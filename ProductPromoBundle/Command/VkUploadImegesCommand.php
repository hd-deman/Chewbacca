<?php
namespace Chewbacca\ProductPromoBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Chewbacca\ProductPromoBundle\Entity\VkBrandPhotoAlbum;
use Chewbacca\ProductPromoBundle\Entity\VkProductPhoto;

class VkUploadImegesCommand extends ContainerAwareCommand
{
    private $archive_album = null;
    private $vkPhpSdk = null;

    protected function configure()
    {
        parent::configure();

        $this->setName('chewbacca:product-promo:vk-upload-images')
             ->setDescription('Upload products images to vk.com.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $host = $this->getContainer()->getParameter('host');
        $this->getContainer()->get('router')->getContext()->setHost($host);

        $this->vkPhpSdk = $this->getContainer()->get('chewbacca_vkontakte_app.vk_php_sdk');
        $this->vkPhpSdk->setAccessToken('f8966542f1b6a3e0f1b6a3e061f198cb1dff1b6f1a503fea13e0e107a17672d');
        $this->vkPhpSdk->setUserId('153142946');

        $em = $this->getContainer()->get('doctrine')->getEntityManager();

        $brands = $em->getRepository('LacrocoStoreBundle:MltdBrand')
            ->createQueryBuilder('b')
            ->select('b, vk_album')
            ->innerJoin('b.mltd_products', 'p')
            ->innerJoin('p.product_images', 'img')
            ->innerJoin('p.currency', 'cur')
            ->leftJoin('b.vk_photo_album', 'vk_album')
            ->innerJoin('p.delivery_prices', 'delivery_price')
            #->andWhere('b.id = 2')
            ->groupBy('b.id')
            ->orderBy('p.created', 'desc')
            ->getQuery()
            ->getResult();

        $vk_group_info = $this->vkPhpSdk->api('groups.getById', array('gid' => 'lacroco'));

        $gid = $vk_group_info["response"][0]['gid'];

        $this->getArchiveAlbum($gid);

        foreach ($brands as $brand) {
            $output->write($brand->getTitle(), true);
            $brand_url = $this->getContainer()->get('router')->generate('products_filter_by_brand', array('brand_slug' => $brand->getSlug()), true);

            $album = $brand->getVkPhotoAlbum();
            if (!$album) {
                $res = $this->vkPhpSdk->api('photos.createAlbum', array(
                    'gid' => $gid,
                    'title' => $brand->getTitle(),
                    'description' => $brand_url,
                    'privacy' => 0,
                    'comment_privacy' => 0
                ));
                $vk_brand_album = new VkBrandPhotoAlbum();
                $vk_brand_album->setTitle($brand->getTitle());
                $vk_brand_album->setDescription($brand_url);
                $vk_brand_album->setVkAid($res['response']['aid']);
                $vk_brand_album->setVkOwnerId(abs($res['response']['owner_id']));
                $vk_brand_album->setVkSize($res['response']['size']);
                $vk_brand_album->setBrand($brand);
                $em->persist($vk_brand_album);
                $em->flush();
            } else {
                $vk_brand_album = $album;
            }
            foreach ($brand->getMltdProducts() as $product) {
                if ($product->getWarningLevel()<10) {
                    foreach ($product->getProductImages() as $productImage) {
                        if (!$productImage->getVkProductPhoto()) {
                            $res = $this->vkPhpSdk->api('photos.getUploadServer', array(
                                'aid' => $vk_brand_album->getVkAid(),
                                'gid' => $vk_brand_album->getVkOwnerId(),
                            ));

                            $ch = curl_init();
                            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data;'));
                            curl_setopt($ch, CURLOPT_URL, $res['response']["upload_url"]);
                            curl_setopt($ch, CURLOPT_FAILONERROR, true);
                            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                            curl_setopt($ch, CURLOPT_AUTOREFERER, true);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
                            curl_setopt($ch, CURLOPT_TIMEOUT, 80);
                            curl_setopt($ch, CURLOPT_MAXREDIRS, 6);

                            curl_setopt($ch, CURLOPT_POST, 1);
                            $tmp=array_search('uri', @array_flip(stream_get_meta_data($GLOBALS[mt_rand()]=tmpfile())));
                            file_put_contents($tmp, file_get_contents('http://lacroco.dev/app_dev.php/media/cache/lacroco_product_biggest'.$productImage->getWebPath()));

                            rename($tmp, $tmp.='.jpg');
                            register_shutdown_function(create_function('', "unlink('{$tmp}');"));
                            var_dump('@'.$tmp);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, array('file1' => '@'.$tmp));

                            $res['response'] = curl_exec($ch);
                            $res['httpcode'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                            $params = json_decode($res['response'], true);

                            if ($params && $params["server"] && $params["photos_list"]!='[]' && $params["aid"] && $params["hash"] && $params["gid"]) {

                                $product_url = $this->getContainer()->get('router')->generate('products_details', array('product_slug' => $product->getSlug(), 'product_id' => $product->getId()), true);
                                $params['caption'] = $product->getTitle()." \n".$product_url;
                                $res = $this->vkPhpSdk->api('photos.save', $params);
                                $vk_product_image = new VkProductPhoto();
                                $vk_product_image->setVkPhotoAlbum($vk_brand_album);
                                $vk_product_image->setProductImage($productImage);
                                $vk_product_image->setCaption($res['response'][0]['text']);
                                $vk_product_image->setVkPid($res['response'][0]['pid']);
                                $vk_product_image->setVkId($res['response'][0]['id']);
                                $vk_product_image->setVkAid($res['response'][0]['aid']);
                                $vk_product_image->setVkOwnerId(abs($res['response'][0]['owner_id']));
                                $vk_product_image->setVkUserId(abs($res['response'][0]['user_id']));
                                $em->persist($vk_product_image);
                                $em->flush();
                            }
                            #sleep(rand(10, 20)*6);
                            //
                        }
                        break;
                    }

                } elseif ($product->getWarningLevel()>9) {
                   $was_found = $product->getWasFound();
                   if (abs($was_found->diff(new \DateTime("now"))->format('%R%a'))>50) {
                        foreach ($product->getProductImages() as $productImage) {
                            if ($vk_photo = $productImage->getVkProductPhoto()) {
                                $output->write('delete old images: '.$productImage->getId(), true);
                                $res = $this->vkPhpSdk->api('photos.delete', array(
                                    'pid' => $vk_photo->getVkPid(),
                                    'oid' => $vk_photo->getVkOwnerId()
                                ));

                                $em->remove($vk_photo);
                                $em->flush();
                            }
                        }
                   }
                } /*elseif  &&  && ) {
                    var_dump($was_found->diff(new \DateTime("now"))->format('%R%a'));
                }*/

            }
/*      ["pid"]=>
      int(287829538)
      ["id"]=>
      string(24) "photo153142946_287829538"
      ["aid"]=>
      int(160196868)
      ["owner_id"]=>
      int(-40566688)
      ["user_id"]=>
      int(153142946)
      ["src"]=>
      string(59) "http://cs402927.userapi.com/v402927946/1fd2/m1vyduhi6S4.jpg"
      ["src_big"]=>
      string(59) "http://cs402927.userapi.com/v402927946/1fd3/NbAwpPZLO7w.jpg"
      ["src_small"]=>
      string(59) "http://cs402927.userapi.com/v402927946/1fd1/wiLBUVZsJS8.jpg"
      ["width"]=>
      int(277)
      ["height"]=>
      int(430)
      ["text"]=>
      string(120) "Sol Republic, Amps HD Headphones - Black
http://lacroco.ru/products-details/sol-republic-amps-hd-headphones-black-22846"
      ["created"]=>
      int(1345039205)
        */
        }
        $em->flush();
        $output->write('total upluaded images: ', true);
    }

    private function getArchiveAlbum($gid)
    {
        return null;
        if (!$this->archive_album || $this->archive_album['size']>=500) {
            $res = $this->vkPhpSdk->api('photos.getAlbums', array('gid' => $gid));
            $i = 0;
            foreach ($res['response'] as $album_v) {
                if (preg_match('~^Archive(\s+\d+)?$~i', $album_v['title'])) {
                    $i++;
                    if ($album_v['size']<500) {
                        $this->archive_album = $album_v;

                        return $this->archive_album;
                    }
                }
            }
            $res = $this->vkPhpSdk->api('photos.createAlbum', array(
                'gid' => $gid,
                'title' => $i ? 'Archive '.$i : 'Archive',
                'description' => "временно нет в наличии",
                'privacy' => 0,
                'comment_privacy' => 0
            ));
            $this->archive_album = $res['response'];
        }

        return $this->archive_album;
    }
}

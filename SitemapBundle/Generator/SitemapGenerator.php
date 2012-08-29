<?php
namespace Chewbacca\SitemapBundle\Generator;
use Symfony\Component\Routing\RouterInterface;

abstract class SitemapGenerator implements SitemapGeneratorInterface
{
  private $router;

  private $config;

  public function __construct(array $config)
  {
      $this->config = $config;
  }

  public function setRouter(RouterInterface $router)
  {
      $this->router = $router;
  }

  public function getRouter()
  {
      return $this->router;
  }

  private function getFilePath()
  {
      return $this->config['path'].$this->config['file_name'];
  }

  public function getWebFilePath()
  {
      return 'http://'.$this->getRouter()->getContext()->getHost().$this->config['web_path'].$this->config['file_name'];
  }

  public function generate($returnString = false)
    {
        // Create dom object
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $dom->formatOutput = true;
        $dom->substituteEntities = false;

        // Create <urlset> root tag
        $urlset = $dom->createElement('urlset');

        // Add attribute of urlset
        $xmlns = $dom->createAttribute('xmlns');
        $urlsetText = $dom->createTextNode('http://www.sitemaps.org/schemas/sitemap/0.9');
        $urlset->appendChild($xmlns);
        $xmlns->appendChild($urlsetText);

        /*
         *  Generate <url> tags and bind them in urlset
         *  <url>
         *     <loc>link</loc>
         *     <lastmod>date</lastmod>
         *     <priority>date</priority>
         *  </url>
         */
        $tags = array('loc', 'lastmod', 'priority');
        $entities = $this->getEntities();
        foreach ($entities as $entity) {
            $url = $dom->createElement('url');
            foreach ($tags as $tag) {
                $text = $dom->createTextNode($this->getTagValue($entity, $tag));
                $elem = $dom->createElement($tag);
                $elem->appendChild($text);

                $url->appendChild($elem);
            }

            $urlset->appendChild($url);
        }

        $dom->appendChild($urlset);

        if ($returnString == false)

            return $dom->save($this->getFilePath());

        return $dom->saveXML();
    }

    /**
     *
     * @param  Entity $entity
     * @param  string $tag
     * @return string
     */
        private function getTagValue($entity, $tag)
    {
        if (!is_array($this->config[$tag])) {
            $method = 'get' . ucfirst($this->config[$tag]);
            if (method_exists($entity, $method)) {
                $value = $entity->$method();

                if ($value instanceof \DateTime) {
                    $value = $value->format('Y-m-d');
                } else {
                    $value = substr($value, 0, 100);
                }
            } else {
                $value = $this->config[$tag];
            }

            return $value;
        } else {
            extract($this->config[$tag]);

            foreach ($params as $key => $param) {
                if (is_array($param)) {
                    $value        = $entity->{'get' . ucfirst($param['field'])}();
                    $object       = new $param['class'];
                    $params[$key] = $object->{$param['method']}($value);
                } else {
                    $value        = $entity->{'get' . ucfirst($param)}();
                    $params[$key] = $value;
                }
            }

            return $this->router->generate($route, $params, true);
        }
    }
}

<?php
namespace Chewbacca\ExchangeRatesBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class ExchangeRatesUpdateCommand extends ContainerAwareCommand
{
	var $rates;

    protected function configure()
    {
        parent::configure();

        $this->setName('chewbacca:exchange-rates:update')
             ->setDescription('Update exchange rates from CBRF.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

		$client = new \SoapClient("http://www.cbr.ru/DailyInfoWebServ/DailyInfo.asmx?WSDL"); 
		if (!isset($date)) $date = date("Y-m-d"); 
		$curs = $client->GetCursOnDate(array("On_date" => $date));
		$this->rates = new \SimpleXMLElement($curs->GetCursOnDateResult->any);
		$rate = $this->GetRate('USD');
		$output->write('USD rate is: '.$rate, true);
		die();
		$em = $this->getContainer()->get('doctrine')->getEntityManager();
		$mltdParser = new MltdObject();
		$brands = $mltdParser->getBrands();
		$new = 0;
		if (is_array($brands)){
			foreach ($brands as $key => $brand_vars) {
				$brand = $em->getRepository('LacrocoStoreBundle:MltdBrand')
					->createQueryBuilder('b')
					->add('where', 'b.mltd_slug = :mltd_id and b.title = :title')
					->setParameter('mltd_id', $brand_vars["mltd_id"])
					->setParameter('title', $brand_vars["title"])
					->getQuery()
					->getOneOrNullResult();
				if (!$brand) {
					$brand = new MltdBrand();
					$output->write('new_brand: '.$brand_vars["title"], true);
					$new++;
				}
				$brand->setTitle($brand_vars["title"]);
				$brand->setMltdSlug($brand_vars["mltd_id"]);
				$brand->setMltdUrl($brand_vars["original_url"]);
				$em->persist($brand);
			}
		}
		$em->flush();

		$output->write('total found categories: '.$brands ? count($brands) : 0, true);
		$output->write('total new categories: '.$new, true);
		return 0;
    }

	function GetRate ($code)
	{
	//Этот метод получает в качестве параметра цифровой или буквенный код валюты и возвращает ее курс
		$code1 = (int)$code;
		if ($code1!=0) 
		{
			$result = $this->rates->xpath('ValuteData/ValuteCursOnDate/Vcode[.='.$code.']/parent::*');
		}
		else
		{
			$result = $this->rates->xpath('ValuteData/ValuteCursOnDate/VchCode[.="'.$code.'"]/parent::*');
		}
		if (!$result)
		{
			return false; 
		}
		else 
		{
			$vc = (float)$result[0]->Vcurs;
			$vn = (int)$result[0]->Vnom;
			return ($vc/$vn);
		}
	}
}
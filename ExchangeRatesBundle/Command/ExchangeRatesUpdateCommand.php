<?php
namespace Chewbacca\ExchangeRatesBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Chewbacca\ExchangeRatesBundle\Entity\Currency;

class ExchangeRatesUpdateCommand extends ContainerAwareCommand
{
    public $rates;

    protected function configure()
    {
        parent::configure();

        $this->setName('chewbacca:exchange-rates:update')
             ->setDescription('Update exchange rates from CBRF.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager();

        $client = new \SoapClient("http://www.cbr.ru/DailyInfoWebServ/DailyInfo.asmx?WSDL");
        if (!isset($date)) $date = date("Y-m-d");
        $curs = $client->GetCursOnDate(array("On_date" => $date));
        $this->rates = new \SimpleXMLElement($curs->GetCursOnDateResult->any);

        $currencies = $em->getRepository('ChewbaccaExchangeRatesBundle:Currency')
            ->createQueryBuilder('c')
            ->getQuery()
            ->getResult();

        foreach ($currencies as $cur) {
            $rate = $this->GetRate($cur->getMnemo());
            $cur->setRate($rate);
            $output->write($cur->getMnemo().' rate is: '.$cur->getRate(), true);
            $em->persist($cur);
        }
        $em->flush();
        $output->write('all rates updated', true);

        return 0;
    }

    public function GetRate ($code)
    {
    //Этот метод получает в качестве параметра цифровой или буквенный код валюты и возвращает ее курс
        $code1 = (int) $code;
        if ($code1!=0) {
            $result = $this->rates->xpath('ValuteData/ValuteCursOnDate/Vcode[.='.$code.']/parent::*');
        } else {
            $result = $this->rates->xpath('ValuteData/ValuteCursOnDate/VchCode[.="'.$code.'"]/parent::*');
        }
        if (!$result) {
            return false;
        } else {
            $vc = (float) $result[0]->Vcurs;
            $vn = (int) $result[0]->Vnom;

            return ($vc/$vn);
        }
    }
}

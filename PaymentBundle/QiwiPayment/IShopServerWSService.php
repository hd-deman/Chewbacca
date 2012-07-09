<?php
namespace Chewbacca\PaymentBundle\QiwiPayment;

/**
 * QiwiServerWSService class
 *
 *
 *
 * @author    {author}
 * @copyright {copyright}
 * @package   {package}
 */
class IShopServerWSService extends \SoapClient
{
  private $kernel;
  private static $classmap = array(
                                    'checkBill' => 'checkBill',
                                    'checkBillResponse' => 'checkBillResponse',
                                    'getBillList' => 'getBillList',
                                    'getBillListResponse' => 'getBillListResponse',
                                    'cancelBill' => 'cancelBill',
                                    'cancelBillResponse' => 'cancelBillResponse',
                                    'createBill' => 'createBill',
                                    'createBillResponse' => 'createBillResponse',
                                   );

  public function __construct($wsdl = "IShopServerWS.wsdl", $options = array())
  {
    $this->kernel = $options['kernel'];

    foreach (self::$classmap as $key => $value) {
      if (!isset($options['classmap'][$key])) {
        $options['classmap'][$key] = 'Chewbacca\PaymentBundle\QiwiPayment\\'.$value;
      }
    }
    $wsdl = $this->kernel->locateResource('@ChewbaccaPaymentBundle/QiwiPayment/'.$wsdl);

    $options['location'] = 'http://ishop.qiwi.ru/services/ishop';

    parent::__construct($wsdl, $options);
  }

  /**
   *
   *
   * @param checkBill $parameters
   * @return checkBillResponse
   */
  public function checkBill(checkBill $parameters)
  {
    return $this->__soapCall('checkBill', array($parameters),       array(
            'uri' => 'http://server.ishop.mw.ru/',
            'soapaction' => ''
           )
      );
  }

  /**
   *
   *
   * @param getBillList $parameters
   * @return getBillListResponse
   */
  public function getBillList(getBillList $parameters)
  {
    return $this->__soapCall('getBillList', array($parameters),       array(
            'uri' => 'http://server.ishop.mw.ru/',
            'soapaction' => ''
           )
      );
  }

  /**
   *
   *
   * @param cancelBill $parameters
   * @return cancelBillResponse
   */
  public function cancelBill(cancelBill $parameters)
  {
    return $this->__soapCall('cancelBill', array($parameters),       array(
            'uri' => 'http://server.ishop.mw.ru/',
            'soapaction' => ''
           )
      );
  }

  /**
   *
   *
   * @param createBill $parameters
   * @return createBillResponse
   */
  public function createBill(createBill $parameters)
  {
    return $this->__soapCall('createBill', array($parameters),       array(
            'uri' => 'http://server.ishop.mw.ru/',
            'soapaction' => ''
           )
      );
  }

}

class checkBill
{
  public $login; // string
  public $password; // string
  public $txn; // string
}

class checkBillResponse
{
  public $user; // string
  public $amount; // string
  public $date; // string
  public $lifetime; // string
  public $status; // int
}

class getBillList
{
  public $login; // string
  public $password; // string
  public $dateFrom; // string
  public $dateTo; // string
  public $status; // int
}

class getBillListResponse
{
  public $txns; // string
  public $count; // int
}

class cancelBill
{
  public $login; // string
  public $password; // string
  public $txn; // string
}

class cancelBillResponse
{
  public $cancelBillResult; // int
}

class createBill
{
  public $login; // string
  public $password; // string
  public $user; // string
  public $amount; // string
  public $comment; // string
  public $txn; // string

  // время жизни (если пусто, используется по умолчанию 30 дней)
  public $lifetime; // string

  // уведомлять пользователя о выставленном счете (0 - нет, 1 - послать СМС, 2 - сделать звонок)
  // уведомления платные для магазина, доступны только магазинам, зарегистрированным по схеме "Именной кошелёк"
  public $alarm = 1; // int

  // выставлять счет незарегистрированному пользователю
  // false - возвращать ошибку в случае, если пользователь не зарегистрирован
  // true - выставлять счет всегда
  public $create = true; // boolean

  public function __construct($params = array())
  {
    if (isset($params['login'])) {
      $this->login = $params['login'];
    }
    if (isset($params['password'])) {
      $this->password = $params['password'];
    }
    if (isset($params['user'])) {
      $this->user = $params['user'];
    }
    if (isset($params['amount'])) {
      $this->amount = $params['amount'];
    }
    if (isset($params['comment'])) {
      $this->comment = $params['comment'];
    }
    if (isset($params['txn'])) {
      $this->txn = $params['txn'];
    }
    if (isset($params['lifetime'])) {
      $this->lifetime = $params['lifetime'];
    }
    if (isset($params['alarm'])) {
      $this->alarm = $params['alarm'];
    }
    if (isset($params['create'])) {
      $this->create = $params['create'];
    }
  }
}

class createBillResponse
{
  public $createBillResult; // int
}

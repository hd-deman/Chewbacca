<?php
namespace Chewbacca\PaymentBundle\QiwiPayment;

use Chewbacca\PaymentBundle\Payment\BasePayment;

use Chewbacca\PaymentBundle\QiwiPayment\createBill;

/*
 * <p>TERMINATION CODES</p>
 * <ul>
 * <li>0    Success</li>
 * <li>13   Server is busy, please repeat your request later</li>
 * <li>150  Authorization error (wrong login/password)</li>
 * <li>215  Bill with this txn-id already exists</li>
 * <li>278  Bill list maximum time range exceeded</li>
 * <li>298  No such agent in the system</li>
 * <li>300  Unknown error</li>
 * <li>330  Encryption error</li>
 * <li>370  Maximum allowed concurrent requests overlimit</li>
 * </ul>
 *
 * <p>STATUSES REFERENCE</p>
 * <ul>
 * <li>50   Made</li>
 * <li>52   Processing</li>
 * <li>60   Payed</li>
 * <li>150  Cancelled (Machine error)</li>
 * <li>160  Cancelled</li>
 * <li>161  Cancelled (Timeout)</li>
 * </ul>
*/

class QiwiPayment extends BasePayment
{

	private $login;
	private $password;
	private $server;

	public function createBillParamsFromOrder($order){
		$params = array(
			'login' => $this->login,
			'password' => $this->password,
		);
		$params['amount'] = $order->getAmount();
		$params['comment'] = 'оплата заказа №'.$order->getId();
		$params['txn'] = $order->getId();
		$params['user'] = '9060557462'; #$order->getMobile();
		#$params['lifetime'] = $lifetime;
		return $params;
	}

    /**
     * {@inheritDoc}
     */
	public function createBill($order){

		$createBillParams = new createBill($this->createBillParamsFromOrder($order));

		$res = $this->server->createBill($createBillParams);
		$rc = $res->createBillResult;
		return $rc;
	}

	public function cancelBill($params){

	}

	public function setLogin($login){
		$this->login = $login;
	}

	public function setPassword($password){
		$this->password = $password;
	}

	public function setServer($server){
		$this->server = $server;
	}
}
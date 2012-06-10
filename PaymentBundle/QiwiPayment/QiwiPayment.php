<?php
namespace Chewbacca\PaymentBundle\QiwiPayment;

use Chewbacca\PaymentBundle\Payment\BasePayment;

use Chewbacca\PaymentBundle\QiwiPayment\createBill;


class QiwiPayment extends BasePayment
{

	private static $termination_codes = array(
		0 	=> 'Success',
		150	=> 'Authorization error (wrong login/password)',
		215 => 'Bill with this txn-id already exists',
		278 => 'Bill list maximum time range exceeded',
		298 => 'No such agent in the system',
		300 => 'Unknown error',
		330 => 'Encryption error',
		370 => 'Maximum allowed concurrent requests overlimit'
	);

	private static $statuses_codes = array(
		50 => 'Made',
		52 => 'Processing',
		60 => 'Payed',
		150 => 'Cancelled (Machine error)',
		160 => 'Cancelled',
		161 => 'Cancelled (Timeout)',
	);

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
		$params['user'] = preg_replace('~^\+?7~', '', $order->getPhone()->getPhoneNumber());
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
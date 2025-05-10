<?php

/**
 * Payment Interface
 *
 * @package     NewTaxi Prime
 * @subpackage  Contracts
 * @category    Payment Interface
 * @author      Seen Technologies
 * @version     1.1.0
 * @link        https://seentechs.com
*/

namespace App\Contracts;

interface PaymentInterface
{
	function makePayment($payment_data,$nonce);
}
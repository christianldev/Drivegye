<?php

/**
 * SMS Interface
 *
 * @package     NewTaxi Prime
 * @subpackage  Contracts
 * @category    SMS Interface
 * @author      Seen Technologies
 * @version     1.1.0
 * @link        https://seentechs.com
*/

namespace App\Contracts;

interface SMSInterface
{
	function initialize();
	function send($to,$text);
}
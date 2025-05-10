<?php

/**
 * Auth Interface
 *
 * @package     NewTaxi Prime
 * @subpackage  Contracts
 * @category    Auth Interface
 * @author      Seen Technologies
 * @version     1.1.0
 * @link        https://seentechs.com
*/

namespace App\Contracts;

use Illuminate\Http\Request;

interface AuthInterface
{
	public function create(Request $request);
	public function login($credentials);
}
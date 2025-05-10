<?php

/**
 * Payment Gateway Model
 *
 * @package     NewTaxi Prime
 * @subpackage  Model
 * @category    Payment Gateway
 * @author      Seen Technologies
 * @version     1.1.0
 * @link        https://seentechs.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payment_gateway';

    public $timestamps = false;
}

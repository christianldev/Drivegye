<?php

/**
 * PaymentMethod Model
 *
 * @package     NewTaxi Prime
 * @subpackage  Model
 * @category    PaymentMethod
 * @author      Seen Technologies
 * @version     1.7
 * @link        https://seentechs.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payment_method';

   
    public $timestamps = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    public function scopePayment($query)
    {
        return $query->whereNotNull('payment_method_id')->whereNotNull('intent_id')->whereNotNull('customer_id')->orderBy('id','desc');
    }
}

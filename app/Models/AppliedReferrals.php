<?php

/**
 * Applied Referrals Model
 *
 * @package     NewTaxi Prime
 * @subpackage  Model
 * @category    Applied Referrals
 * @author      Seen Technologies
 * @version     1.1.0
 * @link        https://seentechs.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppliedReferrals extends Model
{
    use CurrencyConversion;

    public $timestamps = true;

    public $convert_fields = ['amount'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','amount','currency_code'];    
}

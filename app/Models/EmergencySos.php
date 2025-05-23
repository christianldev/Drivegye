<?php

/**
 * Emercency Sos Model
 *
 * @package     NewTaxi Prime
 * @subpackage  Model
 * @category    EmergencySOS
 * @author      Seen Technologies
 * @version     1.1.0
 * @link        https://seentechs.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmergencySos extends Model
{
	/**
	* The database table used by the model.
	*
	* @var string
	*/
    protected $table = 'emergency_sos';
    
    public $timestamps = false;

    protected $appends = ['original_number'];

    /**
     * Get Mobile Number Value
     *
     */
    public function getMobileNumberAttribute()
    {
        return $this->attributes['country_code'].$this->attributes['mobile_number'];
    }

    /**
     * Get Original Number Value
     *
     */
    public function getOriginalNumberAttribute()
    {
        return $this->attributes['mobile_number'];
    }

    // Join with country table
    public function country()
    {
        return $this->belongsTo('App\Models\Country','country_id','id');
    }

    // Join with country table
    public function getCountryCodeAttribute()
    {
        return $this->country->short_name;
    }
}

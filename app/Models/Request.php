<?php

/**
 * Request Model
 *
 * @package     NewTaxi Prime
 * @subpackage  Model
 * @category    Request
 * @author      Seen Technologies
 * @version     1.1.0
 * @link        https://seentechs.com
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DateTime;

class Request extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    use SoftDeletes;
    protected $table = 'request';

    protected $appends = ['accepted_count','pending_count','cancelled_count','total_count','date_time','total_fare','payment_status','currency_code','currency_symbol'];
    protected $dates = ['deleted_at'];

    // Join with users table
    public function users()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    // Join with driver table
    public function driver()
    {
        return $this->belongsTo('App\Models\User','driver_id','id');
    }
    
    // Join with driver_location table
    public function driver_location()
    {
        return $this->hasOne('App\Models\DriverLocation','user_id','driver_id');
    }

    // Join with driver_location table
    public function request()
    {
        return $this->hasmany('App\Models\Request','group_id','group_id');
    }
    
    // Join with profile_picture table
    public function profile_picture()
    {
        return $this->belongsTo('App\Models\ProfilePicture','user_id','user_id');
    }

    // Join with trips table
    public function trips()
    {
        return $this->belongsTo('App\Models\Trips','id','request_id');
    }

    // Join with profile_picture table
    public function car_type()
    {
        return $this->belongsTo('App\Models\CarType','car_id','id');
    }

    // Join with schedule_ride table
    public function schedule_ride()
    {
        return $this->belongsTo('App\Models\ScheduleRide','schedule_id','id');
    }

    public function getAcceptedTripsAttribute()
    {
        $trips = $this->trips()->first();
        $accpted_request = Request::where('group_id',$this->attributes['group_id'])->where('status','Accepted')->first();
        if($accpted_request) {
            $trips = Trips::where('request_id', $accpted_request->id)->first();
        }
        return $trips;
    }
    
    // get user Accepted count
    public function getAcceptedCountAttribute()
    {
         return Request::where('driver_id',$this->attributes['driver_id'])->where('status','Accepted')->count();
    }
    
    // get user Pending count
    public function getPendingCountAttribute()
    {
        return Request::where('driver_id',$this->attributes['driver_id'])->where('status','Pending')->count();
    } 

    // get user Cancelled count
    public function getCancelledCountAttribute()
    {
        return Request::where('driver_id',$this->attributes['driver_id'])->where('status','Cancelled')->count();
    }

    // get user Total count
    public function getTotalCountAttribute()
    {
        return Request::where('driver_id',$this->attributes['driver_id'])->count();
    }

    // get trip total fare
    public function getTotalFareAttribute()
    {
        $trips= Trips::where('request_id',$this->attributes['id']);
        if($trips->count()) {
            return number_format(($trips->get()->first()->total_fare),2, '.', '');
        }
        return "N/A";
    }

    // get trip payment status
    public function getPaymentStatusAttribute()
    {
        $trips= Trips::where('request_id',$this->attributes['id']);
        if($trips->count()) {
            return @$trips->get()->first()->payment_status;
        }
        return "Not Paid";
    }

    // get trip currency code
    public function getCurrencyCodeAttribute()
    {
        $trips= Trips::where('request_id',$this->attributes['id']);
        if($trips->count()) {
            return  @$trips->get()->first()->currency_code;
        }
        return "USD";
    }

    //get trip currency code
    public function getCurrencySymbolAttribute()
    {
        $trips= Trips::where('request_id',$this->attributes['id']);
        if($trips->count()) {
            $code =  @$trips->first()->currency_code;
           return Currency::where('code',$code)->first()->symbol;
        }
        return "$";
    }
    /**
     * Get Date time Formatted
     *  
     */
    public function getDateTimeAttribute()
    {
        $now = new DateTime;
        $now->setTimezone(new \DateTimeZone($this->attributes['timezone']));
        $ago = new DateTime($this->attributes['created_at']);
        $now->setTimezone(new \DateTimeZone($this->attributes['timezone']));
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    /**
     * Get Formatted Drop Latitude
     *  
     */
    public function getFormattedDropLatitudeAttribute()
    {
        $latitude = $this->drop_latitude;
        if($this->trips && in_array($this->trips->status,['Rating','Payment','Completed'])) {
            $latitude = $this->trips->drop_latitude;
        }
        return $latitude;
    }

    /**
     * Get Formatted Drop Longitude
     *  
     */
    public function getFormattedDropLongitudeAttribute()
    {
        $longitude = $this->drop_longitude;
        if($this->trips && in_array($this->trips->status,['Rating','Payment','Completed'])) {
            $longitude = $this->trips->drop_longitude;
        }
        return $longitude;
    }

    /**
     * Check requested car type is pool or not
     *  
     */
    public function getIsPoolTripAttribute()
    {
        return ($this->car_type->is_pool == "Yes");
    }
}

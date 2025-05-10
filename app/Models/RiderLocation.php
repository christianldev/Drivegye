<?php

/**
 * Rider Location Model
 *
 * @package     NewTaxi Prime
 * @subpackage  Model
 * @category    Rider Location
 * @author      Seen Technologies
 * @version     1.1.0
 * @link        https://seentechs.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiderLocation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rider_location';

    public $timestamps = false;

    protected $guarded = [];
}
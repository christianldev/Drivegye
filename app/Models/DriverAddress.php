<?php

/**
 * Driver Address Model
 *
 * @package     NewTaxi Prime
 * @subpackage  Model
 * @category    Driver Address
 * @author      Seen Technologies
 * @version     1.1.0
 * @link        https://seentechs.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriverAddress extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'driver_address';

    public $timestamps = false;
}
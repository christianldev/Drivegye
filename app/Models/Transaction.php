<?php

/**
 * ApiCredential Model
 *
 * @package     NewTaxi Prime
 * @subpackage  Model
 * @category    ApiCredential
 * @author      Seen Technologies
 * @version     1.1.0
 * @link        https://seentechs.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transactions';

    public $timestamps = false;
}

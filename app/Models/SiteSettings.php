<?php

/**
 * Site Settings Model
 *
 * @package     NewTaxi Prime
 * @subpackage  Model
 * @category    Site Settings
 * @author      Seen Technologies
 * @version     1.1.0
 * @link        https://seentechs.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSettings extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'site_settings';

    public $timestamps = false;
}

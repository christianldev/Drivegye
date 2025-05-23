<?php
/**
 * Language Model
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

class Language extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'language';

    public $timestamps = false;

    /**
     * Scope to get Active records Only
     *
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }
}

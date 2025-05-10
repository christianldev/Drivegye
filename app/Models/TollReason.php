<?php
/**
 * Language Model
 *
 * @package     NewTaxi Prime
 * @subpackage  Model
 * @category    TollReason
 * @author      Seen Technologies
 * @version     1.1.0
 * @link        https://seentechs.com
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TollReason extends Model
{
    
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['reason','status'];

    /**
     * Scope to get Active records Only
     *
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }
}

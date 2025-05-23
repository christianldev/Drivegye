<?php

/**
 * Profile Picture Model
 *
 * @package     NewTaxi Prime
 * @subpackage  Model
 * @category    Profile Picture
 * @author      Seen Technologies
 * @version     1.1.0
 * @link        https://seentechs.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilePicture extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'profile_picture';

    protected $primaryKey = 'user_id';

    public $timestamps = false;

    public $appends = ['header_src', 'email_src'];

    // Get picture source URL based on photo_source
    public function getSrcAttribute()
    {
        $url = \App::runningInConsole() ? SITE_URL : url('/');

        $src = @$this->attributes['src'];
        
        if($src == "") {
            $src = $url.'/images/user.jpeg';
        }
        else if($this->attributes['photo_source'] == 'Local') {
            $picture_details = pathinfo($src);
            $src = $url.'/images/user.jpeg';
            if($picture_details['filename'] != 'user') {
                $src =  $url.'/images/users/'.$this->attributes['user_id'].'/'.@$picture_details['filename'].'.'.@$picture_details['extension'];  
            }
        }
        return $src;
    }

    // Get header picture source URL based on photo_source
    public function getHeaderSrcAttribute()
    {
        if($this->attributes['photo_source'] == 'Facebook')
            $src = str_replace('large', 'small', $this->attributes['src']);
        else
            $src = $this->attributes['src'];

        if($src == '')
            $src = url('images/user.jpeg');
        else if($this->attributes['photo_source'] == 'Local'){           
            if($this->attributes['src']==url('images/user.jpeg'))
                $src=$this->attributes['src'];
            else{
                $picture_details = pathinfo($this->attributes['src']);
                $src = url('images/users/'.$this->attributes['user_id'].'/'.@$picture_details['filename'].'.'.@$picture_details['extension']);
            }
            
        }

        return $src;
    }
    
    //mobile hearder picture src 
    public function getHeaderSrc510Attribute()
    {
        if($this->attributes['photo_source'] == 'Facebook')
            $src = str_replace('large', 'small', $this->attributes['src']);
        else
            $src = $this->attributes['src'];

        if($src == '')
            $src = url('images/user.jpeg');
        else if($this->attributes['photo_source'] == 'Local'){
            $picture_details = pathinfo($this->attributes['src']);
             $src = url('images/users/'.$this->attributes['user_id'].'/'.@$picture_details['filename'].'.'.@$picture_details['extension']);
        }

        return $src;
    }

    /**
     * Get Image Source for Email
     *
     */
    public function getEmailSrcAttribute()
    {
        if($this->attributes['photo_source'] == 'Facebook')
            $src = str_replace('large', 'small', $this->attributes['src']);
        else
            $src = $this->attributes['src'];

        if($src == '')
            $src = url('images/user.jpeg');
        else if($this->attributes['photo_source'] == 'Local'){
            $picture_details = pathinfo($this->attributes['src']);
            $src = url('images/users/'.$this->attributes['user_id'].'/'.@$picture_details['filename'].'.'.@$picture_details['extension']);
        }

        return $src;
    }
}

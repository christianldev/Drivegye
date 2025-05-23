<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model {

    /**
    * The database table used by the model.
    *
    * @var string
    */

    protected $fillable = ['title','description','url','status'];

    public $timestamps = false;

    public function getImageSrcAttribute() {
        return url('images/banner/'.$this->attributes['image']);
    }

    public function scopeActive($query) {
        return $query->whereStatus('Active');
    }    
}



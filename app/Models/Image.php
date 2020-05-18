<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $table = 'cscart_images';
    protected $primaryKey = 'image_id';

    protected $guarded = [];

//    public function image_link(){
//        return $this->hasOne(ImageLink::class, 'image_id', 'image_id');
//    }

    public function image_link(){
        return $this->hasMany(ImageLink::class, 'image_id', 'image_id');
    }
}

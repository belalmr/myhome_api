<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $table = 'cscart_images';
    protected $primaryKey = 'image_id';
    protected $appends = ['image_url'];

    protected $guarded = [];

    public function image_link(){
        return $this->hasMany(ImageLink::class, 'image_id', 'image_id');
    }

    public function getImageUrlAttribute() {
        return 'https://my-home.co/images/thumbnails/278/278/detailed/'
            . floor($this->image_id / 1000) . '/' . $this->image_path;
    }
}

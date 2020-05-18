<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerImage extends Model
{
    protected $table = 'cscart_banner_images';
    protected $primaryKey = 'banner_image_id';

    protected $guarded = [];

    public function banner()
    {
        return $this->belongsTo(Banner::class, 'banner_id', 'banner_id');
    }

    public function image_link()
    {
        return $this->hasOne(ImageLink::class, 'detailed_id', 'banner_image_id');
    }
}

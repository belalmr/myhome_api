<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageLink extends Model
{
    protected $table = 'cscart_images_links';
    protected $primaryKey = 'pair_id';

    protected $guarded = [];
//pair_id
//object_id
//object_type
//image_id
//detailed_id
//type
//position
    public function images()
    {
        return $this->belongsTo(Image::class, 'detailed_id', 'image_id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'object_id', 'product_id');
    }

    public function banner_image()
    {
        return $this->belongsTo(BannerImage::class, 'image_id', 'banner_image_id');
    }
}

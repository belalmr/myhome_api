<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'cscart_banners';
    protected $primaryKey = 'banner_id';

    protected $guarded = [];

    public function b_images()
    {
        return $this->hasMany(BannerImage::class, 'banner_id', 'banner_id');
    }
}

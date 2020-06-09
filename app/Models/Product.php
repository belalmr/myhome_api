<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'cscart_products';
    protected $primaryKey = 'product_id';
    protected $appends = ['images'];

    protected $guarded = [];

    public function p_description(){
        return $this->hasMany(ProductDescription::class, 'product_id','product_id');
    }

    public function p_options(){
        return $this->hasMany(ProductOption::class, 'product_id','product_id');
    }

    public function p_features_values(){
        return $this->hasMany(ProductFeatureValue::class, 'product_id','product_id');
    }

    public function p_tabs(){
        return $this->hasMany(ProductTab::class, 'product_id','product_id');
    }

    public function image_link(){
        return $this->hasMany(ImageLink::class, 'object_id', 'product_id');
    }

    public function p_price(){
        return $this->hasOne(ProductPrice::class, 'product_id', 'product_id');
    }

    public function p_sale(){
        return $this->hasOne(ProductSale::class, 'product_id', 'product_id');
    }

    public function session_product(){
        return $this->hasMany(UserSessionProduct::class, 'product_id', 'product_id');
    }

    public function category(){
        return $this->hasMany(ProductCategory::class, 'product_id', 'product_id');
    }

    public function company(){
        return $this->belongsTo(Company::class, 'company_id', 'company_id');
    }

    public function getImagesAttribute(){
        $image = ImageLink::where('object_id', $this->product_id)->pluck('detailed_id')->toArray();
        return Image::whereIn('image_id', $image)->get();
    }

}

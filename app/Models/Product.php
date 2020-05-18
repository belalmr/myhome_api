<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'cscart_products';
    protected $primaryKey = 'product_id';

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


//    public static function pricebeg(){
//        return Product::where('cscart_products.list_price','>','cscart_product_prices.price')
//            ->first()->list_price;
//    }
}

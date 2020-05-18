<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFeatureVariant extends Model
{
    protected $table = 'cscart_product_feature_variants';
    protected $primaryKey = 'variant_id';

    protected $guarded = [];

//    public function product(){
//        $this->belongsTo(Product::class,'product_id','product_id');
//    }

    public function f_v_description(){
        return $this->hasMany(ProductFeatureVariantDescription::class, 'variant_id','variant_id');
    }

    public function f_values(){
        return $this->hasMany(ProductFeatureValue::class, 'feature_id','feature_id');
    }

    public function p_feature(){
        return $this->hasMany(ProductFeature::class, 'feature_id','feature_id');
    }

}

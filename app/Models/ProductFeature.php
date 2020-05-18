<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFeature extends Model
{
    protected $table = 'cscart_product_features';
    protected $primaryKey = 'feature_id';

    protected $guarded = [];

//    public function product(){
//        $this->belongsTo(Product::class,'product_id','product_id');
//    }

    public function f_description(){
        return $this->hasMany(ProductFeatureDescription::class, 'feature_id','feature_id');
    }

    public function f_feature_variants(){
        return $this->hasMany(ProductFeatureVariant::class, 'feature_id','feature_id');
    }

    public function f_features_values(){
        return $this->hasMany(ProductFeatureValue::class, 'feature_id','feature_id');
    }
}

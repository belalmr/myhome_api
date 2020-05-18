<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFeatureValue extends Model
{
    protected $table = 'cscart_product_features_values';

    protected $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class,'product_id','product_id');
    }

    public function p_feature(){
        return $this->belongsTo(ProductFeature::class,'feature_id','feature_id');
    }

    public function p_f_variant(){
        return $this->belongsTo(ProductFeatureVariant::class,'variant_id','variant_id');
    }

}

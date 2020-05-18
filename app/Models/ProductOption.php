<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    protected $table = 'cscart_product_options';
    protected $primaryKey = 'option_id';

    protected $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class,'product_id','product_id');
    }

    public function o_variant(){
        return $this->hasMany(ProductOptionVariant::class, 'option_id','option_id');
    }

    public function o_description(){
        return $this->hasMany(ProductOptionDescription::class, 'option_id','option_id');
    }

}

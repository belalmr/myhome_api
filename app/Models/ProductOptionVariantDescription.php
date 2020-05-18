<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOptionVariantDescription extends Model
{
    protected $table = 'cscart_product_option_variants_descriptions';

    protected $guarded = [];

    public function product(){
        $this->belongsTo(Product::class,'product_id','product_id');
    }
}

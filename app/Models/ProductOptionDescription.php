<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOptionDescription extends Model
{
    protected $table = 'cscart_product_options_descriptions';

    protected $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class,'product_id','product_id');
    }
}

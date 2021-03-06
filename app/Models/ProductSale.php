<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSale extends Model
{
    protected $table = 'cscart_product_sales';

    protected $guarded = [];

    public function product(){
        $this->belongsTo(Product::class,'product_id','product_id');
    }
}

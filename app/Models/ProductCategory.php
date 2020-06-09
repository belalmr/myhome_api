<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'cscart_products_categories';
//    protected $primaryKey = 'product_id';

    protected $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

}

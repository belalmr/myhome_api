<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTab extends Model
{
    protected $table = 'cscart_product_tabs';
    protected $primaryKey = 'tab_id';

    protected $guarded = [];

    public function t_description(){
        return $this->hasMany(ProductTabDescription::class, 'variant_id','variant_id');
    }
}

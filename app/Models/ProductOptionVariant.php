<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PhpOption\Option;

class ProductOptionVariant extends Model
{
    protected $table = 'cscart_product_option_variants';
    protected $primaryKey = 'variant_id';

    protected $guarded = [];

    public function option(){
        return $this->belongsTo(ProductOption::class,'option_id','option_id');
    }

    public function o_variant_description(){
        return $this->hasMany(ProductOptionVariantDescription::class, 'variant_id','variant_id');
    }
}

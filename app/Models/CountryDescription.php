<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryDescription extends Model
{
    protected $table = 'cscart_country_descriptions';

    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Country::class,'category_id','category_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'cscart_countries';
    protected $primaryKey = 'code';

    protected $guarded = [];

    public function c_description(){
        return $this->hasMany(CountryDescription::class, 'code','code');
    }
}

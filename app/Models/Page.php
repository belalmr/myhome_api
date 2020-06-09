<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'cscart_page_descriptions';
    protected $primaryKey = 'page_id';

    protected $guarded = [];

    public function p_description(){
        return $this->hasMany(PageDescription::class, 'page_id','page_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'cscart_categories';
    protected $primaryKey = 'category_id';

    protected $guarded = [];

    public function c_description(){
        return $this->hasMany(CategoryDescription::class, 'category_id','category_id');
    }

}

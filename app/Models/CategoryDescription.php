<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryDescription extends Model
{
    //
    protected $table = 'cscart_category_descriptions';

    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','category_id');
    }
}

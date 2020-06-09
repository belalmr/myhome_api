<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSessionProduct extends Model
{
    protected $table = 'cscart_user_session_products';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    protected $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class,'product_id','product_id');
    }
}

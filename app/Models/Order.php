<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'cscart_orders';
    protected $primaryKey = 'order_id';

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class, 'user_id','user_id');
    }

    public function status1(){
        return $this->belongsTo(Status::class, 'status','status_id');
    }
}

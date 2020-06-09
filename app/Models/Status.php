<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'cscart_statuses';
    protected $primaryKey = 'status_id';

    protected $guarded = [];

    public function status_order(){
        return $this->hasMany(Order::class, 'status', 'status');
    }
}

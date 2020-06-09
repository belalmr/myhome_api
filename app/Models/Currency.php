<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'cscart_currencies';
    protected $primaryKey = 'currency_id';

    protected $guarded = [];

}

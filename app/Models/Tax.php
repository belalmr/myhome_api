<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    //
    protected $table = 'cscart_taxes';
    protected $primaryKey = 'tax_id';

    protected $guarded = [];

    public function tax_rate(){
        return $this->hasMany(TaxRate::class, 'tax_id', 'tax_id');
    }
}

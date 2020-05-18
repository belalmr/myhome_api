<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxRate extends Model
{
    protected $table = 'cscart_tax_rates';

    protected $guarded = [];

    public function tax(){
        return $this->belongsTo(Tax::class, 'tax_id', 'tax_id');
    }
}

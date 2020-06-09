<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'cscart_companies';
    protected $primaryKey = 'company_id';

    public function products(){
        return $this->hasMany(Product::class, 'company_id', 'company_id');
    }
}

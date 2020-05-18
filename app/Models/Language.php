<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'cscart_languages';
    protected $primaryKey = 'lang_id';

    protected $guarded = [];
}

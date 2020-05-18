<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    //
    protected $table = 'cscart_bm_blocks';
    protected $primaryKey = 'block_id';

    protected $guarded = [];
}

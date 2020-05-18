<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{

    protected $table = 'cscart_user_profiles';
    protected $primaryKey = 'profile_id';
    public $timestamps = false;

    protected $guarded = [];

    public function product(){
        return $this->belongsTo(User::class,'user_id','user_id');
    }

//    profile_id
//    user_id
//    profile_type
//    b_firstname
//    b_lastname
//    b_address
//    b_address_2
//    b_city
//    b_county
//    b_state
//    b_country
//    b_zipcode
//    b_phone
//    s_firstname
//    s_lastname
//    s_address
//    s_address_2
//    s_city
//    s_county
//    s_state
//    s_country
//    s_zipcode
//    s_phone
//    s_address_type
//    profile_name

}

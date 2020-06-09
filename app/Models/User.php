<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'cscart_users';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

//    protected $fillable = [
//        'name', 'email', 'password',
//    ];

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token', 'user_login', 'referer', 'is_root','company_id',
        'last_login','company','url','tax_exempt','lang_code','birthday','purchase_timestamp_from','purchase_timestamp_to',
        'responsible_email','last_passwords','password_change_timestamp','api_key','janrain_identifier','salt','timestamp','fax',''
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id', 'user_id');
    }

    public function session_product()
    {
        return $this->hasMany(UserSessionProduct::class, 'user_id', 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'user_id');
    }

}

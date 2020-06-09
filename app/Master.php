<?php

namespace App;

class Master
{
    public static function NiceNames($Model)
    {
        switch ($Model) {
            case 'User':
                return [
                    'name' => __('names.users.name'),
                    'email' => __('names.users.email'),
                    'password' => __('names.users.password'),
                    'old_password' => __('names.users.old_password'),
                    'password_confirmation' => __('names.users.password_confirmation'),
                    'phone' => __('names.users.phone'),
                    'address' => __('names.users.address'),
                    'device_token' => __('names.users.device_token'),
                    'device' => __('names.users.device'),
                    'code' => __('names.users.code'),
                ];
            default :
                [];
        }

    }
}

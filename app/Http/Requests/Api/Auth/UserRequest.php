<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Resources\Api\UserResource;
use App\Master;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class UserRequest extends FormRequest
{
    use ResponseTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'unique:users,email,'. auth()->user()->id,
        ];
    }

    public function attributes()
    {
        return Master::NiceNames('User');
    }
    public function update()
    {
        $logged = auth()->user();
        if($this->has('email'))
            $logged->email = $this->email;
        if($this->has('firstname'))
            $logged->firstname = $this->firstname;
        if($this->has('lastname'))
            $logged->lastname = $this->lastname;
//        if($this->has('telephone'))
//            $logged->telephone = $this->telephone;
        if($this->has('address'))
            $logged->phone = $this->address;
        if($this->has('device_token'))
            $logged->device_token = $this->device_token;
        if($this->has('device'))
            $logged->device = $this->device;
        $logged->save();
        return $this->successJsonResponse( [__('auth.update_successful')],$logged,'User');

    }
}

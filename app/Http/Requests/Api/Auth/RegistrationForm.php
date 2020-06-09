<?php

namespace App\Http\Requests\Api\Auth;

use App\Master;
use App\Http\Requests\Api\ApiRequest;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RegistrationForm extends ApiRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:cscart_users',
            'password' => 'required|string|min:6',
//            'phone' => 'required|string|min:6',
//            'address' => 'required|string|min:6',
            'device_token' => 'string|required_with:device',
            'device' => 'string|required_with:device_token',
        ];

    }

    public function attributes()
    {
        return Master::NiceNames('User');
    }

    public function persist()
    {
        return 11;
        $user = new User();
        $user->firstname = $this->firstname;
        $user->lastname = $this->lastname;
        $user->email = $this->email;
        $user->salt = '';
        $user->company = '';
        $user->fax = '';
        $user->url = '';
        $user->tax_exempt = '';
        $user->lang_code = '';
        $user->purchase_timestamp_from = '';
        $user->last_passwords = '';
        $user->password_change_timestamp = '';
        $user->api_key = '';
        $user->janrain_identifier = '';
        $user->purchase_timestamp_to = '';
        $user->password = md5($this->password);
        $user->telephone = '';
        $user->referer = '';
        $user->status = 'A';
        $user->last_login = '';
        $user->status = 'A';
        $user->user_id = Auth::id();
        $user->user_type = 'user_' . Auth::id();
        $user->address_id = $this->address_id;
        $user->is_root = '';
        $user->salt = $this->salt;
//        $user->device_token = $this->device_token;
//        $user->device = $this->device;
//        $user->token = $this->token;
//        $user->date_added = Carbon::now();
//        if ($this->input('device_token')) {
//            $user->device_token = $this->device_token;
//            $user->device = $this->device;
//        }
        $user->save();

        Auth::attempt(request(['email', 'password']));
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();
        $user->refresh();
        $user['access_token'] = $tokenResult->accessToken;
        $user['token_type'] = 'Bearer';
        $user['expires_at'] = Carbon::parse(
            $tokenResult->token->expires_at
        )->toDateTimeString();
        return $this->successJsonResponse([__('auth.registration_successful')], $user, 'User');

    }

}

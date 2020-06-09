<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiRequest;
use App\Models\UserProfile;
use Illuminate\Foundation\Http\FormRequest;
use App\Master;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoginAuth extends ApiRequest
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
            'email' => 'required|string|email',
            'password' => 'required|string',
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
        $credentials = request(['email', 'password']);
        //  TODO password generate md5 and return and compare with db
        if(!Auth::attempt($credentials))
            return $this->failJsonResponse([__('auth.failed')]);

        $user = $this->user();

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();
        if ($this->input('device_token')) {
            $user->device_token = $this->device_token;
            $user->device = $this->device;
            $user->save();
        }
        $user['profile'] = UserProfile::where('user_id', $this->user()->user_id)->first();
        $user['access_token']= $tokenResult->accessToken;
        $user['access_token']= $tokenResult->accessToken;
        $user['token_type']= 'Bearer';
        $user['expires_at']= Carbon::parse(
            $tokenResult->token->expires_at
        )->toDateTimeString();
        return $this->successJsonResponse( [__('auth.login')], $user,'User');
    }
}

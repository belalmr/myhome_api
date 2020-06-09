<?php

namespace App\Http\Requests\Api\Auth;

use App\Master;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ShowMe extends FormRequest
{
    use ResponseTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
//            'email' => 'required|string|email',
//            'password' => 'required|string',
//            'device_token' => 'string|required_with:device',
//            'device' => 'string|required_with:device_token',
        ];
    }

    public function attributes()
    {
        return Master::NiceNames('User');
    }
    public function persist()
    {
//        $credentials = request(['email', 'password']);
//        if(!Auth::attempt($credentials))
//            return $this->failJsonResponse([__('auth.failed')]);

        $user = $this->user();
//        $request->user();

//        $tokenResult = $user->createToken('Personal Access Token');
//        $token = $tokenResult->token;
//        $token->save();
//        if ($this->input('device_token')) {
//            $user->device_token = $this->device_token;
//            $user->device = $this->device;
//            $user->save();
//        }

//        $user['access_token']= $tokenResult->accessToken;
//        $user['token_type']= 'Bearer';
//        $user['expires_at']= Carbon::parse(
//            $tokenResult->token->expires_at
//        )->toDateTimeString();

        return $this->successJsonResponse( [__('auth.login')], $user,'User');
    }
}

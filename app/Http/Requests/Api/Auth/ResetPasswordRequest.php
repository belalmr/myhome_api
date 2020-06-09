<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiRequest;
use App\Master;
use App\Models\PasswordReset;
use App\Models\User;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetPasswordRequest extends ApiRequest
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
            'email' => 'required|string|exists:users,email',
            'code' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    public function attributes()
    {
        return Master::NiceNames('User');
    }
    public function update()
    {
        $user = User::where('email',$this->email)->first();
        $passwordReset = PasswordReset::where('email',$this->email)->first();
        dd($passwordReset);
        if($passwordReset->token == $this->code){
            $user->password = Hash::make($this->password);
            $user->save();
            $user->notify(
                new PasswordResetSuccess()
            );
            DB::table('oauth_access_tokens')
                ->where('user_id', $user->id)
                ->delete();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->save();
            $user['access_token']= $tokenResult->accessToken;
            $user['token_type']= 'Bearer';
            $user['expires_at']= Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString();

            return $this->successJsonResponse( [__('auth.password_rested')], $user,'User');
        }
        else{
            return $this->failJsonResponse( [__('auth.code_not_correct')]);
        }
    }
}

<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiRequest;
use App\Master;
use App\Models\PasswordReset;
use App\Models\User;
use App\Notifications\PasswordResetRequest;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Hash;

class ForgetPasswordRequest extends ApiRequest
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
        ];
    }

    public function attributes()
    {
        return Master::NiceNames('User');
    }
    public function update()
    {
        $user = User::where('email',$this->email)->first();
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' =>rand(pow(10, 4), pow(10, 5)-1)
            ]
        );
        $user->notify(
            new PasswordResetRequest($passwordReset->token)
        );
        return $this->successJsonResponse([__('auth.code_sent')] );
    }
}

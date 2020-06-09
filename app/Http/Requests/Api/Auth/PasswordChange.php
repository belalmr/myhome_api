<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiRequest;
use App\Master;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Hash;

class PasswordChange extends ApiRequest
{
    use ResponseTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        switch ($this->method()) {
            case 'PATCH':
            case 'PUT':
            case 'DELETE':
            case 'GET':
            {
                return false;
            }
            case 'POST':
            {
                return auth('api')->user() != null;
            }
            default:
                return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => 'required|string|min:6',
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    public function attributes()
    {
        return Master::NiceNames('User');
    }
    public function update()
    {
        $logged = auth()->user();
        if(Hash::check($this->old_password,$logged->password)){
            $logged->password = Hash::make($this->password);
            $logged->save();
            return $this->successJsonResponse([__('auth.update_password_successful')],$logged);
        }
        return $this->failJsonResponse([
            __('messages.password_not_correct')]);
    }
}

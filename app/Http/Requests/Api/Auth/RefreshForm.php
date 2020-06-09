<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiRequest;
use App\Master;
use App\Traits\ResponseTrait;

class RefreshForm extends ApiRequest
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
            'device' => 'required|string',
            'device_token' => 'required|string'
        ];
    }

    public function attributes()
    {
        return Master::NiceNames('User');
    }
    public function refresh()
    {
        $logged = auth('api')->user();
        $logged->device_token = $this->device_token;
        $logged->device = $this->device;
        $logged->save();
        return $this->successJsonResponse( [__('auth.refreshed')],$logged,'User');
    }
}

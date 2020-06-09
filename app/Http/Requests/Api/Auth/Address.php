<?php

namespace App\Http\Requests\Api\Auth;

use App\Traits\ResponseTrait;
use App\Models\UserProfile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Address extends FormRequest
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
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'phone' => 'required|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
        ];
    }

    public function shipping(Request $request, $id)
    {
        if($request != null){
//            $address = UserProfile::find($id);
            $address = UserProfile::where('user_id', $id)->first();
            $address->b_firstname = $request->firstname;
            $address->b_lastname = $request->lastname;
            $address->b_phone = $request->phone;
            $address->b_country = $request->country;
            $address->b_city = $request->city;
            $address->b_address = $request->address;
//            $address->customer_id = Auth::id();

            $address->save();
            return $this->successJsonResponsePost([__('address.update')]);
        }
        return $this->failJsonResponse(['false'],[__('address.failed')]);
    }

    public function payment(Request $request, $id)
    {
        if($request != null){
            $address = UserProfile::where('user_id', $id)->first();
            $address->s_firstname = $request->firstname;
            $address->s_lastname = $request->lastname;
            $address->s_phone = $request->phone;
            $address->s_country = $request->country;
            $address->s_city = $request->city;
            $address->s_address = $request->address;
            $address->save();
            return $this->successJsonResponsePost([__('address.update')]);
        }
        return $this->failJsonResponse(['false'],[__('address.failed')]);
    }
}

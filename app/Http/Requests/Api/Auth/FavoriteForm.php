<?php

namespace App\Http\Requests\Api\Auth;

use App\Models\Product;
use App\Models\UserSessionProduct;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FavoriteForm extends FormRequest
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
            'product_id' => 'required'
        ];
    }

    public function favorite()
    {
        $user_id = Auth::id();
        $product_id = $this->product_id;
        $product = Product::find($product_id);
        $Favourite = UserSessionProduct::where('user_id', $user_id)->first();
        if ($product) {
            if (!$Favourite) {
                $Favourite = new UserSessionProduct();
                $Favourite->user_id = $user_id;
                $Favourite->timestamp = Carbon::now()->timestamp;
                $Favourite->type = 'W';
                $Favourite->user_type = 'R';
                $Favourite->item_id = 0;
                $Favourite->product_id = $this->product_id;
                $Favourite->amount = 1;
                $Favourite->price = 0.00;
                $Favourite->extra = 0;
                $Favourite->session_id = 0;
                $Favourite->ip_address = 0;
                $Favourite->order_id = 0;
                $Favourite->save();
                return $this->successJsonResponse([], ['isFavorite' => true]);

            } else {
                $Favourite->delete();
                return $this->successJsonResponse([], ['isFavorite' => false]);

            }
        } else {
            return $this->failJsonResponse([], 'not found product');
        }
    }
}

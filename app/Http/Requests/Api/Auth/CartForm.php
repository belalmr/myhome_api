<?php

namespace App\Http\Requests\Api\Auth;

use App\Models\Product;
use App\Models\UserSessionProduct;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CartForm extends FormRequest
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
            'product_id' => 'required',
            'amount' => 'required',
        ];
    }

    public function item_id()
    {
        $_cid = request()->item_id;
        $product_id = request()->product_id;
        natsort($_cid);
        array_unshift($_cid, $product_id);
        return $cart_id = crc32(implode('_', $_cid));
    }

    public function add_to_cart()
    {

        $user_id = Auth::id();
        $item_id = UserSessionProduct::where('item_id', $this->item_id())->first();
        $Favourite = UserSessionProduct::where('user_id', $user_id)->first();
        $product = Product::find(request()->product_id);
//        return UserSessionProduct::with('product')->first()->product['product_id'];
        if ($product) {
            if (!$item_id) {
                $Favourite = new UserSessionProduct();
                $Favourite->user_id = $user_id;
                $Favourite->timestamp = Carbon::now()->timestamp;
                $Favourite->type = 'C';
                $Favourite->user_type = 'R';
                $Favourite->item_id = $this->item_id();
                $Favourite->item_type = "P";
                $Favourite->product_id = $this->product_id;
                $Favourite->amount = $this->amount;
                $Favourite->price = $this->price;
//                $Favourite['product_options'] = $this->product_options;
//                $Favourite['pair_id'] = $this->product->with('image_link')->first();
                $Favourite->extra = serialize($Favourite->toArray());
                $Favourite->session_id = 0;
                $Favourite->ip_address = $this->ip();
                $Favourite->order_id = 0;
                $Favourite->save();
                return $this->successJsonResponse([], $Favourite);
//                return $this->successJsonResponse([], $Favourite, ['isCart' => true]);
            } else {

                $amount = $Favourite->amount + $this->amount;
                $Favourite->update(['amount' => $this->amount + $Favourite->amount]);
//                $add = $Favourite->amount + $this->amount;
//                return $this->successJsonResponse([], ['isCart' => 'add ' . $add]);
                return $this->successJsonResponse([], $Favourite);
            }
        } else {
            return $this->failJsonResponse([], 'not found product');
        }
    }
}

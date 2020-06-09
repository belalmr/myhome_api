<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\CartForm;
use App\Http\Resources\CartResource;
use App\Models\UserSessionProduct;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    use ResponseTrait;

    public function add_to_cart(CartForm $form)
    {
        return $form->add_to_cart();
    }

    public function increase_cart(Request $request)
    {
        $cart = UserSessionProduct::where('item_id', $request->item_id);
        $cart->update(['amount' => $request->number]);
        return $this->successJsonResponse([], 'increase_cart');
    }

    public function fetch_cart()
    {
        // TODO return cart
//        $cart = UserSessionProduct::where('user_id', Auth::id())->select([''])->get();
        $cart = UserSessionProduct::where('user_id', 3132978388)->get();
        return $this->successJsonResponse([], new CartResource($cart));
    }

    public function delete_cart(Request $request)
    {
        $cart = UserSessionProduct::where('item_id', $request->item_id)->first();

        if ($cart) {
            $cart->delete();
            return $this->successJsonResponse([], 'cart_delete');
        }
        return $this->failJsonResponse([__('product.not_found')], '');
    }

}

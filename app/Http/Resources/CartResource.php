<?php

namespace App\Http\Resources;

use App\Models\UserSessionProduct;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function unserializeExra()
    {
        return unserialize($this->extra);
    }

    public function toArray($request)
    {
        $user_id = 3132978388;
        $cart = UserSessionProduct::where('user_id', $user_id)->get();
        return [
            'amount_total' => (int) UserSessionProduct::where('user_id', $user_id)->sum('amount'),
            'price_total' => (int) UserSessionProduct::where('user_id', $user_id)->sum('price'),
            'data' => CartDataResource::collection($cart),
//            'extra2' => $this->unserializeExra(),
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function unserializeExra()
    {
        return unserialize($this->extra);
    }

    public function toArray($request)
    {
        return [
            'user_id' => $this->user_id,
            'item_id' => $this->item_id,
            'product_id' => $this->product_id,
            'amount' => $this->amount,
            'price' => $this->price,
            'image' => $this->unserializeExra()['main_pair']['detailed']['http_image_path'],
            'title' => $this->unserializeExra()['product'],
        ];
    }
}

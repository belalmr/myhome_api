<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return object
     */

    // Not Used this Collection
    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            $images = $item->image_link->where('object_type', 'product')->where('type', 'M')->first()->images;
            $path = 'https://my-home.co/images/thumbnails/278/278/detailed/'
                . floor($images->image_id / 1000) . '/' . $images->image_path;

            return [
                'title' => '',
                'products' => [
                    'product_id' => $item->product_id,
                    'product_code' => $item->product_code,
                    'amount' => $item->amount,
                    'price' => round($item->list_price),
                    'title' => $item->p_description->where('lang_code', app()->getLocale())->first()->product,
                    'image' => $path,
                    'isFavorite' => isset($item->session_product()->first()->product_id) ? true : false,
                ]
            ];
        });
    }
}

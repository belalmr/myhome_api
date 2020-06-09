<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BannerCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param    $request
     * @return object
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            $path = 'https://my-home.co/images/promo/'
                . floor($item->image_id / 1000) . '/' . $item->image_path;
            return [
                'image_id'=> $item->image_id,
                'image' => $path,
//                'image_x'=> $item->image_x,
//                'image_y'=> $item->image_y,
            ];
        });
    }
}



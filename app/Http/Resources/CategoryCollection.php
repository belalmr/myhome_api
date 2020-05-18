<?php

namespace App\Http\Resources;

use App\Models\Image;
use App\Traits\ResponseTrait;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
{
    use ResponseTrait;
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return object
     */
    public function toArray($request)
    {
//        return app()->getLocale();
        return $this->collection->map(function ($item) {
            return [
                'category_id' => $item->category_id,
                'title' => $item->c_description->where('lang_code', app()->getLocale())->first()->category,
                'image' => 'https://my-home.co/design/themes/bigbazaar/media/mainicons/'.$item->category_id.'.png'
            ];
        });

        return parent::toArray($request);
    }
}

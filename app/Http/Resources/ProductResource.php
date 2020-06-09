<?php

namespace App\Http\Resources;

use App\Models\ProductFeatureValue;
use App\Models\ProductOption;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $image = $this->image_link()->where('object_type', 'product')->where('type', 'M')->first()->images;
        $path = 'https://my-home.co/images/thumbnails/278/278/detailed/'
            . floor($image->image_id / 1000) . '/' . $image->image_path;
        return [
            'product_id' => $this->product_id,
            'product_code' => $this->product_code,
            'title' => $this->p_description->where('lang_code', app()->getLocale())->first()->product,
            'price' => (double)$this->list_price,
            'discount_price' => (double)$this->p_price->first()->price,
            'image' => $path,
            'images' => $this->images,
            'full_description' => $this->p_description->where('lang_code', app()->getLocale())->first()->full_description,
            'features_value' => FeatureResource::collection(
                ProductFeatureValue::where('product_id', $this->product_id)->where('lang_code', app()->getLocale())->get()),
            'options_value' => OptionResource::collection(
//                ProductOption::where('product_id', $this->product_id)->where('lang_code', app()->getLocale())->get()),
                ProductOption::where('product_id', $this->product_id)->where('status', 'A')->get()),
        ];
    }
}

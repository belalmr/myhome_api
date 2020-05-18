<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Models\ProductFeatureValue;
use App\Models\ProductOption;
use Illuminate\Http\Resources\Json\JsonResource;
use PhpOption\Option;

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
        // TODO: Get all images in product

        $images = $this->image_link()->where('object_type', 'product')->where('type', 'M')->first()->images; // Image Main
//        $images = $this->image_link()->where('object_type', 'product')->where('type', 'A')->get();
        $path = 'https://my-home.co/images/thumbnails/278/278/detailed/'
            . floor($images->image_id / 1000) . '/' . $images->image_path;

        if ($this->image_link()->where('object_type', 'product')->where('type', 'A')->first() != null) {
            $images_product = $this->image_link()->where('object_type', 'product')->where('type', 'A')->first()->images;
            $path_images = 'https://my-home.co/images/thumbnails/278/278/detailed/'
                . floor($images_product->image_id / 1000) . '/' . $images_product->image_path;
        }

        Product::class;
        return [
            'product_id' => $this->product_id,
            'product_code' => $this->product_code,
            'title' => $this->p_description->where('lang_code', app()->getLocale())->first()->product,
            'price' => (double)$this->list_price,
            'discount_price' => (double)$this->p_price->first()->price,
            'image' => $path,
//            'images' => ImageResource::collection(),
            'images' => isset($path_images) ? $path_images : null,
            'full_description' => $this->p_description->where('lang_code', app()->getLocale())->first()->full_description,
            'features_value' => FeatureResource::collection(
                ProductFeatureValue::where('product_id', $this->product_id)->where('lang_code', app()->getLocale())->get()),

            'options_value' => OptionResource::collection(
//                ProductOption::where('product_id', $this->product_id)->where('lang_code', app()->getLocale())->get()),
                ProductOption::where('product_id', $this->product_id)->where('status', 'A')->get()),

            'ss' => ProductOption::where('product_id', $this->product_id)->get(),

            'options' => $this->p_options()->where('status', 'A')
                ->select('option_type', 'required', 'position')
                ->get(),

        ];

    }
}

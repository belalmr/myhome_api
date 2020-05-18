<?php

namespace App\Http\Resources;

use App\Models\ProductFeatureVariant;
use Illuminate\Http\Resources\Json\JsonResource;

class FeatureVariantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
//            'variant_id' => $this->variant_id,
//            'f_v_description' => $this->f_v_description()->where('lang_code', app()->getLocale())->first()->variant,
            'f_v_description' => $this->f_v_description()->first()->variant,
        ];
        return parent::toArray($request);
    }
}

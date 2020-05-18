<?php

namespace App\Http\Resources;

use App\Models\ProductFeature;
use App\Models\ProductFeatureVariant;
use Illuminate\Http\Resources\Json\JsonResource;

class FeatureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'feature_id' => $this->feature_id,
            'p_feature' => $this->p_feature->f_description->where('lang_code', app()->getLocale())->first()->description,
            'variant_id' => $this->variant_id,
            'p_f_variant' => isset($this->p_f_variant->f_v_description) ?
                $this->p_f_variant->f_v_description->where('lang_code', app()->getLocale())->first()->variant : null ,

//            'variant_description' => $this->f_feature_variants()->f_v_description(),
//            'f_description' => $this->f_description()->where('lang_code', app()->getLocale())->first()->description,
        ];
    }
}

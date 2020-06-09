<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OptionResource extends JsonResource
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
            'option_id' => $this->option_id,
            'option_description' => $this->o_description->where('lang_code', app()->getLocale())->first()->description,
            'product_id' => $this->product_id,
//            'variants' => $this->o_variant()->get(),
            'variants' => OptionVariantResource::collection($this->o_variant()->where('status', 'A')->get()),

//            'variant_description' => $this->o_description->where('lang_code', app()->getLocale())->first()->description,
            'option_type' => $this->option_type,
            'required' => $this->required,
//            'p_f_variant' => isset($this->p_f_variant->f_v_description) ?
//                $this->p_f_variant->f_v_description->where('lang_code', app()->getLocale())->first()->variant : null ,

//            'variant_description' => $this->f_feature_variants()->f_v_description(),
//            'f_description' => $this->f_description()->where('lang_code', app()->getLocale())->first()->description,
        ];
    }
}

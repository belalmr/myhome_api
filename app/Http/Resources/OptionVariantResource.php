<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OptionVariantResource extends JsonResource
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
            'variant_id' => $this->variant_id,
            'option_id' => $this->option_id,
            'option_variant_description' => $this->o_variant_description->where('lang_code', app()->getLocale())->first()->variant_name,
            'modifier' => (double) $this->modifier * 1.6,
            'position' => $this->position,
        ];
        return parent::toArray($request);
    }
}

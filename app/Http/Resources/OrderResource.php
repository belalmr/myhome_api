<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        dd($this->user);
        return [
            'order_id' => $this->order_id,
            // TODO: get status relation
            'status' => $this->status,
            'user_id' => $this->user_id,
//                'user' => $item->user()->whereHas('profile', function ($q) {
//                    $q->where('user_id', Auth::id());
//                }),
            'user' =>  isset($this->user->profile->b_firstname) ?
                $this->user->profile->b_firstname . ' ' . $this->user->profile->b_lastname : null,
            'timestamp' => Carbon::parse($this->timestamp)->format('Y/m/d'),
//                'total' => round($item->list_price),
        ];
    }
}

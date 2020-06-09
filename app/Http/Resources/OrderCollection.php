<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;

class OrderCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return object
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            return [
                'order_id' => $item->order_id,
                // TODO: get status relation
                'status' => $item->status,
                'user_id' => $item->user_id,
//                'user' => $item->user()->whereHas('profile', function ($q) {
//                    $q->where('user_id', Auth::id());
//                }),
                'user' =>  isset($item->user->profile->b_firstname) ?
                    $item->user->profile->b_firstname . ' ' . $item->user->profile->b_lastname : null,
                'timestamp' => Carbon::parse($item->timestamp)->format('Y/m/d'),
                'total' => round($item->list_price),
            ];
        });
    }
}

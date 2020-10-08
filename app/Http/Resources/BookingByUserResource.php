<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingByUserResource extends JsonResource
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
            'id' => $this->id,
            'from'=> $this->from,
            'to'=> $this->to,
            'created_at'=> $this->created_at,
            'bookable_id'=> $this->bookable_id,
            'review_key' => $this->review_key,
            'price'=> $this->price,
            'bookable'=> new  BookingByUserBookableShowResource($this->bookable),
        ];
    }
}

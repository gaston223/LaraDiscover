<?php

namespace App\Http\Resources;

use App\Bookable;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingByUserBookableShowResource extends JsonResource
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
            'title' => $this->title,
            'image' => $this->image,
            'description' => $this->description,
            'average_rating' =>  $this->average_rating,
            'sum_review' =>  $this->sum_review,
            'created_at' => $this->created_at,
            'updated_at'=> $this->update_at
        ];
    }
}

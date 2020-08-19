<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            "id" => $this->getRouteKey(),
            "title" => $this->title,
            "start_at" => $this->start_at,
            "end_at" => $this->end_at,
            "all_day" => $this->all_day,
            "time_zone" => $this->timezone,
            "calendar" => $this->calendar->getRouteKey(),
            "category" => $this->category->title,
            "location" => new AddressResource($this->address)
        ];
    }
}

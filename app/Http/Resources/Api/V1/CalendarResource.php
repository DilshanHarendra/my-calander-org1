<?php

namespace App\Http\Resources\Api\V1;

use App\Enums\WeekDays;
use Illuminate\Http\Resources\Json\JsonResource;

class CalendarResource extends JsonResource
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
            "description" => $this->description,
            "first_day" => WeekDays::getKey($this->first_day),
            "time_zone" => $this->time_zone,
            "events"=> EventResource::collection($this->events)
        ];
    }
}

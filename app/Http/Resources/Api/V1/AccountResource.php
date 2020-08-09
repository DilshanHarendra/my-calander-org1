<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);

        return [
            "id" =>  $this->id,
            "name" => $this->name,
            "type" =>  $this->account_type,
            "role" =>  $this->pivot->role
        ];
    }
}

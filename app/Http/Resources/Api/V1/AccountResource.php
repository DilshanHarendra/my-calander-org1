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
            "id" =>  $this->getRouteKey(),
            "name" => $this->name,
            "type" =>  $this->account_type === 0 ? 'personal' : 'business',
            "role" =>  $this->pivot->role === 0 ? 'owner' : 'user',
        ];
    }
}

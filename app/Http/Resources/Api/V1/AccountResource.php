<?php

namespace App\Http\Resources\Api\V1;

use App\Enums\AccountRoleType;
use App\Enums\AccountType;
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
            "category" =>  AccountType::fromValue($this->account_type),
            "role" =>  AccountRoleType::fromValue($this->pivot->role),
        ];
    }
}

<?php


function current_tenant()
{
    $parts = explode('/', $_SERVER['REQUEST_URI']);
    $account =  \App\Models\Tenant\Account::decodeRouteKey($parts[3]);
    return new \App\Http\Resources\Api\V1\AccountResource($account);
}



function current_user()
{
    $user = auth('api')->user();
    return new \App\Http\Resources\Api\V1\UserResource($user);
}

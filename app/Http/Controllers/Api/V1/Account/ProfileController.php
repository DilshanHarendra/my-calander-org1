<?php

namespace App\Http\Controllers\Api\V1\Account;

use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\UserResource;
use Illuminate\Http\Request;

class ProfileController extends ApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function selfProfile(Request $request)
    {
        return new UserResource(current_user());
    }
}

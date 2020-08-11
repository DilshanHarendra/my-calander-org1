<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\LoginRequest;

class TestController extends ApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(LoginRequest $request, $account)
    {

//        return current_user(); // gets user object

        return current_tenant(); // gets account object
    }
}

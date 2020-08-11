<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\UserResource;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwt_auth');
    }

    public function selfProfile(Request $request)
    {
        return new UserResource($request->auth);
    }
}

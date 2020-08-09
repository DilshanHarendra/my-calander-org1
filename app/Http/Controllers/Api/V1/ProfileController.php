<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function selfProfile(Request $request)
    {
        return $request->user();
    }
}

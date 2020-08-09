<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwt_auth');
    }

    public function index(Request $request, $account)
    {
        return $account;

    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends ApiController
{

    /**
     * @param Request $request
     */
    public function register(Request $request)
    {

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'business_name' => ['required', 'string', 'max:255'],
            'account_category' => [],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);



    }
}

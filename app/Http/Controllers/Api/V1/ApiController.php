<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * @param Request $request
     */
    protected function current_tenant(Request $request)
    {

    }






    /**
     * Create a new token.
     *
     * @param  $user
     * @return string
     */
    protected function jwtToken(object $user): string
    {
        $payload = [
            'iss' => "o2o-calendar", // Issuer of the token
            'sub' => $user->id, // Subject of the token
            'email' => $user->email,
            'iat' => time(), // Time when JWT was issued.
            'exp' => time() + 60*60 // Expiration time
        ];

        // As you can see we are passing `JWT_SECRET` as the second parameter that will
        // be used to decode the token in the future.
        return JWT::encode($payload, config('o2o.jwt_token'));
    }



}

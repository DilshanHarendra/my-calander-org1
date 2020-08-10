<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\ErrorCodeType;
use App\Http\Requests\Api\V1\LoginRequest;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiController
{
    protected $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param LoginRequest $request
     * @return string
     */
    public function login(LoginRequest $request)
    {
        $user = $this->repository->getDataByKeyAndValue('email', $request->input('email'));

        if (!$user) {
            // You wil probably have some sort of helpers or whatever
            // to make sure that you have the same response format for
            // different kind of responses. But let's return the
            // below response for now.
            return response()->json([
                'error' => ErrorCodeType::fromValue(1010)
            ], 400);
        }


        // Verify the password and generate the token
        if (Hash::check($request->input('password'), $user->password)) {
            return response()->json([
                'token' => $this->jwtToken($user)
            ], 200);
        }

        // Bad Request response
        return response()->json([
            'error' => ErrorCodeType::fromValue(1010)
        ], 400);

    }




}

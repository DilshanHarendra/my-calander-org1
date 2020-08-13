<?php

namespace App\Http\Controllers\Api\V1\Account;

use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Requests\Api\V1\RegisterRequest;
use App\Http\Resources\Api\V1\UserResource;
use App\Repositories\User\UserRepositoryInterface;

class RegisterController extends ApiController
{
    private $repository;

    /**
     * RegisterController constructor.
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->middleware('auth:api', ['except' => ['register']]);
        $this->repository = $repository;
    }

    /**
     * @param RegisterRequest $request
     * @return UserResource
     */
    public function register(RegisterRequest $request)
    {
        $user = $this->repository->createData($request->validated());
        return new UserResource($user);
    }
}

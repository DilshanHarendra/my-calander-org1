<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\V1\UserResource;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class RegisterController extends ApiController
{
    private $repository;

    /**
     * RegisterController constructor.
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     */
    public function register(Request $request)
    {

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'business_name' => ['required_if:user_category,1', 'string', 'max:255'],
            'user_category' => ['required', 'in:0,1'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = $this->repository->createData($request->only('name', 'email', 'business_name', 'user_category', 'password'));

        return new UserResource($user);

    }
}

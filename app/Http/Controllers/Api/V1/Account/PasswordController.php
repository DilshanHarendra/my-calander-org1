<?php

namespace App\Http\Controllers\Api\V1\Account;

use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ResetEmailRequest;
use App\Http\Requests\Api\V1\ResetPasswordRequest;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class PasswordController extends ApiController
{
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->middleware('auth:api');
        $this->repository = $repository;
    }

    /**
     * @param ResetEmailRequest $request
     */
    public function resetEmail(ResetEmailRequest $request)
    {
        return $this->repository->resetEmail($request->validated());
    }


    /**
     * @param ResetPasswordRequest $request
     */
    public function resetPassword(ResetPasswordRequest $request)
    {

    }
}

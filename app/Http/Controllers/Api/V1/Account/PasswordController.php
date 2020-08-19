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

        $tokenData = $this->repository->resetEmail($request->validated());

        if ($this->sendResetEmail($request->get('email'), $tokenData->token)) {
            return response()->json(['status' => trans('A reset link has been sent to your email address.')]);
        }

        return response()->json(['error' => trans('A Network Error occurred. Please try again.')]);
    }


    /**
     * @param ResetPasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        $tokenData = $this->repository->getResetToken($request->validated());

        $user = $this->repository->resetPassword($tokenData, $request->validated());

        if ($this->sendSuccessEmail($user->email)) {
            return response()->json(['error' => trans('Password reset successful.')]);

        }
        return response()->json(['email' => trans('A Network Error occurred. Please try again.')]);
    }
}

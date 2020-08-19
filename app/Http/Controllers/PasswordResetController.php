<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\V1\ResetPasswordRequest;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
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


    private function sendSuccessEmail($email)
    {
        //send email
    }
}

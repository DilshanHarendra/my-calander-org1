<?php

namespace App\Http\Controllers\Api\V1\Tenant;

use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Controllers\Controller;
use App\Repositories\Account\AccountRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class UsersController extends ApiController
{
    private $repository;

    public function __construct(AccountRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index($account)
    {
        return $this->repository->getAccountUsers(current_tenant()->id);
    }

    public function show($account, $id)
    {

    }

    public function update(Request $request, $account)
    {
        return $this->repository->getAccountUsers(current_tenant()->id);

    }

    public function destory($account, $id)
    {

    }
}

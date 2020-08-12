<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Account\AccountRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class AccountsController extends AdminController
{
    private $repository;

    public function __construct(AccountRepositoryInterface  $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        return $this->repository->getPaginatedData($request->get('per_page'));
    }

    public function store(Request $request)
    {
        return $this->repository->getPaginatedData($request->all());

    }

    public function show($id)
    {
        return $this->repository->getDataById($id);
    }

    public function update(Request $request, $id)
    {

        return $this->repository->updateData($id, $request->all());
    }

    public function destroy($id)
    {
        return $this->repository->deleteData($id);
    }
}

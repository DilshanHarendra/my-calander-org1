<?php

namespace App\Repositories\Account;

use App\Account;


class AccountRepository implements AccountRepositoryInterface
{
    public function get($id){
        return Account::findorfail($id);
    }

    public function create(array $requestData){
        return Account::create($requestData);
    }

    public function update(array $requestData, $id)
    {
        $entity = $this->get($id);
        $entity->update($requestData);
        return $entity;
    }

    public function delete($id)
    {
        $entity = $this->get($id);
        return $entity->delete();
    }

}
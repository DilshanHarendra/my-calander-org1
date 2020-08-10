<?php

namespace App\Repositories\Account;




use App\Models\Tenant\Account;

class AccountRepository implements AccountRepositoryInterface
{
//    public function get($id){
//        return Account::findorfail($id);
//    }
//
//    public function create(array $requestData){
//        return Account::create($requestData);
//    }
//
//    public function update(array $requestData, $id)
//    {
//        $entity = $this->get($id);
//        $entity->update($requestData);
//        return $entity;
//    }
//
//    public function delete($id)
//    {
//        $entity = $this->get($id);
//        return $entity->delete();
//    }

    public function getAllData(array $request)
    {
        // TODO: Implement getAllData() method.
    }

    public function getPaginatedData(array $request)
    {
        // TODO: Implement getPaginatedData() method.
    }

    public function getDataById(int $id)
    {
        // TODO: Implement getDataById() method.
    }

    public function getDataByKeyAndValue($key, $value)
    {
        // TODO: Implement getDataByKeyAndValue() method.
    }

    public function createData(array $request)
    {
        $account = new Account();

        if ($request['user_category'] === 0) {
            $account->name = $request['name']; // gets user name from request
            $account->account_type = 0; // PersonalAccount
        } else {
            $account->name = $request['business_name'];
            $account->account_type = 1; // BusinessAccount
        }

        $account->save();

        return $account;
    }

    public function updateData(int $id, array $request)
    {
        // TODO: Implement updateData() method.
    }

    public function deleteData(int $id)
    {
        // TODO: Implement deleteData() method.
    }
}

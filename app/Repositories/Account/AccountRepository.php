<?php

namespace App\Repositories\Account;




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
        // TODO: Implement createData() method.
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

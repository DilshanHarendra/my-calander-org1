<?php


namespace App\Repositories\Account;


interface AccountRepositoryInterface
{
    public function getAllData(array $request);

    public function getPaginatedData(array $request);

    public function getDataById($hashKey);

    public function getDataByKeyAndValue($key, $value);

    public function createData(array $request);

    public function updateData(int $id, array $request);

    public function deleteData(int $id);


    public function getAccountUsers($accountId);

    public function createAccountUser($accountId, $request);

    public function updateAccountUser($accountId, $userId, $request);

    public function removeAccountUser($accountId, $userId);




}

<?php


namespace App\Repositories\Account;


interface AccountRepositoryInterface
{
    public function getAllData(array $request);

    public function getPaginatedData(array $request);

    public function getDataById(int $id);

    public function getDataByKeyAndValue($key, $value);

    public function createData(array $request);

    public function updateData(int $id, array $request);

    public function deleteData(int $id);

}

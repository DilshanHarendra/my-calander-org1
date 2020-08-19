<?php


namespace App\Repositories\User;


interface UserRepositoryInterface
{

    public function getAllData(array $request);

    public function getPaginatedData(array $request);

    public function getDataById(int $id);

    public function getDataByKeyAndValue($key, $value);

    public function createData(array $request);

    public function updateData(int $id, array $request);

    public function deleteData(int $id);

    public function resetEmail(array $request);

    public function resetPassword(object $token, array $request);

    public function getResetToken(array $request);

    public function removeResetToken(object $user);



}

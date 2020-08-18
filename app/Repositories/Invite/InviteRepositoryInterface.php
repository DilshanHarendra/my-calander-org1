<?php


namespace App\Repositories\Invite;


interface InviteRepositoryInterface
{
    public function getPaginatedData($accountId, array $request);

    public function getDataById($accountId, int $id);

    public function getDataByKeyAndValue($key, $value);

    public function createData($accountId, array $request);

    public function updateData($accountId, int $id, array $request);

    public function deleteData(int $id);
}

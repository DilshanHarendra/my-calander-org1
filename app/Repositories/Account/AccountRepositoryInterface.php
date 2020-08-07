<?php


namespace App\Repositories\Account;


interface AccountRepositoryInterface
{
    public function get($id);

    public function create(array $requestData);

    public function update(array $requestData, $id);

    public function delete($id);

}
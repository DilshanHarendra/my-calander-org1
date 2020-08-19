<?php

namespace App\Repositories\Account;

use App\Enums\AccountType;
use App\Models\Tenant\Account;


class AccountEloquentRepository implements AccountRepositoryInterface
{
    private $entity;

    public function __construct(Account $entity)
    {
        $this->entity = $entity;
    }


    public function getAllData(array $request)
    {
        return Account::get();
    }

    public function getPaginatedData(array $request)
    {
        $limit  = isset($request['per_page']) ? $request['per_page'] : 10;
        return Account::paginate($limit);
    }

    public function getDataById($hashKey)
    {
        return $this->entity->findOrFial($hashKey);

    }



    public function getDataByKeyAndValue($key, $value)
    {
        return $this->entity->where($key, $value)->first();
    }

    /**
     * @param array $request
     * @return Account
     */
    public function createData(array $request)
    {
        $account = new Account();

        if ($request['user_category'] === 0) {
            $account->name = $request['name']; // gets user name from request
            $account->account_type = AccountType::PersonalAccount; // PersonalAccount
        } else {
            $account->name = $request['business_name'];
            $account->account_type = AccountType::BusinessAccount; // BusinessAccount
        }

        $account->save();

        return $account;
    }

    public function updateData(int $id, array $request)
    {
        $entity = $this->getDataById($id);
        $entity->update($request);
        return $entity;
    }

    public function deleteData(int $id)
    {
        $entity = $this->getDataById($id);
        return $entity->delete();
    }


    public function getAccountUsers($accountId)
    {
        return $this->getDataById($accountId)->users;
    }


    public function createAccountUser($accountId, $request)
    {
        // TODO: Implement createAccountUser() method.
    }

    public function updateAccountUser($accountId, $userId, $request)
    {
        // TODO: Implement updateAccountUser() method.
    }

    public function removeAccountUser($accountId, $userId)
    {
        // TODO: Implement removeAccountUser() method.
    }
}

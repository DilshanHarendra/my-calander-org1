<?php

namespace App\Repositories\Account;




use App\Enums\AccountType;
use App\Models\Tenant\Account;

class AccountRepository implements AccountRepositoryInterface
{
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


    /**
     * @param array $request
     * @return Account
     */
    public function createData(array $request)
    {
        $account = new Account();

        if ($request['user_category'] === 0) {
            $account->name = $request['name']; // gets user name from request
            $account->account_type = AccountType::getKey(0); // PersonalAccount
        } else {
            $account->name = $request['business_name'];
            $account->account_type = AccountType::getKey(1); // BusinessAccount
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

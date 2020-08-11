<?php

namespace App\Repositories\Account;

use App\Enums\AccountType;
use App\Models\Tenant\Account;


class AccountRepository implements AccountRepositoryInterface
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

        return Account::findOrFail($id);
        return $this->entity->getRouteKey($hashKey);

    }

    public function getDataByKeyAndValue($key, $value)
    {
        return Account::where($key, $value)->first();
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
}

<?php


namespace App\Repositories\User;

use App\Models\Tenant\User;
use App\Repositories\Account\AccountRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserEloquentRepository implements UserRepositoryInterface
{
    private $accountRepository;

    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

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
        return User::findOrFail($id);
    }

    public function getDataByKeyAndValue($key, $value)
    {
        return User::where($key, $value)->first();
    }

    public function createData(array $request)
    {
        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->save();
        $account = $this->accountRepository->createData($request);
        $user->accounts()->attach($account);
        return $user;
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

    public function resetEmail(array $request)
    {
        // implement email notification
    }
}

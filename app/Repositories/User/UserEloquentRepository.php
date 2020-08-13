<?php


namespace App\Repositories\User;

use App\Models\Tenant\User;
use App\Repositories\Account\AccountRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserEloquentRepository implements UserRepositoryInterface
{
    private $entity;

    private $accountRepository;

    public function __construct(User $entity, AccountRepositoryInterface $accountRepository)
    {
        $this->entity = $entity;
        $this->accountRepository = $accountRepository;
    }

    public function getAllData(array $request)
    {
        // TODO: Implement getAllData() method.
    }

    public function getPaginatedData(array $request)
    {
        $limit  = isset($request['per_page']) ? $request['per_page'] : 10;
        return $this->entity->paginage($limit);

    }

    public function getDataById(int $id)
    {
        return $this->entity->findOrFail($id);
    }

    public function getDataByKeyAndValue($key, $value)
    {
        return $this->entity->where($key, $value)->first();
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
        $user = $this->getDataById($id);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->save();
        return $user;
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

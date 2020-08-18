<?php


namespace App\Repositories\Invite;


use App\Models\Tenant\Invite;
use App\Repositories\Account\AccountRepositoryInterface;

class InviteEloquentRepository implements InviteRepositoryInterface
{

    private $entity;

    private $accountRepository;

    public function __construct(Invite $entity, AccountRepositoryInterface $accountRepository)
    {
        $this->entity = $entity;
        $this->accountRepository = $accountRepository;
    }

    public function getPaginatedData($accountId, array $request)
    {
        $account = $this->accountRepository->getDataById($accountId);
        return $account->invites;
    }

    public function getDataById($accountId, int $id)
    {
        $account = $this->accountRepository->getDataById($accountId);
        return $account->invites->find($id);
    }

    public function createData($accountId, array $request)
    {
        $account = $this->accountRepository->getDataById($accountId);
        return $account->invites()->create($request);
    }

    public function updateData($accountId, int $id, array $request)
    {
        $account = $this->accountRepository->getDataById($accountId);
        $invite =  $account->invites()->find($id);
//
//        $invite->email = $request['email'];
//        $invite->email = $request['email'];
//        $invite->save();
//        return $invite;


        do {
            //generate a random string using Laravel's str_random helper
            $token = str_random();
        } //check if the token already exists and if it does, try again
        while ($this->entity->where('token', $token)->first());

        //create a new invite record
        $invite = Invite::create([
            'email' => $request->get('email'),
            'token' => $token
        ]);


    }

    public function deleteData(int $id)
    {
        // TODO: Implement deleteData() method.
    }

    public function getDataByKeyAndValue($key, $value)
    {
        return $this->entity->where($key, $value)->first();
    }
}

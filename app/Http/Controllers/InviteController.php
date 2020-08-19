<?php

namespace App\Http\Controllers;

use App\Repositories\Invite\InviteRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class InviteController extends Controller
{

    public $inviteRepository;

    public $userRepository;

    public function __construct(InviteRepositoryInterface $inviteRepository, UserRepositoryInterface $userRepository)
    {
        $this->inviteRepository = $inviteRepository;
        $this->userRepository = $userRepository;
    }

    public function accept($token)
    {

        // Look up the invite
        if (!$invite = $this->inviteRepository->getDataByKeyAndValue('token', $token)) {
            //if the invite doesn't exist do something more graceful than this
            abort(404);
        }

        // create the user with the details from the invite
        $this->userRepository->createData(['email' => $invite->email]);

        // delete the invite so it can't be used again
        $this->inviteRepository->deleteData($invite->id);

        // here you would probably log the user in and show them the dashboard, but we'll just prove it worked

        return 'Good job! Invite accepted!';
    }
}

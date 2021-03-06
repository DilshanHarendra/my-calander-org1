<?php


namespace App\Http\Controllers\Api\V1\Event;

use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Requests\Api\V1\Event\InviteToEventRequest;
use App\Http\Resources\Api\V1\InvitationResource;
use App\Http\Resources\Api\V1\RegistrationResource;

use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Event\InvitationRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class InvitationController extends ApiController
{
    private $invitationRepository;
    private $eventRepository;

    public function __construct(InvitationRepositoryInterface $invitationRepository, EventRepositoryInterface $eventRepository)
    {
        $this->invitationRepository = $invitationRepository;
        $this->eventRepository = $eventRepository;
    }

    public function index($account)
    {
        $invitations = $this->invitationRepository->getAllData();
        return InvitationResource::collection($invitations);
    }

    public function event_invites($account,$event)
    {
        try {

            $invitations = $this->invitationRepository->getDataByEvent($event);
            return InvitationResource::collection($invitations);

        }
        catch(ModelNotFoundException $e)
        {
            return response()->json(['message'=> 'Resource not found'], 404);
        }
        catch(Exception $e)
        {
            return response()->json(['message'=> $e->getMessage()], 500);
        }
    }

    public function invite(InviteToEventRequest $request,$account,$event)
    {
        try {

            $this->invitationRepository->createData($request->validated(),$event);

            return response()->json(['message'=> 'SUCCESS'], 201);
        }
        catch(Exception $e)
        {
            return response()->json(['message'=> $e->getMessage()], 500);
        }
    }

}

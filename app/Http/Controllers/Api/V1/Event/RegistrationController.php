<?php


namespace App\Http\Controllers\Api\V1\Event;

use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Requests\Api\V1\Event\RegisterToEventRequest;
use App\Http\Resources\Api\V1\InvitationResource;
use App\Http\Resources\Api\V1\RegistrationResource;
use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Event\RegistrationRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RegistrationController extends ApiController
{
    private $registrationRepository;
    private $eventRepository;

    public function __construct(RegistrationRepositoryInterface $registrationRepository, EventRepositoryInterface $eventRepository)
    {
        $this->registrationRepository = $registrationRepository;
        $this->eventRepository = $eventRepository;
    }

    public function index($account)
    {
        $registrations = $this->registrationRepository->getAllData();
        return RegistrationResource::collection($registrations);
    }

    public function event_registrations($account,$event)
    {
        try {

            $invitations = $this->registrationRepository->getDataByEvent($event);
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

    public function register(RegisterToEventRequest $request,$account,$event)
    {
        try {

            $this->registrationRepository->createData($request->validated(),$event);

            return response()->json(['message'=> 'SUCCESS'], 201);
        }
        catch(Exception $e)
        {
            return response()->json(['message'=> $e->getMessage()], 500);
        }
    }

}

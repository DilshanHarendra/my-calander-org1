<?php


namespace App\Http\Controllers\Api\V1\Event;

use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Requests\Api\V1\Event\CreateEventRequest;
use App\Http\Requests\Api\V1\Event\UpdateEventRequest;
use App\Http\Resources\Api\V1\EventResource;
use App\Models\Event\Event;
use App\Models\Tenant\Account;
use App\Repositories\Address\AddressRepositoryInterface;
use App\Repositories\Event\EventRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psy\Util\Json;

class EventController extends ApiController
{
    private $eventRepository;
    private $addressRepository;

    public function __construct(EventRepositoryInterface $eventRepository, AddressRepositoryInterface $addressRepository)
    {
        $this->middleware('auth:api');
        $this->eventRepository = $eventRepository;
        $this->addressRepository = $addressRepository;
    }

    /**
     * Show all events for a user
     */
    public function index()
    {
        return EventResource::collection($this->eventRepository->getDataByEmail(current_user()->email));
    }

    /**
     * Show an event
     * @param Account $account
     * @param Event $event
     * @return EventResource
     */
    public function show($account,$event)
    {
        try{

            return new EventResource($event);
        }
        catch(ModelNotFoundException $e)
        {
            return response()->json(['message'=> 'Event not found'], 404);
        }
        catch(Exception $e)
        {
            return response()->json(['message'=> $e->getMessage()], 500);
        }
    }

    /**
     * Create a new event
     * @param CreateEventRequest $request
     * @return EventResource
     */
    public function store(CreateEventRequest $request)
    {
        $event = $this->eventRepository->createData($request->validated());

        if($request->has('place_id'))
        {
            $this->addressRepository->createDataWithPlaceId($request->place_id, $event);
        }

        return new EventResource($event);
    }

    /**
     * Update event
     * Category cannot be changed
     *
     * @return EventResource
     */
    public function update(UpdateEventRequest $request,$account,$event)
    {
        try {
            $event = $this->eventRepository->updateData($request->validated(),$event->id);
            return new EventResource($event);
        }
        catch(ModelNotFoundException $e)
        {
            return response()->json(['message'=> 'Event not found'], 404);
        }
        catch(Exception $e)
        {
            return response()->json(['message'=> $e->getMessage()], 500);
        }
    }

    /**
     * Delete an event
     * @param Account $account
     * @param Event $event
     * @return JsonResponse
     */
    public function delete($account,$event)
    {
        try{

            $this->eventRepository->deleteData($event->id);
            return response()->json(['message'=> 'SUCCESS'],204);
        }
        catch(ModelNotFoundException $e)
        {
            return response()->json(['message'=> 'Event not found'], 404);
        }
        catch(Exception $e)
        {
            return response()->json(['message'=> $e->getMessage()], 500);
        }

    }

}

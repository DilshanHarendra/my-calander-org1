<?php


namespace App\Http\Controllers\Api\V1\Event;

use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Requests\Api\V1\Event\CreateEventRequest;
use App\Http\Requests\Api\V1\Event\UpdateEventRequest;
use App\Http\Resources\Api\V1\EventResource;
use App\Repositories\Event\EventRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EventController extends ApiController
{
    private $repository;

    public function __construct(EventRepositoryInterface $repository)
    {
        $this->middleware('auth:api');
        $this->repository = $repository;
    }

    public function index()
    {
        return EventResource::collection($this->repository->getAllData()); //TODO : make it by owner email
    }

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
     *
     * @return EventResource
     */
    public function store(CreateEventRequest $request)
    {
        $event = $this->repository->createData($request->validated());
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
            $event = $this->repository->updateData($request->validated(),$event->id);
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

    public function delete($account,$event)
    {
        try{

            $this->repository->deleteData($event->id);
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

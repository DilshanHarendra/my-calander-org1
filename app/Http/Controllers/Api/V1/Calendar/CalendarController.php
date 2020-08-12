<?php


namespace App\Http\Controllers\Api\V1\Calendar;

use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Requests\Api\V1\Calendar\CreateCalendarRequest;
use App\Http\Requests\Api\V1\Calendar\UpdateCalendarRequest;
use App\Http\Resources\Api\V1\CalendarResource;
use App\Repositories\Calendar\CalendarRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CalendarController extends ApiController
{
    private $repository;

    public function __construct(CalendarRepositoryInterface $repository)
    {
        $this->middleware('auth:api');
        $this->repository = $repository;
    }

    public function index()
    {
        return CalendarResource::collection($this->repository->getAllData()); //TODO : make it by owner email
    }

    public function show($account,$id)
    {
        try{

            $calendar = $this->repository->getDataById($id);
            return new CalendarResource($calendar);
        }
        catch(ModelNotFoundException $e)
        {
            return response()->json(['message'=> 'Calendar not found'], 404);
        }
        catch(Exception $e)
        {
            return response()->json(['message'=> $e->getMessage()], 500);
        }
    }

    public function store(CreateCalendarRequest $request)
    {
        $calendar = $this->repository->createData($request->validated());
        return new CalendarResource($calendar);
    }

    public function update(UpdateCalendarRequest $request,$account,$id)
    {
        try {
            $calendar = $this->repository->updateData($request->validated(), $id);
            return new CalendarResource($calendar);
        }
        catch(ModelNotFoundException $e)
        {
            return response()->json(['message'=> 'Calendar not found'], 404);
        }
        catch(Exception $e)
        {
            return response()->json(['message'=> $e->getMessage()], 500);
        }
    }

    public function delete($account,$id)
    {
        try{

            $this->repository->deleteData($id);
            return response()->json(['message'=> 'SUCCESS'],200);
        }
        catch(ModelNotFoundException $e)
        {
            return response()->json(['message'=> 'Calendar not found'], 404);
        }
        catch(Exception $e)
        {
            return response()->json(['message'=> $e->getMessage()], 500);
        }

    }

}

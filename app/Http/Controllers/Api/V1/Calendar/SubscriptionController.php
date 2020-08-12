<?php


namespace App\Http\Controllers\Api\V1\Calendar;

use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Requests\Api\V1\Calendar\CreateSubscriptionRequest;
use App\Http\Requests\Api\V1\Calendar\DeleteSubscriptionRequest;
use App\Http\Resources\Api\V1\SubscriptionResource;
use App\Repositories\Calendar\SubscriberRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SubscriptionController extends ApiController
{
    private $repository;

    public function __construct(SubscriberRepositoryInterface $repository)
    {
        $this->middleware('auth:api');
        $this->repository = $repository;
    }

    public function calender_subscribers($account,$calendar)
    {
        try {

            $subscriptions = $this->repository->getDataByCalendar($calendar);
            return SubscriptionResource::collection($subscriptions);

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

    public function subscribe(CreateSubscriptionRequest $request, $account , $calendar)
    {
        try {

            $this->repository->createData($request->validated(),$calendar);

            return response()->json(['message'=> 'SUCCESS'], 201);
        }
        catch(Exception $e)
        {
            return response()->json(['message'=> $e->getMessage()], 500);
        }
    }

    public function delete(DeleteSubscriptionRequest $request,$account,$calendar)
    {
        try{

            $this->repository->deleteData($request->validated(),$calendar);
            return response()->json(['message'=> 'SUCCESS'],200);
        }
        catch(ModelNotFoundException $e)
        {
            return response()->json(['message'=> 'Subscription not found'], 404);
        }
        catch(Exception $e)
        {
            return response()->json(['message'=> $e->getMessage()], 500);
        }

    }

}

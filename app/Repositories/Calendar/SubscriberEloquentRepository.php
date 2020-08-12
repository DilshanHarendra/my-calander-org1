<?php

namespace App\Repositories\Calendar;

use App\Jobs\SendEmailJob;
use App\Mail\InviteUserToEvent;
use App\Models\Calendar\Subscriber;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class SubscriberEloquentRepository implements SubscriberRepositoryInterface
{
    public function getAllData()
    {
        return Subscriber::get();
    }

    public function getPaginatedData(array $requestData)
    {
        $limit  = isset($requestData['per_page']) ? $requestData['per_page'] : 10;
        return Subscriber::paginate($limit);
    }

    public function getDataById($id)
    {
        return Subscriber::findorfail($id);
    }

    public function getDataByCalendar($calendar)
    {
        return Subscriber::where('calendar_id',$calendar->id)->get();
    }

    public function createData(array $requestData, $calendar)
    {
        if($calendar->subscribers()->where('email',$requestData['email'])->count() == 0)
        {
            $calendar->subscribers()->create($requestData);
        }
        else
        {
            throw new \Exception('User already subscribed to calendar');
        }
    }

    public function deleteData(array $requestData, $calendar)
    {
        if($calendar->subscribers()->where('email',$requestData['email'])->count() == 1)
        {
            $subscription = $calendar->subscribers()->where('email',$requestData['email']);
            return $subscription->delete();
        }
        else
        {
            throw new ModelNotFoundException();
        }

    }


}
<?php

namespace App\Repositories\Event;

use App\Jobs\SendEmailJob;
use App\Mail\InviteUserToEvent;
use App\Mail\UserRegisteredForEvent;
use App\Models\Event\Registration;

class RegistrationEloquentRepository implements RegistrationRepositoryInterface
{
    public function getAllData()
    {
        return Registration::get();
    }

    public function getPaginatedData(array $requestData)
    {
        $limit  = isset($requestData['per_page']) ? $requestData['per_page'] : 10;
        return Registration::paginate($limit);
    }

    public function getDataById($id)
    {
        return Registration::findorfail($id);
    }

    public function getDataByEvent($event)
    {
        return Registration::where('event_id',$event->id)->get();
    }

    public function createData(array $requestData,$event)
    {
        if($event->registrations()->where('email',$requestData['email'])->count() == 0)
        {
            if($event->registrations()->create($requestData))
            {
                SendEmailJob::dispatch($requestData['email'],new UserRegisteredForEvent($event));
            }
        }
        else
        {
            throw new \Exception('User already registered to event');
        }
    }

}
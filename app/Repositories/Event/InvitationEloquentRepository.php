<?php

namespace App\Repositories\Event;


use App\Jobs\SendEmailJob;
use App\Mail\InviteUserToEvent;
use App\Models\Event\Invitation;

class InvitationEloquentRepository implements InvitationRepositoryInterface
{
    public function getAllData()
    {
        return Invitation::get();
    }

    public function getPaginatedData(array $requestData)
    {
        $limit  = isset($requestData['per_page']) ? $requestData['per_page'] : 10;
        return Invitation::paginate($limit);
    }

    public function getDataById($id)
    {
        return Invitation::findorfail($id);
    }

    public function getDataByEvent($event)
    {
        return Invitation::where('event_id',$event->id)->get();
    }

    public function createData(array $requestData,$event)
    {
        if($event->invitations()->where('email',$requestData['email'])->count() == 0)
        {
             if($event->invitations()->create($requestData))
             {
                 SendEmailJob::dispatch($requestData['email'],new InviteUserToEvent($event));
             }
        }
        else
        {
            throw new \Exception('User already invited to event');
        }
    }

    public function deleteData($id)
    {
        $entity = $this->getDataById($id);
        return $entity->delete();
    }

}
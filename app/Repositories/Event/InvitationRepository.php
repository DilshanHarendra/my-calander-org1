<?php

namespace App\Repositories\Event;

use App\Models\Event\Invitation;

class InvitationRepository implements InvitationRepositoryInterface
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

    public function createData(array $requestData)
    {
        return Invitation::create($requestData);
    }

    public function updateData(array $requestData, $id)
    {
        $entity = $this->getDataById($id);
        $entity->update($requestData);
        return $entity;
    }

    public function deleteData($id)
    {
        $entity = $this->getDataById($id);
        return $entity->delete();
    }

}
<?php

namespace App\Repositories\Event;

use App\Event\Invitation;

class InvitationRepository implements InvitationRepositoryInterface
{
    public function getAll()
    {
        return Invitation::get();
    }

    public function getPaginated(array $requestData)
    {
        $limit  = isset($requestData['per_page']) ? $requestData['per_page'] : 10;
        return Invitation::paginate($limit);
    }

    public function get($id)
    {
        return Invitation::findorfail($id);
    }

    public function getByEvent($event)
    {
        return Invitation::where('event_id',$event->id)->get();
    }

    public function create(array $requestData)
    {
        return Invitation::create($requestData);
    }

    public function update(array $requestData, $id)
    {
        $entity = $this->get($id);
        $entity->update($requestData);
        return $entity;
    }

    public function delete($id)
    {
        $entity = $this->get($id);
        return $entity->delete();
    }

}
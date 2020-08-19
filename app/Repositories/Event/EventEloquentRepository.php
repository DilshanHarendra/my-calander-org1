<?php

namespace App\Repositories\Event;

use App\Enums\CalendarType;
use App\Models\Calendar\Calendar;
use App\Models\Category;
use App\Models\Event\Event;

class EventEloquentRepository implements EventRepositoryInterface
{
    public function getAllData()
    {
        return Event::get();
    }

    public function getPaginatedData(array $requestData)
    {
        $limit  = isset($requestData['per_page']) ? $requestData['per_page'] : 10;
        return Event::paginate($limit);
    }

    public function getDataById($id)
    {
        return Event::findorfail($id);
    }

    public function getDataByEmail($email)
    {
        return Event::where('creator_email',$email)->get();
    }

    public function getDataByCalendar($calendar)
    {
        return Event::where('calendar_id',$calendar->id)->get();
    }

    public function createData(array $requestData)
    {

        $requestData['creator_email'] = current_user()->email;
        $requestData['cover_image_id'] = null;
        $category = Category::find($requestData['category_id']);
        //TODO: implement meta creation based on category

        return Event::create($requestData);
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
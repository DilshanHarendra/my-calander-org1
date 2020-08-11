<?php

namespace App\Repositories\Calendar;

use App\Enums\CalendarType;
use App\Models\Calendar\Calendar;

class CalendarRepository implements CalendarRepositoryInterface
{
    public function getAllData()
    {
        return Calendar::get();
    }

    public function getPaginatedData(array $requestData)
    {
        $limit  = isset($requestData['per_page']) ? $requestData['per_page'] : 10;
        return Calendar::paginate($limit);
    }

    public function getDataById($id)
    {
        return Calendar::findorfail($id);
    }

    public function getDataByEmail($email)
    {
        return Calendar::where('owner_email',$email)->get();
    }

    public function createData(array $requestData)
    {
        $requestData['owner_email'] ='shehan@digitalmediasolutions.com.au';
        $requestData['accounts_id'] =1;
        $requestData['type'] = CalendarType::NormalCalendar;
        return Calendar::create($requestData);
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
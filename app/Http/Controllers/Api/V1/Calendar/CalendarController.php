<?php


namespace App\Http\Controllers\Api\V1\Calendar;
use App\Calendar;
use App\Repositories\Calendar\CalendarRepositoryInterface;

class CalendarController
{
    private $calendarRepository;

    public function __construct(CalendarRepositoryInterface $calendarRepository)
    {
        $this->calendarRepository = $calendarRepository;
    }

    public function index()
    {

    }

    public function show($id)
    {

    }

    public function store(Request $request)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function delete(Request $request, $id)
    {

    }

}

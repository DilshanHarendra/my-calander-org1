<?php


namespace App\Http\Controllers\Api\V1\Calendar;

use App\Http\Controllers\Api\V1\ApiController;
use App\Repositories\Calendar\CalendarRepositoryInterface;
use Illuminate\Http\Request;

class CalendarController extends ApiController
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

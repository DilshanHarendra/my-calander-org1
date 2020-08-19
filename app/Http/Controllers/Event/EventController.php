<?php


namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Repositories\Event\EventRepositoryInterface;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class EventController extends Controller
{
    private $repository;

    public function __construct(EventRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function provider($event,$provider)
    {
        try {
            $link = $event->getAddToProviderLink($provider);

            switch($provider)
            {
                case "google":
                case "yahoo":
                case "webOutloook":
                    return Redirect($link);
                    break;
                case "outlook":
                case "apple":
                    return Response::download($link);
                    break;
            }

        }
        catch(\Exception $e)
        {
            //Show fail web notification
            abort(400);
        }
    }

}
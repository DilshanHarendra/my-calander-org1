<?php


namespace App\Http\Controllers\Api\V1\Event;

use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\V1\EventResource;
use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Event\InvitationRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class InvitationController extends ApiController
{
    private $invitationRepository;
    private $eventRepository;

    public function __construct(InvitationRepositoryInterface $invitationRepository, EventRepositoryInterface $eventRepository)
    {
        $this->invitationRepository = $invitationRepository;
        $this->eventRepository = $eventRepository;
    }

    public function index()
    {
        return EventResource::collection($this->repository->getAllData());
    }

}

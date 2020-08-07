<?php

namespace App\Repositories\Event;

interface InvitationRepositoryInterface
{
    public function getAll();

    public function getPaginated(array $requestData);

    public function get($id);

    public function getByEvent($email);

    public function create(array $requestData);

    public function update(array $requestData, $id);

    public function delete($id);

}
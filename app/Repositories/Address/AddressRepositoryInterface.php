<?php


namespace App\Repositories\Address;


interface AddressRepositoryInterface
{
    public function createDataForEvent(array $requestData,$event);

    public function createDataWithPlaceId($placeID,$event);
}
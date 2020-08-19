<?php


namespace App\Repositories\Address;

use App\Models\Address;
use App\Services\GooglePlacesApi;

class AddressEloquentRepository implements AddressRepositoryInterface
{

    public function getDataById($id)
    {
        return Address::findorfail($id);

    }

    public function createDataForEvent(array $requestData,$event)
    {
        $event->location()->create([
            'street' => $requestData['street'],
            'street_no'=> $requestData['street_no'],
            'floor'=> $requestData['floor'],
            'postal_code'=> $requestData['postal_code'],
            'city' => $requestData['city'],
            'province' =>$requestData['province'],
            'country' =>$requestData['country'],
            'longitude' =>$requestData['longitude'],
            'latitude' => $requestData['latitude'],
        ]);
    }

    public function createDataWithPlaceId($place_id,$event)
    {
        $googlePlaceService = new GooglePlacesApi();

        try {
            $placeDetails = $googlePlaceService->getPlaceById($place_id);
            $addressComponents = $placeDetails->result->address_components;
            $address = new Address();
            $address->place_id = $place_id;
            $address->longitude = $placeDetails->result->geometry->location->lng;
            $address->latitude = $placeDetails->result->geometry->location->lat;
            $address->full_address = $placeDetails->result->formatted_address;

            foreach ($addressComponents as $component)
            {
                if(in_array('floor',$component->types))
                {
                    $address->floor = $component->long_name;
                }

                if(in_array('street_number',$component->types))
                {
                    $address->street_no = $component->long_name;
                }

                if(in_array('route',$component->types))
                {
                    $address->street = $component->long_name;
                }

                if(in_array('locality',$component->types))
                {
                    $address->city = $component->long_name;
                }

                if(in_array('administrative_area_level_1',$component->types))
                {
                    $address->province = $component->long_name;
                }

                if(in_array('country',$component->types))
                {
                    $address->country = $component->long_name;
                }

                if(in_array('postal_code',$component->types))
                {
                    $address->postal_code = $component->long_name;
                }
            }

            $event->address()->save($address);
        }
        catch (\Exception $e)
        {
            //Todo: log this
        }

    }

}
<?php

namespace App\Services;

use GuzzleHttp\Client;

class GooglePlacesApi
{
    protected $url;
    protected $http;
    protected $headers;

    public function __construct()
    {
        $this->api_key = env('GOOGLE_MAPS_API_KEY');
        $this->url = 'https://maps.googleapis.com/maps/api/place/';
        $this->http = new Client();
        $this->headers = [
            'cache-control' => 'no-cache',
            'content-type' => 'application/x-www-form-urlencoded',
        ];
    }

    private function getResponse(string $uri = null)
    {

        $request = $this->http->get($uri, [
            'headers'         => $this->headers,
            'timeout'         => 30,
            'connect_timeout' => true,
            'http_errors'     => true,
        ]);

        $response = $request ? $request->getBody()->getContents() : null;
        $status = $request ? $request->getStatusCode() : 500;

        if ($response && $status === 200 && $response !== 'null') {
            $response = (object) json_decode($response);

            switch($response->status)
            {
                case "OVER_QUERY_LIMIT":
                case "REQUEST_DENIED":
                case "INVALID_REQUEST":
                case "UNKNOWN_ERROR":
                case "ZERO_RESULTS":
                    throw new \Exception($response->error_message);
                    break;
                case "OK":
                    return $response;
                    break;
                default:
                    throw new \Exception('Unknown error with places API');
                    break;

            }

        }

        return null;
    }

    public function getPlaceById($place_id)
    {
        $request = "https://maps.googleapis.com/maps/api/place/details/json?";
        $params = array(
            "place_id" => $place_id,
            "key" => $this->api_key,
            "fields"   => array('website', 'formatted_phone_number'),
        );

        $request .= http_build_query($params);
        return $this->getResponse($request);
    }
}
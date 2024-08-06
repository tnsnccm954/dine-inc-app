<?php

namespace App\Services;

use App\Contracts\GoogleMapService as GoogleMapIService;
use GuzzleHttp\Client;

class GoogleMapService implements GoogleMapIService
{
    protected $baseLat, $baseLng;

    protected $apiKey;
    protected $client;

    public function __construct(Client $client)
    {
        $this->apiKey = env('GOOGLE_MAPS_API_KEY');
        // $this->baseLocation = env('GOOGLE_MAPS_BASE_LOCATION');
        $this->baseLat = env('GOOGLE_MAPS_BASE_LATITUDE');
        $this->baseLng = env('GOOGLE_MAPS_BASE_LONGITUDE');
        $this->client = $client;
    }

    public function nearbySearch($latitude = null, $longitude = null, $radius = 5000, $params = [])
    {
        if (!$latitude || !$longitude) {
            $latitude = $this->baseLat;
            $longitude = $this->baseLng;
        }
        $baseUrl = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json';
        $baseParams = [
            'key' => $this->apiKey,
            'location' => "$latitude,$longitude",
            'radius' => $radius,
            'type' => 'restaurant|cafe|food',
        ];

        // if ($keyword) {
        //     $params['keyword'] = $keyword;
        // }

        $response = $this->client->get($baseUrl, ['query' => [...$baseParams, ...$params]]);
        $data = json_decode($response->getBody(), true);

        return $data;
    }

    public function geocodeAddress($address)
    {
        $baseUrl = 'https://maps.googleapis.com/maps/api/geocode/json';
        $params = [
            'key' => env('GOOGLE_MAPS_API_KEY'),
            'address' => $address,
        ];

        $response = $this->client->get($baseUrl, ['query' => $params]);
        $data = json_decode($response->getBody(), true);

        if ($data['status'] === 'OK') {
            return [
                'latitude' => $data['results'][0]['geometry']['location']['lat'],
                'longitude' => $data['results'][0]['geometry']['location']['lng'],
            ];
        } else {
            // Handle geocoding errors
            return null;
        }
    }

    public function textSearch($query)
    {
        $baseUrl = 'https://maps.googleapis.com/maps/api/place/textsearch/json';
        $params = [
            'key' => env('GOOGLE_MAPS_API_KEY'),
            'query' => $query,
        ];

        $response = $this->client->get($baseUrl, ['query' => $params]);
        $data = json_decode($response->getBody(), true);

        return $data;
    }

    public function getPlaceDetails($placeId)
    {
        $baseUrl = 'https://maps.googleapis.com/maps/api/place/details/json';
        $params = [
            'key' => env('GOOGLE_MAPS_API_KEY'),
            'place_id' => $placeId,
        ];

        $response = $this->client->get($baseUrl, ['query' => $params]);
        $data = json_decode($response->getBody(), true);
        return $data;
    }

    // public function getMapViews()
    // {
    // }
}
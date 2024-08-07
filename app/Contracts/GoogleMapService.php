<?php

namespace App\Contracts;

interface GoogleMapService
{

    public function getDefaultLocation();

    public function nearbySearch($latitude, $longitude, $radius = 5000, $params = []);

    public function geocodeAddress($address);

    public function textSearch($query);

    public function getPlaceDetail($placeId);
}
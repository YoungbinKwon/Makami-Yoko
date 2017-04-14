<?php

class GoogleMapApi {

    private $url_base;

    public function __construct()
    {
        $this->url_base = 'https://maps.googleapis.com/maps/api/directions/json?';
    }

    public function getDistance($from, $to)
    {
        $url = $this->url_base . "origin=" . $from . "&destination=" . $to;
        $googleMapsApiData = json_decode(@file_get_contents($url), true);

        if (isset($googleMapsApiData['routes'][0]['legs'][0]['duration']['value'])) {
            $distance = $googleMapsApiData['routes'][0]['legs'][0]['duration']['value'];
        } else {
            $distance = 99999999;
        }

        return $distance;
    }
}

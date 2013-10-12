<?php

require_once 'autoload.php';
require_once 'location.php';

class LocationController{
    var $location;
    
    function __construct() {
         $location = new Location();
         
         $geocoder = new \Geocoder\Geocoder();
            $adapter  = new \Geocoder\HttpAdapter\CurlHttpAdapter();
        $chain    = new \Geocoder\Provider\ChainProvider(array(
            new \Geocoder\Provider\FreeGeoIpProvider($adapter),
            new \Geocoder\Provider\HostIpProvider($adapter),
            new \Geocoder\Provider\GoogleMapsProvider($adapter),
            new \Geocoder\Provider\BingMapsProvider($adapter, 'AmzBQOqp58xkBE-4NVgLq_RP2pM8v2e_Mbz9VR2jTZ8szmBClFG3ibqfiNu2exsL')

        ));
        $geocoder->registerProvider($chain);
    }
    
    function getLocation($string){
        try {
            $geocode = $geocoder->geocode($string);
            var_export($geocode);
            $location->setLatLng($geocode['latitude'],$geocode['longitude']);
            return $location;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
?>

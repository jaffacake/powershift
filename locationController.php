<?php

require_once 'libs/autoload.php';
require_once 'location.php';

class LocationController{
    
    private $location;
    private $geocoder;
    private $adapter;
    private $chain;
    private $geocode;
    
    function __construct() {
         $this->location = new Location();
         $this->geocoder = new \Geocoder\Geocoder();
         $this->adapter  = new \Geocoder\HttpAdapter\CurlHttpAdapter();
         $this->chain    = new \Geocoder\Provider\ChainProvider(array(
            new \Geocoder\Provider\FreeGeoIpProvider($this->adapter),
            new \Geocoder\Provider\HostIpProvider($this->adapter),
            new \Geocoder\Provider\GoogleMapsProvider($this->adapter),
            new \Geocoder\Provider\BingMapsProvider($this->adapter, 'AmzBQOqp58xkBE-4NVgLq_RP2pM8v2e_Mbz9VR2jTZ8szmBClFG3ibqfiNu2exsL')
        ));
        $this->geocoder->registerProvider($this->chain);
    }
    
    function getLocation($string){
        try {
            $this->geocode = $this->geocoder->geocode($string);
            var_export($this->geocode);
            $this->location->setLatLng($this->geocode['latitude'],$this->geocode['longitude']);
            return $this->location->getLatLng();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
?>

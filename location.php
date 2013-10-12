<?php

class Location{
    
    var $lat;
    var $lng;
    
    function setLatLng($lat,$lng){
        $this->lat = $lat;
        $this->lng = $lng;
    }
    
    function getLatLng(){
        return array('lat' => $this->lat, 'lng' => $this->lng);
    }
}
?>

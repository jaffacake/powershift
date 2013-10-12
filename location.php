<?php

class Location{
    
    private $lat;
    private $lng;
    private $name;
    
    function setLatLng($lat,$lng){
        $this->lat = $lat;
        $this->lng = $lng;
    }
    
    function getLatLng(){
        return array('lat' => $this->lat, 'lng' => $this->lng, 'name' =>$this->name);
    }
    
    function setName($name){
        $this->name = $name;
    }
    
    function getName(){
        return $this->name;
    }
}
?>

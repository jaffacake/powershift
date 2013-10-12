<?php

class Weather{
    private $temperature;
    private $summary;
    private $icon;
    private $humidity;
    private $pressure;
    private $visibility;
    
    
    public function getTemperature() {
    return $this->temperature;
    }

    public function setTemperature($temperature) {
    $this->temperature = $temperature;
    }

    public function getSummary() {
    return $this->summary;
    }

    public function setSummary($summary) {
    $this->summary = $summary;
    }

    public function getIcon() {
    return $this->icon;
    }

    public function setIcon($icon) {
    $this->icon = $icon;
    }

    public function getHumidity() {
    return $this->humidity;
    }

    public function setHumidity($humidity) {
    $this->humidity = $humidity;
    }

    public function getPressure() {
    return $this->pressure;
    }

    public function setPressure($pressure) {
    $this->pressure = $pressure;
    }

    public function getVisibility() {
    return $this->visibility;
    }

    public function setVisibility($visibility) {
    $this->visibility = $visibility;
    }
}

?>

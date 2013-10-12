<?php

require_once 'libs/forecast.io.php';
require_once 'weather.php';

class WeatherController{
    
    private $weather;
    private $api_key = '590e67842b699d251fad2f60b4f9cdc5';
    
    public function __construct() {
        $this->weather = new Weather();
    }
    
}

?>

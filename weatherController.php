<?php

require_once 'libs/forecast.php';
require_once 'weather.php';

class WeatherController{
    
    private $weather;
    private $api_key = '590e67842b699d251fad2f60b4f9cdc5';
    private $forecastWeek;
    private $forecastToday;
    
    
    public function __construct() {
        $this->weather = new Weather();
        $this->forecast = new ForecastIO($this->api_key);
    }
    
    public function getTodaysForecast($lat,$lng){
        $this->forecastToday = $this->forecast->getForecastToday($lat, $lng);
        return $this->forecastToday;
    }
    
    public function getWeeksForecast($lat,$lng){       
        return $this->forecast->getForecastWeek($lat, $lng);;
    }
}

?>

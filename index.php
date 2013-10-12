<?php
require_once('locationController.php');
require_once('weatherController.php');

    $locationController = new LocationController();
    $weatherController = new weatherController();
    
    $array = $locationController->getLocation("b92 0pu");
    
    print_r($weatherController->getWeeksForecast($array['lat'], $array['lng']));
    
    print_r($array);
      
    echo "LocationController created";
    
?>

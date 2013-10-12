<?php

require_once('locationController.php');
require_once('weatherController.php');

    $locationController = new LocationController();
    $weatherController = new weatherController();

    if(isset($_POST['location'])){
        $array = $locationController->getLocation($_POST['location']);
        echo $weatherController->getWeeksForecast($array['lat'], $array['lng']);
    }else{
        echo "null";
    }
?>

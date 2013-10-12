<?php
require_once('locationController.php');

    $locationController = new LocationController();
      
      $array = array('lat' => '52.430286407471', 'lng' => '-1.7572659254074');
      
      print_r($array);
      
      $array2 = $locationController->getLocation("b92 0pu");
      
      print_r($array2);
      
      echo "LocationController created";
?>

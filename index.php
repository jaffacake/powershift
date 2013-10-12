<?php
require_once('locationController.php');
require_once('weatherController.php');

    $locationController = new LocationController();
    $weatherController = new weatherController();
    
    $array = $locationController->getLocation("b92 0pu");
    
    $array2 = $weatherController->getWeeksForecast($array['lat'], $array['lng']);
    
    foreach($array2 as $data){
        echo $data->getMaxTemperature();
    }
      
    echo "LocationController created";
    
?>

<table>

    <tr>
        <?php
        $i = 1;
        foreach($array2 as $data){
            
        ?>
        <td>
            
            <div class="day">
            <?=Date('l', strtotime("+".$i." days"))?>
                
            <?=$data->getSummary()?></div>
            
        </td>
        <?
            $i++;
        
        }
        ?>
    </tr>
</table>

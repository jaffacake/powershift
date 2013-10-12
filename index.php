<?php
require_once('locationController.php');
require_once('weatherController.php');

    $locationController = new LocationController();
    $weatherController = new weatherController();
    
    $array = $locationController->getLocation("b92 0pu");
    
    $array2 = $weatherController->getWeeksForecast($array['lat'], $array['lng']);
    
?>
<link href="style.css" rel="stylesheet" type="text/css" />
<table>

    <tr valign="top" align="center">
        <?php
        $i = 1;
        foreach($array2 as $data){
            
        ?>
        <td>
            
            <div class="forecast">
                <div class="day"><?=Date('l', strtotime("+".$i." days"))?></div>
                <div class="icon"><img src="images/weather/<?=$data->getIcon()?>.png" width="96px" height="96px"/></div>
                <div class="maxTemp">Max Temp:<?=$data->getMaxTemperature()?></div>
                <div class="minTemp">Min Temp:<?=$data->getMinTemperature()?></div>
                <div class="summary"><?=$data->getSummary()?></div>
            </div>
            
        </td>
        <?
            $i++;
        
        }
        ?>
    </tr>
</table>

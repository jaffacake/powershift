<?php

require_once('locationController.php');
require_once('weatherController.php');

    $locationController = new LocationController();
    $weatherController = new weatherController();

    if(isset($_POST['location'])&&isset($_POST['forecast'])){
        $array = $locationController->getLocation($_POST['location']);
        if($_POST['forecast']=="week"){
            
        $array2 = $weatherController->getWeeksForecast($array['lat'], $array['lng']);
        ?>
            <table min-height="200px">
        <tr>
            <td><h1 id="locationName"><?=$array['name']?></h1></td>
        </tr>
        <tr valign="top" align="center">
            <?php
            $i = 1;
            foreach($array2 as $data){

            ?>
            <td>

                <div class="forecast" id="forecast<?=$i?>">
                    <div class="day" id="day<?=$i?>"><h2><?=Date('l', strtotime("+".$i." days"))?></h2></div>
                    <div class="icon" id="icon<?=$i?>"><img src="images/weather/<?=$data->getIcon()?>.png" width="96px" height="96px"/></div>
                    <div class="maxTemp" id="maxTemp<?=$i?>">Max Temp: <?=$data->getMaxTemperature()?></div>
                    <div class="minTemp" id="minTemp<?=$i?>">Min Temp: <?=$data->getMinTemperature()?></div>
                    <div class="summary" id="summary<?=$i?>"><?=$data->getSummary()?></div>
                </div>

            </td>
            <?php
                $i++;

            }
            ?>
        </tr>
    </table>
<?php
        }
        elseif ($_POST['forecast']=="day"){
            if($_POST['forecastDay']=="day1"){
                $array2 = $weatherController->getTodaysForecast($array['lat'], $array['lng']);
            }
            else{
                preg_match('!\d+!', $_POST['forecastDay'], $match);
                $timestamp = date_timestamp_get(Date('l', strtotime("+".$match[0]." days")));
                $array2 = $weatherController->getdayForecast($array['lat'], $array['lng'], $timestamp);
            }
            ?>

            <div><?php
            $i = 1;
            foreach($array2 as $data){
                echo $data->getMaxTemperature();
            ?> 
            
            <?
            }
            ?>
                </div>
            <?
        }
    }else{
        echo "null";
    }
?>

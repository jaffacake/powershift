<?php
    require_once('locationController.php');
    require_once('weatherController.php');

    $locationController = new LocationController();
    $weatherController = new weatherController();
    
    $array = $locationController->getLocation($_SERVER['REMOTE_ADDR']);
    $array2 = $weatherController->getWeeksForecast($array['lat'], $array['lng']);
?>
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.10.2.min.js"></script>

<script>
    $(document).ready(function(){
      $("#search").submit(function(event){
          event.preventDefault();
          $.ajax({
            type: "POST",
            url: "controller.php",
            data: { location: $("#location").val()}
          })
            .done(function( data ) {
                if ( console && console.log ) {
                console.log( "Sample of data:", data );
                }
            });
          
      });
    
    });
    
</script>

<form id="search" method="POST">
<input id="location" name="location"/>
<input id="submit" type="submit"/>
</form>

<table min-height="200px">
    <tr>
        <td><h1><?=$array['name']?></h1></td>
    </tr>
    <tr valign="top" align="center">
        <?php
        $i = 1;
        
        foreach($array2 as $data){
            
        ?>
        <td>
            
            <div class="forecast">
                <div class="day"><h2><?=Date('l', strtotime("+".$i." days"))?></h2></div>
                <div class="icon"><img src="images/weather/<?=$data->getIcon()?>.png" width="96px" height="96px"/></div>
                <div class="maxTemp">Max Temp: <?=$data->getMaxTemperature()?></div>
                <div class="minTemp">Min Temp: <?=$data->getMinTemperature()?></div>
                <div class="summary"><?=$data->getSummary()?></div>
            </div>
            
        </td>
        <?
            $i++;
        
        }
        ?>
    </tr>
</table>

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
      $("#search").submit(function( event ){
          $("#LoadingImage").show();
          event.preventDefault();
          $.ajax({
            type: "POST",
            url: "controller.php",
            data: { forecast: "week", location: $("#location").val()}
          })
            .done(function( data ) {
            $("#LoadingImage").hide();
                $("#content").html(data);
            });
          
      });
      
      
      $('body').on("click", '[class^="forecast"]', function ( event ) {
          event.preventDefault();
          $("#LoadingImage").show();
          loc = "";
          if($("#location").val().length==0){
              loc = "<?=$_SERVER['REMOTE_ADDR']?>";
          }else{
              loc = $("#location").val();
          }
          $.ajax({
            type: "POST",
            url: "controller.php",
            data: { forecast: "day", forecastDay: $(this).children(".day").attr("id"), location: loc}
          })
            .done(function( data ) {
                $("#LoadingImage").hide();
                $("#day-summary").html(data);
            });
          return false;
      });
    
    });
    
</script>

<form id="search" method="POST">
    <input id="location" name="location"/>
    <input id="submit" type="submit"/>
    <div id="LoadingImage" style="display: none">
        <img src="images/ajax_loading.gif" />
    </div>
</form>

<div id="content">
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
        <tr>
            <td><div id="day-summary"></div></td>
        </tr>
    </table>
</div>


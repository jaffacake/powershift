
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.10.2.min.js"></script>

<script>
    $(document).ready(function(){
      $("#search").submit(function( event ){
          $("#LoadingImage").show();
          $("#day-summary").html("");
          event.preventDefault();
          $.ajax({
            type: "POST",
            url: "controller.php",
            data: { forecast: "week", location: $("#location").val()},
            success: function( data ) {
                $("#LoadingImage").hide();
                $("#content").html(data);
            }
          });       
      });
      
      
      $('body').on("click", '[class^="forecast"]', function ( event ) {
          $('[class^="forecast"]').not($(this)).attr("class","forecast");
        $(this).attr("class","forecast-sel");
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
            data: { forecast: "day", forecastDay: $(this).children(".day").attr("id"), location: loc},
            success: function( data ) {
                $("#LoadingImage").hide();
                $("#day-summary").html(data);
            }
          }); 
      });
      
      $('body').on("click", '#currentLocation', function ( event ) {
        $("#LoadingImage").show();
        $("#day-summary").html("");
        event.preventDefault();
        $.ajax({
          type: "POST",
          url: "controller.php",
          data: { forecast: "week", location: "<?=$_SERVER['REMOTE_ADDR']?>"},
          success: function( data ) {
              $("#LoadingImage").hide();
              $("#content").html(data);
          }
        });

    });
    
    });
    
</script>

<form id="search" method="POST">
    <input id="location" name="location"/>
    <input id="submit" type="submit"/>
    <input type="button" id="currentLocation" name="currentLocation" value="Use Current Location"/>
    <div id="LoadingImage" style="display: none">
        <img src="images/ajax_loading.gif" />
    </div>
</form>

<div id="content">
    
</div>

<div id="day-summary" class="day-summary"></div>

<link href="style.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script>
    $(document).ready(function(){
        
        function ajax(){
            $("#LoadingImage").show();
          $("#day-summary").html("");
            $.ajax({
            type: "POST",
            url: "controller.php",
            data: { forecast: "week", location: $("#location").val()},
            success: function( data ) {
                $("#LoadingImage").hide();
                $("#content").html(data);
            }
          });
        }
    
      $("#search").submit(function( event ){
          event.preventDefault();
          ajax();      
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
         $( "#location" ).autocomplete({
            source: function( request, response ) {
            $.ajax({
                url: "http://ws.geonames.org/searchJSON",
                dataType: "jsonp",
                data: {
                featureClass: "P",
                style: "full",
                maxRows: 12,
                name_startsWith: request.term
                },
                success: function( data ) {
                response( $.map( data.geonames, function( item ) {
                    return {
                        label: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName,
                        value: item.name
                    }
                }));
                }
            });
            },
            minLength: 2,
            select: function( event, ui ) {
                ajax(); 
            },
            open: function() {
                $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
            },
            close: function() {
                $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
            }
            });
    
    });
    
</script>

<form id="search" method="POST">
    <div class="ui-widget">
    <input id="location" name="location"/>
    
    <input id="submit" type="submit"/>
    <input type="button" id="currentLocation" name="currentLocation" value="Use Current Location"/>
    <div id="LoadingImage" style="display: none">
        <img src="images/ajax_loading.gif" />
    </div>
    </div>
</form>

<div id="content">
    
</div>

<div id="day-summary" class="day-summary"></div>
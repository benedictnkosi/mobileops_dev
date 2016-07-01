<!DOCTYPE HTML>

<html>
<head>
<title>Pricelist</title>
<meta charset="UTF-8">
<!-- accodian -->

<link rel="stylesheet"
	href="http://necolas.github.io/normalize.css/2.1.3/normalize.css">
<link rel="stylesheet" href="web/css/jquery.idealforms.css">

<link rel="stylesheet"
	href="//netdna.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

<link rel="stylesheet"
	href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

<link rel="stylesheet" href="web/css/build.css" />

<link rel="stylesheet" href="web/css/jquery-ui.css">

<script src="web/js/jquery-ui.js"></script>
<script src="web/js/events/events_geoprices.js"></script>

<style>
.field.buttons button {
	margin-right: .5em;
}

#invalid {
	display: none;
	float: left;
	margin-left: 120px;
	margin-top: .5em;
	color: #CC2A18;
	font-size: 130%;
	font-weight: bold;
}

.idealforms.adaptive #invalid {
	margin-left: 0 !important;
}

.idealforms.adaptive .field.buttons label {
	height: 0;
}

.row.uniform>*>:first-child {
	width: 100%;
}

.major{
    margin-bottom: 3em;
    }

.service_categories_row{
	border:1px solid black;
    border-radius: 5px;
    margin: 3em 3em 2em 0 !important;
}

.service_categories_cell{

        padding: 1em 0 1em 2em !important;
    }
    
    
    .row.uniform>*>:first-child {
    width: auto;
}

</style>

</head>

<body class="landing">

<!-- Two -->
<section id="two" class="wrapper style2">
<div class="container"><header class="major">
<h2>PRICE LIST</h2>
<h3 class="lbl_loading">Finding your location.......</h3>

<div id="img-load">
<img src="web/images/ajax-loader.gif"/>
</div>

</header> <section>

<form class="idealforms" novalidate action="/" method="post">

<div class="row uniform">
   <div class="12u">
                  <div id="lbl_message" class="alert display-none" >
</div>
</div></div>


<div class="row uniform service_categories_row" id="service_categories_row">
 <div class="12u">
              <h4>Select service category</h4>                     
              </div>
	
	</div>
					

<div class="row uniform">
   <div class="12u">
              <button  type="submit" id="cmdSearchPriceList" name="searchPriceList" value="searchPriceList" onclick="getPrices();" style="float: none;">Search Price List</button>                     
              </div>
</div>

<div class="row uniform">

<div class="12u">
<div id="jsontotable-obj" class="jsontotable"></div>
</div>
   
</div></div>




</form>
</section></div>
</section>
<script type="text/javascript" src="web/js/jquery.jsontotable.min.js"></script>

<script src="web/js/jquery-ui.min.js"></script>

<script src="web/js/out/jquery.idealforms.js"></script>


 <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.

      function initMap() {
        
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
        	  sessionStorage.mobileops_lat = position.coords.latitude;
        	  sessionStorage.mobileops_lng =position.coords.longitude;
        	  $('.lbl_loading').text("");
        	  $('#img-load').hide();
          }, function() {
            handleLocationError(true);
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false);
        }
      }

      function handleLocationError(browserHasGeolocation) {
    	  tryAPIGeolocation();
    	  
      
      }

      var tryAPIGeolocation = function() {
    		$.post( "https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyCz7PnH-AuMR2av1QGE3awtv07S9jiRXEQ", function(success) {
    			//apiGeolocationSuccess({coords: {latitude: success.location.lat, longitude: success.location.lng}});
    			 //getPrices(success.location.lat, success.location.lng);
   			 sessionStorage.mobileops_lat = success.location.lat;
   			sessionStorage.mobileops_lng = success.location.lng;
   			$('.lbl_loading').text("");
   			$('#img-load').hide();
    	  })
    	  .fail(function(err) {
    		  $('.lbl_loading').text('Error: Your browser doesn\'t support geolocation.');
    		  $('#img-load').hide();
    	  });
    	};
    	
    </script>
    

 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCz7PnH-AuMR2av1QGE3awtv07S9jiRXEQ&callback=initMap">
    </script>
    
</body>
</html>

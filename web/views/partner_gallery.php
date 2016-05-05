<!DOCTYPE HTML>
<html>
<head>
<title>Gallery</title>
<script src="web/js/lean-slider.js"></script>
<script src="web/js/commons.js"></script>
<link rel="stylesheet" href="web/css/lean-slider.css" type="text/css" />
<link rel="stylesheet" href="web/css/slider-styles.css" type="text/css" />



<link
	href="http://netdna.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css"
	rel="stylesheet">

</head>
<body class="landing">

<section id="two" class="wrapper style2">
<div class="container" id="partner_gallery_container">
<h3 id="gallery_heading" style="text-align: center;">Partner Gallery</h3>


<div class="slider-wrapper">
        <div id="slider">

        </div>
        <div id="slider-direction-nav"></div>
        <div id="slider-control-nav"></div>
    </div>
    
    
</section> <script
	src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>


<script type="text/javascript">

$(document).ready(function() {

	$("#slider").load("src/AppBundle/Controller/controller_partner_profile.php?getPartnerImages=" + getUrlParameter("partnergallery"), function() {
		var slider = $( "#slider" ).html();
		if(slider.indexOf("failed") > -1){
			$( "#gallery_heading" ).html("Partner does not have any images uploaded");
			$( ".slider-wrapper" ).remove();
		}else{
			var slider = $('#slider').leanSlider({
		        directionNav: '#slider-direction-nav',
		        controlNav: '#slider-control-nav',
		        prevText: '', // text for the "prev" directionNav element
		        nextText: '', 
		        pauseOnHover: true, 
		        pauseTime: 20000,
		    });
		}
		
	});
});
      </script>

</body>
</html>

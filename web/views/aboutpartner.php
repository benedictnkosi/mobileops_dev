<!DOCTYPE HTML>
<html>
<head>
<title>About Partner</title>
<script src="web/js/lean-slider.js"></script>
<script src="web/js/commons.js"></script>
<link rel="stylesheet" href="web/css/lean-slider.css" type="text/css" />
<link rel="stylesheet" href="web/css/slider-styles.css" type="text/css" />



<link
	href="web/css/bootstrap.min.css"
	rel="stylesheet">

</head>
<body class="landing">

<section id="two" class="wrapper style2">


<div class="container" id="partner_gallery_container">
<h3 id="heading" style="text-align: center;">Service Provider Profile</h3>

<p id="about_partner"></p>



<div class="slider-wrapper">
        <div id="slider">

        </div>
        <div id="slider-direction-nav"></div>
        <div id="slider-control-nav"></div>
    </div>
    
    
</section> <script
	src="web/js/jquery-ui.min.js"></script>


<script type="text/javascript">

$(document).ready(function() {

	readPartnerProfile();
	
	$("#slider").load("src/AppBundle/Controller/controller_partner_profile.php?getPartnerImages=" + getUrlParameter("aboutpartner"), function() {
		var slider = $( "#slider" ).html();
		if(slider.indexOf("failed") > -1){
			
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

function readPartnerProfile(){
	$.ajax({
		type : 'GET',
		url : 'src/AppBundle/Controller/controller_partner_profile.php?getPartnerPersonalNote=' + getUrlParameter("aboutpartner"),
		dataType : "json",
		success : function(data) {
			//check if booking id found
			
			if(data.status == 1){
				$("#about_partner" ).empty();
				var element = document.getElementById("about_partner");
				element.appendChild(document.createTextNode(data.message['personalNote']));
				$( "#heading" ).html(data.message['name'] + " " + data.message['surname'] + " Profile" );
				return;
			}
		},
	});
}
      </script>

</body>
</html>

<!DOCTYPE HTML>
<html>
<head>
<title>Profile</title>
<link href="web/css/dropzone-style.css" media="all" rel="stylesheet"
	type="text/css" />

<link rel="stylesheet"
	href="http://necolas.github.io/normalize.css/2.1.3/normalize.css">
<link rel="stylesheet" href="web/css/jquery.idealforms.css">


<link
	href="http://netdna.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css"
	rel="stylesheet">
<link href="web/css/star-rating.min.css" media="all" rel="stylesheet"
	type="text/css" />


<script src="web/js/star-rating.min.js" type="text/javascript"></script>
<script src="web/js/events/events_partnerprofile.js" type="text/javascript"></script>

<!-- image upload -->
<script src="/web/js/ajaxupload.js" type="text/javascript"></script>

<link href="web/css/dropzone.css" media="all" rel="stylesheet"
	type="text/css" />

<script src="web/js/dropzone.js"></script>

<!-- LOCATION SCRIPTS -->
<script
	src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="web/js/jquery.geocomplete.js"></script>


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

.row.uniform {
	width: 100%;
}

#upload-file-container {
	cursor: pointer;
	cursor: hand;
}

#upload-file-container input {
	filter: alpha(opacity = 0);
	opacity: 0;
	height: 150px;
	cursor: pointer;
	cursor: hand;
}
</style>


</head>
<body class="landing">
<!-- one -->
<section id="one" class="wrapper style1">
<div class="container"><input id="partner_rating" class="rating"
	value="3" data-min="0" data-max="5" data-disabled="true" data-size="xs"><section>


<h3>Personal Details</h3>


<form class="idealforms" novalidate action="/" method="post"><!-- Text -->


   <div class="row uniform">
   <div class="12u">
                  <div id="lbl_address_message" class="alert display-none alert-danger"  >Address must contains street name and street number
</div>
</div></div>


<div class="row uniform">
<div class="12u">
<div id="lbl_message" class="alert display-none"></div>
</div>
</div>

<div class="row uniform">
<div class="6u 12u(3)">
<div class="field"><input type="text" name="savePersonalDetails"
	value="partner" style="display: none;" /> <input type="text"
	name="firstname" id="firstname" value="" placeholder="First Name" /> <span
	class="error"></span></div>
</div>
<div class="6u 12u(3)">
<div class="field"><input type="text" name="surname" id="surname"
	value="" placeholder="Surname" /> <span class="error"></span></div>
</div>
</div>


<div class="row uniform">
<div class="6u 12u(3)">
<div class="field"><input type="email" name="email" id="email" value=""
	placeholder="Email" disabled="true" /> <span class="error"></span></div>
</div>
<div class="6u 12u(3)">
<div class="field"><input type="text" name="mobile_number"
	id="mobile_number" value="" placeholder="Phone Number" /> <span
	class="error"></span></div>
</div>
</div>

<div class="row uniform">
<div class="6u 12u(3)">
<div class="field"><input type="text" name="address" id="address"
	value=""
	placeholder="Street Address e.g. 340 Kent Avenue, Randburg, South Africa" />
<span class="error"></span></div>
</div>
<div class="6u 12u(3)">
<div class="field"><input type="text" name="complex" id="complex"
	value="" placeholder="Complex Name" /> <span class="error"></span></div>
</div>
</div>

<div class="row uniform">
<div class="6u 12u(1)">
<div class="field"><textarea name="personalNote" cols="100" rows="4"
	placeholder="Tell us about your self" id="txt_personalNote"
	maxlength="200" style="width: 100%;"></textarea> <span class="error"></span></div>
</div>
</div>

<div class="row uniform  display-none">
<div class="6u 12u(3)">

<div class="field"><input name="lat" type="text" value=""
	class="googleResults" id="input_Latitude"> <span class="error"></span>
</div>
</div>
<div class="6u 12u(3)">
<div class="field"><input name="lng" type="text" value=""
	class="googleResults" id="input_Longitude"> <span class="error"></span>
</div>
</div>

<div class="6u 12u(3)">
<div class="field"><input name="administrative_area_level_1" type="text"
	value="" class="googleResults" id="input_province"> <span class="error"></span>
</div>
</div>


<div class="6u 12u(3)">
<div class="field"><input name="locality" type="text"
	value="" class="googleResults" id="input_suburb"> <span class="error"></span>
</div>
</div>


<div class="6u 12u(3)">
<div class="field"><input name="route" type="text" value=""
	class="googleResults" id="input_street_name"> <span class="error"></span>
</div>
</div>

<div class="6u 12u(3)">
<div class="field"><input name="street_number" type="text" value=""
	class="googleResults" id="input_street_number"> <span class="error"></span>
</div>
</div>


<div class="6u 12u(3)">
<div class="field"><input name="sublocality" type="text" value=""
	class="googleResults" id="input_city"> <span class="error"></span></div>
</div>

</div>



<!-- Button -->
<button type="submit" id="cmdSaveDetails">Save Details</button>

</form>
</section></div>
</section>
<!-- Two -->
<section id="two" class="wrapper style2">
<div class="container">
<h3>Partner Services</h3>
<div id="partnerServicesDiv"></div>
<a href="index.php?updateservices" class="button">Update Services</a></div>
</section>


<!-- Three -->

<section id="three" class="wrapper style2">
<div class="container">
<h3>Partner Gallery Images</h3>
<form action="/src/AppBundle/Logic/file_upload.php" class="dropzone"
	id="fileUpload_dropzone"></form>
</div>
</section>

<script
	src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<script src="web/js/out/jquery.idealforms.js"></script>



<script type="text/javascript">


      $("#address").geocomplete({ details: "form" }); 

      $("#address").on('input keyup', function(e) {
              // Reset lat
        	  $('#input_Latitude').val("");
          });
      
      $('form.idealforms').idealforms({
          silentLoad: true,
          rules: {
            'firstname': 'required',
            'surname': 'required',
            'email': 'required email',
            'mobile_number': 'required number min:10 max:10',
            'idnumber': 'required',
            'address': 'required',
            'txt_personalNote': 'required',
          },
          
        	onSubmit: function(invalid, e) {
        	    e.preventDefault();
        	    $('#lbl_message').addClass( "display-none" );
        	    if (invalid) {
        	      
        	    } else {

        	    	if($('#input_street_name').val().length < 1 || $('#input_street_number').val().length < 1 ){
        	    		$('#lbl_address_message').show(function() {
        	    			$(this).fadeOut(6000);}
        	    		);
        	    		
        	    		$(
                        "html, body")
                    .animate({
                            scrollTop: $(
                                    ".container")
                                .offset().top
                        },
                        "slow");
        	    		return;
        	    	}
        	      $.post('src/AppBundle/Controller/controller_partner_profile.php', this.$form.serialize(), function(response) {  
        	    	  var message = response.message;
        	  		if(message.indexOf("Successfully") > -1){
        	  			$('#lbl_message').text(message);
        	  			$('#lbl_message').removeClass( "display-none alert-warning alert-danger" ).addClass( "alert-success" );
        	  		}else{
        	  			$('#lbl_message').text(message);
        	  			$('#lbl_message').removeClass( "display-none alert-success alert-warning" ).addClass( "alert-danger" );
        	  		}
        	  		$(
                    "html, body")
                .animate({
                        scrollTop: $(
                                ".container")
                            .offset().top
                    },
                    "slow");
        	      }, 'json');
        	    }    
        	  }
        });

        $('form.idealforms').find('input, select, textarea').on('change keyup', function() {
          $('#invalid').hide();
        });


        $('input[type=file]').change(function(e){
        	 $( "#cmdSubmitProfilePic" ).click();
        	});
         
         
      </script>
</body>
</html>

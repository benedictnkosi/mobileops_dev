<!DOCTYPE HTML>
<html>
   <head>
   <link rel="stylesheet"
	href="http://necolas.github.io/normalize.css/2.1.3/normalize.css">
<link rel="stylesheet" href="web/css/jquery.idealforms.css">
      
      
<!-- LOCATION SCRIPTS -->      
 <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places,key=AIzaSyDCPdhVj3JIm7hCHjZW4FVQxzGdkCLte0A"></script>
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

.row.uniform>*>:first-child{
width:100%;
}
</style>


   </head>
   <body class="landing">
      <!-- one -->
      <section id="one" class="wrapper style1">
         <div class="reg-container">
            <header class="major">
						<h2>PARTNER REGISTRATION</h2>
						
					</header>
            <!-- Form --> 
            <section>
               <form class="idealforms" novalidate action="/" method="post">

  <!-- Text -->
  
     <div class="row uniform">
   <div class="12u">
                  <div id="lbl_message" class="alert display-none" >
</div>
</div></div>

  <div class="row uniform">
                     <div class="6u 12u(3)">
                     	<div class="field">
                     	<input type="text" name="register" value="partner"
                           style="display:none;"/>
 <input type="text" name="firstname" id="firstname" value=""
                           placeholder="First Name"/>
    <span class="error"></span>
  </div>
                     </div>
                     <div class="6u 12u(3)">	<div class="field">
                     	<input type="text" name="surname" id="surname" value=""
                           placeholder="Surname"/>
                           
  </div></div>
                  </div>
     
                
                               
 <div class="row uniform">
                     <div class="6u 12u(3)">
                     	<div class="field">
 <input type="email" name="email" id="email" value=""
                           placeholder="Email"/>
    <span class="error"></span>
  </div>
                     </div>
                     <div class="6u 12u(3)">	<div class="field">
 <input type="text" name="mobile_number" id="mobile_number" value=""
                           placeholder="Phone Number"/>
    <span class="error"></span>
  </div></div>
                  </div>
                  
 <div class="row uniform">
                     <div class="6u 12u(3)">
                     	<div class="field">
 <input type="text" name="address" id="address" value=""
                           placeholder="Street Address e.g. 340 Kent Avenue, Randburg, South Africa"/>
    <span class="error"></span>
  </div>
                     </div>
                     <div class="6u 12u(3)">	<div class="field">
 <input type="text" name="complex" id="complex" value=""
                           placeholder="Complex Name"/>
    <span class="error"></span>
  </div></div>
                  </div>
                  
                  <div class="row uniform" style="display:none;">
                     <div class="6u 12u(3)">
                     	<div class="field">
 <input name="lat" type="text" value="" class="googleResults"
		id="input_Latitude">
    <span class="error"></span>
  </div>
                     </div>
                     <div class="6u 12u(3)">	<div class="field">
<input name="lng" type="text" value="" class="googleResults"
		id="input_Longitude">
    <span class="error"></span>
  </div></div>
  
  
<div class="6u 12u(3)">
<div class="field"><input name="administrative_area_level_1" type="text" value=""
	class="googleResults" id="input_province"> <span class="error"></span>
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
<div class="field"><input name="locality" type="text" value=""
	class="googleResults" id="input_city"> <span class="error"></span></div>
</div>


<div class="6u 12u(3)">
<div class="field"><input name="sublocality" type="text" value=""
	class="googleResults" id="input_suburb"> <span class="error"></span></div>
</div>

                  </div>
                  
 <div class="row uniform">
                     <div class="6u 12u(3)">
                     	<div class="field">
 <input type="password" name="password" id="password" value=""
                           placeholder="Password"/>
    <span class="error"></span>
  </div>
                     </div>
                     <div class="6u 12u(3)">	<div class="field">
 <input type="password" name="confirm_password" id="confirm_password" value=""
                           placeholder="Confirm Password"/>
    <span class="error"></span>
  </div></div>
                  </div>                  
                  
                                                      
                  
  <!-- Button -->
  <button type="submit" id="cmdRegister" style="margin-top: 1em;">Submit</button>

</form>
            </section>
         </div>
      </section>
      
      <script
	src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<script src="web/js/out/jquery.idealforms.js"></script>

      <script type="text/javascript">

      $("#address").geocomplete({ details: "form" });  // Option 1: Call on element.

      $('form.idealforms').idealforms({
          silentLoad: true,
          rules: {
            'firstname': 'required',
            'surname': 'required',
            'email': 'required email',
            'mobile_number': 'required number min:10 max:10',
            'address': 'required',
            'confirm_password': 'required equalto:password',
            'password': 'required'
          },
          
        	onSubmit: function(invalid, e) {
        	    e.preventDefault();
        	    $('#lbl_message').addClass( "display-none" );
        	    if (invalid) {
        	    	
        	    } else {
            	    $.post('src/AppBundle/Controller/controller_security.php', this.$form.serialize(), function(response) {
          	    	  
        				var message = response.message;
        				
        				if(message.indexOf("successfully") > -1){
        					$('#lbl_message').text(message);
        					$('#lbl_message').removeClass( "display-none alert-danger" ).addClass( "alert-success" );
        					$('form.idealforms').idealforms('reset');
    				        
        				}
        				else{
        					$('#lbl_message').text(message);
        					$('#lbl_message').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
        				}
        				$("html, body").animate({ scrollTop: 0 }, "slow");
          	      }, 'json');
        	    }    
        	  }
        });

        $('form.idealforms').find('input, select, textarea').on('change keyup', function() {
          $('#invalid').hide();
        });


        $( "#confirm_password").on( "keydown", function(event) {
  	      if(event.which == 13) {
  	    	  $( "#cmdRegister" ).click();
  	      }
        
        });
      </script>
   </body>
</html>

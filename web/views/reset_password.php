<!DOCTYPE HTML>
<html>
   <head>
   <title>Reset Password</title>
   <link rel="stylesheet"
	href="http://necolas.github.io/normalize.css/2.1.3/normalize.css">
<link rel="stylesheet" href="web/css/jquery.idealforms.css">
      <script src="web/js/commons.js"></script>
           
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
         <div class="login-reg-container">
            <header class="major">
						<h2>RESET PASSWORD</h2>
						
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
   <div class="12u">
                  <div id="lbl_message" class="alert display-none" >
</div>
</div></div>

  <div class="row uniform">
                     <div class="6u 12u(3)">
                     	<div class="field">
                     	<input type="text" name="resetpassword" value="resetpassword"
                           style="display:none;"/>
    <span class="error"></span>
  </div>
                     </div>
                  </div>
     
         
                  <div class="row uniform">
                     <div class="12u">
                     	<div class="field">
                     	 <input type="password" name="password" id="password" value="" placeholder="Password" />
    <span class="error"></span>
  </div>
                     </div>
                  </div>
                  
                  <div class="row uniform">
                     <div class="12u">
                     	<div class="field">
                     	 <input type="password" name="confirmPassword" id="confirmPassword" value="" placeholder="Confirm Password" />
    <span class="error"></span>
  </div>
                     </div>
                  </div>
                  
  <!-- Button -->

  <button type="submit" id="cmdResetPassword" name="resetPassword" value="resetPassword">Reset Password</button>

</form>
            </section>
         </div>
      </section>
      
    
<script src="web/js/out/jquery.idealforms.js"></script>

      <script type="text/javascript">



      $('form.idealforms').idealforms({
          silentLoad: true,
          iconHtml: false,
          rules: {
            'password': 'required',
            'confirmPassword': 'required equalto:password',
          },
        	onSubmit: function(invalid, e) {
        	    e.preventDefault();

        	    if (invalid) {
        	      
        	    } else {
        	    	var param = "resetpassword=" + getUrlParameter("resetpassword") + "&key=" + getUrlParameter("key") + "&password=" + $('#password').val();           	    					
            	    $.post('src/AppBundle/Controller/controller_security.php', param, function(response) {
        				var message = response.message;
        				if(message.indexOf("successfully") > -1){
        					$('#lbl_message').text(message);
        					$('#lbl_message').removeClass( "display-none alert-danger" ).addClass( "alert-success" );
        				}
        				else{
        					$('#lbl_message').text(message);
        					$('#lbl_message').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
        				}
          	      }, 'json');
        	    }    
        	  }
        });

        $('form.idealforms').find('input, select, textarea').on('change keyup', function() {
          $('#invalid').hide();
        });
        
                
      </script>
   </body>
</html>

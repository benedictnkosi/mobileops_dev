<!DOCTYPE HTML>
<html>
   <head>
   <title>Login</title>
   <link rel="stylesheet"href="http://necolas.github.io/normalize.css/2.1.3/normalize.css">
	<link rel="stylesheet" href="web/css/jquery.idealforms.css">
<script src="web/js/facebook.js"></script>
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
         <div class="login-container">
            <header class="major">

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
                     	<div class="field">
                     	 <fb:login-button size="large" scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>
    <span class="error"></span>
  </div>
                     </div>
                  </div>
                  
         <div class="row uniform">
                     <div class="12u">
                     	<div class="field">
                     	 <input type="email" name="email" id="email" value=""
                           placeholder="Email Address"/>
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
                     	<label class="ideal-radiocheck-label">Remember me
                     	<input type="checkbox" class="skills_checkbox_item" name="rememberme" value="yes">
                     	</label>
                     </div>
                  </div>
                  
                  <div class="row uniform">
                     <div class="12u" style="text-align: center;">
                     	 <!-- Button -->
  <p style="text-align: center;font-size: 10px!important;">* You have 3 attempts to login. On your 3rd failed attempt, your account will be locked.</p>
  <button type="submit" id="cmdLogin" name="login" value="login" onclick="this.form.submited=this.value;" style="float: none;">Login</button>
  <button type="submit" id="cmdResetPassword" name="resetPassword" value="resetPassword" onclick="this.form.submited=this.value;" style="float: none;">Reset Password</button>
  
  <button type="submit" id="cmdTwitter" name="twitter" value="twitter" onclick="this.form.submited=this.value;" class="display-none">Twitter</button>

                     </div>
                  </div>
                  
                  
 
 <div class="row uniform">
                     <div class="6u 12u(3)">
                     	<div class="field">
                     	<input type="text" name="login" value="login"
                           style="display:none;"/>
    <span class="error"></span>
  </div>
                     </div>
                  </div>
                  

                  
</form>
            </section>
         </div>
      </section>
      
      <script
	src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<script src="web/js/out/jquery.idealforms.js"></script>

      <script type="text/javascript">

      $(document).ready(function() {
    	  if("twittererror".indexOf(getUrlParameter("login")) > -1){
    		  $('#lbl_message').text("Twitter login failed, please try again");
			  $('#lbl_message').removeClass( "display-none alert-danger" ).addClass( "alert-success" );
    	  }
    	});
  	

      $('form.idealforms').idealforms({
    	  iconHtml: false,
          silentLoad: true,
          rules: {
            
          },
        	onSubmit: function(invalid, e) {
        	  $('#lbl_message').addClass( "display-none" );
        	    e.preventDefault();

        	    if (invalid) {
        	      
        	    } else {
            	    if (this.$form[0].submited == 'login'){
            	    	var x = $('#password').val();
            	        if(x == null || x == '') {
            	        	$('#lbl_message').text("Password Required");
        					$('#lbl_message').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
        					//return;
                	    }
            	        $.post('src/AppBundle/Controller/controller_security.php', this.$form.serialize(), function(response) {
            				var message = response.message;
            				
            				if(message.indexOf("successfully") > -1){
            					var user_role = response.user_role;
                				
            					//sessionStorage.mobileops_email_address = response.email_address;
            					//sessionStorage.mobileops_firstname = response.firstname;
            					//sessionStorage.mobileops_surname = response.surname;
            					//sessionStorage.mobileops_phone_number = response.phone_number;
            					//sessionStorage.mobileops_user_id = response.user_id;
            					
            					if(user_role.indexOf("CLIENT") > -1){
            						//sessionStorage.mobileops_user_role = "CLIENT";
            						window.location.href = "index.php?mybookings";
                				}else if(user_role.indexOf("PARTNER") > -1){
                					//sessionStorage.mobileops_user_role = "PARTNER";
                					window.location.href = "index.php?mybookings";
                				}else if(user_role.indexOf("ADMINISTRATOR") > -1){
                					//sessionStorage.mobileops_user_role = "ADMINISTRATOR";
                					window.location.href = "index.php";
                				}
            				}
            				else{
            					$('#lbl_message').text(message);
            					$('#lbl_message').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
            				}
              	      }, 'json');
                	      
            	    }else if (this.$form[0].submited == 'resetPassword'){
                	    if($('#email').val().trim().length < 1){
                	    	$('#lbl_message').text("Please provide email address");
         					$('#lbl_message').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
         					return;
                	    }
            	    	 $.post('src/AppBundle/Controller/controller_security.php', "sendPasswordResetEmail=" + $('#email').val(), function(response) {
             				var message = response.message;
             				
             				if(message.indexOf("Successfully") > -1){
             					$('#lbl_message').text(message);
             					$('#lbl_message').removeClass( "display-none alert-danger" ).addClass( "alert-success" );
             				}
             				else{
             					$('#lbl_message').text(message);
             					$('#lbl_message').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
             				}
               	      }, 'json');
            	    } else if (this.$form[0].submited == 'twitter'){
            	    	$.post('src/AppBundle/Controller/controller_security.php', "getTwitterURL=true", function(response) {
             				var message = response.message;

             				if(message.indexOf("oauth_token=") > -1){
             					//sessionStorage.mobileops_user_role = "CLIENT";
             					
             					window.location.assign(message)
             				}
             				else{
             					$('#lbl_message').text(message);
             					$('#lbl_message').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
             				}
               	      }, 'json');
            	    }
            	    
            	   
        	    }    
        	  }
        });

        $('form.idealforms').find('input, select, textarea').on('change keyup', function() {
          $('#invalid').hide();
        });


        $( "#password").on( "keydown", function(event) {
  	      if(event.which == 13) {
  	    	  $( "#cmdLogin" ).click();
  	      }
  	    });


        $( "#email").on( "keydown", function(event) {
    	      if(event.which == 13) {
    	    	  $( "#cmdLogin" ).click();
    	      }
    	    });

        $('#facebook-button').click(function(event){
    	    event.preventDefault();
    	    alert("da");
    	    fblogin(url_to_redirect)
    });

        $('#twitter-button').click(function(event){
    	    event.preventDefault();
    	    $('#cmdTwitter').click();
    });


        function fblogin(url_to_redirect) {
        	  FB.login(function(response) {
        	     if (response.authResponse) {
        	        top.location.href = url_to_redirect;
        	     }
        	     else {
        	     }
        	 }, {scope:'public_profile,email'});
        	}

    	
        
      </script>
   </body>
</html>

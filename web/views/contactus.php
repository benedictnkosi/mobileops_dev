<!DOCTYPE HTML>

<html>
<head>
<link rel="stylesheet"
	href="http://necolas.github.io/normalize.css/2.1.3/normalize.css">
<link rel="stylesheet" href="web/css/jquery.idealforms.css">
<script src="web/js/events/events_contactus.js"></script>



<style type="text/css">
form.idealforms textarea {
	width: 100%;
}
</style>
</head>
<body class="landing">

<!-- Two -->


<section id="one" class="wrapper style1">
<div class="container"><header class="major">
<h2>SEND US A MESSAGE</h2>

</header> <!-- Form --> <section>
<form class="idealforms" novalidate action="/" method="post">

<div class="row uniform">
<div class="12u">
<div id="lbl_message" class="alert display-none"></div>
</div>
</div>

<!-- Text -->
<div class="row uniform">

<div class="12u"><input type="text" name="send_message"
	value="send_message" style="display: none;" />
<div class="select-wrapper"><select name="message_type"
	id="message_type">
	<option value="Query">Query</option>
	<option value="Compliment">Compliment</option>
	<option value="Complaint">Complaint</option>
</select></div>
</div>
</div>

<div class="row uniform">
<div class="6u 12u(3)">
<div class="field"><input type="text" name="firstname" id="firstname"
	value="" placeholder="Name" /> <span class="error"></span></div>
</div>
<div class="6u 12u(3)">
<div class="field"><input type="text" name="surname" id="surname"
	value="" placeholder="Surname" /> <span class="error"></span></div>
</div>
</div>



<div class="row uniform">
<div class="6u 12u(3)">
<div class="field"><input type="email" name="email" id="email" value=""
	placeholder="Email" /> <span class="error"></span></div>
</div>
<div class="6u 12u(3)">
<div class="field"><input type="text" name="mobile_number"
	id="mobile_number" value="" placeholder="Phone Number" /> <span
	class="error"></span></div>
</div>
</div>

<div class="row uniform">
<div class="12u">
<div class="field"><textarea name="message" id="message" placeholder="Enter your message" rows="6"></textarea> <span
	class="error"></span></div>
</div>
</div>

<!-- Button -->
<button type="submit" id="cmdSendMessage">Send Message</button>
</form>

</section> <script src="web/js/out/jquery.idealforms.js"></script> <script
	type="text/javascript">


      $('form.idealforms').idealforms({
          silentLoad: true,
          rules: {
            'firstname': 'required',
            'surname': 'required',
            'email': 'required email',
            'message': 'required minmax:10:500',
            'mobile_number': 'required number min:10 max:10',
          },
          onSubmit: function(invalid, e) {
      	    e.preventDefault();
      	  $('#lbl_message').addClass( "display-none" );
      	    if (invalid) {
      	      
      	    } else {
      	    	$.post('src/AppBundle/Controller/controller_contactus.php', this.$form.serialize(), function(response) {  
      	    		var message = response.message;
    				
    				if(message.indexOf("Successfully") > -1){
    					$('#lbl_message').text(message);
    					$('#lbl_message').removeClass( "display-none alert-danger" ).addClass( "alert-success" );
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

      
      </script>

</body>
</html>

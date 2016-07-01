<!DOCTYPE HTML>

<html>
<head>
<title>Request Service</title>
<link rel="stylesheet"
	href="http://necolas.github.io/normalize.css/2.1.3/normalize.css">
<link rel="stylesheet" href="web/css/jquery.idealforms.css">
<script src="web/js/events/events_newservicerequest.js"></script>



<style type="text/css">
form.idealforms textarea {
	width: 100%;
}
</style>
</head>
<body class="landing">

	<!-- Two -->


	<section id="one" class="wrapper style1">
		<div class="container">
			<header class="major">
				<h2>REQUEST NEW SERVICE</h2>

			</header>
			<!-- Form -->
			<section>
				<form class="idealforms" novalidate action="/" method="post">

					<div class="row uniform">
						<div class="12u">
							<div id="lbl_message" class="alert display-none"></div>
						</div>
					</div>

					<!-- Text -->
					<div class="row uniform"></div>

					<div class="row uniform">
						<div class="6u 12u(3)">
							<input type="text" name="request_service" value="request_service"
								style="display: none;" />
							<div class="select-wrapper">
								<select name="service_category" id="service_category">
								</select>
							</div>
						</div>

						<div class="6u 12u(3)">
							<div class="field">
								<input type="text" name="service_name" id="service_name"
									value="" placeholder="Service Name" max-length="50" /> <span
									class="error"></span>
							</div>
						</div>

					</div>

					<div class="row uniform">
						<div class="12u">
							<div class="field">
								<textarea name="service_description" id="service_description"
									placeholder="Service Description" rows="6" max-length="500"></textarea>
								<span class="error"></span>
							</div>
						</div>
					</div>

					<div class="row uniform">
						<div class="6u 12u(3)">
							<div class="field">
								<button type="submit" id="cmdSubmit">Submit</button>
							</div>
						</div>

					</div>

					<!-- Button -->

				</form>

			</section>
			<script src="web/js/out/jquery.idealforms.js"></script>
			<script type="text/javascript">


      $('form.idealforms').idealforms({
          silentLoad: true,
          iconHtml: false,
          rules: {
            'service_name': 'required',
            'service_description': 'required',
          },
          onSubmit: function(invalid, e) {
      	    e.preventDefault();
      	  $('#lbl_message').addClass( "display-none" );
      	    if (invalid) {
      	      
      	    } else {
      	    	if($('#service_category').val().localeCompare('DEFAULT')==0){
      	    		$('#lbl_message').text('Please select service category');
					$('#lbl_message').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
					$("html, body").animate({ scrollTop: 0 }, "slow");
      	  		return;
      	  	}
      	    	$.post('src/AppBundle/Controller/controller_services.php', this.$form.serialize(), function(response) {  
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

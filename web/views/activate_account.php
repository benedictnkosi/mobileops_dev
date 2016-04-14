<!DOCTYPE HTML>
<html>
<head>
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

.row.uniform>*>:first-child {
	width: 100%;
}
</style>


</head>
<body class="landing">
<!-- one -->
<section id="one" class="wrapper style1">
<div class="container"><header class="major">
<h2>Account Activation</h2>

<form class="idealforms" novalidate action="/" method="post"><!-- Text -->

<div class="row uniform">
<div class="12u">
<div id="lbl_message" class="alert display-none"></div>
</div>
</div>
</form>
</header> <!-- Form --> <section> </section></div>
</section>

<script
	src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<script src="web/js/out/jquery.idealforms.js"></script>


<script type="text/javascript">

$(document).ready(function() {
	var param = "activateaccount=" + getUrlParameter("activateaccount") + "&key=" + getUrlParameter("key"); 
	$.post('src/AppBundle/Controller/controller_security.php', param, function(response) {
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
});

      $('form.idealforms').idealforms({
          silentLoad: true,

        });

        $('form.idealforms').find('input, select, textarea').on('change keyup', function() {
          $('#invalid').hide();
        });
        
                
      </script>
</body>
</html>

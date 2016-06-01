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
<script src="web/js/events/events_pricelist.js"></script>

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

<!-- Two -->
<section id="two" class="wrapper style2">
<div class="container"><header class="major">
<h2>PRICE LIST</h2>
</header> <section>

<form class="idealforms" novalidate action="/" method="post">

<div class="row uniform">
   <div class="12u">
                  <div id="lbl_message" class="alert display-none" >
</div>
</div></div>



<div class="row uniform">
                     <div class="6u 12u(3)">
                     <div class="field">
                    <div class="select-wrapper"><select name="service type" id="dropdown_region">
	<option value="DEFAULT">----SELECT YOUR PROVINCE-----</option>
</select></div></div>
												
												
                     	
                     </div>
                     <div class="6u 12u(3)">	<div class="field">
                    <div class="select-wrapper"><select name="service type" id="dropdown_serviceType">
	<option value="DEFAULT">----SELECT CATEGORY-----</option>
</select></div>

    <span class="error"></span>
  </div></div>
                  </div>


<div id="jsontotable-obj" class="jsontotable"></div>
</form>
</section></div>
</section>
<script type="text/javascript" src="web/js/jquery.jsontotable.min.js"></script>

<script src="web/js/jquery-ui.min.js"></script>

<script src="web/js/out/jquery.idealforms.js"></script>

<script type="text/javascript">

      $('form.idealforms').idealforms({
          silentLoad: true,
          rules: {
          },
        	onSubmit: function(invalid, e) {
        	    e.preventDefault();

        	    if (invalid) {
        	      
        	    } else {
            	    
        	    }    
        	  }
        });

        $('form.idealforms').find('input, select, textarea').on('change keyup', function() {
          $('#invalid').hide();
        });
        
                
      </script>


</body>
</html>

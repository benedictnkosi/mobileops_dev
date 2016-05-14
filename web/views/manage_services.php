<!DOCTYPE HTML>

<html>
<head>
<title>Bookings</title>
<link rel="stylesheet"
	href="http://necolas.github.io/normalize.css/2.1.3/normalize.css">
<link rel="stylesheet" href="web/css/jquery.idealforms.css">
<script src="web/js/events/events_manage_services.js"></script>


   <style>
      .disabled-service{
      	color:red;
      }
      input[type="text"]{
    background: white;
}

   
    </style>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
 
  <script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  </script>
  
</head>
<body class="landing">

<!-- Two -->


<section id="one" class="wrapper style1">
<div class="container-full"><header class="major">
<h2>SERVICES MANAGEMENT</h2>

</header> <!-- Form --> <section>


<div id="tabs">
  <ul>
  <li><a href="#fragment-1">Service Type</a></li>
    <li><a href="#fragment-2">Services</a></li>
    <li><a href="#fragment-3">Region Service</a></li>
    <li><a href="#fragment-4">Region Service Price</a></li>
  </ul>
  
  <div id="fragment-1">
   Service Type
   
   <form class="idealforms" id="form_service_type" novalidate action="/" method="post">

<div class="row uniform">
<div class="12u">
<div id="lbl_message" class="alert display-none"></div>
</div>
</div>
<div class="row uniform">
<div class="6u 12u(3)">
<div class="field"><h3>ALL SERVICE TYPES</h3></div>
</div>
</div>


<div class="row uniform">
<div class="6u 12u(3)">
<div class="field">
              <p class="group" id="p_service_types_checkbox"></p>
              <span class="error"></span>
            </div>
</div>
</div>

</form>

  </div>
  
  
  <!-------------------------------------------------------------------------------------------------->
  
  
  <div id="fragment-2">
     <form class="idealforms" id="form_service" novalidate action="/" method="post">


<div class="row uniform">
<div class="12u">
<div id="lbl_message" class="alert display-none"></div>
</div>
</div>

<div class="row uniform">
<div class="6u 12u(3)">
<div class="field"><h3>ALL SERVICES</h3></div>
</div>
</div>




<div class="row uniform">
<div class="6u 12u(3)">
<div id="partnerServicesDiv"></div>
</div>
</div>

</form>
  </div>
  
  
  <!-------------------------------------------------------------------------------------------------->
  <div id="fragment-3">
  Region Service
  
    <form class="idealforms" id="form_region_service" novalidate action="/" method="post">
    
  <div class="row uniform">
<div class="6u 12u(3)">
<div class="field">
              <label class="main">Service Type for Service:</label>
              <select name="options" id="dropdownRegionTypes">
                
              </select>
              <span class="error"></span>
            </div>
</div>
</div>


<div class="row uniform">
<div class="6u 12u(3)">
<div id="regionsDiv"></div>
</div>
</div>



<div class="row uniform">
<div class="6u 12u(3)">
<div class="field"><button type="submit" id="cmdUpdateServiceTypes" class="display-none">Update Service Type</button></div>
</div>
</div>


</form>
  </div>
  
  <div id="fragment-4">
  Region Service Price
  </div>
  
</div>


</section> 


</section>
      
</body>
</html>

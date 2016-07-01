<!DOCTYPE HTML>

<html>
<head>
<title>Manage Services</title>
<link rel="stylesheet"
	href="http://necolas.github.io/normalize.css/2.1.3/normalize.css">
<link rel="stylesheet" href="web/css/jquery.idealforms.css">
<script src="web/js/events/events_partnerprofile.js"></script>


   <style>
   
   table td {
    padding: 0.1em;
}

label {
    margin: 0;
    font-weight: normal;
}

   form.idealforms .ideal-radiocheck-label {
	display: inline !important;
	padding: .25em 0 !important;
	cursor: pointer;
	clear: none !important;
	float: left;
}
   
   input[type="submit"], input[type="reset"], input[type="button"], .button{
   	font-weight: 400;
    height: 2em;
    line-height: 2em;
   }
   
   td > input[type="text"] {
    height: 2em;
    width:8em;
}

      .disabled-service{
      	color:red;
      }
      input[type="text"]{
    background: white;
}

  <style>
      
      input[type="text"]{
    background: white;
}

    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }
    
    .invoice-box table td{
        
        vertical-align:top;
    }
    
    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }
    
    .invoice-box table tr.top table td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:45px;
        color:#333;
    }
    
    .invoice-box table tr.information table td{
        padding-bottom:40px;
    }
    
    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }
    
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }
    
    .invoice-box table tr.item.last td{
        border-bottom:none;
    }
    
    .invoice-box table tr.total td:nth-child(2){
        border-top:2px solid #eee;
        font-weight:bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }
        
        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
    </style>
    

   
    </style>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
 
 
 
<!-- image upload -->
<script src="/web/js/ajaxupload.js" type="text/javascript"></script>

<link href="web/css/dropzone.css" media="all" rel="stylesheet"
	type="text/css" />

<script src="web/js/dropzone.js"></script>

<!-- LOCATION SCRIPTS -->
<script
	src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="web/js/jquery.geocomplete.js"></script>
 
 
  <script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  </script>
  
</head>
<body class="landing">

<!-- Two -->


<section id="one" class="wrapper style1">
<div class="container"><header class="major">
<h2>PARTNER PROFILE</h2>

</header> <!-- Form --> <section>


<div id="tabs">
  <ul>
  <li><a href="#fragment-1">Profile</a></li>
    <li><a href="#fragment-2">My Services</a></li>
    <li><a href="#fragment-3">Service Prices</a></li>
    <li><a href="#fragment-4">New Service</a></li>
    <li><a href="#fragment-5">Gallery</a></li>
  </ul>
  
  <div id="fragment-1">
   
   <form class="idealforms" id="form_partner_profile" novalidate action="/" method="post">
					<!-- Text -->

					<div class="row uniform">
						<div class="12u">
							<div id="lbl_address_message"
								class="alert display-none alert-danger"></div>
						</div>
					</div>


					<div class="row uniform">
						<div class="12u">
							<div id="lbl_message" class="alert display-none"></div>
						</div>
					</div>

					<div class="row uniform">
						<div class="6u 12u(1)">
							<div class="field">
								<p class="group">
									<label>Mobility:</label> <label><input name="mobility"
										type="radio" value="Walk-In Only">Walk-In Only</label> <label><input
										name="mobility" type="radio" value="Mobile">Mobile</label> <label><input
										name="mobility" type="radio" value="Both">Both</label>
								</p>
								<span class="error"></span>
							</div>
						</div>
					</div>



					<div class="row uniform">
						<div class="6u 12u(3)">
							<div class="field">
								<input type="text" name="savePartnerPersonalDetails" value="partner"
									style="display: none;" /> <input type="text" name="firstname"
									id="firstname" value="" placeholder="First Name" /> <span
									class="error"></span>
							</div>
						</div>
						<div class="6u 12u(3)">
							<div class="field">
								<input type="text" name="surname" id="surname" value=""
									placeholder="Surname" /> <span class="error"></span>
							</div>
						</div>
					</div>


					<div class="row uniform">
						<div class="6u 12u(3)">
							<div class="field">
								<input type="email" name="email" id="email" value=""
									placeholder="Email" disabled="true" /> <span class="error"></span>
							</div>
						</div>
						<div class="6u 12u(3)">
							<div class="field">
								<input type="text" name="mobile_number" id="mobile_number"
									value="" placeholder="Phone Number" /> <span class="error"></span>
							</div>
						</div>
					</div>

					<div class="row uniform">
						<div class="6u 12u(3)">
							<div class="field">
								<input type="text" name="address" id="address" value=""
									placeholder="Street Address e.g. 340 Kent Avenue, Randburg, South Africa" />
								<span class="error"></span>
							</div>
						</div>
						<div class="6u 12u(3)">
							<div class="field">
								<input type="text" name="complex" id="complex" value=""
									placeholder="Complex Name" /> <span class="error"></span>
							</div>
						</div>
					</div>

					<div class="row uniform">
						<div class="6u 12u(1)">
							<div class="field">
								<textarea name="personalNote" cols="100" rows="4"
									placeholder="Tell us about your self" id="txt_personalNote"
									maxlength="200" style="width: 100%;"></textarea>
								<span class="error"></span>
							</div>
						</div>
					</div>

					<div class="row uniform  display-none">
						<div class="6u 12u(3)">

							<div class="field">
								<input name="lat" type="text" value="" class="googleResults"
									id="input_Latitude"> <span class="error"></span>
							</div>
						</div>
						<div class="6u 12u(3)">
							<div class="field">
								<input name="lng" type="text" value="" class="googleResults"
									id="input_Longitude"> <span class="error"></span>
							</div>
						</div>

						<div class="6u 12u(3)">
							<div class="field">
								<input name="administrative_area_level_1" type="text" value=""
									class="googleResults" id="input_province"> <span class="error"></span>
							</div>
						</div>


						<div class="6u 12u(3)">
							<div class="field">
								<input name="locality" type="text" value=""
									class="googleResults" id="input_suburb"> <span class="error"></span>
							</div>
						</div>


						<div class="6u 12u(3)">
							<div class="field">
								<input name="route" type="text" value="" class="googleResults"
									id="input_street_name"> <span class="error"></span>
							</div>
						</div>

						<div class="6u 12u(3)">
							<div class="field">
								<input name="street_number" type="text" value=""
									class="googleResults" id="input_street_number"> <span
									class="error"></span>
							</div>
						</div>


						<div class="6u 12u(3)">
							<div class="field">
								<input name="sublocality" type="text" value=""
									class="googleResults" id="input_city"> <span class="error"></span>
							</div>
						</div>

					</div>



					<!-- Button -->
					<button type="submit" id="cmdSaveDetails">Save Details</button>

				</form>

  </div>
  
  
  <!-------------------------------------------------------------------------------------------------->
  
  
  <div id="fragment-2">
  
  <div class="row uniform">
						<div class="12u">
							<div id="lbl__myservices_message"
								class="alert display-none alert-danger"></div>
						</div>
					</div>
					
					<div id="div_services"></div>		
				

<div class="12u">
<ul class="actions">
	<li><input type="submit" value="SAVE" id="cmd_updateServices" /></li>
</ul>
</div>
  </div>
  
  
  <!-------------------------------------------------------------------------------------------------->
  <div id="fragment-3">
    
    
  <div class="row uniform">
						<div class="12u">
							<div id="lbl__service_prices_message"
								class="alert display-none alert-danger"></div>
						</div>
					</div>
			
	<div id="div_prices"></div>				

<div class="12u">
<ul class="actions">
	<li><input type="submit" value="SAVE" id="cmd_updateServicePrices" /></li>
</ul>
</div>
  </div>
  
  
  <!-------------------------------------------------------------------------------------------------->
  
  
  <div id="fragment-4">
<form class="idealforms" id="form_newService"novalidate action="/" method="post">

					<div class="row uniform">
						<div class="12u">
							<div id="lbl_message_new_service" class="alert display-none"></div>
						</div>
					</div>

					<!-- Text -->
					<div class="row uniform"></div>

					<div class="row uniform">
						<div class="6u 12u(1)">
							<input type="text" name="request_service" value="request_service"
								style="display: none;" />
							<div class="select-wrapper">
								<select name="service_category" id="service_category">
								</select>
							</div>
						</div>

						<div class="6u 12u(1)">
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
  
</div>


 <div id="fragment-5">
<form action="/src/AppBundle/Logic/file_upload.php" class="dropzone"
				id="fileUpload_dropzone"></form>
  
</div>
        
         
          
          
 <div id="newServicePrice_div" class="display-none">
 <h1>Add New Service Price</h1>
 
 
<div class="row uniform">
<div class="6u 12u(3)">
<div class="field">  <select name="options" id="dropdownRegionSerivces">
                
              </select> <span class="error"></span></div>
</div>
<div class="6u 12u(3)">
<div class="field"><input type="text" name="input_service_price" id="input_service_price" value=""
                           placeholder="Price" maxlength="5"/> <span
	class="error"></span></div>
</div>
</div>


          <div class="row uniform">
<div class="6u 12u(3)">
<div class="field">

             <button class="button display-none" type="submit" id="cmdSaveNewServicePrice" name="cmdSaveNewServicePrice" value="Save" >Save Service Price</button>
              <span class="error"></span>
            </div>
</div>
</div>

            </div>
                           
  </div>
  
  

  
  
</div>


</section> 


</section>

</body>
</html>

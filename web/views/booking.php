<!DOCTYPE HTML>
<html>

<head>
<title>New Booking</title>
<script src="web/js/events/events_booking.js"></script>
<!-- accodian -->

<link rel="stylesheet"
	href="//netdna.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

<link rel="stylesheet"
	href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

<link rel="stylesheet" href="web/css/build.css" />

<link rel="stylesheet"
	href="web/css/jquery-ui.css">

<script src="web/js/jquery-ui.js"></script>


<!-- Ideal form-->
<link rel="stylesheet"
	href="web/css/normalize.css">

<link rel="stylesheet" href="web/css/jquery.idealforms.css">

<!-- timepick -->

<link rel="stylesheet" type="text/css"
	href="web/css/jquery.datetimepicker.css"/ >

<script src="web/js/jquery.datetimepicker.full.min.js"></script>

<!-- rating 

<link href="web/css/star-rating.min.css" media="all" rel="stylesheet"
	type="text/css" />

<script src="web/js/star-rating.min.js" type="text/javascript"></script>
-->

<!-- LOCATION SCRIPTS -->      
 <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="web/js/jquery.geocomplete.js"></script>
   

<meta charset=utf-8 />

<style>
.radio-inline input[type=radio]{
	    margin-top: 0.3em;
}

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

</style>

<style>
    
    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
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
    
    
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css"
	rel="stylesheet" type="text/css">


<script>
  $(function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      }
    });
 
    $( "#opener" ).click(function() {
      $( "#dialog" ).dialog( "open" );
    });
  });
  </script>
  
  
</head>

<body class="landing">

<!-- Two -->

<section id="two" class="wrapper style2">

<div class="container booking-container"><header class="major">

<h2 id="booking_heading">BOOK YOUR APPOINTMENT</h2>

</header>


<div class="content">

<div class="idealsteps-container"><nav class="idealsteps-nav"></nav>

<form action="" novalidate autocomplete="off" class="idealforms">

<div class="idealsteps-wrap"><!-- Step 1 --> <section
	class="idealsteps-step">

<h4>PERSONAL DETAILS</h4>

 <div class="row uniform">
   <div class="12u">
                  <div id="lbl_address_message" class="alert display-none alert-danger"  >Address must contains street name and street number
</div>
</div></div>

 <div class="row uniform">
                     <div class="6u 12u(3)">
                     	<div class="field">
                     	
 <input type="text" name="firstname" id="firstname" value=""
                           placeholder="Name"/>
    <span class="error"></span>
  </div>
                     </div>
                     <div class="6u 12u(3)">	<div class="field">
 <input type="text" name="surname" id="surname" value=""
                           placeholder="Surname"/>
    <span class="error"></span>
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
                  
                  <div class="row uniform display-none">
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
	class="googleResults" id="input_city"> <span class="error"></span>
</div>
</div>


<div class="6u 12u(3)">
<div class="field"><input name="sublocality" type="text"
	value="" class="googleResults" id="input_suburb"> <span class="error"></span>
</div>
</div>

<div class="6u 12u(3)">
<div class="field"><input name="provider_name" type="text" id="input_providername"> <span class="error"></span>
</div>
</div>


</div>
<div class="field buttons">
<button  class="next">Next</button>
</div>

                  

</section> <!-- date time --> <section class="idealsteps-step">

<div class="row uniform">
   <div class="12u">
                  <div id="lbl_date_message" class="alert display-none alert-danger"  >Date cannot be in the past.
</div>
</div></div>


<h4>DATE & TIME</h4>
<div class="field"><input id="datetimepicker" type="text"> <span
	class="error"></span></div>
	
	<div class="field buttons">
<button  class="prev">Back</button>
<button  class="next">Next</button>
</div>

</section> <!-- Step sdf --> <section class="idealsteps-step">

 <div class="row uniform">
   <div class="12u">
                  <div id="lbl_service_message" class="alert display-none alert-danger"  >Please select a service
</div>
</div></div>

<h4>SELECT SERVICES FOR YOUR BOOKING</h4>
	
<p>You can only book in the same category</p>

<div id="accordion">

</div>

	<div class="field buttons">
<button  class="prev">Back</button>
<button  class="next">Next</button>
</div>

</section> <section class="idealsteps-step">

 <div class="row uniform">
   <div class="12u">
                  <div id="lbl_message" class="alert display-none alert-danger"  >Please select service provider
</div>
<div id="lbl_location_message" class="alert display-none alert-danger"  >Please select appointment location
</div>

</div></div>

<h4 id="h3_select_partner">SELECT SERVICE PROVIDER</h4>

<div id="bestPartnersDiv"></div>

	<div class="field buttons">
<button  class="prev">Back</button>
<button  class="next">Next</button>
</div>

</section> 


<section class="idealsteps-step">



<div class="invoice-box">
 <div class="row uniform">
   <div class="12u">
                  <div id="lbl_booking_message" class="alert display-none alert-danger"  ></div>
</div></div>

        <table id="invoice_table" cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="web/images/logo.png" style="width:100%; max-width:300px;border-radius: 5px;">
                            </td>
                            
                            <td>
                                Appointment Date: <p id="lbl_date"></p><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            

            
            <tr class="information">
                <td>
                    <h4>CLIENT DETAILS</h4>
                                <p id="personalDetails"></p>
                                <br/>
                                 <h4>SERVICE PROVIDER DETAILS</h4>
                               <p id="lbl_providername"></p>
                               <br/>
                                <p id="lbl_location"></p>
                </td>
                 <td>
                    
                </td>
            </tr>
            
            
            <tr class="heading">
                <td>
                    Service
                </td>
                
                <td>
                    Price
                </td>
            </tr>
           
             <tr class="heading">
                <td>
                    Special Notes
                </td>
                 <td>
                    
                </td>
            </tr>
            
             <tr style="border: none;background-color:white">
                <td>
                    <textarea name=bookingNotes cols="50" rows="4" maxlength="500" 
	placeholder="Special requests and notes" id="txt_bookingNotes"></textarea>
                </td>

            </tr style="border: none;">
            
            <tr>
               
            </tr>
             <tr style="border: none;background-color:white">
                <td>
                    
<button type="submit" onclick="this.disabled=true" class="submit display-none" id="cmdCompleteBooking" style="margin-right: 1em">Complete Booking</button>
        
        
                </td>
            </tr>
            
        </table>
       
       
    </div>

<div class="12u"><section class="feature ">
<div class="field buttons"><label class="main">&nbsp;</label>


</div>
</section></div>


 <div class="row uniform display-none">
<div class="12u">
<div class="field"><input name="booking_time" type="text" value="" id="booking_time"> <span class="error"></span>
</div>
</div>

<div class="12u">
<div class="field"><input name="booking_date" type="text" value="" id="booking_date"> <span class="error"></span>
</div>
</div>

</div>



</div>


</section></div>



</section></div>

<span id="invalid"></span></form>

</div>

</div>


</div>

</section>

<script
	src="web/js/jquery-ui.min.js"></script>

<!--<script src="web/js/out/jquery.idealforms.js"></script>

<script src="web/js/out/jquery.idealforms.min.js"></script>-->

<script>

$("#address").geocomplete({ details: "form" }); 

    
  </script>



</body>


</html>

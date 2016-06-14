<!DOCTYPE HTML>

<html>
<head>
<title>Manage Services</title>
<link rel="stylesheet"
	href="http://necolas.github.io/normalize.css/2.1.3/normalize.css">
<link rel="stylesheet" href="web/css/jquery.idealforms.css">
<script src="web/js/events/events_manage_services.js"></script>


   <style>
   
   input[type="submit"], input[type="reset"], input[type="button"], .button{
   	font-weight: 400;
    height: 2em;
    line-height: 2em;
   }
   
   td > input[type="text"] {
    height: 2em;
    width:7em;
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
   
   <form class="idealforms" id="form_service_type" novalidate action="/" method="post">

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
    
    <form class="idealforms" id="form_region_service" novalidate action="/" method="post">
    
    
<div class="row uniform">
<div class="12u">
<div id="lbl_message" class="alert display-none"></div>
</div>
</div>


  <div class="row uniform">
<div class="6u 12u(3)">
<div class="field">

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
  
  
  <!-------------------------------------------------------------------------------------------------->
  
  
  <div id="fragment-4">

  
  
  <div class="row uniform">
<div class="12u">
<div id="lbl_message_prices" class="alert display-none"></div>
</div>
</div>


  <div class="row uniform">
<div class="6u 12u(3)">
<div class="field">

              <select name="options" id="dropdownPricesRegionTypes">
                
              </select>
              <span class="error"></span>
            </div>
</div>
</div>


  <div class="row uniform">
<div class="6u 12u(1)">
<div class="field">

               <table id="invoice_table" cellpadding="0" cellspacing="0">
            <tr class="heading">
                <td>
                    Service Type
                </td>
                <td>
                    Service Name
                </td>
                
                <td>
                    Price
                </td>
                
                <td>
                    New Price
                </td>
                
                <td>
                    Update
                </td>
                <td>
                    Delete
                </td>
            </tr>
        </table>
              <span class="error"></span>
            </div>
</div>
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

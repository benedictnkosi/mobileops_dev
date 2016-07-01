<!DOCTYPE HTML>

<html>
<head>
<title>New Service Request</title>
<link rel="stylesheet"
	href="http://necolas.github.io/normalize.css/2.1.3/normalize.css">
<link rel="stylesheet" href="web/css/jquery.idealforms.css">
<script src="web/js/events/events_service_requests.js"></script>


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

</head>
<body class="landing">

<!-- Two -->


<section id="one" class="wrapper style1">
<div class="container"><header class="major">
<h2>NEW SERVICE REQUESTS</h2>

</header> <!-- Form --> <section>


<form class="idealforms" novalidate action="/" method="post">
  
  <div class="row uniform">
<div class="12u">
<div id="lbl_message" class="alert display-none"></div>
</div>
</div>



  <div class="row uniform">
<div class="6u 12u(1)">
<div class="field" >

               <table id="serviceRequests_table" cellpadding="0" cellspacing="0" class="invoice-box">
            <tr class="heading">
                <td>
                    Date
                </td>
                <td>
                    Service Category
                </td>
                <td>
                    Service Name
                </td>
                <td>
                    Accept
                </td>
                <td>
                    Reject
                </td>
            </tr>
        </table>
              <span class="error"></span>
            </div>
</div>
</div>
<div id="replacement_service" class="display-none">
<div class="row uniform">
<div class="6u 12u(3)">
<div class="field"><h3>Select service to be used instead of the requested service</h3></div>
</div>
</div>


<div class="row uniform">
<div class="6u 12u(3)">
<div class="select-wrapper"><select name="service_category"
	id="service_category">
</select></div>
</div>

<div class="6u 12u(3)">
<div class="field"><div class="select-wrapper"><select name="service_name"
	id="service_name">
</select></div></div>
</div>



</div>

<div class="row uniform">
<div class="6u 12u(3)">
<div class="field"><a onclick="rejectServiceRequest(event);return false;" href=""  class="button">Reject Service Request</a></div>
</div>
</div>


                           
                          </form> 
</section> 
</section>

<script src="web/js/out/jquery.idealforms.js"></script> <script
	type="text/javascript">


      $('form.idealforms').idealforms({
          silentLoad: true,
          iconHtml: false,
          rules: {
            'firstname': 'required',
            'surname': 'required'
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
    				$("html, body").animate({
    					scrollTop : $(".container").offset().top
    				}, "slow");
        	      }, 'json');
      	    }  
          }
      });

      
      </script>


      
</body>
</html>

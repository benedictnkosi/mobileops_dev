<!DOCTYPE HTML>

<html>
<head>
<title>Booking Details</title>
	<script src="web/js/events/events_bookingdetails.js"></script>
	<script src="web/js/commons.js"></script>
	
      <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
      
      <link rel="stylesheet" type="text/css"
	href="web/css/jquery.datetimepicker.css"/ >

<script src="web/js/jquery.datetimepicker.full.min.js"></script>
      
      
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
    
   </head>
   
	<body class="landing">
				<!-- Two -->
			<section id="two" class="wrapper style2">
	
				<div class="booking-details-container">
				<header class="major">
						<h2>APPOINTMENT DETAILS</h2>
					</header>



<div class="invoice-box">
<div class="row uniform">
   <div class="12u">
                  <div id="lbl_message" class="alert display-none" >
</div>
</div></div>

        <table id="invoice_table" cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="web/images/logo.png" style="width:100%; max-width:300px;border-radius: 5px;">
                            </td>
                            
                            <td style="text-align:left;">
                                Booking Ref: <label id="booking_ref_label"></label><br>
                                Booking Status: <label id="lbl_status"></label><br>
                                Booking Date: <label id="lbl_date"></label><br>
                                
                                
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
             <tr class="top display-none" >
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                              <div class="field " ><input id="datetimepicker" type="text"> <span
	class="error"></span></div>
                            </td>
                            
                            
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <p id="personalDetails"></p>
                            </td>
                            
                            
                        </tr>
                    </table>
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
            
             <tr style="border: none;background-color:white;">
                <td>
                  <p id="bookingnotes"></p>
                </td>

            </tr style="border: none;background-color:white;">
            
            <tr>
               
            </tr>
             <tr style="border: none;background-color:white;" id="tr_buttons">
                <td id="booking-details-buttons">
                   <a id="cancelBooking" href="#" class="button">Cancel Booking</a>
				   <a id="updateBooking" href="#" class="button">Update Booking</a>
                </td>
            </tr>
            
        </table>
       
       
    </div>

</div>
			</section>
			
			<script type="text/javascript">

      

</script>

	</body>
</html>
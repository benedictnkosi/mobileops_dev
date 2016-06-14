<!DOCTYPE HTML>

<html>
<head>
<title>Manage Services</title>
<link rel="stylesheet"
	href="http://necolas.github.io/normalize.css/2.1.3/normalize.css">
<link rel="stylesheet" href="web/css/jquery.idealforms.css">
<script src="web/js/events/events_partner_services.js"></script>


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
<h2>SERVICES PRICES</h2>

</header> <!-- Form --> <section>


<form class="idealforms" novalidate action="/" method="post">
  
  <div class="row uniform">
<div class="12u">
<div id="lbl_message_prices" class="alert display-none"></div>
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
            </tr>
        </table>
              <span class="error"></span>
            </div>
</div>
</div>

                           
                          </form> 
</section> 


</section>
      
</body>
</html>

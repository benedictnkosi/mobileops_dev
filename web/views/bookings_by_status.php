<!DOCTYPE HTML>

<html>
<head>
<title>Bookings</title>
<link rel="stylesheet"
	href="http://necolas.github.io/normalize.css/2.1.3/normalize.css">
<link rel="stylesheet" href="web/css/jquery.idealforms.css">
<script src="web/js/events/events_bookings_by_status.js"></script>


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
        max-width: 6em;
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
    
    .invoice-box {
    border: 1px solid #eee;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
    color: #555;
    font-family: "Helvetica Neue","Helvetica",Helvetica,Arial,sans-serif;
    font-size: 16px;
    line-height: 24px;
    margin: auto;
    padding: 30px;
    width: 100%;
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
        
        .invoice-box table tr{
           padding-bottom:5em;
        }
        

    }
    </style>
    
</head>
<body class="landing">

<!-- Two -->


<section id="one" class="wrapper style1">
<div class="container-full"><header class="major">
<h2>BOOKINGS BY STATUS</h2>

</header> <!-- Form --> <section>
<div class="invoice-box">
<table id="bookings_table" cellpadding="0" cellspacing="0">
            <tr class="heading">
                <td>
                    Ref
                </td>
                <td>
                    Full Name
                </td>
                <td>
                    Mobile
                </td>
                <td>
                    Start Time
                </td>
                <td>
                    Date Booked
                </td>
                 <td>
                    <select name="service type" id="dropdown_status"><option value="DEFAULT">---SELECT STATUS---</option>
	
</select>
                </td>
                 <td>
                    Action
                </td>
            </tr>
        </table>
        </div>
</section> 

</body>
</html>

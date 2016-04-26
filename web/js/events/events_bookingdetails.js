// JavaScript Document

$(document).ready(function() {
	if (!sessionStorage.mobileops_email_address) {
		if(getCookie("mobileops") == null){
			window.location.href = "/index.php?logout";
		}else{
			saveCookieToSession();
		}
	}
	
	var isClientloggedIn = true;
	getBookingDetails();
	
	$('#cancelBooking').click(function(event){
	    event.preventDefault();
	    cancelBooking();
});
	
	$('#updateBooking').click(function(event){
	    event.preventDefault();
	    updateBooking();
});
	
});


function intialiseDateTimePicker(bookignDate, bookingTime){
	$('#datetimepicker').datetimepicker({

		
		  //value:'19.10.2015 09:00',
		  defaultDate:bookignDate + ' 00:00',
		  defaultTime:bookingTime,
		  format:'d.m.Y H:i',
		  inline:true,
		  lang:'ru',
		  minDate:'0',

		  allowTimes:[

		              '07:00', '07:30', '08:00', '08:30','09:00', '09:30','10:00', '10:30','11:00', '11:30','12:00', '12:30','13:00', '13:30',

		              '14:00', '14:30','15:00', '15:30','16:00', '16:30','17:00', '17:30','18:00', '18:30','19:00', '19:30','20:00', '20:30',

		              '21:00',

		             ],
		             onSelectTime: function(dp, $input) {
			 			 sessionStorage.mobileops_seletedBookingTime = dp.dateFormat('H:i');
			 			$('#booking_time').val(dp.dateFormat('H:i'));
		            	 },

		  			onSelectDate: function(dp, $input) {
		            		 sessionStorage.mobileops_seletedBookingDate = dp.dateFormat('Y/m/d');
		            		 $('#booking_date').val(dp.dateFormat('Y/m/d'));
		 	            	 },

		            	 onGenerate: function(dp, $input) {
		 		            	 //alert(dp.dateFormat('Y/m/d'));
			            		 sessionStorage.mobileops_seletedBookingDate = dp.dateFormat('Y/m/d');
			            		 sessionStorage.mobileops_seletedBookingTime = dp.dateFormat('H:i');
			            		 $('#booking_time').val(dp.dateFormat('H:i'));
			            		 $('#booking_date').val(dp.dateFormat('Y/m/d'));
			 	            	 },

		});
}


function updateBooking(){
	$.ajax({
		type : 'POST',
		url : 'src/AppBundle/Controller/controller_booking.php',
		 data: {"updateBooking" : getUrlParameter("bookingdetails"),
			 "client_name":input_client_name.value,
			 "client_surname":input_client_surname.value,
			 "client_email_address":input_client_email_address.value,
			 "client_mobile_number":input_client_mobile_number.value,
			 "seletedBookingDate":sessionStorage.mobileops_seletedBookingDate,
			 "seletedBookingTime":sessionStorage.mobileops_seletedBookingTime,
		
	},
		 dataType : "json",
		success : function(response) {
			var message = response.message;
			if(message.indexOf("Successfully ") > -1){
				$('#lbl_message').text(message);
				$('#lbl_message').removeClass( "display-none alert-danger" ).addClass( "alert-success" );
			}else{
				$('#lbl_message').text(message);
				$('#lbl_message').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
			}
			$("html, body").animate({ scrollTop: $(".invoice-box").offset().top}, "slow");
	},
	});
}



function cancelBooking(){
	$.ajax({
		type : 'POST',
		url : 'src/AppBundle/Controller/controller_booking.php',
		 data: {"cancelBooking" : getUrlParameter("bookingdetails")}, 
		 dataType : "json",
		success : function(response) {
			var message = response.message;
			if(message.indexOf("Successfully ") > -1){
				$('#lbl_message').text(message);
				$('#lbl_message').removeClass( "display-none alert-danger" ).addClass( "alert-success" );
				
				$("#lbl_status" ).empty();
				var element = document.getElementById("lbl_status");
				element.appendChild(document.createTextNode("Cancelled"));
				
			}else{
				$('#lbl_message').text(message);
				$('#lbl_message').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
			}
			$("html, body").animate({ scrollTop: $(".invoice-box").offset().top}, "slow");
	},
	});
}


function addServicesRows(services){
	$('.serviceRow').remove();
	var pricesString = "";
	var totalPrice = 0;
	var rowNum = 4;
	var table = document.getElementById("invoice_table");
	
	for (i = 0; i < services.length; i++){
		var row = table.insertRow(rowNum);
		row.className = "serviceRow";
		rowNum += 1;
		var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		
		cell1.innerHTML = services[i][0];
		cell2.innerHTML = "R" + parseFloat(Math.round(services[i][1] * 100) / 100).toFixed(2);
		
		//pricesString = pricesString + response.message[i][0] + ": R" + parseFloat(Math.round(response.message[i][1] * 100) / 100).toFixed(2) + "<br/>";
		totalPrice = totalPrice + parseInt(services[i][1]);
	}
	//$("#totalAmountDueDiv").html(pricesString + "<br/>Tatal : R" + parseFloat(Math.round(totalPrice * 100) / 100).toFixed(2));
	var row = table.insertRow(rowNum);
	row.className = "serviceRow";
	var cell1 = row.insertCell(0);
	var cell2 = row.insertCell(1);
	
	cell1.innerHTML = "";
	cell2.innerHTML = "Total: R" + parseFloat(Math.round(totalPrice * 100) / 100).toFixed(2);
}



function getBookingDetails(){
	
	$.ajax({
		type : 'GET',
		url : 'src/AppBundle/Controller/controller_booking.php?getBookingDetails=' + getUrlParameter("bookingdetails"),
		data : 'bookingId=' + getUrlParameter("bookingdetails"),
		dataType : "json",
		success : function(data) {
			//initialise calandar
			
			//2016-04-15 09:00
			//15.4.2016
			var dateTimeParts = data['booking_date'].split(" ");
			var dateOnlyParts = dateTimeParts[0].split("-");
			var d = new Date();
			var dateHolder = dateOnlyParts[2] + '.' + dateOnlyParts[1] + '.' + dateOnlyParts[0];
			intialiseDateTimePicker(dateHolder.toString(), dateTimeParts[1]);
			
			
			$('#name').val(data['name']);
			$( "#personalDetails" ).empty();
			
			var element = document.getElementById("personalDetails");
			
			var h = document.createElement("H3")                // Create a <h1> element
			var t = document.createTextNode("CLIENT DETAILS"); 
			h.appendChild(t);      
			
			
			element.appendChild(h);
			element.appendChild(document.createElement("br"));
			
			
			var input_client_name= document.createElement("input");
			input_client_name.type = "text";
			input_client_name.value = data['client_name'];
			input_client_name.id = "input_client_name";
			element.appendChild(input_client_name);
			element.appendChild(document.createElement("br"));
			
			
			var input_client_surname = document.createElement("input");
			input_client_surname.type = "text";
			input_client_surname.value =  data['client_surname'];
			input_client_surname.id = "input_client_surname";
			element.appendChild(input_client_surname);
			element.appendChild(document.createElement("br"));

		
			var input_client_email_address = document.createElement("input");
			input_client_email_address.type = "text";
			input_client_email_address.value = data['client_email_address'];
			input_client_email_address.id = "input_client_email_address";
			element.appendChild(input_client_email_address);
			element.appendChild(document.createElement("br"));
			
			
			var input_client_mobile_number = document.createElement("input");
			input_client_mobile_number.type = "text";
			input_client_mobile_number.value = data['client_mobile_number'];
			input_client_mobile_number.id = "input_client_mobile_number";
			element.appendChild(input_client_mobile_number);
			element.appendChild(document.createElement("br"));

			h = document.createElement("H3")
			t = document.createTextNode("APPOINTMENT ADDRESS"); 
			h.appendChild(t);      
			element.appendChild(h);      
			element.appendChild(document.createElement("br"));
			element.appendChild(document.createTextNode(data['booking_complex']));
			element.appendChild(document.createTextNode(data['booking_address']));
			element.appendChild(document.createElement("br"));
			
			
			
			$("#booking_ref_label" ).empty();
			var element = document.getElementById("booking_ref_label");
			element.appendChild(document.createTextNode(data['booking_ref']));
			
			//selected date
			$( "#lbl_date" ).empty();
			var element = document.getElementById("lbl_date");
			element.appendChild(document.createTextNode(data['booking_date']));
			element.appendChild(document.createElement("br"));
			
			var bookingStatus = "";
			switch(data['booking_status']) {
		    case "BOOKING_ACTIVE":
		    	bookingStatus = "Active";
		        break;
		    case "BOOKING_CANCELLED":
		    	bookingStatus = "Cancelled";
		    	$('#tr_buttons').addClass('display-none')
		        break;
		    default:
		    	bookingStatus =  "Error";
		    	$('#tr_buttons').addClass('display-none')
		    	
			}
			
			$("#lbl_status" ).empty();
			var element = document.getElementById("lbl_status");
			element.appendChild(document.createTextNode(bookingStatus));
			
			//selected services
			var servicesArray = data['booking_services'];
			addServicesRows(servicesArray);
			
			//notes
			$( "#bookingnotes" ).empty();
			var element = document.getElementById("bookingnotes");
			element.appendChild(document.createTextNode(data['booking_notes']));
			
			//selected provider
			
			$( "#partnerDetails" ).empty();
			
			var element = document.getElementById("lbl_providername");
			
			var h = document.createElement("H3")                // Create a <h1> element
			var t = document.createTextNode("SERVICE PROVIDER"); 
			h.appendChild(t);      
			
			
			element.appendChild(h);
			element.appendChild(document.createTextNode(data['provider_name']));

			
			$( "#bookingref" ).text("REF: " + data['booking_ref']);
			$( "#bookingstatus" ).text("STATUS: " + data['booking_status']);
			
	},
	});
	
	
}
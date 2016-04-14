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
});




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
	var rowNum = 3;
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
			$('#name').val(data['name']);
			
			$( "#personalDetails" ).empty();
			
			var element = document.getElementById("personalDetails");
			
			var h = document.createElement("H3")                // Create a <h1> element
			var t = document.createTextNode("CLIENT DETAILS"); 
			h.appendChild(t);      
			
			
			element.appendChild(h);
			element.appendChild(document.createElement("br"));
			
			
			element.appendChild(document.createTextNode(data['client_name'] + " " + data['client_surname']));
			element.appendChild(document.createElement("br"));
			
			element.appendChild(document.createTextNode(data['booking_complex']));
			element.appendChild(document.createElement("br"));
			
			element.appendChild(document.createTextNode(data['client_email_address']));
			element.appendChild(document.createElement("br"));
			
			
			element.appendChild(document.createTextNode(data['client_mobile_number']));
			element.appendChild(document.createElement("br"));
			
			element.appendChild(document.createTextNode(data['booking_address']));
			element.appendChild(document.createElement("br"));
			

			
			$( "#booking_ref_label" ).empty();
			var element = document.getElementById("booking_ref");
			element.appendChild(document.createTextNode(data['booking_ref']));
			
			//selected date
			$( "#lbl_date" ).empty();
			var element = document.getElementById("lbl_date");
			element.appendChild(document.createTextNode(data['booking_date']));
			//element.appendChild(document.createElement("br"));
			
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
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
	if(isClientloggedIn){
		getBookingDetails();
	}
	$('#cancelBooking').click(function(event){
	    event.preventDefault();
	    cancelBooking();
});
});




function cancelBooking(){
	$.ajax({
		type : 'POST',
		url : 'src/controller/controller_bookingdetails.php',
		 data: {"cancelBooking" : getUrlParameter("bookingdetails")}, 
		success : function(data) {
		
	},
	});
}

function getBookingDetails(){
	
	$.ajax({
		type : 'GET',
		url : 'src/controller/controller_bookingdetails.php?getBookingDetails=' + getUrlParameter("bookingdetails"),
		data : 'bookingId=' + getUrlParameter("bookingdetails"),
		dataType : "json",
		success : function(data) {
			$('#name').val(data['name']);
			
			$( "#personalDetails" ).empty();
			
			var element = document.getElementById("personalDetails");
			element.appendChild(document.createTextNode(data['client_name'] + " " + data['client_surname']));
			element.appendChild(document.createElement("br"));
			
			element.appendChild(document.createTextNode(data['booking_complex']));
			element.appendChild(document.createElement("br"));
			
			element.appendChild(document.createTextNode(data['booking_address']));
			element.appendChild(document.createElement("br"));
			
			//selected date
			$( "#lbl_date" ).empty();
			var element = document.getElementById("lbl_date");
			element.appendChild(document.createTextNode(data['booking_date']));
			//element.appendChild(document.createElement("br"));
			
			//selected services
			
			$( "#selectedServices" ).empty();
			
			var element = document.getElementById("selectedServices");
			var servicesArray = data['booking_services'];
			for(var i =0; i < servicesArray.length; i++){
				//element.appendChild(document.createTextNode(servicesArray[i]));
				//element.appendChild(document.createElement("br"));
			}
			
			//notes
			$( "#bookingnotes" ).empty();
			var element = document.getElementById("bookingnotes");
			element.appendChild(document.createTextNode(data['booking_notes']));
			
			//selected provider
			
			$( "#partnerDetails" ).empty();
			
			var element = document.getElementById("lbl_providername");
			element.appendChild(document.createTextNode(data['provider_name']));

			$('#selectedProviderImage').attr("src", "images/partner_profile/profile_" + data['provider_id'] + ".jpg");
			
			$( "#bookingref" ).text("REF: " + data['booking_ref']);
			$( "#bookingstatus" ).text("STATUS: " + data['booking_status']);
			
	},
	});
	
	
}
// JavaScript Document

$(document).ready(function() {
	if (getCookie("mobileops_temp_login") == null) {
		if(getCookie("mobileops")){
			saveCookieToSession();
		}
	}
	
	sessionStorage.mobileops_providerSelected = "";
	
	getBookingDetails();
	getDateChangeReasons();
	
	$('#cancelBooking').click(function(event){
	    event.preventDefault();
	    cancelBooking();
});
	
	
	$('#fetchPartner').click(function(event){
	    event.preventDefault();
	    $('#tr_bestPartners').removeClass( "display-none" ).addClass( "" );
	    getBestPartners();
});
	
	$('#updatePartner').click(function(event){
	    event.preventDefault();
	    changeBookingPartner();
});
	
	
	$('#addBookingNotes').click(function(event){
	    event.preventDefault();
	    addBookingCommentsByClient();
	    
	
});
	
	
	$('#updateDate').click(function(event){
	    event.preventDefault();
	    changeBookingDateTime();
});
	
	$('#changePartnerAndDate').click(function(event){
	    event.preventDefault();
	    changeBookingDateTimeAndPartner();
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
		 data: {"updateBooking" : getUrlParameter("editbooking"),
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
		 data: {"cancelBooking" : getUrlParameter("editbooking")}, 
		 dataType : "json",
		success : function(response) {
			var message = response.message;
			if(message.indexOf("Successfully") > -1){
				
				var bookingStatus = "";
				switch(response['booking_status']) {
			    case "BOOKING_ACTIVE":
			    	bookingStatus = "Active";
			        break;
			    case "BOOKING_CANCELLED":
			    	bookingStatus = "Cancelled";
			    	$('.tr_buttons').addClass('display-none')
			        break;
			    case "BOOKING_AWAITING_PARTNER_CONFIRMATION":
			    	bookingStatus = "Awaiting Partner Confirmation";
			        break;
			    case "BOOKING_AWAITING_CLIENT_CONFIRMATION":
			    	bookingStatus = "Awaiting Client Confirmation";
			        break;
			    case "BOOKING_COMPLETED":
			    	bookingStatus = "Complete";
			    	$('.tr_buttons').addClass('display-none')
			        break;
			    default:
			    	bookingStatus =  "Error";
			    	$('.tr_buttons').addClass('display-none')
				}
				
				$("#lbl_status" ).empty();
				var element = document.getElementById("lbl_status");
				element.appendChild(document.createTextNode(bookingStatus));
				
				$('#lbl_message').text(message);
				$('#lbl_message').removeClass( "display-none alert-danger" ).addClass( "alert-success" );
				
				
				
				$('.tr_buttons').addClass('display-none')
				
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
	var ServicesArray = [];
	for (i = 0; i < services.length; i++){
		var row = table.insertRow(rowNum);
		row.className = "serviceRow";
		rowNum += 1;
		var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		
		cell1.innerHTML = services[i][0];
		ServicesArray.push(services[i][0]);
		
		cell2.innerHTML = "R" + parseFloat(Math.round(services[i][1] * 100) / 100).toFixed(2);
		totalPrice = totalPrice + parseInt(services[i][1]);
	}
	
	sessionStorage.setItem("mobileops_servicesArray", JSON
			.stringify(ServicesArray));
	
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
		url : 'src/AppBundle/Controller/controller_booking.php?getBookingDetails=' + getUrlParameter("editbooking") + "&admin=true",
		data : 'bookingId=' + getUrlParameter("editbooking"),
		dataType : "json",
		success : function(data) {
			//check if booking id found
			
			if(data.status == 2){
				$('#lbl_message').text(data.message);
				$('#lbl_message').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
				$('#invoice_table').addClass('display-none')
				return;
			}
			//initialise calandar
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
			
			
			element.appendChild(document.createTextNode(data['client_name']));
			
			element.appendChild(document.createTextNode(' ' + data['client_surname']));
			element.appendChild(document.createElement("br"));
			
			element.appendChild(document.createTextNode(data['client_email_address']));
			element.appendChild(document.createElement("br"));
			
			element.appendChild(document.createTextNode(data['client_mobile_number']));
			element.appendChild(document.createElement("br"));

			
			h = document.createElement("H3")
			t = document.createTextNode("PARTNER DETAILS"); 
			h.appendChild(t);      
			element.appendChild(h);      
			
			element.appendChild(document.createTextNode("Name: " + data['provider_name']));
			element.appendChild(document.createElement("br"));
			
			h = document.createElement("H3")
			t = document.createTextNode("APPOINTMENT ADDRESS"); 
			h.appendChild(t);      
			element.appendChild(h);
			
			element.appendChild(document.createTextNode(data['booking_complex']));
			element.appendChild(document.createElement("br"));
			element.appendChild(document.createTextNode(data['booking_address']));
			element.appendChild(document.createElement("br"));
			
			//save lat and long to session for when admin wants to get best partners
			sessionStorage.mobileops_lat =data['lat'];
			sessionStorage.mobileops_long = data['lng'];
			
			
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
		    	$('.tr_buttons').addClass( "display-none" );
		    	//$('.tr_buttons').addClass('display-none');
		        break;
		    case "BOOKING_AWAITING_PARTNER_CONFIRMATION":
		    	bookingStatus = "Awaiting Partner Confirmation";
		        break;
		    case "BOOKING_AWAITING_CLIENT_CONFIRMATION":
		    	bookingStatus = "Awaiting Client Confirmation";
		        break;
		    case "BOOKING_COMPLETED":
		    	bookingStatus = "Complete";
		    	$('.tr_buttons').addClass('display-none');
		        break;
		    default:
		    	bookingStatus =  "Error";
		    	$('.tr_buttons').addClass('display-none');
			}
			
			//remove the buttons for partner
			if (getCookie("mobileops_temp_login")) {
				if(getValueInCookie('mobileops_temp_login', 'user_role').localeCompare("PARTNER") == 0 ){
					$('.tr_buttons').addClass('display-none');
				}
			}else{
				$('.tr_buttons').addClass('display-none');
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
			
			var bookingNotes = data['booking_notes'];
			for (i = 0; i < bookingNotes.length; i++){
				element.appendChild(document.createTextNode(bookingNotes[i][1] + ' - '));
				element.appendChild(document.createTextNode(bookingNotes[i][0]));
				element.appendChild(document.createElement("br"));
			}
			
			var element = document.getElementById("addBookingnotes");
			var input_booking_comments= document.createElement("textarea");
			input_booking_comments.type = "text";
			input_booking_comments.id = "input_booking_notes";
			element.appendChild(input_booking_comments);
			

			$("#input_booking_notes").attr('maxlength','100');
			
			$( "#bookingref" ).text("REF: " + data['booking_ref']);
			$( "#bookingstatus" ).text("STATUS: " + data['booking_status']);
			
	},
	});
	
	
}


function getBestPartners(formdata) {
	$("#bestPartnersDiv")
			.load(
					"src/AppBundle/Controller/controller_booking.php?getBestPartners=getBestPartners&skills_array=" + sessionStorage.mobileops_servicesArray + 
					"&lat=" + sessionStorage.mobileops_lat + "&lng=" + sessionStorage.mobileops_long,
					function() {
						$('.selectPartner').click(
								function(event) {
									event.preventDefault();
									$("#selectPartner").bind("click",
											selectPartner(event));
								});

						$(".rating ").rating({
							starCaptions : {
								0 : "Not Rated",
								1 : "Very Poor",
								2 : "Poor",
								3 : "Ok",
								4 : "Good",
								5 : "Very Good"
							},
							starCaptionClasses : {
								1 : "text-danger",
								2 : "text-warning",
								3 : "text-info",
								4 : "text-primary",
								5 : "text-success"
							},
						});
					});
}


//event id is partner + partner id we just need to save the id
function selectPartner(event) {
	var i = event.target.id.toString();
	sessionStorage.mobileops_providerSelected = i.replace("partner", "");
	$('.selectPartner').removeClass("selectedPartner", 1000, "easeInBack");
	$('#' + event.target.id).addClass("selectedPartner");
}

function addBookingCommentsByClient(){
	$.ajax({
		type : 'POST',
		url : 'src/AppBundle/Controller/controller_booking.php',
		 data: {"updateBookingComments" : getUrlParameter("editbooking"),
			 "booking_notes":input_booking_notes.value,
		
	},
		 dataType : "json",
		success : function(response) {
			var message = response.message;
			if(message.indexOf("Successfully ") > -1){
				var myDate = new Date();
				var formateddate = myDate.getFullYear() + "-" +
				('0' + (myDate.getMonth()+1)).slice(-2) + "-" +
				('0' + myDate.getDate()).slice(-2) + " " +
				myDate.getHours() + ":" + myDate.getMinutes() + " - ";
				
				var element = document.getElementById("bookingnotes");
				element.appendChild(document.createTextNode(formateddate));
				element.appendChild(document.createTextNode(input_booking_notes.value));
				element.appendChild(document.createElement("br"));
				input_booking_notes.value = "";
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


function changeBookingDateTimeAndPartner(){
	if($( "#dropdown_reason" ).val().localeCompare("DEFAULT") == 0){
		$('#lbl_message').text("Please select New Booking Time reason");
		$('#lbl_message').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
		$("html, body").animate({ scrollTop: $(".invoice-box").offset().top}, "slow");
		return;
	}
	
	if(sessionStorage.mobileops_providerSelected.localeCompare("") == 0){
			$('#lbl_message').text("Please select New Partner");
			$('#lbl_message').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
			$("html, body").animate({ scrollTop: $(".invoice-box").offset().top}, "slow");
			return;
	}
	
	$.ajax({
		type : 'POST',
		url : 'src/AppBundle/Controller/controller_booking.php',
		 data: {"changeBookingDateTimeAndPartner" : getUrlParameter("editbooking"),
			 "booking_date": sessionStorage.mobileops_seletedBookingDate,
			 "booking_time": sessionStorage.mobileops_seletedBookingTime,
			 "newBookingTimeReason": $( "#dropdown_reason" ).val(),
			 "partner_id"  : sessionStorage.mobileops_providerSelected
	},
		 dataType : "json",
		success : function(response) {
			var message = response.message;
			if(message.indexOf("Successfully ") > -1){
				var bookingStatus = "";
				switch(response['booking_status']) {
			    case "BOOKING_ACTIVE":
			    	bookingStatus = "Active";
			        break;
			    case "BOOKING_CANCELLED":
			    	bookingStatus = "Cancelled";
			    	$('.tr_buttons').addClass('display-none')
			        break;
			    case "BOOKING_AWAITING_PARTNER_CONFIRMATION":
			    	bookingStatus = "Awaiting Partner Confirmation";
			        break;
			    case "BOOKING_AWAITING_CLIENT_CONFIRMATION":
			    	bookingStatus = "Awaiting Client Confirmation";
			        break;
			    case "BOOKING_COMPLETED":
			    	bookingStatus = "Complete";
			    	$('.tr_buttons').addClass('display-none')
			        break;
			    default:
			    	bookingStatus =  "Error";
			    	$('.tr_buttons').addClass('display-none')
				}
				
				$("#lbl_status" ).empty();
				var element = document.getElementById("lbl_status");
				element.appendChild(document.createTextNode(bookingStatus));
				
				
				$( "#lbl_date" ).empty();
				var element = document.getElementById("lbl_date");
				element.appendChild(document.createTextNode(sessionStorage.mobileops_seletedBookingDate + ' ' + sessionStorage.mobileops_seletedBookingTime));
				element.appendChild(document.createElement("br"));
				
				
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


function changeBookingDateTime(){
	if($( "#dropdown_reason" ).val().localeCompare("DEFAULT") == 0){
		$('#lbl_message').text("Please select New Booking Time reason");
		$('#lbl_message').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
		$("html, body").animate({ scrollTop: $(".invoice-box").offset().top}, "slow");
		return;
	}
	
	$.ajax({
		type : 'POST',
		url : 'src/AppBundle/Controller/controller_booking.php',
		 data: {"changeBookingDateTime" : getUrlParameter("editbooking"),
			 "booking_date": sessionStorage.mobileops_seletedBookingDate,
			 "booking_time": sessionStorage.mobileops_seletedBookingTime,
			 "newBookingTimeReason": $( "#dropdown_reason" ).val(),
		
	},
		 dataType : "json",
		success : function(response) {
			var message = response.message;
			if(message.indexOf("Successfully ") > -1){
				var bookingStatus = "";
				switch(response['booking_status']) {
			    case "BOOKING_ACTIVE":
			    	bookingStatus = "Active";
			        break;
			    case "BOOKING_CANCELLED":
			    	bookingStatus = "Cancelled";
			    	$('.tr_buttons').addClass('display-none')
			        break;
			    case "BOOKING_AWAITING_PARTNER_CONFIRMATION":
			    	bookingStatus = "Awaiting Partner Confirmation";
			        break;
			    case "BOOKING_AWAITING_CLIENT_CONFIRMATION":
			    	bookingStatus = "Awaiting Client Confirmation";
			        break;
			    case "BOOKING_COMPLETED":
			    	bookingStatus = "Complete";
			    	$('.tr_buttons').addClass('display-none')
			        break;
			    default:
			    	bookingStatus =  "Error";
			    	$('.tr_buttons').addClass('display-none')
				}
				
				$("#lbl_status" ).empty();
				var element = document.getElementById("lbl_status");
				element.appendChild(document.createTextNode(bookingStatus));
				
				
				$( "#lbl_date" ).empty();
				var element = document.getElementById("lbl_date");
				element.appendChild(document.createTextNode(sessionStorage.mobileops_seletedBookingDate + ' ' + sessionStorage.mobileops_seletedBookingTime));
				element.appendChild(document.createElement("br"));
				
				
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


function changeBookingPartner(){
	if(sessionStorage.mobileops_providerSelected.localeCompare("") == 0){
			$('#lbl_message').text("Please select New Partner");
			$('#lbl_message').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
			$("html, body").animate({ scrollTop: $(".invoice-box").offset().top}, "slow");
			return;
	}
	
		
	var parameters = "changeBookingPartnerByAdmin="  + getUrlParameter('editbooking') + "&partner_id="  + sessionStorage.mobileops_providerSelected;

$.ajax({
type : 'GET',
url : '/src/AppBundle/Controller/controller_booking.php',
data : parameters,
dataType : "json",
success : function(response) {
	if(response.status == 1){
		var bookingStatus = "";
		switch(response['booking_status']) {
	    case "BOOKING_ACTIVE":
	    	bookingStatus = "Active";
	        break;
	    case "BOOKING_CANCELLED":
	    	bookingStatus = "Cancelled";
	    	$('.tr_buttons').addClass('display-none')
	        break;
	    case "BOOKING_AWAITING_PARTNER_CONFIRMATION":
	    	bookingStatus = "Awaiting Partner Confirmation";
	        break;
	    case "BOOKING_AWAITING_CLIENT_CONFIRMATION":
	    	bookingStatus = "Awaiting Client Confirmation";
	        break;
	    case "BOOKING_COMPLETED":
	    	bookingStatus = "Complete";
	    	$('.tr_buttons').addClass('display-none')
	        break;
	    default:
	    	bookingStatus =  "Error";
	    	$('.tr_buttons').addClass('display-none')
		}
		
		$("#lbl_status" ).empty();
		var element = document.getElementById("lbl_status");
		element.appendChild(document.createTextNode(bookingStatus));
		
		
		$('#lbl_message').text(response.message);
		$('#lbl_message').removeClass( "display-none alert-danger" ).addClass( "alert-success" );
	}else{
		$('#lbl_message').text(response.message);
		$('#lbl_message').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
	}
	$("html, body").animate({ scrollTop: $("#lbl_message").offset().top}, "slow");
},
});
}


function getDateChangeReasons(){
	
	var parameters = "getDateChangeReasons=true";

$.ajax({
type : 'GET',
url : '/src/AppBundle/Controller/controller_booking.php',
data : parameters,
dataType : "json",
success : function(response) {
	data = response.ChangeDateReason;
	
	if(response.status == 2){
		return;
	}
	
	for (i = 0; i < data.length; i++) { 
	    $('#dropdown_reason').append($('<option>', { 
	        value: data[i],
	        text : data[i] 
	    }))
	}
},
});
}


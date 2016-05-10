// JavaScript Document

$(document).ready(function() {
	if (getCookie("mobileops_temp_login") == null) {
		if(getCookie("mobileops") == null){
			window.location.href = "/index.php?logout";
		}else{
			saveCookieToSession();
		}
	}
	
	$( "#dropdown_status" ).change(function() {
		getBookingByStatus();
		});
	
	
	if(getValueInCookie('mobileops_temp_login', 'user_role').localeCompare("ADMINISTRATOR") !== 0){
		window.location.href = "/index.php";
	}
	
	getBookingStatus();
	
});


function addBookingsRows(bookings){
	$('.bookingRow').remove();
	var rowNum = 1;
	var table = document.getElementById("bookings_table");
	
	for (i = 0; i < bookings.length; i++){
		var row = table.insertRow(rowNum);
		row.className = "bookingRow";
		rowNum += 1;
		var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		var cell3 = row.insertCell(2);
		var cell4 = row.insertCell(3);
		var cell5 = row.insertCell(4);
		var cell6 = row.insertCell(5);
		var cell7 = row.insertCell(6);
		
		
		cell1.innerHTML = bookings[i][0];
		cell2.innerHTML =  bookings[i][1];
		cell3.innerHTML =  bookings[i][2];
		cell4.innerHTML =  bookings[i][3];
		cell5.innerHTML =  bookings[i][4];
		cell6.innerHTML =  bookings[i][5];
		cell7.innerHTML =  '<a href="/index.php?editbooking=' + bookings[i][0] + '">EDIT</a>';
	}
}



function getBookingByStatus(){
	if($( "#dropdown_status" ).val().localeCompare("DEFAULT") == 0){
		$('.bookingRow').remove();
		return;
	}
	
	$('.bookingRow').remove();
	
	$.ajax({
		type : 'GET',
		url : 'src/AppBundle/Controller/controller_booking.php?getBookingViewByStatus=' + $( "#dropdown_status" ).val(),
		dataType : "json",
		success : function(data) {
			//check if booking id found
			
			if(data.status == 2){
				$('#lbl_message').text(data.message);
				$('#lbl_message').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
				$('#invoice_table').addClass('display-none')
				return;
			}

			var bookingsArray = data['bookings'];
			addBookingsRows(bookingsArray);
			
	},
	});
}


function getBookingStatus(){
	
	var parameters = "getBookingStatus=true";

$.ajax({
type : 'GET',
url : '/src/AppBundle/Controller/controller_booking.php',
data : parameters,
dataType : "json",
success : function(response) {
	data = response.bookingStatus;
	
	if(response.status == 2){
		return;
	}
	
	for (i = 0; i < data.length; i++) { 
	    $('#dropdown_status').append($('<option>', { 
	        value: data[i],
	        text : data[i] 
	    }))
	}
},
});
}


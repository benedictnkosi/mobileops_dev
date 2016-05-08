// JavaScript Document

$(document).ready(function() {
	if (getCookie("mobileops_temp_login") == null) {
		if(getCookie("mobileops") == null){
			//if user just logged in sometimes the system checks for the cookie before its created
			var referrer = document.referrer;
			if(referrer.localeCompare("http://localhost/index.php?login") !== 0){
				window.location.href = "/index.php?logout";
			}else if(referrer.localeCompare("http://localhost/index.php?login") == 0 && sessionStorage.loggedin){
				window.location.href = "/index.php?logout";
			}else{
				sessionStorage.loggedin = 1;
			}
		}
	}

	
    // page is now ready, initialize the calendar...

	if ($(window).width() > 480) {
		$('#calendar').fullCalendar({
			header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,basicWeek,agendaDay'
		},
		editable: false,
		eventLimit: true, // allow "more" link when too many events
		defaultView: 'agendaDay',
		minTime: "07:00:00",
		maxTime: "23:59:00",
		events: 'src/AppBundle/Controller/controller_booking.php?getBookingsInCalender=true',
		timeFormat: 'H:mm',
		});
		}else{
			getCalendarEvents();
		}
});

function getCalendarEvents(){
	$
	.ajax({
		type : 'GET',
		url : 'src/AppBundle/Controller/controller_booking.php?getBookingsInCalender=true&',
		dataType : "json",
		success : function(response) {
			var events = response;
		
			var calendar_list = document.getElementById("calendar_list");
			//only display the latest 10 for the phones
			for (i = 0; i < 10; i++) {
				
				var p = document.createElement('p');
				p.className = "bookings_list";
				p.appendChild(document.createTextNode(events[i]['booking_ref']));
				p.appendChild(document.createElement("br"));
				p.appendChild(document.createTextNode("Services: " +events[i]['services']));
				p.appendChild(document.createElement("br"));
				p.appendChild(document.createTextNode('Start: ' + events[i]['start']));
				p.appendChild(document.createElement("br"));
				
				var href = document.createElement('a');
				href.href = "/index.php?bookingdetails=" + events[i]['id'] + "&uuid=" + events[i]['uuid'];
				href.appendChild(p);
				calendar_list.appendChild(href);

			}
			
			calendar_list.appendChild(document.createTextNode("Please go to the desktop website or rotate the screen and refresh page to see more bookings"));
			
		},

	});
}
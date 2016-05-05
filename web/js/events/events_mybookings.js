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
	//getCalendarEvents();
});
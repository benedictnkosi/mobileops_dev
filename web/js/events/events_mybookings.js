// JavaScript Document

$(document).ready(function() {
	if (getCookie("mobileops_temp_login") == null) {
		if(getCookie("mobileops") == null){
			console.log('mobileops_temp_login and mobileops are null');
			window.location.href = "/index.php?logout";
		}else{
			//saveCookieToSession();
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
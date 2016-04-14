// JavaScript Document

$(document).ready(function() {
	if (!sessionStorage.mobileops_email_address) {
		if(getCookie("mobileops") == null){
			window.location.href = "/index.php?logout";
		}else{
			saveCookieToSession();
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
	events: 'src/controller/controller_booking.php?getAllUserBookingsWithTime=true',
	timeFormat: 'H(:mm)',
	});
	//getCalendarEvents();
});
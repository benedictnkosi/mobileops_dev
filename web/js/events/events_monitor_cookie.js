// JavaScript Document

$(document).ready(function() {
	listenCookieChange('mobileops_temp_login', function() {
		window.location.href = "/index.php?logout";
	});
});

function listenCookieChange(cookieName, callback) {
    setInterval(function() {
        if (getCookie("mobileops_temp_login") == null) {
        	window.location.href = "/index.php?logout";
        }
    }, 100);
}
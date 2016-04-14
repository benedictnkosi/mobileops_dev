// JavaScript Document

$(document).ready(function() {
	if(getUrlParameter('logout')){
		sessionStorage.removeItem("somekey");
		
		var i = sessionStorage.length;
		while(i--) {
		  var key = sessionStorage.key(i);
		  if (key.indexOf("mobileops") > -1) {
			  sessionStorage.removeItem(key);
		  }
		}
	}
});



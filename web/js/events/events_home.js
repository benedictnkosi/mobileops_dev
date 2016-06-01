// JavaScript Document



$(document).ready(function() {

	

	//prepdata();

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





function prepdata(){

	   $.ajax({

	        type: 'GET',

	        url: 'src/AppBundle/Controller/controller_booking.php?prepdata=true',

	        dataType: "json",

	        success: function(data) {

	            

	        },

	    });



}
// JavaScript Document

$(document).ready(function() {
	if (getCookie("mobileops_temp_login") == null) {
		if(getCookie("mobileops") == null){
			window.location.href = "/index.php?logout";
		}else{
			saveCookieToSession();
		}
	}
	
	getServiceCategories();
});



function getServiceCategories(){

	$('#service_category').empty().append('<option value="DEFAULT">----SELECT CATEGORY-----</option>');
	
	var parameters = "getServiceCategories=true";

$.ajax({
type : 'GET',
url : '/src/AppBundle/Controller/controller_services.php',
data : parameters,
dataType : "json",
success : function(response) {
	data = response.message;
	
	if(response.status == 2){
		$('#lbl_message').text(data);
		$('#lbl_message').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
		$("html, body").animate({ scrollTop: 0 }, "slow");
		return;
	}
	
	for (i = 0; i < data.length; i++) { 
	    $('#service_category').append($('<option>', { 
	        value: data[i],
	        text : data[i] 
	    }))
	}
},
});
}



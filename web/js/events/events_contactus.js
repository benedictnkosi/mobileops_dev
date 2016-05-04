// JavaScript Document

$(document).ready(function() {
	if (getCookie("mobileops_temp_login")) {
		prepopulateForm();
	}
});

function prepopulateForm(){
	
	$.ajax({
		type : 'GET',
		url : 'src/AppBundle/Controller/controller_client_profile.php',
		data : 'getClientProfile=true',
		dataType : "json",
		success : function(response) {

			data = response.message;
			$('#firstname').val(data['name']);
			$('#surname').val(data['surname']);
			$('#email').val(data['email']);
			$('#mobile_number').val(data['mobile_number']);
	},
	});
	
}
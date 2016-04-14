// JavaScript Document

$(document).ready(function() {
	if (!sessionStorage.mobileops_email_address) {
		if(getCookie("mobileops") == null){
			window.location.href = "/index.php?logout";
		}else{
			saveCookieToSession();
		}
	}
	
	if(sessionStorage.mobileops_user_role.localeCompare("CLIENT") !== 0){
		window.location.href = "/index.php";
	}
	
	getClientProfile();
});


function savePersonalDetails(){
	$.post('src/controller/controller_client_profile.php', this.$form.serialize(), function(response) {
		var message = response.message;
		if(message.indexOf("successfully") > -1){
			$('#lbl_message').text(message);
			$('#lbl_message').removeClass( "display-none alert-danger" ).addClass( "alert-success" );
		}else{
			$('#lbl_message').text(message);
			$('#lbl_message').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
		}
		$("html, body").animate({ scrollTop: 0 }, "slow");
	});
}

function getClientProfile(){
	$.ajax({
		type : 'GET',
		url : 'src/controller/controller_client_profile.php',
		data : 'getClientProfile=' + sessionStorage.mobileops_email_address,
		dataType : "json",
		success : function(response) {
			data = response.message;
			$('#firstname').val(data['name']);
			$('#surname').val(data['surname']);
			$('#email').val(data['email']);
			$('#mobile_number').val(data['mobile_number']);
			
			if(data['latitude'] !== null){
				$('#address').val(data['address']);
				$('#complex').val(data['complex']);
				$('#input_Latitude').val(data['latitude']);
				$('#input_Longitude').val(data['longitude']);
				$('#input_street_name').val(data['street_name']);
				$('#input_street_number').val(data['street_number']);
				$('#input_city').val(data['city']);
				$('#input_province').val(data['province']);
				$('#input_suburb').val(data['suburb']);
			}
			
	},
	});
}


// JavaScript Document

$(document).ready(function() {
	if (sessionStorage.mobileops_email_address) {
		prepopulateForm();
	}
	
});

function prepopulateForm(){
	$('#firstname').val(sessionStorage.mobileops_firstname);
	$('#surname').val(sessionStorage.mobileops_surname);
	$('#email').val(sessionStorage.mobileops_email_address);
	$('#mobile_number').val(sessionStorage.mobileops_phone_number);
}
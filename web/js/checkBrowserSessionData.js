$(document).ready(function() {
	//if (!sessionStorage.mobileops_email_address) {
		if (sessionStorage.getItem("mobileops_email_address") === null) {
		if(getCookie("mobileops") == null){
			//window.location.href = "/index.php?logout";
		}
	}
});
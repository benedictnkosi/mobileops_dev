<!DOCTYPE HTML>

<html>
<body class="landing">
Proccessing Twitter login................

<script type="text/javascript">
$(document).ready(function() {
	parameters = "loadTwitterUser=true&oauth_token=" + getUrlParameter("oauth_token") + "&oauth_verifier=" + getUrlParameter("oauth_verifier");
	$.post('src/AppBundle/Controller/controller_security.php', parameters , function(response) {
			var message = response.message;
			
			if(message.indexOf("successfully") > -1){
				/* sessionStorage.mobileops_email_address = response.email_address;
				sessionStorage.mobileops_user_role = "CLIENT";
				sessionStorage.mobileops_firstname = response.firstname;
				sessionStorage.mobileops_surname = response.surname;
				sessionStorage.mobileops_phone_number = response.phone_number;
				sessionStorage.mobileops_user_id = response.user_id; */
				
				if(response.phone_number){
					window.location.href = "index.php?mybookings";
				}else{
					window.location.href = "index.php?clientprofile";
				}
			}
			else{
				//window.location.href = "index.php?login=twittererror";
			}
     }, 'json');
});
</script>


</body>
</html>

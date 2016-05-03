// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {
	console.log('statusChangeCallback');
	console.log(response);
	// The response object is returned with a status field that lets the
	// app know the current login status of the person.
	// Full docs on the response object can be found in the documentation
	// for FB.getLoginStatus().
	if (response.status === 'connected') {
		// Logged into your app and Facebook.
		// testAPI();
		loadFacebookUser();
	} else if (response.status === 'not_authorized') {
		// The person is logged into Facebook, but not your app.

		$('#lbl_message').text('Please log into mobileops.');
		$('#lbl_message').removeClass("display-none").addClass("alert-danger");
	} else {
		// The person is not logged into Facebook, so we're not sure if
		// they are logged into this app or not.
		$('#lbl_message').text('Please log into Facebook.');
		$('#lbl_message').removeClass("display-none").addClass("alert-danger");
	}
}

// This function is called when someone finishes with the Login
// Button. See the onlogin handler attached to it in the sample
// code below.

function checkLoginState() {
	FB.getLoginStatus(function(response) {
		statusChangeCallback(response);
	});
}

window.fbAsyncInit = function() {
	FB.init( {
		appId : '773233792802919',
		//appId : '773239122802386',
		xfbml : true,
		cookie : true,
		version : 'v2.5',
		oauth : true
	});
};

(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) {
		return;
	}
	js = d.createElement(s);
	js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function testAPI() {
	console.log('Welcome!  Fetching your information.... ');
	FB.api('/me?fields=name,email', function(response) {
		console.log('Successful login for: ' + response.name);
		console.log(response);
		document.getElementById('status').innerHTML = 'Thanks for logging in, '
				+ response.name + '!';
	});
}

function loadFacebookUser() {
	var email_address;
	var fb_userid;
	var first_name;
	var last_name;

	FB.api('/me?fields=name,email,first_name,last_name', function(response) {
		email_address = response.email;
		fb_userid = response.id;
		first_name = response.first_name;
		last_name = response.last_name;

		var param = "loadFacebookUser=" + email_address + "&fb_userid="
				+ fb_userid + "&first_name=" + first_name + "&last_name="
				+ last_name;

		$.post('src/AppBundle/Controller/controller_security.php', param, function(
				response) {
			var message = response.message;

			if (message.indexOf("successfully") > -1) {
				sessionStorage.mobileops_email_address = response.email_address;
				sessionStorage.mobileops_user_role = "CLIENT";
				sessionStorage.mobileops_firstname = response.firstname;
				sessionStorage.mobileops_surname = response.surname;
				sessionStorage.mobileops_phone_number = response.phone_number;
				sessionStorage.mobileops_user_id = response.user_id;
				
				if(response.phone_number){
					window.location.href = "index.php?mybookings";
					
				}else{
					window.location.href = "index.php?clientprofile";
				}
			} else {
				$('#lbl_message').text(message);
				$('#lbl_message').removeClass("display-none").addClass(
						"alert-danger");
			}
		}, 'json');

	});

}
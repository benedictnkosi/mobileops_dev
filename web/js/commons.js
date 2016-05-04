//generic function to get parameters from URL
function getUrlParameter(sParam) {
	var sPageURL = window.location.search.substring(1);
	var sURLVariables = sPageURL.split('&');
	for (var i = 0; i < sURLVariables.length; i++) {
		var sParameterName = sURLVariables[i].split('=');
		if (sParameterName[0] == sParam) {
			return sParameterName[1];
		}
	}
	return false;
}


function saveCookieToSession() {
	var JsonCookie = jQuery.parseJSON(unescape(getCookie("mobileops")));
	sessionStorage.mobileops_email_address = JsonCookie['email_address'];
	sessionStorage.mobileops_firstname = JsonCookie['firstname'];
	sessionStorage.mobileops_phone_number = JsonCookie['phone_number'];
	sessionStorage.mobileops_surname = JsonCookie['surname'];
	sessionStorage.mobileops_user_role = JsonCookie['user_role'];
	sessionStorage.mobileops_user_id = JsonCookie['user_id'];
	}



function getCookie(cname) {
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ')
			c = c.substring(1);
		if (c.indexOf(name) == 0)
			return c.substring(name.length, c.length);
	}
	return null;
}



function getValueInCookie(cname, cVariableName) {
	var JsonCookie = jQuery.parseJSON(unescape(getCookie(cname)));
	return(JsonCookie[cVariableName]);
}



function replaceParameter(strKey, strValue) {
	var allParameters = sessionStorage.allParameters;
	var Index = allParameters.indexOf(strKey);
	var valueToReplace;
	equalSignIndex = Index + strKey.length + 1;
	var Index1 = allParameters.indexOf("&", equalSignIndex);

	if (Index1 == -1) {
		valueToReplace = allParameters.substring(equalSignIndex);
	} else {
		valueToReplace = allParameters.substring(equalSignIndex, Index1);
	}

	allParameters = allParameters.replace(strKey + "=" + valueToReplace, strKey
			+ "=" + strValue);
	return allParameters;
}
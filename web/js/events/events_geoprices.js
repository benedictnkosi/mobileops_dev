// JavaScript Document

$(document).ready(function() {
	getServiceCategories(loadIdealForms);
});

function getServiceCategories(callback){
		
	//$('.service_categories_row').empty();
	$('#lbl_message').addClass( "display-none" );
	
	var parameters = "getServiceCategories=all";

$.ajax({
type : 'GET',
url : '/src/AppBundle/Controller/controller_pricelist.php',
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
	
	var servicesDiv = document.getElementById("service_categories_row");
	
	for (i = 0; i < data.length; i++) { 
		
		var service_categories_cell = document.createElement("div"); // <div
		service_categories_cell.className = "2u 6u(2) 12u$(3) service_categories_cell";
		
		var checkbox_div = document.createElement("div"); // <div
		checkbox_div.className = "checkbox"

		// <input type="checkbox" class="services_checkbox_item"
		// id="inlineCheckbox1" value="option1">
		var newCheckBox = document.createElement("input");
		newCheckBox.type = 'checkbox';
		newCheckBox.className = "services_checkbox_item";
		newCheckBox.id = "chk_" + data[i];
		newCheckBox.value = data[i];
		
		// <label for="inlineCheckbox1"> SIMPLE WASH </label>
		var label = document.createElement("label");
		label.innerHTML = data[i];
		label.className = "ideal-radiocheck-label";
		label.appendChild(newCheckBox);

		
		service_categories_cell.appendChild(label);
		servicesDiv.appendChild(service_categories_cell);
		
	}
	
	callback();
	

},
});
}

function getPrices(){
	// empty table before repopulating and clear message label
	$('.lbl_loading').text("Finding prices near you.......");
	$("#jsontotable-obj").html("");
	$('#lbl_message').addClass( "display-none" );
	
	var checkedValues = $('.services_checkbox_item:checked').map(function() {
		return this.value;
	}).get();

	if(checkedValues.length < 1){
		$('#lbl_message').text("Please select at least one service category");
		$('#lbl_message').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
		$("html, body").animate({ scrollTop: 0 }, "slow");
	}
	var jsonString = JSON.stringify(checkedValues);
	
	
	var parameters = "getPricelist=" + "Hair" + "&lat=" +  sessionStorage.mobileops_lat + "&lng=" + sessionStorage.mobileops_lng + "&serviceCategories=" + jsonString ;
$.ajax({
type : 'GET',
url : '/src/AppBundle/Controller/controller_pricelist.php',
data : parameters,
dataType : "json",
success : function(response) {
	/* JSON To Table (Has Header) */
	data = response.message;
	$('.lbl_loading').addClass( "display-none" );
	
	if(response.status == 2){
		$('#lbl_message').text(data);
		$('#lbl_message').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
		$("html, body").animate({ scrollTop: 0 }, "slow");
		return;
	}
	
	if(data.length < 1){
		$('#lbl_message').text("No prices found for the selected categories");
		$('#lbl_message').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
		$("html, body").animate({ scrollTop: 0 }, "slow");
		return;
	}
	input = JSON.stringify(data);
	
	$.jsontotable(data, {
		id : "#jsontotable-obj",
		className : "table table-hover"
	});
},
});
}



function loadIdealForms() {

	$
			.getScript(
					"web/js/out/jquery.idealforms.js",
					function(data, textStatus, jqxhr) {
						$('.idealforms')
								.idealforms(
										{
											iconHtml : false,
											silentLoad : true,
											rules : {
	
											},
											onSubmit : function(invalid, e) {
												e.preventDefault();
												
												if (invalid) {

												} else {}
											}
										});

					});
}


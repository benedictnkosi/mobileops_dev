// JavaScript Document

$(document).ready(function() {
	if (getCookie("mobileops_temp_login")) {
		getAllServiceTypes();
	}

	$("#dropdownRegionTypes").change(function() {
		getAllRegionServices();
	});

	$("#tabs").on("tabsactivate", function(event, ui) {
		var active = $("#tabs").tabs("option", "active");
		if (active == 1) { // services tab
			getActiveServices();
		}

		if (active == 2) { // services tab
			getAllActiveRegions();
		}

	});
	
	loadIdealForms();

});

function getActiveServices() {
	$('#partnerServicesDiv').empty()
	$.ajax({
		type : 'GET',
		url : 'src/AppBundle/Controller/controller_manage_services.php',
		data : 'getActiveServices=true',
		dataType : "json",
		success : function(response) {
			var data = response.message;
			var serviceType = ""; // used to track the current service type
			var partnerServicesDiv = document
					.getElementById("partnerServicesDiv");
			var ul;
			var arrayServiceNames = [];
			for (i = 0; i < data.length; i++) {
				// if other service type create a heading with service type name
				// and create a new unordered list element
				if (serviceType.indexOf(data[i][0]) < 0) {
					ul = document.createElement("ul")
					ul.id = data[i][0];
					var h = document.createElement("H4")
					var t = document.createTextNode(data[i][0]);
					h.appendChild(t);
					partnerServicesDiv.appendChild(h);
					partnerServicesDiv.appendChild(ul);
				}

				// add services to the list
				serviceType = data[i][0];
				serviceName = data[i][1];

				var listItem = document.createElement("li");
				listItem.appendChild(document.createTextNode(serviceName));

				if (data[i][2] == false) {
					listItem.className = "disabled-service";
				}
				ul.appendChild(listItem);
			}
		},
	});
}

function getAllActiveRegions() {
	$('#dropdownRegionTypes').empty();
	$.ajax({
		type : 'GET',
		url : 'src/AppBundle/Controller/controller_manage_services.php',
		data : 'getAllActiveRegions=true',
		dataType : "json",
		success : function(response) {

			var activeRegions = response.activeRegions;

			$('#dropdownRegionTypes').append($('<option>', {
				value : "Select Region",
				text : "--Select Region--"
			}))

			for (i = 0; i < activeRegions.length; i++) {
				$('#dropdownRegionTypes').append($('<option>', {
					value : activeRegions[i],
					text : activeRegions[i]
				}))
			}

		},
	});
}

function getAllServiceTypes() {
	$('#p_service_types_checkbox').empty()
	$.ajax({
		type : 'GET',
		url : 'src/AppBundle/Controller/controller_manage_services.php',
		data : 'getAllServiceTypes=true',
		dataType : "json",
		success : function(response) {
			var data = response.message;
			var serviceType = ""; // used to track the current service type
			var partnerServicesDiv = document
					.getElementById("p_service_types_checkbox");
			var ul;
			var arrayServiceNames = [];
			ul = document.createElement("ul")
			for (i = 0; i < data.length; i++) {

				serviceName = data[i][0];

				var listItem = document.createElement("li");
				listItem.appendChild(document.createTextNode(serviceName));

				if (data[i][1] == false) {
					listItem.className = "disabled-service";
				}
				ul.appendChild(listItem);

			}
			partnerServicesDiv.appendChild(ul);
		},
	});

}

function loadIdealForms() {
	$
			.getScript(
					"web/js/out/jquery.idealforms.js",
					function(data, textStatus, jqxhr) {
						$('#form_region_service')
								.idealforms(
										{
											silentLoad : true,
											rules : {

											},
											onSubmit : function(invalid, e) {
												e.preventDefault();
												$('#lbl_message').addClass(
														"display-none");
												if (invalid) {

												} else {
													var active = $("#tabs").tabs("option", "active");
													console.log(active);
													if (active == 2) { // services tab
														updateRegionServices();
													}
													
												}
											}
										});
					});
}

function getAllRegionServices() {
	$('#regionsDiv').empty();
	$('#cmdUpdateServiceTypes').hide();
	$.ajax({
		type : 'GET',
		url : 'src/AppBundle/Controller/controller_manage_services.php',
		data : 'getAllServicesForRegion=' + $('#dropdownRegionTypes').val(),
		dataType : "json",
		success : function(response) {
			var data = response.message;
			var serviceType = ""; // used to track the current service type
			var regionsDiv = document.getElementById("regionsDiv");
			var ul;
			var arrayServiceNames = [];
			for (i = 0; i < data.length; i++) {
				$('#cmdUpdateServiceTypes').show()
				
				// if other service type create a heading with service type name
				// and create a new unordered list element
				if (serviceType.indexOf(data[i][0]) < 0) {
					ul = document.createElement("ul")
					ul.id = data[i][0];
					var h = document.createElement("H4")
					var t = document.createTextNode(data[i][0]);
					h.appendChild(t);
					regionsDiv.appendChild(h);
					regionsDiv.appendChild(ul);
				}

				// add services to the list
				active = data[i][2];
				Service = data[i][1];

				var checkbox_div = document.createElement("div"); // <div
				// class="checkbox
				// ">
				checkbox_div.className = "checkbox"

				// <input type="checkbox" class="services_checkbox_item"
				// id="inlineCheckbox1" value="option1">
				var newCheckBox = document.createElement("input");
				newCheckBox.type = 'checkbox';
				newCheckBox.className = "services_checkbox_item";
				newCheckBox.id = "chk_" + Service;
				newCheckBox.value = Service;


				if (active == true) {
						newCheckBox.checked = true;
				}
				

				// <label for="inlineCheckbox1"> SIMPLE WASH </label>
				var label = document.createElement("label");
				label.htmlFor = "chk_" + Service;
				label.innerHTML = Service;

				checkbox_div.appendChild(newCheckBox);
				checkbox_div.appendChild(label);

				regionsDiv.appendChild(checkbox_div);
			}

		},
	});

}


function updateRegionServices(){

	var checkedValues = $('.services_checkbox_item:checked').map(function() {
	    return this.value;
	}).get();
	
	var jsonString = JSON.stringify(checkedValues);
	
	$.ajax({
		type : 'POST',
		url : 'src/AppBundle/Controller/controller_manage_services.php',
		data: {"saveRegionServices" : jsonString}, 
		dataType : "json",
		success : function(data) {
			
			if(data.message){
					$('#lbl_message').text("Services updated successfuliy");
					$('#lbl_message').removeClass( "display-none alert-danger" ).addClass( "alert-success" );
				}else if(message.indexOf("successfully") > -1){
					$('#lbl_message').text("Services updated successfuliy");
					$('#lbl_message').removeClass( "display-none alert-danger" ).addClass( "alert-success" );
				}
				else{
					$('#lbl_message').text("Error, Failed to update service. Please try again.");
					$('#lbl_message').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
				}
			$("html, body").animate({ scrollTop: $("#lbl_message").offset().top}, "slow");
			
	},
	
	});
}
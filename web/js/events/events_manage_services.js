// JavaScript Document

$(document).ready(function() {
	if (getCookie("mobileops_temp_login")) {
		getAllServiceTypes();
	}

	$("#dropdownRegionTypes").change(function() {
		
		if($(this).find('option:selected').index() == 0){
			$('#regionsDiv').empty();
			$('#cmdUpdateServiceTypes').hide();
			return;
		}else{
			getAllRegionServices();
			
		}
	});
	
	
	$("#dropdownRegionSerivces").change(function() {
		
		if($(this).find('option:selected').index() == 0){
			$('#cmdSaveNewServicePrice').hide();
			return;
		}else{
			$('#cmdSaveNewServicePrice').show();
		}
	});

	
	$("#dropdownPricesRegionTypes").change(function() {
		
		if($(this).find('option:selected').index() == 0){
			$('.serviceRow').remove();
			$('#newServicePrice_div').hide();
			return;
		}else{
			getAllRegionServicePrices();
			getAllActiveServicesForRegion();
			$('#newServicePrice_div').show();
		}
	});


	$("#tabs").on("tabsactivate", function(event, ui) {
		var active = $("#tabs").tabs("option", "active");
		if (active == 1) { // services tab
			getAllServices();
		}

		if (active == 2) { // services tab
			getAllActiveRegions('dropdownRegionTypes');
		}
		
		if(active == 3){
			getAllActiveRegions('dropdownPricesRegionTypes');
			$('#newServicePrice_div').hide();
			$('.serviceRow').remove();
		}

	});
	
	
	$("#cmdSaveNewServicePrice").click(function() {
		addnewServicePrice();
	});


	loadIdealForms();

});

function getAllServices() {
	$('#partnerServicesDiv').empty()
	$.ajax({
		type : 'GET',
		url : 'src/AppBundle/Controller/controller_manage_services.php',
		data : 'getAllServices=true',
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

function getAllActiveRegions(dropDown) {
	$('#' + dropDown).empty();
	
	if (sessionStorage.getItem("allActiveRegions") === null) {
		$.ajax({
			type : 'GET',
			url : 'src/AppBundle/Controller/controller_manage_services.php',
			data : 'getAllActiveRegions=true',
			dataType : "json",
			success : function(response) {

				var activeRegions = response.activeRegions;

				$('#' + dropDown).append($('<option>', {
					value : "Select Region",
					text : "--Select Region To Work With--"
				}))

				for (i = 0; i < activeRegions.length; i++) {
					$('#' + dropDown).append($('<option>', {
						value : activeRegions[i],
						text : activeRegions[i]
					}))
				}
				
				sessionStorage["allActiveRegions"] = JSON.stringify(activeRegions);
				

			},
		});
		}else{
			var activeRegions = JSON.parse(sessionStorage["allActiveRegions"]);
			$('#' + dropDown).append($('<option>', {
				value : "Select Region",
				text : "--Select Region To Work With--"
			}))

			for (i = 0; i < activeRegions.length; i++) {
				$('#' + dropDown).append($('<option>', {
					value : activeRegions[i],
					text : activeRegions[i]
				}))
			}
		}
	
	
	
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
				serviceType = data[i][0];
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
		data: {"saveRegionServices" : jsonString, "region":$('#dropdownRegionTypes').find(":selected").text()}, 
		dataType : "json",
		success : function(data) {
			
			if(data.status == 1){
					$('#lbl_message').text("Services updated successfuliy");
					$('#lbl_message').removeClass( "display-none alert-danger" ).addClass( "alert-success" );
				}
				else{
					$('#lbl_message').text("Error, Failed to update service. Please try again.");
					$('#lbl_message').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
				}
			$("html, body").animate({ scrollTop: $("#tabs").offset().top}, "slow");
			
	},
	
	});
}



function getAllRegionServicePrices() {
	$.ajax({
		type : 'GET',
		url : 'src/AppBundle/Controller/controller_manage_services.php',
		data : 'getAllServicePricesForRegion=' + $('#dropdownPricesRegionTypes').val(),
		dataType : "json",
		success : function(response) {
			var data = response.message;
			addServicesRows(data);
		},
	});

}



function addServicesRows(services){
	$('.serviceRow').remove();
	var rowNum = 1;
	var table = document.getElementById("invoice_table");
	
	for (i = 0; i < services.length; i++){
		var row = table.insertRow(rowNum);
		row.className = "serviceRow";
		rowNum += 1;
		var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		var cell3 = row.insertCell(2);
		var cell4 = row.insertCell(3);
		var cell5 = row.insertCell(4);
		var cell6 = row.insertCell(5);
		
		cell1.innerHTML = services[i][0];
		cell2.innerHTML = services[i][1];
		cell3.innerHTML = "R" + parseFloat(Math.round(services[i][2] * 100) / 100).toFixed(2);
		
		var input = document.createElement('input');
	    input.setAttribute('type', 'text');
	    input.setAttribute('maxlength', '5');
	    input.id = "input_price_" + services[i][3];
	    
		cell4.appendChild(input);
		
		var button = document.createElement('button');
		button.id = "button_price_" + services[i][3];
		button.className = "updateServicePriceButton button";
		button.setAttribute('type', 'submit');
		button.onclick = updateRegionServicePrice;
		button.innerHTML  = "Update";
		cell5.appendChild(button);
		
		
		var deleteButton = document.createElement('button');
		deleteButton.id = "button_delete_" + services[i][3];
		deleteButton.className = "deleteServicePriceButton button";
		deleteButton.setAttribute('type', 'submit');
		deleteButton.onclick = deleteRegionServicePrice;
		deleteButton.innerHTML  = "Delete";
		cell6.appendChild(deleteButton);
		
		
	}
}


function updateRegionServicePrice(){
	var serviceRegionPriceId = this.id.replace("button_price_", "");
	var newPrice = $('#input_price_' + serviceRegionPriceId).val();
	var newPrice = $('#input_price_' + serviceRegionPriceId).val();
	
	if(isNaN(newPrice) == true || newPrice.trim().length < 1){
		$('#lbl_message_prices').text("Please fill in numbers only for New Price");
		$('#lbl_message_prices').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
		$("html, body").animate({ scrollTop: $("#tabs").offset().top}, "slow");
		return;
	}
	
	//check if the number is > 0 if its a number
	if(isNaN(newPrice) == false){
		if(parseInt(newPrice) < 1){
			$('#lbl_message_prices').text("Price must be positive");
			$('#lbl_message_prices').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
			$("html, body").animate({ scrollTop: $("#tabs").offset().top}, "slow");
			return;
		}
	}
	
	$.ajax({
		type : 'POST',
		url : 'src/AppBundle/Controller/controller_manage_services.php',
		data: {"updateRegionServicePrice" : serviceRegionPriceId, "price":newPrice}, 
		dataType : "json",
		success : function(data) {
			
			if(data.status == 1){
					$('#lbl_message_prices').text("Services updated successfuliy");
					$('#lbl_message_prices').removeClass( "display-none alert-danger" ).addClass( "alert-success" );
					$('.serviceRow').remove();
					getAllRegionServicePrices();
				}
				else{
					$('#lbl_message_prices').text("Error, Failed to update service. Please try again.");
					$('#lbl_message_prices').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
				}
			$("html, body").animate({ scrollTop: $("#tabs").offset().top}, "slow");
			
	},
	
	});
}


function deleteRegionServicePrice(){
	var serviceRegionPriceId = this.id.replace("button_delete_", "");
	
	$.ajax({
		type : 'POST',
		url : 'src/AppBundle/Controller/controller_manage_services.php',
		data: {"deleteRegionServicePrice" : serviceRegionPriceId}, 
		dataType : "json",
		success : function(data) {
			
			if(data.status == 1){
					$('#lbl_message_prices').text(data.message);
					$('#lbl_message_prices').removeClass( "display-none alert-danger" ).addClass( "alert-success" );
					$('.serviceRow').remove();
					getAllRegionServicePrices();
				}
				else{
					$('#lbl_message_prices').text(data.message);
					$('#lbl_message_prices').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
				}
			$("html, body").animate({ scrollTop: $("#tabs").offset().top}, "slow");
			
	},
	
	});
}


function getAllActiveServicesForRegion(){
	$('#dropdownRegionSerivces').empty();
	$.ajax({
		type : 'GET',
		url : 'src/AppBundle/Controller/controller_manage_services.php',
		data : 'getAllActiveServicesForRegion=' + $('#dropdownPricesRegionTypes').val(),
		dataType : "json",
		success : function(response) {

			var activeServices = response.activeServices;

			$('#dropdownRegionSerivces').append($('<option>', {
				value : "Select Service",
				text : "--Select Service--"
			}))

			for (i = 0; i < activeServices.length; i++) {
				$('#dropdownRegionSerivces').append($('<option>', {
					value : activeServices[i][1],
					text : activeServices[i][0]
				}))
			}

		},
	});
}



function addnewServicePrice(){

	var price = $('#input_service_price').val();
	
	if(isNaN(price) == true || price.trim().length < 1){
		$('#lbl_message_prices').text("Please fill in numbers only for new service price");
		$('#lbl_message_prices').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
		$("html, body").animate({ scrollTop: $("#tabs").offset().top}, "slow");
		return;
	}
	
	
	
	$.ajax({
		type : 'POST',
		url : 'src/AppBundle/Controller/controller_manage_services.php',
		data: {"addnewServicePrice" : $('#dropdownRegionSerivces').val(), "price":price}, 
		dataType : "json",
		success : function(data) {
			
			if(data.status == 1){
					$('#lbl_message_prices').text(data.message);
					$('#lbl_message_prices').removeClass( "display-none alert-danger" ).addClass( "alert-success" );
					getAllRegionServicePrices();
				}
				else{
					$('#lbl_message_prices').text(data.message);
					$('#lbl_message_prices').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
				}
			$("html, body").animate({ scrollTop: $("#tabs").offset().top}, "slow");
			
	},
	
	});
}

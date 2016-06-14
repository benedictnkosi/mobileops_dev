// JavaScript Document

$(document).ready(function() {
	if (getCookie("mobileops_temp_login")) {
		//getAllServiceTypes();
	}

	$("#cmdSaveNewServicePrice").click(function() {
		addnewServicePrice();
	});


	loadIdealForms();

});


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

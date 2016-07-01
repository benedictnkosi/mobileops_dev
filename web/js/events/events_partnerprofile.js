// JavaScript Document

$(document)
		.ready(
				function() {
					// this is to track uploaded images and to match them to
					// their server names
					// when the user wished to delete them
					sessionStorage.mobileops_servicesChanged = 1;
					sessionStorage.mobileops_servicesFetched = 0;
					var mobileops_uploadedImages = [];
					sessionStorage["mobileops_uploadedImages"] = JSON
							.stringify(mobileops_uploadedImages);

					Dropzone.autoDiscover = false;
					$("#fileUpload_dropzone")
							.dropzone(
									{
										dictDefaultMessage : "Drop files here or click to upload.",
										clickable : true,
										enqueueForUpload : true,
										maxFilesize : 3,
										addRemoveLinks : true,
										uploadMultiple : false,
										maxFiles : 50,

										// on initialize get the images on the
										// server for the partner
										init : function() {
											thisDropzone = this;
											$
													.get(
															'/src/AppBundle/Logic/file_upload.php',
															function(data) {
																$
																		.each(
																				data,
																				function(
																						key,
																						value) {
																					var mockFile = {
																						name : value.name,
																						size : value.size
																					};
																					thisDropzone.options.addedfile
																							.call(
																									thisDropzone,
																									mockFile);
																					thisDropzone.options.thumbnail
																							.call(
																									thisDropzone,
																									mockFile,
																									"web/images/partner_gallery/"
																											+ value.name);
																					$(
																							".dz-details")
																							.remove();
																					$(
																							".dz-progress")
																							.remove();
																				});
															});

											// delete from server
											this
													.on(
															"removedfile",
															function(file) {
																var isFileDeleted = false;

																// get the
																// mapped server
																// name for the
																// file the user
																// is trying to
																// delete and
																// send that to
																// the server
																var mobileops_uploadedImages = JSON
																		.parse(sessionStorage["mobileops_uploadedImages"]);
																for (i = 0; i < mobileops_uploadedImages.length; i++) {
																	var uploadedImage;

																	if (mobileops_uploadedImages[i] !== null) {
																		uploadedImage = mobileops_uploadedImages[i]
																				.split("###");
																	} else {
																		continue;
																	}

																	if (uploadedImage[1]
																			.localeCompare(file.name) == 0) {
																		isFileDeleted = true;
																		delete mobileops_uploadedImages[i];
																		sessionStorage["mobileops_uploadedImages"] = JSON
																				.stringify(mobileops_uploadedImages);
																		$
																				.get(
																						"src/AppBundle/Controller/controller_partner_profile.php?deleteimage=thumb_"
																								+ uploadedImage[0],
																						function(
																								data,
																								status) {
																							if (data
																									.indexOf("success") > -1) {
																								return;
																							} else {
																								$(
																										'#lbl_message')
																										.text(
																												"Failed to delete image from server, please reload the page and try again.");
																								$(
																										'#lbl_message')
																										.removeClass(
																												"display-none alert-success alert-warning")
																										.addClass(
																												"alert-danger");
																								return;
																							}
																						});
																	}
																}

																// if the file
																// was not found
																// on the
																// recently
																// uploaded
																// images and
																// its one of
																// the
																// previously
																// uploaded
																// images
																// call the
																// server with
																// the filename
																// as its
																// already
																// loaded from
																// the server
																if (!isFileDeleted) {
																	$
																			.get(
																					"src/AppBundle/Controller/controller_partner_profile.php?deleteimage="
																							+ file.name,
																					function(
																							data,
																							status) {
																						if (data
																								.indexOf("success") > -1) {
																							return;
																						} else {
																							$(
																									'#lbl_message')
																									.text(
																											"Failed to delete image from server, please reload the page and try again.");
																							$(
																									'#lbl_message')
																									.removeClass(
																											"display-none alert-success alert-warning")
																									.addClass(
																											"alert-danger");
																							return;
																						}
																					});
																}

															});

											// on successfull upload, add the
											// server anme mappinging to the
											// array and save in sessiopn
											// storage
											this
													.on(
															"success",
															function(file,
																	responseText) {
																var mobileops_uploadedImages = JSON
																		.parse(sessionStorage["mobileops_uploadedImages"]);
																mobileops_uploadedImages
																		.push(responseText);
																sessionStorage["mobileops_uploadedImages"] = JSON
																		.stringify(mobileops_uploadedImages);
															});

										}
									});

					$("#tabs").on("tabsactivate", function(event, ui) {

						var active = $("#tabs").tabs("option", "active");
						if (active == 1) { // services tab
							if(sessionStorage.mobileops_servicesFetched == 0){
								getPartnerServices(getAllServices);
							}
							
						}

						if (active == 2) { // services Price tab
							//initialise service prices array
							var mobileops_servicesPricesArray = [];
							sessionStorage.setItem("mobileops_servicesPricesArray", JSON.stringify(mobileops_servicesPricesArray));
							if(sessionStorage.mobileops_servicesChanged == 1){
								getAllServicesWithPrice(getAllServicesWithPrice);
							}
							
						}

						if (active == 3) { // services tab
							getServiceCategories();
							loadIdealForms_newService();
						}

					});

					
					
					$("#cmd_updateServices").bind("click", saveServices);
					$("#cmd_updateServicePrices").bind("click", saveServicesPrices);
					
					
					

					getPartnerProfile();

					loadIdealForms_partnerProfile();

				});

function getPartnerProfile() {
	$.ajax({
		type : 'GET',
		url : 'src/AppBundle/Controller/controller_partner_profile.php',
		data : 'getPartnerProfile=true',
		dataType : "json",
		success : function(response) {
			var data = response.message;
			$('#firstname').val(data['name']);
			$('#surname').val(data['surname']);

			$('#email').val(data['email']);
			$('#mobile_number').val(data['mobile_number']);

			$('#address').val(data['address']);
			$('#complex').val(data['complex']);
			$('#input_Latitude').val(data['latitude']);
			$('#input_Longitude').val(data['longitude']);
			$('#input_street_name').val(data['street_name']);
			$('#input_street_number').val(data['street_number']);
			$('#input_city').val(data['city']);
			$('#input_suburb').val(data['suburb']);
			$('#input_province').val(data['province']);
			$('#txt_personalNote').val(data['personalNote']);

			if (data['mobility']) {
				$('input[value="' + data['mobility'] + '"]').parent(
						".ideal-radiocheck-label").click();
			}

		},
	});
}

function getPartnerServices(callback) {

	$('#div_services').empty();

	$.ajax({
		type : 'GET',
		url : 'src/AppBundle/Controller/controller_partner_profile.php',
		data : 'getPartnerServices=true',
		dataType : "json",
		success : function(response) {
			sessionStorage.mobileops_servicesFetched = 1;
			var data = response.message;
			var serviceType = ""; // used to track the current service type
			var partnerServicesDiv = document
					.getElementById("partnerServicesDiv");
			var ul;
			var arrayServiceNames = [];
			for (i = 0; i < data.length; i++) {
				serviceName = data[i][1];
				arrayServiceNames.push(serviceName);
			}
			callback(arrayServiceNames);

		},
	});
}

function getServiceCategories() {

	$('#service_category').empty().append(
			'<option value="DEFAULT">----SELECT CATEGORY-----</option>');
	
	var parameters = "getServiceCategories=true";

$.ajax({
		type : 'GET',
		url : '/src/AppBundle/Controller/controller_services.php',
		data : parameters,
		dataType : "json",
		success : function(response) {
			data = response.message;

			if (response.status == 2) {
				$('#lbl_message').text(data);
				$('#lbl_message').removeClass("display-none alert-success")
						.addClass("alert-danger");
				$("html, body").animate({
					scrollTop : 0
				}, "slow");
				return;
			}

			for (i = 0; i < data.length; i++) {
				$('#service_category').append($('<option>', {
					value : data[i],
					text : data[i]
				}))
			}
		},
	});
}

function saveServices() {

	var checkedValues = $('.services_checkbox_item:checked').map(function() {
		return this.value;
	}).get();

	var jsonString = JSON.stringify(checkedValues);

	$.ajax({
		type : 'POST',
		url : 'src/AppBundle/Controller/controller_partner_profile.php',
		data : {
			"saveServices" : jsonString
		},
		dataType : "json",
		success : function(data) {

			if (data.status == 1) {
				sessionStorage.mobileops_servicesChanged = 1;
				$('#lbl__myservices_message').text(data.message);
				$('#lbl__myservices_message').removeClass(
						"display-none alert-danger").addClass("alert-success");
				sessionStorage["partnerServices"] = JSON
						.stringify(data.services);
			}

			else {
				$('#lbl__myservices_message').text(data.message);
				$('#lbl__myservices_message').removeClass(
						"display-none alert-success").addClass("alert-danger");
			}
			$("html, body").animate({
				scrollTop : $(".container").offset().top
			}, "slow");

		},

	});
}



function saveServicesPrices() {

	var mobileops_servicesPricesArray = JSON.parse(sessionStorage.getItem("mobileops_servicesPricesArray"));

	$.ajax({
		type : 'POST',
		url : 'src/AppBundle/Controller/controller_partner_profile.php',
		data : {
			"saveServicesPrices" : mobileops_servicesPricesArray
		},
		dataType : "json",
		success : function(data) {

			if (data.status == 1) {
				$('#lbl__service_prices_message').text(data.message);
				$('#lbl__service_prices_message').removeClass(
						"display-none alert-danger").addClass("alert-success");
				var mobileops_servicesPricesArray = [];
				sessionStorage.setItem("mobileops_servicesPricesArray", JSON.stringify(mobileops_servicesPricesArray));
			}

			else {
				$('#lbl__service_prices_message').text(data.message);
				$('#lbl__service_prices_message').removeClass(
						"display-none alert-success").addClass("alert-danger");
			}
			$("html, body").animate({
				scrollTop : $(".container").offset().top
			}, "slow");

		},

	});
}


function getAllServices(partnerservices) {
	$.ajax({
		type : 'GET',
		url : 'src/AppBundle/Controller/controller_services.php',
		data : 'getAllServices=all',
		dataType : "json",
		success : function(response) {
			var data = response.message;
			//var ServiceAccordian = document.getElementById("accordion");
			
			var ServiceAccordian = document.createElement("div");
			ServiceAccordian.id ="accordion";

			var servicesDiv = document.getElementById("div_services");
			var tbl;
			var tblBody;
			

			for (i = 0; i < data.length; i++) {
				var arrayServices = data[i];

				var categoryDiv = document.createElement("div"); // <div>

				for (j = 0; j < arrayServices.length; j++) {
					var Service = arrayServices[j];

					if (j == 0) {
						var h = document.createElement("H3") // <h3>Hair</h3>
						h.appendChild(document.createTextNode(Service));
						ServiceAccordian.appendChild(h);
						categoryDiv.id = "div_" + Service;

					} else {

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

						// check if partner has the service so it can be checked
						for (k = 0; k < partnerservices.length; k++) {
							var partnerService = partnerservices[k];
							if (partnerService.localeCompare(Service) == 0) {
								newCheckBox.checked = true;
							}
						}

						// <label for="inlineCheckbox1"> SIMPLE WASH </label>
						var label = document.createElement("label");
						label.htmlFor = "chk_" + Service;
						label.innerHTML = Service;

						checkbox_div.appendChild(newCheckBox);
						checkbox_div.appendChild(label);

						categoryDiv.appendChild(checkbox_div);
					}
				}

				ServiceAccordian.appendChild(categoryDiv);
			}

			servicesDiv.appendChild(ServiceAccordian);
			
			$("#accordion").accordion();

		},
	});
}

function getAllServicesWithPrice(partnerservices) {
	$('#div_prices').empty();
	$.ajax({
		type : 'GET',
		url : 'src/AppBundle/Controller/controller_partner_profile.php',
		data : 'getServicesWithPrices=all',
		dataType : "json",
		success : function(response) {
			var data = response.message;
			//var ServiceAccordian = document.getElementById("accordion_prices");

			var ServiceAccordian = document.createElement("div");
			ServiceAccordian.id ="accordion_prices";

			var pricesDiv = document.getElementById("div_prices");
			var tbl;
			var tblBody;
			
			for (i = 0; i < data.length; i++) {
				var arrayServices = data[i];


				var categoryDiv = document.createElement("div"); // <div>
					
				for (j = 0; j < arrayServices.length; j++) {
					var Service = arrayServices[j][1];
					var ServiceCategory = arrayServices[j][0];
					var ServicePrice = arrayServices[j][2];
					var ServicPriceeId = arrayServices[j][3];
					var row = document.createElement("tr");
					
					if (j == 0) {
						var h = document.createElement("H3") // <h3>Hair</h3>
						h.appendChild(document.createTextNode(ServiceCategory));
						ServiceAccordian.appendChild(h);
						categoryDiv.id = "div_" + ServiceCategory;

						tbl = document.createElement("table");
						tblBody = document.createElement("tbody");
						
					} //else {

						var cellServiceName = document.createElement("td");
						var cellServicePrice = document.createElement("td");
						var serviceNameLabel = document.createElement("label");
					    var t = document.createTextNode(Service);
					    serviceNameLabel.appendChild(t);

						cellServiceName.appendChild(serviceNameLabel);

						servicePriceInput = document.createElement("input");
						servicePriceInput.setAttribute('type', 'text');
						servicePriceInput.setAttribute('value', ServicePrice);
						servicePriceInput.className = "currency";
						servicePriceInput.id = "servicePriceInput_" + ServicPriceeId;
						cellServicePrice.appendChild(servicePriceInput);
						row.appendChild(cellServiceName);
						row.appendChild(cellServicePrice);
						tblBody.appendChild(row);
					//}
				}
				
				tbl.appendChild(tblBody);
				categoryDiv.appendChild(tbl);
				ServiceAccordian.appendChild(categoryDiv);
				pricesDiv.appendChild(ServiceAccordian);
				sessionStorage.mobileops_servicesChanged = 0;
			}

			$(function(){
			    $(".currency").keyup(function(e){
			        $(this).val(format($(this).val()));
			    });
			});
			
			//on price change add price to the prices array to be updaed on save
			$('.currency').focusout(function(e){
			     console.log(e.target.id);
			     var mobileops_servicesPricesArray = JSON.parse(sessionStorage.getItem("mobileops_servicesPricesArray"));
			     var servicePriceId = e.target.id.replace("servicePriceInput_","");
			     for (var i = 0; i < mobileops_servicesPricesArray.length; i++) {
			    	 if(mobileops_servicesPricesArray[i]["id"].localeCompare(servicePriceId) == 0){
			    		 mobileops_servicesPricesArray.splice(i, 1);
			    	 }
			     }
			     
			     var servicesPrice = {id:servicePriceId, price:e.target.value.replace("R","").replace(".00","").replace(",","")};
			     mobileops_servicesPricesArray.push(servicesPrice);
			     sessionStorage.setItem("mobileops_servicesPricesArray", JSON.stringify(mobileops_servicesPricesArray));
			    });
			
			$("#accordion_prices").accordion();

		},
	});
}

function initialiseImageDropZone() {

}

function loadIdealForms_partnerProfile() {

	$
			.getScript(
					"http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js",
					function(data, textStatus, jqxhr) {
						$("#address").geocomplete({
							details : "form"
						});

						$("#address").on('input keyup', function(e) {
							// Reset lat
							$('#input_Latitude').val("");
						});

					});
	$
			.getScript(
					"web/js/out/jquery.idealforms.js",
					function(data, textStatus, jqxhr) {
						$('#form_partner_profile')
								.idealforms(
										{
											iconHtml : false,
											silentLoad : true,
											rules : {
												'firstname' : 'required',
												'surname' : 'required',
												'email' : 'required email',
												'mobile_number' : 'required number min:10 max:10',
												'idnumber' : 'required',
												'address' : 'required',
												'txt_personalNote' : 'required',
											},

											onSubmit : function(invalid, e) {
												e.preventDefault();
												$('#lbl_message').addClass(
														"display-none");
												if (invalid) {

												} else {

													if (!$(
															'input:radio[name=mobility]:checked')
															.val()) {
														$('#lbl_message')
																.text(
																		'Please select mobility');
														$('#lbl_message')
																.removeClass(
																		"display-none alert-success alert-warning")
																.addClass(
																		"alert-danger");

														$("html, body")
																.animate(
																		{
																			scrollTop : $(
																					".container")
																					.offset().top
																		},
																		"slow");
														return;
													}

													if ($('#input_street_name')
															.val().length < 1
															&& $(
																	'#input_street_number')
																	.val().length < 1) {
														$(
																'#lbl_address_message')
																.text(
																		'Address must contains street name and street number');
														$(
																'#lbl_address_message')
																.show(
																		function() {
																			$(
																					this)
																					.fadeOut(
																							6000);
																		});

														$("html, body")
																.animate(
																		{
																			scrollTop : $(
																					".container")
																					.offset().top
																		},
																		"slow");
														return;
													}

													if ($('#input_street_name')
															.val().length > 1
															&& $(
																	'#input_street_number')
																	.val().length < 1) {
														var streetNumber = prompt(
																"Please enter your street number",
																"");
														if (streetNumber != null) {
															if (!isNaN(streetNumber)) {
																$(
																		"#input_street_number")
																		.val(
																				streetNumber);
															} else {
																$(
																		'#lbl_address_message')
																		.show(
																				function() {
																					$(
																							this)
																							.fadeOut(
																									6000);
																				});

																$("html, body")
																		.animate(
																				{
																					scrollTop : $(
																							".container")
																							.offset().top
																				},
																				"slow");
																return;
															}
														} else {
															$(
																	'#lbl_address_message')
																	.show(
																			function() {
																				$(
																						this)
																						.fadeOut(
																								6000);
																			});

															$("html, body")
																	.animate(
																			{
																				scrollTop : $(
																						".container")
																						.offset().top
																			},
																			"slow");
															return;
														}
													}
													$
															.post(
																	'src/AppBundle/Controller/controller_partner_profile.php',
																	this.$form
																			.serialize(),
																	function(
																			response) {
																		var message = response.message;
																		if (message
																				.indexOf("Successfully") > -1) {
																			$(
																					'#lbl_message')
																					.text(
																							message);
																			$(
																					'#lbl_message')
																					.removeClass(
																							"display-none alert-warning alert-danger")
																					.addClass(
																							"alert-success");
																		} else {
																			$(
																					'#lbl_message')
																					.text(
																							message);
																			$(
																					'#lbl_message')
																					.removeClass(
																							"display-none alert-success alert-warning")
																					.addClass(
																							"alert-danger");
																		}
																		$(
																				"html, body")
																				.animate(
																						{
																							scrollTop : $(
																									".container")
																									.offset().top
																						},
																						"slow");
																	}, 'json');
												}
											}
										});

					});
}

function loadIdealForms_newService() {

	$
			.getScript(
					"web/js/out/jquery.idealforms.js",
					function(data, textStatus, jqxhr) {
						$('#form_newService')
								.idealforms(
										{
											iconHtml : false,
											silentLoad : true,
											rules : {
												'service_name' : 'required',
												'service_description' : 'required',
											},
											onSubmit : function(invalid, e) {
												e.preventDefault();
												$('#lbl_message_new_service')
														.addClass(
																"display-none");
												if (invalid) {

												} else {
													if ($('#service_category')
															.val()
															.localeCompare(
																	'DEFAULT') == 0) {
														$(
																'#lbl_message_new_service')
																.text(
																		'Please select service category');
														$(
																'#lbl_message_new_service')
																.removeClass(
																		"display-none alert-success")
																.addClass(
																		"alert-danger");
														$("html, body")
																.animate(
																		{
																			scrollTop : 0
																		},
																		"slow");
														return;
													}
													$
															.post(
																	'src/AppBundle/Controller/controller_services.php',
																	this.$form
																			.serialize(),
																	function(
																			response) {
																		var message = response.message;

																		if (message
																				.indexOf("Successfully") > -1) {
																			$(
																					'#lbl_message_new_service')
																					.text(
																							message);
																			$(
																					'#lbl_message_new_service')
																					.removeClass(
																							"display-none alert-danger")
																					.addClass(
																							"alert-success");
																		} else {
																			$(
																					'#lbl_message_new_service')
																					.text(
																							message);
																			$(
																					'#lbl_message_new_service')
																					.removeClass(
																							"display-none alert-success")
																					.addClass(
																							"alert-danger");
																		}
																		$(
																				"html, body")
																				.animate(
																						{
																							scrollTop : 0
																						},
																						"slow");
																	}, 'json');
												}
											}
										});

					});
}

var format = function(num) {
	var str = num.toString().replace("R", ""), parts = false, output = [], i = 1, formatted = null;
	if (str.indexOf(".") > 0) {
		parts = str.split(".");
		str = parts[0];
	}
	str = str.split("").reverse();
	for (var j = 0, len = str.length; j < len; j++) {
		if (str[j] != ",") {
			output.push(str[j]);
			if (i % 3 == 0 && j < (len - 1)) {
				output.push(",");
			}
			i++;
		}
	}
	formatted = output.reverse().join("");
	return ("R" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
};

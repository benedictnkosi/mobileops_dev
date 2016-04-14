// JavaScript Document

$(document).ready(function() {
	sessionStorage.mobileops_seletedBookingDate = "null";
	sessionStorage.mobileops_seletedBookingTime = "null";
	sessionStorage.mobileops_providerSelected = "false";
	
	if (!sessionStorage.mobileops_email_address) {
		if(getCookie("mobileops") == null){
			//window.location.href = "/index.php?logout";
		}else{
			saveCookieToSession();
		}
		getAllServices();
		
	}else{
		if (getUrlParameter('editbooking')) {
			getAllBookingdata();
			getAllServices();
		}else{
			getAllServices();
			getClientProfile();
			var d = new Date();
			var dateHolder = (d.getDate() + 1)  + '.' + (d.getMonth() + 1) + '.' + d.getFullYear();
			intialiseDateTimePicker(dateHolder.toString(), '09:00');
		}
		
	}
	
	
});

function getAllBookingdata(){
	//get Booking details
	getBookingDetails();
	//get booking Date, 
	
	//get booked services
	
	//get selected partner
	
	
}


function getBookingDetails(){
	
	$.ajax({
		type : 'GET',
		url : 'src/AppBundle/Controller/controller_bookingdetails.php?getBookingDetails=' + getUrlParameter("editbooking"),
		data : 'bookingId=' + getUrlParameter("editbooking"),
		dataType : "json",
		success : function(data) {
			$('#firstname').val(data['client_name']);
			$('#surname').val(data['client_surname']);
			$('#email').val(data['client_email_address']);
			$('#mobile_number').val(data['client_mobile_number']);
			$('#address').val(data['booking_address']);
			$('#complex').val(data['booking_complex']);
			$('#input_Latitude').val(data['lat']);
			$('#input_Longitude').val(data['lng']);
			$('#input_province').val(data['administrative_area_level_1']);
			$('#input_street_name').val(data['input_street_name']);
			$('#input_city').val(data['locality']);
			$('#input_suburb').val(data['sublocality']);
			
			//set date time picker date and time
			var res = data['booking_date'].split("-");
			day = res[2].substring(0, 2);
			intialiseDateTimePicker(day + '.' + res[1] + '.' + res[0], res[2].substring(3));
			
			//select the booking services
			$( "#chk_Treatment" ).prop( "checked", true );
	},
	});
}


function intialiseDateTimePicker(bookignDate, bookingTime){
	$('#datetimepicker').datetimepicker({

		  //value:'19.10.2015 09:00',
		  defaultDate:bookignDate + ' 00:00',
		  defaultTime:bookingTime,
		  format:'d.m.Y H:i',

		  inline:true,

		  lang:'ru',

		  minDate:0,


		  allowTimes:[

		              '07:00', '07:30', '08:00', '08:30','09:00', '09:30','10:00', '10:30','11:00', '11:30','12:00', '12:30','13:00', '13:30',

		              '14:00', '14:30','15:00', '15:30','16:00', '16:30','17:00', '17:30','18:00', '18:30','19:00', '19:30','20:00', '20:30',

		              '21:00',

		             ],
		             onSelectTime: function(dp, $input) {
			 			 sessionStorage.mobileops_seletedBookingTime = dp.dateFormat('H:i');
			 			$('#booking_time').val(dp.dateFormat('H:i'));
		            	 },

		  			onSelectDate: function(dp, $input) {
		            		 sessionStorage.mobileops_seletedBookingDate = dp.dateFormat('Y/m/d');
		            		 $('#booking_date').val(dp.dateFormat('Y/m/d'));
		 	            	 },

		            	 onGenerate: function(dp, $input) {
		 		            	 //alert(dp.dateFormat('Y/m/d'));
			            		 sessionStorage.mobileops_seletedBookingDate = dp.dateFormat('Y/m/d');
			            		 sessionStorage.mobileops_seletedBookingTime = dp.dateFormat('H:i');
			            		 $('#booking_time').val(dp.dateFormat('H:i'));
			            		 $('#booking_date').val(dp.dateFormat('Y/m/d'));
			 	            	 },

		});
}



function clearSelections(){
	  $('.skills_checkbox_item').removeAttr('checked');
	  $('.ideal-check').removeClass( "checked", 1000, "easeInBack" );
}


function getAllServices(){
	$.ajax({
		type : 'GET',
		url : 'src/AppBundle/Controller/controller_services.php',
		data : 'getAllServices=All',
		dataType : "json",
		success : function(response) {
		var SkillAccordian = document.getElementById("accordion");
		var data = response.message;
		for (i = 0; i < data.length; i++) { 
		    var arraySkills = data[i];
		    var test = "asas";
		    
		    var categoryDiv = document.createElement("div"); //  <div>
		    var fieldDiv = document.createElement("div"); // <div class="field">
		    fieldDiv.className = "field";
		    
		    for (j = 0; j < arraySkills.length; j++) { 
		    	 var skill = arraySkills[j];
		    	 
		    	 if(j == 0){
		    		var h = document.createElement("H3")  ;              // <h3>Hair</h3>
		 		    h.appendChild(document.createTextNode(skill)); 
		    		SkillAccordian.appendChild(h);
		    		categoryDiv.id = "div_" +  skill;
		    		
		    	 }else{
		    		 //<input type="checkbox" class="skills_checkbox_item" id="inlineCheckbox1" value="option1">
		    	     var newCheckBox = document.createElement("input");	
		    		 newCheckBox.type = 'checkbox';
		    		 newCheckBox.className =  "skills_checkbox_item";
		    		 newCheckBox.name =  "skills_checkbox_item[]";
		    		 newCheckBox.id =  "chk_" + skill;
		    		 newCheckBox.value =  skill;
		    		 
		    		 //<label for="inlineCheckbox1"> SIMPLE WASH </label>
		    		 var label = document.createElement("label");	
		    		//label.htmlFor = "chk_" + skill; 
		    		 
		    		label.innerHTML = skill;
		    		label.appendChild(newCheckBox);

		    		//checkbox_div.appendChild(label);
		    		
		    		fieldDiv.appendChild(label);
		    	 }
		    }
		    
		    categoryDiv.appendChild(fieldDiv);
		    SkillAccordian.appendChild(categoryDiv);
		    
		    $('.skills_checkbox_item').change(function() {
		    	sessionStorage.mobileops_providerSelected = "false";
		    });
		    
		}
		
		$( "#accordion" ).accordion({
		      activate: function( event, ui ) {clearSelections();}
		    });
		
		$.getScript( "web/js/out/jquery.idealforms.js", function( data, textStatus, jqxhr ) {
			$('form.idealforms').idealforms({

			      silentLoad: true,
			      rules: {
			    	'name': 'required',
			        'surname': 'required',
			        'email': 'required email',
			        'mobile_number': 'required number min:10 max:10',
			        'address': 'required',
			        //'skills_checkbox_item[]': 'minoption:1',
			        //'skills_checkbox_item1[]': 'minoption:1 maxoption:3',

			      },
			      
			      errors: {
			    	  'skills_checkbox_item[]': {
			    	  ajaxError: 'No Services Selected'
			    	  }
			    	  },

			      steps: {

			    	  MY_stepsItems: ['Step 1', 'Step 2',  'Step 3',   'Step 4','Step 5'],

			    	  buildNavItems: function(i) {
			    	    return this.opts.steps.MY_stepsItems[i];
			    	  },
			    	  after: function(){
			    		 element =  $('li.idealsteps-step-active');
			    		 selectedTab = element[0].firstChild.firstChild.data;
			    		 //var selectedTab = this.firstChild.firstChild.data;
					    	var checkedValues = $('.skills_checkbox_item:checked').map(function() {
				    		    return this.value;
				    		}).get();
					    	
					    	if(("Step 5".localeCompare(selectedTab) == 0) && sessionStorage.mobileops_providerSelected.localeCompare("false") == 0){
					    		if(checkedValues.length > 0){
					    			//$( ".idealsteps-nav ul li").eq(3).click();
					    			$('form.idealforms').idealforms('goToStep',3);
					    			$( '#lbl_message' ).show(function(){
					    			      $(this).fadeOut(3000);
					    			});
					    		}else{ 
					    			//$( ".idealsteps-nav ul li").eq(3).click();
					    			$('form.idealforms').idealforms('goToStep',2);
					    			$( '#lbl_service_message' ).show(function(){
					    			      $(this).fadeOut(3000);
					    			});
					    			
					    		}
					    	}else if (("Step 5".localeCompare(selectedTab) == 0) && sessionStorage.mobileops_providerSelected.localeCompare("false") != 0){

					    		getTotalAmountDue();
					    		
					    		$( "#personalDetails" ).empty();
					    		
					    		var element = document.getElementById("personalDetails");
					    		
					    		element.appendChild(document.createTextNode($('#firstname').val() + " " + $('#surname').val()));
					    		element.appendChild(document.createElement("br")); 
					    		
					    		element.appendChild(document.createTextNode($('#email').val()));
					    		element.appendChild(document.createElement("br"));
					    		
					    		element.appendChild(document.createTextNode($('#mobile_number').val()));
					    		element.appendChild(document.createElement("br"));
					    		
					    		element.appendChild(document.createTextNode($('#complex').val()));
					    		element.appendChild(document.createElement("br"));
					    		
					    		element.appendChild(document.createTextNode($('#address').val()));
					    		element.appendChild(document.createElement("br"));
					    		
					    		//selected date
					    		$( "#lbl_date" ).empty();
					    		var element = document.getElementById("lbl_date");
					    		element.appendChild(document.createTextNode(FormatDateLong()));
					    		element.appendChild(document.createElement("br"));
					    		

					    		
					    		//selected provider
					    		
					    		$( "#lbl_providername" ).empty();
					    		var element = document.getElementById("lbl_providername");
					    		element.appendChild(document.createTextNode("Your service provider is " + $('#lblpartner' + sessionStorage.mobileops_providerSelected).text()));
					    		//$('#selectedProviderImage').attr("src", "images/partner_profile/profile_" + sessionStorage.mobileops_providerSelected + ".jpg");

					    	}
					    	
					    	if(("Step 4".localeCompare(selectedTab) == 0) ){
					    		if(checkedValues.length < 1){
					    			$( ".idealsteps-nav ul li").eq(3).click();
					    			$( '#lbl_service_message' ).show(function(){
					    			      $(this).fadeOut(3000);
					    			});
					    			$('form.idealforms').idealforms('goToStep',2);
					    		}else{
					    			sessionStorage.mobileops_providerSelected = "false";
					    			form = $('form.idealforms');
					    			getBestPartners(form.serialize());
					    		}
					    	}
			    		 
			    	  }
			    	},

			    	
			    	
			  	
			    	onSubmit: function(invalid, e) {
			  	    e.preventDefault();

			  	    if (invalid) {
			  	    	$('#invalid')

			            .show()

			            .toggleClass('valid', ! invalid)

			            .text(invalid ? (invalid +' invalid fields') : 'All good!');
			  	    } else {
			  	    	var checkedValues = $('.skills_checkbox_item:checked').map(function() {
			    		    return this.value;
			    		}).get();
			  	    	
			  	      var selectedStep = $( ".idealsteps-step-active"); 
			  	      if(("Step 5".localeCompare(selectedStep[0].firstChild.firstChild.data) == 0) ){
			  	    	  if("Complete Booking".localeCompare(e.originalEvent.explicitOriginalTarget.innerHTML) == 0){
			  	    		 $.post('src/AppBundle/Controller/controller_booking.php?completeBooking=true', this.$form.serialize(), function(response) {  
					  	    		if(response.message.indexOf("Successful") > -1){
					  	    			window.location.href = "/index.php?bookingdetails=" + response.bookingid;
					  	    		}else{
					  	    			$('#lbl_booking_message').text(response.message);
					  	    			$('#lbl_booking_message').removeClass( "display-none" ).addClass( "alert-danger" );
					  	    			$("html, body").animate({ scrollTop: $("#lbl_booking_message").offset().top}, "slow");
					  	    		}
			  	    		
							  	      }, 'json');
			  	    	  }
			  	    	
			  	      }
			  	     
			  	    }    
			  	  }
			  	  

			    });

			    $('form.idealforms').find('input, select, textarea').on('change keyup', function() {

			      $('#invalid').hide();

			    });



			    $('form.idealforms').idealforms('addRules', {

			      'comments': 'minmax:1:500'

			    });

			    

			    $('.idealsteps-nav li').click(function(event){
			    	$('form.idealforms').idealforms('focusFirstInvalid');
				    });
			    
			    $('.prev').click(function(){

			      $('.prev').show();

			      $('form.idealforms').idealforms('prevStep');

			    });

			    $('.next').click(function(){
			      	
			      $('.next').show();

			      $('form.idealforms').idealforms('nextStep');

			    });
			  
			});
	},
	});
}


function FormatDateLong(){
	//date not set, set default to tomorrow same time + 24 hours
	if( (sessionStorage.mobileops_seletedBookingDate.localeCompare("null") == 0) && (sessionStorage.mobileops_seletedBookingTime.localeCompare("null") == 0) ){
		var today = new Date();
		var date =  new Date();
		date.setDate(today.getDate() + 1);
		var shortDate = date.toString().split('GMT');
		return shortDate[0];
	}
	
	var seletedBookingDate = sessionStorage.mobileops_seletedBookingDate;			    				    		
	var seletedBookingTime = sessionStorage.mobileops_seletedBookingTime;
				    		
	var partsOfDate = seletedBookingDate.split('.');
				    		
	var newDateString = seletedBookingDate + " " + seletedBookingTime ;
	var d = new Date(newDateString);

	var shortDate = d.toString().split('GMT');
	return shortDate[0];
}


function getClientProfile(){
	$.ajax({
		type : 'GET',
		url : 'src/AppBundle/Controller/controller_client_profile.php',
		data : 'getClientProfile=' + sessionStorage.mobileops_email_address,
		dataType : "json",
		success : function(response) {
			data = response.message;
			$('#firstname').val(data['name']);
			$('#surname').val(data['surname']);
			$('#email').val(data['email']);
			$('#mobile_number').val(data['mobile_number']);
			
			if(data['latitude'] !== null){
				$('#address').val(data['address']);
				$('#complex').val(data['complex']);
				$('#input_Latitude').val(data['latitude']);
				$('#input_Longitude').val(data['longitude']);
				$('#input_street_name').val(data['street_name']);
				$('#input_street_number').val(data['street_number']);
				$('#input_province').val(data['province']);
				$('#input_suburb').val(data['suburb']);
				$('#input_city').val(data['city']);
			}
	},
	});
}



function getTotalAmountDue(formdata){
	
	var checkedValues = $('.skills_checkbox_item:checked').map(function() {
	    return this.value;
	}).get();
	
	var jsonString = JSON.stringify(checkedValues);
	
	$.ajax({
		type : 'GET',
		url : 'src/AppBundle/Controller/controller_booking.php?getServicePrices=true&region=' + $('#input_city').val(),
		data: {"services" : jsonString}, 
		dataType : "json",
		success : function(response) {
			$('.serviceRow').remove();
			var services = response.message;
			var pricesString = "";
			var totalPrice = 0;
			var rowNum = 3;
			var table = document.getElementById("invoice_table");
			
			for (i = 0; i < services.length; i++){
				var row = table.insertRow(rowNum);
				row.className = "serviceRow";
				rowNum += 1;
				var cell1 = row.insertCell(0);
				var cell2 = row.insertCell(1);
				
				cell1.innerHTML = response.message[i][0];
				cell2.innerHTML = "R" + parseFloat(Math.round(response.message[i][1] * 100) / 100).toFixed(2);
				
				//pricesString = pricesString + response.message[i][0] + ": R" + parseFloat(Math.round(response.message[i][1] * 100) / 100).toFixed(2) + "<br/>";
				totalPrice = totalPrice + parseInt(response.message[i][1]);
			}
			//$("#totalAmountDueDiv").html(pricesString + "<br/>Tatal : R" + parseFloat(Math.round(totalPrice * 100) / 100).toFixed(2));
			var row = table.insertRow(rowNum);
			row.className = "serviceRow";
			var cell1 = row.insertCell(0);
			var cell2 = row.insertCell(1);
			
			cell1.innerHTML = "";
			cell2.innerHTML = "Total: R" + parseFloat(Math.round(totalPrice * 100) / 100).toFixed(2);
		},
		
		});
}



function getBestPartners(formdata){
	$("#bestPartnersDiv").load("src/AppBundle/Controller/controller_booking.php?getBestPartners=getBestPartners&" + formdata, function() {
		 $('.selectPartner').click(function(event){
			    event.preventDefault();
			    $("#selectPartner").bind("click", selectPartner(event));
		 });
		 
		 $(".rating ").rating({
	         starCaptions: {0: "Not Rated",1: "Very Poor", 2: "Poor", 3: "Ok", 4: "Good", 5: "Very Good"},
	         starCaptionClasses: {1: "text-danger", 2: "text-warning", 3: "text-info", 4: "text-primary", 5: "text-success"},
	         });
	});
}

//event id is partner + partner id we just need to save the id
function selectPartner(event){
	var i = event.target.id.toString();
	sessionStorage.mobileops_providerSelected = i.replace("partner", "");
	$('.selectPartner').removeClass( "selectedPartner", 1000, "easeInBack" );
	$('#' + event.target.id).addClass( "selectedPartner");
	$('form.idealforms').idealforms('goToStep',4);
}

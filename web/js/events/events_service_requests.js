// JavaScript Document

$(document).ready(function() {
	if (getCookie("mobileops_temp_login") == null) {
		if(getCookie("mobileops") == null){
			window.location.href = "/index.php?logout";
		}else{
			saveCookieToSession();
		}
	}
	
	
$("#service_category").change(function() {
		
		if($(this).find('option:selected').index() == 0){
			$('#service_name').empty();
			return;
		}else{
			getServicesByServiceType();
			
		}
	});

	getServiceRequests();
	
});



function getServicesByServiceType(){

	$('#service_name').empty().append('<option value="DEFAULT">----SELECT SERVICE-----</option>');
	
	var parameters = "getServicesByServiceType=" + $('#service_category').val();

$.ajax({
type : 'GET',
url : '/src/AppBundle/Controller/controller_services.php',
data : parameters,
dataType : "json",
success : function(response) {
	data = response.message;
	
	if(response.status == 2){
		$('#lbl_message').text(data);
		$('#lbl_message').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
		$("html, body").animate({
			scrollTop : $(".container").offset().top
		}, "slow");
		return;
	}
	
	for (i = 0; i < data.length; i++) { 
	    $('#service_name').append($('<option>', { 
	        value: data[i],
	        text : data[i] 
	    }))
	}
},
});
}




function getServiceCategories(){

	$('#service_category').empty().append('<option value="DEFAULT">----SELECT CATEGORY-----</option>');
	
	var parameters = "getServiceCategories=true";

$.ajax({
type : 'GET',
url : '/src/AppBundle/Controller/controller_services.php',
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
	
	for (i = 0; i < data.length; i++) { 
	    $('#service_category').append($('<option>', { 
	        value: data[i],
	        text : data[i] 
	    }))
	}
},
});
}

function addServiceRequestsRows(serviceRequests){
	$('.bookingRow').remove();
	var rowNum = 1;
	var table = document.getElementById("serviceRequests_table");
	
	for (i = 0; i < serviceRequests.length; i++){
		var row = table.insertRow(rowNum);
		row.className = "bookingRow";
		rowNum += 1;
		var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		var cell3 = row.insertCell(2);
		var cell4 = row.insertCell(3);
		var cell5 = row.insertCell(4);
		
		
		
		cell1.innerHTML = serviceRequests[i][0];
		cell2.innerHTML =  serviceRequests[i][1];
		cell3.innerHTML =  serviceRequests[i][2];
		cell4.innerHTML =  '<a onclick="acceptServiceRequest(event);return false;" href=""  class="button"  id="' + serviceRequests[i][3] + '">Accept</a>';
		cell5.innerHTML =  '<a onclick="showRejectServiceRequestPanel(event);return false;" href="" class="button" id="' + serviceRequests[i][3] + '">Reject</a>';

	}
}

function acceptServiceRequest(event){
	var r = confirm("Are you sure you want to accept?");
	if (r == false) {
	    return;
	} 
	
	
	$.ajax({
		type : 'GET',
		url : 'src/AppBundle/Controller/controller_services.php?acceptServiceRequest=' + event.target.id.toString(),
		dataType : "json",
		success : function(data) {
			//check if booking id found
			
			if(data.status == 2){
				$('#lbl_message').text(data.message);
				$('#lbl_message').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
			}else{
				$('#lbl_message').text(data.message);
				$('#lbl_message').removeClass( "display-none alert-danger" ).addClass( "alert-success" );
				getServiceRequests();
				
			}
			$("html, body").animate({
				scrollTop : $(".container").offset().top
			}, "slow");

	},
	});
}

function showRejectServiceRequestPanel(event){
	$('#replacement_service').removeClass( "display-none" ).addClass();
	sessionStorage.mobileops_selectedServiceRequest =  event.target.id.toString();
	getServiceCategories() ;
	
	
	
}

function rejectServiceRequest(event){
	if($('#service_name').find('option:selected').index() == 0 || $('#service_category').find('option:selected').index() == 0 ){
		return;
	}
	
	$.ajax({
		type : 'GET',
		url : 'src/AppBundle/Controller/controller_services.php?rejectServiceRequest=' + sessionStorage.mobileops_selectedServiceRequest
		+ "&service_category=" + $('#service_category').val()
		+ "&service_name=" + $('#service_name').val() ,
		dataType : "json",
		success : function(data) {
			//check if booking id found
			
			if(data.status == 2){
				$('#lbl_message').text(data.message);
				$('#lbl_message').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
			}else{
				$('#lbl_message').text(data.message);
				$('#lbl_message').removeClass( "display-none alert-danger" ).addClass( "alert-success" );
				$('#replacement_service').addClass("display-none");
				getServiceRequests();
				
			}
			$("html, body").animate({
				scrollTop : $(".container").offset().top
			}, "slow");

	},
	});
	
	
}


function getServiceRequests(){

	$('.bookingRow').remove();
	
	$.ajax({
		type : 'GET',
		url : 'src/AppBundle/Controller/controller_services.php?getServiceRequests=open',
		dataType : "json",
		success : function(data) {
			//check if booking id found
			
			if(data.status == 2){
				$('#lbl_message').text(data.message);
				$('#lbl_message').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
				$('#invoice_table').addClass('display-none')
				return;
			}

			var serviceRequestsArray = data['serviceRequests'];
			addServiceRequestsRows(serviceRequestsArray);
			
	},
	});
}



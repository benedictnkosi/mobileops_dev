// JavaScript Document

$(document).ready(function() {
	$( "#dropdown_region" ).change(function() {
		getServiceCategoriesForRegion();
		});
	
	$( "#dropdown_serviceType" ).change(function() {
		getPrices();
		});
	
	getRegions();
});

function getRegions(){
var parameters = "getRegions=all";

$.ajax({
type : 'GET',
url : '/src/AppBundle/Controller/controller_pricelist.php',
data : parameters,
dataType : "json",
success : function(response) {
	data = response.message;
	for (i = 0; i < data.length; i++) { 
	    $('#dropdown_region').append($('<option>', { 
	        value: data[i],
	        text : data[i] 
	    }))
	}
},
});
}


function getServiceCategoriesForRegion(){
	
	$('#dropdown_serviceType').empty().append('<option value="DEFAULT">----SELECT CATEGORY-----</option>');
	$('#lbl_message').addClass( "display-none" );
	
	var parameters = "getServiceCategoriesForRegion=" + $( "#dropdown_region" ).val();

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
	
	for (i = 0; i < data.length; i++) { 
	    $('#dropdown_serviceType').append($('<option>', { 
	        value: data[i],
	        text : data[i] 
	    }))
	}
},
});
}

function getPrices(){
	// empty table before repopulating and clear message label
	$("#jsontotable-obj").html("");
	$('#lbl_message').addClass( "display-none" );
	
	
	var parameters = "getPricelist=" + $( "#dropdown_region" ).val() + "&servicetype=" +  $( "#dropdown_serviceType" ).val();
$.ajax({
type : 'GET',
url : '/src/AppBundle/Controller/controller_pricelist.php',
data : parameters,
dataType : "json",
success : function(response) {
	/* JSON To Table (Has Header) */
	data = response.message;
	if(response.status == 2){
		$('#lbl_message').text(data);
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




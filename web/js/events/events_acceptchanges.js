// JavaScript Document

$(document).ready(function() {
		acceptChanges();
});

function acceptChanges(){
	
	$.ajax({
		type : 'GET',
		url : 'src/AppBundle/Controller/controller_booking.php',
		data : 'acceptChanges=' + getUrlParameter('acceptchanges') + "&uuid=" + getUrlParameter('uuid') ,
		dataType : "json",
		success : function(response) {
			if(response.status == 1){
				$('#lbl_message').text(response.message);
				$('#lbl_message').removeClass( "display-none alert-danger" ).addClass( "alert-success" );
			}else{
				$('#lbl_message').text(response.message);
				$('#lbl_message').removeClass( "display-none alert-success" ).addClass( "alert-danger" );
			}
			$("html, body").animate({ scrollTop: $("#lbl_message").offset().top}, "slow");
	},
	});
	
}
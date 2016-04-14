// JavaScript Document

$(document).ready(function() {
	getFaq();
});



function getFaq(){
	$.ajax({
		type : 'GET',
		url : 'src/controller/controller_faq.php',
		data : 'getFaq=all',
		dataType : "json",
		success : function(response) {
		var data = response.message;
		var faq_group = document.getElementById("basics");
		
		for (i = 0; i < data.length; i++) { 
		    var arrayFaq = data[i];
		    var faq_li = document.createElement("li"); // <div>
		   
		    var faq_a = document.createElement("a");
		    faq_a.className = "cd-faq-trigger";
		    faq_a.href="#0";
		    faq_a.innerHTML = arrayFaq[0];
		    
		    var faq_content_div = document.createElement("div");
		    faq_content_div.className = "cd-faq-content";
		    
		    var faq_answer = document.createElement("div");
		    faq_answer.innerHTML = arrayFaq[1]
		    
		    
		    faq_content_div.appendChild(faq_answer);
		    faq_li.appendChild(faq_a);
		    faq_li.appendChild(faq_content_div);
		    faq_group.appendChild(faq_li);
		}

		$.getScript( "js/jquery-2.1.1.js", function( data, textStatus, jqxhr ) {
		})
		
		$.getScript( "js/jquery.mobile.custom.min.js", function( data, textStatus, jqxhr ) {
		})
		
		$.getScript( "js/main.js", function( data, textStatus, jqxhr ) {
		})
	},
	});
}


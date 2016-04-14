// JavaScript Document
$(document).ready(function() {

	   if (!sessionStorage.mobileops_email_address) {
	        if (getCookie("mobileops") == null) {
	        	window.location.href = "/index.php?logout";
	        } else {
	            saveCookieToSession();
	        }
	    }

	    if (sessionStorage.mobileops_user_role.localeCompare("PARTNER") !== 0) {
	        window.location.href = "/index.php";
	    }
   
	// this is to track uploaded images and to match them to their server names
	// when the user wished to delete them
	var mobileops_uploadedImages = [];
	sessionStorage["mobileops_uploadedImages"] = JSON.stringify(mobileops_uploadedImages);

	
    Dropzone.autoDiscover = false;
    $("#fileUpload_dropzone").dropzone({
        dictDefaultMessage: "Drop files here or click to upload.",
        clickable: true,
        enqueueForUpload: true,
        maxFilesize: 3,
        addRemoveLinks: true,
        uploadMultiple: false,
        maxFiles: 20,

        // on initialize get the images on the server for the partner
        init: function() {
            thisDropzone = this;
            $.get('/src/AppBundle/Logic/file_upload.php', function(data) {
                $.each(data, function(key, value) {
                    var mockFile = {
                        name: value.name,
                        size: value.size
                    };
                    thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                    thisDropzone.options.thumbnail.call(thisDropzone, mockFile, "images/partner_gallery/" + value.name);
                    $( ".dz-details" ).remove();
                    $( ".dz-progress" ).remove();
                });
            });

            // delete from server
            this.on("removedfile", function(file) {
            	var isFileDeleted = false;
            	
            	// get the mapped server name for the file the user is trying to
				// delete and send that to the server
            	var mobileops_uploadedImages = JSON.parse(sessionStorage["mobileops_uploadedImages"]);
            	for (i = 0; i < mobileops_uploadedImages.length; i++) { 
            		var uploadedImage;
            		
            		if (mobileops_uploadedImages[i] !== null){
            			uploadedImage = mobileops_uploadedImages[i].split("###");
            		}else{
            			continue;
            		}
            		
            		if(uploadedImage[1].localeCompare(file.name) == 0){
            			isFileDeleted = true;
            			delete mobileops_uploadedImages[i];
            			sessionStorage["mobileops_uploadedImages"] = JSON.stringify(mobileops_uploadedImages);
            			$.get("src/AppBundle/Controller/controller_partner_profile.php?deleteimage=thumb_" + uploadedImage[0], function(data,
                                status) {
                                if (data.indexOf("success") > -1) {
                                	return;
                                } else {
                                    $('#lbl_message').text("Failed to delete image from server, please reload the page and try again.");
                                    $('#lbl_message').removeClass("display-none alert-success alert-warning").addClass("alert-danger");
                                    return;
                                }
                            });
            		}
            	}
            	
            	// if the file was not found on the recently uploaded images and
				// its one of the previously uploaded images
            	// call the server with the filename as its already loaded from
				// the server
            	if(!isFileDeleted){
            		$.get("src/AppBundle/Controller/controller_partner_profile.php?deleteimage=" + file.name, function(data,
                            status) {
                            if (data.indexOf("success") > -1) {
                            	return;
                            } else {
                                $('#lbl_message').text("Failed to delete image from server, please reload the page and try again.");
                                $('#lbl_message').removeClass("display-none alert-success alert-warning").addClass("alert-danger");
                                return;
                            }
                        });
            	}
            	
            	
                
            });
            
            // on successfull upload, add the server anme mappinging to the
			// array and save in sessiopn storage
            this.on("success", function(file, responseText) {
                var mobileops_uploadedImages = JSON.parse(sessionStorage["mobileops_uploadedImages"]);
                mobileops_uploadedImages.push(responseText); 
                sessionStorage["mobileops_uploadedImages"] = JSON.stringify(mobileops_uploadedImages);
            });
            
        }
    });


 

    getPartnerProfile();
    getPartnerServices();
});


function getPartnerProfile() {
    $.ajax({
        type: 'GET',
        url: 'src/AppBundle/Controller/controller_partner_profile.php',
        data: 'getPartnerProfile=' + sessionStorage.mobileops_email_address,
        dataType: "json",
        success: function(response) {
            var data = response.message;
            $('#firstname').val(data['name']);
            $('#surname').val(data['surname']);
            $('#idnumber').val(data['idnumber']);
            $('#email').val(data['email']);
            $('#mobile_number').val(data['mobile_number']);
            $("#gender").val(data['gender']);
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
        },
    });
}


function getPartnerServices() {
    $.ajax({
        type: 'GET',
        url: 'src/AppBundle/Controller/controller_partner_profile.php',
        data: 'getPartnerServices=' + sessionStorage.mobileops_email_address,
        dataType: "json",
        success: function(response) {
            var data = response.message;
            var serviceType = ""; // used to track the current service type
            var partnerServicesDiv = document.getElementById("partnerServicesDiv");
            var ul;
            var arrayServiceNames = [];
            for (i = 0; i < data.length; i++) {
                // if other service type create a heading with service type name
				// and create a new unordered list element
                if (serviceType.indexOf(data[i][0]) < 0) {
                    ul = document.createElement("ul")
                    ul.id = data[i][0];
                    var h = document.createElement("H3")
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
                ul.appendChild(listItem);
                arrayServiceNames.push(serviceName);
            }

            // save the partner services in the sessionStorage
            sessionStorage["partnerServices"] = JSON.stringify(arrayServiceNames);

        },
    });
}
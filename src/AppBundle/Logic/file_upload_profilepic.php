<?php

require_once(__DIR__.'/../../../bootstrap.php');

require_once(__DIR__.'/../Entity/User.php');
require_once(__DIR__.'/../Entity/LuAccountStatus.php');
require_once(__DIR__.'/../Entity/LuUserRole.php');
require_once(__DIR__.'/../Entity/UserProfile.php');
require_once(__DIR__.'/../Entity/Address.php');

include('class.upload.php');

try {
	session_start ();
} catch (Exception $e) {
}

try {


	$dir_dest = 'web/bundles/framework/images/partner_profiles/';
	//check if this call is for getting images or uploading. if uploading the FILES array wont be empty
	if (!empty($_FILES)) {

		$handle = new Upload($_FILES['file']);
			
		//if the file is saved successfully save a thumbnail version of the file
		if ($handle->processed) {
			//save thumbnail
			// yes, the file is on the server
			// below are some example settings which can be used if the uploaded file is an image.
			$handle->image_resize            = true;
			$handle->image_ratio_y           = true;
			$handle->image_x                 = 150;
			$handle->file_new_name_ext       = 'jpg';
			$handle->file_overwrite       = true;
			
			
			// now, we start the upload 'process'. That is, to copy the uploaded file
			//from its temporary location to the wanted location
			// It could be something like $handle->Process('/home/www/my_uploads/');

			$handle->file_new_name_body = "profile_" . $_SESSION['user_id'];
			$handle->Process($dir_dest);

			//if the file is saved successfully store the file name in the db
			if ($handle->processed) {
				echo $dir_dest . "profile_" . $_SESSION['user_id'] . ".jpg";
				//echo "balls";
			}

		} else {
			// one error occured
			echo 'Failed to upload file.';
			return;
		}
			
		//for getting partner images
	}else{
		$obj['name'] = "profile_" . $_SESSION['user_id'] .'.jpg';
		$obj['size'] = filesize($dir_dest. "profile_" . $_SESSION['user_id'] . '.jpg');

		header('Content-type: text/json');              //3
		header('Content-type: application/json');
		echo json_encode($obj);
	}

} catch (Exception $e) {
	echo $e;//"failed to upload file.";
}

?>
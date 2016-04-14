<?php
require_once(__DIR__.'/../../../bootstrap.php');

require_once(__DIR__.'/../Entity/User.php');
require_once(__DIR__.'/../Entity/PartnerImages.php');
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


	$dir_dest = 'web/bundles/framework/images/partner_gallery/';
	//check if this call is for getting images or uploading. if uploading the FILES array wont be empty
	if (!empty($_FILES)) {
		
			$handle = new Upload($_FILES['file']);
			if ($handle->uploaded) {
				// yes, the file is on the server
				// below are some example settings which can be used if the uploaded file is an image.
				$handle->image_resize            = true;
				$handle->image_ratio_y           = true;
				$handle->image_x                 = 500;
				
				
				
				// now, we start the upload 'process'. That is, to copy the uploaded file
				// from its temporary location to the wanted location
				// It could be something like $handle->Process('/home/www/my_uploads/');
				$imageName = uniqid('g_image_');
				$handle->file_new_name_body = $imageName;
				$handle->Process($dir_dest);

				//if the file is saved successfully save a thumbnail version of the file
				if ($handle->processed) {
					//save thumbnail
					// yes, the file is on the server
					// below are some example settings which can be used if the uploaded file is an image.
					$handle->image_resize            = true;
					$handle->image_ratio_y           = true;
					$handle->image_x                 = 150;
					// now, we start the upload 'process'. That is, to copy the uploaded file
					//from its temporary location to the wanted location
					// It could be something like $handle->Process('/home/www/my_uploads/');

					$handle->file_new_name_body = 'thumb_'. $imageName;
					$handle->Process($dir_dest);

					//if the file is saved successfully store the file name in the db
					if ($handle->processed) {
						$user = $entityManager->getRepository('User')->findOneBy(array('emailAddress' => $_SESSION ['email_address']));
						$partnerImage = new PartnerImages();
						
						$pos = strrpos($_FILES['file']['name'], ".");
						$ext = substr($_FILES['file']['name'], $pos);
						//$ext = $_FILES['file']['name];
						$partnerImage->setImageName($imageName . strtolower($ext));
						$partnerImage->setUser($user);

						$entityManager->persist($partnerImage);
						$entityManager->flush();

						echo $imageName . $ext .'###' .$_FILES["file"]["name"];
					}

				} else {
					// one error occured
					echo 'Failed to upload file.';
					return;
				}
			}
			//for getting partner images
	}else{
		$result  = array();
		$user = $entityManager->getRepository('User')->findOneBy(array('emailAddress' => $_SESSION ['email_address']));
		$partnerImages = $entityManager->getRepository('PartnerImages')->findBy(array('user' => $user,'active'=>1));
		foreach ($partnerImages as &$file) {
			$obj['name'] = 'thumb_' . $file->getImageName();
			$obj['size'] = 3000;//filesize($dir_dest. 'thumb_' . $file->getImageName());
			$result[] = $obj;
		}

		header('Content-type: text/json');              //3
		header('Content-type: application/json');
		echo json_encode($result);
	}

} catch (Exception $e) {
	echo $e->getTraceAsString();//"failed to upload file.";
}

?>
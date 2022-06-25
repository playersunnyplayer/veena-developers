<?php
include 'includes_config/db.config.class.php';

if(isset($_POST['mode']) || !empty($_POST['mode'])){
	if($_POST['mode']=='down'){
	 $downid = $_POST['downid'];
	 $name = $_POST['name'];
	 $mobile = $_POST['mobile'];
	 $email = $_POST['email'];

		

	$ProjectDownloadsData = $ProjectDownload->GetProjectDownloadDetails($downid);
	  $ProjectDownloadTitle = $ProjectDownloadsData["msp_title"];
	  $ProjectCurrentStatusImages2 = $ProjectDownloadsData["msp_image2"];
	
	  $sqlQueryAdd = "INSERT INTO `msp_enquiry_download` (`project_name`,`name`,`mobile`,`email`)VALUES ('$ProjectDownloadTitle','$name','$mobile','$email')";

    	$sqlRes = $CMS->dbquery($sqlQueryAdd) or die("Err : ".mysql_error());


    	$filepath = "images/download_images/pdf/".$ProjectCurrentStatusImages2;
    
    // Process download
    if(file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        flush(); // Flush system output buffer
        readfile($filepath);
        
    }else{
	    header("Location: $siteurl/projects");
    }
	}

}
?>
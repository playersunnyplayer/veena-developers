<?php


//$SessionWebsiteID = $_SESSION['web_id'];
$GetWebsiteID = $_GET['wb'];
$SessionWebsiteData = $Website->GetWebsiteDetails($GetWebsiteID);
$WebID = $SessionWebsiteData["websiteid"];

if (empty($WebID))
{
    header("Location: index.php");
}else{
    //$_SESSION['web_id']=$WebID;
    $ShowWebID=$WebID;
    $SessionWebsiteData = $Website->GetWebsiteDetails($ShowWebID);
	$SessionWebsiteID = $SessionWebsiteData["websiteid"];
	$SessionWebsiteTypeID = $SessionWebsiteData["website_type_id"];
	if (empty($SessionWebsiteID))
	{
		header("Location: login.php");
	}
	$SessionWebsiteName = $SessionWebsiteData["website_sitename"];
	$SessionWebsiteAddress = $SessionWebsiteData["website_address"];
	$SessionWebsiteMobile = $SessionWebsiteData["website_mobile"];
	$SessionWebsitePhone = $SessionWebsiteData["website_phone"];
	$SessionWebsiteEmail = $SessionWebsiteData["website_email"];
	$SessionWebsiteLogo = $SessionWebsiteData["website_sitelogo"];
}



?>
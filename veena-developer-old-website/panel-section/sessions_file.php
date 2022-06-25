<?php
session_start();
//$_SESSION['admin_username'] = $admin_username;
$admin_username=$_SESSION['admin_username'];
if (empty($admin_username))
{
	header("Location: login.php");
}

$AdminLoggedUserData = $Admin->AdminLoggedUserInfo($admin_username);
$AdminLoggedUserFullName = $AdminLoggedUserData["admin_firstname"]." ".$AdminLoggedUserData["admin_lastname"];
$AdminLoggedUserFirstName = $AdminLoggedUserData["admin_firstname"];
$AdminLoggedUserEmail = $AdminLoggedUserData["admin_email"];
$AdminLoggedUserID = $AdminLoggedUserData["adminid"];
$AdminLoggedadmin_password = $AdminLoggedUserData["admin_password"];
$AdminUserInfo = $AdminLoggedUserFullName." [Username: ".$admin_username."]";

$AdminLoggedUserSitename = $AdminLoggedUserData["admin_sitename"];
$AdminLoggedUserAddress = $AdminLoggedUserData["admin_address"];
$AdminLoggedUserMobile = $AdminLoggedUserData["admin_mobile"];
$AdminLoggedUserPhone = $AdminLoggedUserData["admin_phone"];



?>
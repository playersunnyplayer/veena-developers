<?php

//error_reporting(0);

/*
 * @package  for DB connection
 * @access   Public + Private
 * @php      5 or higher
 *
 */
define('BASE_PATH','https://veenadevelopers.com/old-website');

$timezone = "Asia/Calcutta";
if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);

class DbaseMySQL {

	// protectec member
	/*
	 * Connection information
	 */
	
	var  $mySQLUser    = "veenabki_dbuser";              // MySQL Username
	var $mySQLPasswd  = "igD*]e!vYC{y";             	 // MySQL Password
	var $mySQLHost    = "localhost";         // MySQL Host IP-Address or Domainname
	var $mySQLPort    = "3306";              // MySQL Port option
	var $mySQLName    = "veenabki_demo";     // MySQL Databasename
	var $mySQLSelectDB;                      // MySQL Databasename
	var $mySQLConnection;                    // MySQL Databasename
	
	/*
	 * DbaseMySQL class constructor
	 *
	 * Initializes the DbaseMySQL class
	 * @access public
	 * @param none
	 * @return string $this->mySQLConnect()
	 */

	function __construct() {

		return $this->mySQLConnect();

	}


	/**
	 * Provides an OOP interface to an MySQL host
	 * @param none
	 * @return boolean
	 */
	function mySQLConnect(){
		// set connection
	/*	$this->mySQLConnection = mysql_connect($this->mySQLHost.":".$this->mySQLPort, $this->mySQLUser, $this->mySQLPasswd) or die("{connect} Database Error: ".mysql_errno()." : ".mysql_error());

		if($this->mySQLConnection){
			//select from databasename
			$this->mySQLSelectDB = mysql_select_db($this->mySQLName, $this->mySQLConnection) or die("{select_db} Database Error: ".mysql_errno()." : ".mysql_error());
			return true;
		}else{
			return false;
		}*/
		
		

$con=mysqli_connect('localhost','veenabki_dbuser','igD*]e!vYC{y','veenabki_demo')or die('can\'t establish connection with mysqli servver');
$mySelectDB=mysqli_select_db($con,'veenabki_demo') or die('could not connect to the database');
if($con){
	return true;
		}else{
			return false;
		}
	}

	/**
	 * closing connection from MySQL host
	 * @param none
	 * @return boolean
	 */

	function mysqlclose()
	{
		// close connection
		$this->mySQLConnection = mysql_close();

		if($this->mySQLConnection){
			return true;
		} else {
			return false;
		}
	}
	
	
	
	
}

# set new class 
$db = new DbaseMySQL(); 
# connecting to database 
$db->mySQLConnect(); 


include "functions.class.php";
include "admin.class.php";
include "cmspages.class.php";
include "youtube.class.php";
include "website.class.php";

// CMS

include "slider.class.php";
include "team.class.php";
include "event.class.php";
include "award.class.php";
include "project.class.php";


include "project_slider.class.php";
include "project_gallery.class.php";
include "project_plan.class.php";
include "project_amenities.class.php";
include "project_current_status.class.php";
include "project_download.class.php";
include "project_video.class.php";
?>
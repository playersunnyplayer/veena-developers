<?php
class WebsiteClass {

	// protectec member

/*
	 * Connection information
	 */

	function dbquery($sql)
	{$con=mysqli_connect('127.0.0.1','veenabki_dbuser','igD*]e!vYC{y','veenabki_demo')or die('can\'t establish connection with mysqlii servver');
            $mySelectDB=mysqli_select_db($con,'veenabki_demo') or die('could not connect to the database');
		if (!empty($sql))
		{
			$result = mysqli_query($con,$sql);
			return $result;
		}

	} 		
	function dbfetch($result)
	{
		if ($row=mysqli_fetch_array($result))
		{
			return $row;
		} 

	} 		
	function dbnumrow($result)
	{
		if ($rowtotal=mysqli_num_rows($result))
		{
			return $rowtotal;
		} 

	}		
	// Website Query

	function GetWebsiteNum()

	{
		$sqlQuery = "SELECT websiteid from msp_website";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlTotal = $this->dbnumrow($sqlRes);		
				if ($sqlTotal > 0 )
			return $sqlTotal;
		else
			return 0;

	}		
	function GetWebsiteNumLimit($offset, $limit)

	{
		$sqlQuery = "SELECT websiteid from msp_website LIMIT $offset, $limit";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlTotal = $this->dbnumrow($sqlRes);
		if ($sqlTotal > 0 )
			return $sqlTotal;
		else
			return 0;

	}		
	function GetWebsiteRes()
	{
		$sqlQuery = "SELECT * from msp_website order by websiteid desc";
		$sqlRes = $this->dbquery($sqlQuery);
		return $sqlRes;
	}		


	function GetWebsiteResLimit($offset, $limit)
	{
		$sqlQuery = "SELECT * from msp_website order by websiteid asc LIMIT $offset, $limit";
		$sqlRes = $this->dbquery($sqlQuery);
		return $sqlRes;

	}		
	function GetWebsiteDetails($id)
	{
		$sqlQuery = "SELECT * from msp_website where websiteid = '$id'";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlData = $this->dbfetch($sqlRes);
		return $sqlData;
	}

	// Events Query

}

$Website = new WebsiteClass(); 
?>
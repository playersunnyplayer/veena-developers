<?php
class AwardClass {
	// protectec member
/*
award
	 * Connection information
	 */
	function dbquery($sql)
	{ 		    $con=mysqli_connect('127.0.0.1','veenabki_dbuser','igD*]e!vYC{y','veenabki_demo')or die('can\'t establish connection with mysqlii servver');
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
	// Award Query
	function GetAwardNum()
	{
		$sqlQuery = "SELECT awardid from msp_award";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlTotal = $this->dbnumrow($sqlRes);
		if ($sqlTotal > 0 )
			return $sqlTotal;
		else
			return 0;
	}
	function GetAwardNumLimit($offset, $limit)
	{
		$sqlQuery = "SELECT awardid from msp_award LIMIT $offset, $limit";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlTotal = $this->dbnumrow($sqlRes);
		if ($sqlTotal > 0 )
			return $sqlTotal;
		else
			return 0;
	}
	function GetAwardRes()
	{
		$sqlQuery = "SELECT * from msp_award order by awardid desc";
		$sqlRes = $this->dbquery($sqlQuery);
		return $sqlRes;
	}
	
	function GetAwardResLimit($offset, $limit)
	{
		$sqlQuery = "SELECT * from msp_award order by awardid asc LIMIT $offset, $limit";
		$sqlRes = $this->dbquery($sqlQuery);
		return $sqlRes;
	}
	
	function GetAwardDetails($id)
	{
		$sqlQuery = "SELECT * from msp_award where awardid = '$id'";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlData = $this->dbfetch($sqlRes);
		return $sqlData;
	}
	
	// Awards Query
}
$Award = new AwardClass(); 
?>
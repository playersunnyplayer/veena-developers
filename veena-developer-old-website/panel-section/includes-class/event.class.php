<?php
class EventClass {
	// protectec member
/*
event
	 * Connection information
	 */
	function dbquery($sql)
	{
	    $con=mysqli_connect('127.0.0.1','veenabki_dbuser','igD*]e!vYC{y','veenabki_demo')or die('can\'t establish connection with mysqli servver');
$mySelectDB=mysqli_select_db($con,'veenabki_demo') or die('could not connect to the database');
if($con){
	return true;
		}else{
			return false;
		}
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
	// Event Query
	function GetEventNum()
	{
		$sqlQuery = "SELECT eventid from msp_event";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlTotal = $this->dbnumrow($sqlRes);
		if ($sqlTotal > 0 )
			return $sqlTotal;
		else
			return 0;
	}
	function GetEventNumLimit($offset, $limit)
	{
		$sqlQuery = "SELECT eventid from msp_event LIMIT $offset, $limit";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlTotal = $this->dbnumrow($sqlRes);
		if ($sqlTotal > 0 )
			return $sqlTotal;
		else
			return 0;
	}
	function GetEventRes()
	{
		$sqlQuery = "SELECT * from msp_event order by eventid desc";
		$sqlRes = $this->dbquery($sqlQuery);
		return $sqlRes;
	}
	
	function GetEventResLimit($offset, $limit)
	{
		$sqlQuery = "SELECT * from msp_event order by eventid asc LIMIT $offset, $limit";
		$sqlRes = $this->dbquery($sqlQuery);
		return $sqlRes;
	}
	
	function GetEventDetails($id)
	{
		$sqlQuery = "SELECT * from msp_event where eventid = '$id'";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlData = $this->dbfetch($sqlRes);
		return $sqlData;
	}
	
	// Events Query
}
$Event = new EventClass(); 
?>
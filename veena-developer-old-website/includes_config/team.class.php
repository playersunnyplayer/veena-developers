<?php
class TeamClass {
	// protectec member
/*
	 * Connection information
	 */
	function dbquery($sql)
	{$con=mysqli_connect('127.0.0.1','veenabki_dbuser','igD*]e!vYC{y','veenabki_demo')or die('can\'t establish connection with mysqli servver');
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
	// Team Query
	function GetTeamNum()
	{
		$sqlQuery = "SELECT teamid from msp_team where msp_status='Active'";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlTotal = $this->dbnumrow($sqlRes);
		if ($sqlTotal > 0 )
			return $sqlTotal;
		else
			return 0;
	}
	function GetTeamNumLimit($offset, $limit)
	{
		$sqlQuery = "SELECT teamid from msp_team where msp_status='Active' LIMIT $offset, $limit";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlTotal = $this->dbnumrow($sqlRes);
		if ($sqlTotal > 0 )
			return $sqlTotal;
		else
			return 0;
	}
	function GetTeamRes()
	{
		$sqlQuery = "SELECT * from msp_team where msp_status='Active' order by teamid desc";
		$sqlRes = $this->dbquery($sqlQuery);
		return $sqlRes;
	}
	
	function GetTeamResLimit($offset, $limit)
	{
		$sqlQuery = "SELECT * from msp_team where msp_status='Active' order by teamid asc LIMIT $offset, $limit";
		$sqlRes = $this->dbquery($sqlQuery);
		return $sqlRes;
	}
	
	function GetTeamDetails($id)
	{
		$sqlQuery = "SELECT * from msp_team where teamid = '$id'";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlData = $this->dbfetch($sqlRes);
		return $sqlData;
	}
	function GetTeamByCategoryIDNum($CategoryID)
	{
		$sqlQuery = "SELECT teamid from msp_team where category_id='$CategoryID' AND msp_status='Active'";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlTotal = $this->dbnumrow($sqlRes);
		if ($sqlTotal > 0 )
			return $sqlTotal;
		else
			return 0;
	}
	function GetTeamByCategoryIDRes($CategoryID)
	{
		$sqlQuery = "SELECT * from msp_team where category_id='$CategoryID' AND msp_status='Active' order by teamid asc";
		$sqlRes = $this->dbquery($sqlQuery);
		return $sqlRes;
	}
	
	// Events Query
}
$Team = new TeamClass(); 
?>
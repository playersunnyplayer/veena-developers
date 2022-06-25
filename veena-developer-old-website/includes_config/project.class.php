<?php
class ProjectClass {
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
	// Project Query
	function GetProjectNum()
	{
		$sqlQuery = "SELECT projectid from msp_project where msp_status='Active'";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlTotal = $this->dbnumrow($sqlRes);
		if ($sqlTotal > 0 )
			return $sqlTotal;
		else
			return 0;
	}
	function GetProjectNumLimit($offset, $limit)
	{
		$sqlQuery = "SELECT projectid from msp_project where msp_status='Active' LIMIT $offset, $limit";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlTotal = $this->dbnumrow($sqlRes);
		if ($sqlTotal > 0 )
			return $sqlTotal;
		else
			return 0;
	}
	function GetProjectRes()
	{
		$sqlQuery = "SELECT * from msp_project where msp_status='Active' order by projectid desc";
		$sqlRes = $this->dbquery($sqlQuery);
		return $sqlRes;
	}
	
	function GetProjectResLimit($offset, $limit)
	{
		$sqlQuery = "SELECT * from msp_project where msp_status='Active' order by projectid asc LIMIT $offset, $limit";
		$sqlRes = $this->dbquery($sqlQuery);
		return $sqlRes;
	}
	
	function GetProjectDetails($id)
	{
		$sqlQuery = "SELECT * from msp_project where projectid = '$id'";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlData = $this->dbfetch($sqlRes);
		return $sqlData;
	}
	function GetProjectCompletedNum()
	{
		$sqlQuery = "SELECT projectid from msp_project where msp_project_type='1' AND msp_status='Active'";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlTotal = $this->dbnumrow($sqlRes);
		if ($sqlTotal > 0 )
			return $sqlTotal;
		else
			return 0;
	}
	function GetProjectCompletedRes()
	{
		$sqlQuery = "SELECT * from msp_project where msp_project_type='1' AND msp_status='Active' order by projectid asc";
		$sqlRes = $this->dbquery($sqlQuery);
		return $sqlRes;
	}
	
	function GetProjectUpcomingNum()
	{
		$sqlQuery = "SELECT projectid from msp_project where msp_project_type='2' AND msp_status='Active'";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlTotal = $this->dbnumrow($sqlRes);
		if ($sqlTotal > 0 )
			return $sqlTotal;
		else
			return 0;
	}
	function GetProjectUpcomingRes()
	{
		$sqlQuery = "SELECT * from msp_project where msp_project_type='2' AND msp_status='Active' order by projectid asc";
		$sqlRes = $this->dbquery($sqlQuery);
		return $sqlRes;
	}
	
	// Events Query
}
$Project = new ProjectClass(); 
?>
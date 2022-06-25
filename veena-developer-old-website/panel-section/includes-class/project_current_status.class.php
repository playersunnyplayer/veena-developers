<?php
class ProjectCurrentStatusClass {

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
	// ProjectCurrentStatus Query

	function GetProjectCurrentStatusNum()

	{
		$sqlQuery = "SELECT project_current_statusid from msp_project_current_status";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlTotal = $this->dbnumrow($sqlRes);		
				if ($sqlTotal > 0 )
			return $sqlTotal;
		else
			return 0;

	}		
	function GetProjectCurrentStatusNumLimit($offset, $limit)

	{
		$sqlQuery = "SELECT project_current_statusid from msp_project_current_status LIMIT $offset, $limit";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlTotal = $this->dbnumrow($sqlRes);
		if ($sqlTotal > 0 )
			return $sqlTotal;
		else
			return 0;

	}		
	function GetProjectCurrentStatusRes()
	{
		$sqlQuery = "SELECT * from msp_project_current_status order by project_current_statusid desc";
		$sqlRes = $this->dbquery($sqlQuery);
		return $sqlRes;
	}		


	function GetProjectCurrentStatusResLimit($offset, $limit)
	{
		$sqlQuery = "SELECT * from msp_project_current_status order by project_current_statusid asc LIMIT $offset, $limit";
		$sqlRes = $this->dbquery($sqlQuery);
		return $sqlRes;

	}		
	function GetProjectCurrentStatusDetails($id)
	{
		$sqlQuery = "SELECT * from msp_project_current_status where project_current_statusid = '$id'";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlData = $this->dbfetch($sqlRes);
		return $sqlData;
	}

	// By Website Query

	function GetProjectCurrentStatusByWebsiteNum($ProjectID)
	{
		$sqlQuery = "SELECT project_current_statusid from msp_project_current_status where msp_website_id='$ProjectID'";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlTotal = $this->dbnumrow($sqlRes);		
					if ($sqlTotal > 0 )
			return $sqlTotal;
		else
			return 0;
	}		
	function GetProjectCurrentStatusByWebsiteNumLimit($ProjectID, $offset, $limit)
	{
		$sqlQuery = "SELECT project_current_statusid from msp_project_current_status where msp_website_id='$ProjectID' LIMIT $offset, $limit";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlTotal = $this->dbnumrow($sqlRes);
		if ($sqlTotal > 0 )
			return $sqlTotal;
		else
			return 0;
	}		
	function GetProjectCurrentStatusByWebsiteRes($ProjectID)
	{
		$sqlQuery = "SELECT * from msp_project_current_status where msp_website_id='$ProjectID' order by msp_mdate desc";
		$sqlRes = $this->dbquery($sqlQuery);
		return $sqlRes;
	}		

	function GetProjectCurrentStatusByWebsiteResLimit($ProjectID, $offset, $limit)
	{
		$sqlQuery = "SELECT * from msp_project_current_status where msp_website_id='$ProjectID' order by msp_mdate desc LIMIT $offset, $limit";
		$sqlRes = $this->dbquery($sqlQuery);
		return $sqlRes;
	}

}

$ProjectCurrentStatus = new ProjectCurrentStatusClass(); 
?>
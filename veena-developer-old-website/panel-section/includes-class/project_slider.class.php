<?php
class ProjectSliderClass {

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
	// ProjectSlider Query

	function GetProjectSliderNum()

	{
		$sqlQuery = "SELECT project_sliderid from msp_project_slider";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlTotal = $this->dbnumrow($sqlRes);		
				if ($sqlTotal > 0 )
			return $sqlTotal;
		else
			return 0;

	}		
	function GetProjectSliderNumLimit($offset, $limit)

	{
		$sqlQuery = "SELECT project_sliderid from msp_project_slider LIMIT $offset, $limit";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlTotal = $this->dbnumrow($sqlRes);
		if ($sqlTotal > 0 )
			return $sqlTotal;
		else
			return 0;

	}		
	function GetProjectSliderRes()
	{
		$sqlQuery = "SELECT * from msp_project_slider order by project_sliderid desc";
		$sqlRes = $this->dbquery($sqlQuery);
		return $sqlRes;
	}		


	function GetProjectSliderResLimit($offset, $limit)
	{
		$sqlQuery = "SELECT * from msp_project_slider order by project_sliderid asc LIMIT $offset, $limit";
		$sqlRes = $this->dbquery($sqlQuery);
		return $sqlRes;

	}		
	function GetProjectSliderDetails($id)
	{
		$sqlQuery = "SELECT * from msp_project_slider where project_sliderid = '$id'";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlData = $this->dbfetch($sqlRes);
		return $sqlData;
	}

	// By Website Query

	function GetProjectSliderByWebsiteNum($ProjectID)
	{
		$sqlQuery = "SELECT project_sliderid from msp_project_slider where msp_website_id='$ProjectID'";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlTotal = $this->dbnumrow($sqlRes);		
					if ($sqlTotal > 0 )
			return $sqlTotal;
		else
			return 0;
	}		
	function GetProjectSliderByWebsiteNumLimit($ProjectID, $offset, $limit)
	{
		$sqlQuery = "SELECT project_sliderid from msp_project_slider where msp_website_id='$ProjectID' LIMIT $offset, $limit";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlTotal = $this->dbnumrow($sqlRes);
		if ($sqlTotal > 0 )
			return $sqlTotal;
		else
			return 0;
	}		
	function GetProjectSliderByWebsiteRes($ProjectID)
	{
		$sqlQuery = "SELECT * from msp_project_slider where msp_website_id='$ProjectID' order by project_sliderid desc";
		$sqlRes = $this->dbquery($sqlQuery);
		return $sqlRes;
	}		

	function GetProjectSliderByWebsiteResLimit($ProjectID, $offset, $limit)
	{
		$sqlQuery = "SELECT * from msp_project_slider where msp_website_id='$ProjectID' order by project_sliderid asc LIMIT $offset, $limit";
		$sqlRes = $this->dbquery($sqlQuery);
		return $sqlRes;
	}

}

$ProjectSlider = new ProjectSliderClass(); 
?>
<?php
class ProjectGalleryClass {

	// protectec member

/*
	 * Connection information
	 */

	function dbquery($sql)
	{$con=mysqli_connect('127.0.0.1','veenabki_dbuser','igD*]e!vYC{y','veenabki_demo')or die('can\'t establish connection with mysqlii servver');
            $mySelectDB=mysqli_select_db($con,'veenabki_demo') or die('could not connect to the database');
		if (!empty($sql))
		{
			$result = mysqli_query($sql);
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
	// ProjectGallery Query

	function GetProjectGalleryNum()

	{
		$sqlQuery = "SELECT project_galleryid from msp_project_gallery";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlTotal = $this->dbnumrow($sqlRes);		
				if ($sqlTotal > 0 )
			return $sqlTotal;
		else
			return 0;

	}		
	function GetProjectGalleryNumLimit($offset, $limit)

	{
		$sqlQuery = "SELECT project_galleryid from msp_project_gallery LIMIT $offset, $limit";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlTotal = $this->dbnumrow($sqlRes);
		if ($sqlTotal > 0 )
			return $sqlTotal;
		else
			return 0;

	}		
	function GetProjectGalleryRes()
	{
		$sqlQuery = "SELECT * from msp_project_gallery order by project_galleryid desc";
		$sqlRes = $this->dbquery($sqlQuery);
		return $sqlRes;
	}		


	function GetProjectGalleryResLimit($offset, $limit)
	{
		$sqlQuery = "SELECT * from msp_project_gallery order by project_galleryid asc LIMIT $offset, $limit";
		$sqlRes = $this->dbquery($sqlQuery);
		return $sqlRes;

	}		
	function GetProjectGalleryDetails($id)
	{
		$sqlQuery = "SELECT * from msp_project_gallery where project_galleryid = '$id'";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlData = $this->dbfetch($sqlRes);
		return $sqlData;
	}

	// By Website Query

	function GetProjectGalleryByWebsiteNum($ProjectID)
	{
		$sqlQuery = "SELECT project_galleryid from msp_project_gallery where msp_website_id='$ProjectID'";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlTotal = $this->dbnumrow($sqlRes);		
					if ($sqlTotal > 0 )
			return $sqlTotal;
		else
			return 0;
	}		
	function GetProjectGalleryByWebsiteNumLimit($ProjectID, $offset, $limit)
	{
		$sqlQuery = "SELECT project_galleryid from msp_project_gallery where msp_website_id='$ProjectID' LIMIT $offset, $limit";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlTotal = $this->dbnumrow($sqlRes);
		if ($sqlTotal > 0 )
			return $sqlTotal;
		else
			return 0;
	}		
	function GetProjectGalleryByWebsiteRes($ProjectID)
	{
		$sqlQuery = "SELECT * from msp_project_gallery where msp_website_id='$ProjectID' order by project_galleryid desc";
		$sqlRes = $this->dbquery($sqlQuery);
		return $sqlRes;
	}		

	function GetProjectGalleryByWebsiteResLimit($ProjectID, $offset, $limit)
	{
		$sqlQuery = "SELECT * from msp_project_gallery where msp_website_id='$ProjectID' order by project_galleryid asc LIMIT $offset, $limit";
		$sqlRes = $this->dbquery($sqlQuery);
		return $sqlRes;
	}

}

$ProjectGallery = new ProjectGalleryClass(); 
?>
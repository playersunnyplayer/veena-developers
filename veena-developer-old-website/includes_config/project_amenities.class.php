<?php
class ProjectAmenitiesClass {
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
 			// ProjectAmenities Query
 		function GetProjectAmenitiesNum()
 		{
 			$sqlQuery = "SELECT project_amenitiesid from msp_project_amenities where msp_status='Active'";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlTotal = $this->dbnumrow($sqlRes);		
 						if ($sqlTotal > 0 )
 				return $sqlTotal;
 			else
 				return 0;
 		}		
 		function GetProjectAmenitiesNumLimit($offset, $limit)
 		{
 			$sqlQuery = "SELECT project_amenitiesid from msp_project_amenities where msp_status='Active' LIMIT $offset, $limit";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlTotal = $this->dbnumrow($sqlRes);
 			if ($sqlTotal > 0 )
 				return $sqlTotal;
 			else
 				return 0;
 		}		
 		function GetProjectAmenitiesRes()
 		{
 			$sqlQuery = "SELECT * from msp_project_amenities where msp_status='Active' order by project_amenitiesid desc";
 			$sqlRes = $this->dbquery($sqlQuery);
 			return $sqlRes;
 		}		

 		function GetProjectAmenitiesResLimit($offset, $limit)
 		{
 			$sqlQuery = "SELECT * from msp_project_amenities where msp_status='Active' order by project_amenitiesid asc LIMIT $offset, $limit";
 			$sqlRes = $this->dbquery($sqlQuery);
 			return $sqlRes;
 		}		

 		function GetProjectAmenitiesDetails($id)
 		{
 			$sqlQuery = "SELECT * from msp_project_amenities where project_amenitiesid = '$id'";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlData = $this->dbfetch($sqlRes);
 			return $sqlData;
 		}

 		function GetProjectAmenitiesByProjectAmenitiesDetails($url_title)
 		{
 			$sqlQuery = "SELECT * from msp_project_amenities where project_amenities_url_title = '$url_title'";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlData = $this->dbfetch($sqlRes);
 			return $sqlData;
 		}
 			// Events Query


 			// By Website Query

 		function GetProjectAmenitiesByWebsiteNum($ProjectID)
 		{
 			$sqlQuery = "SELECT project_amenitiesid from msp_project_amenities where msp_website_id='$ProjectID' AND msp_status='Active'";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlTotal = $this->dbnumrow($sqlRes);		
 						if ($sqlTotal > 0 )
 				return $sqlTotal;
 			else
 				return 0;
 		}		
 		function GetProjectAmenitiesByWebsiteNumLimit($ProjectID, $offset, $limit)
 		{
 			$sqlQuery = "SELECT project_amenitiesid from msp_project_amenities where msp_website_id='$ProjectID' AND msp_status='Active' LIMIT $offset, $limit";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlTotal = $this->dbnumrow($sqlRes);
 			if ($sqlTotal > 0 )
 				return $sqlTotal;
 			else
 				return 0;
 		}		
 		function GetProjectAmenitiesByWebsiteRes($ProjectID)
 		{
 			$sqlQuery = "SELECT * from msp_project_amenities where msp_website_id='$ProjectID' AND msp_status='Active' order by project_amenitiesid asc";
 			$sqlRes = $this->dbquery($sqlQuery);
 			return $sqlRes;
 		}		

 		function GetProjectAmenitiesByWebsiteResLimit($ProjectID, $offset, $limit)
 		{
 			$sqlQuery = "SELECT * from msp_project_amenities where msp_website_id='$ProjectID' AND msp_status='Active' order by project_amenitiesid asc LIMIT $offset, $limit";
 			$sqlRes = $this->dbquery($sqlQuery);
 			return $sqlRes;
 		}

}

$ProjectAmenities = new ProjectAmenitiesClass(); 
?>
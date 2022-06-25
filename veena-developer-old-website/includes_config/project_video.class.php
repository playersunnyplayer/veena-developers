<?php
class ProjectVideoClass {
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
 			// ProjectVideo Query
 		function GetProjectVideoNum()
 		{
 			$sqlQuery = "SELECT project_videoid from msp_project_video where msp_status='Active'";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlTotal = $this->dbnumrow($sqlRes);		
 						if ($sqlTotal > 0 )
 				return $sqlTotal;
 			else
 				return 0;
 		}		
 		function GetProjectVideoNumLimit($offset, $limit)
 		{
 			$sqlQuery = "SELECT project_videoid from msp_project_video where msp_status='Active' LIMIT $offset, $limit";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlTotal = $this->dbnumrow($sqlRes);
 			if ($sqlTotal > 0 )
 				return $sqlTotal;
 			else
 				return 0;
 		}		
 		function GetProjectVideoRes()
 		{
 			$sqlQuery = "SELECT * from msp_project_video where msp_status='Active' order by project_videoid desc";
 			$sqlRes = $this->dbquery($sqlQuery);
 			return $sqlRes;
 		}		

 		function GetProjectVideoResLimit($offset, $limit)
 		{
 			$sqlQuery = "SELECT * from msp_project_video where msp_status='Active' order by project_videoid asc LIMIT $offset, $limit";
 			$sqlRes = $this->dbquery($sqlQuery);
 			return $sqlRes;
 		}		

 		function GetProjectVideoDetails($id)
 		{
 			$sqlQuery = "SELECT * from msp_project_video where project_videoid = '$id'";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlData = $this->dbfetch($sqlRes);
 			return $sqlData;
 		}

 		function GetProjectVideoByProjectVideoDetails($url_title)
 		{
 			$sqlQuery = "SELECT * from msp_project_video where project_video_url_title = '$url_title'";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlData = $this->dbfetch($sqlRes);
 			return $sqlData;
 		}
 			// Events Query


 			// By Website Query

 		function GetProjectVideoByWebsiteNum($ProjectID)
 		{
 			$sqlQuery = "SELECT project_videoid from msp_project_video where msp_website_id='$ProjectID' AND msp_status='Active'";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlTotal = $this->dbnumrow($sqlRes);		
 						if ($sqlTotal > 0 )
 				return $sqlTotal;
 			else
 				return 0;
 		}		
 		function GetProjectVideoByWebsiteNumLimit($ProjectID, $offset, $limit)
 		{
 			$sqlQuery = "SELECT project_videoid from msp_project_video where msp_website_id='$ProjectID' AND msp_status='Active' LIMIT $offset, $limit";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlTotal = $this->dbnumrow($sqlRes);
 			if ($sqlTotal > 0 )
 				return $sqlTotal;
 			else
 				return 0;
 		}		
 		function GetProjectVideoByWebsiteRes($ProjectID)
 		{
 			$sqlQuery = "SELECT * from msp_project_video where msp_website_id='$ProjectID' AND msp_status='Active' order by project_videoid desc";
 			$sqlRes = $this->dbquery($sqlQuery);
 			return $sqlRes;
 		}		

 		function GetProjectVideoByWebsiteResLimit($ProjectID, $offset, $limit)
 		{
 			$sqlQuery = "SELECT * from msp_project_video where msp_website_id='$ProjectID' AND msp_status='Active' order by project_videoid asc LIMIT $offset, $limit";
 			$sqlRes = $this->dbquery($sqlQuery);
 			return $sqlRes;
 		}

}

$ProjectVideo = new ProjectVideoClass(); 
?>
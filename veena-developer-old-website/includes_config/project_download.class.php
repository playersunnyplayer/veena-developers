<?php
class ProjectDownloadClass {
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
 			// ProjectDownload Query
 		function GetProjectDownloadNum()
 		{
 			$sqlQuery = "SELECT project_downloadid from msp_project_download where msp_status='Active'";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlTotal = $this->dbnumrow($sqlRes);		
 						if ($sqlTotal > 0 )
 				return $sqlTotal;
 			else
 				return 0;
 		}		
 		function GetProjectDownloadNumLimit($offset, $limit)
 		{
 			$sqlQuery = "SELECT project_downloadid from msp_project_download where msp_status='Active' LIMIT $offset, $limit";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlTotal = $this->dbnumrow($sqlRes);
 			if ($sqlTotal > 0 )
 				return $sqlTotal;
 			else
 				return 0;
 		}		
 		function GetProjectDownloadRes()
 		{
 			$sqlQuery = "SELECT * from msp_project_download where msp_status='Active' order by project_downloadid desc";
 			$sqlRes = $this->dbquery($sqlQuery);
 			return $sqlRes;
 		}		

 		function GetProjectDownloadResLimit($offset, $limit)
 		{
 			$sqlQuery = "SELECT * from msp_project_download where msp_status='Active' order by project_downloadid asc LIMIT $offset, $limit";
 			$sqlRes = $this->dbquery($sqlQuery);
 			return $sqlRes;
 		}		

 		function GetProjectDownloadDetails($id)
 		{
 			$sqlQuery = "SELECT * from msp_project_download where project_downloadid = '$id'";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlData = $this->dbfetch($sqlRes);
 			return $sqlData;
 		}

 		function GetProjectDownloadByProjectDownloadDetails($url_title)
 		{
 			$sqlQuery = "SELECT * from msp_project_download where project_download_url_title = '$url_title'";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlData = $this->dbfetch($sqlRes);
 			return $sqlData;
 		}
 			// Events Query


 			// By Website Query

 		function GetProjectDownloadByWebsiteNum($ProjectID)
 		{
 			$sqlQuery = "SELECT project_downloadid from msp_project_download where msp_website_id='$ProjectID' AND msp_status='Active'";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlTotal = $this->dbnumrow($sqlRes);		
 						if ($sqlTotal > 0 )
 				return $sqlTotal;
 			else
 				return 0;
 		}		
 		function GetProjectDownloadByWebsiteNumLimit($ProjectID, $offset, $limit)
 		{
 			$sqlQuery = "SELECT project_downloadid from msp_project_download where msp_website_id='$ProjectID' AND msp_status='Active' LIMIT $offset, $limit";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlTotal = $this->dbnumrow($sqlRes);
 			if ($sqlTotal > 0 )
 				return $sqlTotal;
 			else
 				return 0;
 		}		
 		function GetProjectDownloadByWebsiteRes($ProjectID)
 		{
 			$sqlQuery = "SELECT * from msp_project_download where msp_website_id='$ProjectID' AND msp_status='Active' order by project_downloadid desc";
 			$sqlRes = $this->dbquery($sqlQuery);
 			return $sqlRes;
 		}		

 		function GetProjectDownloadByWebsiteResLimit($ProjectID, $offset, $limit)
 		{
 			$sqlQuery = "SELECT * from msp_project_download where msp_website_id='$ProjectID' AND msp_status='Active' order by project_downloadid asc LIMIT $offset, $limit";
 			$sqlRes = $this->dbquery($sqlQuery);
 			return $sqlRes;
 		}

}

$ProjectDownload = new ProjectDownloadClass(); 
?>
<?php
class ProjectPlanClass {
		// protectec member

/*		
 * Connection information		
 */
 		function dbquery($sql)
 		{
 		    $con=mysqli_connect('127.0.0.1','veenabki_dbuser','igD*]e!vYC{y','veenabki_demo')or die('can\'t establish connection with mysqli servver');
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
 			// ProjectPlan Query
 		function GetProjectPlanNum()
 		{
 			$sqlQuery = "SELECT project_planid from msp_project_plan where msp_status='Active'";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlTotal = $this->dbnumrow($sqlRes);		
 						if ($sqlTotal > 0 )
 				return $sqlTotal;
 			else
 				return 0;
 		}		
 		function GetProjectPlanNumLimit($offset, $limit)
 		{
 			$sqlQuery = "SELECT project_planid from msp_project_plan where msp_status='Active' LIMIT $offset, $limit";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlTotal = $this->dbnumrow($sqlRes);
 			if ($sqlTotal > 0 )
 				return $sqlTotal;
 			else
 				return 0;
 		}		
 		function GetProjectPlanRes()
 		{
 			$sqlQuery = "SELECT * from msp_project_plan where msp_status='Active' order by project_planid desc";
 			$sqlRes = $this->dbquery($sqlQuery);
 			return $sqlRes;
 		}		

 		function GetProjectPlanResLimit($offset, $limit)
 		{
 			$sqlQuery = "SELECT * from msp_project_plan where msp_status='Active' order by project_planid asc LIMIT $offset, $limit";
 			$sqlRes = $this->dbquery($sqlQuery);
 			return $sqlRes;
 		}		

 		function GetProjectPlanDetails($id)
 		{
 			$sqlQuery = "SELECT * from msp_project_plan where project_planid = '$id'";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlData = $this->dbfetch($sqlRes);
 			return $sqlData;
 		}

 		function GetProjectPlanByProjectPlanDetails($url_title)
 		{
 			$sqlQuery = "SELECT * from msp_project_plan where project_plan_url_title = '$url_title'";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlData = $this->dbfetch($sqlRes);
 			return $sqlData;
 		}
 			// Events Query


 			// By Website Query

 		function GetProjectPlanByWebsiteNum($ProjectID)
 		{
 			$sqlQuery = "SELECT project_planid from msp_project_plan where msp_website_id='$ProjectID' AND msp_status='Active'";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlTotal = $this->dbnumrow($sqlRes);		
 						if ($sqlTotal > 0 )
 				return $sqlTotal;
 			else
 				return 0;
 		}		
 		function GetProjectPlanByWebsiteNumLimit($ProjectID, $offset, $limit)
 		{
 			$sqlQuery = "SELECT project_planid from msp_project_plan where msp_website_id='$ProjectID' AND msp_status='Active' LIMIT $offset, $limit";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlTotal = $this->dbnumrow($sqlRes);
 			if ($sqlTotal > 0 )
 				return $sqlTotal;
 			else
 				return 0;
 		}		
 		function GetProjectPlanByWebsiteRes($ProjectID)
 		{
 			$sqlQuery = "SELECT * from msp_project_plan where msp_website_id='$ProjectID' AND msp_status='Active' order by project_planid desc";
 			$sqlRes = $this->dbquery($sqlQuery);
 			return $sqlRes;
 		}		

 		function GetProjectPlanByWebsiteResLimit($ProjectID, $offset, $limit)
 		{
 			$sqlQuery = "SELECT * from msp_project_plan where msp_website_id='$ProjectID' AND msp_status='Active' order by project_planid asc LIMIT $offset, $limit";
 			$sqlRes = $this->dbquery($sqlQuery);
 			return $sqlRes;
 		}

}

$ProjectPlan = new ProjectPlanClass(); 
?>
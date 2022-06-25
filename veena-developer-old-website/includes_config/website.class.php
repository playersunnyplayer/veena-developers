<?php
class WebsiteClass {
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
 			// Website Query
 		function GetWebsiteNum()
 		{
 		 	$sqlQuery = "SELECT websiteid from msp_website where website_status='Active'";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlTotal = $this->dbnumrow($sqlRes);		
 			if ($sqlTotal > 0 ){
 				return $sqlTotal;
 			}
 			else{
 				return 0;
 			}
 		}		
 		function GetWebsiteNumLimit($offset, $limit)
 		{
 			$sqlQuery = "SELECT websiteid from msp_website where website_status='Active' LIMIT $offset, $limit";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlTotal = $this->dbnumrow($sqlRes);
 			if ($sqlTotal > 0 ){
 				return $sqlTotal;
 			}
 			else{
 				return 0;
 			}
 		}		
 		function GetWebsiteRes()
 		{
 			$sqlQuery = "SELECT * from msp_website where website_status='Active' order by websiteid asc";
 			$sqlRes = $this->dbquery($sqlQuery);
 			return $sqlRes;
 		}		

 		function GetWebsiteResLimit($offset, $limit)
 		{
 			$sqlQuery = "SELECT * from msp_website where website_status='Active' order by websiteid asc LIMIT $offset, $limit";
 			$sqlRes = $this->dbquery($sqlQuery);
 			return $sqlRes;
 		}		

 		function GetWebsiteDetails($id)
 		{
 			$sqlQuery = "SELECT * from msp_website where websiteid = '$id'";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlData = $this->dbfetch($sqlRes);
 			return $sqlData;
 		}

 		function GetWebsiteByUrlTitleDetails($urltitle)
 		{
 			$sqlQuery = "SELECT * from msp_website where website_url_title = '$urltitle'";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlData = $this->dbfetch($sqlRes);
 			return $sqlData;
 		}



 		function GetWebsiteByTypeNum($typeid)
 		{
 		 	$sqlQuery = "SELECT websiteid from msp_website where website_type_id='$typeid' AND website_status='Active'";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlTotal = $this->dbnumrow($sqlRes);		
 			if ($sqlTotal > 0 ){
 				return $sqlTotal;
 			}
 			else{
 				return 0;
 			}
 		}		
 		function GetWebsiteByTypeRes($typeid)
 		{
 			$sqlQuery = "SELECT * from msp_website where website_type_id='$typeid' AND website_status='Active' order by websiteid desc";
 			$sqlRes = $this->dbquery($sqlQuery);
 			return $sqlRes;
 		}

 		function GetWebsiteDistinctLocationRes($typeid)
 		{
 			$sqlQuery = "SELECT DISTINCT website_location_id from msp_website where website_type_id='$typeid' AND website_status='Active' order by websiteid desc";
 			$sqlRes = $this->dbquery($sqlQuery);
 			return $sqlRes;
 		}

 		function GetWebsiteHomeTopRes()
 		{
 			$sqlQuery = "SELECT * from msp_website where website_show_project='Yes' AND website_show_position='1' AND website_status='Active' order by websiteid asc";
 			$sqlRes = $this->dbquery($sqlQuery);
 			return $sqlRes;
 		}
 		function GetWebsiteHomeCenterRes()
 		{
 			$sqlQuery = "SELECT * from msp_website where website_show_project='Yes' AND website_show_position='2' AND website_status='Active' order by websiteid asc";
 			$sqlRes = $this->dbquery($sqlQuery);
 			return $sqlRes;
 		}
 		function GetWebsiteHomeBottomRes()
 		{
 			$sqlQuery = "SELECT * from msp_website where website_show_project='Yes' AND website_show_position='3' AND website_status='Active' order by websiteid asc";
 			$sqlRes = $this->dbquery($sqlQuery);
 			return $sqlRes;
 		}

 		// Search 
 		function GetWebsiteSearchNum($main_string)
 		{
 		 	$sqlQuery = "SELECT websiteid from msp_website $main_string AND website_status='Active'  ";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlTotal = $this->dbnumrow($sqlRes);		
 			if ($sqlTotal > 0 ){
 				return $sqlTotal;
 			}
 			else{
 				return 0;
 			}
 		}		
 			
 		function GetWebsiteSearchRes($main_string)
 		{
 			$sqlQuery = "SELECT * from msp_website $main_string AND website_status='Active' order by websiteid desc  ";
 			$sqlRes = $this->dbquery($sqlQuery);
 			return $sqlRes;
 		}
 		// Search 

 		// filter 
 		function GetWebsiteFilterByTitleNumLimit($keyword, $offset, $limit)
 		{
 		 	$sqlQuery = "SELECT websiteid from msp_website where website_sitename like '%$keyword%' AND website_status='Active' LIMIT $offset, $limit ";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlTotal = $this->dbnumrow($sqlRes);		
 			if ($sqlTotal > 0 ){
 				return $sqlTotal;
 			}
 			else{
 				return 0;
 			}
 		}		
 			
 		function GetWebsiteFilterByTitleResLimit($keyword, $offset, $limit)
 		{
 			$sqlQuery = "SELECT * from msp_website where website_sitename like '%$keyword%' AND website_status='Active' order by websiteid desc LIMIT $offset, $limit ";
 			$sqlRes = $this->dbquery($sqlQuery);
 			return $sqlRes;
 		}
 		// filter 


 		// completed
 		
 		function GetWebsiteCompletedNum()
 		{
 		 	$sqlQuery = "SELECT websiteid from msp_website where website_status_id='3' AND website_status='Active'";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlTotal = $this->dbnumrow($sqlRes);		
 			if ($sqlTotal > 0 ){
 				return $sqlTotal;
 			}
 			else{
 				return 0;
 			}
 		}		
 		function GetWebsiteCompletedNumLimit($offset, $limit)
 		{
 			$sqlQuery = "SELECT websiteid from msp_website where website_status_id='3' AND website_status='Active' LIMIT $offset, $limit";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlTotal = $this->dbnumrow($sqlRes);
 			if ($sqlTotal > 0 ){
 				return $sqlTotal;
 			}
 			else{
 				return 0;
 			}
 		}		
 		function GetWebsiteCompletedRes()
 		{
 			$sqlQuery = "SELECT * from msp_website where website_status_id='3' AND website_status='Active' order by websiteid desc";
 			$sqlRes = $this->dbquery($sqlQuery);
 			return $sqlRes;
 		}		

 		function GetWebsiteCompletedResLimit($offset, $limit)
 		{
 			$sqlQuery = "SELECT * from msp_website where website_status_id='3' AND website_status='Active' order by websiteid asc LIMIT $offset, $limit";
 			$sqlRes = $this->dbquery($sqlQuery);
 			return $sqlRes;
 		}
 		// completed

 		// completed
 		
 		function GetWebsiteUpcomingNum()
 		{
 		 	$sqlQuery = "SELECT websiteid from msp_website where website_status_id='2' AND website_status='Active'";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlTotal = $this->dbnumrow($sqlRes);		
 						if ($sqlTotal > 0 )
 				return $sqlTotal;
 			else
 				return 0;
 		}		
 		function GetWebsiteUpcomingNumLimit($offset, $limit)
 		{
 			$sqlQuery = "SELECT websiteid from msp_website where website_status_id='2' AND website_status='Active' LIMIT $offset, $limit";
 			$sqlRes = $this->dbquery($sqlQuery);
 			$sqlTotal = $this->dbnumrow($sqlRes);
 			if ($sqlTotal > 0 )
 				return $sqlTotal;
 			else
 				return 0;
 		}		
 		function GetWebsiteUpcomingRes()
 		{
 			$sqlQuery = "SELECT * from msp_website where website_status_id='2' AND website_status='Active' order by websiteid desc";
 			$sqlRes = $this->dbquery($sqlQuery);
 			return $sqlRes;
 		}		

 		function GetWebsiteUpcomingResLimit($offset, $limit)
 		{
 			$sqlQuery = "SELECT * from msp_website where website_status_id='2' AND website_status='Active' order by websiteid asc LIMIT $offset, $limit";
 			$sqlRes = $this->dbquery($sqlQuery);
 			return $sqlRes;
 		}
 		// completed
 		

}

$Website = new WebsiteClass(); 


?>
<?php
class AwardClass {
	// protectec member
/*
	 * Connection information
	 */
	function dbquery($sql)
	{
		if (!empty($sql))
		{
			$result = mysql_query($sql);
			return $result;
		}
	} 
	function dbfetch($result)
	{
		if ($row=mysql_fetch_array($result))
		{
			return $row;
		} 
	} 
	function dbnumrow($result)
	{
		if ($rowtotal=mysql_num_rows($result))
		{
			return $rowtotal;
		} 
	}
	// Award Query
	function GetAwardNum()
	{
		$sqlQuery = "SELECT awardid from msp_award where msp_status='Active'";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlTotal = $this->dbnumrow($sqlRes);
		if ($sqlTotal > 0 )
			return $sqlTotal;
		else
			return 0;
	}
	function GetAwardNumLimit($offset, $limit)
	{
		$sqlQuery = "SELECT awardid from msp_award where msp_status='Active' LIMIT $offset, $limit";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlTotal = $this->dbnumrow($sqlRes);
		if ($sqlTotal > 0 )
			return $sqlTotal;
		else
			return 0;
	}
	function GetAwardRes()
	{
		$sqlQuery = "SELECT * from msp_award where msp_status='Active' order by awardid desc";
		$sqlRes = $this->dbquery($sqlQuery);
		return $sqlRes;
	}
	
	function GetAwardResLimit($offset, $limit)
	{
		$sqlQuery = "SELECT * from msp_award where msp_status='Active' order by awardid asc LIMIT $offset, $limit";
		$sqlRes = $this->dbquery($sqlQuery);
		return $sqlRes;
	}
	
	function GetAwardDetails($id)
	{
		$sqlQuery = "SELECT * from msp_award where awardid = '$id'";
		$sqlRes = $this->dbquery($sqlQuery);
		$sqlData = $this->dbfetch($sqlRes);
		return $sqlData;
	}
	
	
	// Awards Query
}
$Award = new AwardClass(); 
?>
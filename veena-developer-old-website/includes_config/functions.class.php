<?php
function prepare_input($string)
{
	if (is_string($string)) {
			$string = htmlspecialchars($string);
			$string = trim(addslashes($string));
			$string = stripslashes($string);
			$string = str_replace("'", "", $string);
			return $string;
	}
	elseif (is_array($string))
	{
		  reset($string);
		  while (list($key, $value) = each($string)) {
			$string[$key] = prepare_input($value);
		  }
	  return $string;
	}
	else
	{
	  return $string;
	}
}
function html2txt($document)
{
	$search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript
				   '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
				   '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
				   '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA
	);
	$text = preg_replace($search, '', $document);
	return $text;
}
function html2text($document)
{
	$search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript
				   '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
				   '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
				   '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA
	);
	$text = preg_replace($search, '', $document);
	return $text;
}
function getExtension($str)
{
	$i = strrpos($str,".");
	if (!$i) { return ""; }
	$l = strlen($str) - $i;
	$ext = substr($str,$i+1,$l);
	return $ext;
}
function add_http($url){
	if ($url){
		return (substr($url,0,7) == 'http://') ? $url : 'http://' . $url;
	} else {
		return '';
	}
}
///////////////////
function dateAdd($interval,$number,$dateTime) {
	$dateTime = (strtotime($dateTime) != -1) ? strtotime($dateTime) : $dateTime;
$dateTimeArr=getdate($dateTime);
$yr=$dateTimeArr[year];
$mon=$dateTimeArr[mon];
$day=$dateTimeArr[mday];
$hr=$dateTimeArr[hours];
$min=$dateTimeArr[minutes];
$sec=$dateTimeArr[seconds];
switch($interval) {
case "s"://seconds
$sec += $number;
break;
case "n"://minutes
$min += $number;
break;
case "h"://hours
$hr += $number;
break;
case "d"://days
$day += $number;
break;
case "ww"://Week
$day += ($number * 7);
break;
case "m": //similar result "m" dateDiff Microsoft
$mon += $number;
break;
case "yyyy": //similar result "yyyy" dateDiff Microsoft
$yr += $number;
break;
default:
$day += $number;
		}
		$dateTime = mktime($hr,$min,$sec,$mon,$day,$yr);
		$dateTimeArr=getdate($dateTime);
		$nosecmin = 0;
		$min=$dateTimeArr[minutes];
		$sec=$dateTimeArr[seconds];
		if ($hr==0){$nosecmin += 1;}
		if ($min==0){$nosecmin += 1;}
		if ($sec==0){$nosecmin += 1;}
		if ($nosecmin>2){ return(date("Y-m-d",$dateTime));} else { return(date("Y-m-d G:i:s",$dateTime));}
}
function get_time_difference( $start, $end )
{
	$uts['start']      =    strtotime( $start );
	$uts['end']        =    strtotime( $end );
	if( $uts['start']!==-1 && $uts['end']!==-1 )
	{
		if( $uts['end'] >= $uts['start'] )
		{
			$diff    =    $uts['end'] - $uts['start'];
			if( $days=intval((floor($diff/86400))) )
				$diff = $diff % 86400;
			if( $hours=intval((floor($diff/3600))) )
				$diff = $diff % 3600;
			if( $minutes=intval((floor($diff/60))) )
				$diff = $diff % 60;
			$diff    =    intval( $diff );
			return( array('days'=>$days, 'hours'=>$hours, 'minutes'=>$minutes, 'seconds'=>$diff) );
		}
		else
		{
			// trigger_error( "Ending date/time is earlier than the start date/time", E_USER_WARNING );
		}
	}
	else
	{
		trigger_error( "Invalid date/time data detected", E_USER_WARNING );
	}
	return( false );
}
function CalculateDays($d1, $d2)
{
	//$d1=mktime(22,0,0,1,1,2007);
	//$d2=mktime(11,0,0,1,1,2007);
	$hours = floor(($d2-$d1)/3600);
	$minutes = floor(($d2-$d1)/60);
	$seconds = ($d2-$d1);
	$days = floor(($d2-$d1)/86400);
	 return( array('days'=>$days, 'hours'=>$hours, 'minutes'=>$minutes, 'seconds'=>$seconds) );
	}
function checkValidEmail($email)
{
  if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email)) {
	return false;
  }
  else
	return true;
}
function checkValidDate($dt)
{
	$arr=split("-",$dt); // splitting the array
	$dd=$arr[0]; // first element of the array is month
	$mm=$arr[1]; // second element is date
	$yy=$arr[2]; // third element is year
	if(!checkdate($mm,$dd,$yy)){
		return false;
	}
	else
	{
		return true;
	}
}
function GetNewDate($dt)
{
	$arr=split("-",$dt); // splitting the array
	$mm=$arr[0]; // first element of the array is month
	$dd=$arr[1]; // second element is date
	$yy=$arr[2]; // third element is year
	return $date1 = $dd . " ".  date('F', mktime(1,1, 1, $mm, $dd, $yy)) . " ".  $yy;
}
function GetNewDateFormat($dt)
{
	$arr=split("/",$dt); // splitting the array
	$dd=$arr[0]; // first element is date
	$mm=$arr[1]; // second element of the array is month
	$yy=$arr[2]; // third element is year
	return $date1 = $dd . "-".$mm . "-".  $yy;
}
function format_month($month)
{
		if($month<10)
			$month = "0$month";
		else
			$month = "$month";
		return $month;
	}
/*	
function formatdate($dt)
{
	$arr=split("/",$dt); // splitting the array
	$mm=$arr[0]; // first element of the array is month
	$dd=$arr[1]; // second element is date
	$yy=$arr[2]; // third element is year
	if($mm == '1' or $mm == '01')
			$month = "January";
	else if($mm == '2' or $mm == '02')
			$month = "February";
	else if($mm == '3' or $mm == '03')
			$month = "March";
	else if($mm == '4' or $mm == '04')
			$month = "April";
	else if($mm == '5' or $mm == '05')
			$month = "May";
	else if($mm == '6' or $mm == '06')
			$month = "June";
	else if($mm == '7' or $mm == '07')
			$month = "July";
	else if($mm == '8' or $mm == '08')
			$month = "August";
	else if($mm == '9' or $mm == '09')
			$month = "September";
	else if($mm == '10')
			$month = "October";
	else if($mm == '11')
			$month = "November";
	else if($mm == '12')
			$month = "December";
	return $date1 = $dd . " ".  $month ." ".  $yy;
}


function formatdateYearMonthDate($dt)
{
	$arr=split("-",$dt); // splitting the array
	$yy=$arr[0]; // first element of the array is month
	$mm=$arr[1]; // second element is date
	
	
	if($mm == 1 or $mm == 01)
			$month = "Jan";
	else if($mm == 2 or $mm == 02)
			$month = "Feb";
	else if($mm == 3 or $mm == 03)
			$month = "March";
	else if($mm == 4 or $mm == 04)
			$month = "Apr";
	else if($mm == 5 or $mm == 05)
			$month = "May";
	else if($mm == 6 or $mm == 06)
			$month = "Jun";
	else if($mm == 7 or $mm == 07)
			$month = "July";
	else if($mm == 8 or $mm == 08)
			$month = "Aug";
	else if($mm == 9 or $mm == 09)
			$month = "Sep";
	else if($mm == 10)
			$month = "Oct";
	else if($mm == 11)
			$month = "Nov";
	else if($mm == 12)
			$month = "Dec";
	return $date1 = $month ." ".  $yy;
}
function formatOnlyMonths($dt)
{
	$mm=$dt;
	if($mm == 1 or $mm == 01)
			$month = "January";
	else if($mm == 2 or $mm == 02)
			$month = "February";
	else if($mm == 3 or $mm == 03)
			$month = "March";
	else if($mm == 4 or $mm == 04)
			$month = "April";
	else if($mm == 5 or $mm == 05)
			$month = "May";
	else if($mm == 6 or $mm == 06)
			$month = "June";
	else if($mm == 7 or $mm == 07)
			$month = "July";
	else if($mm == 8 or $mm == 08)
			$month = "August";
	else if($mm == 9 or $mm == 09)
			$month = "September";
	else if($mm == 10)
			$month = "October";
	else if($mm == 11)
			$month = "November";
	else if($mm == 12)
			$month = "December";
	return $date1 = $dd . " ".  $month ." ".  $yy;
}
function formatday($dt)
{
	$dd=$dt; // second element is date
	if($dd == 1 or $dd == 01)
			$dd = "01";
	else if($dd == 2 or $dd == 02)
			$dd = "02";
	else if($dd == 3 or $dd == 03)
			$dd = "03";
	else if($dd == 4 or $dd == 04)
			$dd = "04";
	else if($dd == 5 or $dd == 05)
			$dd = "05";
	else if($dd == 6 or $dd == 06)
			$dd = "06";
	else if($dd == 7 or $dd == 07)
			$dd = "07";
	else if($dd == 8 or $dd == 08)
			$dd = "08";
	else if($dd == 9 or $dd == 09)
			$dd = "09";
	return  $dd;
}*/
function strip_slashes($value)
{
   $value = is_array($value) ?
			   array_map('stripslashes_deep', $value) :
			   stripslashes($value);
   $value  = strip_tags($value);
   return $value;
}
function datetojulian( $month, $day, $year )
{
	if ( 2 < $month )
	{
		$month -= 3;
	}
	else
	{
		$month += 9;
		$year -= 1;
	}
	$c = floor( $year / 100 );
	$ya = $year - 100 * $c;
	$j = floor( 146097 * $c / 4 );
	$j += floor( 1461 * $ya / 4 );
	$j += floor( ( 153 * $month + 2 ) / 5 );
	$j += $day + 1721119;
	return $j;
}
function juliantodate( $julian )
{
	$julian -= 1721119;
	$calc1 = 4 * $julian - 1;
	$year = floor( $calc1 / 146097 );
	$julian = floor( $calc1 - 146097 * $year );
	$day = floor( $julian / 4 );
	$calc2 = 4 * $day + 3;
	$julian = floor( $calc2 / 1461 );
	$day = $calc2 - 1461 * $julian;
	$day = floor( ( $day + 4 ) / 4 );
	$calc3 = 5 * $day - 3;
	$month = floor( $calc3 / 153 );
	$day = $calc3 - 153 * $month;
	$day = floor( ( $day + 5 ) / 5 );
	$year = 100 * $year + $julian;
	if ( $month < 10 )
	{
		$month += 3;
	}
	else
	{
		$month -= 9;
		$year += 1;
	}
	$day = $this->formatday($day);
	return $this->format_month($month)."/{$day}/{$year}";
}
function juliantodate_india( $julian )
{
	$julian -= 1721119;
	$calc1 = 4 * $julian - 1;
	$year = floor( $calc1 / 146097 );
	$julian = floor( $calc1 - 146097 * $year );
	$day = floor( $julian / 4 );
	$calc2 = 4 * $day + 3;
	$julian = floor( $calc2 / 1461 );
	$day = $calc2 - 1461 * $julian;
	$day = floor( ( $day + 4 ) / 4 );
	$calc3 = 5 * $day - 3;
	$month = floor( $calc3 / 153 );
	$day = $calc3 - 153 * $month;
	$day = floor( ( $day + 5 ) / 5 );
	$year = 100 * $year + $julian;
	if ( $month < 10 )
	{
		$month += 3;
	}
	else
	{
		$month -= 9;
		$year += 1;
	}
	$day = formatday($day);
	return format_month($day)."/{$month}/{$year}";
}
////////////
function email_header()
{
	$Header_strMessageBody .= "<table width=100% border=0 align=center cellpadding=2 cellspacing=2 style=border:1px solid #999999>";
	$Header_strMessageBody .= "<tr>";
	$Header_strMessageBody .= "<td>&nbsp;</td>";
	$Header_strMessageBody .= "</tr>";
	$Header_strMessageBody .= "<tr>";
	$Header_strMessageBody .= "<td align=left>Kids Become Adults</td>";
	$Header_strMessageBody .= "</tr>";
	$Header_strMessageBody .= "<tr>";
	$Header_strMessageBody .= "<td><table width=100% border=0 align=center cellpadding=0 cellspacing=0>";
	$Header_strMessageBody .= "<tr>";
	$Header_strMessageBody .= "<td>&nbsp;</td>";
	$Header_strMessageBody .= "</tr>";
	$Header_strMessageBody .= "<tr>";
	$Header_strMessageBody .= "<td style=font-size:12px; font-family:Arial; color:#000000;>";
	return $Header_strMessageBody;
}
function email_footer()
{
	$Footer_strMessageBody .= "</td>";
	$Footer_strMessageBody .= "</tr>";
	$Footer_strMessageBody .= "<tr>";
	$Footer_strMessageBody .= "<td>&nbsp;</td>";
	$Footer_strMessageBody .= "</tr>";
	$Footer_strMessageBody .= "</table></td>";
	$Footer_strMessageBody .= "</tr>";
	$Footer_strMessageBody .= "</table>";
	return $Footer_strMessageBody;
}
function time_stamp($session_time)
{
	$time_difference = time() - $session_time ;
	$seconds = $time_difference ;
	$minutes = round($time_difference / 60 );
	$hours = round($time_difference / 3600 );
	$days = round($time_difference / 86400 );
	$weeks = round($time_difference / 604800 );
	$months = round($time_difference / 2419200 );
	$years = round($time_difference / 29030400 );
	if($seconds <= 60)
	{
		echo"$seconds seconds ago";
	}
	else if($minutes <=60)
	{
	   if($minutes==1)
	   {
		 echo"1 minute ago";
		}
	   else
	   {
	   echo"$minutes minutes ago";
	   }
	}
	else if($hours <=24)
	{
	   if($hours==1)
	   {
	   	echo"1 hour ago";
	   }
	   else
	   {
	   	echo"$hours hours ago";
	   }
	}
	else if($days <=7)
	{
	  if($days==1)
	   {
	   echo"1 day ago";
	   }
	   else
	   {
	   echo"$days days ago";
	   }
	}
	else if($weeks <=4)
	{
		if($weeks==1)
		{
			echo"1 week ago";
		}
		else
		{
			echo"$weeks weeks ago";
		}
	 }
	else if($months <=12)
	{
		if($months==1)
		{
			echo"1 month ago";
		}
		else
		{
			echo"$months months ago";
		}
	}
	else
	{
		if($years==1)
		{
			echo"1 year ago";
		}
		else
		{
			echo"$years years ago";
		}
	}
}
///
function encrypt($sData, $sKey='ebuydeals'){
    $sResult = '';
    for($i=0;$i<strlen($sData);$i++){
        $sChar    = substr($sData, $i, 1);
        $sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1);
        $sChar    = chr(ord($sChar) + ord($sKeyChar));
        $sResult .= $sChar;
    }
    return encode_base64($sResult);
}
function decrypt($sData, $sKey='ebuydeals'){
    $sResult = '';
    $sData   = decode_base64($sData);
    for($i=0;$i<strlen($sData);$i++){
        $sChar    = substr($sData, $i, 1);
        $sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1);
        $sChar    = chr(ord($sChar) - ord($sKeyChar));
        $sResult .= $sChar;
    }
    return $sResult;
}
function encode_base64($sData){
    $sBase64 = base64_encode($sData);
    return strtr($sBase64, '+/', '-_');
}
function decode_base64($sData){
    $sBase64 = strtr($sData, '-_', '+/');
    return base64_decode($sBase64);
}
function _prepare_url_text($string)
{
	global $siteurl;
	// remove all characters that aren't a-z, 0-9, dash, underscore or space
	$NOT_acceptable_characters_regex = '#[^-a-zA-Z0-9_ ]#';
	$string = preg_replace($NOT_acceptable_characters_regex, '', $string);
	// remove all leading and trailing spaces
	$string = trim($string);
	// change all dashes, underscores and spaces to dashes
	$string = preg_replace('#[-_ ]+#', '-', $string);
	// return the modified string
	return $string;
}
  ?>
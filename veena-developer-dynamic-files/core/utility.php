<?

class utility extends Singleton

{

	private $uploaded_file;

	public $app;

	public static function &get_instance()

	{

		parent::$my_name = __CLASS__;

		return parent::get_instance();

	}

	function init(){

		$this->app = &app::get_instance();

	}

	function get_uploaded_file(){

		return $this->uploaded_file;

	}
	


	function upload_file($file)

	{

		$file_info = $this->get_file_info($file['name']);

		$tmpname = time()."_".mt_rand(1000, 2000).".".$file_info->extension;

		if(!move_uploaded_file($file['tmp_name'], ABS_PATH.DS."temp".DS.$tmpname)){

			return false;

		}else{

			$this->uploaded_file = ABS_PATH.DS."temp".DS.$tmpname;

			return true;

		}

	}
	

	function store_uploaded_file($uploaddir, $uploadfilename="",$chmod=""){

		if($uploadfilename==""){

			$uploadfilename = basename($local_file);

		}

		$tmpname = $this->uploaded_file;

		if(USE_FTP){

			if(!class_exists("ftp")){

				$ftp_class = $this->app->add_module("ftp");

				if($ftp_class != NULL){

					$ftp = new $ftp_class();

				}else{

					trigger_error("Could not load ftp module", E_USER_ERROR);

				}

			}else{

				$ftp = new ftp();

			}

			if(!$ftp->SetServer(FTP_HOST)) {

				$ftp->quit();

				return false;

			}

			if (!$ftp->connect()) {

				$ftp->quit();

				return false;

			}

			if (!$ftp->login(FTP_USERNAME, FTP_PASSWORD)) {

				$ftp->quit();

				return false;

			}

			$ftp->SetType(FTP_AUTOASCII);

			$ftp->Passive(FALSE);

			$ftp->chdir(FTP_WWWDIR.$uploaddir);

			$ftp->pwd();

			if(FALSE === $ftp->put($tmpname, $uploadfilename)){

				if($this->uploaded_file!=$tmpname){

					@unlink($tmpname);

				}

				$ftp->quit();

				return false;

			}else{

				if($this->uploaded_file!=$tmpname){

					@unlink($tmpname);

				}

				if(is_numeric($chmod)){

					$ftp->chmod($uploadfilename, $chmod);

				}

				$ftp->quit();

				return true;

			}

		}else{

			if(copy($tmpname, ABS_PATH.DS.$uploaddir.DS.$uploadfilename)){

				if($this->uploaded_file!=$tmpname){

					@unlink($tmpname);

				}

				return true;

			}else{

				if($this->uploaded_file!=$tmpname){

					@unlink($tmpname);

				}

				return false;

			}

		}

	}

	function remove_uploaded_file(){

		@unlink($this->uploaded_file);

	}

	function HTMLSafeString($Input, $QuotedString=true){

		$Output = "";

		$Output = strip_tags($Input);

		if($QuotedString)

			$Output = str_replace("\"","",$Output);

		return $Output;

	}

	function DateAdd($interval, $number, $date="") {

		if($date!=""){

			$date_time_array = getdate($date);

		}else{

			$date_time_array = getdate();

		}

		$hours = $date_time_array['hours'];

		$minutes = $date_time_array['minutes'];

		$seconds = $date_time_array['seconds'];

		$month = $date_time_array['mon'];

		$day = $date_time_array['mday'];

		$year = $date_time_array['year'];

		switch ($interval) {

			case 'yyyy':

				$year+=$number;

				break;

			case 'q':

				$year+=($number*3);

				break;

			case 'm':

				$month+=$number;

				break;

			case 'y':

			case 'd':

			case 'w':

				$day+=$number;

				break;

			case 'ww':

				$day+=($number*7);

				break;

			case 'h':

				$hours+=$number;

				break;

			case 'n':

				$minutes+=$number;

				break;

			case 's':

				$seconds+=$number;

				break;

		}

		$timestamp= mktime($hours,$minutes,$seconds,$month,$day,$year);

		return $timestamp;

	}

	function GetPageName(){

		$tmpArray = explode(DS,$_SERVER['SCRIPT_FILENAME']);

		$pagename = $tmpArray[sizeof($tmpArray)-1];

		return $pagename;

	}

	function GetPageURL(){

		$pageURL = 'http://';

		if(array_key_exists("HTTPS", $_SERVER)){

			if(strtoupper($_SERVER["HTTPS"])=="ON"){

				$pageURL = 'https://';

			}

		}

		$pageURL .= $_SERVER['HTTP_HOST']."/".$_SERVER["REQUEST_URI"];

		return $pageURL;

	}

	function GetContentType($file_extension){

		switch(strtolower($file_extension)){

			 case "pdf": $ctype="application/pdf"; break;

			 case "exe": $ctype="application/octet-stream"; break;

			 case "zip": $ctype="application/zip"; break;

			 case "doc": $ctype="application/msword"; break;

			 case "xls": $ctype="application/vnd.ms-excel"; break;

			 case "ppt": $ctype="application/vnd.ms-powerpoint"; break;

			 case "gif": $ctype="image/gif"; break;

			 case "png": $ctype="image/png"; break;

			 case "jpeg":

			 case "jpg": $ctype="image/jpg"; break;

			 case "mp3": $ctype="audio/mpeg"; break;

			 case "wav": $ctype="audio/x-wav"; break;

			 case "mpeg":

			 case "mpg":

			 case "mpe": $ctype="video/mpeg"; break;

			 case "mov": $ctype="video/quicktime"; break;

			 case "avi": $ctype="video/x-msvideo"; break;

			 case "php":

			 case "htm":

			 case "html":

			 case "txt": die("<b>Cannot be used for ". $file_extension ." files!</b>"); break;

			 default: $ctype="application/x-download";

		}

		return $ctype;

	}

	function GenerateRandomKey($Length){

		$Key = "";

		$found = false;

		while(strlen($Key)<$Length){

			srand((double)microtime()*1000000);

			$number = rand(50,150);

			if($number>=65 && $number<=90)

				$Key = $Key.chr($number);

			elseif($number>=48 && $number<=57)

				$Key = $Key.chr($number);

		}

		return trim($Key);

	}

	function ParseMailTemplate($Template, $Custom=""){

		$GeneralKywords = array();

		$GeneralKywords["SERVER_ROOT"]=SERVER_ROOT;

		$f = fopen(ABS_PATH.DS.MAIL_TEMPLATE_PATH."/".$Template,"r");

		if(!$f){

			return NULL;

		}

		$TemplateBody = fread($f,filesize(ABS_PATH.DS.MAIL_TEMPLATE_PATH."/".$Template));

		fclose($f);

		$HTMLBody=$TemplateBody;

		if(is_array($Custom)){

			foreach($Custom as $Find=>$ReplaceWith){

				$TemplateBody = str_replace("{".$Find."}",$ReplaceWith,$TemplateBody);

			}

		}

		foreach($GeneralKywords as $Find=>$ReplaceWith){

			$TemplateBody = str_replace("{".$Find."}",$ReplaceWith,$TemplateBody);

		}

		return $TemplateBody;

	}

	function ParseMailText($Text, $Custom=""){

		$GeneralKywords = array();

		$GeneralKywords["SERVER_ROOT"]=SERVER_ROOT;

		$TemplateBody = $Text;

		$HTMLBody=$TemplateBody;

		if(is_array($Custom)){

			foreach($Custom as $Find=>$ReplaceWith){

				$TemplateBody = str_replace("{".$Find."}",$ReplaceWith,$TemplateBody);

			}

		}

		foreach($GeneralKywords as $Find=>$ReplaceWith){

			$TemplateBody = str_replace("{".$Find."}",$ReplaceWith,$TemplateBody);

		}

		return $TemplateBody;

	}

	function DateDiff($endDate, $beginDate){

		$date_parts1[0]=date("m", $beginDate);

		$date_parts1[1]=date("d", $beginDate);

		$date_parts1[2]=date("Y", $beginDate);

		$date_parts2[0]=date("m", $endDate);

		$date_parts2[1]=date("d", $endDate);

		$date_parts2[2]=date("Y", $endDate);

		$start_date=gregoriantojd($date_parts1[0], $date_parts1[1], $date_parts1[2]);

		$end_date=gregoriantojd($date_parts2[0], $date_parts2[1], $date_parts2[2]);

		return $end_date - $start_date;

	}

	function TimeDiff($bigTime,$smallTime){

			list($h1,$m1,$s1)=split(":",$bigTime);

			list($h2,$m2,$s2)=split(":",$smallTime);

			$second1=$s1+($h1*3600)+($m1*60);//converting it into seconds

			$second2=$s2+($h2*3600)+($m2*60);

			if ($second1==$second2)

			{

				$resultTime="00:00:00";

				return $resultTime;

				exit();

			}

			if ($second1<$second2) //

			{

				$second1=$second1+(24*60*60);//adding 24 hours to it.

			}

			$second3=$second1-$second2;

			//print $second3;

			if ($second3==0)

			{

				$h3=0;

			}

			else

			{

				$h3=floor($second3/3600);//find total hours

			}

			$remSecond=$second3-($h3*3600);//get remaining seconds

			if ($remSecond==0)

			{

				$m3=0;

			}

			else

			{

				$m3=floor($remSecond/60);// for finding remaining  minutes

			}

			$s3=$remSecond-(60*$m3);

			if($h3==0)//formating result.

			{

				$h3="00";

			}

			if($m3==0)

			{

				$m3="00";

			}

			if($s3==0)

			{

				$s3="00";

			}

			$resultTime=array($h3,$m3,$s3);

			return $resultTime;

	}

	function ChangeDateFormat($Date, $FromFormat, $ToFormat){

		$KnownFormat = array("012"=>"ddmmyyyy","102"=>"mmddyyyy","210"=>"yyyymmdd");

		if(!in_array($FromFormat,$KnownFormat) || !in_array($ToFormat,$KnownFormat)){

			echo "<h3>Error in function \"ConvertDateFormat\" : Unknown Date Format";

			exit;

		}

		$Seperator="";

		if(strpos($Date,"/")===false){

		}else{

			$Seperator="/";

		}

		if(strpos($Date,"\\")===false){

		}else{

			$Seperator="\\";

		}

		if(strpos($Date,"-")===false){

		}else{

			$Seperator="-";

		}

		if($Seperator==""){

			echo "<h3>Error in function \"ChangeDateFormat\" : Unknown Date Seperator";

			exit;

		}

		$DateArr = explode($Seperator,$Date);

		$FromDateSequence = array_search($FromFormat, $KnownFormat);

		$Day = $DateArr[strpos($FromDateSequence,"0")];

		$Month = $DateArr[strpos($FromDateSequence,"1")];

		$Year = $DateArr[strpos($FromDateSequence,"2")];

		$ToDateSequence = array_search($ToFormat, $KnownFormat);

		$NewDate = $DateArr[substr($ToDateSequence,0,1)].$Seperator.$DateArr[substr($ToDateSequence,1,1)].$Seperator.$DateArr[substr($ToDateSequence,2,1)];

		return $NewDate;

	}

	function NormalizeURL($URL, $tolower = true){

		$find = array("/\s+/", "/[-]+/", "/\\\/", "/'/");

		$replace_with = array("-", "-", "", "");

		$URL = preg_replace($find, $replace_with, $URL);

		if($tolower){

			$URL = strtolower($URL);

		}

		return strtolower($URL);

	}

	function ArraySearchRecursive($needle, $haystack){

		foreach($haystack as $value){

			if(is_array($value))

				$match=array_search_r($needle, $value);

			if($value==$needle)

				$match=1;

			if($match)

				return 1;

		}

		return 0;

	}

	function html2txt ( $document ){

			$search = array ("'<script[^>]*?>.*?</script>'si",	// strip out javascript

					"'<[\/\!]*?[^<>]*?>'si",		// strip out html tags

					"'([\r\n])[\s]+'",			// strip out white space

					"'@<![\s\S]*?�??[ \t\n\r]*>@'",

					"'&(quot|#34|#034|#x22);'i",		// replace html entities

					"'&(amp|#38|#038|#x26);'i",		// added hexadecimal values

					"'&(lt|#60|#060|#x3c);'i",

					"'&(gt|#62|#062|#x3e);'i",

					"'&(nbsp|#160|#xa0);'i",

					"'&(iexcl|#161);'i",

					"'&(cent|#162);'i",

					"'&(pound|#163);'i",

					"'&(copy|#169);'i",

					"'&(reg|#174);'i",

					"'&(deg|#176);'i",

					"'&(#39|#039|#x27);'",

					"'&(euro|#8364);'i",			// europe

					"'&a(uml|UML);'",			// german

					"'&o(uml|UML);'",

					"'&u(uml|UML);'",

					"'&A(uml|UML);'",

					"'&O(uml|UML);'",

					"'&U(uml|UML);'",

					"'&szlig;'i",

					);

			$replace = array (	"",

						"",

						" ",

						"\"",

						"&",

						"<",

						">",

						" ",

						chr(161),

						chr(162),

						chr(163),

						chr(169),

						chr(174),

						chr(176),

						chr(39),

						chr(128),

						"ä",

						"ö",

						"ü",

						"�?",

						"�?",

						"�?",

						"�?",

					);

			$text = preg_replace($search,$replace,$document);

			return trim ( $text );

	}

	function get_file_info($file){

		$file_name = basename($file);

		$tmparr = explode(".", $file_name);

		$fileinfo = (object)NULL;

		$file_name = "";

		for($i=0; $i<(count($tmparr)-1); $i++){

			$file_name.=".".$tmparr[$i];

		}

		if(strlen($file_name)>0){

			$file_name = substr($file_name, 1);

		}

		$fileinfo->filename = $file_name;

		$fileinfo->extension = $tmparr[count($tmparr)-1];

		return $fileinfo;

	}

	function random_color(){

		mt_srand((double)microtime()*1000000);

		$c = '';

		while(strlen($c)<6){

			$c .= sprintf("%02X", mt_rand(0, 255));

		}

		return $c;

	}

	function format_currency($number, $decimal_places=2, $decimal_symbol=".", $thousand_seperator=",", $currency_symbol="", $currency_symbol_position='before'){

		if(!is_numeric($number)){

			return $number;

		}else{

			$formatted_number = number_format($number, $decimal_places, $decimal_symbol, $thousand_seperator);

			if($currency_symbol!=""){

				if($currency_symbol_position=='after'){

					$formatted_number = $formatted_number." ".$currency_symbol;

				}else{

					$formatted_number = $currency_symbol." ".$formatted_number;

				}

			}

			return $formatted_number;

		}

	}

	function set_message($message, $type){

		$_SESSION['msg'] = $message;

		$_SESSION['type'] = $type;

	}

	function get_message(){

		if(isset($_SESSION['msg']) && isset($_SESSION['type'])){

			if($_SESSION['type']=='SUCCESS'){

				if(VIR_DIR!="")

				{
					
					if(VIR_DIR=="admin/")



					{


				$message =  '<div class="alert alert-success alert-dismissable">



                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>



                                        <h4><strong>Success</strong></h4>



                                        <p>'.$_SESSION['msg'].'</p>



                                    </div>';
					
					}
					else
					{
						$message = '<div class="alert alert-success">

					 <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>

					<strong>Success!</strong> '.$_SESSION['msg'].'

					</div>';
						
					}

				}

				else

				{

					$message =  '<p class="alert alert-success border-0 p-3 pl-5 rounded fs__12"><i class="las la-bell fs__22 mr-2 position-absolute top-15 left-15 text-dark"></i> '.$_SESSION['msg'].'</p>

				';

				}

			}else if($_SESSION['type']=='ERROR'){

				if(VIR_DIR!="")

				{
					
					if(VIR_DIR=="admin/")



					{
						
						$message =  '



						<div class="alert alert-danger alert-dismissable">



                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>



                                        <h4><strong>Error</strong></h4>



                                        <p> '.$_SESSION['msg'].'</p>



                                    </div>';
						
					}
					else
					{

						$message =  '<div class="alert alert-error">

					 <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>

					 <strong>Error!</strong> '.$_SESSION['msg'].'

						</div>';
					
					}

				}

				else

				{

				$message =  '<p class="alert alert-danger border-0 p-3 pl-5 rounded fs__12"><i class="las la-bell fs__22 mr-2 position-absolute top-15 left-15 text-dark"></i> '.$_SESSION['msg'].'</p>

				';


				}

			}else if($_SESSION['type']=='MESSAGE'){

				$message =  '<div class="alert_box r_corners warning m_bottom_10">

					 	<button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>

						<i class="fa fa-exclamation-triangle"></i><p>'.$_SESSION['msg'].'</p>

						</div>';

			}

			unset($_SESSION['msg']);

			unset($_SESSION['type']);

			return $message;

		}

	}

	function string_truncate($string,$length){

		$length_of_string = strlen($string);

		if($length_of_string > $length ){

			return substr($string,0,$length)."..";

		}else{

			return $string;

		}

	}

	function xTimeAgo ($oldTime, $newTime, $timeType) {

        $timeCalc = strtotime($newTime) - strtotime($oldTime);

        if ($timeType == "x") {

            if ($timeCalc == 60) {

                $timeType = "m";

            }

            if ($timeCalc == (60*60)) {

                $timeType = "h";

            }

            if ($timeCalc == (60*60*24)) {

                $timeType = "d";

            }

        }

        if ($timeType == "s") {

            $timeCalc .= " seconds ago";

        }

        if ($timeType == "m") {

            $timeCalc = round($timeCalc/60) . " minutes ago";

        }

        if ($timeType == "h") {

            $timeCalc = round($timeCalc/60/60) . " hours ago";

        }

        if ($timeType == "d") {

            $timeCalc = round($timeCalc/60/60/24) . " days ago";

        }

        return $timeCalc;

    }

	function change_weight_display($value){

		$round = $value/1000;

		if($round>=1){

			$num=number_format($round,2);

			$num=$num;

			return $num." Kg";

		}else{

				$num=$value;

			return $num." Gm";

		}

	}

	function change_weight_display_other($value){

		$round = $value/1000;

		if($round>=1){

			$num=number_format($round,2);

			$num=$num;

			return $num." Kg";

		}else{

				$num=$value;

			return (int) $num." Gm";

		}

	}

function seo_url($string)

{

    $string = str_replace(array('[\', \']'), '', $string);

    $string = preg_replace('/\[.*\]/U', '', $string);

    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);

    $string = htmlentities($string, ENT_COMPAT, 'utf-8');

    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );

    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);

    return strtolower(trim($string, '-'));

}

function getExtension($str)

{

        			 $i = strrpos($str,".");

        			 if (!$i) { return ""; }

         			$l = strlen($str) - $i;

         			$ext = substr($str,$i+1,$l);

         			return $ext;

}

function resize_image($uploadedfile_name,$uploadedfile_tmpname,$image_user_config,$user_width1,$user_width2,$user_width3)

{

			$errors=0;

		//$image =$_FILES["file"]["name"];

			$uploadedfile = $uploadedfile_tmpname;

			$file_name = basename($uploadedfile_name);

    		$file_info = $this->get_file_info($file_name);

			if(strtoupper($file_info->extension)=="JPG" || strtoupper($file_info->extension)=="JPEG" || strtoupper($file_info->extension)=="GIF"  || strtoupper($file_info->extension)=="PNG"){

			$new_name = rand(9,99).time().".".$file_info->extension;

					}

 			if ($new_name)

 			{

 			$filename = stripslashes($uploadedfile_name);

 	 		$i = strrpos($filename,".");

        	 if (!$i) { return ""; }

         	 $l = strlen($filename) - $i;

         	 $ext = substr($filename,$i+1,$l);

			$extension = $ext;

 			$extension = strtolower($extension);

 			if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))

 			{

 			$change='<div class="msgdiv">Unknown Image extension </div> ';

 			$errors=1;

 			}

 			else

 			{

 			$size=filesize($uploadedfile_tmpname);

			if($extension=="jpg" || $extension=="jpeg" )

			{

			$uploadedfile = $uploadedfile_tmpname;

			$src = imagecreatefromjpeg($uploadedfile);

			}

			else if($extension=="png")

			{

			$uploadedfile = $uploadedfile_tmpname;

			$src = imagecreatefrompng($uploadedfile);

			}

			else

			{

			$src = imagecreatefromgif($uploadedfile);

			}

			echo $scr;

			list($width,$height)=getimagesize($uploadedfile);

			if($width>$user_width1)

					{

					$newwidth=$user_width1;

					$newheight=($height/$width)*$newwidth;

					$tmp=imagecreatetruecolor($newwidth,$newheight);

					}

					else

					{

					$newwidth=$width;

					$newheight=($height/$width)*$newwidth;

					$tmp=imagecreatetruecolor($newwidth,$newheight);

					}

					if($width>$user_width2)

					{

					$newwidth1=$user_width2;

					$newheight1=($height/$width)*$newwidth1;

					$tmp1=imagecreatetruecolor($newwidth1,$newheight1);

					}

					else

					{

					$newwidth1=$width;

					$newheight1=($height/$width)*$newwidth1;

					$tmp1=imagecreatetruecolor($newwidth1,$newheight1);

					}

					if($width>$user_width3)

					{

					$newwidth2=$user_width3;

					$newheight2=($height/$width)*$newwidth2;

					$tmp2=imagecreatetruecolor($newwidth2,$newheight2);

					}

					else

					{

					$newwidth2=$width;

					$newheight2=($height/$width)*$newwidth2;

					$tmp2=imagecreatetruecolor($newwidth2,$newheight2);

					}

			imagecolortransparent($tmp, imagecolorallocatealpha($tmp, 0, 0, 0, 127));

    		imagealphablending($tmp, false);

    		imagesavealpha($tmp, true);

			imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

			imagecolortransparent($tmp1, imagecolorallocatealpha($tmp1, 0, 0, 0, 127));

    		imagealphablending($tmp1, false);

    		imagesavealpha($tmp1, true);

			imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);

			imagecolortransparent($tmp2, imagecolorallocatealpha($tmp2, 0, 0, 0, 127));

    		imagealphablending($tmp2, false);

    		imagesavealpha($tmp2, true);

			imagecopyresampled($tmp2,$src,0,0,0,0,$newwidth2,$newheight2,$width,$height);

			$filename = "../".$image_user_config.$new_name;

			$filename1 = "../".$image_user_config."mediumthumb".$new_name;

			$filename2 = "../".$image_user_config."thumb".$new_name;

			if($extension=="jpg" || $extension=="jpeg" )

			{

			imagejpeg($tmp,$filename,100);

			imagejpeg($tmp1,$filename1,100);

			imagejpeg($tmp2,$filename2,100);

			}

			else if($extension=="png")

			{

			imagepng($tmp,$filename);

			imagepng($tmp1,$filename1);

			imagepng($tmp2,$filename2);

			}

			else

			{

			imagepng($tmp,$filename,100);

			imagepng($tmp1,$filename1,100);

			imagepng($tmp2,$filename2,100);

			}

			imagedestroy($src);

			imagedestroy($tmp);

			imagedestroy($tmp1);

			imagedestroy($tmp2);

}

}

return $new_name;

}

function resize_multi_image($uploadedfile_name,$uploadedfile_tmpname,$image_user_config,$user_width1,$user_width2,$user_width3)

{

			$errors=0;

		//$image =$_FILES["file"]["name"];

			$uploadedfile = $uploadedfile_tmpname;

			$file_name = basename($uploadedfile_name);

    		$file_info = $this->get_file_info($file_name);

			if(strtoupper($file_info->extension)=="JPG" || strtoupper($file_info->extension)=="JPEG"  || strtoupper($file_info->extension)=="GIF"  || strtoupper($file_info->extension)=="PNG"){

			$new_name =time().rand(1125,999).".".$file_info->extension;

					}

 			if ($new_name)

 			{

 			$filename = stripslashes($uploadedfile_name);

 	 		$i = strrpos($filename,".");

        	 if (!$i) { return ""; }

         	 $l = strlen($filename) - $i;

         	 $ext = substr($filename,$i+1,$l);

			$extension = $ext;

 			$extension = strtolower($extension);

 			if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))

 			{

 			$change='<div class="msgdiv">Unknown Image extension </div> ';

 			$errors=1;

 			}

 			else

 			{

 			$size=filesize($uploadedfile_tmpname);

			if($extension=="jpg" || $extension=="jpeg" )

			{

			$uploadedfile = $uploadedfile_tmpname;

			$src = imagecreatefromjpeg($uploadedfile);

			}

			else if($extension=="png")

			{

			$uploadedfile = $uploadedfile_tmpname;

			$src = imagecreatefrompng($uploadedfile);

			}

			else

			{

			$src = imagecreatefromgif($uploadedfile);

			}

			echo $scr;

			list($width,$height)=getimagesize($uploadedfile);

			if($width>$user_width1)

					{

					$newwidth=$user_width1;

					$newheight=($height/$width)*$newwidth;

					$tmp=imagecreatetruecolor($newwidth,$newheight);

					}

					else

					{

					$newwidth=$width;

					$newheight=($height/$width)*$newwidth;

					$tmp=imagecreatetruecolor($newwidth,$newheight);

					}

					if($width>$user_width2)

					{

					$newwidth1=$user_width2;

					$newheight1=($height/$width)*$newwidth1;

					$tmp1=imagecreatetruecolor($newwidth1,$newheight1);

					}

					else

					{

					$newwidth1=$width;

					$newheight1=($height/$width)*$newwidth1;

					$tmp1=imagecreatetruecolor($newwidth1,$newheight1);

					}

					if($width>$user_width3)

					{

					$newwidth2=$user_width3;

					$newheight2=($height/$width)*$newwidth2;

					$tmp2=imagecreatetruecolor($newwidth2,$newheight2);

					}

					else

					{

					$newwidth2=$width;

					$newheight2=($height/$width)*$newwidth2;

					$tmp2=imagecreatetruecolor($newwidth2,$newheight2);

					}

			imagecolortransparent($tmp, imagecolorallocatealpha($tmp, 0, 0, 0, 127));

    		imagealphablending($tmp, false);

    		imagesavealpha($tmp, true);

			imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

			imagecolortransparent($tmp1, imagecolorallocatealpha($tmp1, 0, 0, 0, 127));

    		imagealphablending($tmp1, false);

    		imagesavealpha($tmp1, true);

			imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);

			imagecolortransparent($tmp2, imagecolorallocatealpha($tmp2, 0, 0, 0, 127));

    		imagealphablending($tmp2, false);

    		imagesavealpha($tmp2, true);

			imagecopyresampled($tmp2,$src,0,0,0,0,$newwidth2,$newheight2,$width,$height);

			$filename = $image_user_config.$new_name;

			$filename1 = $image_user_config."mediumthumb".$new_name;

			$filename2 = $image_user_config."thumb".$new_name;

			if($extension=="jpg" || $extension=="jpeg" )

			{

			imagejpeg($tmp,$filename,100);

			imagejpeg($tmp1,$filename1,100);

			imagejpeg($tmp2,$filename2,100);

			}

			else if($extension=="png")

			{

			imagepng($tmp,$filename);

			imagepng($tmp1,$filename1);

			imagepng($tmp2,$filename2);

			}

			else

			{

			imagepng($tmp,$filename,100);

			imagepng($tmp1,$filename1,100);

			imagepng($tmp2,$filename2,100);

			}

			imagedestroy($src);

			imagedestroy($tmp);

			imagedestroy($tmp1);

			imagedestroy($tmp2);

}

}

return $new_name;

}

//FOr Single image resize

function resize_single_image($uploadedfile_name,$uploadedfile_tmpname,$image_user_config,$user_width1)

{

			$errors=0;

			//$image =$_FILES["file"]["name"];

			if(!empty($uploadedfile_name))

			{

			$uploadedfile = $uploadedfile_tmpname;

			$file_name = basename($uploadedfile_name);

    		$file_info = $this->get_file_info($file_name);

			if(strtoupper($file_info->extension)=="JPG" || strtoupper($file_info->extension)=="JPEG"  || strtoupper($file_info->extension)=="GIF"  || strtoupper($file_info->extension)=="PNG"){

			$new_name = time().rand(9,99).".".$file_info->extension;

			}

 			if ($new_name)

 			{

 			$filename = stripslashes($uploadedfile_name);

 			 $i = strrpos($filename,".");

        	 if (!$i) { return ""; }

         	 $l = strlen($filename) - $i;

         	 $ext = substr($filename,$i+1,$l);

			$extension = $ext;

 			$extension = strtolower($extension);

 			if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))

 			{

 			$change='<div class="msgdiv">Unknown Image extension </div> ';

 			$errors=1;

 			}

 			else

 			{

 			$size=filesize($uploadedfile_tmpname);

			if($extension=="jpg" || $extension=="jpeg" )

			{

			$uploadedfile = $uploadedfile_tmpname;

			$src = imagecreatefromjpeg($uploadedfile);

			}

			else if($extension=="png")

			{

			$uploadedfile = $uploadedfile_tmpname;

			$src = imagecreatefrompng($uploadedfile);

			}

			else

			{

			$src = imagecreatefromgif($uploadedfile);

			}

			//echo $scr;

			list($width,$height)=getimagesize($uploadedfile);

			if($width>$user_width1)

					{

					$newwidth=$user_width1;

					$newheight=($height/$width)*$newwidth;

					$tmp=imagecreatetruecolor($newwidth,$newheight);

					}

					else

					{

					$newwidth=$width;

					$newheight=($height/$width)*$newwidth;

					$tmp=imagecreatetruecolor($newwidth,$newheight);

					}

			imagecolortransparent($tmp, imagecolorallocatealpha($tmp, 0, 0, 0, 127));

    		imagealphablending($tmp, false);

    		imagesavealpha($tmp, true);

			imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

			$filename = "../".$image_user_config.$new_name;

			if($extension=="jpg" || $extension=="jpeg" )

			{

			imagejpeg($tmp,$filename,100);

			}

			else if($extension=="png")

			{

			imagepng($tmp,$filename);

			}

			else

			{

			imagepng($tmp,$filename,100);

			}

			imagedestroy($src);

			imagedestroy($tmp);

			}

}

else

{

}

}

return $new_name;

}

function resize_single_image_front($uploadedfile_name,$uploadedfile_tmpname,$image_user_config,$user_width1)

{

$errors=0;

//$image =$_FILES["file"]["name"];

			$uploadedfile = $uploadedfile_tmpname;

			$file_name = basename($uploadedfile_name);

    		$file_info = $this->get_file_info($file_name);

					if(strtoupper($file_info->extension)=="JPG" || strtoupper($file_info->extension)=="GIF"  || strtoupper($file_info->extension)=="PNG"){

						$new_name = time().".".$file_info->extension;

					}

 			if ($new_name)

 			{

 			$filename = stripslashes($uploadedfile_name);

  			$extension = $this->getExtension($filename);

 			$extension = strtolower($extension);

 			if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))

 			{

 			$change='

 			<div class="msgdiv">Unknown Image extension </div>

';

 			$errors=1;

 			}

 			else

 			{

 		$size=filesize($uploadedfile_tmpname);

			if($extension=="jpg" || $extension=="jpeg" )

			{

			$uploadedfile = $uploadedfile_tmpname;

			$src = imagecreatefromjpeg($uploadedfile);

			}

			else if($extension=="png")

			{

			$uploadedfile = $uploadedfile_tmpname;

			$src = imagecreatefrompng($uploadedfile);

			}

			else

			{

			$src = imagecreatefromgif($uploadedfile);

			}

			echo $scr;

			list($width,$height)=getimagesize($uploadedfile);

			if($width>$user_width1)

					{

					$newwidth=$user_width1;

					$newheight=($height/$width)*$newwidth;



					$tmp=imagecreatetruecolor($newwidth,$newheight);

					}

					else

					{

					$newwidth=$width;

					$newheight=($height/$width)*$newwidth;

					$tmp=imagecreatetruecolor($newwidth,$newheight);

					}

			imagecolortransparent($tmp, imagecolorallocatealpha($tmp, 0, 0, 0, 127));

    		imagealphablending($tmp, false);

    		imagesavealpha($tmp, true);

			imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

			//imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

			$filename =$image_user_config.$new_name;

			if($extension=="jpg" || $extension=="jpeg" )

			{

			imagejpeg($tmp,$filename,100);

			}

			else if($extension=="png")

			{

			imagepng($tmp,$filename);

			}

			else

			{

			imagepng($tmp,$filename,100);

			}

			//imagejpeg($tmp,$filename,100);

			imagedestroy($src);

			imagedestroy($tmp);

}

}

return $new_name;

}

function is_member_login()

{

	if(isset($_SESSION['MemberID']))

	{

		$login = true;

	}

	else

	{

		$login = false;

	}

	return $login;

}

function thumbnail($image_path,$thumb_path,$image_name,$thumb_width)

{

    $src_img = imagecreatefromjpeg("$image_path/$image_name");

    $origw=imagesx($src_img);

    $origh=imagesy($src_img);

    $new_w = $thumb_width;

    $diff=$origw/$new_w;

    $new_h=$new_w;

    $dst_img = imagecreate($new_w,$new_h);

    imagecopyresized($dst_img,$src_img,0,0,0,0,$new_w,$new_h,imagesx($src_img),imagesy($src_img));

    imagejpeg($dst_img, "$thumb_path/$image_name");

    return TRUE;

}

function resize($filename, $width, $height)

	  {

		if (!file_exists(DIR_IMAGE . $filename) || !is_file(DIR_IMAGE . $filename))

		{

			return;

		}

		$info = pathinfo($filename);

		$extension = $info['extension'];

		$old_image = $filename;

		 $new_image = 'cache/' . substr($filename, 0, strrpos($filename, '.')) . '-' . $width . 'x' . $height . '.' . $extension;

		if (!file_exists(DIR_IMAGE . $new_image) || (filemtime(DIR_IMAGE . $old_image) > filemtime(DIR_IMAGE . $new_image))) {

			$path = '';

			$directories = explode('/', dirname(str_replace('../', '', $new_image)));

			foreach ($directories as $directory) {

				$path = $path . '/' . $directory;

				if (!file_exists(DIR_IMAGE . $path)) {

					@mkdir(DIR_IMAGE . $path, 0777);

				}

			}

			list($width_orig, $height_orig) = getimagesize(DIR_IMAGE . $old_image);

			if ($width_orig != $width || $height_orig != $height) {

				//$is=$this->app->load_module("Image");

				/*if($is == NULL)

				{

				echo 'Could not load Image Resizer Module';

			    }*/

				$is=$this->app->load_module("Image");

				$is = new Image(DIR_IMAGE . $old_image);

				$is->resize($width, $height);

				$is->save(DIR_IMAGE . $new_image);

			} else {

				copy(DIR_IMAGE . $old_image, DIR_IMAGE . $new_image);

			}



		}

		if (isset($_SERVER["HTTPS"]) && (($_SERVER["HTTPS"] == 'on') || ($this->request->server['HTTPS'] == '1'))) {

			return $new_image;

		} else {

			return $new_image;

		}

	}

function highlight1($text, $words)

{

    $split_words = explode("" , $words );

    foreach($split_words as $word)

    {

        $word=trim($word);

		$color = "#e5e5e5";

$text =preg_replace("|($word)|Ui" ,"<b class='matched_word'><b>$1</b></b>" , $text );

    }

    return $text;

}

function highlight($str, $keyword) {

$str = preg_replace("/\b([a-z]*${keyword}[a-z]*)\b/i","<b>$1</b>",$str);

return $str;

}



function curPageURL() {

 $pageURL = 'http';

 //if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}

 $pageURL .= "://";

 if ($_SERVER["SERVER_PORT"] != "80") {

  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];

 } else {

  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

 }

 return $pageURL;

}

function removeFromString($str, $item) {

    $parts = explode(',', $str);

    while(($i = array_search($item, $parts)) !== false) {

        unset($parts[$i]);

    }

    return implode(',', $parts);

}

function keygen($length)

{

		   	 $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

   			 $charactersLength = strlen($characters);

   			 $key = '';

			for ($i = 0; $i < $length; $i++) {

				$key .= $characters[rand(0, $charactersLength - 1)];

			}

		if(strlen($key)!=$length)

		{

			$this->keygen($length);

		}

		else if(strlen($key)==$length)

		{

			if($key!='')

			{

				$obj_model_user = $this->app->load_model("customer");

				$rs_user = $obj_model_user->execute("SELECT",false,"SELECT ref_key FROM customer WHERE ref_key='".$key."'","");

				if(count($rs_user)>0)

				{

					$this->keygen($length);

				}

				else

				{

					return $key;

				}

			}

			else

			{

				$this->keygen($length);

			}

		}

		else

		{

			$this->keygen($length);

		}

}

function random_password($length)

{

	$key = '';

	list($usec, $sec) = explode(' ', microtime());

	mt_srand((float) $sec + ((float) $usec * 100000));

   	$inputs = array_merge(range('a','z'),range(0,9),range('A','Z'));

   	for($i=0; $i<$length; $i++)

	{

   	    $key .= $inputs{mt_rand(0,61)};

	}

	return $key;

}

function last_id($table_name)

		{

			$obj_model_lid = $this->app->load_model($table_name);

			$rslid=$obj_model_lid->execute("SELECT",false,"","","id DESC LIMIT 1");

			return $rslid[0]['id'];

		}

function unique_slug($table_name,$action,$slug_field,$value,$edit_id=0)

		{

		 if($action=='add'){

			$value_slug=$this->seo_url($value);

			$obj_model_slug = $this->app->load_model($table_name);

			$rsslug=$obj_model_slug->execute("SELECT",false,"","".$slug_field."='".$value_slug."'");

			if(count($rsslug)>0)

			{

				$slug_id=$this->last_id($table_name)+1;

				$slug=$value_slug.'_'.$slug_id;

			}

			else

			{

			$slug=$value_slug;

			}

		 }

		 else

		 {

			$value_slug=$this->seo_url($value);

			$obj_model_slug = $this->app->load_model($table_name);

			$rsslug=$obj_model_slug->execute("SELECT",false,"","id!=".$edit_id." and ".$slug_field."='".$value_slug."'");

			if(count($rsslug)>0)

			{

				$slug_id=$edit_id;

				$slug=$value_slug.'_'.$slug_id;

			}

			else

			{

			$slug=$value_slug;

			}

		 }

		return $slug;

}

function get_client_ip() {

    $ipaddress = '';

    if (getenv('HTTP_CLIENT_IP'))

        $ipaddress = getenv('HTTP_CLIENT_IP');

    else if(getenv('HTTP_X_FORWARDED_FOR'))

        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');

    else if(getenv('HTTP_X_FORWARDED'))

        $ipaddress = getenv('HTTP_X_FORWARDED');

    else if(getenv('HTTP_FORWARDED_FOR'))

        $ipaddress = getenv('HTTP_FORWARDED_FOR');

    else if(getenv('HTTP_FORWARDED'))

       $ipaddress = getenv('HTTP_FORWARDED');

    else if(getenv('REMOTE_ADDR'))

        $ipaddress = getenv('REMOTE_ADDR');

    else

        $ipaddress = 'UNKNOWN';

    return $ipaddress;

}

function detect_browser()

{

// Copyright 2013.1.5 Mehdi Jazini mr.jazini@gmail.com

$ExactBrowserNameUA=$_SERVER['HTTP_USER_AGENT'];

If (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "opr/")) {

    // OPERA

    $ExactBrowserNameBR="Opera";

} else if (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "chrome/")) {

    // CHROME

    $ExactBrowserNameBR="Chrome";

} else if (strpos(strtolower($ExactBrowserNameUA), "msie")) {

    // INTERNET EXPLORER

    $ExactBrowserNameBR="Internet Explorer";

} else if (strpos(strtolower($ExactBrowserNameUA), "firefox/")) {

    // FIREFOX

    $ExactBrowserNameBR="Firefox";

} else if (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "opr/")==false and strpos(strtolower($ExactBrowserNameUA), "chrome/")==false) {

    // SAFARI

    $ExactBrowserNameBR="Safari";

} else {

    // OUT OF DATA

    $ExactBrowserNameBR="OUT OF DATA";

};

return $ExactBrowserNameBR;

}



function get_sms_balance()
{

		$curl = curl_init();

curl_setopt_array($curl, array(

  CURLOPT_URL => "https://control.msg91.com/api/balance.php?authkey=368534AnUMuT68h4J6167e05cP1&type=4",

  CURLOPT_RETURNTRANSFER => true,

  CURLOPT_ENCODING => "",

  CURLOPT_MAXREDIRS => 10,

  CURLOPT_TIMEOUT => 30,

  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

  CURLOPT_CUSTOMREQUEST => "GET",

  CURLOPT_SSL_VERIFYHOST => 0,

  CURLOPT_SSL_VERIFYPEER => 0,

));

$response = curl_exec($curl);

$err = curl_error($curl);

curl_close($curl);

if ($err) {

} else {

}

	return $response;

}




function send_email_data($mail_data)
{
	
	
			$obj_model_tabel = $this->app->load_model("generel_settings");
			$rs_data = $obj_model_tabel->execute("SELECT", false, "", "");
			
			
			$template_name=$mail_data['template_name'];
			
			if($template_name=='contact_admin.html')
			{
			
				$email=$rs_data[0]['to_emails'];
				$cc_emails=$rs_data[0]['cc_emails'];				
				$e_data=explode(',',$cc_emails);	
			
			}
			else if($template_name=='career_admin.html')
			{
			
				$email=$rs_data[0]['career_to_emails'];
				$cc_emails=$rs_data[0]['career_cc_emails'];				
				$e_data=explode(',',$cc_emails);	
				
				
				
				
			
			}
			else if($template_name=='project_admin.html')
			{
			
				$email=$rs_data[0]['project_to_emails'];
				$cc_emails=$rs_data[0]['project_cc_emails'];				
				$e_data=explode(',',$cc_emails);	
			
			}
			
			
			
			
			
			/*$email="thedezineuser@gmail.com";
			$cc_emails='';
			$e_data='';*/
		
				
			
			$subject=$mail_data['subject'];
			$body_parameters=$mail_data['body_parameters'];
		
			  $obj_mailer = $this->app->load_module("mailer\sender");
			  $mail_body = $this->ParseMailTemplate($template_name, $body_parameters);
			  
			  if($mail_body==NULL)
			  {
				  $this->app->display_error(NULL, "Could not parse the mail template");
			  }
			  
			  $obj_mailer->create();
			  $obj_mailer->subject($subject);
			  if($mail_data['file_name']!='')
			   {
				   
				  
				   
				   $obj_mailer->attatch($mail_data['filepath'],$mail_data['file_name']);
                        

				   
				}
			  $obj_mailer->add_to(trim($email));
			  if(count($e_data)>1)
			  {
					for($i=0;$i<count($e_data);$i++)
					{
						 $obj_mailer->add_cc(trim($e_data[$i]));
						
					}  
			   }
			   
			   
			   
			   
			   
			  
			  
			  
			  $obj_mailer->htmlbody($mail_body);	
			  $flag = $obj_mailer->send();
			  
			  
			 
			 
			 
			  
			
			
			
		
		return $flag;	
		
}

//New Function 
function send_sms_new($mb,$sms_type,$default_string,$new_string)
{
	
	
	$obj_model_tabel = $this->app->load_model("sms_data");
	$rs_data = $obj_model_tabel->execute("SELECT", false, "", "name='".$sms_type."' and status='Active'");
	if(count($rs_data)>0)
	{
		$template_id=$rs_data[0]['template_id'];
		$language=$rs_data[0]['language'];
		$sms_text=$rs_data[0]['sms_text'];
		$sms_text_system=$rs_data[0]['sms_text_system'];
		
		$message_text=str_replace($default_string, $new_string, $sms_text);
		
		if($mb!='9510069163' && $mb!='1234567890')
		{
			//Your authentication key
			$authKey = '';
			//Multiple mobiles numbers separated by comma
			$mobileNumber='91'.$mb;
			//Sender ID,While using route4 sender id should be 6 characters long.
			$senderId ='';//
			
			//Your message to send, Add URL encoding here.
			$message = urlencode($message_text);
			//Define route
			$route = "4";
			$postData = array(
				'authkey' => $authKey,
				'mobiles' => $mobileNumber,
				'message' => $message,
				'sender' => $senderId,
				'route' => $route,
				'country' => 91,
				'DLT_TE_ID' =>$template_id
			);
			$url="https://control.msg91.com/api/sendhttp.php";
			$ch = curl_init();
			curl_setopt_array($ch, array(	
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => $postData
			));
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			$output = curl_exec($ch);
			if(curl_errno($ch))
			{
				echo 'error:' . curl_error($ch);
			}
			curl_close($ch);
			
			
			
			
		}
		
		
		
	
		$total_phone=count(explode(',',$mb));
		$update_field=array();
		$update_field['phones'] = $mb;
		$update_field['sms_count'] = $total_phone;
		$update_field['sms_text'] = $message_text;
		$update_field['sms_msg_id'] = $output;
		$update_field['sms_status'] = $sms_status;
		$update_field['entry_date'] = date('d-m-Y');
		$update_field['entry_date_time'] = date('d-m-Y H:i:s');
		$obj_model_sms_history = $this->app->load_model("sms_history");
		$obj_model_sms_history->map_fields($update_field);
		$obj_model_sms_history->execute("INSERT");
		
		
		
	}
}


function generate_OTP($length)

{

	$chars = '1234567890';

	$chars_length = (strlen($chars) - 1);

	$string = $chars{rand(0, $chars_length)};

	for ($i = 1; $i < $length; $i = strlen($string))

    {

       $r = $chars{rand(0, $chars_length)};

       if ($r != $string{$i - 1}) $string .= $r;

    }

	return $string;
}



function get_used_area($area)

{

	$obj_model_user=$this->app->load_model("user");

	$rs_user=$obj_model_user->execute("SELECT",false,"","area_name='".$area."'");

	if(count($rs_user)>0)

	{

		$tag='Used';

	}

	else

	{

		$tag='';

	}

	return $tag;

}

function get_used_zone($id)

{

	$obj_model_user=$this->app->load_model("area");

	$rs_user=$obj_model_user->execute("SELECT",false,"","zone_id='".$id."'");

	if(count($rs_user)>0)

	{

		$tag='Used';

	}

	else

	{

		$tag='';

	}

	return $tag;

}

function sum_extra_price($order_id)

{

	$obj_model_order_detail=$this->app->load_model("order_detail");

	$rs_order_detail=$obj_model_order_detail->execute("SELECT",false,"SELECT SUM(extra_price) FROM `order_detail` WHERE order_master_id=".$order_id."","");

	return $rs_order_detail['extra_price'];

}

function get_extracharge($order_master_id)

{

	$obj_model_order_detail=$this->app->load_model("order_detail");

	$rs_od=$obj_model_order_detail->execute("SELECT",false,"SELECT SUM(extra_price) as extra_charge FROM order_detail WHERE order_master_id=".$order_master_id."","");

	return $rs_od[0]['extra_charge'];

}

function operator_orders($op_id)

{

	$obj_model_orders=$this->app->load_model("order_master");

	$rs_od=$obj_model_orders->execute("SELECT",false,"","op_id=".$op_id."");

	return count($rs_od);

}

function wallet_balance($us_id)

{

	//echo 'mehul'.$us_id; exit;

	$obj_model_user=$this->app->load_model("user");

	$rs_ud=$obj_model_user->execute("SELECT",false,"","id=".$us_id."");

	return $rs_ud[0]['wallet'];

}

function user_name($us_id)

{

	//echo 'mehul'.$us_id; exit;

	$obj_model_user=$this->app->load_model("user");

	$rs_ud=$obj_model_user->execute("SELECT",false,"","id=".$us_id."");

	return $rs_ud[0]['name'];

}

function ticket_category_name($id)

{

	//echo 'mehul'.$us_id; exit;

	$obj_model_table=$this->app->load_model("ticket_category");

	$rs_ud=$obj_model_table->execute("SELECT",false,"","id=".$id."");

	return $rs_ud[0]['name'];

}

function total_calls($us_id)

{

	//echo 'mehul'.$us_id; exit;

	$obj_model_calls=$this->app->load_model("calls");

	$rs=$obj_model_calls->execute("SELECT",false,"","crmuser_id=".$us_id."");

	return count($rs);

}

function total_orders($us_id)

{

	//echo 'mehul'.$us_id; exit;

	$obj_model_order_master=$this->app->load_model("order_master");

	$rs=$obj_model_order_master->execute("SELECT",false,"","op_id=".$us_id."");

	return count($rs);

}

function get_crm_membername($id)

{

	//echo 'mehul'.$us_id; exit;

	$obj_model_user=$this->app->load_model("crm_user");

	$rs_ud=$obj_model_user->execute("SELECT",false,"","id=".$id."");

	return $rs_ud[0]['name'];

}

function getpcmrpauto2($product_id)

{

$obj_model_product_price = $this->app->load_model("product_price");

$rs_price = $obj_model_product_price->execute("SELECT", false, "", "product_id=".$product_id."","price DESC");

$mrp=$rs_price[0]['mrp'];

$price=$rs_price[0]['price'];

if($mrp==0 || $mrp<=$price)

{

$mrp1=0;

}

else

{

	$mrp1=$mrp;

}

//$unit_price=intval($rs_price[0]['mrp']);

return $mrp1;

}

function total_group_user($user_id)

{

	$a=explode(',',$user_id);

	$g_name='';

	for($i=0;$i<count($a);$i++)

				{

	$obj_model_table = $this->app->load_model("user_group");

	$rs_table = $obj_model_table->execute("SELECT", false, "", "id='".$a[$i]."'");

	if($i==(count($a)-1))

	{

		$g_name.=$rs_table[0]['name'];

	}

	else

	{

	$g_name.=$rs_table[0]['name'].', ';

	}

				}

return $g_name;

}

function getkgmrp1($product_id)

{

$obj_model_product_price = $this->app->load_model("product_price");

$rs_price = $obj_model_product_price->execute("SELECT", false, "", "product_id=".$product_id." and weight=1000");

if(count($rs_price)>0)

{

	$unit_mrp=intval($rs_price[0]['mrp']);

	$unit_price=intval($rs_price[0]['price']);

}

else

{

	//$rs_min_price = $obj_model_product_price->execute("SELECT", false, "SELECT MIN(mrp) as min_price FROM product_price WHERE product_id=".$product_id."", "product_id=".$product_id."","price desc");

	$rs_min_price = $obj_model_product_price->execute("SELECT", false, "","product_id=".$product_id."","price ASC");

	$unit_mrp=intval($rs_min_price[0]['mrp']);

	$unit_price=intval($rs_min_price[0]['price']);

}

if($unit_mrp==0 || $unit_mrp<=$unit_price)

{

$mrp1=0;

}

else

{

	$mrp1=$unit_mrp;

}

//$unit_price=intval($rs_price[0]['mrp']);

return $mrp1;

return $unit_mrp;

}

function get_user_tokens()

{

	$obj_model_cust = $this->app->load_model("user");

	$rs_gcm=$obj_model_cust->execute("SELECT", false, "", "Token!=''","","Token");

	$registation_ids = array();

	for($i=0; $i<count($rs_gcm); $i++)

    {

		array_push($registation_ids, $rs_gcm[$i]['Token']);

    }

	return $registation_ids;

}

function add_push_notification_gcm($data,$from)

{

	// Android App

	$obj_model_table=$this->app->load_model("generel_settings");

	$rs_data=$obj_model_table->execute("SELECT",false,"","");

	$google_key=$rs_data[0]['google_key'];

	$obj_model_cust = $this->app->load_model("user");

	$rs_gcm=$obj_model_cust->execute("SELECT", false, "", "AndroidToken!=''","","AndroidToken");

	$count=count($rs_gcm);

	//echo $count; exit;

	$total_rep=$count/1000 ;

	$a=0;

	$total_rep=(int)$total_rep+1;

	for($i=0;$i<$total_rep;$i++)

	{

		 $obj_model_user=$this->app->load_model("user");

		 $rs_user = $obj_model_user->execute("SELECT",false,"","AndroidToken!=''","id ASC limit ".$a.",1000");

		 $to='';

		 if(count($rs_user)>0)

		 {

			 $to = array();

			 foreach($rs_user as $item)

			 {

				array_push($to, $item['AndroidToken']);

			 }

		 }

		$path_to_firebase_cm = 'https://fcm.googleapis.com/fcm/send';

		$fields = array(

           'registration_ids' => $to,

			 'data' => $data

        );

		if (!defined('SERVER_KEY'))

		{

			define("SERVER_KEY", $google_key);

		}

        $headers = array(

            'Authorization:key=' . SERVER_KEY,

            'Content-Type:application/json'

        );

		$ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $path_to_firebase_cm);

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		
		     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		 
		 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);

   		curl_close($ch);

		 $a=$a+1000;

	}
	
		
	
	// For Iphone
	
	$obj_model_cust_iphone = $this->app->load_model("user");
	$rs_iphone_data=$obj_model_cust_iphone->execute("SELECT", false, "", "IphoneToken!=''","","IphoneToken");
	
	if(count($rs_iphone_data)>0)
	{
		
			for($i=0;$i<count($rs_iphone_data);$i++)
			{
				$deviceToken =  $rs_iphone_data[$i]['IphoneToken'];
				//$message = 'A push notification has been sent!';
				$ctx = stream_context_create();
				// ck.pem is your certificate file
				stream_context_set_option($ctx, 'ssl', 'local_cert', 'pushcert.pem');
				stream_context_set_option($ctx, 'ssl', 'passphrase', '');
				
				// Open a connection to the APNS server
				$fp = stream_socket_client(
					'ssl://gateway.push.apple.com:2195', $err,
					//'ssl://gateway.push.apple.com:2195', $err,
					$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
				if (!$fp)
					exit("Failed to connect: $err $errstr" . PHP_EOL);
					
				
				$body['aps'] = array(
				'alert' => $data['message'],
				'typedata' => array(
					'body' =>'Notification',
					'values' =>$data,
					
				),
				'badge' => '',
				'sound' => 'oven.caf'
				
				);
				
				$payload = json_encode($body);		
				
				$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
				$result = fwrite($fp, $msg, strlen($msg));
						
				fclose($fp);
		
				
				
			}
			
	
	
	}
	
	
	
	
	return '';

}

function add_push_notification_delivery_boy($data,$delivery_token)

{

		// Android App

		//$google_key='AIzaSyDhmfs22guuubC5L8F9LfQp-uUMf0CnQAA';

		$obj_model_table=$this->app->load_model("generel_settings");

		$rs_data=$obj_model_table->execute("SELECT",false,"","");

		$google_key=$rs_data[0]['google_key'];

		$to = array();

		array_push($to, $delivery_token);

		$path_to_firebase_cm = 'https://fcm.googleapis.com/fcm/send';

		$fields = array(

           'registration_ids' => $to,

		   'data' => $data

        );

		if (!defined('SERVER_KEY'))

		{

			define("SERVER_KEY", $google_key);

		}

        $headers = array(

            'Authorization:key=' . SERVER_KEY,

            'Content-Type:application/json'

        );

		$ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $path_to_firebase_cm);

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

   		curl_close($ch);

		return '';

}

// Order Delivered Notification

function add_push_notification_order_delivered($data,$delivery_token)

{

		// Android App

		//$google_key='AIzaSyDhmfs22guuubC5L8F9LfQp-uUMf0CnQAA';

		$obj_model_table=$this->app->load_model("generel_settings");

		$rs_data=$obj_model_table->execute("SELECT",false,"","");

		$google_key=$rs_data[0]['google_key'];

		$to = array();

		array_push($to, $delivery_token);

		$path_to_firebase_cm = 'https://fcm.googleapis.com/fcm/send';

		$fields = array(

           'registration_ids' => $to,

		   'data' => $data

        );

		if (!defined('SERVER_KEY'))

		{

			define("SERVER_KEY", $google_key);

		}

        $headers = array(

            'Authorization:key=' . SERVER_KEY,

            'Content-Type:application/json'

        );

		$ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $path_to_firebase_cm);

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);

   		curl_close($ch);

		//print_r($result); exit;

		return '';

}

//ss

//for api

 function indent($json) {

    $result      = '';

    $pos         = 0;

    $strLen      = strlen($json);

    $indentStr   = '  ';

    $newLine     = "\n";

    $prevChar    = '';

    $outOfQuotes = true;

    for ($i=0; $i<=$strLen; $i++) {

        // Grab the next character in the string.

        $char = substr($json, $i, 1);

        // Are we inside a quoted string?

        if ($char == '"' && $prevChar != '\\') {

            $outOfQuotes = !$outOfQuotes;

        // If this character is the end of an element,

        // output a new line and indent the next line.

        } else if(($char == '}' || $char == ']') && $outOfQuotes) {

            $result .= $newLine;

            $pos --;

            for ($j=0; $j<$pos; $j++) {

                $result .= $indentStr;

            }

        }

        // Add the character to the result string.

        $result .= $char;

        // If the last character was the beginning of an element,

        // output a new line and indent the next line.

        if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes)

		{

            $result .= $newLine;

				if ($char == '{' || $char == '[') {

					$pos ++;

				}

				for ($j = 0; $j < $pos; $j++) {

					$result .= $indentStr;

				}

        }

        $prevChar = $char;

    }

    return $result;

}

function encrypt( $data)

{

return base64_encode($data);

}

function decrypt($data)

{

  $value= base64_decode($data);

  return $value;

}




function check_user_cart($user_id)
	{
		$obj_model_tmp_k = $this->app->load_model("tmp_cart");
		$rskart = $obj_model_tmp_k->execute("SELECT",false,"SELECT COUNT(id) AS total_items, SUM(total_price) AS cart_total FROM tmp_cart WHERE user_id='".$user_id."'");
		$cart_total=$rskart[0]["cart_total"];
		$total_items=$rskart[0]["total_items"];
		if($cart_total==NULL)
		{
			$cart_total=0;
		}
		if($total_items==NULL)
		{
			$total_items=0;
		}
		$data=array();
		$data['cart_amount']=$cart_total;
		$data['cart_items']=$total_items;
		return $data;
	}
	
	
	
	
	function check_product_whishlist($product_id,$user_id)
	{
		$data='No';
		if($user_id>0 && $user_id!='')
		{
			$obj_model_check= $this->app->load_model("user_whishlist");
			$rs_data = $obj_model_check->execute("SELECT",false,"","user_id='".$user_id."' and product_id='".$product_id."'");
			if(count($rs_data)>0)
			{
				$data='Yes';
			}
		}
		return $data;
	}
	
	
	


function check_user_whislist($user_id)
	{
		$obj_model_tmp_k = $this->app->load_model("user_whishlist");
		$rskart = $obj_model_tmp_k->execute("SELECT",false,"SELECT COUNT(id) AS total_items FROM user_whishlist WHERE user_id='".$user_id."'");
		$total_items=$rskart[0]["total_items"];
		if($total_items==NULL)
		{
			$total_items=0;
		}
		$data=array();
		$data['whish_items']=$total_items;
		return $data;
	}



function check_product_in_cart($price_id,$user_id)
{
	
	if($user_id>0 && $user_id!='')
	{
		$obj_model_table=$this->app->load_model("tmp_cart");
		$rs_data=$obj_model_table->execute("SELECT",false,"","user_id='".$user_id."' and product_price_id='".$price_id."'","id DESC Limit 0,1");
		
		$data=(string)$rs_data[0]['quantity'];
	}
	else
	{
		$data="0";
	}
	
	return $data;
}


//function for app to get price of product
function get_app_price_data($p_id,$p_option_final,$user_id)
{
	if($p_option_final=='in_pcs')
	{
		$p_option='Pcs';
		$obj_model_table=$this->app->load_model("product_price");
		$rs_data=$obj_model_table->execute("SELECT",false,"","product_id=".$p_id."","weight ASC");
		if(count($rs_data)>0)
			{
				$i=1;
				foreach($rs_data as $item)
				{
					$price_id=$item['id'];
					$price=$item['price'];
					$mrp=$item['mrp'];
					$weight=(int)$item['weight'];
					if($mrp>$price)
					{
						$dis=(($mrp-$price)*100)/$mrp;
						if($dis==0)
						{
							$dis='';
						} 
						
					}
					else
					{
						$dis='';
						$mrp='';
					}
					$P_ID=$this->encrypt($price_id);
					
					$cart_qty=$this->check_product_in_cart($price_id,$user_id);
					
					$max_qty=(int)$item['max_quantity'];
					
					if($max_qty==0)
					{
						
						$max_qty=1000;
						
						
					}
					
					if($dis>0)
					{
						
						$dis=(int)$dis;
					}
					
					$price_list[]=array("sr"=>(string)$i,"price_ID"=>$P_ID,"price"=>$price,"mrp"=>$mrp,"weight"=>$weight.' '.$p_option,"dis"=>(string)$dis,"cart_qty"=>$cart_qty,"max_qty"=>(string)(int)$max_qty);
					$i++;
				}
			}
			else
			{
					$price_list[]=array("sr"=>"","price_ID"=>"","price"=>"","mrp"=>"","weight"=>"","dis"=>"","cart_qty"=>"","max_qty"=>"");
			}
	}
	else if($p_option_final=='in_pkt')
	{
		$p_option='Pkt';
		$obj_model_table=$this->app->load_model("product_price");
		$rs_data=$obj_model_table->execute("SELECT",false,"","product_id=".$p_id."","weight ASC");
		if(count($rs_data)>0)
			{
				$i=1;
				foreach($rs_data as $item)
				{
					$price_id=$item['id'];
					$price=$item['price'];
					$mrp=$item['mrp'];
					$weight=(int)$item['weight'];
					if($mrp>$price)
					{
						$dis=(($mrp-$price)*100)/$mrp;
						if($dis==0)
						{
							$dis='';
						} 
						
					}
					else
					{
						$dis='';
						$mrp='';
					}
					$P_ID=$this->encrypt($price_id);
					
					$cart_qty=$this->check_product_in_cart($price_id,$user_id);
					
					$max_qty=(int)$item['max_quantity'];
					
					if($max_qty==0)
					{
						
						$max_qty=1000;
						
						
					}
					
					if($dis>0)
					{
						
						$dis=(int)$dis;
					}
					
					$price_list[]=array("sr"=>(string)$i,"price_ID"=>$P_ID,"price"=>$price,"mrp"=>$mrp,"weight"=>$weight.' '.$p_option,"dis"=>(string)$dis,"cart_qty"=>$cart_qty,"max_qty"=>(string)(int)$max_qty);
					$i++;
				}
			}
			else
			{
					$price_list[]=array("sr"=>"","price_ID"=>"","price"=>"","mrp"=>"","weight"=>"","dis"=>"","cart_qty"=>"","max_qty"=>"");
			}
	}
	else if($p_option_final=='in_gm')
	{
		$p_option='gm';
		$obj_model_table=$this->app->load_model("product_price");
		$rs_data=$obj_model_table->execute("SELECT",false,"","product_id=".$p_id."","weight ASC");
		if(count($rs_data)>0)
		{
			$i=1;
					foreach($rs_data as $item)
					{
						$price_id=$item['id'];
						$price=$item['price'];
						$mrp=$item['mrp'];
						$weight=(int)$item['weight'];
						$final_weight=$this->change_weight_display_2018($weight,$p_option_final);
						if($mrp>$price)
						{
							$dis=(($mrp-$price)*100)/$mrp;
							
							if($dis==0)
							{
								$dis='';
							} 
						}
						else
						{
							$dis='';
							$mrp='';
						}
						$P_ID=$this->encrypt($price_id);
						
						$cart_qty=$this->check_product_in_cart($price_id,$user_id);
						
						$max_qty=(int)$item['max_quantity'];
					
					if($max_qty==0)
					{
						
						$max_qty=1000;
						
						
					}
					
					if($dis>0)
					{
						
						$dis=(int)$dis;
					}
						
						$price_list[]=array("sr"=>(string)$i,"price_ID"=>$P_ID,"price"=>$price,"mrp"=>$mrp,"weight"=>$final_weight,"dis"=>(string)$dis,"cart_qty"=>$cart_qty,"max_qty"=>(string)(int)$max_qty);
						$i++;
					}
			}
			else
			{
				$price_list[]=array("sr"=>"","price_ID"=>"","price"=>"","mrp"=>"","weight"=>"","dis"=>"","cart_qty"=>"","max_qty"=>"");
			}
	}
	
	else if($p_option_final=='in_ltr')
	{
		$p_option='ml';
		$obj_model_table=$this->app->load_model("product_price");
		$rs_data=$obj_model_table->execute("SELECT",false,"","product_id=".$p_id."","weight ASC");
		if(count($rs_data)>0)
		{
			$i=1;
					foreach($rs_data as $item)
					{
						$price_id=$item['id'];
						$price=$item['price'];
						$mrp=$item['mrp'];
						$weight=(int)$item['weight'];
						$final_weight=$this->change_weight_display_2018($weight,$p_option_final);
						if($mrp>$price)
						{
							$dis=(($mrp-$price)*100)/$mrp;
							
							if($dis==0)
							{
								$dis='';
							} 
						}
						else
						{
							$dis='';
							$mrp='';
						}
						$P_ID=$this->encrypt($price_id);
						$cart_qty=$this->check_product_in_cart($price_id,$user_id);
						
						
						$max_qty=(int)$item['max_quantity'];
					
					if($max_qty==0)
					{
						
						$max_qty=1000;
						
						
					}
					
					if($dis>0)
					{
						
						$dis=(int)$dis;
					}
						
						
						$price_list[]=array("sr"=>(string)$i,"price_ID"=>$P_ID,"price"=>$price,"mrp"=>$mrp,"weight"=>$final_weight,"dis"=>(string)$dis,"cart_qty"=>$cart_qty,"max_qty"=>(string)(int)$max_qty);
						$i++;
					}
			}

			else
			{
				
				
				
				$price_list[]=array("sr"=>"","price_ID"=>"","price"=>"","mrp"=>"","weight"=>"","dis"=>"","cart_qty"=>"","max_qty"=>'');
				
				
				
				
				
				
				
			}
	}
	return $price_list;
}




function get_app_price_data_old($p_id,$p_option_final)

{
	

	if($p_option_final=='in_pcs')

	{

		$p_option='Pcs';

		$obj_model_table=$this->app->load_model("product_price");

		$rs_data=$obj_model_table->execute("SELECT",false,"","product_id=".$p_id."","weight ASC");

		if(count($rs_data)>0)

			{

				$i=1;

				foreach($rs_data as $item)

				{

					$price_id=$item['id'];

					$price=$item['price'];

					$mrp=$item['mrp'];

					$weight=(int)$item['weight'];

					$max_qty=(int)$item['max_quantity'];
					
					if($max_qty==0)
					{
						
						$max_qty=1000;
						
						
					}

					if($mrp>$price)

					{

						$dis=(($mrp-$price)*100)/$mrp;

					}

					else

					{

						$dis=0;

					}

					$P_ID=$this->encrypt($price_id);

					$price_list[]=array("sr"=>(string)$i,"price_ID"=>$P_ID,"price"=>$price,"mrp"=>$mrp,"weight"=>$weight.' '.$p_option,"dis"=>(string)(int)$dis,"max_qty"=>(string)(int)$max_qty);

					$i++;

				}

			}

			else

			{

					$i=1;

					$price_id='0';

					$price='0';

					$mrp='0';

					$weight='0';

					$max_qty=0;

					if($mrp>$price)

					{

						$dis=(($mrp-$price)*100)/$mrp;

					}

					else

					{

						$dis=0;

					}

					$P_ID=$this->encrypt($price_id);

					$price_list[]=array("sr"=>(string)$i,"price_ID"=>$P_ID,"price"=>$price,"mrp"=>$mrp,"weight"=>$weight,"dis"=>(string)(int)$dis,"max_qty"=>(string)(int)$max_qty);
					
					
					

			}

	}

	

	else if($p_option_final=='in_pkt')

	{

		$p_option='Pkt';

		$obj_model_table=$this->app->load_model("product_price");

		$rs_data=$obj_model_table->execute("SELECT",false,"","product_id=".$p_id."","weight ASC");

		if(count($rs_data)>0)

			{

				$i=1;

				foreach($rs_data as $item)

				{

					$price_id=$item['id'];

					$price=$item['price'];

					$mrp=$item['mrp'];

					$weight=(int)$item['weight'];

					$max_qty=(int)$item['max_quantity'];
					
					if($max_qty==0)
					{
						
						$max_qty=1000;
						
						
					}

					if($mrp>$price)

					{

						$dis=(($mrp-$price)*100)/$mrp;

					}

					else

					{

						$dis=0;

					}

					$P_ID=$this->encrypt($price_id);

					$price_list[]=array("sr"=>(string)$i,"price_ID"=>$P_ID,"price"=>$price,"mrp"=>$mrp,"weight"=>$weight.' '.$p_option,"dis"=>(string)(int)$dis,"max_qty"=>(string)(int)$max_qty);

					$i++;

				}

			}

			else

			{

					$i=1;

					$price_id='0';

					$price='0';

					$mrp='0';

					$weight='0';

					$max_qty=0;

					if($mrp>$price)

					{

						$dis=(($mrp-$price)*100)/$mrp;

					}

					else

					{

						$dis=0;

					}

								$P_ID=$this->encrypt($price_id);

					$price_list[]=array("sr"=>(string)$i,"price_ID"=>$P_ID,"price"=>$price,"mrp"=>$mrp,"weight"=>$weight,"dis"=>(string)(int)$dis,"max_qty"=>(string)(int)$max_qty);
					
					

			}

	}

	else if($p_option_final=='in_gm')

	{

		$p_option='gm';

		$obj_model_table=$this->app->load_model("product_price");

		$rs_data=$obj_model_table->execute("SELECT",false,"","product_id=".$p_id."","weight ASC");

		if(count($rs_data)>0)

		{

			$i=1;

					foreach($rs_data as $item)

					{

						$price_id=$item['id'];

						$price=$item['price'];

						$mrp=$item['mrp'];

						$weight=(int)$item['weight'];

						$max_qty=(int)$item['max_quantity'];
						
						if($max_qty==0)
						{
							
							$max_qty=1000;
							
							
						}

						$final_weight=$this->change_weight_display_2018($weight,$p_option_final);

						if($mrp>$price)

						{

							$dis=(($mrp-$price)*100)/$mrp;

						}

						else

						{

							$dis=0;

						}

						$P_ID=$this->encrypt($price_id);

						$price_list[]=array("sr"=>(string)$i,"price_ID"=>$P_ID,"price"=>$price,"mrp"=>$mrp,"weight"=>$final_weight,"dis"=>(string)(int)$dis,"max_qty"=>(string)(int)$max_qty);

						$i++;

					}

			}

			else

			{

				$i=1;

				$price_id='0';

					$price='0';

					$mrp='0';

					$weight='0';

					$max_qty=0;

					if($mrp>$price)

					{

						$dis=(($mrp-$price)*100)/$mrp;

					}

					else

					{

						$dis=0;

					}

				$P_ID=$this->encrypt($price_id);

				$price_list[]=array("sr"=>(string)$i,"price_ID"=>$P_ID,"price"=>$price,"mrp"=>$mrp,"weight"=>$weight,"dis"=>(string)(int)$dis,"max_qty"=>(string)(int)$max_qty);
				

			}

	}

	else if($p_option_final=='in_ltr')

	{

		$p_option='ml';

		$obj_model_table=$this->app->load_model("product_price");

		$rs_data=$obj_model_table->execute("SELECT",false,"","product_id=".$p_id."","weight ASC");

		if(count($rs_data)>0)

		{

			$i=1;

					foreach($rs_data as $item)

					{

						$price_id=$item['id'];

						$price=$item['price'];

						$mrp=$item['mrp'];

						$weight=(int)$item['weight'];

						$max_qty=(int)$item['max_quantity'];
						
						if($max_qty==0)
					{
						
						$max_qty=1000;
						
						
					}

						$final_weight=$this->change_weight_display_2018($weight,$p_option_final);

						if($mrp>$price)

						{

							$dis=(($mrp-$price)*100)/$mrp;

						}

						else

						{

							$dis=0;

						}

						$P_ID=$this->encrypt($price_id);

						$price_list[]=array("sr"=>(string)$i,"price_ID"=>$P_ID,"price"=>$price,"mrp"=>$mrp,"weight"=>$final_weight,"dis"=>(string)(int)$dis,"max_qty"=>(string)(int)$max_qty);

						$i++;

					}

			}

			else

			{

				$i=1;

				$price_id=0;

				$price='0';

				$mrp='0';

				$weight='0';

				$max_qty='0';

				
				

				if($mrp>$price)

				{

					$dis=(($mrp-$price)*100)/$mrp;

				}

				else

				{

					$dis=0;

				}

				$P_ID=$this->encrypt($price_id);

				$price_list[]=array("sr"=>(string)$i,"price_ID"=>$P_ID,"price"=>$price,"mrp"=>$mrp,"weight"=>$weight,"dis"=>(string)(int)$dis,"max_qty"=>(string)(int)$max_qty);

			}

	}

	return $price_list;

}



function get_app_price_single($p_id,$p_option)

{

	if($p_option=='in_pcs')

	{

		$p_option='Pcs';

		$obj_model_table=$this->app->load_model("product_price");

		$rs_data=$obj_model_table->execute("SELECT",false,"","product_id=".$p_id."","weight ASC");

		$price=$rs_data[0]['price'];

		$mrp=$rs_data[0]['mrp'];

		$weight=$rs_data[0]['weight'];

		$max_qty=$rs_data[0]['max_quantity'];

		if($mrp>$price)

		{

			$dis=(($mrp-$price)*100)/$mrp;

		}

		else

		{

			$dis=0;

		}

	}
	else if($p_option=='in_pkt')

	{

		$p_option='Pkt';

		$obj_model_table=$this->app->load_model("product_price");

		$rs_data=$obj_model_table->execute("SELECT",false,"","product_id=".$p_id."","weight ASC");

		$price=$rs_data[0]['price'];

		$mrp=$rs_data[0]['mrp'];

		$weight=$rs_data[0]['weight'];

		$max_qty=$rs_data[0]['max_quantity'];

		if($mrp>$price)

		{

			$dis=(($mrp-$price)*100)/$mrp;

		}

		else

		{

			$dis=0;

		}

	}

	else if($p_option=='in_ltr')

	{

		$p_option='ml';

		$obj_model_table=$this->app->load_model("product_price");

		$rs_data=$obj_model_table->execute("SELECT",false,"","product_id=".$p_id."","weight ASC");

		$price=$rs_data[0]['price'];

		$mrp=$rs_data[0]['mrp'];

		$weight=$rs_data[0]['weight'];

		$max_qty=$rs_data[0]['max_quantity'];

		if($mrp>$price)

		{

			$dis=(($mrp-$price)*100)/$mrp;

		}

		else

		{

			$dis=0;

		}

	}

	else

	{

		$p_option='gm';

		$obj_model_table=$this->app->load_model("product_price");

		$rs_data=$obj_model_table->execute("SELECT",false,"","product_id=".$p_id."","weight ASC");

		$price=$rs_data[0]['price'];

		$mrp=$rs_data[0]['mrp'];

		$weight=$rs_data[0]['weight'];

		$max_qty=$rs_data[0]['max_quantity'];

		if($mrp>$price)

		{

			$dis=(($mrp-$price)*100)/$mrp;

		}

		else

		{

			$dis=0;

		}

	}
	
	if($mrp==NULL)
	{
		$mrp='0';
		
	}
	
	if($price==NULL)
	{
		$price='0';
		
	}
	
	
	
	$f_discount=(int)$dis;
	
	if($f_discount<=0)
	{
		$f_discount='';
		
	}
	

	$data['mrp']=$mrp;

	$data['dis']=$f_discount;

	$data['price']=$price;

	$data['weight']=$weight;

	$data['p_option']=$p_option;

	$data['max_qty']=$max_qty;

	return $data;

}

//ss

function getpcmrp_update($product_id)

{

$obj_model_product_price = $this->app->load_model("product_price");

$rs_price = $obj_model_product_price->execute("SELECT", false, "", "product_id='".$product_id."'");

$unit_price=intval($rs_price[0]['mrp'])/$rs_price[0]['weight'];

return $unit_price;

}

function getHashes($txnid, $amount, $productinfo, $firstname, $email, $user_credentials, $udf1, $udf2, $udf3, $udf4, $udf5,$offerKey,$cardBin)

			{

			// $firstname, $email can be "", i.e empty string if needed. Same should be sent to PayU server (in request params) also.

			$key = '3lJHAf';//'gtKFFx';

			$salt = '90pSvbpa';//'eCwWELxi';

			$payhash_str = $key . '|' . $this->checkNull($txnid) . '|' .$this->checkNull($amount)  . '|' .$this->checkNull($productinfo)  . '|' . $this->checkNull($firstname) . '|' . $this->checkNull($email) . '|' . $this->checkNull($udf1) . '|' . $this->checkNull($udf2) . '|' . $this->checkNull($udf3) . '|' . $this->checkNull($udf4) . '|' . $this->checkNull($udf5) . '||||||' . $salt;

			$paymentHash = strtolower(hash('sha512', $payhash_str));

			$arr['payment_hash'] = $paymentHash;

			$cmnNameMerchantCodes = 'get_merchant_ibibo_codes';

			$merchantCodesHash_str = $key . '|' . $cmnNameMerchantCodes . '|default|' . $salt ;

			$merchantCodesHash = strtolower(hash('sha512', $merchantCodesHash_str));

			$arr['get_merchant_ibibo_codes_hash'] = $merchantCodesHash;

			$cmnMobileSdk = 'vas_for_mobile_sdk';

			$mobileSdk_str = $key . '|' . $cmnMobileSdk . '|default|' . $salt;

			$mobileSdk = strtolower(hash('sha512', $mobileSdk_str));

			$arr['vas_for_mobile_sdk_hash'] = $mobileSdk;

			$cmnPaymentRelatedDetailsForMobileSdk1 = 'payment_related_details_for_mobile_sdk';

			$detailsForMobileSdk_str1 = $key  . '|' . $cmnPaymentRelatedDetailsForMobileSdk1 . '|default|' . $salt ;

			$detailsForMobileSdk1 = strtolower(hash('sha512', $detailsForMobileSdk_str1));

			$arr['payment_related_details_for_mobile_sdk_hash'] = $detailsForMobileSdk1;

			//used for verifying payment(optional)

			$cmnVerifyPayment = 'verify_payment';

			$verifyPayment_str = $key . '|' . $cmnVerifyPayment . '|'.$txnid .'|' . $salt;

			$verifyPayment = strtolower(hash('sha512', $verifyPayment_str));

			$arr['verify_payment_hash'] = $verifyPayment;

			if($user_credentials != NULL && $user_credentials != '')

			{

				$cmnNameDeleteCard = 'delete_user_card';

				$deleteHash_str = $key  . '|' . $cmnNameDeleteCard . '|' . $user_credentials . '|' . $salt ;

				$deleteHash = strtolower(hash('sha512', $deleteHash_str));

				$arr['delete_user_card_hash'] = $deleteHash;

				$cmnNameGetUserCard = 'get_user_cards';

				$getUserCardHash_str = $key  . '|' . $cmnNameGetUserCard . '|' . $user_credentials . '|' . $salt ;

				$getUserCardHash = strtolower(hash('sha512', $getUserCardHash_str));

				$arr['get_user_cards_hash'] = $getUserCardHash;

				$cmnNameEditUserCard = 'edit_user_card';

				$editUserCardHash_str = $key  . '|' . $cmnNameEditUserCard . '|' . $user_credentials . '|' . $salt ;

				$editUserCardHash = strtolower(hash('sha512', $editUserCardHash_str));

				$arr['edit_user_card_hash'] = $editUserCardHash;

				$cmnNameSaveUserCard = 'save_user_card';

				$saveUserCardHash_str = $key  . '|' . $cmnNameSaveUserCard . '|' . $user_credentials . '|' . $salt ;

				$saveUserCardHash = strtolower(hash('sha512', $saveUserCardHash_str));

				$arr['save_user_card_hash'] = $saveUserCardHash;

				$cmnPaymentRelatedDetailsForMobileSdk = 'payment_related_details_for_mobile_sdk';

				$detailsForMobileSdk_str = $key  . '|' . $cmnPaymentRelatedDetailsForMobileSdk . '|' . $user_credentials . '|' . $salt ;

				$detailsForMobileSdk = strtolower(hash('sha512', $detailsForMobileSdk_str));

				$arr['payment_related_details_for_mobile_sdk_hash'] = $detailsForMobileSdk;

			}

			if ($offerKey!=NULL && !empty($offerKey)) {

				$cmnCheckOfferStatus = 'check_offer_status';

						$checkOfferStatus_str = $key  . '|' . $cmnCheckOfferStatus . '|' . $offerKey . '|' . $salt ;

						$checkOfferStatus = strtolower(hash('sha512', $checkOfferStatus_str));

				$arr['check_offer_status_hash']=$checkOfferStatus;

			}

			if ($cardBin!=NULL && !empty($cardBin)) {

				$cmnCheckIsDomestic = 'check_isDomestic';

						$checkIsDomestic_str = $key  . '|' . $cmnCheckIsDomestic . '|' . $cardBin . '|' . $salt ;

						$checkIsDomestic = strtolower(hash('sha512', $checkIsDomestic_str));

				$arr['check_isDomestic_hash']=$checkIsDomestic;

			}

			return array('result'=>$arr);

			}

			function checkNull($value) {

			if ($value == null) {

				return '';

			} else {

				return $value;

			}

}

function get_order_extraprice($oid)

{

		$extra_price=0;

		$obj_model_table=$this->app->load_model("order_detail");

		$rs_data=$obj_model_table->execute("SELECT",false,"","order_master_id=".$oid."");

		if(count($rs_data)>0)

		{

			for($i=0;$i<count($rs_data);$i++)

			{

				$extra_price=$extra_price+$rs_data[$i]['extra_price'];

			}

		}

		else

		{

			$extra_price=0;

		}

		return $extra_price;

}

	function web_mail_header()

	{

		$obj_model_table=$this->app->load_model("generel_settings");

		$rs_data=$obj_model_table->execute("SELECT",false,"","");

		$title=$rs_data[0]['project_title'];

		$website=$rs_data[0]['website'];

		$logo=$rs_data[0]['logo'];

		$logourl=SERVER_ROOT.'/uploads/project_image/'.$logo;

		$html='

<!DOCTYPE html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />

<style>

img {

	padding:0;

	margin:0 auto;

}

multiline

{

color: #777777;

}

</style>

</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<div style="padding-top:40px!important; padding-bottom:40px!important;margin:0!important;display:block!important;min-width:100%!important;width:100%!important;background:#e9e9e9">

<table width="600"  align="center" cellpadding="0" cellspacing="0" style="background-color:#fff;border:1px solid #e9e9e9;">

  <tbody>

    <tr>

      <td valign="middle" >

      <table width="100%" border="0"  cellspacing="0" cellpadding="0" align="center" >

          <tbody>

            <tr align="center" class="img">

              <td style="color: #777777; font-size: 14px; font-family: \'Open Sans\', Arial, sans-serif; line-height: 24px;padding:0px 0px 0px !important" >

			  <a href="'.$website.'" target="_blank"> <img src="'.$logourl.'" alt="'.$title.'" title="'.$title.'" class="img" width="100%" >

			  </a>

			  </td>

            </tr>

            <tr>

          ';

			  return $html;

	}

	function web_mail_footer()

	{

		$obj_model_table=$this->app->load_model("generel_settings");

		$rs_data=$obj_model_table->execute("SELECT",false,"","");

		$app_url=$rs_data[0]['app_url'];

		$app_url_iphone=$rs_data[0]['app_url_iphone'];

		$logourl=SERVER_ROOT.'/uploads/project_image/'.$logo;

		$contact_email=$rs_data[0]['contact_email'];

		$website=$rs_data[0]['website'];

		$facebook_link=$rs_data[0]['facebook_link'];

		$twitter_link=$rs_data[0]['twitter_link'];

		$youtube_link=$rs_data[0]['youtube_link'];

		$google_plus_link=$rs_data[0]['google_plus'];

		$html='

             </tr>

            <tr>

              <td style="border-top: 1px solid #00a859;

    padding-top: 10px;

    padding-bottom: 10px;

    background: #00a859;"><table align="center">

    <td width="" style="font-family: open sans,Arial,Helvetica,sans-serif;

    font-size: 16px;

    font-weight: 500;

    color: #fff;

    line-height: 16px;

    text-align: justify;

    letter-spacing: 0.019em;"> Download  Our App Now. &nbsp; &nbsp;  </td>

                    <td><a href="'.$app_url.'" target="_blank"> <img src="'.SERVER_ROOT.'/mail/app.png" /> </a>

					<a href="'.$app_url_iphone.'" target="_blank"> <img src="'.SERVER_ROOT.'/mail/app_iphone.png" /> </a>

					</td>

                </table></td>

            </tr>

            <tr style="display:block;white-space:nowrap;border-bottom:1px solid #e9e9e9;">

              <td style="display:inline-block; "><table width="100%" border="0" cellspacing="0" cellpadding="0">

                  <tbody>

                    <tr>

                      <td width="450"><div style="color:#979797;margin-top:10px; padding-bottom:10px; letter-spacing:0.016em;font-family:open sans,Arial,Helvetica,sans-serif;padding-left:10px">

                          <div style="font-size:14px;color:#979797;font-weight:500;font-family:open sans,Arial,Helvetica,sans-serif">Customer Service</div>

                          <span style="font-size:11px">Have questions? Feel free to write us at <br>

                          <a href="'.$website.'" style="color:#979797;text-decoration:none" target="_blank"> <strong>'.$contact_email.'</strong> </a> <br />

                          We love to hear from you.</span></div></td>

                      <td width="150" align="right"><div style="color:#979797;margin-top:0px; padding-bottom:10px; letter-spacing:0.016em;font-family:open sans,Arial,Helvetica,sans-serif;padding-right:10px;padding-left:10px">

                          <table width="150" border="0" cellspacing="0" cellpadding="0">

                            <tbody>

                              <tr>

                                <td align="right" height="30" valign="top" style="font-size:14px;color:#979797;font-family:open sans,Arial,Helvetica,sans-serif;letter-spacing:0.01em;font-weight:500"><p style="margin-top:10px;margin-bottom:10px">Stay Connected</p></td>

                              </tr>

                              <tr>

                                <td valign="bottom"><table width="150" border="0"  align="right"  style="text-align:right" cellspacing="0" cellpadding="0">

                                    <tbody>

                                      <tr>

										<td><a href="https://www.facebook.com/reekayafresh" target="_blank"><img src="'.SERVER_ROOT.'/mail/fa.png" alt="Facebook" title="Facebook" width="40" height="40" ></a></td>

                                        <td><a href="https://www.instagram.com/reekayafresh/" target="_blank"><img src="'.SERVER_ROOT.'/mail/instagram.png" alt="Instagram" title="Instagram" width="40" height="40" ></a></td>
										
										<td><div style="width:40px;height:40px"></div></td>

										

                                      </tr>

                                    </tbody>

                                  </table></td>

                              </tr>

                            </tbody>

                          </table>

                        </div></td>

                    </tr>

                  </tbody>

                </table></td>

            </tr>

          </tbody>

        </table></td>

    </tr>

  </tbody>

</table>

</div>

</body>

</html>

';

			  return $html;

	}

	function getkgprice_admin($product_id)

{

$obj_model_product_price = $this->app->load_model("product_price");

$rs_price = $obj_model_product_price->execute("SELECT", false, "", "product_id=".$product_id." and weight=1000");

if(count($rs_price)>0)

{

	$unit_price=intval($rs_price[0]['price']);

}

else

{

	$rs_min_price = $obj_model_product_price->execute("SELECT", false, "", "product_id=".$product_id."","weight ASC");

	$weight=$rs_min_price[0]['weight'];

	$price=$rs_min_price[0]['price'];

	$new_price=(1000*$price)/($weight);

	$unit_price=intval($new_price);

}

return $unit_price;

}

function getkgmrp_admin($product_id)

{

$obj_model_product_price = $this->app->load_model("product_price");

$rs_price = $obj_model_product_price->execute("SELECT", false, "", "product_id=".$product_id." and weight=1000");

if(count($rs_price)>0)

{

	$unit_price=intval($rs_price[0]['mrp']);

}

else

{

	$rs_min_price = $obj_model_product_price->execute("SELECT", false, "", "product_id=".$product_id."","weight ASC");

	$weight=$rs_min_price[0]['weight'];

	$price=$rs_min_price[0]['mrp'];

	$new_mrp=(1000*$price)/($weight);

	$unit_price=intval($new_mrp);

}

return $unit_price;

}

function check_orders($user_id,$coupon_id)

{

		$obj_model_table=$this->app->load_model("order_master");

		$rs_od=$obj_model_table->execute("SELECT",false,"","user_id='".$user_id."' and discount_coupon_id='".$coupon_id."'", "id ASC");

		if(count($rs_od)>0)

		{

			$status='Yes';

		}

		else

		{

			$status='No';

		}

		return $status;

}

function dis_html($coupon_id,$coupon_code)

{

		if($coupon_code!='' && $coupon_id>0)

		{

			$d_html='<br/><br/><span id="dis_data"><b>'.$coupon_code.'</b> Coupon Use.</span>';

		}

		else

		{

			$d_html='';

		}

		return $d_html;

}



function dis_html_detail($coupon_id,$coupon_code)

{

		if($coupon_code!='' && $coupon_id>0)

		{

			$d_html=' (<span id="dis_data"><b>'.$coupon_code.'</b> Coupon Use.</span>) ';

		}

		else

		{

			$d_html='';

		}

		return $d_html;

}

function express_html($express_charge)

{

		if($express_charge>0)

		{

			$html='<br/><span class="express">Express</span>';

		}

		else

		{

			$html='';

		}

		return $html;

}

function excel_cat_name($product_id)

	{

	$category=$this->app->load_model("category");

	$category->join_table("product_category","left", array("category_id"), array("id"=>"category_id"));

	$rs_category=$category->execute("SELECT",false,"","product_category.product_id=".$product_id."");

			$name='';

			for($i=0;$i<count($rs_category);$i++)

			{

				if($i==count($rs_category)-1)

				{

					$name.=$rs_category[$i]['category_name'];

				}

				else

				{

				$name.=$rs_category[$i]['category_name'].',';

				}

			}

			return $name;

		}

			function resize_multi_image_new($uploadedfile_name,$uploadedfile_tmpname,$image_user_config,$user_width1,$user_width2,$user_width3)

{

			$errors=0;

		//$image =$_FILES["file"]["name"];

			$uploadedfile = $uploadedfile_tmpname;

			$file_name = basename($uploadedfile_name);

    		$file_info = $this->get_file_info($file_name);

			if(strtoupper($file_info->extension)=="JPG" || strtoupper($file_info->extension)=="JPEG" || strtoupper($file_info->extension)=="GIF"  || strtoupper($file_info->extension)=="PNG"){

			$new_name =$file_name;

			//echo $new_name; exit;

					}

 			if ($new_name)

 			{

 			$filename = stripslashes($uploadedfile_name);

 	 		$i = strrpos($filename,".");

        	 if (!$i) { return ""; }

         	 $l = strlen($filename) - $i;

         	 $ext = substr($filename,$i+1,$l);

			$extension = $ext;

 			$extension = strtolower($extension);

 			if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))

 			{

 			$change='<div class="msgdiv">Unknown Image extension </div> ';

 			$errors=1;

 			}

 			else

 			{

 			$size=filesize($uploadedfile_tmpname);

			if($extension=="jpg" || $extension=="jpeg" )

			{

			$uploadedfile = $uploadedfile_tmpname;

			$src = imagecreatefromjpeg($uploadedfile);

			}

			else if($extension=="png")

			{

			$uploadedfile = $uploadedfile_tmpname;

			$src = imagecreatefrompng($uploadedfile);

			}

			else

			{

			$src = imagecreatefromgif($uploadedfile);

			}

			echo $scr;

			list($width,$height)=getimagesize($uploadedfile);

			if($width>$user_width1)

					{

					$newwidth=$user_width1;

					$newheight=($height/$width)*$newwidth;

					$tmp=imagecreatetruecolor($newwidth,$newheight);

					}

					else

					{

					$newwidth=$width;

					$newheight=($height/$width)*$newwidth;

					$tmp=imagecreatetruecolor($newwidth,$newheight);

					}

					if($width>$user_width2)

					{

					$newwidth1=$user_width2;

					$newheight1=($height/$width)*$newwidth1;

					$tmp1=imagecreatetruecolor($newwidth1,$newheight1);

					}

					else

					{

					$newwidth1=$width;

					$newheight1=($height/$width)*$newwidth1;

					$tmp1=imagecreatetruecolor($newwidth1,$newheight1);

					}

					if($width>$user_width3)

					{

					$newwidth2=$user_width3;

					$newheight2=($height/$width)*$newwidth2;

					$tmp2=imagecreatetruecolor($newwidth2,$newheight2);

					}

					else

					{

					$newwidth2=$width;

					$newheight2=($height/$width)*$newwidth2;

					$tmp2=imagecreatetruecolor($newwidth2,$newheight2);

					}

			imagecolortransparent($tmp, imagecolorallocatealpha($tmp, 0, 0, 0, 127));

    		imagealphablending($tmp, false);

    		imagesavealpha($tmp, true);

			imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

			imagecolortransparent($tmp1, imagecolorallocatealpha($tmp1, 0, 0, 0, 127));

    		imagealphablending($tmp1, false);

    		imagesavealpha($tmp1, true);

			imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);

			imagecolortransparent($tmp2, imagecolorallocatealpha($tmp2, 0, 0, 0, 127));

    		imagealphablending($tmp2, false);

    		imagesavealpha($tmp2, true);

			imagecopyresampled($tmp2,$src,0,0,0,0,$newwidth2,$newheight2,$width,$height);

			$filename = $image_user_config.$new_name;

			$filename1 = $image_user_config."mediumthumb".$new_name;

			$filename2 = $image_user_config."thumb".$new_name;

			if($extension=="jpg" || $extension=="jpeg" )

			{

			imagejpeg($tmp,$filename,100);

			imagejpeg($tmp1,$filename1,100);

			imagejpeg($tmp2,$filename2,100);

			}

			else if($extension=="png")

			{

			imagepng($tmp,$filename);

			imagepng($tmp1,$filename1);

			imagepng($tmp2,$filename2);

			}

			else

			{

			imagepng($tmp,$filename,100);

			imagepng($tmp1,$filename1,100);

			imagepng($tmp2,$filename2,100);

			}

			imagedestroy($src);

			imagedestroy($tmp);

			imagedestroy($tmp1);

			imagedestroy($tmp2);

}

}

return $new_name;

}

	function image_string()

{

	$rand_val = date('YMDHIS') . rand(11111, 99999);

    return  md5($rand_val);

}

function getproductprice_admin_2020($product_id)

{

	$obj_model_product_price = $this->app->load_model("product_price");

	$rs_price = $obj_model_product_price->execute("SELECT", false, "", "product_id=".$product_id."","weight ASC");

	$kg_price='';

	if(count($rs_price)>0)

	{

				for($i=0;$i<count($rs_price);$i++)

				{

					if($rs_price[$i]['weight']==1000)

					{

						$weight=$rs_price[$i]['weight'];

						// Price

						$price=$rs_price[$i]['price'];

						$new_price=(1000*$price)/($weight);

						$unit_price=intval($new_price);

						// MRP

						$mrp=$rs_price[$i]['mrp'];

						$new_mrp=(1000*$mrp)/($weight);

						$unit_mrp=intval($new_mrp);

						$kg_price='Yes';

					}

				}

				if($kg_price=='')

				{

					$weight=$rs_price[0]['weight'];

					// Price

					$price=$rs_price[0]['price'];

					$new_price=(1000*$price)/($weight);

					$unit_price=intval($new_price);

					// MRP

					$mrp=$rs_price[0]['mrp'];

					$new_mrp=(1000*$mrp)/($weight);

					$unit_mrp=intval($new_mrp);

				}

		$price_status='Yes';

	}

	else

	{

		$price_status='No';

		$unit_price=0;

		$unit_mrp=0;

	}

	$data=array();

	$data['unit_price']=$unit_price;

	$data['unit_mrp']=$unit_mrp;

	$data['price_status']=$price_status;

	return $data;

}

function getpcprice_update_2020($product_id)

{

	$obj_model_product_price = $this->app->load_model("product_price");

	$rs_price = $obj_model_product_price->execute("SELECT", false, "", "product_id=".$product_id."","weight ASC");

	$kg_price='';

	if(count($rs_price)>0)

	{

				for($i=0;$i<count($rs_price);$i++)

				{

					if($rs_price[$i]['weight']==1)

					{

						$weight=$rs_price[$i]['weight'];

						// Price

						$price=$rs_price[$i]['price'];

						$unit_price=number_format($price/$weight,'2','.','');

						// MRP

						$mrp=$rs_price[$i]['mrp'];

						$unit_mrp=number_format($mrp/$weight,'2','.','');

						$kg_price='Yes';

					}

				}

				if($kg_price=='')

				{

					$weight=$rs_price[0]['weight'];

					// Price

					$price=$rs_price[0]['price'];

					$unit_price=number_format($price/$weight,'2','.','');

					// MRP

					$mrp=$rs_price[0]['mrp'];

					$unit_mrp=number_format($mrp/$weight,'2','.','');

				}

		$price_status='Yes';

	}

	else

	{

		$price_status='No';

		$unit_price=0;

		$unit_mrp=0;

	}

		$unit_price=str_replace(".00","",$unit_price);

		$unit_mrp=str_replace(".00","",$unit_mrp);

	$data=array();

	$data['unit_price']=$unit_price;

	$data['unit_mrp']=$unit_mrp;

	$data['price_status']=$price_status;

	return $data;

}

function change_weight_display_2018($value,$unit){

		$round = $value/1000;

		if($unit=='in_gm')

		{

			if($round>=1){

			$num=number_format($round,2);

			$num=$num;

			return $num." Kg";

			}else{

				$num=$value;

			return $num." Gm";

			}

		}

		else if($unit=='in_ltr')

		{

			if($round>=1){

			$num=number_format($round,2);

			$num=$num;

			return $num." Ltr";

			}else{

				$num=$value;

			return $num." ml";

			}

		}

		else

		{

			return " Pcs";

		}

	}

	function change_weight_display_other_2018($value,$unit){

		if($unit=='in_gm')

		{

			$round = $value/1000;

			if($round>=1){

				$num=number_format($round,2);

				$num=$num;

				return $num." Kg";

			}else{

					$num=$value;

				return (int) $num." Gm";

			}

		}

		else if($unit=='in_ltr')

		{

			$round = $value/1000;

			if($round>=1){

				$num=number_format($round,2);

				$num=$num;

				return $num." Ltr";

			}else{

					$num=$value;

				return (int) $num." ml";

			}

		}

		else

		{

			$type='';

		}

	}

	function order_print_weight_detail_data($pro_unit,$default_weight,$final_weight,$default_qty,$final_qty)

	{

					// Weight Check //

					if($default_weight!=$final_weight)

					{

						if($final_weight>$default_weight)

						{

							$extra_weight1=$final_weight-$default_weight;

							$extra_weight=$this->change_weight_display_other_2018($extra_weight1,$pro_unit);

							$display_extra=' (+'.$extra_weight.')';

						}

						else

						{

							$extra_weight1=$default_weight-$final_weight;

							$extra_weight=$this->change_weight_display_other_2018($extra_weight1,$pro_unit);

							$display_extra=' (-'.$extra_weight.')';

						}

					}

					else

					{

						$display_extra='';

					}

				$final_weight1=$this->change_weight_display_other_2018($default_weight,$pro_unit);

				$product_weight=$final_weight1.$display_extra;

				if($pro_unit=='in_gm')

				{

					$weight=$product_weight;

				}

				else if($pro_unit=='in_ltr')

				{

					$weight=$product_weight;

				}

				

				else  if($pro_unit=='in_pkt')

				{

					$default_weight=(int)($default_weight);

				    $final_weight=(int)($final_weight);

					if($default_weight!=$final_weight)

					{

						if($final_weight>$default_weight)

						{

							$extra_weight1=$final_weight-$default_weight;

							$display_extra=' (+'.$extra_weight1.' Pkt)';

						}

						else

						{

							$extra_weight1=$default_weight-$final_weight;

							$display_extra=' (-'.$extra_weight1.' Pkt)';

						}

					}

					else

					{

						$display_extra='';

					}

					$product_weight=$default_weight." Pkt".$display_extra;

					$weight=$product_weight;

				}

				else

				{

					$default_weight=(int)($default_weight);

				    $final_weight=(int)($final_weight);

					if($default_weight!=$final_weight)

					{

						if($final_weight>$default_weight)

						{

							$extra_weight1=$final_weight-$default_weight;

							$display_extra=' (+'.$extra_weight1.' Pcs)';

						}

						else

						{

							$extra_weight1=$default_weight-$final_weight;

							$display_extra=' (-'.$extra_weight1.' Pcs)';

						}

					}

					else

					{

						$display_extra='';

					}

					$product_weight=$default_weight." Pcs".$display_extra;

					$weight=$product_weight;

				}

				// Weight Check //

				// Qty Check //

					$default_qty=(int)($default_qty);

				    $final_qty=(int)($final_qty);

					if($default_qty!=$final_qty)

					{

						if($final_qty>$default_qty)

						{

							$extra_qty1=$final_qty-$default_qty;

							$display_extra_qty=' (+'.$extra_qty1.')';

						}

						else

						{

							$extra_qty1=$default_qty-$final_qty;

							$display_extra_qty=' (-'.$extra_qty1.')';

						}

					}

					else

					{

						$display_extra_qty='';

					}

					$product_qty=$default_qty."".$display_extra_qty;

					$qty=$product_qty;

				// Qty Check //

			$data=array();

			$data['o_weight']=$weight;

			$data['o_qty']=$qty;

			return $data;

	}

	function web_order_status($status)

	{

				if($status=='Unpaid')

				{

					$ostatus='<span class="label label-info">Pending</span>';

				}

				elseif($status=='Paid')

				{

					$ostatus='<span class="label label-success">Confirmed</span>';

				}

				elseif($status=='Canceled')

				{

					$ostatus='<span class="label label-warning">Canceled</span>';

				}

				elseif($status=='On Delivery')

				{

					$ostatus='<span class="label label-blue">Dispatched</span>';

				}

				elseif($status=='Delivered')

				{

					$ostatus='<span class="label label-blue">Delivered</span>';

				}

				elseif($status=='Tracking Order')

				{

					$ostatus='<span class="label label-blue" style="background:#00BCD4;color:#fff">Tracking Order</span>';

				}

				elseif($status=='Delay')

				{

					$ostatus='<span class="label label-blue" style="background:#000;color:#fff">Delay</span>';

				}

				else

				{

					$ostatus='<span class="label label-blue" style="background:#000;color:#fff">'.$status.'</span>';

				}

				return $ostatus;

	}

	function order_status_html($status)

	{

				if($status=='Unpaid')

				{

					$ostatus='<span class="label label-info">Pending</span>';

				}

				elseif($status=='Paid')

				{

					$ostatus='<span class="label label-success">Confirmed</span>';

				}

				elseif($status=='Canceled')

				{

					$ostatus='<span class="label label-warning">Canceled</span>';

				}

				elseif($status=='On Delivery')

				{

					$ostatus='<span class="label label-blue">Dispatched</span>';

				}

				elseif($status=='Delivered')

				{

					$ostatus='<span class="label label-blue">Delivered</span>';

				}

				elseif($status=='Tracking Order')

				{

					$ostatus='<span class="label label-blue" style="background:#00BCD4;color:#fff">Tracking Order</span>';

				}

				elseif($status=='Delay')

				{

					$ostatus='<span class="label label-blue" style="background:#000;color:#fff">Delay</span>';

				}

				else

				{

					$ostatus='<span class="label label-blue" style="background:#000;color:#fff">'.$status.'</span>';

				}

				return $ostatus;

	}

	function order_from_info_html($order_from)

	{

		$html=$order_from;

		return $html;

	}

	function payment_info_html($payment_type,$payment_status)

	{

		if($payment_type=='COD' || $payment_type=='WALLET')

		{

			$html=$payment_type;

		}

		else

		{

			$html=$payment_type;

			if($payment_status=='Failed')

			{

				$html.='<br/><span class="label label-warning" style="background:red">Failed</span>';

			}

			else if($payment_status=='Success')

			{

				$html.='<br/><span class="label label-success">Success</span>';

			}

			else

			{

				$html.='';

			}

		}

		return $html;

	}

	function payment_info_html_app($payment_type,$payment_status)

	{

		$html=$payment_type;

		return $html;

	}

	

	

	

	function get_option_q_view_add_cart_btn($product_id,$product_price_id)

	{

		

		

	

		

		

		

		$obj_model_tmp_k = $this->app->load_model("tmp_cart");

		$rskart = $obj_model_tmp_k->execute("SELECT",false,"","session_id='".session_id()."' AND product_id='".$product_id."' AND product_price_id='".$product_price_id."'");

		

		

		

		if(count($rskart)>0)

		{

		

			$btn.='<div class="clearfix quantity r_corners d_inline_middle f_size_medium color_dark">

                      <button class="bg_tr d_block f_left detail_qty_p_m_'.$product_id.'" data-direction="down" onclick="add_to_cart('.$product_id.',\'quick_view\',\'MINUS\')">-</button>

                      <input type="text" name="detail_qty" id="detail_qty" readonly="" value="'.$rskart[0]['quantity'].'" class="f_left detail_qty_'.$product_id.'" style="text-align:center">

                      <button class="bg_tr d_block f_left  detail_qty_p_m_'.$product_id.'" data-direction="up" onclick="add_to_cart('.$product_id.',\'quick_view\',\'PLUS\')">+</button>

                    </div>';

		}

		else

		{

			$btn.='<a class="button_type_12 r_corners bg_scheme_color color_light tr_delay_hover d_inline_b f_size_large" href="javascript:void(0);" onclick="add_to_cart('.$product_id.',\'quick_view\',\'PLUS\')"  title="Add To Cart"><i class="fa fa-shopping-cart" ></i> Add To Cart</a>';

			

		}

	

	

	$btn.='</div>';

						

						

						

	return $btn;



		

	}

	

	

	function get_option_detail_add_cart_btn($product_id,$product_price_id)

{

	

		

		

		

		$obj_model_tmp_k = $this->app->load_model("tmp_cart");

		$rskart = $obj_model_tmp_k->execute("SELECT",false,"","session_id='".session_id()."' AND product_id='".$product_id."' AND product_price_id='".$product_price_id."'");

		

		

		

		if(count($rskart)>0)

		{

		

			$btn.='<div class="clearfix quantity r_corners d_inline_middle f_size_medium color_dark">

                      <button class="bg_tr d_block f_left detail_qty_p_m_'.$product_id.'" data-direction="down" onclick="add_to_cart('.$product_id.',\'detail\',\'MINUS\')">-</button>

                      <input type="text" name="detail_qty" id="detail_qty" readonly="" value="'.$rskart[0]['quantity'].'" class="f_left detail_qty_'.$product_id.'" style="text-align:center">

                      <button class="bg_tr d_block f_left  detail_qty_p_m_'.$product_id.'" data-direction="up" onclick="add_to_cart('.$product_id.',\'detail\',\'PLUS\')">+</button>

                    </div>';

		}

		else

		{

			$btn.='<a class="button_type_12 r_corners bg_scheme_color color_light tr_delay_hover d_inline_b f_size_large" href="javascript:void(0);" onclick="add_to_cart('.$product_id.',\'detail\',\'PLUS\')"  title="Add To Cart"><i class="fa fa-shopping-cart" ></i> Add To Cart</a>';

			

		}

	

	

	$btn.='</div>';

						

						

						

	return $btn;

}

	

	

	

	

	

		function get_option_add_cart_btn($product_id,$product_price_id)

{

	

		

		

		

		$obj_model_tmp_k = $this->app->load_model("tmp_cart");

		$rskart = $obj_model_tmp_k->execute("SELECT",false,"","session_id='".session_id()."' AND product_id='".$product_id."' AND product_price_id='".$product_price_id."'");

		

		

		

		if(count($rskart)>0)

		{

		

			$btn.='<div class="clearfix quantity r_corners d_inline_middle f_size_medium color_dark">

                      <button class="bg_tr d_block f_left detail_qty_p_m_'.$product_id.'" data-direction="down" onclick="add_to_cart('.$product_id.',\'other\',\'MINUS\')">-</button>

                      <input type="text" name="detail_qty" id="detail_qty" readonly="" value="'.$rskart[0]['quantity'].'" class="f_left detail_qty_'.$product_id.'" style="text-align:center">

                      <button class="bg_tr d_block f_left  detail_qty_p_m_'.$product_id.'" data-direction="up" onclick="add_to_cart('.$product_id.',\'other\',\'PLUS\')">+</button>

                    </div>';

		}

		else

		{

			$btn.='<a class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0" href="javascript:void(0);" onclick="add_to_cart('.$product_id.',\'other\',\'PLUS\')" style="font-size: 13px; margin-right: 3px; padding: 4px 5px;" title="Add To Cart"><i class="fa fa-shopping-cart" style="font-size:12px"></i> Add To Cart</a>';

			

		}

	

	

	$btn.='</div>';

						

						

						

	return $btn;

}

	

	

	

	function get_add_cart_btn($product_id,$pro_unit)

{

	$obj_model_product_price = $this->app->load_model("product_price");

	$rs_price = $obj_model_product_price->execute("SELECT",false,"","product_id=".$product_id."","weight ASC");

	

	$btn='<div class="pr_'.$product_id.' incr-btn">';

	

	if(count($rs_price)>0)

	{

		

		$product_price_id=$rs_price[0]['id'];

		$product_id=$rs_price[0]['product_id'];

		

		$obj_model_tmp_k = $this->app->load_model("tmp_cart");

		$rskart = $obj_model_tmp_k->execute("SELECT",false,"","session_id='".session_id()."' AND product_id='".$product_id."' AND product_price_id='".$product_price_id."'");

		

		

		

		if(count($rskart)>0)

		{

		

			$btn.='<div class="clearfix quantity r_corners d_inline_middle f_size_medium color_dark">

                      <button class="bg_tr d_block f_left detail_qty_p_m_'.$product_id.'" data-direction="down" onclick="add_to_cart('.$product_id.',\'other\',\'MINUS\')">-</button>

                      <input type="text" name="detail_qty" id="detail_qty" readonly="" value="'.$rskart[0]['quantity'].'" class="f_left detail_qty_'.$product_id.'" style="text-align:center">

                      <button class="bg_tr d_block f_left  detail_qty_p_m_'.$product_id.'" data-direction="up" onclick="add_to_cart('.$product_id.',\'other\',\'PLUS\')">+</button>

                    </div>';

		}

		else

		{

			$btn.='<a class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0" href="javascript:void(0);" onclick="add_to_cart('.$product_id.',\'other\',\'PLUS\')" style="font-size: 13px; margin-right: 3px; padding: 4px 5px;" title="Add To Cart"><i class="fa fa-shopping-cart" style="font-size:12px"></i> Add To Cart</a>';

			

		}

	

	}

	else

	{

		$btn.='<a class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0 sold_out" href="javascript:void(0);"  style="font-size: 13px; margin-right: 3px; padding: 4px 5px;" title="Sold Out"> <i class="fa fa-shopping-cart" style="font-size:12px"></i> Sold Out</a>';

		

	}

	$btn.='</div>';

						

						

						

	return $btn;

}







function get_product_q_view_add_cart_btn($product_id,$pro_unit)

{

	$obj_model_product_price = $this->app->load_model("product_price");

	$rs_price = $obj_model_product_price->execute("SELECT",false,"","product_id=".$product_id."","weight ASC");

	

	$btn='<div class="pr_'.$product_id.'">';

	

	if(count($rs_price)>0)

	{

		

		$product_price_id=$rs_price[0]['id'];

		$product_id=$rs_price[0]['product_id'];

		

		$obj_model_tmp_k = $this->app->load_model("tmp_cart");

		$rskart = $obj_model_tmp_k->execute("SELECT",false,"","session_id='".session_id()."' AND product_id='".$product_id."' AND product_price_id='".$product_price_id."'");

		

		

		

		if(count($rskart)>0)

		{

		

			$btn.='<div class="clearfix quantity r_corners d_inline_middle f_size_medium color_dark">

                      <button class="bg_tr d_block f_left detail_qty_p_m_'.$product_id.'" data-direction="down" onclick="add_to_cart('.$product_id.',\'quick_view\',\'MINUS\')">-</button>

                      <input type="text" name="detail_qty" id="detail_qty" readonly="" value="'.$rskart[0]['quantity'].'" class="f_left detail_qty_'.$product_id.'" style="text-align:center">

                      <button class="bg_tr d_block f_left  detail_qty_p_m_'.$product_id.'" data-direction="up" onclick="add_to_cart('.$product_id.',\'quick_view\',\'PLUS\')">+</button>

                    </div>';

		}

		else

		{

			$btn.='<a class="button_type_12 r_corners bg_scheme_color color_light tr_delay_hover f_left f_size_large" href="javascript:void(0);" onclick="add_to_cart('.$product_id.',\'quick_view\',\'PLUS\')"  title="Add To Cart"><i class="fa fa-shopping-cart" ></i> Add To Cart</a>';

			

		}

	

	}

	else

	{

		$btn.='<a class="button_type_12 r_corners bg_scheme_color color_light tr_delay_hover f_left f_size_large sold_out" href="javascript:void(0);"   title="Sold Out"> <i class="fa fa-shopping-cart" style="font-size:12px"></i> Sold Out</a>';

		

	}

	$btn.='</div>';

						

						

						

	return $btn;

}

	















	

	function get_product_detail_add_cart_btn($product_id,$pro_unit)

{

	$obj_model_product_price = $this->app->load_model("product_price");

	$rs_price = $obj_model_product_price->execute("SELECT",false,"","product_id=".$product_id."","weight ASC");

	

	$btn='<div class="pr_'.$product_id.'">';

	

	if(count($rs_price)>0)

	{

		

		$product_price_id=$rs_price[0]['id'];

		$product_id=$rs_price[0]['product_id'];

		

		$obj_model_tmp_k = $this->app->load_model("tmp_cart");

		$rskart = $obj_model_tmp_k->execute("SELECT",false,"","session_id='".session_id()."' AND product_id='".$product_id."' AND product_price_id='".$product_price_id."'");

		

		

		

		if(count($rskart)>0)

		{

		

			$btn.='<div class="clearfix quantity normal-quantity r_corners d_inline_middle f_size_medium color_dark">

                      <button class="bg_tr d_block f_left detail_qty_p_m_'.$product_id.'" data-direction="down" onclick="add_to_cart('.$product_id.',\'detail\',\'MINUS\')">-</button>

                      <input type="text" name="detail_qty" id="detail_qty" readonly="" value="'.$rskart[0]['quantity'].'" class="f_left detail_qty_'.$product_id.'" style="text-align:center">

                      <button class="bg_tr d_block f_left  detail_qty_p_m_'.$product_id.'" data-direction="up" onclick="add_to_cart('.$product_id.',\'detail\',\'PLUS\')">+</button>

                    </div>';

		}

		else

		{

			$btn.='<a class="button_type_12 r_corners bg_scheme_color color_light tr_delay_hover d_inline_b f_size_large" href="javascript:void(0);" onclick="add_to_cart('.$product_id.',\'detail\',\'PLUS\')"  title="Add To Cart"><i class="fa fa-shopping-cart" ></i> Add To Cart</a>';

			

		}

	

	}

	else

	{

		$btn.='<a class="button_type_12 r_corners bg_scheme_color color_light tr_delay_hover d_inline_b f_size_large sold_out" href="javascript:void(0);"   title="Sold Out"> <i class="fa fa-shopping-cart" style="font-size:12px"></i> Sold Out</a>';

		

	}

	$btn.='</div>';

						

						

						

	return $btn;

}

	

	

	

	

	

	

	

function preview_excel($inputFileName,$table_class=NULL)

	{

		try {

		$inputFileType = PHPExcel_IOFactory::identify($inputFileName);

		$objReader = PHPExcel_IOFactory::createReader($inputFileType);

		$objPHPExcel = $objReader->load($inputFileName);

		} catch(Exception $e) {

   		 die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());

		}

		//Get worksheet dimensions

		$sheet = $objPHPExcel->getSheet(0);

		$highestRow = $sheet->getHighestRow();

		$highestColumn = $sheet->getHighestColumn();

		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

		//  Loop through each row of the worksheet in turn

		$html='<table class="'.$table_class.'">';

		for ($row = 1; $row <= $highestRow; $row++){

    	 $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,

                                    NULL,

                                    TRUE,

                                    FALSE);

		$html.='<tr>';

        for ($col = 0; $col < $highestColumnIndex; ++ $col) {

            $cell = $sheet->getCellByColumnAndRow($col, $row);

            $val = $cell->getValue();

            $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);

           // echo '<td>' . $val . '<br>(Typ ' . $dataType . ')</td>';

			  $html.= '<td>' . $val . '<br></td>';

        }

        $html.='</tr>';

		}

		$html.='</table>';

		return $html;

	}

		function export_excel($ExeclHeads,$data_array,$fields,$filename,$array_field)

{

	$objPHPExcel = new PHPExcel();

	$objPHPExcel->setActiveSheetIndex(0);

	$rowCount = 1;

	//start of printing column names as names of MySQL fields

	$column = 'A';

	for ($i = 0; $i < count($ExeclHeads); $i++)

	{

		$objPHPExcel->getActiveSheet()->setCellValue($column.$rowCount, $ExeclHeads[$i]);

		$column++;

	}

  //end of adding column names

  //start while loop to get data

  $rowCount = 2;

  foreach($data_array as $row)

 {

		$column = 'A';

		for($j=0; $j<count($fields);$j++)

		{

			if(!isset($row[$fields[$j]]))

				$value = NULL;

			elseif ($row[$fields[$j]] != "")

				$value = strip_tags($row[$fields[$j]]);

			else

				$value = "";

			$objPHPExcel->getActiveSheet()->setCellValue($column.$rowCount, $value);

				foreach($array_field as $ddd => $dddvalue)

				{

				if($ddd==$fields[$j])

				{

					//$pr_title=$dddvalue['prompt_title'];

					//$pr_prompt=$dddvalue['prompt'];

					//$pr_options=$dddvalue['options'];

					$objValidation3 = $objPHPExcel->getActiveSheet()->getCell($column . $rowCount)->getDataValidation();

					$objValidation3->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);

					$objValidation3->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);

					$objValidation3->setAllowBlank(false);

					$objValidation3->setShowInputMessage(true);

					$objValidation3->setShowDropDown(true);

					//$objValidation3->setPromptTitle($pr_title);

					//$objValidation3->setPrompt($pr_prompt);

					$objValidation3->setErrorTitle('Input error');

					$objValidation3->setError('Value is not in list');

					//$objValidation3->setFormula1('"'.$pr_options.'"');

				}

			  }

			$column++;

		}

		$rowCount++;

		}

		header('Content-Type: application/vnd.ms-excel; charset=utf-8');

		header('Content-Disposition: attachment;filename="'.$filename.'.xls"');

		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

		ob_end_clean();

		ob_start();

		$objWriter->save('php://output');

}

// New Added Function 2021 BY Mehul 


function getproductprice_admin_2021($product_id,$product_unit)
{

	$obj_model_product_price = $this->app->load_model("product_price");
	$rs_price = $obj_model_product_price->execute("SELECT", false, "", "product_id=".$product_id."","weight ASC");
	$kg_price='';

	if(count($rs_price)>0)
	{

		if($product_unit=='in_gm' || $product_unit=='in_ltr')
		{

			$cal_weight=1000;

		}
		else
		{
			$cal_weight=1;
		}

				for($i=0;$i<count($rs_price);$i++)

				{

					if($rs_price[$i]['weight']==$cal_weight)
					{

						$weight=$rs_price[$i]['weight'];
						// Price
						$price=$rs_price[$i]['price'];
						$new_price=($cal_weight*$price)/($weight);
						$unit_price=intval($new_price);

						// MRP

						$mrp=$rs_price[$i]['mrp'];
						$new_mrp=($cal_weight*$mrp)/($weight);
						$unit_mrp=intval($new_mrp);
						$kg_price='Yes';

					}


				}

				if($kg_price=='')
				{
					$weight=$rs_price[0]['weight'];
					// Price

					$price=$rs_price[0]['price'];
					$new_price=($cal_weight*$price)/($weight);
					$unit_price=intval($new_price);

					// MRP
					$mrp=$rs_price[0]['mrp'];
					$new_mrp=($cal_weight*$mrp)/($weight);
					$unit_mrp=intval($new_mrp);

				}


		$price_status='Yes';
	}
	else
	{
		$price_status='No';
		$unit_price=0;
		$unit_mrp=0;
	}







	$data=array();
	$data['unit_price']=$unit_price;
	$data['unit_mrp']=$unit_mrp;
	$data['price_status']=$price_status;
	return $data;




}

// New Added Function 2021 BY Rahul
	function o_status_html2020($order_status)
	{
		
		
		
		if($order_status=='Pending')
		{
			$class="badge-secondary";	
		}
		else if($order_status=='Confirmed')
		{
			$class="badge-primary";	
		}
		
		else if($order_status=='Packed')
		{
			$class="badge-info";	
		}
		
		else if($order_status=='Dispatched')
		{
			$class="badge-warning";	
		}
		
		else if($order_status=='Delivered')
		{
			$class="badge-success";	
		}
		
		else if($order_status=='Return')
		{
			$class="badge-danger";	
		}
		
		else if($order_status=='Canceled')
		{
			$class="badge-danger";	
		}
		else
		{
			$class="badge-dark";	
			
		}
		
		
		$order_status='<span class="badge '.$class.'" >'.$order_status.'</span>';
		
		
		
		
		
		return $order_status;
	}
	
	function sort_order($table_name)
	{
		$obj_table =$this->app->load_model($table_name);
		$result = $obj_table->execute("SELECT", false, "SELECT count(*) as allcount,".$table_name.".* from ".$table_name."  where id!=0 and status!='Trash'");
		$totalRecords = $result[0]['allcount'];
		$records = array();
		for($i=1;$i<=$totalRecords+1;$i++)
		{
			$records[$i] = $i;
		}
		 return $records;
	}

	function sort_order_count($table_name)
	{
		$obj_table =$this->app->load_model($table_name);
		$result = $obj_table->execute("SELECT", false, "SELECT count(*) as allcount,".$table_name.".* from ".$table_name."  where id!=0 and status!='Trash'");
		$totalRecords = $result[0]['allcount'];
	
		return $totalRecords+1;
	}
	
	function user_group($group_id)
	{
		$group_ids=explode(',',$group_id);
		$group_name='';
		 for($j=0;$j<count($group_ids);$j++)
		 {
			$obj_model_user_group=$this->app->load_model('user_group');

			$rs_cat=$obj_model_user_group->execute("SELECT",false,"SELECT id,name FROM user_group WHERE id=".$group_ids[$j]."","");
		 	$group_name.='<span class="badge badge-primary">'.$rs_cat[0]['name'].'</span> ';
		 }
		 return $group_name;
	}
	
	function user_status($user_status)
	{
		if($user_status=='Yes')
		{
			$user_status='<span class="badge badge-warning">Yes</span>';
		}
		else
		{
			$user_status='<span class="badge badge-danger">No</span>';
		}
		return $user_status;
	}
	
	
	function user_registered_with($registered_with)
	{
		if($registered_with=='website')
		{
			$user_status='<span class="badge badge-warning">Website</span>';
		}
		else if($registered_with=='facebook' || $registered_with=='facebook_app')
		{
			$user_status='<span class="badge badge-secondary">Facebook</span>';
		}
		else if($registered_with=='google' || $registered_with=='google_app')
		{
			$user_status='<span class="badge badge-success">Google</span>';
		}
		else if($registered_with=='iphone')
		{
			$user_status='<span class="badge badge-info">Iphone</span>';
		}
		else if($registered_with=='android_app')
		{
			$user_status='<span class="badge badge-dark">Android</span>';
		}
		else 
		{
			$user_status='<span class="badge badge-light">Both</span>';
		}
		return $user_status;
	}

	
	
	function product_cat_names($product_id)
	{
		if($product_id>0)
		{
			$obj_model_tble = $this->app->load_model("product_category");
			$obj_model_tble->join_table("category", "left", array("name"), array("category_id"=>"id"));
			$data=$obj_model_tble->execute("SELECT",false,"","product_id='".$product_id."'");
			if(count($data)>0)
			{
				$ccat_array=array();
				for($i=0;$i<count($data);$i++)
				{
				$ccat_array[]=$data[$i]['category_name'];
				}
				$cats=implode(',',$ccat_array);
				return $cats;
			}
			else
			{
				return '';
			}
		}
		else
		{
			return '';
		}
	}
	
	function cat_listmenu($pid = 0,$act,$product_id)
	{
		if($act=='edit')
		{
		$obj_model_category=$this->app->load_model('category');
		$rs_cat=$obj_model_category->execute("SELECT",false,"SELECT id,name,parentcategory_id FROM category WHERE status='Active' and parentcategory_id='$pid'","");
		$i=0;
		foreach($rs_cat as $cat)
		{
			$obj_model_product_category=$this->app->load_model('category_group_ids');
			$rs_product_cat=$obj_model_product_category->execute("SELECT",false,"","group_id=".$product_id." and category_id=".$cat['id']."");
			if($i%2==0)
			{
			echo '<div class="even">';
			}
			else
			{
			echo '<div class="odd">';
			}
			if($rs_product_cat[0]["category_id"]==$cat['id'])
			{
				$checked='checked="checked"';
			}
			else
			{
				$checked='';
			}
		print' <label class="csscheckbox csscheckbox-primary">
		<input class="csscheckbox csscheckbox-default" type="checkbox" '.$checked.' name="product_category[]" value="'.$cat['id'].'"> <span></span>&nbsp;&nbsp;&nbsp;'.$cat['name'].' </label>';
				if($this->countsubcat($cat['id'])>0)
					{
						echo'<div class="subs">';
						$this->cat_listmenu($cat['id'],$act,$product_id);
						echo'</div>';
					}
					echo '</div>';
				}
			}
			else
			{
			$obj_model_category=$this->app->load_model('category');
			$rs_cat=$obj_model_category->execute("SELECT",false,"SELECT id,name,parentcategory_id FROM category WHERE status='Active' and parentcategory_id='$pid'","");
			$i=0;
			foreach($rs_cat as $cat)
			{
				if($i%2==0)
				{
				echo '<div class="even">';
				}
				else
				{
				echo '<div class="odd">';
				}
		print' <label class="csscheckbox csscheckbox-primary">
		<input type="checkbox" name="product_category[]" value="'.$cat['id'].'"><span></span>&nbsp;&nbsp;&nbsp;'.$cat['name'].' </label>';
			 if($this->countsubcat($cat['id'])>0)
			 {
				echo'<div class="subs">';
				$this->cat_listmenu($cat['id'],'','');
				echo'</div>';
			 }
				echo '</div>';
			 }
		   }
		$i++;
	}
	
	function get_image_path($image_name,$folder,$type)
	{
		
		
		
		
		
			if($image_name!="" && file_exists(ABS_PATH."/uploads/".$folder."/".$image_name))
			{
				$large_image= SERVER_ROOT."/uploads/".$folder."/".$image_name;
				$medium_image= SERVER_ROOT."/uploads/".$folder."/".'mediumthumb'.$image_name;
				$thumb_image= SERVER_ROOT."/uploads/".$folder."/".'thumb'.$image_name;
			}
			
			
			else
			{
				
				if($folder=='customer')
				{
					$large_image=SERVER_ROOT.'/uploads/default_customer.png';
					$medium_image=SERVER_ROOT.'/uploads/default_customer.png';
					$thumb_image=SERVER_ROOT.'/uploads/default_customer.png';
					
				}
				else
				{
				
					$large_image=SERVER_ROOT.'/uploads/default.png';
					$medium_image=SERVER_ROOT.'/uploads/default.png';
					$thumb_image=SERVER_ROOT.'/uploads/default.png';
				
				}
			}
			if($type=='')
			{
				$data=array();
				$data['large_image']=$large_image;
				$data['medium_image']=$medium_image;
				$data['thumb_image']=$thumb_image;
			}
			else
			{
				if($type=='large')
				{
					$data=$large_image;
				}
				else if($type=='medium')
				{
					$data=$medium_image;
				}
				else if($type=='thumb')
				{
					$data=$thumb_image;
				}
				else
				{
					$data='';
				}
			}
			return $data;
	}
	
	function get_zone2021($area_name)
	{
		$obj_model_area=$this->app->load_model("area");
		$rs_area=$obj_model_area->execute("SELECT",false,"","name='".trim($area_name)."'");
		if(count($rs_area)>0)
		{
			if($rs_area[0]['zone']=='West')
			{
				$zone='<span class="badge badge-primary">West</span>';
			}
			elseif($rs_area[0]['zone']=='South-West')
			{
				$zone='<span class="badge badge-secondary">South-West</span>';
			}
			elseif($rs_area[0]['zone']=='South')
			{
				$zone='<span class="badge badge-success">South</span>>';
			}
			elseif($rs_area[0]['zone']=='North')
			{
				$zone='<span class="badge badge-warning">North</span>';
			}
			elseif($rs_area[0]['zone']=='East')
			{
				$zone='<span class="badge badge-info">East</span>';
			}
			else
			{
				$zone='<span class="badge badge-dark">Centeral</span>';
			}
		}
		else
		{
			$zone='-';
		}
		return $zone;
	}
	
	function set_message2021($message, $type){
		$_SESSION['msg'] = $message;
		$_SESSION['type'] = $type;
	}
	function get_message2021()
	{
		if(VIR_DIR=="admin/")
		{
			if(isset($_SESSION['msg']) && isset($_SESSION['type'])){
					if($_SESSION['type']=='SUCCESS'){
						$message =  '<div class="alert alert-success alert-dismissible fade show" role="alert">
									  <i class="fa fa-check mg-r-10"></i> <strong>SUCCESS </strong> '.$_SESSION['msg'].'
									  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">×</span>
									  </button>
									</div>';
					}else if($_SESSION['type']=='ERROR'){
						$message =  '<div class="alert alert-error alert-dismissible fade show" role="alert">
									  <i class="fa fa-close mg-r-10"></i> <strong>ERROR </strong> '.$_SESSION['msg'].'
									  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">×</span>
									  </button>
									</div>';
					}else if($_SESSION['type']=='MESSAGE'){
						$message =  '<div class="alert alert-warning alert-dismissible fade show" role="alert">
									  <i class="fa fa-bullhorn mg-r-10"></i> <strong>Information </strong> '.$_SESSION['msg'].'
									  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">×</span>
									  </button>
									</div>';
					}
					unset($_SESSION['msg']);
					unset($_SESSION['type']);
					return $message;
				}
		}
		else
		{
		if(isset($_SESSION['msg']) && isset($_SESSION['type']))
		{
			if($_SESSION['type']=='SUCCESS')
			{
				if(VIR_DIR!="")
				{
				$message = '<div class="alert alert-success">
					 <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
					<strong>Success!</strong> '.$_SESSION['msg'].'
				</div>';
				}
				else
				{
				$message =  '<div class="col-sm-12">
				<div class="alert_box r_corners color_green success m_bottom_10">
							<button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>
							<i class="fa fa-smile-o"></i><p>'.$_SESSION['msg'].' </p>
							</div></div>
				';
				}
			}
			else if($_SESSION['type']=='ERROR')
			{
				if(VIR_DIR!="")
				{
				$message =  '<div class="alert alert-error">
					 <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
					 <strong>Error!</strong> '.$_SESSION['msg'].'
				</div>';
				}
				else
				{
				$message ='
				<div class="col-sm-12">
				<div class="alert_box r_corners error ">
							<button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>
							<i class="fa fa-exclamation-triangle"></i><p>'.$_SESSION['msg'].'</p>
							</div></div>

							';
				}
			}
			else if($_SESSION['type']=='MESSAGE'){
				$message =  '<div class="col-sm-12"><div class="alert_box r_corners warning m_bottom_10">
					 	<button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>
						<i class="fa fa-exclamation-triangle"></i><p>'.$_SESSION['msg'].'</p>
						</div></div>';
			}
			unset($_SESSION['msg']);
			unset($_SESSION['type']);
			return $message;
		}
		}
	}

	
	function numerdisplayformate($number) {
		$num = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $number);
		return $num;
	}


	function resize_multi_image_2020($uploadedfile_name,$uploadedfile_tmpname,$image_user_config,$user_width1,$user_width2,$user_width3)

	{

				$errors=0;

			//$image =$_FILES["file"]["name"];

				$uploadedfile = $uploadedfile_tmpname;

				$file_name = basename($uploadedfile_name);

				$file_info = $this->get_file_info($file_name);

				if(strtoupper($file_info->extension)=="JPG" || strtoupper($file_info->extension)=="JPEG" || strtoupper($file_info->extension)=="GIF"  || strtoupper($file_info->extension)=="PNG"){

				$new_name = rand(1234,999999).$this->image_string().".".$file_info->extension;

						}

				if ($new_name)

				{

				$filename = stripslashes($uploadedfile_name);

				$i = strrpos($filename,".");

				 if (!$i) { return ""; }

				 $l = strlen($filename) - $i;

				 $ext = substr($filename,$i+1,$l);

				$extension = $ext;

				$extension = strtolower($extension);

				if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))

				{

				$change='<div class="msgdiv">Unknown Image extension </div> ';

				$errors=1;

				}

				else

				{

				$size=filesize($uploadedfile_tmpname);

				if($extension=="jpg" || $extension=="jpeg" )

				{

				$uploadedfile = $uploadedfile_tmpname;

				$src = imagecreatefromjpeg($uploadedfile);

				}

				else if($extension=="png")

				{

				$uploadedfile = $uploadedfile_tmpname;

				$src = imagecreatefrompng($uploadedfile);

				}

				else

				{

				$src = imagecreatefromgif($uploadedfile);

				}

				echo $scr;

				list($width,$height)=getimagesize($uploadedfile);

				if($width>$user_width1)

						{

						$newwidth=$user_width1;

						$newheight=($height/$width)*$newwidth;

						$tmp=imagecreatetruecolor($newwidth,$newheight);

						}

						else

						{

						$newwidth=$width;

						$newheight=($height/$width)*$newwidth;

						$tmp=imagecreatetruecolor($newwidth,$newheight);

						}

						if($width>$user_width2)

						{

						$newwidth1=$user_width2;

						$newheight1=($height/$width)*$newwidth1;

						$tmp1=imagecreatetruecolor($newwidth1,$newheight1);

						}

						else

						{

						$newwidth1=$width;

						$newheight1=($height/$width)*$newwidth1;

						$tmp1=imagecreatetruecolor($newwidth1,$newheight1);

						}

						if($width>$user_width3)

						{

						$newwidth2=$user_width3;

						$newheight2=($height/$width)*$newwidth2;

						$tmp2=imagecreatetruecolor($newwidth2,$newheight2);

						}

						else



						{

						$newwidth2=$width;

						$newheight2=($height/$width)*$newwidth2;

						$tmp2=imagecreatetruecolor($newwidth2,$newheight2);

						}

				imagecolortransparent($tmp, imagecolorallocatealpha($tmp, 0, 0, 0, 127));

				imagealphablending($tmp, false);

				imagesavealpha($tmp, true);

				imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

				imagecolortransparent($tmp1, imagecolorallocatealpha($tmp1, 0, 0, 0, 127));

				imagealphablending($tmp1, false);

				imagesavealpha($tmp1, true);

				imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);

				imagecolortransparent($tmp2, imagecolorallocatealpha($tmp2, 0, 0, 0, 127));

				imagealphablending($tmp2, false);

				imagesavealpha($tmp2, true);

				imagecopyresampled($tmp2,$src,0,0,0,0,$newwidth2,$newheight2,$width,$height);

				$filename = $image_user_config.$new_name;

				$filename1 = $image_user_config."mediumthumb".$new_name;

				$filename2 = $image_user_config."thumb".$new_name;

				if($extension=="jpg" || $extension=="jpeg" )

				{

				imagejpeg($tmp,$filename,90);

				imagejpeg($tmp1,$filename1,90);

				imagejpeg($tmp2,$filename2,90);

				}

				else if($extension=="png")

				{

				imagepng($tmp,$filename);

				imagepng($tmp1,$filename1);

				imagepng($tmp2,$filename2);

				}

				else

				{

				imagepng($tmp,$filename,90);


				imagepng($tmp1,$filename1,90);

				imagepng($tmp2,$filename2,90);

				}

				imagedestroy($src);

				imagedestroy($tmp);

				imagedestroy($tmp1);

				imagedestroy($tmp2);

	}

	}

	return $new_name;

	}
	
	
		function moneyFormatIndia($number) {
		$num = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $number);
		$num=str_replace(".00","",$num);
		return '<i class="las la-rupee-sign"></i> '.$num;
}



function get_tag_names($ids)
{
	if($ids!='')
	{
		$obj_model_all = $this->app->load_model("tags");
		$records = $obj_model_all->execute("SELECT",false,"","id IN (".$ids.")");
		
		
		if(count($records)>0)
		{
			$tm=array();
			for($i=0;$i<count($records);$i++)
			{
				$tm[]=$records[$i]['name'];
				
			}
			
			$masters=implode(',',$tm);
			return $masters;	
			
		}
		else
		{
			return '';	
			
		}
		
	}
	else
	{
		return '';	
	}	
}

	
	function get_price_info_detail($id,$master_price,$master_mrp)
{
	
	$mrp_display='';
	$dis_html='';
	if($master_mrp>$master_price && $master_mrp!=0)
	{
		$mrp_display='<del>'.$this->moneyFormatIndia($master_mrp).'</del>';
		
		
		$dis_q=$master_mrp-$master_price;
		$dis_per=$dis_q*100/$master_mrp;
		if((int)$dis_per>0)
		{
		
			$dis_html='<span class="disDiv">'.(int)$dis_per.'% OFF </span>';
		
		}
		
	}
	
	$price_display='<ins>'.$this->moneyFormatIndia($master_price).'</ins>';
	
	
	
		$p_info_html=' <p class="price_range" id="price_ppr">'.$price_display.' '.$mrp_display.' '.$dis_html.'</p>';
	
	
				
		
		
		$data=array();
		$data['p_info_html']=$p_info_html;
		$data['dis_html']=$dis_html;
			
					

		return $data;
					
}
	
	
	
	
	function load_product($data,$limit,$category_slug,$subcategory_slug,$subsubcategory_slug,$size_v,$style_v,$brand_v,$price_v,$serach_keyword,$serach_cat,$product_new,$order_v,$total_products,$product_img,$gender_v,$p_range_v,$p_function_v,$p_brand_v,$p_manufacturer_v,$p_discount_v,$products_data_types,$p_core_collection_v,$p_new_arrivals_v)
{
  $page = $data['page'];
   if($page==1){
   $start = 0;
  }
  else{
  $start = ($page-1)*$limit;
  }
  //echo $order_v; exit;
  //style query condition
 if(($order_v!='') && ($order_v!="no"))
 {
	if($order_v=="top"){$order_by='teacher.current_rattings DESC';}
	elseif($order_v=="new"){$order_by='product.sort_order ASC ';}
	elseif($order_v=="z_a"){$order_by='product.name DESC ';}
	elseif($order_v=="a_z"){$order_by='product.name ASC ';}
	elseif($order_v=="h_l"){$order_by='product.master_price DESC ';}
	elseif($order_v=="l_h"){$order_by='product.master_price ASC ';}
	else{$order_by='product.sort_order ASC';}
 }
 else
 {
 $order_by='product.sort_order ASC';
 }
 
 
 
 
 
	if($category_slug>0)
	{
		 $catCond="  and FIND_IN_SET (".$category_slug.",category_ids)";
		
	}
	else
	{
		$catCond="";
		
	}
	
	
	if($subcategory_slug>0)
	{
		 $subcatCond="  and FIND_IN_SET (".$subcategory_slug.",category_ids)";
		
	}
	else
	{
		$subcatCond="";
		
	}
	
	if($subsubcategory_slug>0)
	{
		 $subsubcatCond="  and FIND_IN_SET (".$subsubcategory_slug.",category_ids)";
		
	}
	else
	{
		$subsubcatCond="";
		
	}
 
 
 
 
 // Gender
	$new_array1=array();
	  if(($gender_v!='') && ($gender_v!="no"))
	{
		$g_array=explode(',',$gender_v);
		foreach ($g_array as $g_i)
		{
				$new_array1[]=" gender='".$g_i."'";
		}
		$new_style1=implode('OR',$new_array1);
		$genders_cond=" and  (".$new_style1.")";
	}
	else
	{
		$genders_cond='';
		
	}
 
 
 //old function not used in current
 	
 
 	if(($price_v!='') && ($price_v!="no"))
	{
		$price_array=explode(',',$price_v);
		if(count($price_array)>1)
		{
			$first_price=$price_array[0];
			$last_price=end($price_array);
			$price_range_s=explode("_",$first_price);
			$price_range_start=$price_range_s[0];
			$price_range_l=explode("_",$last_price);
			$price_range_end=$price_range_l[1];
			$price_cond=" and (productn_attribute.web_price BETWEEN ".$price_range_start." AND ".$price_range_end.")";
		}
		else
		{
		$parr=explode("_",$price_v);
		$price_cond=" and (productn_attribute.web_price BETWEEN ".$parr[0]." AND ".$parr[1].")";
		}
	}
	else
	{
				$price_cond='';
	}
 
 
 
 
 //Price Range Data
 
  if(($p_range_v!='') && ($p_range_v!="no"))
	{
		$price_array=explode(',',$p_range_v);
		foreach ($price_array as $size_i)
		{
				$price_range_d=explode("_",$size_i);
				$price_range_start=$price_range_d[0];
				$price_range_end=$price_range_d[1];
				
			
				$new_array1[]=" (master_price BETWEEN ".$price_range_start." AND ".$price_range_end.")";
		}
		
		
			$new_style1=implode('OR',$new_array1);
			$price_range_cond=" and  (".$new_style1.")";
			
			
			if($order_v=="no")
			{
				$order_by='product.master_price ASC ';
			}
			
		
	}
	else
	{
			
			$price_range_cond='';
			
	}
	
	
	// Collection
	$new_array1=array();
	 if(($size_v!='') && ($size_v!="no"))
	{
		$size_array=explode(',',$size_v);
		foreach ($size_array as $size_i)
		{
				$new_array1[]=" FIND_IN_SET (".$size_i.",product_filter.filter_master_values) ";
		}
		$new_style1=implode('OR',$new_array1);
		$collection_cond=" and  (".$new_style1.")";
	}
	else
	{
		$collection_cond='';
	}
	
	
	
	
	
	
	
	
	
	
	// Core Collection
	$new_array1=array();
	  if(($p_core_collection_v!='') && ($p_core_collection_v!="no"))
	{
		$size_array=explode(',',$p_core_collection_v);
		foreach ($size_array as $size_i)
		{
				$new_array1[]=" FIND_IN_SET (".$size_i.",product_info.core_collection_id) ";
		}
		$new_style1=implode('OR',$new_array1);
		$core_collection_cond=" and  (".$new_style1.")";
	}
	else
	{
		$core_collection_cond='';
	}
	
	
	
	
	
	// New Arrivals Collection
	$new_array1=array();
	  if(($p_new_arrivals_v!='') && ($p_new_arrivals_v!="no"))
	{
		$size_array=explode(',',$p_new_arrivals_v);
		foreach ($size_array as $size_i)
		{
				$new_array1[]=" FIND_IN_SET (".$size_i.",product_info.new_arrivals_id) ";
		}
		$new_style1=implode('OR',$new_array1);
		$new_collection_cond=" and  (".$new_style1.")";
	}
	else
	{
		$new_collection_cond='';
	}
	
	
	

	
	
	// Function
	$new_array1=array();
	  if(($p_function_v!='') && ($p_function_v!="no"))
	{
		$size_array=explode(',',$p_function_v);
		foreach ($size_array as $size_i)
		{
				$new_array1[]=" FIND_IN_SET (".$size_i.",product.function_master_id) ";
		}
		$new_style1=implode('OR',$new_array1);
		$function_cond=" and  (".$new_style1.")";
	}
	else
	{
		$function_cond='';
	}
	
	// Function
	$new_array1=array();
	  if(($p_brand_v!='') && ($p_brand_v!="no"))
	{
		$size_array=explode(',',$p_brand_v);
		foreach ($size_array as $size_i)
		{
				$new_array1[]=" FIND_IN_SET (".$size_i.",product.brand_master_id) ";
		}
		$new_style1=implode('OR',$new_array1);
		$brands_cond=" and  (".$new_style1.")";
	}
	else
	{
		$brands_cond='';
	}
	
	// Manufacturer
	$new_array1=array();
	  if(($p_manufacturer_v!='') && ($p_manufacturer_v!="no"))
	{
		$size_array=explode(',',$p_manufacturer_v);
		foreach ($size_array as $size_i)
		{
				$new_array1[]=" FIND_IN_SET (".$size_i.",product.manufacturer) ";
		}
		$new_style1=implode('OR',$new_array1);
		$manu_cond=" and  (".$new_style1.")";
	}
	else
	{
		$manu_cond='';
	}
	
	
	// Discount
	$new_array1=array();
	  if(($p_discount_v!='') && ($p_discount_v!="no"))
	{
		$size_array=explode(',',$p_discount_v);
		foreach ($size_array as $size_i)
		{
				$new_array1[]=" FIND_IN_SET (".$size_i.",product.discount) ";
		}
		$new_style1=implode('OR',$new_array1);
		
		$s_date = date('d-m-Y'); 
		$e_date="31-12-2022";
		
		
		$p_discount_cond=" and  (".$new_style1.") AND ((STR_TO_DATE(`expire_date`, '%d-%m-%Y') BETWEEN STR_TO_DATE('".$s_date."', '%d-%m-%Y') AND STR_TO_DATE('".$e_date."', '%d-%m-%Y')) or (expire_date=''))";
	}
	else
	{
		$p_discount_cond='';
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	// Material
		$new_array1=array();
	  if(($brand_v!='') && ($brand_v!="no"))
	{
		$size_array=explode(',',$brand_v);
		foreach ($size_array as $size_i)
		{
				$new_array1[]=" FIND_IN_SET (".$size_i.",product.material_master_id) ";
		}
		$new_style1=implode('OR',$new_array1);
		$material_cond=" and  (".$new_style1.")";
	}
	else
	{
		$material_cond='';
	}
	//Shape
		$new_array1=array();
	  if(($style_v!='') && ($style_v!="no"))
	{
		$size_array=explode(',',$style_v);
		foreach ($size_array as $size_i)
		{
				$new_array1[]=" FIND_IN_SET (".$size_i.",product_info.dial_shape) ";
		}
		$new_style1=implode('OR',$new_array1);
		$shape_cond=" and  (".$new_style1.")";
	}
	else
	{
		$shape_cond='';
	}
	//Size
	
	
	 if(($serach_cat>0) && ($serach_cat!="no"))
	{
		$search_tag_cond="  and FIND_IN_SET (".$serach_cat.",category_ids)";
		
		
	}
	else
	{
		$search_tag_cond='';
	}
	
	
	
	if($serach_keyword!='')
	{
		$q=$serach_keyword;
		$g_search_query=" and (product.name LIKE '$q%' or product.name LIKE '%$q%' or product.name LIKE '%$q')";
	}
	else
	{
		$g_search_query="";
	}
	
	
	
	$icon_name='';
	
	if($products_data_types=='whislist')
	{
		
		
		$p_ids=implode(',',$_SESSION['wish']);
		
		if($p_ids!='')
		{
		
			$catCond=" and product.id IN (".$p_ids.")";
		}
		else
		{
			$catCond=" and product.id=0";
			
		}
		
		$icon_name='wis_remove';
		
			
	}
	
	
	
	
	
	
	
	
	//echo $ingradiant_cond;
	$filter_cond=$catCond.$subcatCond.$subsubcatCond.$collection_cond.$color_cond.$size_cond.$season_cond.$material_cond.$shape_cond.$g_search_query.$pmi_cond.$genders_cond.$price_range_cond.$function_cond.$brands_cond.$manu_cond.$p_discount_cond.$wish_filter_cond.$core_collection_cond.$new_collection_cond.$search_tag_cond;
	
	


	
	
	
	
	$obj_model_all_data = $this->app->load_model("product");
	$rs_total = $obj_model_all_data->execute("SELECT",false,"SELECT count(*) as allcount,product.*,product_filter.* from product  LEFT JOIN product_filter AS product_filter ON(product.id=product_filter.product_id) where  product.id!=0 and product.status='Active' ".$alpha_cond." ".$filter_cond." ".$g_search_query."","");
	$total_products=$rs_total[0]['allcount'];
	
	$obj_model_all = $this->app->load_model("product");
	$obj_model_all->join_table("product_filter", "left", array("filter_master_values"), array("id"=>"product_id"));
	$records = $obj_model_all->execute("SELECT",false,"","product.status='Active' ".$alpha_cond." ".$filter_cond." ".$g_search_query."","".$order_by." limit ".$start.",".$limit."","product.id");
	
				//echo $obj_model_all->sql;
 // $sql = "select * from product order by id asc limit $start,$limit";
  $str='';
  //$data = $con->query($sql);
  if(count($records)>0){
   foreach($records as $product)
   {
	   				$id=$product['id'];
					$name=$product['name'];
					$slug=$product['slug'];
					
					$master_price=$product['master_price'];
					$master_mrp=$product['master_mrp'];
					
					$master_type=$product['master_type'];
					$displayPname=$this->string_truncate($name,p_name_limit);
					
					
					
					
					
					$detailUrl='product-detail/'.$slug.'.html';
					
					
					
					
					
					$price_info=$this->get_price_info($id,$master_price,$master_mrp);
					
					
					
					$dis_html=$price_info['dis_html'];
					$price_html=$price_info['p_info_html'];
					
					
								
					$folder=$product['folder'];
					$image=$product['image'];
					
					$productImage=$this->get_image_path($image,'product/'.$folder.'/','medium');
					
					
					$available_sizes_hrml=$this->get_product_sizes($id,$master_type);
					
					
					
					if (in_array($id, $_SESSION['wish']))
					{
							  $wish_active='wis_added';
							  $w_label='Remove from Wishlist';
							  
							  
							  if($products_data_types=='whislist')
								{
									  $wish_active='wis_remove';
									
								}
		
		
		
							  
					}
					else
					{
							 $wish_active='';
							 $w_label='Add to Wishlist';
					}
					
					$str.='<div class="col-lg-3 col-md-3 col-6 pr_animated done mt__30 pr_grid_item product nt_pr desgin__1">
                                <div class="product-inner pr">
                                    <div class="product-image position-relative oh lazyload">
                                       '.$dis_html.'
                                        <a class="d-block" href="'.$detailUrl.'">
                                            <div class="pr_lazy_img main-img nt_img_ratio nt_bg_lz lazyload padding-top__135_318 " data-bgset="'.$productImage.'"></div>
                                        </a>
                                        <div class="hover_img pa pe_none t__0 l__0 r__0 b__0 op__0">
                                            <div class="pr_lazy_img back-img pa nt_bg_lz lazyload padding-top__135_318 " data-bgset="'.$productImage.'"></div>
                                        </div>
                                        <div class="nt_add_w ts__03 pa 
										 '.$wish_active.' wish_'.$id.'">
                                            <a href="javascript:void(0)" onclick="add_to_wish('.$id.')" class="wishlistadd wish_l_'.$id.'  cb chp ttip_nt tooltip_right"><span class="tt_txt wish_label_'.$id.'">'.$w_label.'</span><i class="facl facl-heart-o"></i></a>
                                        </div>
                                        <div class="hover_button op__0 tc pa flex column ts__03">
                                            <a class="pr nt_add_qv js_add_qv cd br__40 pl__25 pr__25 bgw tc dib ttip_nt tooltip_top_left" href="javascript:void(0)" data-id="'.$id.'"><span class="tt_txt">Quick view</span><i class="iccl iccl-eye"></i><span>Quick view</span></a>
                                            
											
                                        </div>
										'.$available_sizes_hrml.'
                                    </div>
                                    <div class="product-info mt__15">
                                        <h3 class="product-title position-relative fs__14 mg__0 fwm">
                                            <a class="cd chp" href="'.$detailUrl.'">'.$displayPname.'</a>
                                        </h3>
                                       '.$price_html.'
                                       
									   
                                    </div>
                                </div>
                            </div>';
   }
	$load_total = $page*$limit;
  	$total_products=$total_products;
   	$remain_load11=$total_products-$load_total;
    $remain_load=(int)$remain_load11;
	$str .= "<input type='hidden' class='total_datas' value='".($total_products)."'>";
	if($remain_load<=0)
	{
		 //$str .= "<input type='hidden' class='isload' value='false'><p class=\"no-more-products loaderclass\">Showing ".$total_products." out of ".$total_products." items</p>";
		  $str .= "<input type='hidden' class='isload' value='false'><p class=\"no-more-products loaderclass\"></p>";
	}
	else
	{
   $str.="<input type='hidden' class='nextpage' value='".($page+1)."'>
   <input type='hidden' class='isload' value='true'>
   <input type='hidden' class='nextload_total' value='".$remain_load."'>
   ";
	}
   }else{
	   $str .= "<input type='hidden' class='total_datas' value='".($total_products)."'>";
   if($page==1)
   {
	    $str .= "<input type='hidden' class='isload' value='false'><p class=\"no-more-products loaderclass\" style=\"    margin-bottom: 100px;margin-top: 20px;\">No Result Found.</p>";
   }
   else
   {
	      // $str .= "<input type='hidden' class='isload' value='false'><p class=\"no-more-products loaderclass\">Showing ".$total_products." out of ".$total_products." items</p>";
		    $str .= "<input type='hidden' class='isload' value='false'><p class=\"no-more-products loaderclass\"></p>";
   }
   }
return $str;

		
	}


function GetStateName($state_id)
{
	if($state_id>0)
	{
		$obj_model_state = $this->app->load_model("state");
		$rs_state = $obj_model_state->execute("SELECT",false,"","id=".$state_id."","id DESC limit 0,1");
		return $rs_state[0]['name'];	
	}	
}


function GetCategoryName($category_id)
{
	if($category_id>0)
	{
		$obj_model_state = $this->app->load_model("category");
		$rs_state = $obj_model_state->execute("SELECT",false,"","id=".$category_id."","id DESC limit 0,1");
		return $rs_state[0]['category_name'];	
	}	
}

function load_blogs($data,$limit,$category_slug,$subcategory_slug,$subsubcategory_slug,$size_v,$style_v,$brand_v,$price_v,$serach_keyword,$serach_cat,$product_new,$order_v,$total_products)
	{
  $page = $data['page'];
   if($page==1){
   $start = 0;
  }
  else{
  $start = ($page-1)*$limit;
  }
  //echo $order_v; exit;
  //style query condition


 
 $order_by='blog.sort_order ASC';

	//size query condition
   
	 
	 
	
	
	
		$g_search_query="";
		
		
		
			if($category_slug!='no' && $subcategory_slug=='no')
			{
				
			
			
				$g_search_query=" and category_id='".$category_slug."'";
				
			}
			else if($category_slug=='no' && $subcategory_slug!='no')
			{
				
			
				$g_search_query=" and FIND_IN_SET (".$subcategory_slug.",tag_ids)";
			
				
				
				
			}
	
	
	
	
					
					
				$master_con=" and blog.status='Active'";
				
				
				
				$filter_cond=$g_search_query.$master_con;
				$obj_model_all_data = $this->app->load_model("blog");
				$rs_total = $obj_model_all_data->execute("SELECT",false,"SELECT count(*) as allcount  from blog where  blog.id!=0 ".$filter_cond."","");
				
				$AllTotal=$rs_total[0]['allcount'];
	 			
				
				
				
				$obj_model_all = $this->app->load_model("blog");
				$obj_model_all->join_table("blog_category", "left", array( "name"), array("category_id"=>"id"));
				//$obj_model_all->join_table("city", "left", array( "name"), array("city_id"=>"id"));
				//$obj_model_all->join_table("state", "left", array("name"), array("state_id"=>"id"));
				$records = $obj_model_all->execute("SELECT",false,"","blog.id!=0  ".$filter_cond."","blog.sort_order ASC limit ".$start.",".$limit."","");
 // $sql = "select * from product order by id asc limit $start,$limit";
  $str='';
  //$data = $con->query($sql);
  if(count($records)>0){
	  
	  $sr=1;
   foreach($records as $product)
   {
	   		
			
			
					
				
				
					
					
					
						$title=$product['title'];
						$short_info=$product['short_info'];
						$slug=$product['slug'];
						$blog_category_name=$product['blog_category_name'];
						$added_date=$product['added_date'];
						
						
						$f_date=date('d M Y',strtotime($added_date));
						$image=$product['image'];
						 $folder='blog';
		 				 $mainImage=$this->get_image_path($image,$folder,'large');	
					
					
					
	 $str.= '<div class="blogThumb">
							<figure>
								<img src="'.$mainImage.'" alt="'.$title.'">
							</figure>
							<div class="blogHeadingList">
								<p class="blogSemiHeading">'.$blog_category_name.'</p>
								<p><i class="fa fa-calendar"></i> '.$f_date.' </p>
							</div>
							<h3>'.$title.'</h3>
							<p>'.$short_info.'</p>
							<a href="blog-detail/'.$slug.'.html" class="btn btn-trinary">Read More</a>
						</div>';
								
								 $sr++;
   }
	$load_total = $page*$limit;
  	$total_products=$total_products;
   	$remain_load11=$total_products-$load_total;
    $remain_load=(int)$remain_load11;
	$str .= "<input type='hidden' class='total_datas' value='".($total_products)."'>";
	  $str .= "<input type='hidden' class='total_all_datas' value='".($AllTotal)."'>";
	if($remain_load<=0)
	{
		 //$str .= "<input type='hidden' class='isload' value='false'><p class=\"no-more-products loaderclass\">Showing ".$total_products." out of ".$total_products." items</p>";
		  $str .= "<input type='hidden' class='isload' value='false'><p class=\"no-more-products loaderclass\"></p>";
	}
	else
	{
   $str.="<input type='hidden' class='nextpage' value='".($page+1)."'>
   <input type='hidden' class='isload' value='true'>
   <input type='hidden' class='nextload_total' value='".$remain_load."'>
   ";
	}
   }else{
	   $str .= "<input type='hidden' class='total_datas' value='".($total_products)."'>";
	   $str .= "<input type='hidden' class='total_all_datas' value='".($AllTotal)."'>";
	   
   if($page==1)
   {
	   
	   
	   
	   
	    $str .= "<input type='hidden' class='isload' value='false'>  <img src='images/under-construction.gif' alt='' style='margin: 0 auto;display: inherit;'>";
   }
   else
   {
	      // $str .= "<input type='hidden' class='isload' value='false'><p class=\"no-more-products loaderclass\">Showing ".$total_products." out of ".$total_products." items</p>";
		    $str .= "<input type='hidden' class='isload' value='false'><p class=\"no-more-products loaderclass\"></p>";
   }
   }
return $str;

		
	}
	
	

function FileUpload($data=[])
{
	$filename=$data['filename'];
	$filetmpname=$data['filetmpname'];
	$folder=$data['folder'];

	$filerename   = time()."_".mt_rand(1000, 2000);
	$extension  = pathinfo($filename,PATHINFO_EXTENSION);
	$basename   = $filerename.".".$extension;

	$source       = $filetmpname;
	$destination  = "../uploads/".$folder."/".$basename;

	/* move the file */
	move_uploaded_file($source,$destination);

	return $basename;
}


function FileUpload11($data=[])
{
	$filename=$data['filename'];
	$filetmpname=$data['filetmpname'];
	$folder=$data['folder'];

	$filerename   = time()."_".mt_rand(1000, 2000);
	$extension  = pathinfo($filename,PATHINFO_EXTENSION);
	$basename   = $filerename.".".$extension;

	$source       = $filetmpname;
	$destination  = "../../../uploads/".$folder."/".$basename;

	/* move the file */
	move_uploaded_file($source,$destination);

	return $basename;
}


}

?>
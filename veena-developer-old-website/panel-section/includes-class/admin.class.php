<?

class AdminClass {



	function dbquery($sql)

	{
	     		    $con=mysqli_connect('127.0.0.1','veenabki_dbuser','igD*]e!vYC{y','veenabki_demo')or die('can\'t establish connection with mysqlii servver');
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



	function ValidateAdminLogin($username, $password)

	{

		$pass_md_word = md5($password);

		$sqlMemberQuery = "SELECT adminid from msp_admin WHERE admin_username = '$username' AND admin_pass_md_word = '$pass_md_word'";

		$sqlMemberRes = $this->dbquery($sqlMemberQuery);// or die(mysqli_error());

		$sqlTotal = $this->dbnumrow($sqlMemberRes); //or die(mysqli_error());



		if ($sqlTotal > 0 )

			return 1;

		else

			return 0;

	}



	function ValidateAdminPassword($username, $password)

	{

		$sqlMemberQuery = "SELECT * from msp_admin WHERE admin_username = '$username' AND admin_password = '$password'";

		$sqlMemberRes = $this->dbquery($sqlMemberQuery);// or die(mysqli_error());

		$sqlTotal = $this->dbnumrow($sqlMemberRes); //or die(mysqli_error());



		if ($sqlTotal > 0 )

			return 1;

		else

			return 0;

	}



	function getAdminInfo($AdminLoggedUserID)

	{

		$sqlQuery = "SELECT * from msp_admin where adminid='$AdminLoggedUserID'";

		$sqlRes = $this->dbquery($sqlQuery);

		$sqlData = $this->dbfetch($sqlRes);

		

		return $sqlData;

	}



	var $prefix = 'PBN_';

    var $tblname = '';



    function Table($name){

        $this->tblname = $this->prefix.$name;

    }

	

	function getAdminInfotest()

	{

		$sqlQuery = "SELECT * from {$this->tblname} ";

		$sqlRes = $this->dbquery($sqlQuery);

		$sqlData = $this->dbfetch($sqlRes);



		return $sqlData;

	}



	function AdminLoggedUserNum($username)

	{

		$sqlQuery = "SELECT * from msp_admin where admin_username = '$username'";

		$sqlRes = $this->dbquery($sqlQuery);

		$sqlData = $this->dbnumrow($sqlRes);



		return $sqlData;

	}



	function AdminLoggedUserInfo($username)

	{

		$sqlQuery = "SELECT * from msp_admin where admin_username = '$username'";

		$sqlRes = $this->dbquery($sqlQuery);

		$sqlData = $this->dbfetch($sqlRes);



		return $sqlData;

	}

	function RecordIP()

	{

		/// ONLINE

		$tm = time();

		$timeout = $tm - (600);  //300 is 5 mins

		if($_SERVER["REMOTE_ADDR"]){$ip=$_SERVER["REMOTE_ADDR"];}

		else{$ip=$_SERVER["HTTP_X_FORWARDED_FOR"];}

		$brws = explode("(",$_SERVER["HTTP_USER_AGENT"]);

		$browser = $brws[0];

		$pdate = date("d/m/Y H:i:s");

		//$Admin->dbquery("INSERT INTO msp_whois_online SET  time='".$tm."', ip='".$ip."', browser='".$browser."'");



		$this->dbquery("INSERT INTO msp_whois_online (`id`, `user_id`, `time`, `pdate`, `ip`, `browser`, `status`) VALUES ('', '0', '$tm', '$pdate', '$ip', '$browser', 'Yes')");

		$this->dbquery("UPDATE whois_online SET status = 'No' WHERE time<$timeout"); 

		//$count = mysqli_num_rows(mysqli_query("SELECT DISTINCT(ip) FROM guest"));

		//$count = $count + 10;

	}

}



$Admin = new AdminClass(); 

# Get All Admin Info

//$Admin->RecordIP();







?>
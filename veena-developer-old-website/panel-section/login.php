<?php

include 'includes-class/db.config.class.php';

$con=mysqli_connect('127.0.0.1','veenabki_dbuser','igD*]e!vYC{y','veenabki_demo')or die('can\'t establish connection with mysqli servver');
            $mySelectDB=mysqli_select_db($con,'veenabki_demo') or die('could not connect to the database');

if (isset($_POST["mode"]))

{

	if ($_POST["mode"] == "login")

	{

		$user_username = prepare_input($_POST["username"]);

		$user_password = prepare_input($_POST["password"]);



		if (!empty($user_username) AND !empty($user_password))

		{

          $username =   mysqli_real_escape_string($con,$user_username);

          $password =   mysqli_real_escape_string($con,$user_password);



			 $adminInfo = $Admin->ValidateAdminLogin($username,$password);

           

			if ($adminInfo == 1)

			{

				session_start();

				//session_register("admin_username");

				$_SESSION['admin_username'] = $username;



				header("Location: index.php");

				exit();

               



			}

			else if ($adminInfo == 0)

			{

				$action="error";

			}

		}

		else

		{

			$action="error";

		}

	}

}

?>

<!DOCTYPE html>

<html lang="en">



<head>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Login </title>

	<!-- Bootstrap -->

	<link href="assets/css/bootstrap.min.css" rel="stylesheet">

	<!-- slimscroll -->

	<link href="assets/css/jquery.slimscroll.css" rel="stylesheet">

	<!-- Fontes -->

	<link href="assets/css/font-awesome.min.css" rel="stylesheet">

	<link href="assets/css/simple-line-icons.css" rel="stylesheet">

	<!-- all buttons css -->

	<link href="assets/css/buttons.css" rel="stylesheet">

	<!-- animate css -->

	<link href="assets/css/animate.css" rel="stylesheet">

	<!-- top nev css -->

	<link href="assets/css/page-header.css" rel="stylesheet">

	<!-- adminui main css -->

	<link href="assets/css/main.css" rel="stylesheet">

	<!-- aqua black theme css -->

	<link href="assets/css/aqua-black.css" rel="stylesheet">

	<!-- media css for responsive  -->

	<link href="assets/css/main.media.css" rel="stylesheet">

	<!--[if lt IE 9]> <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->

	<!--[if lt IE 9]> <script src="dist/html5shiv.js"></script> <![endif]-->



	 <script src="assets/js/vendor/jquery-1.11.1.min.js"></script>

        <script src="assets/js/vendor/form_validator.js"></script>

        <script src="assets/js/vendor/jquery.validate.js"></script>

	

	

</head>



<body class="aqua-bg login">

	<div class="middle-box text-center loginscreen ">

		<div class="widgets-container">

			<div>

				    <!-- <img src="assets/images/user.png" alt="..."> -->

				    <img src="<?=$siteurl;?>/images/sitelogo-1518871592.png" alt="<?=$sitename;?>"

			</div>

			<br>

			<h3>Welcome to <?=$sitename;?></h3>

		

			<p>Login in. To see it in action.</p>





			<?php

                //$action = $_GET["action"];

                if ($action == "error") {

                ?>

                <div class="alert alert-danger" id="MessageID" ><strong>Error!</strong> Username or Password couldnt match. </div>

                <?php

                }



                if ($action == "login") {

                ?>

               <div class="alert alert-warning" id="MessageID" >You are not logged in. </div>

                <?php

                }



                if ($_GET["action"] == "logout") {

                ?>

                <div class="alert alert-success" id="MessageID" > <strong>Success!</strong> You are successfully logged out. </div>

                <?php

                }



                if ($action == "sent") {

                ?>

                <div class="alert alert-info" id="MessageID" > <strong>Info!</strong>Password has been sent your email address.

                </div>

                <?php

                }

                ?>





			<form id="LoginForm"  class="top15"  method="post" action="login.php" autocomplete="off">

				<div class="form-group">

					<input type="username" name="username" id="username" required="" placeholder="Username" class="form-control">

				</div>

				<div class="form-group">

					<input type="password" name="password" id="password" required="" placeholder="Password" class="form-control">

				</div>

				<input type="hidden" name="mode" value="login" />

				<button class="btn aqua block full-width bottom15" type="submit">Login</button>

				<a href="forgot_password.html"><small>Forgot password?</small></a>



			

			</form>

			<p class="top15"> <small><?=$sitename;?> is easy to use and customize &copy; 2017</small> </p>

		</div>

	</div>

</body>



</html>
<?
class _logout extends controller{
function init(){
			//$this->app->enable_cache("home.html");
		}
	function onload(){
	
		unset($_SESSION['admin']);
		unset($_SESSION['adminName']);
		unset($_COOKIE['Grocery']);
	
		setcookie("Grocery", "", time() - 3600, "/");
					
		
		$this->app->utility->set_message("You have successfully logged out of the system", "SUCCESS");
		$this->app->redirect("index.php");
		
		
	}	
}
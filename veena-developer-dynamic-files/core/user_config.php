<?
class userconfig
{
	var $config;
	/*==================================================================================*/
	/*  WRITE ALL USER CONFIG VARIABLE IN THIS FILE WHICH IS USED MORE THEN ONE TIME 	*/
	/*	FOR EXAMPLE , is given below , THIS VARIABLE IS DEFINED FOR UPLOADING FILE PATH */
	/*==================================================================================*/

	function __construct()
	{
			

			$this->config["banner"] = "/uploads/banner/";
			$this->config["project"] = "/uploads/project/";
			
			$this->config["projects_gallery"] = "/uploads/projects_gallery/";
			
			$this->config["amenities_master"] = "/uploads/amenities_master/";
			
			
			$this->config["highlights"] = "/uploads/highlights/";
			
			$this->config["careers"] = "/uploads/careers/";
			
			$this->config["csr"] = "/uploads/csr/";
			$this->config["team"] = "/uploads/team/";
			
			$this->config["about"] = "/uploads/about/";
			
			$this->config["home"] = "/uploads/home/";
			
			$this->config["logo"] = "/uploads/logo/";

			$this->config["blog"] = "/uploads/blog/";
			
			
			$this->config["files"] = "/uploads/files/";
			
		}
	}
?>
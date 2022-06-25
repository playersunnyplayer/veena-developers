<?

class _about_us extends controller{

	function init(){

	}

	function onload()
	{
	
	//banner
	
	
		
		

		
		$obj_model_about_detail=$this->app->load_model('about_detail');
		$rs_about_page=$obj_model_about_detail->execute("SELECT",false,"","");
		$this->app->assign("rs_about_page", $rs_about_page[0]);
		
		

		
		$obj_model_team=$this->app->load_model('team');
		$rs_team=$obj_model_team->execute("SELECT",false,"","status='Active'","sort_id ASC");
		$this->app->assign("rs_team", $rs_team);
		
		
		$this->app->setTitle($rs_about_page[0]['meta_title']);
		$this->app->setKeywords($rs_about_page[0]['meta_keywords']);	
		$this->app->setDescription($rs_about_page[0]['meta_desc']);	
			
		
		
		
		
		
		
		
	
	

	}

	

	

	

}

?>
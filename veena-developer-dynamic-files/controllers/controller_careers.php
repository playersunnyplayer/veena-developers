<?

class _careers extends controller{

	function init(){

	}

	function onload()
	{
	
	//banner
	
	
	
		$obj_model_career_detail=$this->app->load_model('career_detail');
		$rs_career_page=$obj_model_career_detail->execute("SELECT",false,"","");
		$this->app->assign("rs_career_page", $rs_career_page[0]);
		
		

		
		$obj_model_career_jobs=$this->app->load_model('career_jobs');
		$rs_jobs=$obj_model_career_jobs->execute("SELECT",false,"","status='Active'","sort_id ASC");
		$this->app->assign("rs_jobs", $rs_jobs);
		
		$this->app->setTitle($rs_career_page[0]['meta_title']);	
		$this->app->setKeywords($rs_career_page[0]['meta_keywords']);	
		$this->app->setDescription($rs_career_page[0]['meta_desc']);	
		
		
		
		
		
		
		
		
	
	

	}

	

	

	

}

?>
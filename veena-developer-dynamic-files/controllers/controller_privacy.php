<?

class _privacy extends controller{

	function init(){

	}

	function onload()
	{
	
	//banner
	
	
	
		$obj_model_career_detail=$this->app->load_model('page_detail');
		$rs_career_page=$obj_model_career_detail->execute("SELECT",false,"","id=1");
		$this->app->assign("rs_career_page", $rs_career_page[0]);
		
		

		
		
		$this->app->setTitle($rs_career_page[0]['meta_title']);	
		$this->app->setKeywords($rs_career_page[0]['meta_keywords']);	
		$this->app->setDescription($rs_career_page[0]['meta_desc']);	
		
		
		
		
		
		
		
		
	
	

	}

	

	

	

}

?>
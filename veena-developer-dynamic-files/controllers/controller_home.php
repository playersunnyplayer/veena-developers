<?

class _home extends controller{

	function init(){

	}

	function onload()
	{
	
	//banner
	
	
	
	
	
		$obj_model_home_detail=$this->app->load_model('home_detail');
		$rs_home=$obj_model_home_detail->execute("SELECT",false,"","");
		$this->app->assign("rs_home", $rs_home[0]);
		
		

		
	
	
		
		$this->app->setTitle($rs_home[0]['meta_title']);
		$this->app->setKeywords($rs_home[0]['meta_keywords']);	
		$this->app->setDescription($rs_home[0]['meta_desc']);	
	
	
	
	
	

		$obj_model_banner=$this->app->load_model('banner');
		$re_banner=$obj_model_banner->execute("SELECT",false,"","status='Active'","sort_id ASC");
		$this->app->assign("banner", $re_banner);

		$obj_model_testimonial=$this->app->load_model('testimonial');
		$re_testimonial=$obj_model_testimonial->execute("SELECT",false,"","status='Active'","sort_id ASC");
		$this->app->assign("testimonial", $re_testimonial);
		
		
		
		$obj_model_projects=$this->app->load_model('projects');
		$obj_model_projects->join_table("projects_info", "left", array(), array("id"=>"projects_id"));
		$rs_resi_projects=$obj_model_projects->execute("SELECT",false,"","projects.status='Active' and category_ids='1' and FIND_IN_SET (1,tag_ids)","projects.sort_order ASC");
		$this->app->assign("rs_resi_projects", $rs_resi_projects);
		
		
		$obj_model_projects1=$this->app->load_model('projects');
		$obj_model_projects1->join_table("projects_info", "left", array(), array("id"=>"projects_id"));
		$rs_comm_projects=$obj_model_projects1->execute("SELECT",false,"","projects.status='Active' and category_ids='2' and FIND_IN_SET (1,tag_ids)","projects.sort_order ASC");
		$this->app->assign("rs_comm_projects", $rs_comm_projects);

	}

	

	

	

}

?>
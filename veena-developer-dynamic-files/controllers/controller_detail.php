<?

class _detail extends controller{

	function init(){

	}

	function onload()
	{
	
	//banner
	
	
		$slug=$this->app->getGetVar('slug');
		
		
		if($slug=='')
		{
			$this->app->redirect(SERVER_ROOT);
			exit;	
		}


		
		$obj_model_projects=$this->app->load_model('projects');
		$obj_model_projects->join_table("projects_info", "left", array(), array("id"=>"projects_id"));
		$rs_projects=$obj_model_projects->execute("SELECT",false,"","projects.status='Active' and slug='".$slug."' and FIND_IN_SET (1,tag_ids)","projects.id DESC");
		$this->app->assign("rs_project", $rs_projects[0]);
		
		
		if(count($rs_projects)<=0)
		{
			$this->app->redirect(SERVER_ROOT);
			exit;
			
			
			
		}
		
		
		
		
		
		$this->app->setTitle($rs_projects[0]['projects_info_meta_title']);	
		$this->app->setKeywords($rs_projects[0]['projects_info_meta_keyword']);	
		$this->app->setDescription($rs_projects[0]['projects_info_meta_description']);	
		
	
	
		
		
		
		
		
		
		
		$project_id=$rs_projects[0]['id'];
		
		$amm_ids=$rs_projects[0]['projects_info_projects_amenities_master_ids'];
		
		if($amm_ids!='')
		{
			$amm_cond=" and id IN (".$amm_ids.")";
			
			
			$obj_model_amenities_master=$this->app->load_model('amenities_master');
			$rs_amenities_master=$obj_model_amenities_master->execute("SELECT",false,"SELECT * FROM `amenities_master` WHERE status='Active' ".$amm_cond." ORDER BY FIELD(id, ".$amm_ids.")","");
			$this->app->assign("rs_amenities_master", $rs_amenities_master);
			
		}
		
		
		
		
		
		
		
		
		$obj_model_projects_gallery=$this->app->load_model('projects_gallery');
		$obj_model_projects_gallery->join_table("projects_gallery_category", "left", array("name","heading"), array("projects_gallery_category_id"=>"id"));
		$rs_projects_gallery_cat=$obj_model_projects_gallery->execute("SELECT",false,"","projects_id='".$project_id."' and projects_gallery.status='Active'","","projects_gallery.projects_gallery_category_id");
		$this->app->assign("rs_projects_gallery_cat", $rs_projects_gallery_cat);
		
		
		$obj_model_projects_highlights=$this->app->load_model('projects_highlights');
		$obj_model_projects_highlights->join_table("highlights", "left", array(), array("highlights_id"=>"id"));
		$rs_projects_highlights=$obj_model_projects_highlights->execute("SELECT",false,"","projects_id='".$project_id."' and projects_highlights.status='Active'","","");
		$this->app->assign("rs_projects_highlights", $rs_projects_highlights);
		
		
		
		
		
		
	
	

	}

	

	

	

}

?>
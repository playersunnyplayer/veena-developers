<?

class _blog_detail extends controller{

	function init(){

	}

	function onload()
	{
	
	//banner
	
	
		$slug=$this->app->getGetVar('slug');
		
		
		
		
		
		$obj_model_career_detail=$this->app->load_model('blog_content');
		$rs_career_page=$obj_model_career_detail->execute("SELECT",false,"","");
		$this->app->assign("rs_career_page", $rs_career_page[0]);
		
		
			
		
		
		if($slug!='')
		{
			
			
			
				$cat_cond=" and blog.slug='".$slug."'";
				
			
			
			
			
			
		
		
			
		}
		
		
		else
		{
			$this->app->redirect(SERVER_ROOT.'/blog.html');
			
			
				
		}
		
		
		
		$obj_model_cats=$this->app->load_model('blog_category');
		$rs_category=$obj_model_cats->execute("SELECT",false,"","blog_category.status='Active'","blog_category.sort_order ASC");
		$this->app->assign("rs_category", $rs_category);
		
		
		$obj_model_blog_tag=$this->app->load_model('blog_tag');
		$rs_tags=$obj_model_blog_tag->execute("SELECT",false,"","blog_tag.status='Active'","blog_tag.sort_order ASC");
		$this->app->assign("rs_tags", $rs_tags);
		


		
		$obj_model_blog=$this->app->load_model('blog');
		$obj_model_blog->join_table("blog_category", "left", array("name"), array("category_id"=>"id"));
		$rs_blogs=$obj_model_blog->execute("SELECT",false,"","blog.status='Active' ".$cat_cond." ","blog.sort_order ASC");
		$this->app->assign("rs_blogs", $rs_blogs[0]);
		
		
		
		
		
		
		
		$amm_ids=$rs_blogs[0]['tag_ids'];
		
		if($amm_ids!='')
		{
			$amm_cond=" and id IN (".$amm_ids.")";
			
			
			$obj_model_amenities_master=$this->app->load_model('blog_tag');
			$rs_tag_master=$obj_model_amenities_master->execute("SELECT",false,"SELECT * FROM `blog_tag` WHERE status='Active' ".$amm_cond." ORDER BY FIELD(id, ".$amm_ids.")","");
			$this->app->assign("rs_tag_master", $rs_tag_master);
			
		}
		
		
		
		
		
		
		
		
		
		$this->app->setTitle($rs_blogs[0]['meta_title']);	
		$this->app->setKeywords($rs_blogs[0]['meta_keywords']);	
		$this->app->setDescription($rs_blogs[0]['meta_desc']);
		
		
			
		
		
			$this->app->assign("page_title", $page_title);
		
		
		
		
		
		
		
		
		
		
		
		
		
	
	

	}

	

	

	

}

?>
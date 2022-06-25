<?

class _blog extends controller{

	function init(){

	}

	function onload()
	{
	
	//banner
	
	
		$slug=$this->app->getGetVar('slug');
		
		$tag=$this->app->getGetVar('tag');
		
		
		
		$obj_model_career_detail=$this->app->load_model('blog_content');
		$rs_career_page=$obj_model_career_detail->execute("SELECT",false,"","");
		$this->app->assign("rs_career_page", $rs_career_page[0]);
		
		
		$this->app->setTitle($rs_career_page[0]['meta_title']);	
		$this->app->setKeywords($rs_career_page[0]['meta_keywords']);	
		$this->app->setDescription($rs_career_page[0]['meta_desc']);	
		
		
		if($slug!='' && $tag=='')
		{
			
			$obj_model_cataa=$this->app->load_model('blog_category');
			$rs_categoryaa=$obj_model_cataa->execute("SELECT",false,"","blog_category.status='Active' and slug='".$slug."'","blog_category.sort_order ASC");
			
			if(count($rs_categoryaa)>0)
			{
				
				$this->app->assign("catID", $rs_categoryaa[0]['id']);
				
				$page_title="".$rs_categoryaa[0]['name']."";
				$cat_cond=" and category_id='".$rs_categoryaa[0]['id']."'";
				
			}
			else
			{
				
				
				$this->app->redirect(SERVER_ROOT."/blog.html");
				
			}
		
			
			
			
		
		
			
		}
		else if($slug!='' && $tag!='')
		{
			
			$obj_model_cataa=$this->app->load_model('blog_tag');
			$rs_categoryaa=$obj_model_cataa->execute("SELECT",false,"","blog_tag.status='Active' and slug='".$tag."'","blog_tag.sort_order ASC");
			
			if(count($rs_categoryaa)>0)
			{
				
				$this->app->assign("tagID", $rs_categoryaa[0]['id']);
				
				$page_title="".$rs_categoryaa[0]['name']."";
				$cat_cond=" and FIND_IN_SET (".$rs_categoryaa[0]['id'].",tag_ids)";
				
			}
			else
			{
				
				
				$this->app->redirect(SERVER_ROOT."/blog.html");
				
			}
		
			
			
			
		
		
			
		}
		
		
		else
		{
			$page_title="All Blogs";
			$cat_cond="";
			
			
				
		}
		
		
		
		$obj_model_cats=$this->app->load_model('blog_category');
		$rs_category=$obj_model_cats->execute("SELECT",false,"","blog_category.status='Active'","blog_category.sort_order ASC");
		$this->app->assign("rs_category", $rs_category);
		


		
		$obj_model_blog=$this->app->load_model('blog');
		$obj_model_blog->join_table("blog_category", "left", array("name"), array("category_id"=>"id"));
		$rs_blogs=$obj_model_blog->execute("SELECT",false,"","blog.status='Active' ".$cat_cond." ","blog.sort_order ASC");
		$this->app->assign("rs_blogs", $rs_blogs);
		
		
		
			
		
		
			$this->app->assign("page_title", $page_title);
		
		
		
		
		
		
		
		
		
		
		
		
		
	
	

	}

	

	

	

}

?>
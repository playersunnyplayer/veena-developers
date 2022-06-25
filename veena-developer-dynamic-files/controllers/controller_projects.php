<?

class _projects extends controller{

	function init(){

	}

	function onload()
	{
	
	//banner
	
	
		$slug=$this->app->getGetVar('slug');
		
		$slug1=$this->app->getGetVar('slug1');
		
		
		if($slug=='')
		{
			$this->app->redirect(SERVER_ROOT);
			exit;	
		}
		
		if($slug1=='')
		{
			$this->app->redirect(SERVER_ROOT);
			exit;	
		}
		
		
		
		
		
		if($slug1=='ongoing')
		{
			$other_cond=" and FIND_IN_SET (1,tag_ids)";
			$label1='Ongoing';
			
		}
		else if($slug1=='upcoming')
		{
			$other_cond=" and FIND_IN_SET (2,tag_ids)";
			$label1='Upcoming';
			
		}
		else if($slug1=='completed')
		{
			$other_cond=" and FIND_IN_SET (3,tag_ids)";
			$label1='Completed';
			
		}
		else
		{
			$other_cond=" and FIND_IN_SET (0,tag_ids)";
			$label1='';
				
		}
		
		
		if($slug=='residential')
		{
			$cat_cond=" and category_ids='1'";
			$cat_cond_new=" and id='1'";
			$label='Residential';
			
		}
		else if($slug=='commercial')
		{
			$cat_cond=" and category_ids='2'";
			$cat_cond_new=" and id='2'";
			
			$label='Commercial';
			
		}
		else
		{
			$cat_cond=" and category_ids='0'";
			$cat_cond_new="";
			$label='';
				
		}

		if($cat_cond_new!='')
		{
			$obj_model_category=$this->app->load_model('category');
			$rs_category=$obj_model_category->execute("SELECT",false,"","status='Active' ".$cat_cond_new."");
			$this->app->assign("rs_category", $rs_category[0]);
			
			$this->app->setTitle($rs_category[0]['meta_title']);
			
			$this->app->setKeywords($rs_category[0]['meta_keyword']);	
			$this->app->setDescription($rs_category[0]['meta_description']);	
		}

		
		$obj_model_projects=$this->app->load_model('projects');
		$obj_model_projects->join_table("projects_info", "left", array(), array("id"=>"projects_id"));
		$rs_projects=$obj_model_projects->execute("SELECT",false,"","projects.status='Active' ".$cat_cond." ".$other_cond." ","projects.sort_order ASC");
		$this->app->assign("rs_project", $rs_projects);
		
		
		
			$page_title="".$label." ".$label1." Projects";
		
		
			$this->app->assign("page_title", $page_title);
			
			
			
			if($slug=='residential')
		{
			if($slug1=='ongoing')
			{
				$metatitle="";
				$metakeyword="";
				$metadesc="";
				
			}
			else if($slug1=='upcoming')
			{
				$metatitle="Upcoming Residential Projects in Mumbai | Veena Developers";
				$metakeyword="upcoming realty projects in mumbai, upcoming residential project in mumbai, upcoming residential projects in mumbai western suburbs, veena developers ongoing projects, best upcoming residential projects in mumbai, upcoming flats in mumbai, upcoming residential projects in south mumbai, best upcoming residential projects in mumbai, upcoming flats in mumbai, new upcoming residential projects in mumbai";
				$metadesc="Veena Skyvista, Veena Vasudha, Veena Arista, New Kamal Society, Veena Symphony, Veena Samrudhi, Veena Velocity III are some of the upcoming residential projects.";
				
				
			}
			else if($slug1=='completed')
			{
				$metatitle="Completed Residential Projects in Mumbai | Veena Developers";
				$metakeyword="veena crest andheri, completed residential projects by veena developers, Veena Signature kandivali, veena serenity tilak nagar, veena velocity vasai, veena dynasty vasai, veena developers chembur, veena developers vasai east, veena developers projects, veena developers projects";
				$metadesc="With more than 31 years of experience in the Real Estate Sector Veena Developers has succesfully delivered 30+ projects to 5300 happy Families without delay.";
				
				
			}
			
			
			if($metatitle!='')
			{
			
			$this->app->setTitle($metatitle);			
			$this->app->setKeywords($metakeyword);	
			$this->app->setDescription($metadesc);
			
			}
			
			
		}
		else if($slug=='commercial')
		{
			
			if($slug1=='ongoing')
			{
				$metatitle="";
				$metakeyword="";
				$metadesc="";
				
				
			}
			else if($slug1=='upcoming')
			{
				$metatitle="Upcoming Commercial Projects in Mumbai | Veena Developers";
				$metakeyword="new construction commercial buildings near me, commercial construction companies near me, commercial construction projects near me, commercial building projects, commercial real estate projects, new commercial developments near me, commercial construction projects, industrial commercial building, commercial projects near me, high rise commercial building, 9 business bay";
				$metadesc="Veena Developers has landmarks across Mumbai and Mumbai Metropolitan Areas. Veena Skytech and Veena Technopark are major upcoming commercial projects. ";
				
				
			}
			else if($slug1=='completed')
			{
				$metatitle="Completed Commercial Projects in Mumbai | Veena Developers";
				$metakeyword="commercial fit out office, two story commercial building, commercial construction projects near me, industrial commercial building, commercial building projects, vsouk, vmall, nikunj signature, sanghavi industrial estate, sonal amit shopping center, high rise commercial building, commercial construction companies";
				$metadesc="V Souk, Vmall, Nikunj Signature, Sanghavi Industrial Estate and Sonal Amit Shopping Center are top commercial projects delivered by Veena Developers.";
				
				
			}
			
			if($metatitle!='')
			{
			
			$this->app->setTitle($metatitle);			
			$this->app->setKeywords($metakeyword);	
			$this->app->setDescription($metadesc);
			
			}
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
	
	

	}

	

	

	

}

?>
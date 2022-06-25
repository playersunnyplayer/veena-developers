<?
	class global_include
	{
		private $settings = array();
		private $app;
		private $initialized = false;
		private $system_acl_permission = array();
		public function __construct()
		{
			$this->app = &app::get_instance();
		}
		public function initalize()
		{
			if(!$this->initialized)
			{
				$this->initialized=true;
				
				if(VIR_DIR=="admin/")
				{

					mysqli_set_charset($this->app->set_db_conn(),'utf-8');
					setcookie('Grocery_page', $this->app->getCurrentView(), time() + (86400 * 30), "/admin/");
					$this->app->setTitle(DEFAULT_TITLE." - Administrator");
					if($this->app->getCurrentView()!="forgot_password")
					{
						if($this->app->getCurrentView()!="default" && (empty($_SESSION["admin"])))
						{
							$this->app->redirect($this->app->root_relative."admin/index.php");
						}
						else if($this->app->getCurrentView()=="default" && (isset($_SESSION["admin"])) && $this->app->getCurrentAction()!="do_logout")
						{
							$this->app->redirect($this->app->root_relative."admin/index.php?view=home");
						}
						else
						{
							if(empty($_SESSION['records']))
							{
								$_SESSION['records'] = ($this->app->getPostVar("record_per_page")==NULL?10:$this->app->getPostVar("record_per_page"));
							}
							else
							{
								if($this->app->getPostVar("record_per_page") != NULL)
								{
									$_SESSION['records'] = $this->app->getPostVar("record_per_page");
								}
						}
						$rs  = array();
						$val = 5;
						for($i=0;$i<10;$i++)
						{
							$rs[$val] = $val;
							$val = $val+5;
						}
						$this->app->assign("record", $rs);
						$this->app->assign("field_record_per_page", $_SESSION['records']);
					 }
					}

					$new_page=$this->app->getCurrentView();
					if($_SESSION['search_by']!='' && $_SESSION['search_keyword']!='' && $_SESSION['current_page']=='')
					{
								$_SESSION['current_page']=$this->app->getCurrentView();
					}
					if($_SESSION['current_page']!=$new_page)
					{
						$_SESSION['current_page']='';
						$_SESSION['search_start_date']='';
						$_SESSION['search_end_date']='';
						$_SESSION['search_category']='';
						$_SESSION['search_type']='';
					}
					$this_page=$this->app->getCurrentView();
					$obj_model_admin = $this->app->load_model("admin");
					$rs_admin = $obj_model_admin->execute("SELECT", false, "", "id='".$_SESSION['admin']."'");
					$this->app->assign("rs_admin",$rs_admin[0]);
					
					if($_SESSION['admin']!='1' && $this->app->getCurrentView()=="account_list")
					{
						$this->app->redirect($this->app->root_relative."admin/index.php?view=home");
					}
					
					
					
					if($this->app->getCurrentView()=="project_list" || $this->app->getCurrentView()=="project_addedit" || $this->app->getCurrentView()=="projects_gallery_list")
					{
						
					}
					else
					{
						$_SESSION['search_p_cat_id']='';
							
					}
					
					
					
					
					
					$obj_model_generel_settings= $this->app->load_model("generel_settings");
					$rs_gs = $obj_model_generel_settings->execute("SELECT", false, "", "");
					$this->app->assign("gs",$rs_gs[0]);
				}
				
				
				if(VIR_DIR=="")
				{
					$url=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
					$new_url=str_replace("https://","",$url);
					$new_url=str_replace("http://","",$new_url);
					$new_url=str_replace("www.","",$new_url);
					$new_url=str_replace("WWW.","",$new_url);
					if (strpos($url, "http://")!==false)
					{
						$this->app->redirect("https://www.".$new_url);
					}
					if (strpos($url, "www")!==false)
					{
					}
					else
					{
						$this->app->redirect("https://www.".$new_url);
					}
					

				mysqli_set_charset($this->app->set_db_conn(),'utf-8');
				
				$obj_model_meta=$this->app->load_model('meta');
				$rs_meta=$obj_model_meta->execute("SELECT",false,"","");
				$this->app->assign("meta", $rs_meta[0]);

				$obj_model_generel_settings=$this->app->load_model('generel_settings');
				$rs_gs=$obj_model_generel_settings->execute("SELECT",false,"","id=1");
				$this->app->assign("gs", $rs_gs[0]);
				
				
				
				
				
				
				// Residental
				$obj_model_all_projects=$this->app->load_model('projects');
				$rs_all_projects_ongoing=$obj_model_all_projects->execute("SELECT",false,"","projects.status='Active' and category_ids='1' and FIND_IN_SET (1,tag_ids)","projects.sort_order ASC");
				$this->app->assign("rs_all_projects_ongoing", $rs_all_projects_ongoing);
				
				
				/*$obj_model_all_projects=$this->app->load_model('projects');
				$rs_all_projects_upcoming=$obj_model_all_projects->execute("SELECT",false,"","projects.status='Active' and category_ids='1' and FIND_IN_SET (2,tag_ids)","projects.id DESC");
				$this->app->assign("rs_all_projects_upcoming", $rs_all_projects_upcoming);
				
				
				$obj_model_all_projects=$this->app->load_model('projects');
				$rs_all_projects_complated=$obj_model_all_projects->execute("SELECT",false,"","projects.status='Active' and category_ids='3' and FIND_IN_SET (3,tag_ids)","projects.id DESC");
				$this->app->assign("rs_all_projects_complated", $rs_all_projects_complated);*/
				
				// Commercial
				
				$obj_model_all_projects=$this->app->load_model('projects');
				$rs_all_projects_ongoing_comm=$obj_model_all_projects->execute("SELECT",false,"","projects.status='Active' and category_ids='2' and FIND_IN_SET (1,tag_ids)","projects.sort_order ASC");
				$this->app->assign("rs_all_projects_ongoing_comm", $rs_all_projects_ongoing_comm);
				
				/*$obj_model_all_projects=$this->app->load_model('projects');
				$rs_all_projects_upcoming_comm=$obj_model_all_projects->execute("SELECT",false,"","projects.status='Active' and category_ids='2' and FIND_IN_SET (2,tag_ids)","projects.id DESC");
				$this->app->assign("rs_all_projects_upcoming_comm", $rs_all_projects_upcoming_comm);
				
				
				$obj_model_all_projects=$this->app->load_model('projects');
				$rs_all_projects_complated_comm=$obj_model_all_projects->execute("SELECT",false,"","projects.status='Active' and category_ids='2' and FIND_IN_SET (3,tag_ids)","projects.id DESC");
				$this->app->assign("rs_all_projects_complated_comm", $rs_all_projects_complated_comm);
				*/
				
				
				
				
				
			
			  }

			  
			}
		}
	}
		/*==================================================================================*/
		/*	DEFINE ALL GLOBAL FUNCTIONS HERE												*/
		/*==================================================================================*/
?>
<?
class _project_addedit extends controller
{

	function init()
	{
	}

	function onload()
	{
		$obj_model_category= $this->app->load_model("category");
		$rs_category = $obj_model_category->execute("SELECT", false,"","status='Active'");
		$records1 = array();
		$records1[''] = " Select";
		for($i=0;$i<count($rs_category);$i++){
		$records1[$rs_category[$i]['id']] = $rs_category[$i]['category_name'];
		}
		$this->assign("cat_data",$records1);
		
		
		
		
		
		
		
		$obj_model_highlights= $this->app->load_model("highlights");
		$rs_highlights=$obj_model_highlights->execute("SELECT", false,"","status='Active'");
		$records2 = array();
		$records2[''] = " Select";
		for($i=0;$i<count($rs_highlights);$i++){
		$records2[$rs_highlights[$i]['id']] = $rs_highlights[$i]['name'];
		}
		
		$this->assign("rs_highlights",$records2);		
		
		
		

		$obj_model_tags= $this->app->load_model("tags");
		$rs_tag = $obj_model_tags->execute("SELECT", false,"","status='Active'");
		$this->assign("rs_tag",$rs_tag);


		

		$id=$this->app->getGetVar('id');
		if($id!='')
		{
			$this->app->assign("manage_for","Edit");
			$this->load_data();
		}
		else
		{
			
			$obj_model_menities_master= $this->app->load_model("amenities_master");
			$rs_amenities_master=$obj_model_menities_master->execute("SELECT", false,"","status='Active'","name ASC");
			$this->assign("rs_amenities_master",$rs_amenities_master);	
				
			$this->app->assign("manage_for","Add");
		}
		$this->app->assign("to_do","Project");
	}
	
	function load_data()
	{
		$id=$this->app->getGetVar('id');
		$obj_model_product = $this->app->load_model("projects", $id);
		$rscat = $obj_model_product->execute("SELECT");
		if(count($rscat)>0)
		{
			$obj_model_projects_info= $this->app->load_model("projects_info");
			$rs_info = $obj_model_projects_info->execute("SELECT",false,"","projects_id='".$rscat[0]['id']."'");

			$this->app->assign_form_data("frm_project_addedit", $rscat[0]);
			$this->app->assign("rscat", $rscat[0]);
			$this->app->assign("rs_info", $rs_info[0]);
			
			
			
			
			
			
			
			if($rs_info[0]['projects_amenities_master_ids']!='')
			{
				
				$obj_model_menities_master1= $this->app->load_model("amenities_master");
				$rs_amenities_master=$obj_model_menities_master1->execute("SELECT", false,"SELECT * FROM `amenities_master` WHERE id>0 and status='Active' ORDER BY FIELD(id, ".$rs_info[0]['projects_amenities_master_ids'].")","","");
				
				
				
				$this->assign("rs_amenities_master",$rs_amenities_master);	
			
			
				
				
				
				
				
				
			
			}
			else
			{
				$obj_model_menities_master= $this->app->load_model("amenities_master");
				$rs_amenities_master=$obj_model_menities_master->execute("SELECT", false,"","status='Active'","name ASC");
				$this->assign("rs_amenities_master",$rs_amenities_master);	
				
			}
			
			
			
			$obj_model_catalogue_price_data= $this->app->load_model("projects_highlights");
			$rs_tab_data = $obj_model_catalogue_price_data->execute("SELECT",false,"","projects_id=".$rscat[0]['id']);
			
			$this->app->assign("rs_tab_data", $rs_tab_data);
			
			
			
		}
		else
		{
			$this->app->redirect("index.php?view=project_list");
		}
	}

	
	function update_data()
	{
		$amenities_master_ids=$this->app->getPostVar('projects_amenities_master_ids1');		
		
		$amenities_master_ids=implode(',',$amenities_master_ids);
		$category_ids=$this->app->getPostVar('category_ids');		
		
		
		$tag_ids=$this->app->getPostVar('tag_ids1');		
		$tag_ids=implode(',',$tag_ids);
		$id=$this->app->getPostVar('id');
		$name=$this->app->getPostVar('name');
		
		
			$final_price_p=$this->app->getPostVar('final_price_p');
			$points_p=$this->app->getPostVar('points_p');
			$table_id=$this->app->getPostVar('table_id');

			$slug=$this->app->getPostVar('slug');
		
		if($id!="")
		{

			$obj_model_projects= $this->app->load_model("projects");
			$result=$obj_model_projects->execute("SELECT",false,"","id!='".$id."' and slug='".$slug."'");

			if(count($result)>0)
			{
				$this->app->utility->set_message("Slug already exists", "ERROR");
				$this->app->redirect("index.php?view=project_addedit&id=".$id);
			}


			//$slug=$this->app->utility->unique_slug('projects','edit','slug',$name,$id);
			$obj_model_record = $this->app->load_model("projects");
			$result=$obj_model_record->execute("SELECT",false,"","id='".$id."'");

			$update_field = array();
			if($result[0]["image"]!=NULL && $_FILES['image']['error'] == 0)
			{
				@unlink('../'.$this->app->get_user_config("project").'/'.$result[0]["image"]);
				@unlink('../'.$this->app->get_user_config("project").'/mediumthumb'.$result[0]["image"]);
				@unlink('../'.$this->app->get_user_config("project").'/thumb'.$result[0]["image"]);
				$update_field['image']='';									
			}	

			if(!empty($_FILES['image']['name']))
			{
				if($result[0]["image"]!=NULL)
				{
					@unlink('../'.$this->app->get_user_config("project").'/'.$result[0]["image"]);
					@unlink('../'.$this->app->get_user_config("project").'/mediumthumb'.$result[0]["image"]);
					@unlink('../'.$this->app->get_user_config("project").'/thumb'.$result[0]["image"]);

				}
				$image=$this->app->utility->resize_single_image($_FILES['image']['name'],$_FILES['image']['tmp_name'],$this->app->get_user_config("project"),'550');	
				$update_field['image']=$image;
			}


			if($result[0]["banner"]!=NULL && $_FILES['banner']['error'] == 0)
			{
				@unlink('../'.$this->app->get_user_config("project").'/'.$result[0]["banner"]);
				@unlink('../'.$this->app->get_user_config("project").'/mediumthumb'.$result[0]["banner"]);
				@unlink('../'.$this->app->get_user_config("project").'/thumb'.$result[0]["banner"]);
				$update_field['banner']='';									
			}

			if(!empty($_FILES['banner']['name']))
			{
				if($result[0]["banner"]!=NULL)
				{
					@unlink('../'.$this->app->get_user_config("project").'/'.$result[0]["banner"]);
					@unlink('../'.$this->app->get_user_config("project").'/mediumthumb'.$result[0]["banner"]);
					@unlink('../'.$this->app->get_user_config("project").'/thumb'.$result[0]["banner"]);

				}
				$banner=$this->app->utility->resize_single_image($_FILES['banner']['name'],$_FILES['banner']['tmp_name'],$this->app->get_user_config("project"),'1490');
				$update_field['banner']=$banner;
			}
			
			if($result[0]["mobile_banner"]!=NULL && $_FILES['mobile_banner']['error'] == 0)
			{
				@unlink('../'.$this->app->get_user_config("project").'/'.$result[0]["mobile_banner"]);
				@unlink('../'.$this->app->get_user_config("project").'/mediumthumb'.$result[0]["mobile_banner"]);
				@unlink('../'.$this->app->get_user_config("project").'/thumb'.$result[0]["mobile_banner"]);
				$update_field['mobile_banner']='';									
			}

			if(!empty($_FILES['mobile_banner']['name']))
			{
				if($result[0]["mobile_banner"]!=NULL)
				{
					@unlink('../'.$this->app->get_user_config("project").'/'.$result[0]["mobile_banner"]);
					@unlink('../'.$this->app->get_user_config("project").'/mediumthumb'.$result[0]["mobile_banner"]);
					@unlink('../'.$this->app->get_user_config("project").'/thumb'.$result[0]["mobile_banner"]);

				}
				$mobile_banner=$this->app->utility->resize_single_image($_FILES['mobile_banner']['name'],$_FILES['mobile_banner']['tmp_name'],$this->app->get_user_config("project"),'767');
				$update_field['mobile_banner']=$mobile_banner;
			}



			//For page Slug
			$update_field['slug'] = $slug;
			$update_field['name'] = $name;
			$update_field['tag_ids'] = $tag_ids;
			$update_field['category_ids'] = $category_ids;
			

			$obj_model_product = $this->app->load_model("projects", $id);
			$obj_model_product->map_fields($update_field);
			if($obj_model_product->execute("UPDATE")>0)
			{	
				$obj_model_projects_info = $this->app->load_model("projects_info");
				$result=$obj_model_projects_info->execute("SELECT",false,"","projects_id='".$id."'");

				$update_field1 = array();
				
				if($result[0]["about_image"]!=NULL && $_FILES['about_image']['error'] == 0)
				{
					@unlink('../'.$this->app->get_user_config("project").'/'.$result[0]["about_image"]);
					@unlink('../'.$this->app->get_user_config("project").'/mediumthumb'.$result[0]["about_image"]);
					@unlink('../'.$this->app->get_user_config("project").'/thumb'.$result[0]["about_image"]);
					$update_field1['about_image']='';									
				}

				if(!empty($_FILES['about_image']['name']))
				{
					if($result[0]["about_image"]!=NULL)
					{
						@unlink('../'.$this->app->get_user_config("project").'/'.$result[0]["about_image"]);
						@unlink('../'.$this->app->get_user_config("project").'/mediumthumb'.$result[0]["about_image"]);
						@unlink('../'.$this->app->get_user_config("project").'/thumb'.$result[0]["about_image"]);

					}
					$about_image=$this->app->utility->resize_single_image($_FILES['about_image']['name'],$_FILES['about_image']['tmp_name'],$this->app->get_user_config("project"),'550');

					$update_field1['about_image']=$about_image;
				}	

				if($result[0]["amenities_bg"]!=NULL && $_FILES['amenities_bg']['error'] == 0)
				{
					@unlink('../'.$this->app->get_user_config("project").'/'.$result[0]["amenities_bg"]);
					@unlink('../'.$this->app->get_user_config("project").'/mediumthumb'.$result[0]["amenities_bg"]);
					@unlink('../'.$this->app->get_user_config("project").'/thumb'.$result[0]["amenities_bg"]);
					$update_field1['amenities_bg']='';									
				}

				if(!empty($_FILES['amenities_bg']['name']))
				{
					if($result[0]["amenities_bg"]!=NULL)
					{
						@unlink('../'.$this->app->get_user_config("project").'/'.$result[0]["amenities_bg"]);
						@unlink('../'.$this->app->get_user_config("project").'/mediumthumb'.$result[0]["amenities_bg"]);
						@unlink('../'.$this->app->get_user_config("project").'/thumb'.$result[0]["amenities_bg"]);

					}
					$amenities_bg=$this->app->utility->resize_single_image($_FILES['amenities_bg']['name'],$_FILES['amenities_bg']['tmp_name'],$this->app->get_user_config("project"),'1920');

					$update_field1['amenities_bg']=$amenities_bg;
				}	

				if($result[0]["amenities_image"]!=NULL && $_FILES['amenities_image']['error'] == 0)
				{
					@unlink('../'.$this->app->get_user_config("project").'/'.$result[0]["amenities_image"]);
					@unlink('../'.$this->app->get_user_config("project").'/mediumthumb'.$result[0]["amenities_image"]);
					@unlink('../'.$this->app->get_user_config("project").'/thumb'.$result[0]["amenities_image"]);
					$update_field1['amenities_image']='';									
				}

				if(!empty($_FILES['amenities_image']['name']))
				{
					if($result[0]["amenities_image"]!=NULL)
					{
						@unlink('../'.$this->app->get_user_config("project").'/'.$result[0]["amenities_image"]);
						@unlink('../'.$this->app->get_user_config("project").'/mediumthumb'.$result[0]["amenities_image"]);
						@unlink('../'.$this->app->get_user_config("project").'/thumb'.$result[0]["amenities_image"]);

					}
					$amenities_image=$this->app->utility->resize_single_image($_FILES['amenities_image']['name'],$_FILES['amenities_image']['tmp_name'],$this->app->get_user_config("project"),'2400');

					$update_field1['amenities_image']=$amenities_image;
				}	

				if($result[0]["floor_img"]!=NULL && $_FILES['floor_img']['error'] == 0)
				{
					@unlink('../'.$this->app->get_user_config("project").'/'.$result[0]["floor_img"]);
					@unlink('../'.$this->app->get_user_config("project").'/mediumthumb'.$result[0]["floor_img"]);
					@unlink('../'.$this->app->get_user_config("project").'/thumb'.$result[0]["floor_img"]);
					$update_field1['floor_img']='';									
				}
				
				if(!empty($_FILES['floor_img']['name']))
				{
					if($result[0]["floor_img"]!=NULL)
					{
						@unlink('../'.$this->app->get_user_config("project").'/'.$result[0]["floor_img"]);
						@unlink('../'.$this->app->get_user_config("project").'/mediumthumb'.$result[0]["floor_img"]);
						@unlink('../'.$this->app->get_user_config("project").'/thumb'.$result[0]["floor_img"]);

					}
					$floor_img=$this->app->utility->resize_single_image($_FILES['floor_img']['name'],$_FILES['floor_img']['tmp_name'],$this->app->get_user_config("project"),'840');

					$update_field1['floor_img']=$floor_img;
				}


				if(!empty($_FILES['floor_link2_file']['name']))
				{
					$floor_link2_file=$this->app->utility->FileUpload([filename=>$_FILES['floor_link2_file']['name'],filetmpname=>$_FILES['floor_link2_file']['tmp_name'],folder=>"project"]);
					$update_field1["floor_link2_file"] = $floor_link2_file;
				}


				if(!empty($_FILES['floor_link2_icon']['name']))
				{
					$floor_link2_icon=$this->app->utility->FileUpload([filename=>$_FILES['floor_link2_icon']['name'],filetmpname=>$_FILES['floor_link2_icon']['tmp_name'],folder=>"project"]);
					$update_field1["floor_link2_icon"] = $floor_link2_icon;
				}


				if(!empty($_FILES['floor_link1_file']['name']))
				{
					$floor_link1_file=$this->app->utility->FileUpload([filename=>$_FILES['floor_link1_file']['name'],filetmpname=>$_FILES['floor_link1_file']['tmp_name'],folder=>"project"]);
					$update_field1["floor_link1_file"] = $floor_link1_file;
				}


				if(!empty($_FILES['floor_link1_icon']['name']))
				{
					$floor_link1_icon=$this->app->utility->FileUpload([filename=>$_FILES['floor_link1_icon']['name'],filetmpname=>$_FILES['floor_link1_icon']['tmp_name'],folder=>"project"]);
					$update_field1["floor_link1_icon"] = $floor_link1_icon;
				}

				$update_field1['projects_amenities_master_ids'] = $amenities_master_ids;
				$obj_model_projects_info= $this->app->load_model("projects_info");
				$obj_model_projects_info->map_fields($update_field1);
				$obj_model_projects_info->execute("UPDATE",false,"","projects_id='".$id."'");
				
				
				
				
				
				
				
				for($i=0;$i<count($final_price_p);$i++)
				{
					if($final_price_p[$i]!='' && $points_p[$i]!='')
					{
						$update_field = array();	
						$update_field["projects_id"]=$id;							
						$update_field["highlights_id"] = $final_price_p[$i];
						$update_field["value_data"] = $points_p[$i];
						$obj_catalogue_price_data= $this->app->load_model("projects_highlights");
						$obj_catalogue_price_data->map_fields($update_field);
						
						
						if($table_id[$i]>0)
						{
							$rs=$obj_catalogue_price_data->execute("UPDATE",false,"","id='".$table_id[$i]."'");
							
						}
						else
						{
							$rs=$obj_catalogue_price_data->execute("INSERT",false,"");
							
						}
						
					}
				}
				
				
				
				
				
				
				
			
				$this->app->utility->set_message("Project updated successfully", "SUCCESS");
				$this->app->redirect("index.php?view=project_list");
			}
			else
			{
				$this->app->utility->set_message("Ooops... There was a problem in update project records", "ERROR");
				$this->app->redirect("index.php?view=project_list");
			}
		}
		else
		{
			$obj_model_projects= $this->app->load_model("projects");
			$result=$obj_model_projects->execute("SELECT",false,"","slug='".$slug."'");

			if(count($result)>0)
			{
				$this->app->utility->set_message("Slug already exists", "ERROR");
				$this->app->redirect("index.php?view=project_addedit");
			}

			//INSERT RECORDS
			//$slug=$this->app->utility->unique_slug('projects','add','slug',$name);
			$update_field = array();
			if(!empty($_FILES['image']['name']))
			{
				$image=$this->app->utility->resize_single_image($_FILES['image']['name'],$_FILES['image']['tmp_name'],$this->app->get_user_config("project").'/'.$folder.'/','550');
				$update_field["image"] = $image;
			}

			if(!empty($_FILES['banner']['name']))
			{
				$banner=$this->app->utility->resize_single_image($_FILES['banner']['name'],$_FILES['banner']['tmp_name'],$this->app->get_user_config("project").'/'.$folder.'/','1490');
				$update_field["banner"] = $banner;
			}
			
			
			if(!empty($_FILES['mobile_banner']['name']))
			{
				
				
				$mobile_banner=$this->app->utility->resize_single_image($_FILES['mobile_banner']['name'],$_FILES['mobile_banner']['tmp_name'],$this->app->get_user_config("project"),'767');
				$update_field['mobile_banner']=$mobile_banner;
			}

			$update_field['name'] = $name;
			$update_field['status'] = 'Active';
			$update_field['added_date'] = date('d-m-Y H:i:s');
			$update_field['slug'] = $slug;
			$update_field['tag_ids'] = $tag_ids;
			$update_field['category_ids'] = $category_ids;

			$obj_model_product = $this->app->load_model("projects");
			$obj_model_product->map_fields($update_field);
			$ins=$obj_model_product->execute("INSERT");
			if($ins>0)
			{
				$update_field1 = array();
				if(!empty($_FILES['about_image']['name']))
				{
					$about_image=$this->app->utility->resize_single_image($_FILES['about_image']['name'],$_FILES['about_image']['tmp_name'],$this->app->get_user_config("project").'/'.$folder.'/','550');
					$update_field1["about_image"] = $about_image;
				}

				if(!empty($_FILES['amenities_bg']['name']))
				{
					$amenities_bg=$this->app->utility->resize_single_image($_FILES['amenities_bg']['name'],$_FILES['amenities_bg']['tmp_name'],$this->app->get_user_config("project").'/'.$folder.'/','1920');
					$update_field1["amenities_bg"] = $amenities_bg;
				}

				if(!empty($_FILES['amenities_image']['name']))
				{
					$amenities_image=$this->app->utility->resize_single_image($_FILES['amenities_image']['name'],$_FILES['amenities_image']['tmp_name'],$this->app->get_user_config("project").'/'.$folder.'/','2400');
					$update_field1["amenities_image"] = $amenities_image;
				}

				if(!empty($_FILES['floor_img']['name']))
				{
					$floor_img=$this->app->utility->resize_single_image($_FILES['floor_img']['name'],$_FILES['floor_img']['tmp_name'],$this->app->get_user_config("project").'/'.$folder.'/','840');
					$update_field1["floor_img"] = $floor_img;
				}

				if(!empty($_FILES['floor_link2_file']['name']))
				{
					$floor_link2_file=$this->app->utility->FileUpload([filename=>$_FILES['floor_link2_file']['name'],filetmpname=>$_FILES['floor_link2_file']['tmp_name'],folder=>"project"]);
					$update_field1["floor_link2_file"] = $floor_link2_file;
				}


				if(!empty($_FILES['floor_link2_icon']['name']))
				{
					$floor_link2_icon=$this->app->utility->FileUpload([filename=>$_FILES['floor_link2_icon']['name'],filetmpname=>$_FILES['floor_link2_icon']['tmp_name'],folder=>"project"]);
					$update_field1["floor_link2_icon"] = $floor_link2_icon;
				}


				if(!empty($_FILES['floor_link1_file']['name']))
				{
					$floor_link1_file=$this->app->utility->FileUpload([filename=>$_FILES['floor_link1_file']['name'],filetmpname=>$_FILES['floor_link1_file']['tmp_name'],folder=>"project"]);
					$update_field1["floor_link1_file"] = $floor_link1_file;
				}


				if(!empty($_FILES['floor_link1_icon']['name']))
				{
					$floor_link1_icon=$this->app->utility->FileUpload([filename=>$_FILES['floor_link1_icon']['name'],filetmpname=>$_FILES['floor_link1_icon']['tmp_name'],folder=>"project"]);
					$update_field1["floor_link1_icon"] = $floor_link1_icon;
				}

				$update_field1['projects_id'] = $ins;
				$update_field1['projects_amenities_master_ids'] = $amenities_master_ids;

				$obj_model_projects_info= $this->app->load_model("projects_info");
				$obj_model_projects_info->map_fields($update_field1);
				$obj_model_projects_info->execute("INSERT");
				
				
				
				
				
			
				
				for($i=0;$i<count($final_price_p);$i++)
				{
					if($final_price_p[$i]!='' && $points_p[$i]!='')
					{
						$update_field = array();	
						$update_field["projects_id"]=$ins;							
						$update_field["highlights_id"] = $final_price_p[$i];
						$update_field["value_data"] = $points_p[$i];
						$obj_catalogue_price_data= $this->app->load_model("projects_highlights");
						$obj_catalogue_price_data->map_fields($update_field);
						$rs=$obj_catalogue_price_data->execute("INSERT",false,"");
						
					}
				}
				
				
				
				
				
				

				$this->app->utility->set_message("Project added successfully", "SUCCESS");
				$this->app->redirect("index.php?view=project_list");
			}
			else
			{
				$this->app->utility->set_message("Try Again.", "ERROR");
				$this->app->redirect("index.php?view=project_list");
			}
		}
	}
}
?>
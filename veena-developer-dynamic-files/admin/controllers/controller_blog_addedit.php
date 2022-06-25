<?
class _blog_addedit extends controller
{

	function init()
	{
	}

	function onload()
	{
		
		
		
		$obj_model_category= $this->app->load_model("blog_category");
		$rs_category = $obj_model_category->execute("SELECT", false,"","status='Active'");
		$records1 = array();
		$records1[''] = " Select";
		for($i=0;$i<count($rs_category);$i++){
		$records1[$rs_category[$i]['id']] = $rs_category[$i]['name'];
		}
		$this->assign("cat_data",$records1);
		

		$id=$this->app->getGetVar('id');
		if($id!='')
		{
			$this->app->assign("manage_for","Edit");
			$this->load_data();
		}
		else
		{
			
			
			
			
			$obj_model_menities_master= $this->app->load_model("blog_tag");
			$rs_amenities_master=$obj_model_menities_master->execute("SELECT", false,"","status='Active'","name ASC");
			$this->assign("rs_amenities_master",$rs_amenities_master);	
			
			
			
			
			
			
			$this->app->assign("manage_for","Add");
		}
		$this->app->assign("to_do","Blog");
	}
	
	function load_data()
	{
		$id=$this->app->getGetVar('id');
		$obj_model_product = $this->app->load_model("blog", $id);
		$rscat = $obj_model_product->execute("SELECT");
		if(count($rscat)>0)
		{
			
			
			
			if($rscat[0]['tag_ids']!='')
			{
				
				$obj_model_menities_master1= $this->app->load_model("blog_tag");
				$rs_amenities_master=$obj_model_menities_master1->execute("SELECT", false,"SELECT * FROM `blog_tag` WHERE id>0 and status='Active' ORDER BY FIELD(id, ".$rscat[0]['tag_ids'].")","","");
				
				
				
				$this->assign("rs_amenities_master",$rs_amenities_master);	
			
			
				
				
				
				
				
				
			
			}
			else
			{
				$obj_model_menities_master= $this->app->load_model("blog_tag");
				$rs_amenities_master=$obj_model_menities_master->execute("SELECT", false,"","status='Active'","name ASC");
				$this->assign("rs_amenities_master",$rs_amenities_master);	
				
			}
			

			$this->app->assign_form_data("frm_project_addedit", $rscat[0]);
			$this->app->assign("rscat", $rscat[0]);
			$this->app->assign("rs_info", $rs_info[0]);
			
			
		}
		else
		{
			$this->app->redirect("index.php?view=blog_list");
		}
	}

	
	function update_data()
	{
		
		$amenities_master_ids=$this->app->getPostVar('projects_amenities_master_ids1');		
		
		$tag_ids=implode(',',$amenities_master_ids);
		$title=$this->app->getPostVar('title');		
		
		
		
		$slug=$this->app->getPostVar('slug');	
	
		$id=$this->app->getPostVar('id');		
		
		
		
		if($id>0)
		{
			$idCond=" and id!='".$id."'";	
			
		}
		else
		{
			$idCond="";	
		}
		
		
		$obj_model_check= $this->app->load_model("blog");
		$rs_check = $obj_model_check->execute("SELECT",false,"","slug='".$slug."' ".$idCond."");
		
		if(count($rs_check)>0)
		{
			
			$this->app->utility->set_message("Duplicate Slug Found!", "ERROR");
			$this->app->redirect("index.php?view=blog_addedit&id=".$id);
			exit;
			
			
		}
		
		
		
		if($id!="")
		{
			
			
			$obj_model_last_data = $this->app->load_model("blog", $id);
			$result = $obj_model_last_data->execute("SELECT");
			
			
			
			
			

			$update_field = array();
			
			
			if($result[0]["image"]!=NULL && $_FILES['image']['error'] == 0)
			{
				@unlink('../'.$this->app->get_user_config("blog").'/'.$result[0]["image"]);
				@unlink('../'.$this->app->get_user_config("blog").'/mediumthumb'.$result[0]["image"]);
				@unlink('../'.$this->app->get_user_config("blog").'/thumb'.$result[0]["image"]);
				$update_field['image']='';									
			}
			
			if(!empty($_FILES['image']['name']))
			{
				
				$image=$this->app->utility->resize_single_image($_FILES['image']['name'],$_FILES['image']['tmp_name'],$this->app->get_user_config("blog"),'550');	
				$update_field['image']=$image;
			}
	
			
			if($result[0]["detail_image"]!=NULL && $_FILES['detail_image']['error'] == 0)
			{
				@unlink('../'.$this->app->get_user_config("blog").'/'.$result[0]["detail_image"]);
				@unlink('../'.$this->app->get_user_config("blog").'/mediumthumb'.$result[0]["detail_image"]);
				@unlink('../'.$this->app->get_user_config("blog").'/thumb'.$result[0]["detail_image"]);
				$update_field['detail_image']='';									
			}
			
			if(!empty($_FILES['detail_image']['name']))
			{
				
				$detail_image=$this->app->utility->resize_single_image($_FILES['detail_image']['name'],$_FILES['detail_image']['tmp_name'],$this->app->get_user_config("blog"),'1920');	
				$update_field['detail_image']=$detail_image;
			}
			
			
			$update_field['title'] = $title;
			$update_field['tag_ids'] = $tag_ids;
			
			


			$obj_model_product = $this->app->load_model("blog", $id);
			$obj_model_product->map_fields($update_field);
			if($obj_model_product->execute("UPDATE")>0)
			{	
				
				
				
				
				
			
				$this->app->utility->set_message("Blog Records updated successfully", "SUCCESS");
				$this->app->redirect("index.php?view=blog_list");
			}
			else
			{
				$this->app->utility->set_message("Ooops... There was a problem in update records", "ERROR");
				$this->app->redirect("index.php?view=blog_list");
			}
		}
		else
		{
			//INSERT RECORDS
			
			
			$update_field = array();
			
			if(!empty($_FILES['image']['name']))
			{
				
				$image=$this->app->utility->resize_single_image($_FILES['image']['name'],$_FILES['image']['tmp_name'],$this->app->get_user_config("blog"),'550');	
				$update_field['image']=$image;
			}
			
			if(!empty($_FILES['detail_image']['name']))
			{
				
				$detail_image=$this->app->utility->resize_single_image($_FILES['detail_image']['name'],$_FILES['detail_image']['tmp_name'],$this->app->get_user_config("blog"),'1920');	
				$update_field['detail_image']=$detail_image;
			}
			
			
			$update_field['title'] = $title;
			$update_field['tag_ids'] = $tag_ids;
			
		
			
			$obj_model_product = $this->app->load_model("blog");
			$obj_model_product->map_fields($update_field);
			$ins=$obj_model_product->execute("INSERT");
			if($ins>0)
			{
				
				

				$this->app->utility->set_message("Blog Records added successfull", "SUCCESS");
				$this->app->redirect("index.php?view=blog_list");
			}
			else
			{
				$this->app->utility->set_message("Try Again.", "ERROR");
				$this->app->redirect("index.php?view=blog_list");
			}
		}
	}
}
?>
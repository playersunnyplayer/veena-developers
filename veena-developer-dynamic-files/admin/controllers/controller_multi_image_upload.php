<?php
class _multi_image_upload extends controller
{
	function init()
	{
		if($this->app->getCurrentAction()=="")
		{
			$this->load_data();
		}
	}

	function onload()
	{
	}	
		
	function load_data()
	{
		
		$product_id=$this->app->getGetVar('product_id');
		
		
		$obj_model_products= $this->app->load_model("csr_category");
		$rs_product= $obj_model_products->execute("SELECT", false,"","csr_category.id='".$product_id."'");
		$this->assign("rs_product",$rs_product[0]);
		
		if(count($rs_product)<=0)
		{
			$this->app->redirect("index.php?view=csr_category_list");	
			exit;
		}
		
		
		
	}	
	

}	
?>
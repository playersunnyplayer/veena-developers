<?php
	class model_projects{
		public $fields= array();
		public $nullable= array();
		public $default_value= array();
		public $ID= 0;
		public $KEY= "";

		function model_projects($ID=0){
			$this->ID = $ID;
			$this->KEY = "id";
			$this->fields["id"]="int(11)";
			$this->nullable["id"]="NO";
			$this->default_value["id"]="";
			$this->fields["category_ids"]="varchar(255)";
			$this->nullable["category_ids"]="NO";
			$this->default_value["category_ids"]="";
			$this->fields["tag_ids"]="varchar(255)";
			$this->nullable["tag_ids"]="NO";
			$this->default_value["tag_ids"]="";
			$this->fields["name"]="varchar(255)";
			$this->nullable["name"]="NO";
			$this->default_value["name"]="";
			$this->fields["slug"]="varchar(255)";
			$this->nullable["slug"]="NO";
			$this->default_value["slug"]="";
			$this->fields["subtitle"]="varchar(255)";
			$this->nullable["subtitle"]="NO";
			$this->default_value["subtitle"]="";
			$this->fields["rera_reg_no"]="varchar(500)";
			$this->nullable["rera_reg_no"]="NO";
			$this->default_value["rera_reg_no"]="";
			$this->fields["image"]="varchar(255)";
			$this->nullable["image"]="NO";
			$this->default_value["image"]="";
			$this->fields["banner"]="varchar(255)";
			$this->nullable["banner"]="NO";
			$this->default_value["banner"]="";
			$this->fields["mobile_banner"]="varchar(255)";
			$this->nullable["mobile_banner"]="NO";
			$this->default_value["mobile_banner"]="";
			$this->fields["micro_web"]="text";
			$this->nullable["micro_web"]="NO";
			$this->default_value["micro_web"]="";
			$this->fields["email"]="varchar(255)";
			$this->nullable["email"]="NO";
			$this->default_value["email"]="";
			$this->fields["phone"]="varchar(255)";
			$this->nullable["phone"]="NO";
			$this->default_value["phone"]="";
			$this->fields["status"]="enum('Active','Inactive')";
			$this->nullable["status"]="NO";
			$this->default_value["status"]="Active";
			$this->fields["sort_order"]="int(11)";
			$this->nullable["sort_order"]="NO";
			$this->default_value["sort_order"]="";
			$this->fields["added_date"]="varchar(255)";
			$this->nullable["added_date"]="NO";
			$this->default_value["added_date"]="";
		}
	}
?>
<?php
	class model_projects_gallery{
		public $fields= array();
		public $nullable= array();
		public $default_value= array();
		public $ID= 0;
		public $KEY= "";

		function model_projects_gallery($ID=0){
			$this->ID = $ID;
			$this->KEY = "id";
			$this->fields["id"]="int(11)";
			$this->nullable["id"]="NO";
			$this->default_value["id"]="";
			$this->fields["projects_id"]="int(11)";
			$this->nullable["projects_id"]="NO";
			$this->default_value["projects_id"]="";
			$this->fields["projects_gallery_category_id"]="int(11)";
			$this->nullable["projects_gallery_category_id"]="NO";
			$this->default_value["projects_gallery_category_id"]="";
			$this->fields["title"]="varchar(255)";
			$this->nullable["title"]="NO";
			$this->default_value["title"]="";
			$this->fields["image"]="varchar(255)";
			$this->nullable["image"]="NO";
			$this->default_value["image"]="";
			$this->fields["sort_id"]="int(11)";
			$this->nullable["sort_id"]="NO";
			$this->default_value["sort_id"]="";
			$this->fields["status"]="enum('Active','Inactive')";
			$this->nullable["status"]="NO";
			$this->default_value["status"]="Active";
		}
	}
?>
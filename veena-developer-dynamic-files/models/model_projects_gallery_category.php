<?php
	class model_projects_gallery_category{
		public $fields= array();
		public $nullable= array();
		public $default_value= array();
		public $ID= 0;
		public $KEY= "";

		function model_projects_gallery_category($ID=0){
			$this->ID = $ID;
			$this->KEY = "id";
			$this->fields["id"]="int(11)";
			$this->nullable["id"]="NO";
			$this->default_value["id"]="";
			$this->fields["name"]="varchar(255)";
			$this->nullable["name"]="NO";
			$this->default_value["name"]="";
			$this->fields["heading"]="text";
			$this->nullable["heading"]="NO";
			$this->default_value["heading"]="";
			$this->fields["sort_id"]="int(11)";
			$this->nullable["sort_id"]="NO";
			$this->default_value["sort_id"]="";
			$this->fields["status"]="enum('Active','Inactive','Trash')";
			$this->nullable["status"]="NO";
			$this->default_value["status"]="Active";
		}
	}
?>
<?php
	class model_category{
		public $fields= array();
		public $nullable= array();
		public $default_value= array();
		public $ID= 0;
		public $KEY= "";

		function model_category($ID=0){
			$this->ID = $ID;
			$this->KEY = "id";
			$this->fields["id"]="int(11)";
			$this->nullable["id"]="NO";
			$this->default_value["id"]="";
			$this->fields["category_name"]="varchar(500)";
			$this->nullable["category_name"]="NO";
			$this->default_value["category_name"]="";
			$this->fields["category_slug"]="varchar(255)";
			$this->nullable["category_slug"]="NO";
			$this->default_value["category_slug"]="";
			$this->fields["sort_order"]="int(11)";
			$this->nullable["sort_order"]="NO";
			$this->default_value["sort_order"]="";
			$this->fields["meta_keyword"]="varchar(255)";
			$this->nullable["meta_keyword"]="NO";
			$this->default_value["meta_keyword"]="";
			$this->fields["meta_description"]="varchar(255)";
			$this->nullable["meta_description"]="NO";
			$this->default_value["meta_description"]="";
			$this->fields["status"]="enum('Inactive','Active')";
			$this->nullable["status"]="NO";
			$this->default_value["status"]="Inactive";
			$this->fields["meta_title"]="varchar(255)";
			$this->nullable["meta_title"]="NO";
			$this->default_value["meta_title"]="";
			$this->fields["chat_code"]="text";
			$this->nullable["chat_code"]="NO";
			$this->default_value["chat_code"]="";
		}
	}
?>
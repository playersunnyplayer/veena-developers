<?php
	class model_tags{
		public $fields= array();
		public $nullable= array();
		public $default_value= array();
		public $ID= 0;
		public $KEY= "";

		function model_tags($ID=0){
			$this->ID = $ID;
			$this->KEY = "id";
			$this->fields["id"]="int(11)";
			$this->nullable["id"]="NO";
			$this->default_value["id"]="";
			$this->fields["name"]="varchar(255)";
			$this->nullable["name"]="NO";
			$this->default_value["name"]="";
			$this->fields["status"]="enum('Active','Inactive')";
			$this->nullable["status"]="NO";
			$this->default_value["status"]="Active";
			$this->fields["sort_order"]="int(11)";
			$this->nullable["sort_order"]="NO";
			$this->default_value["sort_order"]="";
		}
	}
?>
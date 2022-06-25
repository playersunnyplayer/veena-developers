<?php
	class model_project_enquiry{
		public $fields= array();
		public $nullable= array();
		public $default_value= array();
		public $ID= 0;
		public $KEY= "";

		function model_project_enquiry($ID=0){
			$this->ID = $ID;
			$this->KEY = "id";
			$this->fields["id"]="int(11)";
			$this->nullable["id"]="NO";
			$this->default_value["id"]="";
			$this->fields["data_type"]="varchar(100)";
			$this->nullable["data_type"]="NO";
			$this->default_value["data_type"]="";
			$this->fields["data_value"]="varchar(100)";
			$this->nullable["data_value"]="NO";
			$this->default_value["data_value"]="";
			$this->fields["project_id"]="int(11)";
			$this->nullable["project_id"]="NO";
			$this->default_value["project_id"]="";
			$this->fields["name"]="varchar(255)";
			$this->nullable["name"]="NO";
			$this->default_value["name"]="";
			$this->fields["email"]="varchar(255)";
			$this->nullable["email"]="NO";
			$this->default_value["email"]="";
			$this->fields["phone"]="varchar(255)";
			$this->nullable["phone"]="NO";
			$this->default_value["phone"]="";
			$this->fields["msg"]="text";
			$this->nullable["msg"]="NO";
			$this->default_value["msg"]="";
			$this->fields["added_date"]="varchar(255)";
			$this->nullable["added_date"]="NO";
			$this->default_value["added_date"]="";
			$this->fields["ip"]="varchar(255)";
			$this->nullable["ip"]="NO";
			$this->default_value["ip"]="";
		}
	}
?>
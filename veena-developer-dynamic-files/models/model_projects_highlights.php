<?php
	class model_projects_highlights{
		public $fields= array();
		public $nullable= array();
		public $default_value= array();
		public $ID= 0;
		public $KEY= "";

		function model_projects_highlights($ID=0){
			$this->ID = $ID;
			$this->KEY = "id";
			$this->fields["id"]="int(11)";
			$this->nullable["id"]="NO";
			$this->default_value["id"]="";
			$this->fields["highlights_id"]="int(11)";
			$this->nullable["highlights_id"]="NO";
			$this->default_value["highlights_id"]="";
			$this->fields["projects_id"]="int(11)";
			$this->nullable["projects_id"]="NO";
			$this->default_value["projects_id"]="";
			$this->fields["value_data"]="varchar(100)";
			$this->nullable["value_data"]="NO";
			$this->default_value["value_data"]="";
			$this->fields["sort_id"]="int(11)";
			$this->nullable["sort_id"]="NO";
			$this->default_value["sort_id"]="";
			$this->fields["status"]="enum('Active','Inactive')";
			$this->nullable["status"]="NO";
			$this->default_value["status"]="Active";
		}
	}
?>
<?php
	class model_career_jobs{
		public $fields= array();
		public $nullable= array();
		public $default_value= array();
		public $ID= 0;
		public $KEY= "";

		function model_career_jobs($ID=0){
			$this->ID = $ID;
			$this->KEY = "id";
			$this->fields["id"]="int(11)";
			$this->nullable["id"]="NO";
			$this->default_value["id"]="";
			$this->fields["title"]="varchar(255)";
			$this->nullable["title"]="NO";
			$this->default_value["title"]="";
			$this->fields["experience"]="varchar(255)";
			$this->nullable["experience"]="NO";
			$this->default_value["experience"]="";
			$this->fields["qualification"]="varchar(255)";
			$this->nullable["qualification"]="NO";
			$this->default_value["qualification"]="";
			$this->fields["sort_id"]="int(11)";
			$this->nullable["sort_id"]="NO";
			$this->default_value["sort_id"]="";
			$this->fields["status"]="enum('Active','Inactive','Trash')";
			$this->nullable["status"]="NO";
			$this->default_value["status"]="Active";
		}
	}
?>
<?php
class plan {
	private $db;
	function __construct() {
		include 'model/plan.php';
		$this->db = new ModelPlan;
	}
	public function GetPlan(){
		echo json_encode($this->db->GetPlan());
	}
}
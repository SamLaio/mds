<?php
class plan {
	private $db;
	function __construct() {
		include 'model/plan.php';
		$this->db = new ModelPlan;
	}
	public function GetFlow(){
		echo json_encode($this->db->GetFlow());
	}
	public function GetPlan(){
		echo json_encode($this->db->GetPlan());
	}
	public function PlanAdd($arr=false){
		if(isset($arr['post'])){
			$arr = $arr['post'];
			/*
				PlanAddSeq
				PlanAddDate
				PlanAddEarnings
			*/
			foreach($arr as $key => $value){
				$key = explode('PlanAdd',$key);
				$key = strtolower($key[1]);
				$tmp[$key] = $value;
			}
			// print_r($tmp);exit;
			$this->db->PlanAdd($tmp);
		}
	}
}
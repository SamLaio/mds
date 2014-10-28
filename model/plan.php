<?php
class ModelPlan  extends LibDataBase {
	private $PlanTable;
	function __construct() {
		parent::__construct();
		$this->table = 'flow';
		$this->PlanTable = 'plan';
	}
	public function GetPlan(/*$arr*/){
		/*
		Earnings
		Loss
		*/
		
		$flow = $this->Assoc($this->table,'*','','in_date asc'/*,implode(' and ',$this->ValAddTip($arr))*/);
		
		$plan = $this->Assoc($this->PlanTable,'*','','in_date asc'/*,implode(' and ',$this->ValAddTip($arr))*/);
		// print_r($plan);exit;
		foreach($flow as $fV){
		}
		
		return $re;
	}
}
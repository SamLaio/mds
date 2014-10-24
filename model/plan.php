<?php
class ModelPlan  extends LibDataBase {
	private $PlanTable;
	function __construct() {
		parent::__construct();
		$this->table = 'flow';
		$this->PlanTable = 'plan';
	}
	public function GetPlan($arr){
		/*
		Earnings
		Loss
		*/
		$flow = $this->Assoc($this->table,'*',implode(' and ',parent::ValAddTip($arr['where'])));
	}
}
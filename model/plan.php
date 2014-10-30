<?php
class ModelPlan  extends LibDataBase {
	private $PlanTable;
	function __construct() {
		parent::__construct();
		$this->table = 'flow';
		$this->PlanTable = 'plan';
	}
	public function GetFlow(/*$arr*/){
		$flow = $this->Assoc($this->table,'*',"user_id = '".$_SESSION['UserId']."'",'in_date asc');
		$plan = $this->Assoc($this->PlanTable,'*',"user_id = '".$_SESSION['UserId']."'",'in_date asc');
		$count = 0;
		foreach($flow as $fK => $fV){
			$add = '-';
			$de = '-';
			if($fV['type'] == '+'){
				$add = $fV['amount'];
				$count += $add;
			}else{
				$de = $fV['amount'];
				$count -= $de;
			}
			$re[] = array('seq'=>$fV['seq'],'date'=>$fV['in_date'],'add'=>(int) $add,'de'=>(int) $de,'count'=>(int) $count,'earnings'=>'');
		}
		$tmp = '';
		foreach($plan as $pK=>$pV){
			foreach($re as $rK => $rV){
				if($rV['date'] <= $pV['in_date'] and $re[$rK]['earnings'] == ''){
					$re[$rK]['earnings'] = $pV['earnings'];
				}
			}
		}
		return $re;
	}
	public function GetPlan(){
		$re = $this->Assoc($this->PlanTable,'*','','in_date asc');
		foreach($re as $key => $value){
			$re[$key]['date'] = $value['in_date'];
			unset($re[$key]['in_date']);
		}
		return $re;
	}
	public function PlanAdd($arr){
		if($arr['seq'] != ''){
			$seq = $arr['seq'];
			unset($arr['seq']);
			$arr['in_date'] = $arr['date'];
			unset($arr['date']);
			$sql = $this->Up($this->PlanTable,$arr,"seq = '$seq'");
		}else{
			unset($arr['seq']);
			$arr['in_date'] = $arr['date'];
			unset($arr['date']);
			$arr['user_id']=$_SESSION['UserId'];
			$sql = $this->In($this->PlanTable, $arr);
		}
		echo $sql;
		$this->Query($sql);
	}
}
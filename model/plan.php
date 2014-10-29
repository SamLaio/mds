<?php
class ModelPlan  extends LibDataBase {
	private $PlanTable;
	function __construct() {
		parent::__construct();
		$this->table = 'flow';
		$this->PlanTable = 'plan';
	}
	public function GetPlan(/*$arr*/){
		$flow = $this->Assoc($this->table,'*',"user_id = '".$_SESSION['UserId']."'",'in_date asc');
		$plan = $this->Assoc($this->PlanTable,'*',"user_id = '".$_SESSION['UserId']."'",'in_date asc');
		$count = 0;
		if(count($plan) >= 1){
			foreach($flow as $fK => $fV){
				$add = '';
				$de = '';
				if($fV['type'] == '+'){
					$add = $fV['amount'];
					$count += $add;
				}else{
					$de = $fV['amount'];
					$count -= $de;
				}
				$re[] = array('date'=>$fV['in_date'],'add'=>(int) $add,'de'=>(int) $de,'count'=>(int) $count,'earnings'=>'');
			}
			$tmp = '';
			foreach($plan as $pK=>$pV){
				foreach($re as $rK => $rV){
					if($rV['date'] < $pV['in_date']){
						$tmp .= ($tmp !='')?",".$rK:$rK;
					}else{
						foreach(explode(',',$tmp) as $tV){
							$re[$tV]['earnings'] = $pV['earnings'];
						}
						$tmp = '';
					}
				}
			}
			/*foreach($plan as $pK=>$pV){
				$re[] = array('date'=>$pV['in_date'],'add'=>123123123123,'de'=>123123123123,'count'=>'','earnings'=>(int) $pV['earnings']);
			}
			array_multisort($re);
			$tmp = '';
			$count = 0;
			foreach($re as $rK => $rV){
				if($rV['add'] == $rV['de'] and $rV['add'] == 123123123123){
					foreach(explode(',',$tmp) as $tV)
						$re[$tV]['earnings'] = $rV['earnings'];
					$re[$rK]['add'] = '';
					$re[$rK]['de'] = '';
					$re[$rK]['count'] = $count;
					$tmp = '';
				}else{
					$tmp .= ($tmp !='')?",".$rK:$rK;
					$count = $rV['count'];
				}
			}*/
		}else{
			foreach($flow as $fK => $fV){
				$add = '';
				$de = '';
				if($fV['type'] == '+'){
					$add = $fV['amount'];
					$count += $add;
				}else{
					$de = $fV['amount'];
					$count -= $de;
				}
				$re[] = array('date'=>$fV['in_date'],'add'=>$add,'de'=>$de,'earnings'=>'','count'=>$count);
			}
		}
		// print_r($re);
		return $re;
	}
}
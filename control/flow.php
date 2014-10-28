<?php
class flow {
	function __construct() {
		include 'model/flow.php';
		$this->db = new ModelFlow;
	}
	public function GetFlow($arr=false){
		if($arr){
			$arr = $arr['post'];
			if(isset($arr['s_date']) and $arr['s_date'] != 'All')
				$where[] = "in_date >= '".$arr['s_date']."'";
			if(isset($arr['e_date']) and $arr['e_date'] != 'All')
				$where[] = "in_date <= '".$arr['e_date']."'";
			$where[] = "user_id = '".$_SESSION['UserId']."'";
			echo json_encode($this->db->GetFlow($where));
		}
	}
	public function AddFlow($arr=false){
		if($arr){
			$arr = $arr['post'];
			$tmp;
			foreach($arr as $key => $value){
				$key = explode('FlowAdd',$key);
				$key = strtolower($key[1]);
				$tmp[$key] = $value;
			}
			$tmp['in_date'] = $tmp['date'];
			unset($tmp['date']);
			$arr = $tmp;
			unset($tmp);
			$this->db->AddFlow($arr);
		}
	}
	public function DelFlow($arr=false){
		if($arr){
			$arr = $arr['post']['seq'];
			//DELETE FROM [TABLE NAME] WHERE 條件;
			if($arr != '')
				$this->db->DelFlow($arr);
		}
	}
}
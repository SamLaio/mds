<?php
class flow {
	private $UserTable;
	function __construct() {
		include 'model/flow.php';
		$this->db = new ModelFlow;
		$this->table = 'flow';
		$this->UserTable = 'user';
	}
	public function GetFlow($arr){
		$arr = $arr['post'];
		$where = '';
		if(isset($arr['s_date']) and $arr['s_date'] != 'All')
			$where .= ($where != '')? " and in_date >= '".$arr['s_date']."'":"in_date >= '".$arr['s_date']."'";
		if(isset($arr['e_date']) and $arr['e_date'] != 'All'){
			$arr['e_date'] = explode('-',$arr['e_date']);
			$arr['e_date'][2] = $arr['e_date'][2] +1;
			$arr['e_date'][1] = ($arr['e_date'][1] < 10)?'0'.$arr['e_date'][1]:$arr['e_date'][1];
			$arr['e_date'][2] = ($arr['e_date'][2] < 10)?'0'.$arr['e_date'][2]:$arr['e_date'][2];
			$arr['e_date'] = implode('-',$arr['e_date']);
			$where .= ($where != '')? " and in_date < '".$arr['e_date']."'":"in_date < '".$arr['e_date']."'";
		}
		$where = ($where != '')? "user_id = '".$_SESSION['UserId']."' and ".$where:"user_id = '".$_SESSION['UserId']."'";
		$re = $this->db->Assoc($this->table,'*', $where,'in_date desc');
		$accName = $this->db->Assoc($this->UserTable,'*');
		foreach($re as $key =>$value){
			foreach($accName as $nameV)
				$re[$key]['user_id'] = ($nameV['seq'] == $value['user_id'])? $nameV['name']:'unfind';
		}
		echo json_encode($re);
	}
	public function AddFlow($arr){
		$arr = $arr['post'];
		$arr = array_values($arr);
		$arr[] = $_SESSION['UserId'];
		echo $this->db->In($this->table,array("in_date","type","amount","note","user_id"),$arr);
		$this->db->Query($this->db->In($this->table,array("in_date","type","amount","note","user_id"),$arr));
	}
}
<?php
class ModelIndex  extends LibDataBase {
	private $UserTable;
	function __construct() {
		parent::__construct();
		$this->UserTable = 'user';
		$this->table = 'flow';
	}
	public function GetFlow($arr){
		$arr['group'] = $this->GroupOut(explode(',',$arr['group']));
		foreach($arr['group'] as $value){
			$group[] = $value['seq'];
		}
		unset($arr['group']);
		$group[] = $_SESSION['UserId'];
		$arr[] = "user_id in (" . implode(',',parent::ValAddTip($group)).')';
		$arr = implode(' and ', $arr);
		// print_r($arr);exit;
		$re = $this->Assoc($this->table,'*', $arr,'in_date desc');
		$accName = $this->Assoc($this->UserTable,'*');
		foreach($re as $key =>$value){
			foreach($accName as $nameV)
				$re[$key]['user_id'] = ($nameV['seq'] == $value['user_id'])? $nameV['name']:'unfind';
		}
		return $re;
	}
	public function GroupOut($arr){
		$arr = 'token in ('.implode(',',parent::ValAddTip($arr)).')';
		//print_r($this->Assoc($this->UserTable,array('name','token'), $arr));
		return $this->Assoc($this->UserTable,array('seq','name','token'), $arr);
	}
}
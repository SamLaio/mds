<?php
class ModelFlow  extends LibDataBase {
	private $UserTable;
	function __construct() {
		parent::__construct();
		$this->table = 'flow';
		$this->UserTable = 'user';
	}
	public function GetFlow($arr){
		$arr = implode(' and ', $arr);
		$re = $this->Assoc($this->table,'*', $arr,'in_date desc');
		$accName = $this->Assoc($this->UserTable,'*');
		foreach($re as $key =>$value){
			foreach($accName as $nameV)
				$re[$key]['user_id'] = ($nameV['seq'] == $value['user_id'])? $nameV['name']:'unfind';
		}
		return $re;
	}
	public function AddFlow($arr){
		if($arr['seq'] != ''){
			$tmp = $arr['seq'];
			unset($arr['seq']);
			$arr = $this->Up($this->table,$arr,"seq = '".$tmp."'");
		}else{
			$arr['user_id'] = $_SESSION['UserId'];
			unset($arr['seq']);
			$arr = $this->In($this->table,$arr);
		}
		$this->Query($arr);
	}
	public function DelFlow($arr){
		$this->Query($this->Del($this->table,"seq = '$arr'"));
	}
}
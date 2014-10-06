<?php
class ModelLogin extends LibDataBase {

	function __construct() {
		parent::__construct();
	}
	public function UserCk($arr){
		$account = $this->Assoc('user','*',"account = '".$arr['post']['account']."' and pswd = '".md5($arr['post']['pswd'])."'");
		if($this->count == 0)
			return false;
		else
			return $account[0];
		//print_r($account);
		//print_r($arr);
	}
}
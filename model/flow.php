<?php
class ModelFlow  extends LibDataBase {
	private $db;
	function __construct() {
		parent::__construct();
	}
	public function FlowShow($arr){
	
	}
	public function FlowAdd($arr){
		$arr = json_decode($arr['post']);
		$val = array();
		$fold = '';
		foreach($arr as $arrV){
			$arrV['user_id'] = $_SESSION['UserId'];
			$fold = $this->addTip($arrV);
			$val[] = '('.implode(',',$fold['val']).')';
			$fold = implode(',',$fold['fold']);
		}
		$val = implode(',',$val);
		echo $fold;
		echo $val;
	}
	private function addTip($arr){
		$ret = array();
		foreach($arr as $key => $val){
			$ret['fold'][] = "'$key'";
			$ret['val'][] = "'$val'";
		}
		return $ret;
	}
}
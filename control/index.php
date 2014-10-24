<?php
class index {
	private $db;
	function __construct() {
		include 'model/index.php';
		$this->db = new ModelIndex;
	}
	public function GetFlow($arr=false){
		if($arr['post']){
			$arr = $arr['post'];
			$where = array();
			$where['group'] = $arr['group'];
			if($arr['s_date'] != 'All')
				$where[] = "in_date >= '".$arr['s_date']."'";
			if($arr['e_date'] != 'All')
				$where[] = "in_date <= '".$arr['e_date']."'";
			echo json_encode($this->db->GetFlow($where));
		}
	}
	public function GroupOut($arr=false){
		if($arr['post']['group']){
			$group = explode(',',$arr['post']['group']);
		}else{
			$group = ($_SESSION['group']!='')?explode(',',$_SESSION['group']):array();
			$group[] = $_SESSION['token'];
		}
		$arr = array();
		foreach($this->db->GroupOut($group) as $value){
			$arr[] = array('name'=>$value['name'], 'token'=>$value['token']);
		}
		echo json_encode($arr);
	}	
}
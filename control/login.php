<?php
class login {
	private $db;
	function __construct() {
		include 'model/login.php';
		$this->db = new ModelLogin;
		//echo 'login';
	}
	
	public function UserCk($arr){
		$account = $this->db->UserCk('user','*',"account = '".$arr['post']['account']."' and pswd = '".md5($arr['post']['pswd'])."'");
		if($account){
			if($account['status'] == 1){
				$_SESSION['UserId'] = $account['seq'];
				$_SESSION['UserName'] = $account['name'];
			}
		}else{
			
		}
	}
}
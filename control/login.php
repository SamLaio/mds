<?php
class login {
	private $db;
	function __construct() {
		include 'model/login.php';
		$this->db = new ModelLogin;

	}
	
	public function UserCk($arr){
		$account = $this->db->UserCk($arr);
		if($account){
			//print_r($account);
			if($account['status'] == 1){
				$_SESSION['UserId'] = $account['seq'];
				$_SESSION['UserName'] = $account['name'];
				echo 1;
			}else{
				echo 2;
			}
		}else{
			echo 0;
		}
	}
	
	public function Logout(){
		unset($_SESSION['UserId']);
		unset($_SESSION['UserName']);
	}
}
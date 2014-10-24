<?php
class login {
	private $db;
	function __construct() {
		include 'model/login.php';
		$this->db = new ModelLogin;
	}
	
	public function UserCk($arr){
		$arr = $arr['post'];
		$account = $this->db->UserCk($arr);
		if($account){
			//print_r($account);
			if($account['status'] == 1){
				$_SESSION['UserId'] = $account['seq'];
				$_SESSION['UserName'] = $account['name'];
				$_SESSION['group'] = $account['group'];
				$_SESSION['token'] = $account['token'];
				if($account['admin'] == 1)
					$_SESSION['admin'] = 1;
				
				unset($_SESSION['PwEnCode']);
				unset($_SESSION['PwHand']);
				unset($_SESSION['CaptchaArr']);
				unset($_SESSION['CaptchaPw']);
				unset($_SESSION['DePwHand']);
				unset($_SESSION['DePwEnCode']);
				
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
		unset($_SESSION['group']);
		unset($_SESSION['admin']);
		echo 1;
	}
	
	/*public function UserTokenCk($arr){
		$arr = $arr['post'];
		if(isset($arr['Token']
	}*/
}
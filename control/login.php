<?php
class login {
	private $db;
	public $SiteName;
	function __construct() {
		include 'model/login.php';
		$this->db = new ModelLogin;
		$this->SiteName='登入';
	}
	
	public function UserCk($arr){
		$arr = $arr['post'];
		$account = $this->db->UserCk($arr);
		if($account){
			//print_r($account);
			if($account['status'] == 1){
				$_SESSION['UserId'] = $account['seq'];
				$_SESSION['UserName'] = $account['name'];
				
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
		echo 1;
	}
	
	/*public function UserTokenCk($arr){
		$arr = $arr['post'];
		if(isset($arr['Token']
	}*/
}
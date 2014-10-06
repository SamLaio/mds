<?php
class index {
	private $db;
	private $login;
	function __construct() {
		if(isset($_SESSION['UserId'])){
			include 'model/index.php';
			$this->db = new ModelIndex;
		}else{
			$_SESSION['UrlTo'] = 'login';
		}
	}

	public function error($id = false) {
		
	}

}
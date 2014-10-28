<?php
class install {
	private $installObj;
	function __construct() {
		if(file_exists('lib/Config.php')){
			include 'lib/Config.php';
			if(isset($DbType)){
				unset($_SESSION['SiteName']);
				unset($_SESSION['SiteUrl']);
				unset($_SESSION['SiteLang']);
				echo '<script>history.back(1);</script>';
				exit;
			}
		}else{
			$_SESSION['SiteName'] = 'MyMVC';
		}
	}
	public function Lang(){
		$ret = array();
		//print_r(SCANDIR('view/lang'));
		foreach(SCANDIR('view/lang') as $value){
			if (substr($value, 0, strrpos($value, ".js")))
				$ret[]['lang'] = substr($value, 0, strrpos($value, "."));
		}
		echo json_encode($ret);
	}
	public function St1($arr){
		$arr = $arr['post'];
		//all
		if(isset($arr['DbType']) and $arr['DbType'] != '')
			$str = '$'."DbType = '".$arr['DbType']."';\n";
		if(isset($arr['DbName']) and $arr['DbName'] != ''){
			if($arr['DbType'] != 'sqlite')
				$str .= '$'."DbName = '".$arr['DbName']."';\n";
			else
				$str .= '$'."DbName = 'model/".$arr['DbName']."';\n";
		}
		//all
		//mysql
		if(isset($arr['DbHost']) and $arr['DbHost'] != '')
			$str .= '$'."DbHost = '".$arr['DbHost']."';\n";
		if(isset($arr['DbAdName']) and $arr['DbAdName'] != '')
			$str .= '$'."DbUser = '".$arr['DbAdName']."';\n";
		if(isset($arr['DbAdPw']) and $arr['DbAdPw'] != '')
			$str .= '$'."DbPw = '".$arr['DbAdPw']."';\n";
		//mysql
		if(isset($arr['DbType']))
			define('DbType', $arr['DbType']);
		if(isset($arr['DbHost']))
			define('DbHost', $arr['DbHost']);
		if(isset($arr['DbAdName']))
			define('DbUser', $arr['DbAdName']);
		if(isset($arr['DbAdPw']))
			define('DbPw', $arr['DbAdPw']);
		if(isset($arr['DbName'])){
			if(DbType == 'sqlite')
				define('DbName', 'model/'.$arr['DbName']);
			else
				define('DbName', $arr['DbName']);
		}
		$str = "<?php\n".$str;
		$fp = fopen('lib/Config.php','w+');
		fwrite($fp,$str);
		fclose($fp);
		include 'model/install.php';
		$this->installObj = new InstallModel;
		$this->installObj->St1(array('AdName'=>$arr['AdName'],'AdPw'=>$arr['AdPw'],'SiteName'=>$arr['SiteName'],'SiteUrl'=>$arr['SiteUrl'],'SiteLang'=>$arr['SiteLang']));
		unset($_SESSION);
	}
}
<?php
class js {
	function __construct($obj=false) {
		if($obj){
			if($obj == 'LibJs')
				$obj = "lib/js/LibJs.php";
			if($obj == 'Jquery')
				$obj = 'lib/js/jquery.min.js';
			if($obj == 'JqueryUI')
				$obj = 'lib/js/jquery-ui.js';
			if($obj == 'JqueryDataTables')
				$obj = 'lib/js/jquery.dataTables.js';
			if($obj == 'Lang'){
				$obj = "view/lang/".$_SESSION['SiteLang'].".js";
			}
			include $obj;
		}else{
			echo 'error';
		}
		/*
		[0] => jquery-ui.js
		[1] => jquery-ui.min.js
		[2] => jquery.dataTables.js
		[3] => jquery.min.js
		*/
	}
}
?>
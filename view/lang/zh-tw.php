<?php
	$strLang=array(
		'account'=>array('type'=>'def','val'=>'帳號:'),
		'password'=>array('type'=>'def','val'=>'密碼:'),
		'captcha'=>array('type'=>'def','val'=>'驗證碼:'),
		'submit'=>array('type'=>'input','val'=>'送出'),
		
		'goIndex'=>array('type'=>'def','val'=>'首頁'),
		'login'=>array('type'=>'def','val'=>'登入'),
		'logout'=>array('type'=>'def','val'=>'登出')
	);
?>
$(window).ready(function(){
<?php
	foreach($strLang as $key => $value){
		if($value['type'] == 'def')
			$tmp = 'html';
		if($value['type'] == 'input')
			$tmp = 'val';
		echo "\tif($('.Lang_$key').length > 0) $('.Lang_$key').$tmp('".$value['val']."');\n";
	}
?>
});
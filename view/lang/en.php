<?php
	$strLang=array(
		'InstallInfo'=>array('type'=>'def','val'=>'Install Info'),
		'AdminName'=>array('type'=>'def','val'=>'Administrator Name:'),
		'AdminPw'=>array('type'=>'def','val'=>'Administrator Password:'),
		'SiteName'=>array('type'=>'def','val'=>'Site Name:'),
		'SiteUrl'=>array('type'=>'def','val'=>'Site Url:'),
		'SiteLang'=>array('type'=>'def','val'=>'Site Language:'),
		'DbType'=>array('type'=>'def','val'=>'DataBase Type:'),
		'DbName'=>array('type'=>'def','val'=>'DataBase Name:'),
		'DbHost'=>array('type'=>'def','val'=>'DataBase Link:'),
		'DbAdame'=>array('type'=>'def','val'=>'DataBase Administrator Name:'),
		'DbAdPw'=>array('type'=>'def','val'=>'DataBase Administrator Password:'),
		
		'account'=>array('type'=>'def','val'=>'Account:'),
		'password'=>array('type'=>'def','val'=>'Password:'),
		'captcha'=>array('type'=>'def','val'=>'Captcha:'),
		'ReLoadCapthcha'=>array('type'=>'def','val'=>'ReLoadCapthchaImg'),
		'submit'=>array('type'=>'input','val'=>'Submit'),
		
		'flow'=>array('type'=>'def','val'=>'Flow'),
		'plan'=>array('type'=>'def','val'=>'Plan'),
		'goIndex'=>array('type'=>'def','val'=>'Index'),
		'login'=>array('type'=>'def','val'=>'Login'),
		'logout'=>array('type'=>'def','val'=>'Logout'),
		
		'StartDate'=>array('type'=>'def','val'=>'StartDate:'),
		'EndDate'=>array('type'=>'def','val'=>'EndDate:')
	);
?>
var datepickerLang;
var alert_sub;
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
	alert_sub = {
		'Login':{
			'StNull':'Any Info is NULL!!',
			'StError':'Info is ERROR!!',
			'CaptchaNull':'Captcha is NULL or Error!!'
		}
	};
	datepickerLang={
				showMonthAfterYear:true,
				dateFormat:"yy-mm-dd"
			};
});
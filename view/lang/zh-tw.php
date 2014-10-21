<?php
	$strLang=array(
		'InstallInfo'=>array('type'=>'def','val'=>'安裝設定'),
		'AdminName'=>array('type'=>'def','val'=>'管理員帳號:'),
		'AdminPw'=>array('type'=>'def','val'=>'管理員密碼:'),
		'SiteName'=>array('type'=>'def','val'=>'網站名稱:'),
		'SiteUrl'=>array('type'=>'def','val'=>'網站網址:'),
		'SiteLang'=>array('type'=>'def','val'=>'網站語言:'),
		'DbType'=>array('type'=>'def','val'=>'資料庫類型:'),
		'DbName'=>array('type'=>'def','val'=>'資料庫名稱:'),
		'DbHost'=>array('type'=>'def','val'=>'資料庫連線:'),
		'DbAdame'=>array('type'=>'def','val'=>'資料庫管理員帳號:'),
		'DbAdPw'=>array('type'=>'def','val'=>'資料庫管理員密碼:'),
		
		'account'=>array('type'=>'def','val'=>'帳號:'),
		'password'=>array('type'=>'def','val'=>'密碼:'),
		'captcha'=>array('type'=>'def','val'=>'驗證碼:'),
		'ReLoadCapthcha'=>array('type'=>'def','val'=>'刷新圖片'),
		//'Loain'=>array('type'=>'def','val'=>'刷新圖片'),
		'submit'=>array('type'=>'input','val'=>'送出'),
		
		'flow'=>array('type'=>'def','val'=>'新增'),
		'plan'=>array('type'=>'def','val'=>'計劃'),
		'goIndex'=>array('type'=>'def','val'=>'首頁'),
		'login'=>array('type'=>'def','val'=>'登入'),
		'logout'=>array('type'=>'def','val'=>'登出'),
		
		'StartDate'=>array('type'=>'def','val'=>'開始日期:'),
		'EndDate'=>array('type'=>'def','val'=>'結束日期:')
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
			'StNull':'資料不齊!!',
			'StError':'資料錯誤!!',
			'CaptchaNull':'驗證碼空白或錯誤!!'
			
		}
	};
	datepickerLang={
				dayNames:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
				dayNamesMin:["日","一","二","三","四","五","六"],
				monthNames:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
				monthNamesShort:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
				prevText:"上月",
				nextText:"次月",
				weekHeader:"週",
				showMonthAfterYear:true,
				dateFormat:"yy-mm-dd"
			};
});
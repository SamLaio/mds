<?php
class Load extends LibDataBase {
	function __construct() {
		parent::__construct();
		$re = $this->Assoc('site','*');
		$_SESSION['SiteName'] = $re[0]['name'];
		$_SESSION['SiteUrl'] = $re[0]['url'];
		$_SESSION['SiteLang'] = $re[0]['lang'];
	}
}
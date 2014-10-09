<?php
if(!isset($_SESSION))
	session_start();
include_once 'lib/LibBoot.php';
include_once 'lib/LibDataBase.php';
if(!file_exists('lib/Config.php') and !strpos($_SERVER['REQUEST_URI'],'install')){
	header('Location: install');
}else if(file_exists('lib/Config.php')){
	if(strpos($_SERVER['REQUEST_URI'],'install'))
		header('Location: index');
	include 'lib/config.php';
	if(isset($DbType))
		define('DbType', $DbType);
	if(isset($DbHost))
		define('DbHost', $DbHost);
	if(isset($DbUser))
		define('DbUser', $DbUser);
	if(isset($DbPw))
		define('DbPw', $DbPw);
	if(isset($DbName))
		define('DbName', $DbName);
	//echo DbName;
	if(!isset($_SESSION['SiteName']) or !isset($_SESSION['SiteUrl'])){
		include 'model/load.php';
		$Load = new Load;
	}
}
/*
 					$this->dbhost = $DbHost;
					$this->dbuser = $DbUser;
					$this->dbpass = $DbPw;
					$this->dbname = $DbName;
 */
//echo $_SERVER['REQUEST_URI'];
$boot = new LibBoot(explode('/', $_SERVER['REQUEST_URI']));

<?php
class InstallModel extends LibDataBase {
	function __construct() {
		parent::__construct();
	}
	public function St1($arr){
		if($this->dbtype == 'mysql'){
			$this->Query("CREATE DATABASE IF NOT EXISTS `$this->dbname` /*!40100 DEFAULT CHARACTER SET latin1 */;");
			$this->Query("USE `$this->dbname`;");
			$this->Query("CREATE TABLE `user` (
				`seq` int(11) NOT NULL AUTO_INCREMENT,
				`account` text NOT NULL,
				`pswd` text NOT NULL,
				`name` text,
				`token` text,
				`token_date` varchar(20),
				`old_token` text,
				`group` text,
				`status` int(11) NOT NULL DEFAULT '1', 
				`admin` int(11) NOT NULL DEFAULT '0',
				PRIMARY KEY (`seq`)
			) ENGINE=MyISAM DEFAULT CHARSET=latin1;");
			$this->Query("CREATE TABLE `flow` (
				`seq` int(11) NOT NULL AUTO_INCREMENT,
				`user_id` int(11) NOT NULL,
				`note` text,
				`type` varchar(2) NOT NULL,
				`amount` text NOT NULL,
				`in_date` text,
				`in_date` varchar(20) NOT NULL DEFAULT '1',
				PRIMARY KEY (`seq`)
			) ENGINE=MyISAM DEFAULT CHARSET=latin1;");
			$this->Query("CREATE TABLE `plan` (
				`seq` int(11) NOT NULL AUTO_INCREMENT,
				`user_id` int(11) NOT NULL,
				`note` text,
				`type` varchar(2) NOT NULL,
				`amount` text NOT NULL,
				`in_date` text,
				`in_date` varchar(20) NOT NULL DEFAULT '1',
				PRIMARY KEY (`seq`)
			) ENGINE=MyISAM DEFAULT CHARSET=latin1;");
			$this->Query("CREATE TABLE `site` (
				`account` TEXT NOT NULL,
				`url` TEXT NOT NULL,
				`lang` TEXT NOT NULL
			)COLLATE='latin1_swedish_ci' ENGINE=MyISAM;");
		}elseif($this->dbtype=='sqlite'){
			$this->Query("CREATE TABLE [user] (
				[seq] INTEGER  PRIMARY KEY NOT NULL,
				[account] TEXT  NOT NULL,
				[pswd] TEXT  NOT NULL,
				[name] TEXT  NOT NULL,
				[token] TEXT  NULL,
				[token_date] VARCHAR(20)  NULL,
				[old_token] TEXT  NULL,
				[group] TEXT NULL,
				[status] INTEGER DEFAULT '1' NOT NULL,
				[admin] INTEGER DEFAULT '0' NOT NULL
			);");
			$this->Query("CREATE TABLE [flow] (
				[seq] INTEGER  PRIMARY KEY AUTOINCREMENT NOT NULL,
				[user_id] INTEGER  NOT NULL,
				[note] TEXT  NULL,
				[type] VARCHAR(2)  NOT NULL,
				[amount] TEXT DEFAULT '0' NOT NULL,
				[in_date] VARCHAR(20)  NOT NULL
			);");
			$this->Query("CREATE TABLE [plan] (
				[seq] INTEGER  PRIMARY KEY AUTOINCREMENT NOT NULL,
				[user_id] INTEGER  NOT NULL,
				[note] TEXT  NULL,
				[type] VARCHAR(2)  NOT NULL,
				[amount] TEXT DEFAULT '0' NOT NULL,
				[in_date] VARCHAR(20)  NOT NULL
			);");
			$this->Query('CREATE TABLE [site] (
				[name] text  NOT NULL,
				[url] text  NULL,
			[lang] text  NULL)');
		}
		$tokenDate = date('Y-m-d H:i:s');
		$this->Query($this->In('user', 
			array(
				'account'=>$arr['AdName'],
				'pswd'=>md5($arr['AdPw']),
				'name'=>'Admin',
				'token'=>md5($arr['AdName'].$tokenDate.$arr['AdPw']),
				'token_date'=>$tokenDate,
				'old_token'=>md5($arr['AdName'].$tokenDate.$arr['AdPw']),
				'admin'=>'1'
			)
		));
		$this->Query($this->In('site', array('name'=>$arr['SiteName'],'url'=>$arr['SiteUrl'],'lang'=>$arr['SiteLang'])));
		return true;
	}
}
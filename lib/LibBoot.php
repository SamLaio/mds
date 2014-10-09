<?php

class LibBoot {
	function __construct($url) {
		if(isset($url[2]) and $url[2] != '' and $url[2] == 'cgi'){
			$url[2] = $url[3];
			$url[3] = $url[4];
		}
		$view = (isset($url[2]) and $url[2] != '') ? $this->FileCk(SCANDIR('view'), $url[2]) : 'index';
		$control = (isset($url[2]) and $url[2] != '') ? $this->FileCk(SCANDIR('control'), $url[2]) : 'index';
		if($view == $control and $view == 'error'){
			
		}
		if(isset($_SESSION['PwHand'])){
			$_SESSION['DePwHand'] = $_SESSION['PwHand'];
		}
		if(isset($_SESSION['PwEnCode'])){
			$_SESSION['DePwEnCode'] = $_SESSION['PwEnCode'];
		}
		if(count($_GET) != 0)
			$data['get'] = $this->InDataCk($_GET);
		if(count($_POST) != 0)
			$data['post'] = $this->InDataCk($_POST);
		
		include "control/$control.php";
		$ControlObj = new $control;
		$PageData = false;
		if (isset($url[3]) and $url[3] != '') {
			$url[3] = explode('?', $url[3]);
			$url[3] = $url[3][0];
			if (method_exists($ControlObj, $url[3])) {
				if (count($_GET) != 0 or count($_POST) != 0){
					$PageData=$ControlObj->{$url[3]}($data);
				}else{
					$PageData=$ControlObj->{$url[3]}();
				}
			}
		}
		if($view == $control and !(isset($data['get']['cgi']) or isset($url[4]))){
			$view = array('page'=>$view,'data'=>$PageData);
			include "view/View.php";
			$ViewObj = new View($view);
		}
		if(isset($_SESSION['DePwEnCode'])){
			unset($_SESSION['DePwEnCode']);
		}
		if(isset($_SESSION['DePwHand'])){
			unset($_SESSION['DePwHand']);
		}
	}

	private function FileCk($arr, $file_name) {
		$ret = 'error';
		//print_r($arr);
		foreach ($arr as $value) {
			if (substr($value, 0, strrpos($value, ".")) == $file_name)
				$ret = $file_name;
		}
		return $ret;
	}

	private function InDataCk($arr) {
		$data = [];
		foreach ($arr as $key => $value) {
			if(isset($_SESSION['DePwHand']) and stristr($value,$_SESSION['DePwHand'])){
				$value = $this->PwDeCode(str_replace($_SESSION['DePwHand'],'',$value));
			}
			$data[$key] = $this->CheckInput($value);
		}
		return $data;
	}

	private function CheckInput($value) {
		if (is_array($value)) {
			foreach ($value as $key2 => $value2)
				$value[$key2] = $this->CheckInput($value2);
		} else {
			$value = str_replace(["&", "'", '"', "<", ">"], ['@&5', '@&1', '@&2', '@&3', '@&4'], $value);
		}
		return $value;
	}
	public function PwDeCode($str){
		$tmp = '';
		$arr = $_SESSION['DePwEnCode'];
		$str = explode('*|*', $str);
		foreach($str as $val){
			foreach($arr as $arr_v){
				if(urldecode($arr_v['val']) == urldecode($val)){
					$tmp .= urldecode($arr_v['id']);
				}
			}
		}
		return $tmp;
	}
}
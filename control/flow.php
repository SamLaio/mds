<?php
class flow {
	function __construct() {
		include 'model/flow.php';
		$this->db = new ModelFlow;
	}
}
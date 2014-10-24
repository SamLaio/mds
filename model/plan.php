<?php
class ModelPlan  extends LibDataBase {
	private $UserTable;
	function __construct() {
		parent::__construct();
		$this->table = 'flow';
	}
}
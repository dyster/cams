<?php

namespace cams\controllers;

use cams\models\acos;

class AcosController extends \lithium\action\Controller {

	public function index() {
		$acos = aco::all();
		return compact('acos');
	}

	
}

?>
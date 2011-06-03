<?php

namespace cams\controllers;
use cams\models\Types;

class TypesController extends \lithium\action\Controller {

	public function index() {
		$types = Types::all();
		
		return compact('types');
	}
	
	public function view($typeID) {
		
		$type = Types::first($typeID);
		return compact('type');
	}
}

?>
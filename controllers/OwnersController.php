<?php

namespace cams\controllers;
use cams\models\Owners;
use cams\models\Objects;

class OwnersController extends \lithium\action\Controller {

	public function index() {
		$owners = Owners::all();
		
		return compact('owners');
	}
	
	public function view($ownerID) {
		
		$owner = Owners::first($ownerID);
		$objects = Objects::all(array('conditions' => array('owner_id' => $owner->id, 'active' => 1), 'order' => 'name ASC'));
		return compact('owner', 'objects');
	}
}

?>
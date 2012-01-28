<?php

namespace cams\controllers;

use cams\models\Circuits;
use cams\models\Objects;
use lithium\action\DispatchException;

class CircuitsController extends \lithium\action\Controller {

	public function index() {
		$circuits = Circuits::all();
		$objects = Objects::find('all', array('limit' => 10));
		return compact('circuits', 'objects');
	}

	public function view() {
		$circuit = Circuits::first($this->request->id);
		return compact('circuit');
	}

	public function add() {
		$circuit = Circuits::create();

		if (($this->request->data) && $circuit->save($this->request->data)) {
			$this->redirect(array('Circuits::view', 'args' => array($circuit->id)));
		}
		return compact('circuit');
	}

	public function edit() {
		$circuit = Circuits::find($this->request->id);

		if (!$circuit) {
			$this->redirect('Circuits::index');
		}
		if (($this->request->data) && $circuit->save($this->request->data)) {
			$this->redirect(array('Circuits::view', 'args' => array($circuit->id)));
		}
		return compact('circuit');
	}

	public function delete() {
		if (!$this->request->is('post') && !$this->request->is('delete')) {
			$msg = "Circuits::delete can only be called with http:post or http:delete.";
			throw new DispatchException($msg);
		}
		Circuits::find($this->request->id)->delete();
		$this->redirect('Circuits::index');
	}
}

?>
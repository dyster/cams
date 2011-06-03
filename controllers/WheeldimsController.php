<?php

namespace cams\controllers;

use cams\models\Wheeldim;

class WheeldimsController extends \lithium\action\Controller {

	public function index() {
		$wheeldims = Wheeldim::all();
		return compact('wheeldims');
	}

	public function view($wheeldimId) {
		$wheeldim = Wheeldim::first($wheeldimId);
		return compact('wheeldim');
	}

	public function add() {
		$wheeldim = Wheeldim::create();

		if (($this->request->data) && $wheeldim->save($this->request->data)) {
			$this->redirect(array('Wheeldims::view', 'args' => array($wheeldim->id)));
		}
		return compact('wheeldim');
	}

	public function edit() {
		$wheeldim = Wheeldim::find($this->request->id);

		if (!$wheeldim) {
			$this->redirect('Wheeldims::index');
		}
		if (($this->request->data) && $wheeldim->save($this->request->data)) {
			$this->redirect(array('Wheeldims::view', 'args' => array($wheeldim->id)));
		}
		return compact('wheeldim');
	}
}

?>
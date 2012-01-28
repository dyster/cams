<?php

namespace cams\controllers;

use cams\models\Usershifts;
use lithium\action\DispatchException;

class UsershiftsController extends \lithium\action\Controller {

	public function index() {
		$usershifts = Usershifts::all();
		return compact('usershifts');
	}

	public function view($id) {
		$usershift = Usershifts::first($id);
		return compact('usershift');
	}

	public function add() {
		$usershift = Usershifts::create();

		if (($this->request->data) && $userShift->save($this->request->data)) {
			return $this->redirect(array('Usershifts::view', 'args' => array($usershift->id)));
		}
		return compact('usershift');
	}

	public function edit($id) {
		$usershift = Usershifts::find($id);

		if (!$usershift) {
			return $this->redirect('Usershifts::index');
		}
		if (($this->request->data) && $userShift->save($this->request->data)) {
			return $this->redirect(array('UserShifts::view', 'args' => array($id)));
		}
		return compact('usershift');
	}

	public function delete() {
		if (!$this->request->is('post') && !$this->request->is('delete')) {
			$msg = "Usershifts::delete can only be called with http:post or http:delete.";
			throw new DispatchException($msg);
		}
		Usershifts::find($this->request->id)->delete();
		return $this->redirect('Usershifts::index');
	}
}

?>
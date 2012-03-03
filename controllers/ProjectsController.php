<?php

namespace cams\controllers;

use cams\models\Projects;
use cams\models\Objects;
use cams\models\Owners;
use lithium\action\DispatchException;
use li3_flash_message\extensions\storage\FlashMessage;

class ProjectsController extends \lithium\action\Controller {

	public function index() {
		$projects = Projects::all(array('order' => array('id' => 'DESC')));
		return compact('projects');
	}

	public function kiosk() {
		$projects = Projects::all(array('order' => array('id' => 'DESC')));
		$this->set(compact('projects'));
		return $this->render(array('layout' => 'kiosk'));
	}

	public function view($id) {
		$project = Projects::first($id, array('with' => array('Owners', 'Objects', 'Users')));
		return compact('project');
	}

	public function add() {
		if( $this->request->is('ajax') ) {
			$this->_render['layout'] = false;
		}
		$project = Projects::create($this->request->data);
		//$objects = Objects::all();
		//$owners = Owners::all();
		if($this->request->data)
		{
			if( Projects::first(array('conditions' => array('project_nr' => $this->request->data['project_nr']))))
			{
				FlashMessage::Write('Projektet finns redan', array('class' => 'fail'));
				goto end;
			}
			elseif($project->save($this->request->data))
			{
				return $this->redirect(array('Projects::index'));
			}

		}
		end:
		return compact('project', 'objects', 'owners');
	}

	public function edit($id) {
		$project = Projects::find($id);
		if (($this->request->data) && $project->save($this->request->data)) {
			return $this->redirect(array('Projects::index'));
		}
		return compact('project');
	}

	public function delete($id) {
		Projects::find($id)->delete();
		return $this->redirect('Projects::index');
	}
}

?>

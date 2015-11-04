<?php

namespace cams\controllers;
use cams\models\Objects;
use cams\models\Types;
use cams\models\Owners;
use cams\models\Damages;
use li3_flash_message\extensions\storage\FlashMessage;
use lithium\Storage\Session;

class ObjectsController extends \lithium\action\Controller {

	public function index($a = 20, $b = 20) {
		$objects = Objects::find('all', array('order' => 'id DESC', 'limit' => $b));
		$prio1s = Damages::find('all', array('conditions' => array('prio' => 1, 'active' => 1), 'order' => 'created DESC', 'limit' => $a)); // , 'fields' => array('object_id')
		$prios = array();
		foreach($prio1s as $dam)
		{
			if(!in_array($dam->object_id, $prios))
				$prios[] = $dam->object_id;
		}
		$prios = array_unique($prios);
		foreach($prios as $prio)
			$prioobjects[] = Objects::first(array('conditions' => array('id' => $prio)));
		
		return compact('objects', 'prioobjects');
	}

    public function groups() {
        $temp = Objects::all(array('fields' => array('group')));
        foreach($temp as $t)
            !empty($t->group) ? $groupnames[] = $t->group : null;
        $groupnames = array_unique($groupnames);
        foreach($groupnames as $t)
        {
            $groups[$t] = Objects::all(array('conditions' => array('group' => $t)));
        }
        $groups['Ogrupperade'] = Objects::all(array('conditions' => array('group' => '')));

        return compact('groups');
    }
	
	public function view($objectID) {
		
		$object = Objects::find($objectID);
		$damages = $object->getDamages();
		$owner = $object->getOwner();
		$type = $object->getType();
		
		
		return compact('object', 'damages', 'owner', 'type');
	}
	
	public function archive($objectID) {
		$object = Objects::find($objectID);
		$damages = $object->getArchivedDamages();
		return compact('object', 'damages');
	}
	
	public function edit($ID){
		$object = Objects::first($ID);
		if($this->request->data && $object->save($this->request->data))
		{
			FlashMessage::Write('Fordon ändrat', array('class' => 'success'));
            return $this->redirect('/objects/view/'.$object->id);
		}
		
		foreach(Owners::all() as $owner)
			$owners[$owner->id] = $owner->short;
		foreach(Types::all() as $type)
			$types[$type->id] = $type->name;
			
		return compact('object', 'types', 'owners');
	}
	
	public function add() {
		if($this->request->is('ajax'))
			$this->_render['layout'] = false;

		$object = Objects::create();
		
		foreach(Owners::all() as $owner)
			$owners[$owner->id] = $owner->short;
		foreach(Types::all() as $type)
			$types[$type->id] = $type->name;
		
		
		if($this->request->data)
		{
			preg_match_all('/(\\d\\d) (\\d\\d) ([0-9]{4}) ([0-9]{3})-(\\d)/', $this->request->data['name'], $result, PREG_PATTERN_ORDER);
			if(!$result[0])
			{
				FlashMessage::Write('Ej giltigt nr, format: XX XX XXXX XXX-X', array('class' => 'fail'));
				return compact('object', 'types', 'owners');
			}
			if($object->save($this->request->data))
				FlashMessage::Write('Fordon tillagt', array('class' => 'success'));
		}
				
        return compact('object', 'types', 'owners');
	}
	
	public function statistics($objectID)
	{
		$allDam = Damages::find('all', array('conditions' => array('object_id' => $objectID)));
		if(count($allDam) > 0)
		{
			$codeArr = Damages::getCodeArray();
			
			foreach($allDam as $damage)
				$codes[] = $damage->code;
			$codeCount = array_count_values($codes);
			
			$groups = array();
			foreach($codeCount as $key => $val)
				$groups[] = array($codeArr[$key], ($val * 100) / count($codes) . '%', $val);
		}
		
		return compact('groups');
	}
	
	public function deactivate($id) {
		$object = Objects::first($id);
		
		if (($this->request->data) && $object->save($this->request->data)) {
        	FlashMessage::Write('Fordon avaktiverat', array('class' => 'success'));
			return $this->redirect('objects/index');
        }
		
		return compact('object');
	}

	public function menu() {
		if($this->request->is('ajax'))
			$this->_render['layout'] = false;

		$types = Types::all(array('with' => array('Objects'), 'order' => 'name'));

		$selObj = Session::read('objectID');

		$controllerMenu['title'] = "Fordon";
		$controllerMenu['objects'] = array();
		foreach($types as $type) {
			$controllerMenu['objects'][$type->name]['class'] = 'hide';
			foreach($type->objects as $object) {
				if($object->id == $selObj) {
					$controllerMenu['objects'][$type->name]['items'][] = array('name' => '<strong>'.$object->name.'</strong>', 'link' => '/objects/view/'.$object->id);
					$controllerMenu['objects'][$type->name]['class'] = 'show';
				}
				else
					$controllerMenu['objects'][$type->name]['items'][] = array('name' => $object->name, 'link' => '/objects/view/'.$object->id);
			}
		}
		$this->set(compact('controllerMenu'));
	}

	public function _init() {
		parent::_init();
		if(isset($this->request->params['args'][0]))
			Session::write('objectID', $this->request->params['args'][0]);
	}

}

?>

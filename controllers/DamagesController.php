<?php

namespace cams\controllers;
use cams\models\Damages;
use cams\models\Objects;
use cams\models\Logs;
use cams\models\News;

use li3_flash_message\extensions\storage\FlashMessage;

class DamagesController extends \lithium\action\Controller {

	public function index($a = 10, $b = 10, $c = 10) {
		$modifieddamages = Damages::find('all', array('conditions' => array('modifiedby > 0', 'active' => 1),'order' => 'modified DESC', 'limit' => $a));
		$damages = Damages::find('all', array('order' => 'created DESC', 'limit' => $b, 'conditions' => array('active' => 1)));
		$nulleddamages = Damages::find('all', array('conditions' => array('nulledby > 0'),'order' => 'nulled DESC', 'limit' => $c));
		return compact('damages', 'modifieddamages', 'nulleddamages');
	}
	
	public function search() {
		if($this->request->data['q'])
		{
			$q = $this->request->data['q'];
			$damages = Damages::all(array('conditions' => "`short` LIKE '%$q%' OR `notes` LIKE '%$q%' OR `nulltext` LIKE '%$q%'", 'limit' => 30));
			$objects = Objects::all(array('conditions' => "`name` LIKE '%$q%' OR `notes` LIKE '%$q%'", 'limit' => 30));
			$news = News::all(array('conditions' => "`post` LIKE '%$q%'", 'limit' => 30));
			return compact('damages', 'objects', 'news');
		}
	}
	
	public function add($objectID) {
		$damage = Damages::create($this->request->data);
		
		$damage->object_id = $objectID;
		
        if ($this->request->data) 
        {
        	if($this->request->data['prio'] == 1 && empty($this->request->data['location']))
			{
				FlashMessage::Write('Du måste skriva in plats vid prio 1', array('class' => 'fail'));
				return compact('damage');
			}
        	if($damage->save())
			{
				FlashMessage::Write('Skadan sparad', array('class' => 'success'));
            	return $this->redirect('objects/view/'.$objectID);
			}
        }
		
        return compact('damage');
	}
	
	public function edit($damageID){
		$damage = Damages::first($damageID);
		if($this->request->data && $damage->save($this->request->data))
		{
			FlashMessage::Write('Skadan ändrad', array('class' => 'success'));
            return $this->redirect('objects/view/'.$damage->object_id);
		}
			
		return compact('damage');
	}
	
	public function nullify($damageID){
		$damage = Damages::first($damageID);
		if(!$damage->active)
		{
			FlashMessage::Write('Skadan är redan kvitterad', array('class' => 'fail'));
	            return $this->redirect('/damages/index');
		}
		if($this->request->data)
		{
			if(strlen($this->request->data['nulltext']) < 2)
			{
				FlashMessage::Write('Ingen åtgärd inmatad', array('class' => 'fail'));
				return compact('damage');
			}
			$damage->active = 0;
			$damage->nulledby = $_SESSION['user']['id'];
			$damage->nulled = date('Y-m-d H:i:s');
			if($damage->save($this->request->data))
			{
				FlashMessage::Write('Skadan kvitterad', array('class' => 'success'));
	            return $this->redirect('objects/view/'.$damage->object_id);
			}
		}
		return compact('damage');
	}
		
	public function view($damageID) {
		$damage = Damages::first($damageID);
		$object = $damage->getObject();
		$owner = $object->getOwner();
		$type = $object->getType();
		$logs = Logs::GetLog('damages', $damageID);
		return compact('damage', 'object', 'owner', 'type', 'logs');
	}
	
	public function statistics() {
		$damages = Damages::all();
		
		// Calc damages per object
		foreach($damages as $damage)
			$objectDist[] = $damage->object_id;
		$objectDist = array_count_values($objectDist);
		arsort($objectDist);
		$objectDist = array_slice($objectDist, 0, 10, true);
		
		
		foreach($damages as $damage)
			$codeDist[] = $damage->code;
		$damageCount = count($codeDist);
		$codeDist = array_count_values($codeDist);
		arsort($codeDist);
		$codeArr = Damages::getCodeArray();
		foreach($codeDist as $key => $val)
			$groups[] = array($codeArr[$key], ($val * 100) / $damageCount . '%', $val);
		
		return compact('objectDist', 'groups');
	}
	
}

?>
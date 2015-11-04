<?php

namespace cams\controllers;
use cams\models\Damages;
use cams\models\Objects;
use cams\models\Logs;
use cams\models\News;

use li3_flash_message\extensions\storage\FlashMessage;

class DamagesController extends \lithium\action\Controller {

	public function index($a = 10, $b = 10, $c = 10) {
		$modifieddamages = Damages::find('all', array('conditions' => array('modifiedby > 0', 'active' => 1),'order' => 'modified DESC', 'limit' => $b));
		$damages = Damages::find('all', array('order' => 'created DESC', 'limit' => $a, 'conditions' => array('active' => 1)));
		$nulleddamages = Damages::find('all', array('conditions' => array('nulledby > 0'),'order' => 'nulled DESC', 'limit' => $c));
		return compact('damages', 'modifieddamages', 'nulleddamages');
	}
	
	public function search() {
		if($this->request->data['q'])
		{
			$q = implode('.?',str_split($this->request->data['q']));
			$q = '.*'.$q.'.*';
			$damages = Damages::all(array('conditions' => "`short` REGEXP '$q' OR `notes` REGEXP '$q' OR `nulltext` REGEXP '$q'", 'limit' => 30));
			//$objects = Objects::all(array('conditions' => "`name` REGEXP '$q' OR `notes` REGEXP '$q'", 'limit' => 30));
			$objects = Objects::all(array('conditions' => array('or' => array("`name` REGEXP '$q'", "`notes` REGEXP '$q'"), 'active' => 1), 'limit' => 30));
			$news = News::all(array('conditions' => "`post` REGEXP '$q'", 'limit' => 30));
			$totalCount = count($damages) + count($objects);
			if ($totalCount == 1) {
				switch (1) {
					case count($damages):
						return 
$this->redirect('/damages/view/'.$damages->current()->id);
					case count($objects):
						return 
$this->redirect('/objects/view/'.$objects->current()->id);
				}
			}
			return compact('damages', 'objects', 'news');
		}
	}
	
	public function browse() {
		if(!isset($this->request->data['active'])) $this->request->data['active'] = 0;
		if(!isset($this->request->data['inactive'])) $this->request->data['inactive'] = 0;
		$active = $this->request->data['active'];
		$inactive = $this->request->data['inactive'];
		
		$limit = 20;
        $page = $this->request->page ?: 1;
        $order = array('created' => 'DESC');
		$conditions = array();
		
		if($inactive && !$active)
			$conditions['active'] = 0;
		elseif (!$inactive && $active) 
			$conditions['active'] = 1;
		
        $total = Damages::count(compact('conditions'));
        $posts = Damages::all(compact('order','limit','page', 'conditions'));
		
        return compact('posts', 'total', 'page', 'limit', 'active', 'inactive');
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
            	return $this->redirect('/objects/view/'.$objectID);
			}
        }
		
        return compact('damage');
	}
	
	public function edit($damageID){
		$damage = Damages::first($damageID);
		if($this->request->data && $damage->save($this->request->data))
		{
			FlashMessage::Write('Skadan ändrad', array('class' => 'success'));
            return $this->redirect('/objects/view/'.$damage->object_id);
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
	            return 
$this->redirect('/objects/view/'.$damage->object_id);
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
		
		require LITHIUM_LIBRARY_PATH . "/jpgraph/src/jpgraph.php";
 		require LITHIUM_LIBRARY_PATH . "/jpgraph/src/jpgraph_line.php";

        $query = Damages::connection()->read("SELECT year( `created` ) FROM `damages` GROUP BY year( `created` )");
        foreach($query as $q)
            foreach($q as $y)
                $years[] = $y;


		foreach($years as $year)
		{
			for($i=1;$i<13;$i++)
			{
				$stats[$year][$i]['reported'] = Damages::count(array('conditions' => array('`created` LIKE  \''.$year.'-'.str_pad($i, 2, "0", STR_PAD_LEFT).'%\'')));
                $stats[$year][$i]['remaining'] = Damages::count(array('conditions' => array('`created` LIKE  \''.$year.'-'.str_pad($i, 2, "0", STR_PAD_LEFT).'%\'', '`nulledby` = 0')));
				$stats[$year][$i]['nulled'] = Damages::count(array('conditions' => array('`nulled` LIKE  \''.$year.'-'.str_pad($i, 2, "0", STR_PAD_LEFT).'%\'', '`nulledby` > 0')));
                $stats[$year][$i]['totalremaining'] = Damages::count(array('conditions' => array('`created` <=  \''.$year.'-'.str_pad($i, 2, "0", STR_PAD_LEFT).'-31\'', '(`nulled` >  \''.$year.'-'.str_pad($i, 2, "0", STR_PAD_LEFT).'-31\' OR `nulledby` = 0)')));
			}
		}

        $damtotal = Damages::count();
        $damremain = Damages::count(array('conditions' => array('`nulledby` = 0')));

		return compact('objectDist', 'groups', 'stats', 'damtotal', 'damremain');
	}

    public function ford() {
        if(!$this->request->data) {
            return array('out' => null);
        }
		$result = 0;
		$paste = $this->request->data['paste'];
		switch (1)
		{
			case preg_match('/^MKUS\b/m', $paste):
				$out['type'] = 'MKUS';
				break;
			case preg_match('/^MSKS\b/m', $paste):
				$out['type'] = 'MSKS';
				$result = preg_match_all('/\n (?P<date>\d{6}) \b.*?\b (?P<text>.*?)(?P<id>\d{8}).*?\n/is', $paste, $matches);
				break;
			case preg_match('/^MAUS\b/m', $paste):
				$out['type'] = 'MAUS';
				$result = preg_match_all('/\n  (?P<date>\d{6}) \b.*?\b (?P<text>.*?)(?P<id>\d{8}).*?\n/is', $paste, $matches);
				break;
			case preg_match('/^MKKS\b/m', $paste):
				$out['type'] = 'MKKS';
				$result = preg_match_all('/\n  (?P<date>\d{6}) \b.*?\b (?P<text>.*?)(?P<id>\d{8}).*?\n/is', $paste, $matches);
				break;
			default:
				$out['type'] = 'UNKNOWN';
				$result = preg_match_all('/\n ? (?P<date>\d{6}) \b.*?\b (?P<text>.*?)(?P<id>\d{8}).*?\n/is', $paste, $matches);
		}

		if(preg_match('/Fordon: (\b.+?\b)/', $paste, $match)) {
			$out['object'] = $match[1];
		}

		for($i=0;$i<$result;$i++)
		{
			$out['data'][] = array('date' => $matches['date'][$i], 'text' => trim($matches['text'][$i]), 'id' => $matches['id'][$i]);
		}

        return compact('out');
    }
	
}

?>

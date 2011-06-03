<?php
namespace cams\models;

use cams\models\Objects;
use cams\models\Users;
use cams\models\Logs;

class Damages extends \lithium\data\Model {
		
		public function getObject($record)
		{
			return Objects::first($record->object_id);
			
		}
		
		public function getCreatedBy($record)
		{
			return Users::first($record->createdby);
		}
		
		public function getModifiedBy($record)
		{
			return Users::first($record->modifiedby);
		}
		
		public function getNulledBy($record)
		{
			return Users::first($record->nulledby);
		}
		
		public function getCodeArray()
		{
			return array(1 => 'Hjul', 2 => 'Stöt & Drag', 3 => 'Broms', 4 => 'Boggie', 5 => 'Luft', 6 => 'Last', 0 => 'Övrigt');
		}
		
		public function getCode($id)
		{
			$arr = self::getCodeArray();
			return $arr[$id];
		}
}

/*
 * Adds created date when a post is first created, if it allready exists, it updates modified
 * Also adds user that created/modified
 */
Damages::applyFilter('save', function($self, $params, $chain){
	    
    $record = $params['entity'];
	    	
	if ($record->id)
    	{
    		$record->modified = date('Y-m-d H:i:s');
			$record->modifiedby = $_SESSION['user']['id'];
		}
	else
		{
    		$record->created = date('Y-m-d H:i:s');
			$record->createdby = $_SESSION['user']['id'];
		}
		
	Logs::CheckFields($params, 'damages', array('prio', 'short', 'notes', 'active', 'code'));
		
    $params['entity'] = $record;
    return $chain->next($self, $params, $chain);

});

?>
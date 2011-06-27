<?php
namespace cams\models;
use cams\models\Owners;
use cams\models\Damages;
use cams\models\Types;

class Objects extends \lithium\data\Model {
	
		public $belongsTo = array('Owners');
	
		public $validates = array('name' => 'Nummer saknas');
		
		public function getOwner($record)
		{
			return Owners::find($record->owner_id);
		}
		
		public function getDamages($record)
		{
			return Damages::find('all', array('conditions' => array('object_id' => $record->id, 'active' => 1), 'order' => '`created` DESC'));
		}
		
		public function getArchivedDamages($record)
		{
			return Damages::find('all', array('conditions' => array('object_id' => $record->id, 'active' => 0), 'order' => '`created` DESC'));
		}
		
		public function getType($record)
		{
			return Types::find($record->type_id);
		}
		
		public function toString($record)
		{
			return $record->getType()->name . ' ' . $record->name; 
		}
		
		public function getPrio1Date($record)
		{
			$dam = Damages::first(array('conditions' => array('object_id' => $record->id, 'active' => 1, 'prio' => 1), 'order' => '`created` DESC'));
			return $dam->created;
		}
		
		public function getPrio1Location($record)
		{
			$dam = Damages::first(array('conditions' => array('object_id' => $record->id, 'active' => 1, 'prio' => 1), 'order' => '`created` DESC'));
			return $dam->location;
		}
}

Objects::applyFilter('save', function($self, $params, $chain){
	    
    $record = $params['entity'];
	
	if(!$record->id)
		$record->created = date('Y-m-d H:i:s');
    		
	Logs::CheckFields($params, 'objects', array('notes', 'owner_id', 'active'));
				
    $params['entity'] = $record;
    return $chain->next($self, $params, $chain);

});

?>
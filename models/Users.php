<?php
namespace cams\models;

use cams\models\Owners;

class Users extends \lithium\data\Model {
        //public $_meta = array('connection' => 'mongo');

		public $belongsTo = array('Owners');
			
		public $validates =  array('email' => array(array('email', 'message' => 'Din email är ej giltig')) );
							 
		public function getOwner($record)
		{
			return Owners::find($record->owner_id);
		}
}			

Users::applyFilter('save', function($self, $params, $chain){
	    
    $record = $params['entity'];
    if (!$record->id) {
        $record->password = \lithium\util\String::hash($record->password);
    }
	
    $params['entity'] = $record;
    return $chain->next($self, $params, $chain);

});


?>

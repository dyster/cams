<?php

namespace cams\models;
use lithium\security\Auth;
use cams\models\Owners;

class Projects extends \lithium\data\Model {

	public $validates = array();
	public $belongsTo = array('Owners', 'Users', 'Objects');
	
	public function getClient($record)
	{
		return Owners::first($record->client_id);
		
	}
}

Projects::applyFilter('save', function($self, $params, $chain){
	    
    $record = $params['entity'];
    if (!$record->id) {
    	
    	$authz = Auth::check('user');
        $record->user_id = $authz['id'];
		$record->owner_id = $authz['owner_id'];
		$record->created = date('Y-m-d H:i:s');
    }
	
    $params['entity'] = $record;
    return $chain->next($self, $params, $chain);

});

?>
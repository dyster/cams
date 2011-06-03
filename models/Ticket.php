<?php

namespace cams\models;
use cams\models\Users;
use cams\models\Logs;

class Ticket extends \lithium\data\Model {

	public $validates = array();
	
	public function getCreatedBy($record)
		{
			return Users::first($record->user_id);
		}
		
	public function getComments($record)
	{
		return Tickets_comments::all(array('conditions' =>array('ticket_id' => $record->id), 'order' => 'created ASC'));
	}
	
	public function getCommentsCount($record)
	{
		return Tickets_comments::count(array('conditions' =>array('ticket_id' => $record->id)));
	}
}

Ticket::applyFilter('save', function($self, $params, $chain){
	    
    $record = $params['entity'];
    	
	if (!$record->id)
    	{
    		$record->created = date('Y-m-d H:i:s');
			$record->user_id = $_SESSION['user']['id'];
		}
		
	Logs::CheckFields($params, 'tickets', array('title', 'type', 'text', 'module'));
				
    $params['entity'] = $record;
    return $chain->next($self, $params, $chain);

});

?>
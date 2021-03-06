<?php

namespace cams\models;

class News extends \lithium\data\Model {

	public $validates = array();
	//public $_meta = array('connection' => 'mongo');
	
	public function getCreatedBy($record)
		{
			return Users::first($record->user_id);
		}
}

News::applyFilter('save', function($self, $params, $chain){
	    
    $record = $params['entity'];
    	
	if (!$record->id)
    	{
    		$record->created = date('Y-m-d H:i:s');
			$record->user_id = $_SESSION['user']['id'];
		}
					
    $params['entity'] = $record;
    return $chain->next($self, $params, $chain);

});
?>
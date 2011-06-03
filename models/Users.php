<?php
namespace cams\models;

class Users extends \lithium\data\Model {
	public $validates =  array('email' => array(array('email', 'message' => 'Din email är ej giltig'))
							 );
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

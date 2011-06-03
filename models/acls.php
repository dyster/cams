<?php
namespace cams\models;
use cams\models\acos;

class acls extends \lithium\data\Model {
	
	public static function getAllowedAcos($userID)
	{
		$acls = self::find('all', array('conditions' => array('user_id' => $userID)));
		$allowed = array();
		foreach($acls as $acl)
		{
			$allowed[] = (int)$acl->aco_id;
		}
		return $allowed;
	}
	
	public static function getAllowedAction($userid, $controller, $action)
	{
		$aco = acos::first(array('conditions' => array('controller' => $controller, 'action' => $action)));
		if($aco == null)
			return false;
		$acl = self::first(array('conditions' => array('user_id' => $userid, 'aco_id' => $aco->id)));
		if($acl == null)
			return false;
		else
			return true;
	}
}

?>
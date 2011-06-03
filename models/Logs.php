<?php
namespace cams\models;

class Logs extends \lithium\data\Model {
	
	public static function Log($table, $field, $foreignid, $from, $to)
	{
		$log = self::create();
		$log->created = date('Y-m-d H:i:s');
		$log->user_id = $_SESSION['user']['id'];
		$log->table = $table;
		$log->field = $field;
		$log->foreign_id = $foreignid;
		$log->from = $from;
		$log->to = $to;
		$log->save();
	}
	
	public function getUser($record)
		{
			return Users::first($record->user_id);
		}
	
	
	public static function CheckFields($params, $table, $fields = array())
	{
		$record = $params['entity'];
    	$postdata = $params['data'];
		
		foreach($fields as $field)
		{
			if($record->{$field} == null || !isset($postdata[$field]) || $postdata[$field] == null)
				continue;
			if(strcasecmp(trim($record->{$field}), trim($postdata[$field])) != 0)
				self::Log($table, $field, $record->id, $record->{$field}, $postdata[$field]);
		}
	}
	
	public static function GetLog($table, $id)
	{
		return self::all(array('conditions' => array('table' => $table, 'foreign_id' => $id), 'order' => 'created DESC'));
	}
}



?>
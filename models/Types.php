<?php
namespace cams\models;

class Types extends \lithium\data\Model {
	public $hasMany = array('Objects' => array('conditions' => array('active' => 1)));
	
}

?>
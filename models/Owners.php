<?php
namespace cams\models;

class Owners extends \lithium\data\Model {
		public $hasMany = array('Users', 'Objects');
}

?>
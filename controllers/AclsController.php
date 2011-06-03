<?php

namespace cams\controllers;

use cams\models\acls;

class AclsController extends \lithium\action\Controller {

    public function index() {
        $acls = acl::all();
		return compact('acls');
    }

	
		
}



?>

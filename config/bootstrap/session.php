<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2011, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

/**
* This configures your session storage. The Cookie storage adapter must be connected first, since
* it intercepts any writes where the `'expires'` key is set in the options array.
*/
use lithium\storage\Session;

Session::config(array(
// 'cookie' => array('adapter' => 'Cookie'),
'default' => array('adapter' => 'Php')
));

/**
* Uncomment the lines below to enable forms-based authentication. This configuration will attempt
* to authenticate users against a `Users` model. In a controller, run
* `Auth::check('default', $this->request)` to authenticate a user. This will check the POST data of
* the request (`lithium\action\Request::$data`) to see if the fields match the `'fields'` key of
* the configuration below. If successful, it will write the data returned from `Users::first()` to
* the session using the default session configuration.
*
* Once the session data is written, you can call `Auth::check('default')` to check authentication
* status or retrieve the user's data from the session. Call `Auth::clear('default')` to remove the
* user's authentication details from the session. This effectively logs a user out of the system.
* To modify the form input that the adapter accepts, or how the configured model is queried, or how
* the data is stored in the session, see the `Form` adapter API or the `Auth` API, respectively.
*
* @see lithium\security\auth\adapter\Form
* @see lithium\action\Request::$data
* @see lithium\security\Auth
*/
use lithium\security\Auth;
use lithium\security\Password;

Auth::config(array('user' =>
				array(
					'adapter' => 'Form',
					'model' => 'Users',
					'fields' => array('username', 'password'),
					'filters' => array('password' => array('lithium\util\String', 'hash')), //'validators' => array('password' => false)
					'validators' => array('password' => function($form, $data){return $form == $data;})
					)
));
/*
Auth::config(array(
 	'user' => array(
 		'adapter' => 'Form',
 		'filters' => array('password' => array('lithium\util\String', 'hash')),
 		'validators' => array(
 			'password' => function($form, $data) {
 				return Password::check($form, $data);
 			}
 		)
 	)
 ));*/

use lithium\action\Dispatcher;
use lithium\action\Response;
use cams\models\acls;
use cams\models\acos;
use cams\models\Stats;
use li3_flash_message\extensions\storage\FlashMessage;

Dispatcher::applyFilter('_callable', function($self, $params, $chain) {
    $ctrl = $chain->next($self, $params, $chain);

	$controller = $ctrl->request->params["controller"];
	$action = $ctrl->request->params["action"];



	$aco = acos::find('first', array('conditions' => array('controller' => $controller, 'action' => $action)));
	if($aco == null)
	{
		FlashMessage::Write('Permission Denied, there is no ACO for this page', array('class' => 'fail'));
		return function() use ($request) {return new Response(compact('request') + array('location' => '/')); 	};
	}

	$stat = Stats::Create();
	$stat->aco_id = $aco->id;
	$stat->useragent = $_SERVER['HTTP_USER_AGENT'];
	$stat->ip = ip2long($_SERVER['REMOTE_ADDR']);
	$stat->time = date('Y-m-d H:i:s');
	if(!empty($_SESSION['user']))
		$stat->user_id = $_SESSION['user']['id'];
	$stat->Save();

	if($aco->public)
		return $ctrl;

	$auth = Auth::check('user');
    if (!$auth) {
	return function() use ($request) {return new Response(compact('request') + array('location' => '/login')); 	};
    }

	if($aco->default)
		return $ctrl;

	$acl = acls::find('first', array('conditions' => array('user_id' => $auth["id"] , 'aco_id' => $aco->id)));

	if($acl == null)
	{
		FlashMessage::Write('Permission Denied', array('class' => 'fail'));
		return function() use ($request) {return new Response(compact('request') + array('location' => '/')); 	};
	}

	return $ctrl;

});

?>

<?php

namespace cams\controllers;

use lithium\security\Auth;
use cams\models\Users;
use cams\models\acos;
use cams\models\acls;
use cams\models\Owners;

use li3_flash_message\extensions\storage\FlashMessage;

class UsersController extends \lithium\action\Controller {

    public function index() {
        $users = Users::all();
        return compact('users');
    }

    public function add() {
        $user = Users::create($this->request->data);
		foreach(Owners::all() as $owner)
			$owners[$owner->id] = $owner->short;
        if (($this->request->data) && $user->save()) {
            return $this->redirect('Users::index');
        }
        return compact('user', 'owners');
    }

	public function login() {

		if(!empty($this->request->data))
		{
			if(Auth::check('user', $this->request))
			{
				$user = Users::first($_SESSION['user']['id']);
				$_SESSION['lastlogin'] = $user->lastlogin;
				$_SESSION['notifications'][] = array('text' => 'Din senaste inloggning var '.$user->lastlogin, 'class' => 'notice');
				$user->lastlogin = date('Y-m-d H:i:s');
				$user->save();

            			return $this->redirect('/news/index');
			}
			else
				FlashMessage::Write('Fel användarnamn eller lösenord', array('class' => 'fail'));

        }
		elseif (Auth::check('user'))
		{
			//return $this->redirect('users/profile');

		}

	}

	public function logout(){
				//$user = Users::first($_SESSION['user']['id']);
				//$user->lastlogin = date('Y-m-d H:i:s');
				//$user->save();
                Auth::clear('user');
                return $this->redirect('/users/login');
        }

	public function edit($userID){
		$acos = acos::all(array('conditions' => array('public' => '0', 'default' => '0'), 'order' => 'controller'));
		$publicacos = acos::all(array('conditions' => array('public' => '1'), 'order' => 'controller'));
		$defaultacos = acos::all(array('conditions' => array('default' => '1'), 'order' => 'controller'));
		$allowed = acls::getAllowedAcos($userID);
		$user = Users::find($userID);
		foreach(Owners::all() as $owner)
			$owners[$owner->id] = $owner->short;

		if($this->request->data && $user->save($this->request->data))
		{
			FlashMessage::Write('Användare ändrad', array('class' => 'success'));
		}


		return compact('acos', 'allowed', 'user', 'defaultacos', 'publicacos', 'owners');
	}

	public function flip($acoID, $userID){
		$acl = acls::find('first', array('conditions' => array('user_id' => $userID, 'aco_id' => $acoID)));

		if(!$acl)
		{
			$acl = acls::create();
			$acl->user_id = $userID;
			$acl->aco_id = $acoID;
			$acl->save();
		}
		else
		{
			$acl->delete();
		}
		return $this->redirect("users/edit/{$userID}");
	}

	public function profile()
	{
		$auth = Auth::check('user');
		if($auth)
		{
			$user = Users::first($auth['id']);
			if($this->request->data)
			{
				if(!empty($this->request->data['password1']) && !empty($this->request->data['password2']))
				{
					if(\lithium\util\String::hash($this->request->data['oldpassword']) == $user->password)
					{
						if($this->request->data['password1'] == $this->request->data['password2'])
						{
							$user->password = \lithium\util\String::hash($this->request->data['password1']);
							if($user->save())
								$_SESSION['notifications'][] = array('class' => 'success', 'text' => 'Lösenordet ändrat');
						}
						else
							$_SESSION['notifications'][] = array('class' => 'fail', 'text' => 'Dom nya lösenorden matchar inte');
					}
					else
						$_SESSION['notifications'][] = array('class' => 'fail', 'text' => 'Fel lösenord');
				}
				elseif($user->save($this->request->data))
				{
					FlashMessage::Write('Användaruppgifter ändrade', array('class' => 'success'));
				}
			}

			return compact('user');
		}
		else
			return $this->redirect('Users::login');
	}


	public function password($userID)
	{
		$user = Users::find($userID);

		if($this->request->data)
		{
			$user->password = \lithium\util\String::hash($this->request->data['password']);
			if($user->save())
			{
				FlashMessage::Write('Lösenordet ändrat', array('class' => 'success'));
				return $this->redirect('users/index');
			}
		}

		return compact('user');
	}

	/*
	public function _init(array $options = array())
	{

		$controllerMenu['title'] = "Användare";
		$controllerMenu['objects']['Sidor']['class'] = 'show';
		$controllerMenu['objects']['Sidor']['items'][] = array('name' => 'Index', 'link' => '/users/index/');
		$controllerMenu['objects']['Sidor']['items'][] = array('name' => 'Add', 'link' => '/users/add/');

		$this->set(compact('controllerMenu'));

		parent::_init();
	}*/

}



?>

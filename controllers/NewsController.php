<?php

namespace cams\controllers;

use cams\models\News;
use cams\models\Ticket;

class NewsController extends \lithium\action\Controller {

	public function index() {
		$news = News::all(array('limit' => '4', 'order' => 'created DESC'));
		$usertickets = Ticket::all(array('conditions' => array('user_id' => $_SESSION['user']['id']), 'limit' => 30, 'order' => 'created DESC'));
		return compact('news', 'usertickets');
	}

	public function view() {
		$news = News::first($this->request->id);
		return compact('news');
	}

	public function add() {
		$news = News::create();
		
		if (($this->request->data) && $news->save($this->request->data)) {
			$this->redirect('/');
		}
		return compact('news');
	}

	public function edit() {
		$news = News::find($this->request->id);

		if (!$news) {
			$this->redirect('News::index');
		}
		if (($this->request->data) && $news->save($this->request->data)) {
			$this->redirect(array('News::view', 'args' => array($news->id)));
		}
		return compact('news');
	}
}

?>
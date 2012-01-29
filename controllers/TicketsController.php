<?php

namespace cams\controllers;

use cams\models\Ticket;
use cams\models\Logs;
use cams\models\Tickets_comments;

use li3_flash_message\extensions\storage\FlashMessage;

class TicketsController extends \lithium\action\Controller {

	public function index() {
		$tickets = Ticket::all(array('order' => 'created DESC'));
		return compact('tickets');
	}

    public function view($id) {
		$ticket = Ticket::first($id);
		if ($ticket->updated && $_SESSION['user']['id'] == $ticket->user_id) {
			$ticket->updated = false;
			$ticket->save();
		}
		$logs = Logs::GetLog('tickets', $id);
		$comment = Tickets_comments::create();
		$comment->ticket_id = $id;

		if (($this->request->data) && $comment->save($this->request->data)) {
			if ($ticket->user_id != $_SESSION['user']['id']) {
				$ticket->updated = true;
				$ticket->save();
			}
			return $this->redirect('tickets/view/' . $ticket->id);
		}
		$comments = Tickets_comments::all(array(
            'conditions' =>array('ticket_id' => $id), 'order' => 'created DESC')
        );
		return compact('ticket', 'comments','comment', 'logs');
	}

	public function add($module = null) {
		$ticket = Ticket::create();

		if (($this->request->data) && $ticket->save($this->request->data)) {
			return $this->redirect('tickets/view/' . $ticket->id);
		}
		$ticket->module = $module;
		return compact('ticket');
	}

	public function edit($id) {
		$ticket = Ticket::find($id);

		if (!$ticket) {
			$this->redirect('Tickets::index');
		}
		if (($this->request->data) && $ticket->save($this->request->data)) {
			return $this->redirect('tickets/view/' . $ticket->id);
		}
		return compact('ticket');
	}

	public function delete($id) {
		$ticket = Ticket::first($id);
		if ($ticket->user_id != $_SESSION['user']['id']) {
			FlashMessage::Write(
				'Du kan endast avsluta dina egna ärenden', array('class' => 'fail')
			);
			return $this->redirect('/');
		}
		$comments = $ticket->getComments();
		$logs = Logs::GetLog('tickets', $id);
		$ticket->delete();
		foreach ($comments as $com) {
			$com->delete();
        }
		foreach ($logs as $log) {
			$log->delete();
		}
		return $this->redirect('/');
	}
}

?>
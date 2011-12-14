<?php
class SettingsController extends AppController {

	var $name = 'Settings';
	var $helpers = array('Html', 'Form');
	
	function beforeFilter() {
        $this->Auth->allow('index');
    }

	function admin_index() {
		$this->pageTitle = 'Settings';
        $this->Setting->recursive = 0;
		$this->set('settings', $this->paginate());
		$this->layout = 'admin';
	}

	function index() {
		$this->pageTitle = 'Settings';
        $this->Setting->recursive = 0;
		$this->set('settings', $this->paginate());
	}

	function admin_edit($id = 1) {
        $this->pageTitle = 'Edit Settings';
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Setting', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Setting->save($this->data)) {
				$this->Session->setFlash(__('Settings has been saved', true));
			$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Setting could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Setting->read(null, $id);
		}
		$this->layout = 'admin';
	}
}
?>
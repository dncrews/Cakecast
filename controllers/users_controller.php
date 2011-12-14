<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html', 'Form');
    
    function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
		$this->set('current_id', $this->Auth->user('id'));
		$this->set('is_admin', $this->Auth->user('admin'));
		$this->layout = 'admin';
	}

	function admin_add() {
		if (!empty($this->data)) {
    		$this->User->create();
    		if ($this->User->save($this->data)) {
    			$this->Session->setFlash(__('The User has been saved', true));
    			$this->redirect(array('action'=>'index'));
    		} else {
    			$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
    		}
		}
		$this->layout = 'admin';
	}

	function admin_edit($id = null) {
		$this->set('current_id', $this->Auth->user('id'));
		$this->set('is_admin', $this->Auth->user('admin'));
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid User', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		$this->layout = 'admin';
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for User', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->del($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->layout = 'admin';
	}
	function admin_login() {
		$this->layout = 'admin';
    }
	function admin_logout()  {
        $this->redirect($this->Auth->logout());
    }

}
?>
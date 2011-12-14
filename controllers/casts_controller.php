<?php
class CastsController extends AppController {

	var $name = 'Casts';
	var $helpers = array('Html', 'Form', 'Javascript', 'Text');
	var $components = array('Getid3');
	var $paginate = array(
        'order' => array(
            'Cast.created' => 'desc'
        )
    );
	
	function beforefilter() {
        $this->Auth->allow('index', 'rss', 'view', 'admin_add', 'archive');
    }
	
	function rss() {
		$Setting = ClassRegistry::init('Setting');
        $this->Cast->recursive = 0;
		$this->set('casts', $this->Cast->find('all'));
		$settings = $Setting->find();
		$settings = $settings['Setting'];
		$this->set('settings', $settings);
		$this->layout = false;
    }
    
    function admin_index() {
		$this->Cast->recursive = 0;
		$this->set('casts', $this->paginate());
		$this->layout = 'admin';
	}
    
	function index() {
		$this->Cast->recursive = 0;
		$this->set('casts', $this->Cast->find('all', array('limit' => 5, 'order' => 'Cast.created DESC')));
	}
	
	function archive() {
		$this->Cast->recursive = 0;
		$this->set('casts', $this->Cast->find('all', array('order'=>'Cast.created DESC')));
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Cast.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('cast', $this->Cast->read(null, $id));
		$this->layout = 'admin';
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Cast.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('cast', $this->Cast->read(null, $id));
	}

	function admin_add() {
	    //because of the oddities...
	    if(!$this->Auth->user() && empty($this->data)){
	       $this->Session->setFlash($this->Auth->loginError);
           $this->redirect($this->Auth->loginAction);
        }
        if (!empty($this->data['Cast']['audio_file'])) {
			$this->data['Cast']['user_id'] = $this->Auth->user('id');
			$this->Cast->Getid3 = $this->Getid3;
			$this->Cast->data = $this->data;
			$uploadResult = $this->Cast->uploadFile();
            if (!empty($uploadResult)) {
                $this->data = $uploadResult;
				$this->layout = 'ajax';
				$this->set('filename',$uploadResult['Cast']['audio_file']);
				$this->render('admin_ajax_add');
			} else {
				$this->Session->setFlash(__('The Cast could not be saved. Please, try again.', true));
			}
		}
        elseif (!empty($this->data)) {
            $this->Cast->create();
			$this->data['Cast']['user_id'] = $this->Auth->user('id');
			$this->Cast->Getid3 = $this->Getid3;
			if ($this->Cast->save($this->data)) {
				$this->Session->setFlash(__('The Cast has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Cast could not be saved. Please, try again.', true));
			}
		}
		else {
            if(sizeof($_POST)) {
                echo "<pre style='text-align: left;'>";
                var_dump($_POST);
                var_dump($_FILES);
                die();
            }
        }
		$users = $this->Cast->User->find('list');
		$this->set(compact('users'));
		$this->layout = 'admin';
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Cast', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			$this->Cast->Getid3 = $this->Getid3;
			if ($this->Cast->save($this->data)) {
				$this->Session->setFlash(__('The Cast has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Cast could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Cast->read(null, $id);
		}
		$users = $this->Cast->User->find('list');
		$this->set(compact('users'));
		$this->layout = 'admin';
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Cast', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Cast->del($id)) {
			$this->Session->setFlash(__('Cast deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>
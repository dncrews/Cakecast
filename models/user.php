<?php
class User extends AppModel {

	var $name = 'User';
	var $validate = array(
		'username' => array(
            array(
                'rule' => array('minLength', 4),
                'message' => 'Username must be at least 4 characters'
            ),
            array(
                'rule' => 'isUnique',
                'message' => 'Username already taken'
            )
        ),
        'password' => array(
            array (
                'rule' => array('password', 'verify_password'),
                'on' => 'create',
                'required' => true,
                'allowEmpty' => false,
                'message' => 'Passwords do not match'
            ),
            array (
                'rule' => array('password', 'verify_password'),
                'on' => 'update',
                'required' => false,
                'allowEmpty' => false,
                'message' => 'Passwords do not match'
            )
        ),
        'verify_password' => array(
            array (
                'rule' => array('minLength', 5),
                'on' => 'create',
                'required' => true,
                'allowEmpty' => false,
                'message' => 'Password must be at least 5 characters'
            ),
            array (
                'rule' => array('minLength', 5),
                'on' => 'update',
                'required' => false,
                'allowEmpty' => true,
                'message' => 'Password must be at least 5 characters'
            )
        ),
        'name' => array(
            'rule' => array('alnumWhitelist', array(' ', '\'', '"', '.')),
            'required' => true,
            'allowEmpty' => false,
            'message' => 'Please only use numbers, letters, and spaces.'
        ),
		'email' => array(
            'rule' => 'email',
            'message' => 'Please use a valid email address.'
        )
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Cast' => array(
			'className' => 'Cast',
			'foreignKey' => 'user_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
    function password($check, $field) {
        return (array_shift($check) == Security::hash($this->data[$this->name][$field], null, true));
    }
	
	function beforeValidate () {
        if($this->data['User']['verify_password'] === '') {
            unset($this->data['User']['password']);
        }
    }

}
?>
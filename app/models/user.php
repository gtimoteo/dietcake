<?php

class User extends AppModel{
	public $username;
	public $password;
	public $retype_password;
	
	
	public $validation = array(
		'username' => array(
			'length' => array(
				'validate_between', 1, 30,
			),
		),
		
		'password' => array(
			'length' => array(
				'validate_between', 1, 32,
			),
		),
	);
}

?>
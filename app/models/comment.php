<?php
//enable comments to be obtained from the Thread model
class Comment extends AppModel{
	public $username;
	
	public $validation = array(
		// 'username' => array(
			// 'length' => array(
				// 'validate_between', 1, 16,
			// ),
		// ),
		
		'body' => array(
			'length' => array(
				'validate_between', 1, 200,
			),
		),
	);
}

?>
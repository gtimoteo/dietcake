<?php

class Thread extends AppModel{
	//obtain all threads
	public static function getAll(){
		$threads = array();

		//connection to database
		$db = DB::conn();
		//select query using rows method of class DB
		$rows = $db->rows('SELECT * FROM thread');
		//loops to the result set
		foreach ($rows as $row) {
			//add element(comment) to variable thread
			$threads[] = new Thread($row);
		}

		return $threads;
	}
}

?>
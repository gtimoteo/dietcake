<!-- #########  MODEL  ######### -->
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

	//display a thread selected by a query parameter and comments on the thread
	public static function get($id){
		$db = DB::conn();
		$row = $db->row('SELECT * FROM thread WHERE id = ?', array($id));
		return new self($row);
	}
	
	//obtain comments from the database
	public function getComments()
	{
		$comments = array();
		$db = DB::conn();
		$rows = $db->rows(
				'SELECT * FROM comment WHERE thread_id = ? ORDER BY created ASC',
				array($this->id)
			);
		foreach ($rows as $row) {
			$comments[] = new Comment($row);
		}
		return $comments;
	}

}//end of Thread class

?>
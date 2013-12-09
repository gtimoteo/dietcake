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
	
	// insert comments to database
	// create a comment object and access its members 
	// as parameters in inserting data to database
	public function write(Comment $comment){
		if (!$comment->validate()) {
			throw new ValidationException('invalid comment');
		}
	
		$db = DB::conn();
		$db->query(
			'INSERT INTO comment SET thread_id = ?, username = ?, body = ?, created = NOW()',
			array($this->id, $comment->username, $comment->body)
		);
	}

}//end of Thread class

?>
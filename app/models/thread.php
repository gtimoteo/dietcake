<!-- #########  MODEL  ######### -->
<?php
class Thread extends AppModel
{   
    
    const MAX_THREADS = 5;
    const MAX_COMMENTS = 5;
	//validation for title
	public $validation = array(
		'title' => array(
			'length' => array(
				'validate_between', 1, 30,
			),
		),
	);
	
	//obtain all threads
	public static function getAll()
    {
		$threads = array();
		
		//connection to database
		$db = DB::conn();
		//select query using rows method of class DB
		$rows = $db->rows('SELECT * FROM thread');
		//loops to the result set
		foreach ($rows as $v) {
			//add element(comment) to variable thread
			$threads[] = new Thread($v);
		}

		return $threads;
	}

	//display a thread selected by a query parameter and comments in the thread
	public static function get($id)
    {
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
		foreach ($rows as $v) {
			$comments[] = new Comment($v);
		}
		return $comments;
	}
	
	// insert comments to database
	// create a comment object and access its members 
	// as parameters in inserting data to database
	public function write(Comment $comment)
    {
		if (!$comment->validate()) {
			throw new ValidationException('invalid comment');
		}
	
		$db = DB::conn();
        //$db->begin();
		$db->query(
			'INSERT INTO comment SET thread_id = ?, username = ?, body = ?, created = NOW()',
			array($this->id, $comment->username, $comment->body)
		);
        //$db->commit();
	}
	
	//creates a new threads
	public function create(Comment $comment)
    {
		$this->validate();
		$comment->validate();
		if ($this->hasError() || $comment->hasError()) {
			throw new ValidationException('invalid thread or comment');
		}
		
		$db = DB::conn();
		$db->begin();
		$db->query('INSERT INTO thread SET title = ?, created = NOW()', array($this->title));
		$this->id = $db->lastInsertId();
		// write first comment at the same time
		$this->write($comment);
		$db->commit();
	}
	
	//inserts new user data to database
	public function sign_up(User $user)
    {
		$user->validate();
		if ($user->hasError()) {
			throw new ValidationException('invalid username or password');
		}
		
		$db = DB::conn();
		$params = array(
			"username" => $user->username,
			"password" => md5($user->password)
		);
		$db->insert("user", $params);
	}
	
    //checks if account/username exists in table user
	public function isUserExisting($username)
    {
		$db = DB::conn();
		$result = $db->value(
			"SELECT COUNT(*) FROM user WHERE username = ?",
			array($username)
		);
		
		return $result;
	}
	
    //sign in validation
	public static function signIn($username, $password)
    {
		$db = DB::conn();
		$result = $db->value(
			"SELECT COUNT(*) FROM user WHERE username = ? AND password = ?",
			array($username, md5($password))
		);	
		return $result;
	}
    
    //get total number of threads pages
    public static function getNumberOfPages()
    {
        $threads = Thread::getAll();
        return ceil(count($threads) / THREAD::MAX_THREADS);
    }

    //get 5 threads for threads pagination
    public static function getThreads($page)
    {
		$threads = array();
		
		//connection to database
		$db = DB::conn();
		//select query using rows method of class DB
		$rows = $db->rows('SELECT * FROM thread');
		//loops to the result set
        $len = count($rows);
        $max_threads = Thread::MAX_THREADS;
        $start = ($page * $max_threads) - $max_threads;
        $end = $start + $max_threads;
        for ($start; $start < $end AND $start < $len; $start++) {
            $threads[] = new Thread($rows[$start]);
            
        }
		return $threads;
	}
    
    //get total number of comments pages
    public static function getNumberOfComments(Thread $thread)
    {
        $comments = $thread->getComments();
        return ceil(count($comments) / Thread::MAX_COMMENTS);
    }
    
    //get 5 comments for comments pagination
    public static function getSomeComments($page, $thread_id)
    {
        $comments = array();
        
        $db = DB::conn();
        $rows = $db->rows(
            "SELECT * FROM comment WHERE thread_id = ?",
            array($thread_id)
        );
        
        $len = count($rows);
        $max_comments = Thread::MAX_COMMENTS;
        $start = ($page * $max_comments) - $max_comments;
        $end = $start + $max_comments;
        for($start; $start < $end AND $start < $len; $start++){
            $comments[] = new Comment($rows[$start]);
        }
        return $comments;
    }
    
    
}//end of Thread class

?>
<!-- #########  CONTROLLER  ######### -->

<?php

class ValidationException extends AppException{

}

class ThreadController extends AppController{

	public function index(){
		$username = Param::get('username');
		$password = Param::get('password');
		$page = Param::get('page_next', 'index');
		
		switch($page){
			case 'index':
				if (isset($_SESSION['username'])){
                    $number_of_pages = Thread::getNumberOfPages();
                    $next_page = 1;
                    $current_page = 1;
                    $threads = Thread::getThreads(1);
					$page = 'threads';
				}
				break;
			case 'index_end':
				if (strlen($username) == 0 || strlen($password) == 0){
					$check_textbox = TRUE;
					$page = 'index';
				}else{
					if(Thread::signIn($username, $password)){
						$_SESSION['username'] = $username;
						$number_of_pages = Thread::getNumberOfPages();
                        $next_page = 1;
                        $current_page = 1;
                        $threads = Thread::getThreads(1);
                        $page = 'threads';
					}else{
						$invalid_account = TRUE;
						$page = 'index';
					}
				}
		}
	    $this->set(get_defined_vars());
		//header("location: /thread/{$page}");
        $this->render($page);
	}

	public function threads(){
        check_session();
		// TODO: Get all threads
		// obtain comments by accessing 
		// Thread class getAll() function(models/thread.php)      
        $page = Param::get('page');
        $next_page = $page;
        $current_page = $page;
        $number_of_pages = Thread::getNumberOfPages();
        $threads = Thread::getThreads($page);        
		$this->set(get_defined_vars());
	}

	//view.php
	public function view(){
        check_session();
        $thread_id = Param::get('thread_id');
        $page = Param::get('page');
        
		$thread = Thread::get(Param::get('thread_id'));
        
        $next_page = $page;
        $current_page = $page;
        $item_num = (($page * Thread::MAX_COMMENTS) - Thread::MAX_COMMENTS) + 1;
        //get total pages for comments, 5 comments per page
        $number_of_pages = Thread::getNumberOfComments($thread);
        //get comments
		$comments = Thread::getSomeComments($page, $thread_id);
		$this->set(get_defined_vars());
	}
	
	// write.php
	public function write(){
        check_session();
        $thread_id = Param::get('thread_id');
        $p = Param::get('page');
        
		$thread = Thread::get(Param::get('thread_id'));
        $comment = new Comment;
        
        $next_page = $p;
        $current_page = $p;
        $item_num = (($p * Thread::MAX_COMMENTS) - Thread::MAX_COMMENTS) + 1;
        
		//$comments = $thread->getComments();     
        $comments = Thread::getSomeComments($p, $thread_id);        
        
		$page = Param::get('page_next', 'write');
			
		switch ($page) {
			case 'write':
				break;
			case 'write_end':
				$comment->username = $_SESSION['username'];
				$comment->body = Param::get('body');
				try{
					$thread->write($comment);
				}catch(ValidationException $e){
					$page = 'write';
				}
				break;
			default:
				throw new NotFoundException("{$page} is not found");
		}
		$this->set(get_defined_vars());
		$this->render($page);
	}
	
	//register a new user
	public function sign_up(){
        check_session();
		$thread = new Thread;
		$user = new User;
		$page = Param::get('page_next', 'sign_up');
		
		$username = Param::get('username');
		$password = Param::get('password');
		$retype_password = Param::get('retype_password');
		
		switch($page){
			case 'sign_up':
				break;
			case 'sign_up_end':		
				if ($password != $retype_password){
					$password_mismatched = TRUE;
					$page = 'sign_up';
				}else{
					$user_exists = $thread->isUserExisting($username);
					if ($user_exists == 1){
						$user_exists_error = TRUE;	
						$page = 'sign_up';
					}else{
						$user->username = $username;
						$user->password =  $password;
						$user->retype_password = $retype_password;
					
						$_SESSION['username'] = $username;
						try{
							$thread->sign_up($user);
						}catch(ValidationException $e){
							$page = 'sign_up';
						}
					}	
				}
				break;
			default:
				throw new NotFoundException("{$page} is not found");
		}
		$this->set(get_defined_vars());
		$this->render($page);
	}
	
	public function create(){
        check_session();
		$thread = new Thread;
		$comment = new Comment;
		$page = Param::get('page_next', 'create');
		switch ($page) {
			case 'create':
				break;
			case 'create_end':
				$thread->title = Param::get('title');
				$comment->username = $_SESSION['username'];
				$comment->body = Param::get('body');
				try {
					$thread->create($comment);
				} catch (ValidationException $e) {
					$page = 'create';
				}
				break;
			default:
				throw new NotFoundException("{$page} is not found");
		}
		$this->set(get_defined_vars());
		$this->render($page);
	}
	
	public function logout(){
		session_destroy();
        header("Location: /thread/index");
	}
	
}// end of Thread class

?>
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
					$threads = Thread::getAll();
					$page = 'threads';
				}
				break;
			case 'index_end':
				if (strlen($username) == 0 || strlen($password) == 0){
					$isEmptyTextbox = TRUE;
					$page = 'index';
				}else{
					if(Thread::sign_in($username, $password)){
						$_SESSION['username'] = $username;
						$threads = Thread::getAll();
						$page = 'threads';
					}else{
						$invalidAccountError = TRUE;
						$page = 'index';
					}
				}
		}
		$this->set(get_defined_vars());
		$this->render($page);
	}
	
	public function threads(){
		// TODO: Get all threads
		// obtain comments by accessing 
		// Thread class getAll() function(models/thread.php)
		$threads = Thread::getAll();
		
		$this->set(get_defined_vars());
	}

	//view.php
	public function view(){
		$thread = Thread::get(Param::get('thread_id'));
		//call getComment function to obtain comments in database and display it to view.php
		$comments = $thread->getComments();
		
		$this->set(get_defined_vars());
	}
	
	// write.php
	public function write(){
		$thread = Thread::get(Param::get('thread_id'));
		$comment = new Comment;
		$comments = $thread->getComments();
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
					$password_mismatched_error = TRUE;
					$page = 'sign_up';
				}else{
					$user_exists = $thread->userExists($username);
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
		$this->render('index');
	}
	
}// end of Thread class

?>
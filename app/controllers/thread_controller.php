<!-- #########  CONTROLLER  ######### -->

<?php

class ValidationException extends AppException{

}

class ThreadController extends AppController{
	public function index(){
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
		$page = Param::get('page_next', 'write');
		
		
		switch ($page) {
			case 'write':
				break;
			case 'write_end':
				$comment->username = Param::get('username');
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
	
	public function create(){
		$thread = new Thread;
		$comment = new Comment;
		$page = Param::get('page_next', 'create');
		switch ($page) {
			case 'create':
				break;
			case 'create_end':
				$thread->title = Param::get('title');
				$comment->username = Param::get('username');
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
	
	
}// end of Thread class

?>
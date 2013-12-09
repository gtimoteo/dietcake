<!-- #########  CONTROLLER  ######### -->

<?php

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
}

?>
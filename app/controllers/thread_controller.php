<?php

class ThreadController extends AppController{
	public function index(){
		// TODO: Get all threads
		// obtain comments by accessing 
		// Thread class getAll() function(models/thread.php)
		$threads = Thread::getAll();

		$this->set(get_defined_vars());
	}
}

?>
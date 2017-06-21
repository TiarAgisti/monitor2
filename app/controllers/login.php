<?php

class Login extends Controller {
	//protected $level;

	public function __construct(){
		if(is_logged()){
			header('Location: '.SERVER_NAME);
		}

		//$this->level = $this->model('level');
	}
	
	/* login for seeker */
	public function index(){
		is_header(); 
		$this->view($_GET['url']);
		is_footer(); 
	}

}
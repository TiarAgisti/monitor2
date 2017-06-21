<?php

class Home extends Controller {
	protected $userpassword;

	public function __construct(){
		//var_dump(to_page('login'));
		if (is_logged() == false) {
			to_page('login');
		} 
		/*$this->userpassword = $this->model('userpassword');*/
		
		//var_dump('AAA');
	}

	public function index(){

		is_header(); 
		$this->view('home',[]);
		is_footer(); 
	}

}

?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		//$this->load->view('welcome_message');
		echo "this is admin home page";
	}
	
	public function test() {
	    
	    echo "this is Home trst file";
	}
}

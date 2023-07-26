<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Lead_management extends MY_Controller {

    function __construct() {

        parent::__construct();

        $this->load->library('session');

        $this->load->model('admin/Dashboard_Model');

        $this->load->model('Common_model');

        

         

	}

	public function index() {

        $this->getPermission('admin/allproducts');

	    $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);

        $this->load->view($url1.'/template/header');
        $this->load->view($url1.'/'.$url2.'/list',$data);
        $this->load->view($url1.'/template/footer');
    }
	
}
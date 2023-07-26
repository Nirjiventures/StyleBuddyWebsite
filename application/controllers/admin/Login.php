<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function  __construct()
   {
     parent::__construct();
     $this->load->library('session');
     $this->load->library('form_validation');
     $this->load->helper('form');
     $this->load->model('admin/Login_Model');
     $this->load->model('Page_Model');
      $this->site = $this->Page_Model->allController();
      $this->style = $this->Page_Model->stylist();
    }
     // LOGIN ROUTE  REMOVE DESIGN CSS FROM PUBLIC/ASSETS
    //$route['desk-login'] = 'admin/Login';
    //$route['admin-dashboard'] = 'admin/Dashboard';
    public function desk_login()
  	{ 
      redirect(base_url('stylebuddy-admin'));
    } 
	public function index()
	{    
	    if($this->session->userdata('authenticated')) {
            redirect('admin/Dashboard');
         }
	    
	    $this->form_validation->set_rules('email','Email','required|trim|valid_email');
        $this->form_validation->set_rules('password','Password','required|trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger mt-1">','</span>');
        
        if( $this->form_validation->run() == false) {
		   $this->load->view('admin/login');
        
	     } else {
	         
            $email = $this->security->xss_clean($this->input->post('email'));
            $password = md5($this->security->xss_clean($this->input->post('password')));
            $user = $this->Login_Model->login_chk($email,$password);
                
            if($user) {
                if($user->status == 1) {
                    $userData = [
                        'admin_id'=> $user->id,
                        'adminEmail'=> $user->email,
                        'authenticated' => TRUE
                    ];
                    
                    $this->session->set_userdata($userData);
                    redirect('admin-dashboard');
                } else {
                    $this->session->set_flashdata('message','Oh, Your account is disabled by admin. Please contact administrator');
                    redirect('stylebuddy-admin');
                }
            } else {
                $this->session->set_flashdata('message','Oh, Invalid Email or Password, try again!!');
                redirect('stylebuddy-admin');
            }
	    }
   }
   
  public function logout()  
    {  
      $this->session->sess_destroy();  
      redirect('stylebuddy-admin', 'refresh');
    }
}
?>
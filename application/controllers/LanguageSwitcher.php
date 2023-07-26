<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class LanguageSwitcher extends CI_Controller
{
    public function __construct() {
        parent::__construct();
	}
 
    function switchLang($language = "") {
        //$this->session->sess_destroy();
        $frontUserData = [ 'loginUser','fname','lname','mobile','city_name','userId','venderId','email','userType','profile_update_ratio','currently_logged_in'];
        $this->session->unset_userdata($frontUserData);
        $language = ($language != "") ? $language : $this->config->item('language');
        $this->session->set_userdata('site_lang', $language);
        $sub = base_url();
        redirect($sub.'/'.$language);
    }
}
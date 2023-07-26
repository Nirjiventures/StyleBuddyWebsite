<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class User_authentication extends CI_Controller { 
     
    function __construct(){ 
        parent::__construct(); 
        //$this->load->library('Google'); 
        //$this->load->model('user'); 
        $this->load->library('google');
        $this->config->load('google_config');
    } 
     
    public function index(){ 
        echo die;
        // Redirect to profile page if the user already logged in 
        if($this->session->userdata('loggedIn') == true){ 
            redirect('user_authentication/profile/'); 
        } 
         
        if(isset($_GET['code'])){ 
             
            // Authenticate user with google 
            if($this->google->getAuthenticate()){ 
             
                // Get user info from google 
                $gpInfo = $this->google->getUserInfo(); 
                 
                // Preparing data for database insertion 
                $userData['oauth_provider'] = 'google'; 
                $userData['oauth_uid']         = $gpInfo['id']; 
                $userData['first_name']     = $gpInfo['given_name']; 
                $userData['last_name']         = $gpInfo['family_name']; 
                $userData['email']             = $gpInfo['email']; 
                $userData['gender']         = !empty($gpInfo['gender'])?$gpInfo['gender']:''; 
                $userData['locale']         = !empty($gpInfo['locale'])?$gpInfo['locale']:''; 
                $userData['picture']         = !empty($gpInfo['picture'])?$gpInfo['picture']:''; 
                 
                // Insert or update user data to the database 
                //$userID = $this->user->checkUser($userData); 
                $userID = 1; 
                 
                // Store the status and user profile info into session 
                $this->session->set_userdata('loggedIn', true); 
                $this->session->set_userdata('userData', $userData); 
                 
                // Redirect to profile page 
                redirect('user_authentication/profile/'); 
            } 
        }  
         
        // Google authentication url 
        $data['loginURL'] = $this->google->loginURL(); 
         
        // Load google login view 
        $this->load->view('user_authentication/index',$data); 
    } 
     
    public function profile(){ 
        // Redirect to login page if the user not logged in 
        if(!$this->session->userdata('loggedIn')){ 
            redirect('/user_authentication/'); 
        } 
         
        // Get user info from session 
        $data['userData'] = $this->session->userdata('userData'); 
         
        // Load user profile view 
        $this->load->view('user_authentication/profile',$data); 
    } 
     
    public function logout(){ 
        // Reset OAuth access token 
        $this->google->revokeToken(); 
         
        // Remove token and user data from the session 
        $this->session->unset_userdata('loggedIn'); 
        $this->session->unset_userdata('userData'); 
         
        // Destroy entire session data 
        $this->session->sess_destroy(); 
         
        // Redirect to login page 
        redirect('/user_authentication/'); 
    } 
    
    /*public function google_login(){
        $clientId = $this->config->item('google_client_id'); 
        $clientSecret = $this->config->item('google_client_secret');  
        $redirectURL = $this->config->item('google_redirect_url');
         
        
        $postData = $this->input->get();

         
        require_once APPPATH.'third_party/google/Google_Client.php';
        require_once APPPATH.'third_party/google/contrib/Google_Oauth2Service.php';

        
        
        $gClient = new Google_Client();
        $gClient->setApplicationName('Login');
        $gClient->setClientId($clientId);
        $gClient->setClientSecret($clientSecret);
        $gClient->setRedirectUri($redirectURL);
        $google_oauthV2 = new Google_Oauth2Service($gClient);
        
        if(isset($_GET['code'])){
            echo "<pre>";
            print_r($_GET['code']);
            die;
            $gClient->authenticate($_GET['code']);
            $_SESSION['token'] = $gClient->getAccessToken();
            header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
        }

        if (isset($_SESSION['token'])) {
            echo "<pre>";
            print_r($userProfile);
            die;
            $gClient->setAccessToken($_SESSION['token']);
        }
        
        if ($gClient->getAccessToken()) {
            $userProfile = $google_oauthV2->userinfo->get();
            $user_type = $this->session->userdata('log_user_type');
            echo "<pre>";
            print_r($userProfile);
            die;
            $table = "users";
            $email = $userProfile['email'];
            $social_id = $userProfile['id'];
            $social_type = 'google';
            $imageUrl = $userProfile['picture'];
            $first_name = $userProfile['given_name'];
            $last_name = $userProfile['family_name'];
            $imgName = $first_name.rand();
            
            $image = 'users/google_'.$imgName.'.png';
            $ch = curl_init($imageUrl);
            $fp = fopen('uploads/'.$image, 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp); 
            $insert_data                = array();
            $insert_data['social_type'] = trim($social_type);
            $insert_data['social_id'] = trim($social_id);
            $insert_data['profilephoto'] = trim($image);
            $insert_data['user_type']   = 5;
            $insert_data['status']  = 1;
            $insert_data['active']  = 1;
            $insert_data['first_name']  = trim($first_name);
            $insert_data['last_name']   = trim($last_name);
            $insert_data['created_at']  = date("Y-m-d h:i:s");
            $insert_data['email']       = trim($email);
            $insert_data['username']    = trim($email);
                
             
            //$row = $this->common_model->commonUpdate('user_cart',$updateCond,$wherCond);
            //$row = $this->common_model->commonUpdate('user_wishlist',$updateCond,$wherCond);
            $this->session->set_flashdata('login_social_error', 'Logged in Successfully.');
            redirect(base_url());
        } 
        else 
        {
            echo $url = $gClient->createAuthUrl();
            header("Location: $url");
            exit;
        }
    }
    public function google_logout(){ 
        require_once APPPATH.'third_party/src/Google_Client.php';
        require_once APPPATH.'third_party/src/contrib/Google_Oauth2Service.php';

        $clientId = $this->config->item('google_client_id'); 
        $clientSecret = $this->config->item('google_client_secret');  
        $redirectURL = $this->config->item('google_redirect_url');
        
        $gClient = new Google_Client();

        $gClient->revokeToken(); 
        $this->session->unset_userdata('loggedIn'); 
        $this->session->unset_userdata('userData'); 
        $this->session->sess_destroy(); 
    }*/
    
     
    public function google_login(){
        $data['google_login_url']=$this->google->get_login_url();
        $this->load->view('home',$data);
    }

    public function oauth2callback(){
        
        if (isset($_GET['code'])) {
            $this->client = new Google_Client();
		    $this->client->authenticate($_GET['code']);
		     
            var_dump($this->client->getAccessToken());die;
		}
		 if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
		    $this->client->setAccessToken($_SESSION['access_token']);
		    $plus = new Google_Service_Plus($this->client);
			$person = $plus->people->get('me');
			$info['id']=$person['id'];
			$info['email']=$person['emails'][0]['value'];
			$info['name']=$person['displayName'];
			$info['link']=$person['url'];
			$info['profile_pic']=substr($person['image']['url'],0,strpos($person['image']['url'],"?sz=50")) . '?sz=800';
            var_dump($info);
		    return  $info;
		}
		 
        /*$google_data=$this->google->validate();
        $session_data=array(
            'name'=>$google_data['name'],
            'email'=>$google_data['email'],
            'source'=>'google',
            'profile_pic'=>$google_data['profile_pic'],
            'link'=>$google_data['link'],
            'sess_logged_in'=>1
            );
        $this->session->set_userdata($session_data);
        //var_dump($session_data);die;
        redirect(base_url('user_authentication/google_login'));*/
    }
    public function google_logout(){
        session_destroy();
        unset($_SESSION['access_token']);
        $session_data=array(
                'sess_logged_in'=>0);
        $this->session->set_userdata($session_data);
        redirect(base_url('user_authentication/google_login'));
    }
     
}
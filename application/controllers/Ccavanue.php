<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ccavanue extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Page_Model');
        $this->site = $this->Page_Model->allController();
        $this->style = $this->Page_Model->stylist();
        
        $this->load->library('PHPMailer_Lib');
        $this->mail = $this->phpmailer_lib->load();
        
        define('WORKING_KEY', '8D794C37ECE872F8CB371001C5CD06CF');
	    define('ACCESS_CODE', 'AVWE00JG72BL21EWLB');
    }
    function encrypt($plainText,$key){
		$key = $this->hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$openMode = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
		$encryptedText = bin2hex($openMode);
		return $encryptedText;
	}

	function decrypt($encryptedText,$key){
		$key = $this->hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$encryptedText = $this->hextobin($encryptedText);
		$decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
		return $decryptedText;
	}
	//*********** Padding Function *********************

	function pkcs5_pad ($plainText, $blockSize){
	    $pad = $blockSize - (strlen($plainText) % $blockSize);
	    return $plainText . str_repeat(chr($pad), $pad);
	}

	//********** Hexadecimal to Binary function for php 4.0 version ********

	function hextobin($hexString) { 
        $length = strlen($hexString); 
        $binString="";   
        $count=0; 
        while($count<$length){       
            $subString =substr($hexString,$count,2);           
            $packedString = pack("H*",$subString); 
            if ($count==0){
                $binString=$packedString;
            }  else{
                $binString.=$packedString;
            } 
            
            $count+=2; 
        } 
        return $binString; 
    }
    
    
    public function initialForm(){
        $merchant_data='2';
    	$working_key=WORKING_KEY; 
    	$access_code=ACCESS_CODE; 
    	
    	$postData =  $this->input->post();
    	
    	$postData['payment_gateway']  = 'ccavanue';
        $postData['full_name']  = $postData['fname'].' '.$postData['lname'];
        $postData['created_at']  = date('Y-m-d h:i:s');
        
        if($this->session->userdata('userId')){
            $postData['user_id']  = $this->session->userdata('userId');
        }
        $this->db->insert('intial_booking',$postData);
        $orderId = $this->db->insert_id();
        
    	$postData['tid'] = time(); 
    	$postData['amount'] = 1000; 
    	$postData['currency'] = 'INR'; 
    	
    	$postData['order_id'] = $orderId; 
    	$postData['merchant_id'] = 1104336; 
    	$postData['redirect_url'] = base_url('ccavanue/initialFormResponse'); 
    	$postData['cancel_url'] = base_url('ccavanue/initialFormResponse'); 
    	$postData['language'] = 'EN'; 
    	foreach ($postData as $key => $value){
    		$merchant_data.=$key.'='.$value.'&';
    	}
    
    	$encrypted_data=$this->encrypt($merchant_data,$working_key);
    	$data['encrypted_data'] = $encrypted_data;
    	$data['access_code'] = ACCESS_CODE;
    	
    	$this->load->view('ccavanue-form',$data);

    } 
    public function initialFormResponse(){
        error_reporting(0);
    	if(!$_POST){
    	   redirect(base_url()); 
    	}
    	$workingKey=WORKING_KEY;		//Working Key should be provided here.
    	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
    	$rcvdString=$this->decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
    	
    	$data['rcvdString'] = $rcvdString;
    	$decryptValues=explode('&', $rcvdString);
    	$dataSize=sizeof($decryptValues);
    	
    	for($i = 0; $i < $dataSize; $i++) {
    		$information=explode('=',$decryptValues[$i]);
    		if(!empty($information[1])){
    		    if($information[0] == 'order_id'){
    		       $p['order_id'] =   $information[1];
    		    }else if($information[0] == 'tracking_id'){
    		       $p['txn_id'] =   $information[1];
    		    }else if($information[0] == 'order_status'){
    		       $p['order_status'] =   $information[1];
    		       $p['payment_status'] =   $information[1];
    		    }else if($information[0] == 'payment_mode'){
    		       $p['payment_mode'] =   $information[1];
    		    }else if($information[0] == 'currency'){
    		       $p['currency'] =   $information[1];
    		    }else if($information[0] == 'amount'){
    		       $p['price'] =   $information[1];
    		    }else if($information[0] == 'card_name'){
    		       $p['card_name'] =   $information[1];
    		       $p['method'] =   $information[1];
    		    }else{
    		       //$p[$information[0]] =   $information[1]; 
    		    }
    		}
    	}
    	
    	//$p['payment_gateway']  = 'ccavanue';
        //$p['created_at']  = date('Y-m-d h:i:s');
        //$this->db->insert('intial_booking',$p);
    
        $orderId = $p['order_id'];
        $this->db->where('id', $orderId);
        $update_password = $this->db->update('intial_booking',$p);
        
        $bookRow = $this->db->get_where('intial_booking',['id'=> $orderId])->row();
        $userId = $bookRow->user_id;
        
        $table = 'vender';
        $user = $this->db->query('select * from '.$table.' WHERE id="'.$userId.'"')->row();
        $frontUserData = [ 'loginUser'=>$user->fname.' '.$user->lname,'fname'=>$user->fname, 'lname'=>$user->lname,  'mobile'=>$user->mobile,  'city_name'=>$user->city_name, 'userId'=>$user->id, 'venderId'=>$user->id,  'email'=> $user->email, 'userType'=>$user->user_type,'currently_logged_in' => 1 ];
                    $this->session->set_userdata($frontUserData);
                        
        //sentMailFlag
    	$this->load->view('initital-form-response',$data);
    }


    public function userOrder() {
        $merchant_data='2';
        $working_key=WORKING_KEY; 
        $access_code=ACCESS_CODE; 

        $total = $this->cart->total();
        $cart = $this->cart->contents();
        $productList = array();
        $uploadData = array();
        $postData = $this->input->post();
        $data['total_price'] = $total;
        $data['order_id'] = $this->input->post('merchant_order_id');
        $data['pay_type'] = $this->input->post('pay_type');
        $data['payment_gateway'] = $this->input->post('pay_type');
        $data['fname'] = $this->input->post('fname');
        $data['lname'] = $this->input->post('lname');
        $data['company'] = $this->input->post('company');
        $data['address'] = $this->input->post('address'); 
        $data['city'] = $this->input->post('city');
        $data['state'] = $this->input->post('state');
        $data['pincode'] = $this->input->post('zip');
        $data['country'] = $this->input->post('country');
        $data['mobile'] = $this->input->post('mobile');
        $data['user_id'] = $this->session->userdata('userId');
        $data['user_email'] = $this->session->userdata('email');
        $data['payment_status'] = 'NONE';
        $data['order_status'] = 'Unfinished order';
        $data['created_at'] = date('Y-m-d H:i:s');

        $postData['full_name']  = $postData['fname'].' '.$postData['lname'];
        $orderId = 0;
        if(!empty($cart)) {    
            $this->db->insert('user_order',$data);
            $orderId = $this->db->insert_id();
        }
        foreach($cart as $cartval) {
             $productList[] = array(
                    'productId' =>  $cartval['id'],
                    'productName' =>  $cartval['name'],
                    'productQty' =>  $cartval['qty'],
                    'productMrpPrice' =>  $cartval['mrpprice'],
                    'productPrice' =>  $cartval['price'],
                    'productImg' =>  $cartval['options']['image'],
                    'catId' =>  $cartval['options']['catId'],
                    'discount' =>  $cartval['discount'],
                    'discountPrice' =>  $cartval['discountPrice'],
                    'totalDiscount' =>  $cartval['discountPrice'] * $cartval['qty'],
                    'totalMrpPrice' =>  $cartval['mrpprice'] * $cartval['qty'],
                    'totalPrice' =>  $cartval['subtotal'],
                    'venderId' =>  $cartval['options']['venderId'],
                    'size' =>  $cartval['options']['size']
                    );
        }
        

        for($i = 0; $i < count($productList); $i++ ) {
                  
              $uploadData[$i]['orderId'] = $orderId;    
              $uploadData[$i]['user_id'] = $data['user_id'];
              $uploadData[$i]['invoiceNo'] = $orderId; 
              $uploadData[$i]['productId'] = $productList[$i]['productId'];
              $uploadData[$i]['productName'] = $productList[$i]['productName'];
              $uploadData[$i]['productMrpPrice'] = $productList[$i]['productMrpPrice'];
              $uploadData[$i]['productPrice'] = $productList[$i]['productPrice'];
              $uploadData[$i]['productQty'] = $productList[$i]['productQty'];
              $uploadData[$i]['totalPrice'] = $productList[$i]['totalPrice'];
              $uploadData[$i]['totalMrpPrice'] = $productList[$i]['totalMrpPrice'];
              $uploadData[$i]['productImg'] = $productList[$i]['productImg'];
              
              $uploadData[$i]['catId'] = $productList[$i]['catId'];
              $uploadData[$i]['discount'] = $productList[$i]['discount'];
              $uploadData[$i]['discountPrice'] = $productList[$i]['discountPrice']; 
              $uploadData[$i]['totalDiscount'] = $productList[$i]['totalDiscount']; 
              $uploadData[$i]['venderId'] = $productList[$i]['venderId'];
              $uploadData[$i]['size'] = $productList[$i]['size'];
              $uploadData[$i]['created_at'] = date('Y-m-d H:i:s');
        }
        $this->db->insert_batch('user_order_details',$uploadData);
          
        $userInvoice = ['orderId'=> $orderId];
        $this->session->set_userdata($userInvoice);
        if ($this->input->post('pay_type') == 'ccavanue') {
            $postData['tid'] = time(); 
            $postData['amount'] = $total; 
            $postData['currency'] = 'INR'; 
            
            $postData['order_id'] = $orderId; 
            $postData['merchant_id'] = 1104336; 
            $postData['redirect_url'] = base_url('ccavanue/ordrresponse'); 
            $postData['cancel_url'] = base_url('ccavanue/ordrresponse'); 
            $postData['language'] = 'EN'; 
            foreach ($postData as $key => $value){
                $merchant_data.=$key.'='.$value.'&';
            }
        
            $encrypted_data=$this->encrypt($merchant_data,$working_key);
            $data['encrypted_data'] = $encrypted_data;
            $data['access_code'] = ACCESS_CODE;
            
            $this->load->view('ccavanue-form',$data);

        }else if ($this->input->post('pay_type') == 'ROZARPAY') {
            if (!empty($this->input->post('razorpay_payment_id')) && !empty($this->input->post('merchant_order_id'))) {
                $razorpay_payment_id = $this->input->post('razorpay_payment_id');
                $merchant_order_id = $this->input->post('merchant_order_id');
                
                $this->session->set_flashdata('razorpay_payment_id', $razorpay_payment_id);
                $this->session->set_flashdata('merchant_order_id', $razorpay_payment_id);
                $currency_code = 'INR';
                $amount = $this->input->post('merchant_total');
                $success = false;
                $error = '';
                try {                
                    $ch = $this->curl_handler($razorpay_payment_id, $amount);
                    //execute post
                    $result = curl_exec($ch);
                    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    if ($result === false) {
                        $success = false;
                        $error = 'Curl error: '.curl_error($ch);
                    } else {
                        $response_array = json_decode($result, true);
                        if ($http_status === 200 and isset($response_array['error']) === false) {
                            $success = true;
                            $payment_method = $response_array['method'];
                            if ($response_array['status'] == 'captured') {
                                $payment_status = 'APPROVED';
                            }else{
                               $payment_status = $response_array['status']; 
                            }
                            

                        } else {
                            $success = false;
                            if (!empty($response_array['error_code'])) {
                                $error = $response_array['error_code'].':'.$response_array['error_description'];
                            } else {
                                $error = 'RAZORPAY_ERROR:Invalid Response <br/>'.$result;
                            }
                        }
                    }
                    curl_close($ch);
                } catch (Exception $e) {
                    $success = false;
                    $error = 'Request to Razorpay Failed';
                }
                
                if ($success === true) {
                    if(!empty($this->session->userdata('ci_subscription_keys'))) {
                        //$this->session->unset_userdata('ci_subscription_keys');
                    }
                     
                    $up['txn_id'] = $this->session->flashdata('razorpay_payment_id');
                    $up['payment_status'] = $payment_status;
                    $up['method'] = $payment_method;
                    $up['order_status'] = 'Pending';

                    $this->db->where('id', $orderId);
                    $update_password = $this->db->update('user_order',$up); 
                    try {
                        $postData['orderId'] = $orderId;
                        $postData['email'] = 'vijay@gleamingllp.com';
                        $this->sendMail($postData);
                    } catch (Exception $e) {
                        
                    }
                    redirect($this->input->post('merchant_surl_id'));
                    
                } else {
                    redirect($this->input->post('merchant_furl_id'));
                }
            } else {
                echo 'An error occured. Contact site administrator, please!';
            }
        }else{
            $payment_status = 'Pending';
            $payment_method = 'COD';
             
            $up['txn_id'] = $this->session->flashdata('razorpay_payment_id');
            $up['payment_status'] = $payment_status;
            $up['method'] = $payment_method;
            $up['order_status'] = 'Pending';

            $this->db->where('id', $orderId);
            $update_password = $this->db->update('user_order',$up); 
            try {
                $postData['orderId'] = $orderId;
                $postData['email'] = 'vijay@gleamingllp.com';
                $this->sendMail($postData);
            } catch (Exception $e) {
                
            }
            redirect($this->input->post('merchant_surl_id'));
        }
    } 
    public function ordrresponse(){
        error_reporting(0);
        if(!$_POST){
           redirect(base_url()); 
        }
        $workingKey=WORKING_KEY;        //Working Key should be provided here.
        $encResponse=$_POST["encResp"];         //This is the response sent by the CCAvenue Server
        $rcvdString=$this->decrypt($encResponse,$workingKey);       //Crypto Decryption used as per the specified working key.
        
        $data['rcvdString'] = $rcvdString;
        $decryptValues=explode('&', $rcvdString);
        $dataSize=sizeof($decryptValues);
        
        for($i = 0; $i < $dataSize; $i++) {
            $information=explode('=',$decryptValues[$i]);
            if(!empty($information[1])){
                if($information[0] == 'order_id'){
                   $p['order_id'] =   $information[1];
                }else if($information[0] == 'tracking_id'){
                   $p['txn_id'] =   $information[1];
                }else if($information[0] == 'order_status'){
                   //$p['order_status'] =   $information[1];
                   $p['order_status'] = 'Pending';
                   $p['payment_status'] =   $information[1];
                }else if($information[0] == 'payment_mode'){
                   $p['payment_mode'] =   $information[1];
                }else if($information[0] == 'currency'){
                   $p['currency'] =   $information[1];
                }else if($information[0] == 'amount'){
                   $p['total_price'] =   $information[1];
                }else if($information[0] == 'card_name'){
                   $p['card_name'] =   $information[1];
                   $p['method'] =   $information[1];
                }else{
                   //$p[$information[0]] =   $information[1]; 
                }
            }
        }
        
        $orderId = $p['order_id'];
        $this->db->where('id', $orderId);
        $update_password = $this->db->update('user_order',$p);
        
        $bookRow = $this->db->get_where('user_order',['id'=> $orderId])->row();
        $userId = $bookRow->user_id;
        
        $table = 'vender';
        $user = $this->db->query('select * from '.$table.' WHERE id="'.$userId.'"')->row();
        $frontUserData = [ 'loginUser'=>$user->fname.' '.$user->lname,'fname'=>$user->fname, 'lname'=>$user->lname,  'mobile'=>$user->mobile,  'city_name'=>$user->city_name, 'userId'=>$user->id, 'venderId'=>$user->id,  'email'=> $user->email, 'userType'=>$user->user_type,'currently_logged_in' => 1 ];
        $this->session->set_userdata($frontUserData);

        $id = $orderId;
        $data['order'] = $order = $this->db->get_where('user_order',['id'=> $id])->row();

        $this->db->select ( 'user_order.*, user_order_details.*' ); 
        $this->db->from ( 'user_order' );
        $this->db->join ( 'user_order_details','user_order_details.invoiceNo = user_order.id');
        $this->db->order_by("user_order.id", "DESC");
        $this->db->where ( 'user_order.id',$id);
        $query = $this->db->get();
        $data['orderDetails'] = $orderDetails = $query->result();

        $mail=array();
        $mail['order_table'] = 'order'; 
        $mail['order_id'] = $id; 
        $this->sendMail($mail);

        $data['title'] = 'Ccavanue Success';
        $msg = "<h4>Your transaction is successful</h4>";  
        $msg .= "<br/>";
        $msg .= "Transaction ID: ".$this->session->flashdata('razorpay_payment_id');
        $msg .= "<br/>";
        $msg .= "Order ID: ".$this->session->flashdata('merchant_order_id');
        $data['message'] = $msg;
        $this->load->view('order-success',$data);

                        
        //sentMailFlag
        //$this->load->view('initital-form-response',$data);
    }
     

    
    public function success() {
        $id = $this->session->userdata('orderId');
        $data['order'] = $order = $this->db->get_where('user_order',['id'=> $id])->row();

        $this->db->select ( 'user_order.*, user_order_details.*' ); 
        $this->db->from ( 'user_order' );
        $this->db->join ( 'user_order_details','user_order_details.invoiceNo = user_order.id');
        $this->db->order_by("user_order.id", "DESC");
        $this->db->where ( 'user_order.id',$id);
        $query = $this->db->get();
        $data['orderDetails'] = $orderDetails = $query->result();

        $mail=array();
        $mail['order_table'] = 'order'; 
        $mail['order_id'] = $id; 
        $this->sendMail($mail);

        $data['title'] = 'Razorpay Success';
        $msg = "<h4>Your transaction is successful</h4>";  
        $msg .= "<br/>";
        $msg .= "Transaction ID: ".$this->session->flashdata('razorpay_payment_id');
        $msg .= "<br/>";
        $msg .= "Order ID: ".$this->session->flashdata('merchant_order_id');
        $data['message'] = $msg;
        $this->load->view('order-success',$data);   

    }  
    public function failed() {
        $data['title'] = 'Razorpay Failed';  
        $msg = "<h4>Your transaction got Failed</h4>";  
        $msg .= "<br/>";
        $msg .= "Transaction ID: ".$this->session->flashdata('razorpay_payment_id');
        $msg .= "<br/>";
        $msg .= "Order ID: ".$this->session->flashdata('merchant_order_id');
        $data['message'] = $msg;
        $this->load->view('order-failed',$data);
    }

    public function fashion_success() {
        /*$id = $this->session->userdata('orderId');
        $data['order'] = $order = $this->db->get_where('user_order',['id'=> $id])->row();

        $this->db->select ( 'user_order.*, user_order_details.*' ); 
        $this->db->from ( 'user_order' );
        $this->db->join ( 'user_order_details','user_order_details.invoiceNo = user_order.id');
        $this->db->order_by("user_order.id", "DESC");
        $this->db->where ( 'user_order.id',$id);
        $query = $this->db->get();
        $data['orderDetails'] = $orderDetails = $query->result();

        $mail=array();
        $mail['order_table'] = 'order'; 
        $mail['order_id'] = $id; 
        $this->sendMail($mail);*/
        $data['order'] = array();
        $data['title'] = 'Razorpay Success';
        $msg = "<h4>Your transaction is successful</h4>";  
        $msg .= "<br/>";
        $msg .= "Transaction ID: ".$this->session->flashdata('razorpay_payment_id');
        $msg .= "<br/>";
        $msg .= "Order ID: ".$this->session->flashdata('merchant_order_id');
        $data['message'] = $msg;
        $this->load->view('order-success',$data);   

    }  
    public function fashion_failed() {
        $data['title'] = 'Razorpay Failed';  
        $msg = "<h4>Your transaction got Failed</h4>";  
        $msg .= "<br/>";
        $msg .= "Transaction ID: ".$this->session->flashdata('razorpay_payment_id');
        $msg .= "<br/>";
        $msg .= "Order ID: ".$this->session->flashdata('merchant_order_id');
        $data['message'] = $msg;
        $this->load->view('order-failed',$data);
    }
    public function fashon_consulting_booking() {   
        $total = $this->cart->total();
        $cart = $this->cart->contents();
        $productList = array();
        $uploadData = array();
        $postData = $this->input->post();

        $insert['order_id'] = $this->input->post('merchant_order_id');
        $insert['consulting_id'] = $this->session->userdata('consulting_id');
        $insert['payment_gateway'] = $this->input->post('pay_type');
        $insert['date'] = $this->session->userdata('date');
        $insert['time'] = $this->session->userdata('time');
        $insert['staff'] = $this->session->userdata('staff');
        $insert['price'] = $this->session->userdata('price');
        $insert['service_name'] = $this->session->userdata('name');
        $insert['meetingHour'] = $this->session->userdata('meetingHour');
        $insert['fname'] = $this->input->post('fname');
        $insert['lname'] = $this->input->post('lname');
        $insert['mobile'] = $this->input->post('mobile');
        $insert['email'] = $this->input->post('email');
        $insert['address'] = $this->input->post('address');
        $insert['country'] = $this->input->post('country');
        $insert['state'] = $this->input->post('state');
        $insert['city'] = $this->input->post('city');
        $insert['pincode'] = $this->input->post('zip');
        $insert['requiremnt'] = $this->input->post('requiremnt');
        $insert['age'] = $this->input->post('age');
        $insert['favorite_color'] = $this->input->post('favorite_color'); 
        $insert['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('fashon_consulting_booking',$insert);
        $orderId = $this->db->insert_id();  
        $userInvoice = ['fashon_booking_id'=> $orderId];
        $this->session->set_userdata($userInvoice);

        if ($this->input->post('pay_type') == 'ROZARPAY') {
            if (!empty($this->input->post('razorpay_payment_id')) && !empty($this->input->post('merchant_order_id'))) {
                $razorpay_payment_id = $this->input->post('razorpay_payment_id');
                $merchant_order_id = $this->input->post('merchant_order_id');
                
                $this->session->set_flashdata('razorpay_payment_id', $razorpay_payment_id);
                $this->session->set_flashdata('merchant_order_id', $razorpay_payment_id);
                $currency_code = 'INR';
                $amount = $this->input->post('merchant_total');
                $success = false;
                $error = '';
                try {                
                    $ch = $this->curl_handler($razorpay_payment_id, $amount);
                    //execute post
                    $result = curl_exec($ch);
                    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    if ($result === false) {
                        $success = false;
                        $error = 'Curl error: '.curl_error($ch);
                    } else {
                        $response_array = json_decode($result, true);
                        if ($http_status === 200 and isset($response_array['error']) === false) {
                            $success = true;
                            $payment_method = $response_array['method'];
                            $payment_status = $response_array['status'];
                        } else {
                            $success = false;
                            if (!empty($response_array['error_code'])) {
                                $error = $response_array['error_code'].':'.$response_array['error_description'];
                            } else {
                                $error = 'RAZORPAY_ERROR:Invalid Response <br/>'.$result;
                            }
                        }
                    }
                    curl_close($ch);
                } catch (Exception $e) {
                    $success = false;
                    $error = 'Request to Razorpay Failed';
                }
                
                if ($success === true) {
                    if(!empty($this->session->userdata('ci_subscription_keys'))) {
                        //$this->session->unset_userdata('ci_subscription_keys');
                    }
                    $up['txn_id'] = $this->session->flashdata('razorpay_payment_id');
                    $up['payment_status'] = $payment_status;
                    $up['method'] = $payment_method;
                    $up['order_status'] = 'Pending';

                    $this->db->where('id', $orderId);
                    $update_password = $this->db->update('fashon_consulting_booking',$up); 

                    redirect($this->input->post('merchant_surl_id'));
                    
                } else {
                    redirect($this->input->post('merchant_furl_id'));
                }
            } else {
                echo 'An error occured. Contact site administrator, please!';
            }
        }else{
            $payment_status = 'Pending';
            $payment_method = 'COD';
            $up['txn_id'] = $this->session->flashdata('razorpay_payment_id');
            $up['payment_status'] = $payment_status;
            $up['method'] = $payment_method;
            $up['order_status'] = 'Pending';

            $this->db->where('id', $orderId);
            $update_password = $this->db->update('fashon_consulting_booking',$up); 

            redirect($this->input->post('merchant_surl_id'));
        }
    } 

    public function intial_booking_form() {   
         
        $postData = $this->input->post();

        $insert['order_id'] = $this->input->post('merchant_order_id');
        $insert['payment_gateway'] = $this->input->post('pay_type');
        $insert['price'] = $this->input->post('merchant_total');
        $insert['fname'] = $this->input->post('fname');
        $insert['lname'] = $this->input->post('lname');
        $insert['mobile'] = $this->input->post('mobile');
        $insert['email'] = $this->input->post('email');
        $insert['address'] = $this->input->post('address');
        $insert['special_instruction'] = $this->input->post('special_instruction');
        $insert['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('intial_booking',$insert);
        $orderId = $this->db->insert_id();  
        $userInvoice = ['invoice'=> $orderId];
        $this->session->set_userdata($userInvoice);

        if ($this->input->post('pay_type') == 'ROZARPAY') {
            if (!empty($this->input->post('razorpay_payment_id')) && !empty($this->input->post('merchant_order_id'))) {
                $razorpay_payment_id = $this->input->post('razorpay_payment_id');
                $merchant_order_id = $this->input->post('merchant_order_id');
                
                $this->session->set_flashdata('razorpay_payment_id', $razorpay_payment_id);
                $this->session->set_flashdata('merchant_order_id', $razorpay_payment_id);
                $currency_code = 'INR';
                $amount = $this->input->post('merchant_total');
                $success = false;
                $error = '';
                try {                
                    $ch = $this->curl_handler($razorpay_payment_id, $amount);
                    //execute post
                    $result = curl_exec($ch);
                    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    if ($result === false) {
                        $success = false;
                        $error = 'Curl error: '.curl_error($ch);
                    } else {
                        $response_array = json_decode($result, true);
                        if ($http_status === 200 and isset($response_array['error']) === false) {
                            $success = true;
                            $payment_method = $response_array['method'];
                            $payment_status = $response_array['status'];
                        } else {
                            $success = false;
                            if (!empty($response_array['error_code'])) {
                                $error = $response_array['error_code'].':'.$response_array['error_description'];
                            } else {
                                $error = 'RAZORPAY_ERROR:Invalid Response <br/>'.$result;
                            }
                        }
                    }
                    curl_close($ch);
                } catch (Exception $e) {
                    $success = false;
                    $error = 'Request to Razorpay Failed';
                }
                
                if ($success === true) {
                    if(!empty($this->session->userdata('ci_subscription_keys'))) {
                        //$this->session->unset_userdata('ci_subscription_keys');
                    }
                    $up['txn_id'] = $this->session->flashdata('razorpay_payment_id');
                    $up['payment_status'] = $payment_status;
                    $up['method'] = $payment_method;
                    $up['order_status'] = 'Pending';

                    $this->db->where('id', $orderId);
                    $update_password = $this->db->update('intial_booking',$up); 

                    redirect($this->input->post('merchant_surl_id'));
                    
                } else {
                    redirect($this->input->post('merchant_furl_id'));
                }
            } else {
                echo 'An error occured. Contact site administrator, please!';
            }
        }else{
            $payment_status = 'Pending';
            $payment_method = 'COD';
            $up['txn_id'] = $this->session->flashdata('razorpay_payment_id');
            $up['payment_status'] = $payment_status;
            $up['method'] = $payment_method;
            $up['order_status'] = 'Pending';

            $this->db->where('id', $orderId);
            $update_password = $this->db->update('intial_booking',$up); 

            redirect($this->input->post('merchant_surl_id'));
        }
    }
     
    public function sendMail($data){
         
        if ($data['order_table'] == 'order') { 
            $id = $data['order_id'];
            //$order = $this->db->get_where('user_order',['id'=> $id])->row();
            $order = $this->db->get_where('user_order',['id'=> $id,'sentMailFlag'=>0])->row();
            if ($order) { 
                $this->db->select ( 'user_order.*, user_order_details.*' ); 
                $this->db->from ( 'user_order' );
                $this->db->join ( 'user_order_details','user_order_details.invoiceNo = user_order.id');
                $this->db->order_by("user_order.id", "DESC");
                $this->db->where ( 'user_order.id',$id);
                $query = $this->db->get();
                $orderDetails = $query->result();

                
                $up = array();
                $up['sentMailFlag'] = 1;
                $this->db->where('id', $id);
                $this->db->update('user_order',$up); 
                 
                $style = '<style>.approved {
                                    color: green;
                                    font-weight: bold;
                                }
                                .rightbar table {
                                    border: 1px solid #ccc;
                                }
                                .table{width:100%;border-collapse: collapse;}
                                .text-center {
                                    text-align: center!important;
                                }
                                .table>tbody {
                                    vertical-align: inherit;
                                }
                                tbody, td, tfoot, th, thead, tr {
                                    border-color: inherit;
                                    border-style: solid;
                                    border-width: 1px;
                                    padding:5px 10px;
                                }
                                .rightbar table tr td {
                                    vertical-align: middle;
                                }
                                .min_pro {
                                    width: 60px;
                                    height: 60px;
                                    border-radius: 4px;
                                    border: 1px solid #333;
                                    padding: 5px;
                                    margin-right: 10px;
                                }
                                .table-striped>tbody>tr:nth-of-type(odd)>*{background:rgb(234 231 207);}
                                .table>:not(caption)>*>*{background:#fff;}

                                .pp_profile {
                                    background: #e5da95;
                                    padding: 30px;
                                    margin-bottom: 20px;
                                    line-height: 7px;
                                }
                                h3.uk_title {
                                    margin-bottom: 20px;
                                }
                                table {
                                    border-collapse: collapse;
                                }
                                </style>';
                $option = $style;
                $option .= '<div class="summery_order" style="background:#f7f3da;">
                            <hr/> 
                            <div class="row align-items-center">

                                <div class="col-sm-12">
                                    <p class="odds">
                                        <b>Order ID : #'.$order->id.' | </b>
                                        <b>Payment Method: <span class="approved" style="color: green;font-weight: bold;">'.$order->payment_gateway.'</span> | </b>
                                        <b>Payment Status: <span class="approved" style="color: green;font-weight: bold;">'.$order->payment_status.'</span> | </b>
                                        Order Status: <span class="approved" style="color: green;font-weight: bold;">'.$order->order_status .'</span>  |  
                                        Order Date : '. date('j F, Y',strtotime($order->created_at)) .'
                                    </p>
                                </div>
                            </div>
                            <hr/>
                            <table cellspacing="0" cellpadding="4" class="table table-bordered table-striped text-center" style="width:100%; border: 1px solid #ccc; border-collapse: collapse; text-align:center;">
                                
                                <tr style="border: 1px solid #333;">
                                    <td style="border: 1px solid #333; "></td>
                                    <td style="border: 1px solid #333; ">Product Name</td>
                                    <td style="border: 1px solid #333; ">Price</td>
                                    <td style="border: 1px solid #333; ">Discount</td>
                                    <td style="border: 1px solid #333; ">Qty</td>
                                    <td style="border: 1px solid #333; ">Subtotal</td>
                                </tr>';
                                $total = 0; 
                                $discountTotal = 0;
                             
                                foreach($orderDetails as $list) { 
                                    $total += $list->totalMrpPrice;
                                    $discountTotal += $list->totalDiscount; 
                                    $option .= '<tr style="border: 1px solid #333;">
                                        <td style="border: 1px solid #333;"> <img src="'.base_url('assets/images/product/').$list->productImg .'" class="min_pro" width="100px" style="width: 60px;height: 60px;border-radius: 4px;border: 1px solid #333;padding: 5px;margin-right: 10px;"> </td>
                                        <td style="border: 1px solid #333;" class="text-left">'. $list->productName .'</td>';

                                        $option .= '<td style="border: 1px solid #333;">';
                                        if ($list->productMrpPrice > $list->productPrice) {
                                            $option .= '<span style="text-decoration: line-through;">'. $this->site->currency.' '.number_format($list->productMrpPrice) .'</span>&nbsp;&nbsp;';
                                            $option .= $this->site->currency.' '.number_format($list->productPrice) ;
                                        }else{
                                            $option .= $this->site->currency.' '.number_format($list->productPrice);
                                        }
                                        $option .= '</td>';
                                        
                                        $option .= '<td style="border: 1px solid #333;">'. ' '.number_format($list->discount) .'%</td>
                                        <td style="border: 1px solid #333;">'. $list->productQty .' </td>
                                        <td style="border: 1px solid #333;">'.  $this->site->currency.' '.number_format($list->productPrice*$list->productQty) .'</td>
                                    </tr>';
                                }  
                                $option .= '<tr style="border: 1px solid #333;">
                                    <td colspan="4" class="text-right" style="border: 1px solid #333;"></td>
                                    <td class="text-right" style="border: 1px solid #333;"><b> Total</b></td>
                                    <td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.number_format($total) .'</b></td>
                                </tr>';
                                $option .= '<tr style="border: 1px solid #333;">
                                    <td colspan="4" class="text-right" style="border: 1px solid #333;"></td>
                                    <td class="text-right" style="border: 1px solid #333;"><b> Discount</b></td>
                                    <td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.number_format($discountTotal) .'</b></td>
                                </tr>';
                                $option .= '<tr style="border: 1px solid #333;">
                                    <td colspan="4" class="text-right" style="border: 1px solid #333;"></td>
                                    <td class="text-right" style="border: 1px solid #333;"><b> Subtotal</b></td>
                                    <td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.number_format($order->total_price) .'</b></td>
                                </tr>';
                            $option .= '</table>
                            <div class="pp_profile" style="background: #e5da95;padding: 30px;margin-bottom: 20px;line-height: 7px; margin-top:20px;">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h3 class="uk_title">Shipping Address</h3>
                                        <p>'. $order->address .'</p>
                                        <p>Pin - '. $order->pincode .'</p>
                                        <p>'. $order->city.', '.$order->state.' - '.$order->country .'</p>
                                        <p>Email : '. $order->user_email .'</p>
                                        <p>Mobile : '. $order->mobile .'</p>
                                    </div>
                                </div>
                            </div>
                        </div>';
                $subject =  'Your '.$this->site->site_name.' order has been received!';
                $this->mail->setFrom($order->user_email);
                $this->mail->addAddress($this->mail->Username,$this->site->site_name);
                $this->mail->Subject = $subject;   
                $mailContent = '<p><b>Dear : Admin</b></p>';
                $mailContent .= $option;
                $mailContent .= '<hr/>';
                $mailContent .= '<p>Thanks for order</p>
                            <p><b>Regards</b><br/>'.$this->site->site_name.'</p>
                            <b>CONTACT INFO</b>
                            <p>'.$this->site->mobile.'<br/>Email: '.$this->site->email.''.$this->site->address.'</p>';

                $this->mail->Body = $mailContent;
                $admin =  $this->mail->send();






                $to      =  'vijay@gleamingllp.com,'.$order->user_email;
                $form =  $this->mail->Username;
                $mailContent = '<p><b>Dear : </b>'.ucwords($order->fname.' '.$order->lname).'</p>';
                $mailContent .= $option;
                $mailContent .= '<hr/>';
                $mailContent .= '<p>Thanks for order</p>
                            <p><b>Regards</b><br/>'.$this->site->site_name.'</p>
                            <b>CONTACT INFO</b>
                            <p>'.$this->site->mobile.'<br/>Email: '.$this->site->email.''.$this->site->address.'</p>';
                
                /*$headers =  "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .=  "From: Quinzzy <$form>"  . "\r\n";
                $headers .=  "Reply-To: $form"  . "\r\n";
                mail($to, $subject, $mailContent, $headers);*/

                /*$this->load->library('m_pdf');
                $mpdf = new mPDF();
                $mpdf->autoLangToFont = true; 
                $mpdf->autoScriptToLang = true;
                $mpdf->baseScript = 1;
                $mpdf->autoVietnamese = true;
                $mpdf->autoArabic = true;

                $mpdf->WriteHTML($sty, 1);
                //$mpdf->AddPage();
                //$mpdf->WriteHTML($content_part_admin);
                $mpdf->AddPage();
                $mpdf->WriteHTML($mailContent);
                //$mpdf->AddPage();
                //$mpdf->WriteHTML($content_part_admin_address);
                
                //$mpdf->Output($pdfFilePath, 'I');
                $mpdf->Output($pdfFilePath, 'F');*/


                $config = array('mailtype' => 'html','charset'  => 'utf-8','priority' => '1');
                $this->email->initialize($config);
                $this->email->set_newline("\r\n");
                $this->email->from($form, $this->site->site_name);
                $this->email->to($to);
                $this->email->cc('vijay@gleamingllp.com');              
                $this->email->subject($subject);
                //$this->email->attach($pdfFilePath);
                $this->email->message($mailContent);
                $this->email->send();
             
            }
        }
    }

}
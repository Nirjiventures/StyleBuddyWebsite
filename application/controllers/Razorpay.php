<?php



defined('BASEPATH') OR exit('No direct script access allowed');







class Razorpay extends MY_Controller {



    function __construct(){



        parent::__construct();



        $this->load->model('Page_Model');



        $this->site = $this->Page_Model->allController();



        $this->style = $this->Page_Model->stylist();



        



        $this->load->library('PHPMailer_Lib');



        $this->mail = $this->phpmailer_lib->load();



        $this->load->model('common_model');



    }



    public function index() {



        $this->checkout();



    }



    private function curl_handler($payment_id, $amount)  {



        $url            = 'https://api.razorpay.com/v1/payments/'.$payment_id.'/capture';



        $key_id         = ROZARPAY_KEY;



        $key_secret     = ROZARPAY_SECRET;



        $fields_string  = "amount=$amount";



         



        $ch = curl_init();



        //set the url, number of POST vars, POST data



        curl_setopt($ch, CURLOPT_URL, $url);



        curl_setopt($ch, CURLOPT_USERPWD, $key_id.':'.$key_secret);



        curl_setopt($ch, CURLOPT_TIMEOUT, 60);



        curl_setopt($ch, CURLOPT_POST, 1);



        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);



        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);



        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);



        return $ch;



    }   



      



    public function userOrder() {   



        



        $wh = ' WHERE user_id = "'.$this->session->userdata('session_user_id_temp').'"';



        $cartArray = $this->common_model->get_all_details_query('user_cart',$wh)->result_array();



        



        $wh = ' WHERE user_id = "'.$this->session->userdata('session_user_id_temp').'"';



        $user_cart_session = $this->common_model->get_all_details_query('user_cart_session',$wh)->row_array();



        



        $sessionArray = json_decode($user_cart_session['cart_record']);



        $total = str_replace(",", '', $sessionArray->display_total);



        $bag_total_price = str_replace(",", '', $sessionArray->bag_total);







        $email = $this->input->post('email');



        $userId = $this->input->post('userId');











        $productList = array();



        $uploadData = array();



        $postData = $this->input->post();



        $data['bag_total_price'] = $bag_total_price;



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







        $coupon_id = $user_cart_session['coupon_id'];

        $coupon_value = $user_cart_session['coupon_value'];

        $coupon_code = $user_cart_session['coupon_code'];



        $data['coupon_id'] = $coupon_id;



        $data['coupon_value'] = $coupon_value;



        $data['coupon_code'] = $coupon_code;



        $guest = 0;



        if (!$this->session->userdata('userId')) {



            $user = $this->common_model->get_all_details('vender',array('email'=>$email))->row();



            if (!$user) {



                $dataa = array();



                $dataa['email'] = $email;



                $dataa['password'] = md5(123456);



                $dataa['user_type'] = 3;



                $dataa['status'] = 1;



                $dataa['fname'] = $this->input->post('fname');



                $dataa['lname'] = $this->input->post('lname');



                $dataa['address'] = $this->input->post('address'); 



                $dataa['city_name'] = $this->input->post('city');



                $dataa['state_name'] = $this->input->post('state');



                $dataa['zip'] = $this->input->post('zip');



                $dataa['pin'] = $this->input->post('zip');



                $dataa['country'] = $this->input->post('country');



                $dataa['mobile'] = $this->input->post('mobile');



                $this->db->insert('vender',$dataa); 



                $userId = $this->db->insert_id();



                $user = $this->common_model->get_all_details('vender',array('email'=>$email))->row();



                $frontUserData = [ 'loginUser'=>$user->fname.' '.$user->lname,'fname'=>$user->fname, 'lname'=>$user->lname,  'mobile'=>$user->mobile,  'city_name'=>$user->city_name, 'userId'=>$user->id, 'venderId'=>$user->id,  'email'=> $user->email, 'userType'=>$user->user_type,'currently_logged_in' => 1 ];







                $this->session->set_userdata($frontUserData);



                $userId = $user->id;



                $guest = 1;



            }else{



                $frontUserData = [ 'loginUser'=>$user->fname.' '.$user->lname,'fname'=>$user->fname, 'lname'=>$user->lname,  'mobile'=>$user->mobile,  'city_name'=>$user->city_name, 'userId'=>$user->id, 'venderId'=>$user->id,  'email'=> $user->email, 'userType'=>$user->user_type,'currently_logged_in' => 1 ];







                $this->session->set_userdata($frontUserData);



                $userId = $user->id;



            }



            



        }



        







        $data['user_id'] = $userId;



        $data['user_email'] = $email;



        $data['payment_status'] = 'NONE';



        $data['order_status'] = 'Unfinished order';



        $data['created_at'] = date('Y-m-d H:i:s');



        



        $data['ip_address'] = $this->input->ip_address();



        $data['user_agent'] = $this->input->user_agent();



        $data['browser'] = $this->agent->browser();



        $data['browserVersion'] = $this->agent->version();



        $data['platform'] = $this->agent->platform();


        $couponRow11 = $this->common_model->get_all_details('giftcard_booking',array('id'=>$coupon_id))->row_array();
        if ($couponRow11) {
            $data['coupon_type'] = 'giftcard';
        }
        $couponRow111  =  $this->common_model->get_all_details('coupon',array('id'=>$coupon_id))->row_array();
        if ($couponRow111) {
            $data['coupon_type'] = 'coupon';
        }








        if(!empty($cartArray)) {    



            $this->db->insert('user_order',$data);



            $orderId = $this->db->insert_id();







            /*$couponRow = $this->common_model->get_all_details('gift',array('id'=>$coupon_id))->row_array();



            if ($couponRow) {



                $dataa = array();



                $dataa['gift_code_limit_avail'] = $couponRow['gift_code_limit_avail'] - 1; 



                $dataa['gift_code_limit_used'] = $couponRow['gift_code_limit_used'] + 1; 



                $this->db->where('id', $coupon_id);



                $this->db->update('gift',$dataa); 



            }*/



            $couponRow = $this->common_model->get_all_details('giftcard_booking',array('id'=>$coupon_id))->row_array();



            if ($couponRow) {



                $dataa = array();



                $dataa['is_used'] = 1; 



                $this->db->where('id', $coupon_id);



                $this->db->update('giftcard_booking',$dataa); 



            }



            if ($this->input->post('save_address')) {



                $dataa = array();



                $dataa['fname'] = $this->input->post('fname');



                $dataa['lname'] = $this->input->post('lname');



                $dataa['address'] = $this->input->post('address'); 



                $dataa['city_name'] = $this->input->post('city');



                $dataa['state_name'] = $this->input->post('state');



                $dataa['zip'] = $this->input->post('zip');



                $dataa['country'] = $this->input->post('country');



                $dataa['mobile'] = $this->input->post('mobile');



                $dataa['user_id'] = $userId;







                $user_shipping_addressRow = $this->common_model->get_all_details('user_shipping_address',$dataa)->row_array();



                if (!$user_shipping_addressRow) {



                    $this->db->insert('user_shipping_address',$dataa); 



                    $user_shipping_address = $this->db->insert_id();







                    $dataa = array();



                    $dataa['save_address'] = 1; 



                    $dataa['current_address_id'] = $user_shipping_address;



                    $this->db->where('id', $userId);



                    $this->db->update('vender',$dataa); 



                }



                



            }



            



            if ($this->input->post('notify_latest_product')) {



                $dataa = array();



                $dataa['notify_latest_product'] = 1;



                $this->db->where('id', $userId);



                $this->db->update('vender',$dataa);  



            }



            /*if ($this->input->post('save_address')) {



                $dataa['save_address'] = 1; 



                if ($this->input->post('notify_latest_product')) {



                    $dataa['notify_latest_product'] = 1; 



                }



                $dataa['fname'] = $this->input->post('fname');



                $dataa['lname'] = $this->input->post('lname');



                $dataa['address'] = $this->input->post('address'); 



                $dataa['city'] = $this->input->post('city');



                $dataa['state'] = $this->input->post('state');



                $dataa['pin'] = $this->input->post('zip');



                $dataa['zip'] = $this->input->post('zip');



                $dataa['country'] = $this->input->post('country');



                $dataa['mobile'] = $this->input->post('mobile');







                $this->db->where('id', $this->session->userdata('userId'));



                $this->db->update('vender',$dataa); 



                //echo $this->db->last_query();die;



            }*/



        }



         



        foreach ($cartArray as $key => $cartval) {



            $ss = json_decode($cartval['options']);



            $productList[] = array(



                    'productId' =>  $cartval['product_id'],



                    'productName' =>  ucwords($cartval['name']),



                    'productQty' =>  $cartval['quantity'],



                    'productMrpPrice' =>  $cartval['mrp_price'],



                    'productPrice' =>  $cartval['price'],



                    'discount' =>  $cartval['discount'],



                    'totalPrice' =>  $cartval['total'],



                    'size' =>  $cartval['size'],



                    'discountPrice' =>  $cartval['discount_price'],



                    'totalDiscount' =>  $cartval['discount_total'],



                    'totalMrpPrice' =>  $cartval['mrp_price_total'],



                    'productImg' =>  $ss->image,



                    'catId' =>  $ss->catId,



                    'venderId' =>  $ss->venderId,



                    'cart_type' =>  $cartval['cart_type']



                    );



        }







        for($i = 0; $i < count($productList); $i++ ) {



            

            //$r = $this->common_model->get_all_details('products',array('id'=>$productList[$i]['productId']))->row_array();

            if ($productList[$i]['cart_type'] == 'service') {

                if ($coupon_id) {

                    $iid = $productList[$i]['productId'];

                    $couponRow  =  $this->common_model->get_all_details('coupon',array('id'=>$coupon_id,'service'=>$iid))->row_array();

                    if ($couponRow) {
                        $uploadData[$i]['coupon_type'] = 'coupon';
                    }else{
                        $uploadData[$i]['coupon_type'] = 'giftcard';
                    }
                    $uploadData[$i]['coupon_id'] = $coupon_id;

                    $uploadData[$i]['coupon_value'] = $coupon_value;

                    $uploadData[$i]['coupon_code'] = $coupon_code;
                    

                }

            }else{

                $r = $this->common_model->get_all_details('products',array('id'=>$productList[$i]['productId']))->row_array();

                $uploadData[$i]['vendor_id'] = $r['user_id'];

            }

            



            $uploadData[$i]['orderId'] = $orderId;    



            $uploadData[$i]['vendor_vendor_id'] = $productList[$i]['venderId'];



            $uploadData[$i]['vendor_id'] = $r['user_id'];



            $uploadData[$i]['user_id'] = $data['user_id'];



            $uploadData[$i]['invoiceNo'] = $orderId; 



            $uploadData[$i]['productId'] = $productList[$i]['productId'];



            $uploadData[$i]['productName'] = $productList[$i]['productName'];



            $uploadData[$i]['productMrpPrice'] = $productList[$i]['productMrpPrice'];



            $uploadData[$i]['productPrice'] = $productList[$i]['productPrice'];



            $uploadData[$i]['productQty'] = $productList[$i]['productQty'];



            $uploadData[$i]['totalPrice'] = $productList[$i]['totalPrice'];



            $uploadData[$i]['totalMrpPrice'] =$productList[$i]['totalMrpPrice'];



            $uploadData[$i]['productImg'] = $productList[$i]['productImg'];



            $uploadData[$i]['cart_type'] = $productList[$i]['cart_type'];







            $uploadData[$i]['catId'] = $productList[$i]['catId'];



            $uploadData[$i]['discount'] = $productList[$i]['discount'];



            $uploadData[$i]['discountPrice']=$productList[$i]['discountPrice']; 



            $uploadData[$i]['totalDiscount']=$productList[$i]['totalDiscount']; 



            $uploadData[$i]['venderId'] = $productList[$i]['venderId'];



            $uploadData[$i]['size'] = $productList[$i]['size'];



            $uploadData[$i]['created_at'] = date('Y-m-d H:i:s');



            $uploadData[$i]['order_id']=$this->input->post('merchant_order_id');



            



            $uploadData[$i]['ip_address'] = $this->input->ip_address();



            $uploadData[$i]['user_agent'] = $this->input->user_agent();



            $uploadData[$i]['browser'] = $this->agent->browser();



            $uploadData[$i]['browserVersion'] = $this->agent->version();



            $uploadData[$i]['platform'] = $this->agent->platform();



            



        }



        $this->db->insert_batch('user_order_details',$uploadData);



        //echo $this->db->last_query();die;



        $userInvoice = ['orderId'=> $orderId,'guest'=>$guest];



        $this->session->set_userdata($userInvoice);



        //var_dump($this->input->post());



        if ($this->input->post('pay_type') == 'RAZORPAY') {



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







                    $this->db->where('orderId', $orderId);



                    $update_password = $this->db->update('user_order_details',$up); 



                    //echo $this->db->last_query();



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

        }else if ($this->input->post('pay_type') == 'FREE') {

            $payment_status = 'APPROVED ';

            $payment_method = 'FREE';

            

            $up['txn_id'] = 'STYLE-'.$orderId.time();

            $up['payment_status'] = $payment_status;

            $up['method'] = $payment_method;

            $up['order_status'] = 'Pending';

            $this->db->where('id', $orderId);

            $this->db->update('user_order',$up); 

            $this->db->where('orderId', $orderId);

            $this->db->update('user_order_details',$up);

            try {

                $postData['orderId'] = $orderId;

                $postData['email'] = 'vijay@gleamingllp.com';

                $this->sendMail($postData);

            } catch (Exception $e) {

            }

            redirect($this->input->post('merchant_surl_id'));

        }else{

            $payment_status = 'APPROVED';

            $payment_method = $this->input->post('pay_type');



             

            $up['txn_id'] = 'STYLE-'.$orderId.time();

            $up['payment_status'] = $payment_status;

            $up['method'] = $payment_method;

            $up['order_status'] = 'Pending';

            $this->db->where('id', $orderId);

            $this->db->update('user_order',$up); 

            $this->db->where('orderId', $orderId);

            $this->db->update('user_order_details',$up); 

            try {

                $postData['orderId'] = $orderId;

                $postData['email'] = 'vijay@gleamingllp.com';

                $this->sendMail($postData);

            } catch (Exception $e) {

            }

            redirect($this->input->post('merchant_surl_id'));



        }



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







        $insert['currency'] = $this->input->post('currency');



        $insert['order_id'] = $this->input->post('merchant_order_id');



        $insert['payment_gateway'] = $this->input->post('pay_type');



        $insert['service_id'] = $this->input->post('service_id');



        $insert['price'] = $this->input->post('merchant_total');



        $insert['fname'] = $this->input->post('fname');



        $insert['lname'] = $this->input->post('lname');



        $insert['mobile'] = $this->input->post('mobile');



        $insert['email'] = $this->input->post('email');



        $insert['address'] = $this->input->post('address');



        $insert['special_instruction'] = $this->input->post('special_instruction');



        $insert['created_at'] = date('Y-m-d H:i:s');



        if ($this->session->userdata('userId')) {



            $insert['user_id'] = $this->session->userdata('userId');



        }



        



        $insert['full_name']  = $postData['fname'].' '.$postData['lname'];







        $this->db->insert('intial_booking',$insert);



        $orderId = $this->db->insert_id();  



        $userInvoice = ['invoice'=> $orderId];



        $this->session->set_userdata($userInvoice);



         



         



        if ($this->input->post('pay_type') == 'RAZORPAY') {



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



                    //var_dump($http_status);



                    //var_dump($result);



                    if ($result === false) {



                        $success = false;



                        $error = 'Curl error: '.curl_error($ch);



                    } else {



                        $response_array = json_decode($result, true);



                        //var_dump($response_array);



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







            //redirect($this->input->post('merchant_surl_id'));



        }



    }



    



    public function stylist_service_book() {   



        $productList = array();



        $uploadData = array();



        $postData = $this->input->post();



        $data['total_price'] = $this->input->post('package_price');



        $data['tax'] = $this->input->post('payment_tax');



        $data['tax_total'] = $this->input->post('payment_tax_total');



        $data['grand_total'] = $this->input->post('grand_total');



        



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



        $data['vendor_id'] = $this->input->post('vendor_id');



        $data['package_id'] = $this->input->post('package_id');



        $data['package'] = $this->input->post('package');







        $data['user_id'] = $this->session->userdata('userId');



        $data['user_email'] = $this->session->userdata('email');



        $data['payment_status'] = 'NONE';



        $data['order_status'] = 'Unfinished order';



        $data['created_at'] = date('Y-m-d H:i:s');



        



        $this->db->insert('services_booking',$data);



        $orderId = $this->db->insert_id();



        //echo $this->db->last_query();



         



        $userInvoice = ['orderId'=> $orderId];



        $this->session->set_userdata($userInvoice);



        if ($this->input->post('pay_type') == 'RAZORPAY') {



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



                    $update_password = $this->db->update('services_booking',$up); 



                    echo $this->db->last_query();



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



            $update_password = $this->db->update('services_booking',$up); 



            //echo $this->db->last_query();



            try {



                $postData['orderId'] = $orderId;



                $postData['email'] = 'vijay@gleamingllp.com';



                //$this->sendMail($postData);



            } catch (Exception $e) {



                



            }



            redirect($this->input->post('merchant_surl_id'));



        }



    }







    public function subscription() {   



        $productList = array();



        $uploadData = array();



        $postData = $this->input->post();



        $data['total_price'] = $this->input->post('package_price');



        $data['tax'] = $this->input->post('payment_tax');



        $data['tax_total'] = $this->input->post('payment_tax_total');



        $data['grand_total'] = $this->input->post('grand_total');



        



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



        $data['vendor_id'] = $this->input->post('vendor_id');



        $data['package_id'] = $this->input->post('package_id');



        $data['package'] = $this->input->post('package');







        $data['user_id'] = $this->session->userdata('userId');



        $data['user_email'] = $this->session->userdata('email');



        $data['payment_status'] = 'NONE';



        $data['order_status'] = 'Unfinished order';



        $data['created_at'] = date('Y-m-d H:i:s');



        



        $condition = " WHERE id = '". $this->input->post('package_id') ."'";



        $value = $this->common_model->get_all_details_query('subscription_plan',$condition)->row_array();



        $start_date = date('Y-m-d');







        $data['start_date'] = $start_date;



        $data['end_date'] = date('Y-m-d', strtotime(' + '.$value['valid_days'].' days'));



        $data['total_job'] = $value['total_job'];



        $data['total_days'] = $value['valid_days'];



        $data['package_description'] = $value['package_description'];



        $data['left_job'] = $value['total_job'];



        $this->db->insert('subscription_booking',$data);



        $orderId = $this->db->insert_id();



        //echo $this->db->last_query();



         



        $userInvoice = ['orderId'=> $orderId];



        $this->session->set_userdata($userInvoice);



        if ($this->input->post('pay_type') == 'RAZORPAY') {



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



                    $up['txn_id'] = $this->session->flashdata('razorpay_payment_id');



                    $up['payment_status'] = $payment_status;



                    $up['method'] = $payment_method;



                    $up['order_status'] = 'Pending';







                    $this->db->where('id', $orderId);



                    $this->db->update('subscription_booking',$up); 



                    echo $this->db->last_query();







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



        }



    }







    public function success() {



        if($this->session->userdata('orderId')){



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



            



            $data['seoData'] = array();



            $list = $this->db->query('select * from cms_pages where slug = "order-success" and status=1')->row();



            if($list) {



                $data['seoData'] = $list;



            }    



            $this->load->view('order-success',$data); 



        }else{



            redirect(base_url());



        }



    }  



    public function initial_success() {



        $data['order'] = array();



        $data['title'] = 'Razorpay Success';



        $msg = '<div style="text-align:center">';  



            $msg .= "<h4>Your transaction is successful</h4>";  



            $msg .= "<br/>";



            $msg .= "Transaction ID: ".$this->session->flashdata('razorpay_payment_id');



            $msg .= "<br/>";



            $msg .= "Order ID: ".$this->session->flashdata('merchant_order_id');



        $msg .= "</div>";



        $data['message'] = $msg;



        $data['seoData'] = array();



        $list = $this->db->query('select * from cms_pages where slug = "order-success" and status=1')->row();



        if($list) {



            $data['seoData'] = $list;



        } 



        $this->load->view('order-success',$data);   



    }



    public function stylistbook_success() {



        if($this->session->userdata('orderId')){



            $id = $this->session->userdata('orderId');



            $data['order'] = $order = $this->db->get_where('services_booking',['id'=> $id])->row();



            



            $condition = " WHERE id = '".$order->vendor_id."'";



            $vendor_row = $this->common_model->get_all_details_query('vender',$condition)->row_array();



                



            $condition = " WHERE id = '". $order->package_id ."'";



            $value = $this->common_model->get_all_details_query('services_vendor',$condition)->row_array();



             



            if ($value['admin_status']) {



                $condition = " WHERE services_id = '". $value['services_id'] ."' order by id asc";



            }else{



                $condition = " WHERE services_id = '". $value['id'] ."' order by id asc";



            }



            $rows = $this->common_model->get_all_details_query('services_feature',$condition)->result_array();



              



            $txt = 'Classic';



            if ($order->package == 'package_price_1') {



               $txt = 'Classic';



               $description = 'package_description_1';



            }elseif ($order->package == 'package_price_2') {



               $txt = 'Premium';



               $description = 'package_description_2';



            }elseif ($order->package == 'package_price_3') {



               $txt = 'Luxury';



               $description = 'package_description_3';



            }



            $option = '<div class="summery_order">';



                $option = '<div class="row align-items-center">



                                <div class="col-sm-12">



                                    <p class="odds">



                                        <b>Order ID : #'.$order->id.' | </b>



                                        <b>Payment Method: <span class="approved" style="color: green;font-weight: bold;">'.$order->payment_gateway.'</span> | </b>



                                        <b>Payment Status: <span class="approved" style="color: green;font-weight: bold;">'.$order->payment_status.'</span> | </b>



                                        Order Date : '. date('j F, Y',strtotime($order->created_at)) .'



                                    </p>



                                </div>



                            </div>';



                     $option = '<table cellspacing="0" cellpadding="4" class="table table-bordered table-striped" style="width:100%; border: 1px solid #ccc; border-collapse: collapse;">



                            <tr style="border: 1px solid #333;">



                                <td style="border: 1px solid #333;" class="text-left"><b>Stylist Name : </b></td>



                                <td style="border: 1px solid #333;" class="text-left">'.ucwords($vendor_row['fname'].' '.$vendor_row['lname']).'</td>



                            </tr> 



                            <tr style="border: 1px solid #333;">



                                <td colspan="2" style="border: 1px solid #333;" class="text-left"><b>'.$value['area_expertise_name'].'</b></td>



                            </tr> 



                            <tr style="border: 1px solid #333;">



                                <td colspan="2" style="border: 1px solid #333;" class="text-left"><b>'.$txt.' Package</b></td>



                            </tr>';



                            $option .= '<tr style="border: 1px solid #333;">



                                    <td colspan="2" style="border: 1px solid #333;text-align:left">'. $value[$description] .'</td>



                                    </tr>';



                             



                            $option .= '<tr style="border: 1px solid #333;">



                                <td style="border: 1px solid #333;"> <b>Package Price : </b></td>



                                <td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.($order->total_price) .'</b></td>



                            </tr>';



                            $option .= '<tr style="border: 1px solid #333;">



                                <td style="border: 1px solid #333;"> <b>GST @ 18% : </b></td>



                                <td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.($order->tax_total) .'</b></td>



                            </tr>';



                            $option .= '<tr style="border: 1px solid #333;">



                                <td style="border: 1px solid #333;"> <b>Grand Total : </b></td>



                                <td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.($order->grand_total) .'</b></td>



                            </tr>';



                $option .= '</table>';



                $option .= '<div style="background: #e5da95;margin-bottom: 20px;padding: 16px;">



                                <div class="row">



                                    <div class="col-sm-6">



                                        <h3 class="uk_title mb-3 mt-3">Address</h3>



                                        <p>'. $order->address .'</p>



                                        <p>Pin - '. $order->pincode .'</p>



                                        <p>'. $order->city.', '.$order->state.' - '.$order->country .'</p>



                                        <p>Email : '. $order->user_email .'</p>



                                        <p>Mobile : '. $order->mobile .'</p>



                                    </div>



                                </div>



                            </div>';



            $option .= '</div>';



            







            $data['result']  = $option;



            $mail=array();



            $mail['order_table'] = 'services_booking'; 



            $mail['order_id'] = $id; 



            $this->sendMail($mail);







            $data['title'] = 'Razorpay Success';



            $msg = "<h4>Your transaction is successful</h4>";  



            $msg .= "<br/>";



            $msg .= "Transaction ID: ".$this->session->flashdata('razorpay_payment_id');



            $msg .= "<br/>";



            $msg .= "Order ID: ".$this->session->flashdata('merchant_order_id');



            $data['message'] = $msg;



            $data['seoData'] = array();



            $list = $this->db->query('select * from cms_pages where slug = "order-success" and status=1')->row();



            if($list) {



                $data['seoData'] = $list;



            } 



            $this->load->view('service-booking-success',$data); 



        }else{



            redirect(base_url());



        }



    }







    public function subscription_success() {



        if($this->session->userdata('orderId')){



            $id = $this->session->userdata('orderId');



            $data['order'] = $order = $this->db->get_where('subscription_booking',['id'=> $id])->row();



            



            $condition = " WHERE id = '".$order->vendor_id."'";



            $vendor_row = $this->common_model->get_all_details_query('vender',$condition)->row_array();



                



            $condition = " WHERE id = '". $order->package_id ."'";



            $value = $this->common_model->get_all_details_query('subscription_plan',$condition)->row_array();



            $condition = " WHERE id = '". $value['id'] ."' order by id asc";



             



            $option = '<div class="summery_order">';



                $option = '<div class="row align-items-center">



                                <div class="col-sm-12">



                                    <p class="odds">



                                        <b>Order ID : #'.$order->id.' | </b>



                                        <b>Payment Method: <span class="approved" style="color: green;font-weight: bold;">'.$order->payment_gateway.'</span> | </b>



                                        <b>Payment Status: <span class="approved" style="color: green;font-weight: bold;">'.$order->payment_status.'</span> | </b>



                                        Order Date : '. date('j F, Y',strtotime($order->created_at)) .'



                                    </p>



                                </div>



                            </div>';



                     $option = '<table cellspacing="0" cellpadding="4" class="table table-bordered table-striped" style="width:100%; border: 1px solid #ccc; border-collapse: collapse;">



                            <tr style="border: 1px solid #333;">



                                <td style="border: 1px solid #333;" class="text-left"><b>Name : </b></td>



                                <td style="border: 1px solid #333;" class="text-left">'.ucwords($vendor_row['fname'].' '.$vendor_row['lname']).'</td>



                            </tr> 



                            <tr style="border: 1px solid #333;">



                                <td colspan="2" style="border: 1px solid #333;" class="text-left"><b>'.$txt.' Subscription: '.$order->package.'</b></td>



                            </tr>';



                            $option .= '<tr style="border: 1px solid #333;">



                                <td style="border: 1px solid #333;"> <b>Subscription Price : </b></td>



                                <td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.($order->total_price) .'</b></td>



                            </tr>';



                            $option .= '<tr style="border: 1px solid #333;">



                                <td style="border: 1px solid #333;"> <b>GST @ 18% : </b></td>



                                <td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.($order->tax_total) .'</b></td>



                            </tr>';



                            $option .= '<tr style="border: 1px solid #333;">



                                <td style="border: 1px solid #333;"> <b>Grand Total : </b></td>



                                <td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.($order->grand_total) .'</b></td>



                            </tr>';



                $option .= '</table>';



                $option .= '<div style="background: #e5da95;margin-bottom: 20px;padding: 16px;">



                                <div class="row">



                                    <div class="col-sm-6">



                                        <h3 class="uk_title mb-3 mt-3">Info:</h3>



                                        <p>Email : '. $order->user_email .'</p>



                                        <p>Mobile : '. $order->mobile .'</p>



                                    </div>



                                </div>



                            </div>';



            $option .= '</div>';



            







            $data['result']  = $option;



            $mail=array();



            $mail['order_table'] = 'subscription_booking'; 



            $mail['order_id'] = $id; 



            $this->sendMail($mail);







            $data['title'] = 'Razorpay Success';



            $msg = "<h4>Your transaction is successful</h4>";  



            $msg .= "<br/>";



            $msg .= "Transaction ID: ".$this->session->flashdata('razorpay_payment_id');



            $msg .= "<br/>";



            $msg .= "Order ID: ".$this->session->flashdata('merchant_order_id');



            $data['message'] = $msg;



            



            $data['seoData'] = array();



            $list = $this->db->query('select * from cms_pages where slug = "order-success" and status=1')->row();



            if($list) {



                $data['seoData'] = $list;



            } 



            $this->load->view('front/postjobs/subscription-booking-success',$data); 



        }else{



            redirect(base_url());



        }



    }



    public function ask_quote_booking() {   



        $postData = $this->input->post();



        



         



        if ($this->input->post('pay_type') == 'RAZORPAY') {



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



                        //var_dump($response_array);



                        if ($http_status === 200 and isset($response_array['error']) === false) {



                            



                            



                            $insert['currency'] = $this->input->post('currency');



                            $insert['total_price'] = $this->input->post('grand_total');



                            $insert['tax'] = $this->input->post('payment_tax');



                            $insert['tax_total'] = $this->input->post('payment_tax_total');



                            $insert['grand_total'] = $this->input->post('merchant_total') / 100;



                            



                            $insert['order_id'] = $this->input->post('merchant_order_id');



                            $insert['pay_type'] = $this->input->post('pay_type');



                            $insert['payment_gateway'] = $this->input->post('pay_type');



                    



                            $insert['fname'] = $this->input->post('fname');



                            $insert['lname'] = $this->input->post('lname');



                            $insert['mobile'] = $this->input->post('mobile');



                            $insert['email'] = $email = $this->input->post('email');



                            $insert['city'] = $this->input->post('city');



                            $insert['area_expertise'] = $this->input->post('area_expertise');



                            $insert['message'] = $this->input->post('message');



                            $insert['created_at'] = date('Y-m-d H:i:s');



                            if ($this->session->userdata('userId')) {



                                $insert['user_id'] = $this->session->userdata('userId');



                            }



                            



                            $insert['full_name']  = $postData['fname'].' '.$postData['lname'];



                    



                            $this->db->insert('ask_quote_online',$insert);



                            $orderId = $this->db->insert_id();  



                            /*$userInvoice = ['invoice'=> $orderId];



                            $this->session->set_userdata($userInvoice);*/



                            $userInvoice = ['orderId'=> $orderId];



                            $this->session->set_userdata($userInvoice);



                            



                            



                            $success = true;



                            $payment_method = $response_array['method'];



                            $payment_status = $response_array['status'];



                            



                            



                            



                            if(!empty($this->session->userdata('ci_subscription_keys'))) {



                                //$this->session->unset_userdata('ci_subscription_keys');



                            }



                            $up['txn_id'] = $this->session->flashdata('razorpay_payment_id');



                            $up['payment_status'] = $payment_status;



                            $up['method'] = $payment_method;



                           



                            $this->db->where('id', $orderId);



                            $update_password = $this->db->update('ask_quote_online',$up); 



                            //echo $this->db->last_query();die;



                            $uRow = $this->db->get_where('vender',['email'=> $email])->row_array();



                            



                            if(!$uRow){



                                $insert = array();



                                $insert['fname'] = $this->input->post('fname');



                                $insert['lname'] = $this->input->post('lname');



                                $insert['mobile'] = $this->input->post('mobile');



                                $insert['email'] = $email = $this->input->post('email');



                                $insert['created_at'] = date('Y-m-d H:i:s');



                            



                            



                                 



                                $insert['password']  = md5(123456);



                                $insert['user_type']  = 3;



                                $this->db->insert('vender',$insert); 



                                $userInvoice = ['password_status'=> 1];



                                $this->session->set_userdata($userInvoice);



                            }else{



                                $userInvoice = ['password_status'=> 0];



                                $this->session->set_userdata($userInvoice);



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



                    redirect($this->input->post('merchant_surl_id'));



                } else {



                    redirect($this->input->post('merchant_furl_id'));



                }



            } else {



                echo 'An error occured. Contact site administrator, please!';



            }



        }



    }



    public function ask_quote_booking_success() {



        if($this->session->userdata('orderId')){



            $id = $this->session->userdata('orderId');



            $data['order'] = $order = $this->db->get_where('ask_quote_online',['id'=> $id])->row_array();



            







             



            $data['title'] = 'Razorpay Success';



            $option = '<div class="summery_order">';



                $option = '<div class="row align-items-center">



                                <div class="col-sm-12">



                                    <p class="odds">



                                        <b>Order ID : #'.$order['id'].' | </b>



                                        <b>Payment Method: <span class="approved" style="color: green;font-weight: bold;">'.$order['payment_gateway'].'</span> | </b>



                                        <b>Payment Status: <span class="approved" style="color: green;font-weight: bold;">'.$order['payment_status'].'</span> | </b>



                                        Order Date : '. date('j F, Y',strtotime($order['created_at'])) .'



                                    </p>



                                </div>



                            </div>';



                     $option .= '<table cellspacing="0" cellpadding="4" class="table table-bordered table-striped" style="width:100%; border: 1px solid #ccc; border-collapse: collapse;">';







                            $option .= '<tr style="border: 1px solid #333;">



                                <td style="border: 1px solid #333;" class="text-left"><b>Name : </b></td>



                                <td style="border: 1px solid #333;" class="text-left">'.ucwords($order['fname'].' '.$order['lname']).'</td>



                            </tr>';



                            $option .= '<tr style="border: 1px solid #333;">



                                <td style="border: 1px solid #333;" class="text-left"><b>Email : </b></td>



                                <td style="border: 1px solid #333;" class="text-left">'.ucwords($order['email']).'</td>



                            </tr>';



                            $option .= '<tr style="border: 1px solid #333;">



                                <td style="border: 1px solid #333;" class="text-left"><b>Mobile : </b></td>



                                <td style="border: 1px solid #333;" class="text-left">'.ucwords($order['mobile']).'</td>



                            </tr>';



                            $option .= '<tr style="border: 1px solid #333;">



                                <td style="border: 1px solid #333;" class="text-left"><b>Consultation Topic : </b></td>



                                <td style="border: 1px solid #333;" class="text-left">'.ucwords($order['area_expertise']).'</td>



                            </tr>';



                            $option .= '<tr style="border: 1px solid #333;">



                                <td style="border: 1px solid #333;"> <b>Fashion Expert Consultation Fees : </b></td>



                                <td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.($order['total_price']) .'</b></td>



                            </tr>';



                            /*$option .= '<tr style="border: 1px solid #333;">



                                <td style="border: 1px solid #333;"> <b>GST @ 18% : </b></td>



                                <td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.($order['tax_total']) .'</b></td>



                            </tr>';*/



                            /*$option .= '<tr style="border: 1px solid #333;">



                                <td style="border: 1px solid #333;"> <b>Grand Total : </b></td>



                                <td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.($order['grand_total']) .'</b></td>



                            </tr>';*/



                $option .= '</table>';



                 



            $option .= '</div>';



            







            $data['result']  = $option;



            $mail=array();



            $mail['order_table'] = 'ask_quote_online'; 



            $mail['order_id'] = $id; 



            $this->sendMail($mail);



            $data['seoData'] = array();



            $list = $this->db->query('select * from cms_pages where slug = "order-success" and status=1')->row();



            if($list) {



                $data['seoData'] = $list;



            } 



            $this->load->view('ask-quote-booking-success',$data);



        }else{



            redirect(base_url());



        }   



    }



    



    public function fashion_success() {



        $data['order'] = array();



        $data['title'] = 'Razorpay Success';



        $msg = "<h4>Your transaction is successful</h4>";  



        $msg .= "<br/>";



        $msg .= "Transaction ID: ".$this->session->flashdata('razorpay_payment_id');



        $msg .= "<br/>";



        $msg .= "Order ID: ".$this->session->flashdata('merchant_order_id');



        $data['message'] = $msg;



        $data['seoData'] = array();



        $list = $this->db->query('select * from cms_pages where slug = "order-success" and status=1')->row();



        if($list) {



            $data['seoData'] = $list;



        } 



        $this->load->view('order-success',$data);   



    }  



    



    public function consult_booking() {   



        $postData = $this->input->post();



        



         



        if ($this->input->post('pay_type') == 'RAZORPAY') {



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



                        //var_dump($response_array);die;



                        if ($http_status === 200 and isset($response_array['error']) === false) {



                            $consult_package_id = $this->input->post('consult_package_id');



                            $insert['consult_package_id'] = $consult_package_id;



                            $consult_plan = $this->common_model->get_all_details('consult_plan',array('id'=>$consult_package_id))->row_array();



                            $insert['package_name'] = $consult_plan['package_name'];



                            $insert['package_description'] = $consult_plan['package_description'];







                            $insert['currency'] = $this->input->post('currency');



                            $insert['total_price'] = $this->input->post('grand_total');



                            $insert['tax'] = $this->input->post('payment_tax');



                            $insert['tax_total'] = $this->input->post('payment_tax_total');



                            $insert['grand_total'] = $this->input->post('merchant_total') / 100;



                            



                            $insert['order_id'] = $this->input->post('merchant_order_id');



                            $insert['pay_type'] = $this->input->post('pay_type');



                            $insert['payment_gateway'] = $this->input->post('pay_type');



                    



                            $insert['fname'] = $this->input->post('fname');



                            $insert['lname'] = $this->input->post('lname');



                            



                            if ($this->input->post('mobile')) {



                                $mobile = $this->input->post('mobile');



                            }else{



                                $mobile = $response_array['contact'];



                            }



                            $insert['mobile'] = $mobile;



                            $email = $this->input->post('email');



                            $userId = $this->input->post('userId');



                            



                            $insert['email'] = $email;



                            $insert['created_at'] = date('Y-m-d H:i:s');



                            if ($this->session->userdata('userId')) {



                                $insert['user_id'] = $this->session->userdata('userId');



                            }



                            $guest = 0;



                            if (!$this->session->userdata('userId')) {



                                $user = $this->common_model->get_all_details('vender',array('email'=>$email))->row();



                                if (!$user) {



                                    $dataa = array();



                                    $dataa['email'] = $email;



                                    $dataa['password'] = md5(123456);



                                    $dataa['user_type'] = 3;



                                    $dataa['status'] = 1;



                                    $dataa['fname'] = $this->input->post('fname');



                                    $dataa['lname'] = $this->input->post('lname');



                                    $dataa['mobile'] = $mobile;



                                    $this->db->insert('vender',$dataa); 



                                    $userId = $this->db->insert_id();



                                    $user = $this->common_model->get_all_details('vender',array('email'=>$email))->row();



                                    $frontUserData = [ 'loginUser'=>$user->fname.' '.$user->lname,'fname'=>$user->fname, 'lname'=>$user->lname,  'mobile'=>$user->mobile,  'city_name'=>$user->city_name, 'userId'=>$user->id, 'venderId'=>$user->id,  'email'=> $user->email, 'userType'=>$user->user_type,'currently_logged_in' => 1 ];







                                    $this->session->set_userdata($frontUserData);



                                    $userId = $user->id;



                                    $guest = 1;



                                }else{



                                    $frontUserData = [ 'loginUser'=>$user->fname.' '.$user->lname,'fname'=>$user->fname, 'lname'=>$user->lname,  'mobile'=>$user->mobile,  'city_name'=>$user->city_name, 'userId'=>$user->id, 'venderId'=>$user->id,  'email'=> $user->email, 'userType'=>$user->user_type,'currently_logged_in' => 1 ];







                                    $this->session->set_userdata($frontUserData);



                                    $userId = $user->id;



                                }



                                



                            }







                            $insert['user_id'] = $userId;



                            $insert['full_name']  = $postData['fname'].' '.$postData['lname'];



                            $insert['city']  = $postData['city'];



                            $insert['message']  = $postData['message'];



                    



                            $this->db->insert('consult_order',$insert);



                            $orderId = $this->db->insert_id();  



                            $userInvoice = ['orderId'=> $orderId,'guest'=>$guest]; 



                            $this->session->set_userdata($userInvoice);



                            



                            



                            $success = true;



                            $payment_method = $response_array['method'];



                            $payment_status = $response_array['status'];



                            



                            



                            



                            if(!empty($this->session->userdata('ci_subscription_keys'))) {



                                //$this->session->unset_userdata('ci_subscription_keys');



                            }



                            $up['txn_id'] = $this->session->flashdata('razorpay_payment_id');



                            $up['payment_status'] = $payment_status;



                            $up['method'] = $payment_method;



                           



                            $this->db->where('id', $orderId);



                            $update_password = $this->db->update('consult_order',$up); 



                            //echo $this->db->last_query();die;



                            $uRow = $this->db->get_where('vender',['email'=> $email])->row_array();



                            



                            if(!$uRow){



                                $insert = array();



                                $insert['fname'] = $this->input->post('fname');



                                $insert['lname'] = $this->input->post('lname');



                                $insert['mobile'] = $mobile;



                                $insert['email'] = $email = $this->input->post('email');



                                $insert['created_at'] = date('Y-m-d H:i:s');



                                $insert['password']  = md5(123456);



                                $insert['user_type']  = 3;



                                $this->db->insert('vender',$insert); 



                                $userInvoice = ['password_status'=> 1];



                            }else{



                                $userInvoice = ['password_status'=> 0];



                            }



                            $this->session->set_userdata($userInvoice);



                            $insert = array();



                            $insert['package_id'] = $consult_package_id;



                            $insert['package_expire_date'] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 365 days'));



                            $insert['package_status'] = 1;



                            $this->common_model->commonUpdate('vender',$insert,array('email'=>$email)); 



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



                    redirect($this->input->post('merchant_surl_id'));



                } else {



                    redirect($this->input->post('merchant_furl_id'));



                }



            } else {



                echo 'An error occured. Contact site administrator, please!';



            }



        }



    }



    public function consult_booking_success() {



        if($this->session->userdata('orderId')){



            $id = $this->session->userdata('orderId');



            $data['order'] = $order = $this->db->get_where('consult_order',['id'=> $id])->row_array();



            $data['title'] = 'Razorpay Success';



            $option = '<div class="summery_order">';



                $option .= '<div class="row align-items-center">



                            <div class="col-sm-12">



                                <p class="odds">



                                    <b>Order ID : #'.$order['id'].' | </b>



                                    <b>Payment Method: <span class="approved" style="color: green;font-weight: bold;">'.$order['payment_gateway'].'</span> | </b>



                                    <b>Payment Status: <span class="approved" style="color: green;font-weight: bold;">'.$order['payment_status'].'</span> | </b>



                                    Order Date : '. date('j F, Y',strtotime($order['created_at'])) .'



                                </p>



                            </div>



                        </div>';



                 $option .= '<table cellspacing="0" cellpadding="4" class="table table-bordered table-striped" style="width:100%; border: 1px solid #ccc; border-collapse: collapse;">';







                        $option .= '<tr style="border: 1px solid #333;">



                            <td style="border: 1px solid #333;" class="text-left"><b>Name : </b></td>



                            <td style="border: 1px solid #333;" class="text-left">'.ucwords($order['fname'].' '.$order['lname']).'</td>



                        </tr>';



                        $option .= '<tr style="border: 1px solid #333;">



                            <td style="border: 1px solid #333;" class="text-left"><b>Email : </b></td>



                            <td style="border: 1px solid #333;" class="text-left">'.ucwords($order['email']).'</td>



                        </tr>';



                        if ($order['mobile']) {



                            $option .= '<tr style="border: 1px solid #333;">



                                <td style="border: 1px solid #333;" class="text-left"><b>Mobile : </b></td>



                                <td style="border: 1px solid #333;" class="text-left">'.ucwords($order['mobile']).'</td>



                            </tr>';



                        }



                        if ($order['city']) {



                            $option .= '<tr style="border: 1px solid #333;">



                                <td style="border: 1px solid #333;" class="text-left"><b>City : </b></td>



                                <td style="border: 1px solid #333;" class="text-left">'.($order['city']).'</td>



                            </tr>';



                        }



                        if ($order['message']) {



                            $option .= '<tr style="border: 1px solid #333;">



                                <td style="border: 1px solid #333;" class="text-left"><b>Message : </b></td>



                                <td style="border: 1px solid #333;" class="text-left">'.$order['message'].'</td>



                            </tr>';



                        }



                        $option .= '<tr style="border: 1px solid #333;">



                            <td colspan="2" style="text-align:center"><h5>Package Info </h5></td>



                        </tr>';



                        $option .= '<tr style="border: 1px solid #333;">



                            <td colspan="2" style="text-align:center"> <b>Package Name : </b>'. $order['package_name'] .'</td>



                        </tr>';



                        $option .= '<tr style="border: 1px solid #333;">



                            <td style="border: 1px solid #333;"> <b>Package Price : </b></td>



                            <td style="border: 1px solid #333;"> '. $this->site->currency.' '.($order['total_price']) .'</td>



                        </tr>';



                        $package_description =  json_decode($order['package_description']);







                        foreach ($package_description as $key => $value) {



                            $option .= '<tr style="border: 1px solid #333;">



                                <td style="border: 1px solid #333;"> <b>'.$value->question_name.' : </b></td>



                                <td style="border: 1px solid #333;"> '. $value->question_value .'</td>



                            </tr>';



                        }



                        







                $option .= '</table>';



                 



            $option .= '</div>';



            







            $data['result']  = $option;



            $mail=array();



            $mail['order_table'] = 'consult_order'; 



            $mail['order_id'] = $id; 



            $this->sendMail($mail);



            $data['seoData'] = array();



            $list = $this->db->query('select * from cms_pages where slug = "order-success" and status=1')->row();



            if($list) {



                $data['seoData'] = $list;



            } 



            $this->load->view('ask-quote-booking-success',$data);



        }else{



            redirect(base_url());



        }   



    }



    



    public function giftcard_booking() {   



        $postData = $this->input->post();



        if ($this->input->post('pay_type') == 'RAZORPAY') {



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



                        //var_dump($response_array);



                        if ($http_status === 200 and isset($response_array['error']) === false) {



                            



                            



                            $gift_id = base64_decode(base64_decode(base64_decode($this->input->post('giftcard_id'))));



                            $giftCradRow = $this->common_model->get_all_details('gift',array('id'=> $gift_id))->row_array();







                            $insert['gift_id'] = $gift_id;



                            $insert['gift_code'] = random_strings(10);;



                            $insert['gift_name'] = $giftCradRow['name'];



                            $insert['currency'] = $this->input->post('currency');



                            $insert['total_price'] = $this->input->post('grand_total');



                            $insert['tax'] = $this->input->post('payment_tax');



                            $insert['tax_total'] = $this->input->post('payment_tax_total');



                            $insert['grand_total'] = $this->input->post('merchant_total') / 100;



                            



                            $insert['order_id'] = $this->input->post('merchant_order_id');



                            $insert['pay_type'] = $this->input->post('pay_type');



                            $insert['payment_gateway'] = $this->input->post('pay_type');



                    



                            $insert['fname'] = $this->input->post('fname');



                            $insert['lname'] = $this->input->post('lname');



                            $insert['mobile'] = $this->input->post('mobile');



                            $insert['email'] = $email = $this->input->post('email');



                            $insert['message'] = $this->input->post('message');



                            



                            $sender_name = $this->input->post('sender_name');



                            $sender_email = $this->input->post('sender_email');



                            $insert['sender_name'] = $sender_name;



                            $insert['sender_email'] = $sender_email;



                            



                            $insert['created_at'] = date('Y-m-d H:i:s');



                            if ($this->session->userdata('userId')) {



                                $insert['user_id'] = $this->session->userdata('userId');



                            }



                            



                            $insert['full_name']  = $postData['fname'].' '.$postData['lname'];



                            



                            $insert['ip_address'] = $this->input->ip_address();



                            $insert['user_agent'] = $this->input->user_agent();



                            $insert['browser'] = $this->agent->browser();



                            $insert['browserVersion'] = $this->agent->version();



                            $insert['platform'] = $this->agent->platform();



                            



                            $this->db->insert('giftcard_booking',$insert);



                            $orderId = $this->db->insert_id();  



                            $userInvoice = ['orderId'=> $orderId];



                            $this->session->set_userdata($userInvoice);



                            



                            



                            $success = true;



                            $payment_method = $response_array['method'];



                            $payment_status = $response_array['status'];



                            



                            



                            



                            if(!empty($this->session->userdata('ci_subscription_keys'))) {



                                //$this->session->unset_userdata('ci_subscription_keys');



                            }



                            $up['txn_id'] = $this->session->flashdata('razorpay_payment_id');



                            $up['payment_status'] = $payment_status;



                            $up['method'] = $payment_method;



                           



                            $this->db->where('id', $orderId);



                            $update_password = $this->db->update('giftcard_booking',$up); 



                            //echo $this->db->last_query();die;



                            $uRow = $this->db->get_where('vender',['email'=> $email])->row_array();



                            



                            if(!$uRow){



                                $insert = array();



                                $insert['fname'] = $this->input->post('fname');



                                $insert['lname'] = $this->input->post('lname');



                                $insert['mobile'] = $this->input->post('mobile');



                                $insert['email'] = $email = $this->input->post('email');



                                $insert['created_at'] = date('Y-m-d H:i:s');



                            



                            



                                 



                                $insert['password']  = md5(123456);



                                $insert['user_type']  = 3;



                                $this->db->insert('vender',$insert); 



                                $userInvoice = ['password_status'=> 1];



                                $this->session->set_userdata($userInvoice);



                            }else{



                                $userInvoice = ['password_status'=> 0];



                                $this->session->set_userdata($userInvoice);



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



                    $id = $this->session->userdata('orderId');



                    $order = $this->db->get_where('giftcard_booking',['id'=> $id])->row_array();



            



                    $option = '';



                    $option .= '<h3 style="margin-bottom: 0px;"><b> Hello : </b>'.ucwords($order['sender_name']).'</h3>';



                    $option .= '<p>Thank you for purchasing Gift Card for <b>'.ucwords($order['fname'].' '.$order['lname']).'.</b> <br>Your Gift Card has been delivered to the sender mail address <br> <b><i class="fa fa-envelope"></i> '.$order['email'].'. </b></p>';



                    $option .= '<hr>';



                    $option .= '<p>For help on how to encash the gift card, please visit our Help Section or write to us on <b>'.$this->site->mobile.'</b></p>'; 



                    $this->session->set_flashdata('gift_booking_success',$option);



                    /*



                    $option = '';



                    $option .= '<h3 style="margin-bottom: 0px;"><b> Hello : </b>'.ucwords($order['sender_name']).'</h3>';



                    $option .= '<p>Thank you for purchasing Gift Card for '.ucwords($order['fname'].' '.$order['lname']).'. Your Gift Card has been delivered to the sender mail address '.$order['email'].'. </p>';



                    $option .= '<p><b>For help on how to encash the gift card, please visit our Help Section or write to us on '.$this->site->mobile.'</b></p>'; 



                    $this->session->set_flashdata('gift_booking_success',$option); */



                     



                    redirect($this->input->post('merchant_surl_id'));



                } else {



                    redirect($this->input->post('merchant_furl_id'));



                }



            } else {



                echo 'An error occured. Contact site administrator, please!';



            }



        }



    }



    public function giftcard_booking_success() {



        if($this->session->userdata('orderId')){



            $id = $this->session->userdata('orderId');



            $order = $this->db->get_where('giftcard_booking',['id'=> $id])->row_array();



            $data['order'] = $order;







             



            $data['title'] = 'Razorpay Success';



            $option = '<div class="summery_order">';



                $option = '<div class="row align-items-center">



                                <div class="col-sm-12">



                                    <p class="odds">



                                        <b>Order ID : '.$order['order_id'].' | </b>



                                        <b>Payment Method: <span class="approved" style="color: green;font-weight: bold;">'.$order['payment_gateway'].'</span> | </b>



                                        <b>Payment Status: <span class="approved" style="color: green;font-weight: bold;">'.$order['payment_status'].'</span> | </b>



                                        Order Date : '. date('j F, Y',strtotime($order['created_at'])) .'



                                    </p>



                                </div>



                            </div>';



                     $option .= '<table cellspacing="0" cellpadding="4" class="table table-bordered table-striped" style="width:100%; border: 1px solid #ccc; border-collapse: collapse;">';







                            $option .= '<tr style="border: 1px solid #333;">



                                <td style="border: 1px solid #333;" class="text-left"><b>Recipient Name : </b></td>



                                <td style="border: 1px solid #333;" class="text-left">'.ucwords($order['fname'].' '.$order['lname']).'</td>



                            </tr>';



                            $option .= '<tr style="border: 1px solid #333;">



                                <td style="border: 1px solid #333;" class="text-left"><b>Recipient Email : </b></td>



                                <td style="border: 1px solid #333;" class="text-left">'.ucwords($order['email']).'</td>



                            </tr>';



                            $option .= '<tr style="border: 1px solid #333;">



                                <td style="border: 1px solid #333;" class="text-left"><b>Recipient Mobile : </b></td>



                                <td style="border: 1px solid #333;" class="text-left">'.ucwords($order['mobile']).'</td>



                            </tr>';



                            $option .= '<tr style="border: 1px solid #333;">



                                <td style="border: 1px solid #333;" class="text-left"><b>Sender Name : </b></td>



                                <td style="border: 1px solid #333;" class="text-left">'.ucwords($order['sender_name']).'</td>



                            </tr>';



                            $option .= '<tr style="border: 1px solid #333;">



                                <td style="border: 1px solid #333;" class="text-left"><b>Sender Email : </b></td>



                                <td style="border: 1px solid #333;" class="text-left">'.ucwords($order['sender_email']).'</td>



                            </tr>';



                            $option .= '<tr style="border: 1px solid #333;">



                                <td style="border: 1px solid #333;" class="text-left"><b>Message : </b></td>



                                <td style="border: 1px solid #333;" class="text-left">'.($order['message']).'</td>



                            </tr>';



                             



                            $option .= '<tr style="border: 1px solid #333;">



                                <td style="border: 1px solid #333;" class="text-left"><b>Gift Card Code : </b></td>



                                <td style="border: 1px solid #333;" class="text-left">'.($order['gift_code']).'</td>



                            </tr>';



                             



                            $option .= '<tr style="border: 1px solid #333;">



                                <td style="border: 1px solid #333;"> <b>Gift Card Price : </b></td>



                                <td style="border: 1px solid #333;"> <b>'. $this->site->currency.' '.($order['total_price']) .'</b></td>



                            </tr>';



                             



                $option .= '</table>';



                 



            $option .= '</div>';



            







            $data['result']  = $option;







            /**/



             /*$option = '';



                    $option .= '<h3 style="margin-bottom: 0px;"><b> Hello : </b>'.ucwords($order['sender_name']).'</h3>';



                    $option .= '<p>Thank you for purchasing Gift Card for <b>'.ucwords($order['fname'].' '.$order['lname']).'.</b> <br>Your Gift Card has been delivered to the sender mail address <br> <b><i class="fa fa-envelope"></i> '.$order['email'].'. </b></p>';



                    $option .= '<hr>';



                    $option .= '<p>For help on how to encash the gift card, please visit our Help Section or write to us on <b>'.$this->site->mobile.'</b></p>'; 



                    $this->session->set_flashdata('gift_booking_success',$option);*/



             /**/



            $mail=array();



            $mail['order_table'] = 'giftcard_booking'; 



            $mail['order_id'] = $id; 



            $this->sendMail($mail);



            $data['seoData'] = array();



            $list = $this->db->query('select * from cms_pages where slug = "order-success" and status=1')->row();



            if($list) {



                $data['seoData'] = $list;



            } 



            $this->load->view('giftcard-booking-success',$data);



        }else{



            redirect(base_url());



        }   



    }



    public function failed() {



        $data['title'] = 'Razorpay Failed';  



        $msg = "<h4>Your transaction got Failed</h4>";  



        $msg .= "<br/>";



        $msg .= "Transaction ID: ".$this->session->flashdata('razorpay_payment_id');



        $msg .= "<br/>";



        $msg .= "Order ID: ".$this->session->flashdata('merchant_order_id');



        $data['message'] = $msg;



        $data['parentCategory'] = $this->data['parentCategory'];



        $this->load->view('order-failed',$data);



    }



    public function sendMail($data){



        $this->cart->destroy();



        $user_id  = $this->session->userdata('session_user_id_temp');



        $conSession = array('user_id'=>$user_id);



        $this->common_model->commonDelete('user_cart',$conSession);



        $this->common_model->commonDelete('user_cart_session',$conSession);



        



        if ($data['order_table'] == 'order') { 



            $id = $data['order_id'];



            //$order = $this->db->get_where('user_order',['id'=> $id,'sentMailFlag'=>0])->row_array();



            $order = $this->db->get_where('user_order',['id'=> $id])->row_array();



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



                 



                $option = '';



                $option .= '<style>';



                    $option .= '.banner{background: #FFFA00; }



                                .banner h1{padding:45px; font-weight: 700; font-size: 32px; line-height: 44px; text-transform: uppercase;}



                                .banner img {width: 100%; height: 190px; object-fit: cover; }



                                .meddle_content{padding:30px 40px; background:#fff;}



                                .meddle_content h4{font-weight: 700; font-size: 15px; line-height: 22px;}   



                                .meddle_content p{font-weight: 400; font-size: 14px; line-height: 19px; width: 100%; margin-bottom: 0px;}



                                .bt_box { background: #FF00A8; border-radius: 6px; color: #FFF; text-decoration: none; padding: 10px 20px; font-size: 15px; font-weight: 700; font-style: normal; letter-spacing: 0.5px; margin-top:24px; display: inline-block;}



                                .bt_box:hover{text-decoration:none; color:#fff; background:#000;}



                                .meddle_content hr {color: #a3a0a0; margin: 10px 0px; }



                                .ord {font-size: 10px; line-height: 14px; }



                                .view_to { font-size: 10px; line-height: 14px; background: rgba(0, 255, 240, 0.5); border-radius: 8px; padding: 10px; }



                                .next_sp { font-weight: 700; font-size: 15px; line-height: 22px; letter-spacing: 0.02em; color: #FF00C7; margin-bottom: 10px; }



                                .next_data p { font-style: normal; font-weight: 400; font-size: 12px; line-height: 16px; color: #000000; margin-bottom: 15px; width: 80%; }



                                .pk_list { font-size: 13px; line-height: 18px; margin-bottom: 6px; }  



                                .pk_list span { float: right; font-weight: 600; }



                                .pk_list img { margin-right: 15px; }



                                .shipp{font-size: 12px; line-height: 14px;}';



                $option .= '</style>';







                 

                



                $cart_typeArray = array();



                $mailContent =  mailHtmlHeader_New($this->site);



                    $mailContent .= $option;

                    $mailContent .= '<div class="common_w" style="padding:20px 20px;text-align:center;background:#FFFA00;"><b>Purchase confirmation</b></div>';



                    $mailContent .= '<div style="clear: both;"></div>';



                    $mailContent .= '<div class="common_w meddle_content" style="background:#fff;width:100%">';



                        $mailContent .= '<h4>'.ucwords($order['fname'].' '.$order['lname']).', Thank you for purchasing from Stylebuddy</h4>';



                        $mailContent .= '<p><b>Product Details</b></p>';



                        $mailContent .= '<div class="col-sm-12 p-0 mb-4">';



                            $mailContent .= '<div class="pk_list">';



                                    $option = '';



                                    $total = 0; 



                                    $discountTotal = 0;



                                 



                                    foreach($orderDetails as $list) {



                                        if (!in_array($list->cart_type, $cart_typeArray)) {



                                            array_push($cart_typeArray, $list->cart_type);



                                        } 



                                        $total += $list->totalMrpPrice;



                                        $discountTotal += $list->totalDiscount; 



                                       



                                        $finalImageUrl = 'assets/images/product/'.$list->productImg;



                                        if ($list->cart_type == 'service') {



                                            $finalImageUrl = $list->productImg;



                                        }







                                        $img =  'assets/images/no-image.jpg'; 



                                        if(!empty($finalImageUrl))  { 



                                            if (file_exists($finalImageUrl)) {



                                                $img = $finalImageUrl;



                                            }



                                        }



                                 



                             



                                        $option .= '<div class="row m-0 align-items-center">';



                                            $option .= '<div class="col-sm-2 p-0" style="width:18%;float:left;">';



                                                $option .= '<img src="'.base_url($img).'" class="min_pro" style="width:90%;border-radius: 4px;margin-right: 15px;">';



                                            $option .= '</div>';



                                            $option .= '<div class="col-sm-6 p-0" style="width:52%;float:left;word-break: break-all;">';



                                                $option .= '<span style="vertical-align: middle;"> '. ucwords($list->productName) .'    x  '. $list->productQty .'</span>';



                                            $option .= '</div>';



                                            $option .= '<div class="col-sm-4 p-0"  style="width:20%;float:left;">';



                                                if ($list->productMrpPrice > $list->productPrice) {



                                                    $option .= '<span style="float: right; font-weight: 600;text-decoration: line-through;">Rs. '.($list->productMrpPrice) .'</span><br/>';



                                                } 



                                                $option .= '<span style="float: right; font-weight: 600">Rs. '.($list->productPrice).'</span>';



                                                



                                            $option .= '</div>';



                                            $option .= '<div class="col-sm-6 p-0" style="width:10%;float:right;word-break: break-all;">';



                                            $option .= '</div>';



                                        $option .= '</div>';



                                        $option .= '<div style="clear:both"></div>';



                                    } 



                                    $mailContent .= $option; 



                            $mailContent .= '</div>';



                        $mailContent .= '</div>';



                        $option = '';



                        $option .= '<div style="clear:both"></div>';



                        $option .= '<hr/>';



                        $option .= '<div style="clear:both"></div>';



                            $option .= '<div class="col-sm-12 p-0 mb-4">';



                                $option .= '<div class="pk_list">';



                                    $option .= '<div class="row m-0 align-items-center"  style="width:100%;">';



                                        $option .= '<div class="col-sm-8 p-0" style="width:60%;float:left;">';



                                        $option .= '</div>';



                                        $option .= '<div class="col-sm-4 p-0"  style="width:40%;float:right;">';



                                            $option .= '<p><b> Total : Rs. '.($total) .'</b></p>';



                                            $option .= '<p><b> Discount : Rs. '.($discountTotal) .'</b></p>';



                                            if ($order['coupon_value']) {

                                                if($order['coupon_type'] == 'coupon'){
                                                    $option .= '<p> <b>Coupon Code Discount('.$order['coupon_code'].') : - Rs. '.number_format($order['coupon_value']) .'</b></p>';
                                                }else{ 
                                                    $option .= '<p> <b>Gift Card Discount('.$order['coupon_code'].') : - Rs. '.number_format($order['coupon_value']) .'</b></p>';
                                                }


                                                



                                            }



                                            $option .= '<p><b> Subtotal : Rs. '.($order['total_price']) .'</b></p>';



                                        $option .= '</div>';



                                    $option .= '</div>';



                                $option .= '</div>';



                            $option .= '</div>';



                        $mailContent .= $option;



                        $mailContent .= '<div style="clear:both"></div>';



                        $mailContent .= '<hr/>';



                        $mailContent .= '<div class="row m-0"  style="width:100%;">';



                            $mailContent .= '<div class="col-sm-6 p-0">';



                                $mailContent .= '<p class="mb-3"><b>Purchase Details</b></p>';



                                    $mailContent .= '<div class="shipp">';



                                        $mailContent .= 'Order ID : #'.$order['order_id'].' <br>';



                                        $mailContent .= 'Payment Method: '.$order['payment_gateway'].' <br>';



                                        $mailContent .= 'Payment Status: '.$order['payment_status'].' <br>';



                                        $mailContent .= 'Purchase Date : '.date('d M, Y',strtotime($order['created_at']));



                                    $mailContent .= '</div>';



                            $mailContent .= '</div>';



                            $mailContent .= '<div class="col-sm-6 p-0">';



                                if(in_array('product',$cart_typeArray)){



                                    $mailContent .= '<p class="mb-3"><b>Shipping Details</b></p>';



                                    $mailContent .= '<div class="shipp">';



                                        $mailContent .= 'Address : #'.$order['address'].' '.$order['city'].' '.$order['state'].' '.$order['country'].' <br>';



                                        $mailContent .= 'Pin: '.$order['pincode'].' <br>';



                                        $mailContent .= 'Mobile: '.$order['mobile'].' <br>';



                                        $mailContent .= 'Purchase Date : '.date('d M, Y',strtotime($order['created_at'])).'';



                                        if($this->session->userdata('guest')){



                                                    $mailContent .= '<b>Acount Detail:</b><br/>';   



                                                    $mailContent .= '<b>Email: '.$order['user_email'].'</b><br/>';   



                                                    $mailContent .= '<b>Password: 123456</b><br/>';   



                                        }



                                    $mailContent .= '</div>';



                                }



                            $mailContent .= '</div>';



                        $mailContent .= '</div>';



                        $mailContent .= '<hr/>';



                        $mailContent .= '<div class="next_sp" style="font-weight: 700; font-size: 15px; line-height: 22px; letter-spacing: 0.02em; color: #FF00C7; margin-bottom: 10px;">Next Steps</div>';



                        $mailContent .= '<div class="next_data">



                                            <p style="font-style: normal; font-weight: 400; font-size: 12px; line-height: 16px; color: #000000; margin-bottom: 15px; width: 80%; ">We will keep you updated on where your order is and when it will get delivered to you. Please check your email for updates. </p>



                                        </div>';



                    $mailContent .= '</div>';



                    



                $mailContent .= mailHtmlFooter_New_2($this->site);



                $subject =  'Your '.$this->site->site_name.' order has been received!';



                



                $to      =  'vijay@gleamingllp.com,'.$order['user_email'];



                $from = FROM_EMAIL;



                $from_name = $this->site->site_name;



                $cc = CC_EMAIL;



                $reply = REPLY_EMAIL;



                



                $pdf_name = 'invoice_'.time() .'.pdf';



                $pdfFilePath = FCPATH . "assets/images/pdf/" . $pdf_name;



                $sty = '<style type="text/css"> body { font-family: DejaVu Sans, sans-serif; }</style>';



                try {



                    /*$this->load->library('m_pdf'); 



                    $this->m_pdf->pdf->AddPage();



                    $this->m_pdf->pdf->WriteHTML($mailContent);



                    $this->m_pdf->pdf->Output($pdfFilePath, 'F');*/



                    //$this->createPDF($pdfFilePath, $mailContent);



                



                    $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $pdfFilePath='');



                    



                    if($this->session->userdata('guest')){



                                            



                                        



                        $subject =  'Your account Detail';



                        



                        



                        $option = '<style>';



                            $option .= '



                                .banner{background: #FFFA00; }



                                .banner h1{padding:45px; font-weight: 700; font-size: 32px; line-height: 44px; text-transform: uppercase;}



                                .banner img {width: 100%; height: 190px; object-fit: cover; }



                                .meddle_content{padding:30px 40px; background:#fff;}



                                .meddle_content h4{font-weight: 700; font-size: 15px; line-height: 22px;}   



                                .meddle_content p{font-weight: 400; font-size: 14px; line-height: 19px; width: 82%; margin-bottom: 0px;}



                                .bt_box { background: #FF00A8; border-radius: 6px; color: #FFF; text-decoration: none; padding: 10px 20px; font-size: 15px; font-weight: 700; font-style: normal; letter-spacing: 0.5px; margin-top:24px; display: inline-block;}



                                .bt_box:hover{text-decoration:none; color:#fff; background:#000;}';







                        $option .= '</style>';



                        /*$option .='<div class="common_w banner" style="width:100%; margin:auto;background: #FFFA00;height: 160px; ">';



                            $option  .= '<div class="row m-0" style="width:100%;">';



                                $option  .= '<div class="col-sm-7 p-0" style="width:60%;float:left;">';



                                    $option  .= '<h1 style="padding-top:24px;padding-left:16px;padding-right:16px;text-align:center; font-weight: 700; font-size: 20px; line-height: 28px; text-transform: uppercase;">Welcome to STYLEBUDDY</h1>';



                                $option  .= '</div>';



                                $option  .= '<div class="col-sm-5 p-0" style="width:40%;float:right;">';



                                    $option  .= '<img style="width: 100%; height: 160px; object-fit: cover; " src="'.base_url('assets/images/email_banner_user.png').'" class="img-fluid">';



                                $option  .= '</div>';



                            $option  .= '</div>';



                        $option  .= '</div>';*/



                        



                        /*$option .='<div class="common_w banner"  style="width:100%; display:block;">';



                            $option  .= '<div class="row m-0" style="width:100%;">';



                                $option  .= '<div class="col-sm-7 p-0" style="width:60%; height: 100%; float:left;  ">';



                                    $option  .= '<h1 style="margin-top: 14%; padding-left:16px;padding-right:16px;text-align:center; font-weight: 700; 



                                    font-size: 100%; line-height: 20px; text-transform: uppercase;">Welcome to STYLEBUDDY</h1>';



                                $option  .= '</div>';



                                $option  .= '<div class="mobile-view col-sm-5 p-0" style="width:40%;float:right;">';



                                    $option  .= '<img style="width: 100%; height: auto; display:block;" src="'.base_url('assets/images/email_banner_user.png').'" class="img-fluid"> ';



                                $option  .= '</div>';



                            $option  .= '</div>';



                        $option  .= '</div>';*/



        







                        $mailContent =  mailHtmlHeader_New($this->site);



                            $mailContent .= $option;

                            $mailContent .= '<div class="common_w" style="padding:20px 20px;text-align:center;background:#FFFA00;"><b>Welcome to STYLEBUDDY</b></div>';



                            $mailContent .= '<div style="clear: both;"></div>';



                            $mailContent.='<div class="common_w meddle_content" style="padding:30px 40px;background:#fff;">';



                                $mailContent .= '<h4 style="font-weight: 700; font-size: 15px; line-height: 22px;">Hi '.ucwords($order['fname'].' '.$order['lname']).'</h4>';



                                $mailContent .= '<p>Email: '.$order['user_email'].'</p>';   



                                $mailContent .= '<p>Password: 123456</p>';  



                        



                            $mailContent .= '</div>';



                        $mailContent .= mailHtmlFooter_New_1($this->site);



                        



                        $to      =  $order['user_email'];



                        $from = FROM_EMAIL;



                        $from_name = $this->site->site_name;



                        $cc = CC_EMAIL;



                        $reply = REPLY_EMAIL;



                        $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $pdfFilePath='');



                    }



                    unlink($pdfFilePath);



                    $this->session->set_flashdata('success','<span class="text-white bg-info p-2">Quote has been sent Successfully!!</span>'); 



                      



                } catch(Exception $e) {



                    echo 'Error';



                    echo $e;



                }



             



            }



        }else if ($data['order_table'] == 'services_booking') { 



            $id = $data['order_id'];



            $order = $this->db->get_where('services_booking',['id'=> $id,'sentMailFlag'=>0])->row();



            //$order = $this->db->get_where('services_booking',['id'=> $id])->row();



            if ($order) {



                



                $vendorRow = $this->db->get_where('vender',['id'=>$order->vendor_id])->row();



        



                if ($vendorRow->expertise) {



                    $area_expertise = explode(',', $vendorRow->expertise);



                    $ideas = $this->db->query('SELECT * from area_expertise'." WHERE status = 1 and  id = ".$area_expertise[0])->row();



                    $vendorRow->area_expertiseRow = $ideas;



                }



                



                



                $condition = " WHERE id = '". $order->package_id ."'";



                $value = $this->common_model->get_all_details_query('services_vendor',$condition)->row_array();



                 



                if ($value['admin_status']) {



                    $condition = " WHERE services_id = '". $value['services_id'] ."' order by id asc";



                }else{



                    $condition = " WHERE services_id = '". $value['id'] ."' order by id asc";



                }



                $rows = $this->common_model->get_all_details_query('services_feature',$condition)->result_array();



                  



                $txt = 'Classic';



                if ($order->package == 'package_price_1') {



                   $txt = 'Classic';



                   $description = 'package_description_1';



                }elseif ($order->package == 'package_price_2') {



                   $txt = 'Premium';



                   $description = 'package_description_2';



                }elseif ($order->package == 'package_price_3') {



                   $txt = 'Luxury';



                   $description = 'package_description_3';



                }







                $up = array();



                $up['sentMailFlag'] = 1;



                $this->db->where('id', $id);



                $this->db->update('services_booking',$up); 



                 



                



                $option = '<p>Thank you for purchasing the ‘‘'.$vendorRow->area_expertiseRow->name.'’’ services delivered by <b>'.$vendorRow->fname.' '.$vendorRow->lname.'</b> from the stylebuddy platform.</p>';



                $option .= '<p>This is to confirm we have received your order of ‘‘'.$txt.' Package’’ which will be delivered by <b>'.$vendorRow->fname.' '.$vendorRow->lname.'</b>.</p>';



                



                 



                $option .= '<div class="summery_order">';



                                $option .= '<p style="margin:40px 0px;"><b style="border: 1px solid #333; padding: 10px 14px; border-radius: 4px; background: #742ea0; color: #FFF;">The Next steps</b></p>';



                                $option .= '<p>The Stylebuddy team will be in touch with you very soon via phone or email to confirm the order and explain the next steps about delivering the styling service to you. We request you to respond to any email or phone call from the stylebuddy team. </p>';



                                $option .= '<p>Kindly reach out to <a href="mailto:'.$this->site->email.'" style="color: #742ea0; text-decoration: none;"><i class="fa fa-envelope-o" aria-hidden="true"></i>'.$this->site->email.'</a> for any queries or doubts. </p>';



                                 



                                



                                $option .= '<div style="text-align: center;background: #e7e1c4;padding: 10px;margin-top: 20px; ">';



                                    $option .= '<table cellspacing="0" cellpadding="4"  style="border:1px solid #333333; width:100%; padding: 10px;border-collapse: collapse;">



                                        <tr style="border: 1px solid #333;">



                                            <td style="border: 1px solid #333;" class="text-left"><b>Date of Purchase:</b></td>



                                            <td style="border: 1px solid #333;" class="text-left"><b>'. date('j F, Y',strtotime($order->created_at)) .'</b></td>



                                        </tr>



                                        <tr style="border: 1px solid #333;">



                                            <td style="border: 1px solid #333;" class="text-left"><b>Order ID :</b></td>



                                            <td style="border: 1px solid #333;" class="text-left"><b>#'.$order->id.'</b></td>



                                        </tr>



                                        <tr style="border: 1px solid #333;">



                                            <td style="border: 1px solid #333;" class="text-left"><b>Package Price :</b></td>



                                            <td style="border: 1px solid #333;" class="text-left"><b>INR '.($order->total_price) .'</b></td>



                                        </tr>



                                         <tr style="border: 1px solid #333;">



                                            <td style="border: 1px solid #333;" class="text-left"><b>GST @ 18% :</b></td>



                                            <td style="border: 1px solid #333;" class="text-left"><b>INR '.($order->tax_total) .'</b></td>



                                        </tr>



                                         <tr style="border: 1px solid #333;">



                                            <td style="border: 1px solid #333;" class="text-left"><b>Grand Total :</b></td>



                                            <td style="border: 1px solid #333;" class="text-left"><b>INR '.($order->grand_total) .'</b></td>



                                        </tr>



                                        <tr style="border: 1px solid #333;">



                                            <td style="border: 1px solid #333;" class="text-left"><b>Status :</b></td>



                                            <td style="border: 1px solid #333;" class="text-left"><b>'.$order->payment_status.'</b></td>



                                        </tr>';



                                    $option .= '</table>';



                                $option .= '</div>';



                                 



                                $option .= '<p><b>Your package: </b></p>';



                                $option .= '<div><h3>'.$value['area_expertise_name'].'</h3></div>';



                                $option .= '<p><b>'.$txt.' Package</b></p>';



                                $option .= '<div>'.$value[$description].'</div>';



                             



                $option .= '</div>';



                $option .= '<hr/>';



                        



                $subject =  $this->site->site_name.' - Confirmation of purchase';



                



                



                //invoce



                $invoiceEmailHeader = '<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;800&display=swap" rel="stylesheet">">';



                $invoiceEmailHeader = '<style> 



                                .table{width:100%; font-family: \'Poppins\', sans-serif; margin-top: 0px;  padding: 12px; border-collapse: collapse;}



                                .table thead tr{



                                    background-color: #742ea0;



                                }



                                .table thead td, .table thead th{



                                   font-weight:bold;



                                   text-align:left;



                                }



                                .text-center {



                                    text-align: center!important;



                                }



                                 



                                </style>';



                $invoiceEmailHeader .= '<body style="margin:0px;">';



                    $invoiceEmailHeader .= '<p style="text-align: left; padding-left: 0px; margin-top: 30px;"><img src="'.base_url('assets/images/'.$this->site->logo).'" style="width: 160px;"></p>';



                    $invoiceEmailHeader .= '<table class="table" style="width:100%; border-collapse: collapse; margin-top: 30px; background: #742ea0;">';



                        $invoiceEmailHeader .= '<tr>';



                            $invoiceEmailHeader .= '<td style="width:70%"></td>';



                            $invoiceEmailHeader .= '<td style="width:25%;text-align: right;font-family: \'Poppins\', sans-serif; color: #000;margin: -1px;background: #fff; padding: 1em;"><h3>Tax Invoice Bill</h3> </td>';



                            $invoiceEmailHeader .= '<td style="width:5%"></td>';



                        $invoiceEmailHeader .= '</tr>';



                    $invoiceEmailHeader .= '</table>';







                    















                    $invoiceEmailFooter = '<div style="margin: 30px 0px;border-top: 3px solid #742ea0;background: #f0f0f0;">';



                        $invoiceEmailFooter .= '<table class="table text-center">';



                            $invoiceEmailFooter .= '<tr>';



                                $invoiceEmailFooter .= '<td style="padding-top:1em;">Call</td>';



                                $invoiceEmailFooter .= '<td style="padding-top:1em;">Email</td>';



                                $invoiceEmailFooter .= '<td style="padding-top:1em;">Website</td>';



                            $invoiceEmailFooter .= '</tr>';



                            $invoiceEmailFooter .= '<tr>';



                                $invoiceEmailFooter .= '<td style="padding:1em;"><a style="color:#000;text-decoration:none" href="tel:'.$this->site->mobile.'">'.$this->site->mobile.'</a></td>';



                                $invoiceEmailFooter .= '<td style="padding:1em;"><a style="color:#000;text-decoration:none" href="mailto:'.$this->site->email.'">'.$this->site->email.'</a></td>';



                                $invoiceEmailFooter .= '<td style="padding:1em;"><a style="color:#000;text-decoration:none" href="'.base_url().'">'.base_url().'</a></td>';



                            $invoiceEmailFooter .= '</tr>';



                            $invoiceEmailFooter .= '<tr style="margin-top:2em;">';



                                $invoiceEmailFooter .= '<td colspan="3" style="margin-top:2em;padding:1em;border-top:1px solid #742ea0">Address: '.$this->site->address.'</td>';



                            $invoiceEmailFooter .= '</tr>';



                        $invoiceEmailFooter .= '</table>';



                    $invoiceEmailFooter .= '</div>';



                $invoiceEmailFooter .= '</body>';







             











                $invoiceOption = '<div style="width:100%;  padding:30px 0px; display: inline-block; font-family: \'Poppins\', sans-serif;">';



                    $invoiceOption .= '<div style="padding: 0px 0px; float: left; width: 55%;">';



                        $invoiceOption .= '<p style="margin: 0px; "><b>Invoice to</b></p>';



                        $invoiceOption .= '<h4 style="margin: 0px; text-transform: uppercase; letter-spacing: 1px;">'.ucwords($order->fname.' '.$order->lname).'</h4>';



                        $invoiceOption .= '<p style="margin: 0px 0px;">Address: '.$order->address.'</p>';



                        $invoiceOption .= '<p style="margin: 0px 0px;">Mobile: <a style="color:#000;text-decoration:none" href="tel:'.$order->mobile.'">'.$order->mobile.'</p>';



                        $invoiceOption .= '<p style="margin: 0px 0px;">Email: <a style="color:#000;text-decoration:none" href="mailto:'.$order->user_email.'">'.$order->user_email.'</p>';



                    $invoiceOption .= '</div>';



                    $invoiceOption .= '<div style="padding: 0px 20px; float: right; width: 35%;">';



                        $invoiceOption .= '<p style="margin: 5px 0px;"><b>Invoice# : </b> #'.$order->id.'</p>';



                        $invoiceOption .= '<p style="margin: 5px 0px;"><b>Date : </b> '. date('j F, Y',strtotime($order->created_at)) .'</p>'; 



                        $invoiceOption .= '<p><b style="border-bottom: 1px solid #333;">GSTIN: '.$this->site->gstin.'</b></p>';     



                    $invoiceOption .= '</div>';



                $invoiceOption .= '</div>';



                







                $invoiceOption .= '<table class="table" style="width:100%; font-family: \'Poppins\', sans-serif; margin-bottom: 30px;  border: 1px solid #742ea0; padding: 12px; border-collapse: collapse;">



                                    <thead>



                                        <tr style="">



                                            <th style="padding: 10px;color:#FFF;font-weight: bold; ">S.N.</th>



                                            <th style="padding: 10px;color:#FFF;font-weight: bold; ">Service </th>



                                            <th style="padding: 10px;color:#FFF;font-weight: bold; ">Price</th>



                                            <th style="padding: 10px;color:#FFF;font-weight: bold; ">Total</th>



                                        </tr>



                                    </thead>



                                    <tbody>



                                    <tr>



                                        <td style="padding: 14px;">1</td>



                                        <td style="padding: 14px;">'.$value['area_expertise_name'].'</td>



                                        <td style="padding: 14px;">INR '.($order->total_price) .'</td>



                                        <td style="padding: 14px;">INR '.($order->total_price) .'</td>



                                    </tr>                   



                                    <tr>



                                        <td colspan="5"><div style="height:80px;"></div></td>



                                    </tr>



                                    </tbody>



                                </table>';



                







                $invoiceOption .= '<div style="width:100%; padding:0px 0px; display: inline-block; border: 0px solid #ccc; font-family: \'Poppins\', sans-serif; margin-bottom: 20px;">



    



                                <div style="padding: 0px 0px; float: left; width: 50%;">



                                    <p style="margin-bottom:10px;"><b>Thank you for your business</b></p>



                                    



                                    



                                    <p style="margin:0px;"><b>Terms & Conditions</b></p>



                                    <p style="margin:0px; margin-bottom:10px;">Style Buddy is owned and operated by Strike A Pose Fashion India Pvt. Ltd. 



                                    <br><a style="color:#000;text-decoration:none" href="'.base_url('terms-of-use').'">Terms & Conditions</a></p>



                                </div>



                                



                                <div style="padding: 0px 20px; float: right; width: 40%;">



                                    



                                    <table style="width:100%; font-family: \'Poppins\', sans-serif; margin-top: 0px; font-weight: bold;  padding: 12px; border-collapse: collapse;">



                                        <tr>



                                            <td style="width:70%; padding: 10px;">Total Invoice Value </td>



                                            <td style="text-align: right; padding: 10px;">INR '.($order->total_price) .'</td>



                                        </tr>



                                        <tr>



                                            <td style="width:70%; padding: 10px;">GST @ 18%</td>



                                            <td style="text-align: right; padding: 10px;">INR '.($order->tax_total) .'</td>



                                        </tr>



                                        <tr >



                                            <td style="width:70%; padding: 10px;background-color: #742ea0; color:#FFF;">Total Payable </td>



                                            <td style="text-align: right; padding: 10px;background-color: #742ea0; color:#FFF;">INR '.($order->grand_total) .'</td>



                                        </tr>



                                    </table>



                                </div>  



                            </div>';



                



                



                $mailContent =  mailHtmlHeader($this->site);



                    $mailContent .= '<h1 style="text-align: center;text-transform: uppercase;letter-spacing: 2px;color: #f62ac1;">Confirmation of Purchase</h1>';



                    $mailContent .= '<h3 style="margin-bottom: 0px;"><b><i class="fa fa-user" aria-hidden="true"></i> Dear : </b>Admin</h3>';



                    $mailContent .= $option;



                $mailContent .= mailHtmlFooter($this->site);



                



                $to = TO_EMAIL;



                $from = FROM_EMAIL;



                $from_name = $this->site->site_name;



                $cc = CC_EMAIL;



                $reply = REPLY_EMAIL;



                $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $attach);



                 



                // Send email to   user 



                $mailContent =  mailHtmlHeader($this->site);



                    //$mailContent .= '<p style="text-align: center;text-transform: uppercase;letter-spacing: 2px;color: #f62ac1;">Confirmation of Purchase</p>';



                    $mailContent .= '<p style="color: #f62ac1;">Confirmation of Purchase</p>';



                    $mailContent .= '<h3 style="margin-bottom: 0px;"><b><i class="fa fa-user" aria-hidden="true"></i> Dear : </b>'.ucwords($order->fname.' '.$order->lname).'</h3>';



                    $mailContent .= $option;



                $mailContent .= mailHtmlFooter($this->site);



                $attach_pdf = $invoiceEmailHeader;



                    $attach_pdf .= $invoiceOption;



                $attach_pdf .= $invoiceEmailFooter;







                $to      =  $order->user_email;



                $from = FROM_EMAIL;



                $from_name = $this->site->site_name;



                $cc = CC_EMAIL;



                $reply = REPLY_EMAIL;



                



                $pdf_name = 'invoice_'.time() .'.pdf';



                $pdfFilePath = FCPATH . "assets/images/pdf/" . $pdf_name;



                $sty = '<style type="text/css"> body { font-family: DejaVu Sans, sans-serif; }</style>';



                try {



                    /*$this->load->library('m_pdf'); 



                    $this->m_pdf->pdf->AddPage();



                    $this->m_pdf->pdf->WriteHTML($attach_pdf);



                    $this->m_pdf->pdf->Output($pdfFilePath, 'F');*/







                    //$this->createPDF($pdfFilePath, $attach_pdf);







                    $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $pdfFilePath='');



                    



                    unlink($pdfFilePath);



                    $this->session->set_flashdata('success','<span class="text-white bg-info p-2">Quote has been sent Successfully!!</span>'); 



                      



                } catch(Exception $e) {



                    echo 'Error';



                    echo $e;



                }



                



            }



        }else if ($data['order_table'] == 'consult_order') { 



           $id = $data['order_id'];



            $order = $this->db->get_where('consult_order',['id'=> $id,'sentMailFlag'=>0])->row_array();



            //$order = $this->db->get_where('consult_order',['id'=> $id])->row_array();



            if ($order) {



                



                $up = array();



                $up['sentMailFlag'] = 1;



                $this->db->where('id', $id);



                $this->db->update('consult_order',$up); 



                



                $option .= '<p>Thank you for booking your initial styling consultation with StyleBuddy. A representative from StyleBuddy will contact you soon to schedule your consultation with our Stylist. </p>';



                /*$option .= ' 



                        <h3>Form Details</h3>



                        <p><b>Name : </b>'.$order['fname'].' '.$order['lname'].'<br/>



                        <b>Email Id : </b>'.$order['email'].'<br/>



                        <b>Mobile : </b>'.$order['mobile'].'<br/>



                        <b>Fashion Expert Consultation Fees : </b>'.'INR '.$order['total_price'];*/







                $option .= '<div class="summery_order">';



                    $option .= '<div class="row align-items-center">



                                    <div class="col-sm-12">



                                        <p class="odds">



                                            <b>Order ID : #'.$order['id'].' | </b>



                                            <b>Payment Method: <span class="approved" style="color: green;font-weight: bold;">'.$order['payment_gateway'].'</span> | </b>



                                            <b>Payment Status: <span class="approved" style="color: green;font-weight: bold;">'.$order['payment_status'].'</span> | </b>



                                            Order Date : '. date('j F, Y',strtotime($order['created_at'])) .'



                                        </p>



                                    </div>



                                </div>';



                         $option .= '<div style="background:#f0f0f0; padding:20px;"><table cellspacing="0" cellpadding="4" class="table table-striped" style="width:100%;  border-collapse: collapse;">';







                                $option .= '<tr>



                                    <td style="class="text-left"><b>Name : </b></td>



                                    <td style="class="text-left">'.ucwords($order['fname'].' '.$order['lname']).'</td>



                                </tr>';



                                $option .= '<tr>



                                    <td class="text-left"><b>Email : </b></td>



                                    <td class="text-left">'.ucwords($order['email']).'</td>



                                </tr>';



                                if ($order['mobile']) {



                                    $option .= '<tr>



                                        <td class="text-left"><b>Mobile : </b></td>



                                        <td class="text-left">'.ucwords($order['mobile']).'</td>



                                    </tr>';



                                }



                                if ($order['city']) {



                                    $option .= '<tr>



                                        <td class="text-left"><b>City : </b></td>



                                        <td class="text-left">'.($order['city']).'</td>



                                    </tr>';



                                }



                                if ($order['message']) {



                                    $option .= '<tr>



                                        <td class="text-left"><b>Message : </b></td>



                                        <td  class="text-left">'.$order['message'].'</td>



                                    </tr>';



                                }



                                



                        $option .= '</table><hr style="opacity: .25;"><p><b>Package Name : </b>'. $order['package_name'] .'</p></div>';







                        $option .= '<table cellspacing="0" cellpadding="4" class="table table-striped" style="width:100%;  border-collapse: collapse;">';



                                     







                                $option .= '<tr style="background: #742ea0; color:#ffffff; padding:30px!important; margin-top:15px;">



                                    <td > <b>Package Price : </b></td>



                                    <td > INR '.($order['total_price']) .'</td>



                                </tr>';



                                $package_description =  json_decode($order['package_description']);







                                foreach ($package_description as $key => $value) {



                                    $option .= '<tr style="border-bottom: 1px solid #ccc; padding: 14px 0px;">



                                        <td>'.$value->question_name.' : </td>



                                        <td style="color: #868282;"> '. $value->question_value .'</td>



                                    </tr>';



                                }



                                







                    $option .= '</table>';



                     



                $option .= '</div>';



                



                if($this->session->userdata('password_status')){



                    $option .= '<br/><b>Password:</b>  123456</p>';    



                }



                $option .= '</p>'; 







                if($this->session->userdata('password_status')){



                    $option .= '<p><b>Note: We have also created a StyleBuddy account for you. Your user ID will be your e-mail and temp. password will be 123456. We advise you to please login and reset the password. </b></p>';    



                }



                $subject =  $this->site->site_name.' - Fashion Expert Consultation';



                $mailContent =  mailHtmlHeader($this->site);



                    $mailContent .= '<h3 style="margin-bottom: 0px;"><b><i class="fa fa-user" aria-hidden="true"></i> Dear : </b>Admin</h3>';



                    $mailContent .= $option;



                $mailContent .= mailHtmlFooter($this->site);



                $to = TO_EMAIL;



                $from = FROM_EMAIL;



                $from_name = $this->site->site_name;



                $cc = CC_EMAIL;



                $reply = REPLY_EMAIL;



                $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $attach);



                 



                $mailContent =  mailHtmlHeader($this->site);



                    $mailContent .= '<h3 style="margin-bottom: 0px;"><b><i class="fa fa-user" aria-hidden="true"></i> Dear : </b>'.ucwords($order['fname'].' '.$order['lname']).'</h3>';



                    $mailContent .= $option;



                $mailContent .= mailHtmlFooter($this->site);



                 







                $to      =  $order['email'];



                //$to      =  'vijay@gleamingllp.com';



                $from = FROM_EMAIL;



                $from_name = $this->site->site_name;



                $cc = CC_EMAIL;



                $reply = REPLY_EMAIL;



                



                $pdf_name = 'invoice_'.time() .'.pdf';



                $pdfFilePath = FCPATH . "assets/images/pdf/" . $pdf_name;



                $sty = '<style type="text/css"> body { font-family: DejaVu Sans, sans-serif; }</style>';



                try {



                    /*$this->load->library('m_pdf'); 



                    $this->m_pdf->pdf->AddPage();



                    $this->m_pdf->pdf->WriteHTML($attach_pdf);



                    $this->m_pdf->pdf->Output($pdfFilePath, 'F');*/







                   // $this->createPDF($pdfFilePath, $option);



                    $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $pdfFilePath);



                    



                    



                    if($this->session->userdata('guest')){



                        $subject =  'Your account Detail';



                        $option = '<p>Email: '.$order['email'].'</p>';   



                        $option .= '<p>Password: 123456</p>';  



                        



                        $mailContent =  mailHtmlHeader($this->site);



                            $mailContent .= '<div style="margin-top:30px;padding: 10px 15px;background: #fff8ee;">';



                                $mailContent .= '<h3 style=" font-size:24px;margin-bottom: 0px;"><b>Dear : </b>'.ucwords($order['fname'].' '.$order['lname']).'</h3>';



                                $mailContent .= $option;



                            $mailContent .= '</div>';



                        $mailContent .= mailHtmlFooter($this->site);



                        



                        $to      =  'vijay@gleamingllp.com,'.$order['user_email'];



                        $from = FROM_EMAIL;



                        $from_name = $this->site->site_name;



                        $cc = CC_EMAIL;



                        $reply = REPLY_EMAIL;



                        



                                                



                        $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $pdfFilePath='');



                    



                    }



                    unlink($pdfFilePath);



                    $this->session->set_flashdata('success','<span class="text-white bg-info p-2">Quote has been sent Successfully!!</span>'); 



                      



                } catch(Exception $e) {



                    echo 'Error';



                    echo $e;



                }



            }



        }else if ($data['order_table'] == 'giftcard_booking') { 



            $id = $data['order_id'];



            $order = $this->db->get_where('giftcard_booking',['id'=> $id,'sentMailFlag'=>0])->row_array();



            //$order = $this->db->get_where('giftcard_booking',['id'=> $id])->row_array();



            if ($order) {



                







                







                $up = array();



                $up['sentMailFlag'] = 1;



                $this->db->where('id', $id);



                $this->db->update('giftcard_booking',$up); 



                $subject =  $this->site->site_name.' - Giftcard Purchase';

                $subject1 =  $this->site->site_name.' - Giftcard Received';



                



                 



                $option = '';



                $option .= '<style>';



                    $option .= '.banner{background: #FFFA00; }



                            .banner h1{padding:45px; font-weight: 700; font-size: 32px; line-height: 44px; text-transform: uppercase;}



                            .banner img {width: 100%; height: 190px; object-fit: cover; }



                            .meddle_content{padding:30px 40px; background:#fff;}



                            .meddle_content h4{font-weight: 700; font-size: 15px; line-height: 22px;}   



                            .meddle_content p{font-weight: 400; font-size: 14px; line-height: 19px; width: 100%; margin-bottom: 0px;}



                            .bt_box { background: #FF00A8; border-radius: 6px; color: #FFF; text-decoration: none; padding: 10px 20px; font-size: 15px; font-weight: 700; font-style: normal; letter-spacing: 0.5px; margin-top:24px; display: inline-block;}



                            .bt_box:hover{text-decoration:none; color:#fff; background:#000;}



                            .meddle_content hr {color: #a3a0a0; margin: 10px 0px; }



                            .ord {font-size: 10px; line-height: 14px; }



                            .view_to { font-size: 10px; line-height: 14px; background: rgba(0, 255, 240, 0.5); border-radius: 8px; padding: 10px; }



                            .next_sp { font-weight: 700; font-size: 15px; line-height: 22px; letter-spacing: 0.02em; color: #FF00C7; margin-bottom: 10px; }



                            .next_data p { font-style: normal; font-weight: 400; font-size: 12px; line-height: 16px; color: #000000; margin-bottom: 15px; width: 80%; }



                            .pk_list { font-size: 13px; line-height: 18px; margin-bottom: 6px; }  



                            .pk_list span { float: right; font-weight: 600; }



                            .pk_list img { margin-right: 15px; }



                            .shipp{font-size: 12px; line-height: 14px;}



                            .access {margin-top: 30px; margin-bottom:20px;}



                            .access p { font-weight: 700; font-size: 15px; line-height: 22px; }



                            .access small {font-size: 12px;     line-height: 16px;  }

                            .loging { background: #FF00A8; border-radius: 5px; color: #fff; padding: 12px; margin-top: 25px; width: 90%;}



                            .loging p{font-size: 12px!important; line-height: 16px; }



                            a.loginn { font-weight: 700; font-size: 14px; line-height: 19px; color: #FFF; text-decoration: none; padding: 4px 30px; background: #FF00A8; border-radius: 6px; margin-left: 20px; }



                            ';



                $option .= '</style>';



                 



                



                $mailContent =  mailHtmlHeader_New($this->site);



                    $mailContent .= $option;

                    $mailContent .= '<div class="common_w" style="padding:20px 20px;text-align:center;background:#FFFA00;"><h2><b>Gift Card Purchase</b></h2></div>';



                    $mailContent .= '<div style="clear: both;"></div>';



                    $mailContent .= '<div class="common_w meddle_content"  style="padding:30px 40px;background:#fff;">';



                        $mailContent .= '<h4 style="font-weight: 700; font-size: 15px; line-height: 22px;">'.ucwords($order['sender_name']).', Thank you for purchasing a Gift Card on Stylebuddy</h4>';



                        $mailContent .= '<p><b>Gift Card Purchase Details</b></p><hr>';



                        $mailContent .= '<div class="col-sm-12 p-0 mb-4">';



                            $mailContent .= '<div class="pk_list">';



                                $mailContent .= '<div class="row m-0 align-items-center">';



                                    $mailContent.='<div class="col-sm-8 p-0">1 x '.$order['gift_name'].'</div>';



                                    $mailContent.='<div class="col-sm-4 p-0"><span>Rs. '.$order['total_price'].'/-</span></div>';



                                $mailContent .= '</div>';



                            $mailContent .= '</div>';



                        $mailContent .= '</div><hr/>';



                        $mailContent .= '<p class="this"><b>This service as a reciept for the gift card you have purchased. </b></p>';



                        $mailContent .= '<div class="loging" style="background: #FF00A8; border-radius: 5px; color: #fff; padding: 12px; margin-top: 25px; width: 90%;">';



                            $mailContent .= '<p>Looking to buy more gift cards from us? VISIT our website and buy<br> more gift cards today!</p>';



                            $mailContent .= '<a href="'.base_url().'" class="visit" style="font-weight: 700; font-size: 12px; line-height: 19px; color: #FFF; text-decoration: none; padding: 4px 30px; background: #000000; border-radius: 6px; margin-top:10px; display:inline-block;">VISIT</a>';



                        $mailContent .= '</div>';



                    $mailContent .= '</div>';



                    



                $mailContent .= mailHtmlFooter_New_2($this->site);



                



                $to      =  $order['sender_email'];



                $from = FROM_EMAIL;



                $from_name = $this->site->site_name;



                $cc = CC_EMAIL;



                $reply = REPLY_EMAIL;



                $pdfFilePath = '';



                $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $pdfFilePath);



 







                $option = '';



                $option .= '<style>';



                    $option .= '.banner{background: #FFFA00; }



                                .banner h1{padding:45px; font-weight: 700; font-size: 32px; line-height: 44px; text-transform: uppercase;}



                                .banner img {width: 100%; height: 190px; object-fit: cover; }



                                .meddle_content{padding:30px 40px; background:#fff;}



                                .meddle_content h4{font-weight: 700; font-size: 15px; line-height: 22px;}   



                                .meddle_content p{font-weight: 400; font-size: 14px; line-height: 19px; width: 100%; margin-bottom: 0px;}



                                .bt_box { background: #FF00A8; border-radius: 6px; color: #FFF; text-decoration: none; padding: 10px 20px; font-size: 15px; font-weight: 700; font-style: normal; letter-spacing: 0.5px; margin-top:24px; display: inline-block;}



                                .bt_box:hover{text-decoration:none; color:#fff; background:#000;}



                                .meddle_content hr {color: #a3a0a0; margin: 10px 0px; }



                                .ord {font-size: 10px; line-height: 14px; }



                                .view_to { font-size: 10px; line-height: 14px; background: rgba(0, 255, 240, 0.5); border-radius: 8px; padding: 10px; }



                                .next_sp { font-weight: 700; font-size: 15px; line-height: 22px; letter-spacing: 0.02em; color: #FF00C7; margin-bottom: 10px; }



                                .next_data p { font-style: normal; font-weight: 400; font-size: 12px; line-height: 16px; color: #000000; margin-bottom: 15px; width: 80%; }



                                .pk_list { font-size: 13px; line-height: 18px; margin-bottom: 6px; }  



                                .pk_list span { float: right; font-weight: 600; }



                                .pk_list img { margin-right: 15px; }



                                .loging { background: #FF00A8; border-radius: 5px; color: #fff; padding: 12px; margin-top: 25px; width: 90%;}



                                .loging p{font-size: 12px!important; line-height: 16px; }



                                .this{font-weight: 700!important;font-size: 12px!important; line-height: 22px;   color: #000000;}



                                .visit{font-weight: 700; font-size: 12px; line-height: 19px; color: #FFF; text-decoration: none; padding: 4px 30px; background: #000000; border-radius: 6px; margin-top:10px; display:inline-block;}';



                $option .= '</style>';



                



                

                $mailContent =  mailHtmlHeader_New($this->site);



                    $mailContent .= $option;

                    $mailContent .= '<div class="common_w" style="padding:20px 20px;text-align:center;background:#FFFA00;"><h2><b>Gift Card Received</b></h2></div>';



                    $mailContent .= '<div style="clear: both;"></div>';



                    $mailContent .= '<div class="common_w meddle_content" style="padding:30px 40px;background:#fff;">';



                        $mailContent .= '<h4 style="font-weight: 700; font-size: 15px; line-height: 22px;">'.ucwords($order['fname'].' '.$order['lname']).', You have been sent a Gift Card by '.ucwords($order['sender_name']).'</h4>';



                        $mailContent .= '<p><b>Gift Card Details</b></p><hr>';



                        $mailContent .= '<div class="col-sm-12 p-0 mb-4">';



                            $mailContent .= '<div class="pk_list">';



                                $mailContent .= '<div class="row m-0 align-items-center">';



                                    $mailContent.='<div class="col-sm-8 p-0">1 x '.$order['gift_name'].'</div>';



                                    $mailContent.='<div class="col-sm-4 p-0"><span>Rs. '.$order['total_price'].'/-</span></div>';



                                $mailContent .= '</div>';



                            $mailContent .= '</div>';



                        $mailContent .= '</div><hr/>';



                         



                        $mailContent .= '<div class="loging" style="background: #FF00A8; border-radius: 5px; color: #fff; padding: 12px; margin-top: 25px; width: 90%;">';

                            $mailContent .= '<p>YOUR GIFT CARD CODE IS <b>'.$order['gift_code'].'</b></p>';

                        $mailContent .= '</div><br/>';

                        $mailContent .= '<p class="this"><b>Please remember  and restore this Gift Card at a safe place. You can use this code during checkout stage at '.base_url().'</b></p>';



                    $mailContent .= '</div>';



                $mailContent .= mailHtmlFooter_New_2($this->site);



                



                $to      =  $order['email'];



                $from = FROM_EMAIL;



                $from_name = $this->site->site_name;



                $cc = CC_EMAIL;



                $reply = REPLY_EMAIL;







                $pdf_name = 'invoice_'.time() .'.pdf';



                $pdfFilePath = FCPATH . "assets/images/pdf/" . $pdf_name;



                //$this->createPDF($pdfFilePath, $option);



                $this->send_email($to, $from,$from_name, $subject1, $mailContent, $cc,$reply, $pdfFilePath="");







            }



        }else if ($data['order_table'] == 'giftcard_booking1111111111') { 



            $id = $data['order_id'];



            $order = $this->db->get_where('giftcard_booking',['id'=> $id,'sentMailFlag'=>0])->row_array();



            //$order = $this->db->get_where('giftcard_booking',['id'=> $id])->row_array();



            if ($order) {



                







                







                $up = array();



                $up['sentMailFlag'] = 1;



                $this->db->where('id', $id);



                $this->db->update('giftcard_booking',$up); 



                $subject =  $this->site->site_name.' - Giftcard Purchase';



                



                 



                $option = '';



                $option .= '<style>';



                    $option .= '.banner{background: #FFFA00; }



                            .banner h1{padding:45px; font-weight: 700; font-size: 32px; line-height: 44px; text-transform: uppercase;}



                            .banner img {width: 100%; height: 190px; object-fit: cover; }



                            .meddle_content{padding:30px 40px; background:#fff;}



                            .meddle_content h4{font-weight: 700; font-size: 15px; line-height: 22px;}   



                            .meddle_content p{font-weight: 400; font-size: 14px; line-height: 19px; width: 100%; margin-bottom: 0px;}



                            .bt_box { background: #FF00A8; border-radius: 6px; color: #FFF; text-decoration: none; padding: 10px 20px; font-size: 15px; font-weight: 700; font-style: normal; letter-spacing: 0.5px; margin-top:24px; display: inline-block;}



                            .bt_box:hover{text-decoration:none; color:#fff; background:#000;}



                            .meddle_content hr {color: #a3a0a0; margin: 10px 0px; }



                            .ord {font-size: 10px; line-height: 14px; }



                            .view_to { font-size: 10px; line-height: 14px; background: rgba(0, 255, 240, 0.5); border-radius: 8px; padding: 10px; }



                            .next_sp { font-weight: 700; font-size: 15px; line-height: 22px; letter-spacing: 0.02em; color: #FF00C7; margin-bottom: 10px; }



                            .next_data p { font-style: normal; font-weight: 400; font-size: 12px; line-height: 16px; color: #000000; margin-bottom: 15px; width: 80%; }



                            .pk_list { font-size: 13px; line-height: 18px; margin-bottom: 6px; }  



                            .pk_list span { float: right; font-weight: 600; }



                            .pk_list img { margin-right: 15px; }



                            .shipp{font-size: 12px; line-height: 14px;}



                            .access {margin-top: 30px; margin-bottom:20px;}



                            .access p { font-weight: 700; font-size: 15px; line-height: 22px; }



                            .access small {font-size: 12px;     line-height: 16px;  }



                            a.loginn { font-weight: 700; font-size: 14px; line-height: 19px; color: #FFF; text-decoration: none; padding: 4px 30px; background: #FF00A8; border-radius: 6px; margin-left: 20px; }



                            ';



                $option .= '</style>';



                 



                /*$option  .= '<div class="common_w banner" style="width:100%; margin:auto;background: #FFFA00;height: 260px; ">';



                    $option  .= '<div class="row m-0" style="width:100%;">';



                        $option  .= '<div class="col-sm-7 p-0" style="width:60%;float:left;">';



                            $option  .= '<h1 style="padding-top:42px;padding-left:16px;padding-right:16px;text-align:center; font-weight: 700; font-size: 20px; line-height: 32px; text-transform: uppercase;">PURCHASE confirmation</h1>';



                        $option  .= '</div>';



                        $option  .= '<div class="col-sm-5 p-0" style="width:40%;float:right;">';



                            $option  .= '<img style="width: 100%; height: 260px; object-fit: cover; " src="'.base_url('assets/images/email_banner_gift_1.png').'" class="img-fluid">';



                        $option  .= '</div>';



                    $option  .= '</div>';



                $option  .= '</div>';*/



                /*$option .='<div class="common_w banner" style="width:100%; margin:auto;background: #FFFA00;height: 160px; ">';



                    $option  .= '<div class="row m-0" style="width:100%;">';



                        $option  .= '<div class="col-sm-7 p-0" style="width:60%;float:left;">';



                            $option  .= '<h1 style="padding-top:24px;padding-left:16px;padding-right:16px;text-align:center; font-weight: 700; font-size: 20px; line-height: 28px; text-transform: uppercase;">Purchase confirmation</h1>';



                        $option  .= '</div>';



                        $option  .= '<div class="col-sm-5 p-0" style="width:40%;float:right;">';



                            $option  .= '<img style="width: 100%; height: 160px; object-fit: cover; " src="'.base_url('assets/images/email_banner_gift_1.png').'" class="img-fluid">';



                        $option  .= '</div>';



                    $option  .= '</div>';



                $option  .= '</div>';*/



                /*$option .='<div class="common_w banner"  style="width:100%; display:block;">';



                    $option  .= '<div class="row m-0" style="width:100%;">';



                        $option  .= '<div class="col-sm-7 p-0" style="width:60%; height: 100%; float:left;  ">';



                            $option  .= '<h1 style="margin-top: 14%; padding-left:16px;padding-right:16px;text-align:center; font-weight: 700; 



                            font-size: 100%; line-height: 20px; text-transform: uppercase;">>Purchase confirmation</h1>';



                        $option  .= '</div>';



                        $option  .= '<div class="mobile-view col-sm-5 p-0" style="width:40%;float:right;">';



                            $option  .= '<img style="width: 100%; height: auto; display:block;" src="'.base_url('assets/images/email_banner_gift_1.png').'" class="img-fluid"> ';



                        $option  .= '</div>';



                    $option  .= '</div>';



                $option  .= '</div>';*/



                $mailContent =  mailHtmlHeader_New($this->site);



                    $mailContent .= $option;

                    $mailContent .= '<div class="common_w" style="padding:20px 20px;text-align:center;background:#FFFA00;"><b>Purchase confirmation</b></div>';



                    $mailContent .= '<div style="clear: both;"></div>';



                    $mailContent .= '<div class="common_w meddle_content"  style="background:#fff;">';



                        $mailContent .= '<h4 style="font-weight: 700; font-size: 15px; line-height: 22px;">'.ucwords($order['sender_name']).', You made a Gift Card Purchase from Stylebuddy</h4>';



                        $mailContent .= '<p><b>Gift Card Details</b></p><hr/>';



                        $mailContent .= '<div class="col-sm-12 p-0 mb-4">';



                            $mailContent .= '<div class="pk_list">';



                                $mailContent .= '<div class="row m-0 align-items-center">';



                                    $mailContent.='<div class="col-sm-8 p-0">1 x '.$order['gift_name'].'</div>';



                                    $mailContent.='<div class="col-sm-4 p-0"><span>Rs. '.$order['total_price'].'/-</span></div>';



                                $mailContent .= '</div>';



                            $mailContent .= '</div>';



                        $mailContent .= '</div>';



                        $mailContent .= '<p><b>Purchase Details</b></p><hr>';



                        $mailContent .= '<div class="row m-0">



                                            <div class="col-sm-6 p-0">



                                                <div class="shipp">



                                                    Order ID : #'.$order['order_id'].' <br>



                                                    Payment Method: '.$order['payment_gateway'].' <br>



                                                    Payment Status: '.$order['payment_status'].' <br>



                                                    Purchase Date : '.date('d M, Y',strtotime($order['created_at'])).'



                                                </div>



                                            </div>



                                        </div>';



                        $mailContent .= '<div class="access">



                                            <p>To Access your Gift card code, please  <span><a href="'.base_url('login').'" class="loginn" style="font-weight: 700; font-size: 14px; line-height: 19px; color: #FFF; text-decoration: none; padding: 4px 30px; background: #FF00A8; border-radius: 6px; margin-left: 20px; ">LOGIN</a></span></p>



                                            <small>and visit your dashboard to get Gift card access. </small>



                                        </div><hr> ';



                        $mailContent .= '<div class="next_sp">How to use the Gift Card?</div>



                                            <div class="next_data">



                                                <p>To use the gift card, you need to head over to the Stylebuddy shop or service and input the GIFT CARD CODE given in your dashboard. </p>



                                            </div>';



                    $mailContent .= '</div>';



                    



                $mailContent .= mailHtmlFooter_New_2($this->site);



                



                $to      =  $order['sender_email'];



                $from = FROM_EMAIL;



                $from_name = $this->site->site_name;



                $cc = CC_EMAIL;



                $reply = REPLY_EMAIL;



                $pdfFilePath = '';



                $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $pdfFilePath);











                /*$option = '';



                $option .= '<p>'.$order['sender_name'].' has sent you this amazing gift card from StyleBuddy. You can use this Gift Card to purchase a product or book a personal styling service by visiting '.base_url().'</p>';



                $option .= '<p>Please open the attachment to see your gift card</p>';



                $option .= '<p><b>Your Gift Card is '.($order['gift_code']).'.</b></p>';



                $option .= '<p>Please remember and store this Gift Card Code at a safe place. You can use this code during checkout stage at '.base_url().'</p>'; 



                $option .= '<p>If you have any questions or need support, please WhatsAPP us on '.$this->site->mobile.' or write to us at '.base_url().'</p>'; */







                $option = '';



                $option .= '<style>';



                    $option .= '.banner{background: #FFFA00; }



                                .banner h1{padding:45px; font-weight: 700; font-size: 32px; line-height: 44px; text-transform: uppercase;}



                                .banner img {width: 100%; height: 190px; object-fit: cover; }



                                .meddle_content{padding:30px 40px; background:#fff;}



                                .meddle_content h4{font-weight: 700; font-size: 15px; line-height: 22px;}   



                                .meddle_content p{font-weight: 400; font-size: 14px; line-height: 19px; width: 100%; margin-bottom: 0px;}



                                .bt_box { background: #FF00A8; border-radius: 6px; color: #FFF; text-decoration: none; padding: 10px 20px; font-size: 15px; font-weight: 700; font-style: normal; letter-spacing: 0.5px; margin-top:24px; display: inline-block;}



                                .bt_box:hover{text-decoration:none; color:#fff; background:#000;}



                                .meddle_content hr {color: #a3a0a0; margin: 10px 0px; }



                                .ord {font-size: 10px; line-height: 14px; }



                                .view_to { font-size: 10px; line-height: 14px; background: rgba(0, 255, 240, 0.5); border-radius: 8px; padding: 10px; }



                                .next_sp { font-weight: 700; font-size: 15px; line-height: 22px; letter-spacing: 0.02em; color: #FF00C7; margin-bottom: 10px; }



                                .next_data p { font-style: normal; font-weight: 400; font-size: 12px; line-height: 16px; color: #000000; margin-bottom: 15px; width: 80%; }



                                .pk_list { font-size: 13px; line-height: 18px; margin-bottom: 6px; }  



                                .pk_list span { float: right; font-weight: 600; }



                                .pk_list img { margin-right: 15px; }



                                .loging { background: #FF00A8; border-radius: 5px; color: #fff; padding: 12px; margin-top: 25px; width: 90%;}



                                .loging p{font-size: 12px!important; line-height: 16px; }



                                .this{font-weight: 700!important;font-size: 12px!important; line-height: 22px;   color: #000000;}



                                .visit{font-weight: 700; font-size: 12px; line-height: 19px; color: #FFF; text-decoration: none; padding: 4px 30px; background: #000000; border-radius: 6px; margin-top:10px; display:inline-block;}';



                $option .= '</style>';



                /*$option  .= '<div class="common_w banner" style="width:100%; margin:auto;background: #FFFA00;height: 260px; ">';



                    $option  .= '<div class="row m-0" style="width:100%;">';



                        $option  .= '<div class="col-sm-7 p-0" style="width:60%;float:left;">';



                            $option  .= '<h1 style="padding-top:42px;padding-left:16px;padding-right:16px;text-align:center; font-weight: 700; font-size: 22px; line-height: 32px; text-transform: uppercase;">Gift Card Used to purchase</h1>';



                        $option  .= '</div>';



                        $option  .= '<div class="col-sm-5 p-0" style="width:40%;float:right;">';



                            $option  .= '<img style="width: 100%; height: 260px; object-fit: cover; " src="'.base_url('assets/images/email_banner_gift_2.png').'" class="img-fluid">';



                        $option  .= '</div>';



                    $option  .= '</div>';



                $option  .= '</div>';*/



                /*$option .='<div class="common_w banner" style="width:100%; margin:auto;background: #FFFA00;height: 160px; ">';



                    $option  .= '<div class="row m-0" style="width:100%;">';



                        $option  .= '<div class="col-sm-7 p-0" style="width:60%;float:left;">';



                            $option  .= '<h1 style="padding-top:24px;padding-left:16px;padding-right:16px;text-align:center; font-weight: 700; font-size: 20px; line-height: 28px; text-transform: uppercase;">Gift Card Used to purchase</h1>';



                        $option  .= '</div>';



                        $option  .= '<div class="col-sm-5 p-0" style="width:40%;float:right;">';



                            $option  .= '<img style="width: 100%; height: 160px; object-fit: cover; " src="'.base_url('assets/images/email_banner_gift_2.png').'" class="img-fluid">';



                        $option  .= '</div>';



                    $option  .= '</div>';



                $option  .= '</div>';*/



                /*$option .='<div class="common_w banner"  style="width:100%; display:block;">';



                    $option  .= '<div class="row m-0" style="width:100%;">';



                        $option  .= '<div class="col-sm-7 p-0" style="width:60%; height: 100%; float:left;  ">';



                            $option  .= '<h1 style="margin-top: 14%; padding-left:16px;padding-right:16px;text-align:center; font-weight: 700; 



                            font-size: 100%; line-height: 20px; text-transform: uppercase;">>Gift Card Used to purchase</h1>';



                        $option  .= '</div>';



                        $option  .= '<div class="mobile-view col-sm-5 p-0" style="width:40%;float:right;">';



                            $option  .= '<img style="width: 100%; height: auto; display:block;" src="'.base_url('assets/images/email_banner_gift_2.png').'" class="img-fluid"> ';



                        $option  .= '</div>';



                    $option  .= '</div>';



                $option  .= '</div>';*/



                

                $mailContent =  mailHtmlHeader_New($this->site);



                    $mailContent .= $option;

                    $mailContent .= '<div class="common_w" style="padding:20px 20px;text-align:center;background:#FFFA00;"><b>Gift Card Used to purchase</b></div>';



                    $mailContent .= '<div style="clear: both;"></div>';



                    $mailContent .= '<div class="common_w meddle_content" style="padding:30px 40px;background:#fff;">';



                        $mailContent .= '<h4 style="font-weight: 700; font-size: 15px; line-height: 22px;">'.ucwords($order['fname'].' '.$order['lname']).', You used your Gift Card on Stylebuddy</h4>';



                        $mailContent .= '<p><b>Gift Card Usage Details</b></p><hr>';



                        $mailContent .= '<div class="col-sm-12 p-0 mb-4">';



                            $mailContent .= '<div class="pk_list">';



                                $mailContent .= '<div class="row m-0 align-items-center">';



                                    $mailContent.='<div class="col-sm-8 p-0">1 x '.$order['gift_name'].'</div>';



                                    $mailContent.='<div class="col-sm-4 p-0"><span>Rs. '.$order['total_price'].'/-</span></div>';



                                $mailContent .= '</div>';



                            $mailContent .= '</div>';



                        $mailContent .= '</div><hr/>';



                        $mailContent .= '<p class="this"><b>This is to confirm you have used your gift card on a product or service on stylebuddy. </b></p>';



                        $mailContent .= '<div class="loging">';



                            $mailContent .= '<p>Looking to buy more gift cards from us? VISIT our website and buy<br> more gift cards today!</p>';



                            $mailContent .= '<a href="'.base_url().'" class="visit" style="font-weight: 700; font-size: 12px; line-height: 19px; color: #FFF; text-decoration: none; padding: 4px 30px; background: #000000; border-radius: 6px; margin-top:10px; display:inline-block;">VISIT</a>';



                        $mailContent .= '</div>';



                    $mailContent .= '</div>';



                $mailContent .= mailHtmlFooter_New_2($this->site);



                



                $to      =  $order['email'];



                $from = FROM_EMAIL;



                $from_name = $this->site->site_name;



                $cc = CC_EMAIL;



                $reply = REPLY_EMAIL;







                $pdf_name = 'invoice_'.time() .'.pdf';



                $pdfFilePath = FCPATH . "assets/images/pdf/" . $pdf_name;



                //$this->createPDF($pdfFilePath, $option);



                $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $pdfFilePath="");







            }



        }else if ($data['order_table'] == 'ask_quote_online') { 



           $id = $data['order_id'];



            $order = $this->db->get_where('ask_quote_online',['id'=> $id,'sentMailFlag'=>0])->row_array();



            //$order = $this->db->get_where('ask_quote_online',['id'=> $id])->row_array();



            if ($order) {



                



                $up = array();



                $up['sentMailFlag'] = 1;



                $this->db->where('id', $id);



                $this->db->update('ask_quote_online',$up); 



                



                $option .= '<p>Thank you for booking your initial styling consultation with StyleBuddy. A representative from StyleBuddy will contact you soon to schedule your consultation with our Stylist. </p>';



                $option .= ' 



                        <h3>Form Details</h3>



                        <p><b>Name : </b>'.$order['fname'].' '.$order['lname'].'<br/>



                        <b>Email Id : </b>'.$order['email'].'<br/>



                        <b>Mobile : </b>'.$order['mobile'].'<br/>



                        <b>City : </b>'.$order['city'].'<br/>



                        <b>Consultation Topic : </b>'.$order['area_expertise'].'<br/>



                        <b>Message : </b>'.$order['message'].'<br/>



                        <b>Fashion Expert Consultation Fees : </b>'.'INR '.$order['total_price'];



                        if($this->session->userdata('password_status')){



                            $option .= '<br/><b>Password:</b>  123456</p>';    



                        }



                        $option .= '</p>';  



                        if($this->session->userdata('password_status')){



                            $option .= '<p><b>Note: We have also created a StyleBuddy account for you. Your user ID will be your e-mail and temp. password will be 123456. We advise you to please login and reset the password. </b></p>';    



                        }



                        



                 



                



                 







                $subject =  $this->site->site_name.' - Fashion Expert Consultation';



                



                $mailContent =  mailHtmlHeader($this->site);



                    $mailContent .= '<h3 style="margin-bottom: 0px;"><b><i class="fa fa-user" aria-hidden="true"></i> Dear : </b>Admin</h3>';



                    $mailContent .= $option;



                $mailContent .= mailHtmlFooter($this->site);



                



                $to = TO_EMAIL;



                $from = FROM_EMAIL;



                $from_name = $this->site->site_name;



                $cc = CC_EMAIL;



                $reply = REPLY_EMAIL;



                $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $attach);



                 



                $mailContent =  mailHtmlHeader($this->site);



                    $mailContent .= '<h3 style="margin-bottom: 0px;"><b><i class="fa fa-user" aria-hidden="true"></i> Dear : </b>'.ucwords($order['fname'].' '.$order['lname']).'</h3>';



                    $mailContent .= $option;



                $mailContent .= mailHtmlFooter($this->site);



                 







                $to      =  $order['email'];



                $to      =  'vijay@gleamingllp.com';



                $from = FROM_EMAIL;



                $from_name = $this->site->site_name;



                $cc = CC_EMAIL;



                $reply = REPLY_EMAIL;



                



                $pdf_name = 'invoice_'.time() .'.pdf';



                $pdfFilePath = FCPATH . "assets/images/pdf/" . $pdf_name;



                $sty = '<style type="text/css"> body { font-family: DejaVu Sans, sans-serif; }</style>';



                try {



                    /*$this->load->library('m_pdf'); 



                    $this->m_pdf->pdf->AddPage();



                    $this->m_pdf->pdf->WriteHTML($attach_pdf);



                    $this->m_pdf->pdf->Output($pdfFilePath, 'F');*/



                    //$this->createPDF($pdfFilePath, $option);



                    $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $pdfFilePath);



                    



                    unlink($pdfFilePath);



                    $this->session->set_flashdata('success','<span class="text-white bg-info p-2">Quote has been sent Successfully!!</span>'); 



                      



                } catch(Exception $e) {



                    echo 'Error';



                    echo $e;



                }



            }



        }else if ($data['order_table'] == 'subscription_booking') { 



            $id = $data['order_id'];



            $order = $this->db->get_where('subscription_booking',['id'=> $id,'sentMailFlag'=>0])->row();



            //$order = $this->db->get_where('subscription_booking',['id'=> $id])->row();



            if ($order) {



                



                $vendorRow = $this->db->get_where('vender',['id'=>$order->vendor_id])->row();



        







                $up = array();



                $up['sentMailFlag'] = 1;



                $this->db->where('id', $id);



                $this->db->update('services_booking',$up); 



                 



                



                $option = '<p>Thank you for purchasing the subscription by <b>'.$vendorRow->fname.' '.$vendorRow->lname.'</b> from the stylebuddy platform.</p>';



                 



                $option .= '<div class="summery_order">';



                                $option .= '<p style="margin:40px 0px;"><b style="border: 1px solid #333; padding: 10px 14px; border-radius: 4px; background: #742ea0; color: #FFF;">The Next steps</b></p>';



                                $option .= '<p>The Stylebuddy team will be in touch with you very soon via phone or email to confirm the order and explain the next steps about delivering the styling service to you. We request you to respond to any email or phone call from the stylebuddy team. </p>';



                                $option .= '<p>Kindly reach out to <a href="mailto:'.$this->site->email.'" style="color: #742ea0; text-decoration: none;"><i class="fa fa-envelope-o" aria-hidden="true"></i>'.$this->site->email.'</a> for any queries or doubts. </p>';



                                



                                $option .= '<div style="text-align: center;background: #e7e1c4;padding: 10px;margin-top: 20px; ">';



                                    $option .= '<table cellspacing="0" cellpadding="4"  style="border:1px solid #333333; width:100%; padding: 10px;border-collapse: collapse;">



                                        <tr style="border: 1px solid #333;">



                                            <td style="border: 1px solid #333;" class="text-left"><b>Date of Purchase:</b></td>



                                            <td style="border: 1px solid #333;" class="text-left"><b>'. date('j F, Y',strtotime($order->created_at)) .'</b></td>



                                        </tr>



                                        <tr style="border: 1px solid #333;">



                                            <td style="border: 1px solid #333;" class="text-left"><b>Order ID :</b></td>



                                            <td style="border: 1px solid #333;" class="text-left"><b>#'.$order->id.'</b></td>



                                        </tr>



                                        <tr style="border: 1px solid #333;">



                                            <td style="border: 1px solid #333;" class="text-left"><b>Package Price :</b></td>



                                            <td style="border: 1px solid #333;" class="text-left"><b>INR '.($order->total_price) .'</b></td>



                                        </tr>



                                         <tr style="border: 1px solid #333;">



                                            <td style="border: 1px solid #333;" class="text-left"><b>GST @ 18% :</b></td>



                                            <td style="border: 1px solid #333;" class="text-left"><b>INR '.($order->tax_total) .'</b></td>



                                        </tr>



                                         <tr style="border: 1px solid #333;">



                                            <td style="border: 1px solid #333;" class="text-left"><b>Grand Total :</b></td>



                                            <td style="border: 1px solid #333;" class="text-left"><b>INR '.($order->grand_total) .'</b></td>



                                        </tr>



                                        <tr style="border: 1px solid #333;">



                                            <td style="border: 1px solid #333;" class="text-left"><b>Status :</b></td>



                                            <td style="border: 1px solid #333;" class="text-left"><b>'.$order->payment_status.'</b></td>



                                        </tr>';



                                    $option .= '</table>';



                                $option .= '</div>';



                                 



                                $option .= '<p><b>Your package: </b></p>';



                                $option .= '<div><h3>'.$order->package.'</h3></div>';



                                $option .= '<div>'.$order->package_description.'</div>';



                             



                $option .= '</div>';



                $option .= '<hr/>';



                        



                $subject =  $this->site->site_name.' - Confirmation of purchase';



                



                







                //invoce



                $invoiceEmailHeader = '<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;800&display=swap" rel="stylesheet">">';



                $invoiceEmailHeader = '<style> 



                                .table{width:100%; font-family: \'Poppins\', sans-serif; margin-top: 0px;  padding: 12px; border-collapse: collapse;}



                                .table thead tr{



                                    background-color: #742ea0;



                                }



                                .table thead td, .table thead th{



                                   font-weight:bold;



                                   text-align:left;



                                }



                                .text-center {



                                    text-align: center!important;



                                }



                                 



                                </style>';



                $invoiceEmailHeader .= '<body style="margin:0px;">';



                    $invoiceEmailHeader .= '<p style="text-align: left; padding-left: 0px; margin-top: 30px;"><img src="'.base_url('assets/images/'.$this->site->logo).'" style="width: 160px;"></p>';



                    $invoiceEmailHeader .= '<table class="table" style="width:100%; border-collapse: collapse; margin-top: 30px; background: #742ea0;">';



                        $invoiceEmailHeader .= '<tr>';



                            $invoiceEmailHeader .= '<td style="width:70%"></td>';



                            $invoiceEmailHeader .= '<td style="width:25%;text-align: right;font-family: \'Poppins\', sans-serif; color: #000;margin: -1px;background: #fff; padding: 1em;"><h3>Tax Invoice Bill</h3> </td>';



                            $invoiceEmailHeader .= '<td style="width:5%"></td>';



                        $invoiceEmailHeader .= '</tr>';



                    $invoiceEmailHeader .= '</table>';







                    















                    $invoiceEmailFooter = '<div style="margin: 30px 0px;border-top: 3px solid #742ea0;background: #f0f0f0;">';



                        $invoiceEmailFooter .= '<table class="table text-center">';



                            $invoiceEmailFooter .= '<tr>';



                                $invoiceEmailFooter .= '<td style="padding-top:1em;">Call</td>';



                                $invoiceEmailFooter .= '<td style="padding-top:1em;">Email</td>';



                                $invoiceEmailFooter .= '<td style="padding-top:1em;">Website</td>';



                            $invoiceEmailFooter .= '</tr>';



                            $invoiceEmailFooter .= '<tr>';



                                $invoiceEmailFooter .= '<td style="padding:1em;"><a style="color:#000;text-decoration:none" href="tel:'.$this->site->mobile.'">'.$this->site->mobile.'</a></td>';



                                $invoiceEmailFooter .= '<td style="padding:1em;"><a style="color:#000;text-decoration:none" href="mailto:'.$this->site->email.'">'.$this->site->email.'</a></td>';



                                $invoiceEmailFooter .= '<td style="padding:1em;"><a style="color:#000;text-decoration:none" href="'.base_url().'">'.base_url().'</a></td>';



                            $invoiceEmailFooter .= '</tr>';



                            $invoiceEmailFooter .= '<tr style="margin-top:2em;">';



                                $invoiceEmailFooter .= '<td colspan="3" style="margin-top:2em;padding:1em;border-top:1px solid #742ea0">Address: '.$this->site->address.'</td>';



                            $invoiceEmailFooter .= '</tr>';



                        $invoiceEmailFooter .= '</table>';



                    $invoiceEmailFooter .= '</div>';



                $invoiceEmailFooter .= '</body>';







             











                $invoiceOption = '<div style="width:100%;  padding:30px 0px; display: inline-block; font-family: \'Poppins\', sans-serif;">';



                    $invoiceOption .= '<div style="padding: 0px 0px; float: left; width: 55%;">';



                        $invoiceOption .= '<p style="margin: 0px; "><b>Invoice to</b></p>';



                        $invoiceOption .= '<h4 style="margin: 0px; text-transform: uppercase; letter-spacing: 1px;">'.ucwords($order->fname.' '.$order->lname).'</h4>';



                        $invoiceOption .= '<p style="margin: 0px 0px;">Address: '.$order->address.'</p>';



                        $invoiceOption .= '<p style="margin: 0px 0px;">Mobile: <a style="color:#000;text-decoration:none" href="tel:'.$order->mobile.'">'.$order->mobile.'</p>';



                        $invoiceOption .= '<p style="margin: 0px 0px;">Email: <a style="color:#000;text-decoration:none" href="mailto:'.$order->user_email.'">'.$order->user_email.'</p>';



                    $invoiceOption .= '</div>';



                    $invoiceOption .= '<div style="padding: 0px 20px; float: right; width: 35%;">';



                        $invoiceOption .= '<p style="margin: 5px 0px;"><b>Invoice# : </b> #'.$order->id.'</p>';



                        $invoiceOption .= '<p style="margin: 5px 0px;"><b>Date : </b> '. date('j F, Y',strtotime($order->created_at)) .'</p>'; 



                        $invoiceOption .= '<p><b style="border-bottom: 1px solid #333;">GSTIN: '.$this->site->gstin.'</b></p>';     



                    $invoiceOption .= '</div>';



                $invoiceOption .= '</div>';



                







                $invoiceOption .= '<table class="table" style="width:100%; font-family: \'Poppins\', sans-serif; margin-bottom: 30px;  border: 1px solid #742ea0; padding: 12px; border-collapse: collapse;">



                                    <thead>



                                        <tr style="">



                                            <th style="padding: 10px;color:#FFF;font-weight: bold; ">S.N.</th>



                                            <th style="padding: 10px;color:#FFF;font-weight: bold; ">Service </th>



                                            <th style="padding: 10px;color:#FFF;font-weight: bold; ">Price</th>



                                            <th style="padding: 10px;color:#FFF;font-weight: bold; ">Total</th>



                                        </tr>



                                    </thead>



                                    <tbody>



                                    <tr>



                                        <td style="padding: 14px;">1</td>



                                        <td style="padding: 14px;">'.$value['area_expertise_name'].'</td>



                                        <td style="padding: 14px;">INR '.($order->total_price) .'</td>



                                        <td style="padding: 14px;">INR '.($order->total_price) .'</td>



                                    </tr>                   



                                    <tr>



                                        <td colspan="5"><div style="height:80px;"></div></td>



                                    </tr>



                                    </tbody>



                                </table>';



                







                $invoiceOption .= '<div style="width:100%; padding:0px 0px; display: inline-block; border: 0px solid #ccc; font-family: \'Poppins\', sans-serif; margin-bottom: 20px;">



    



                                <div style="padding: 0px 0px; float: left; width: 50%;">



                                    <p style="margin-bottom:10px;"><b>Thank you for your business</b></p>



                                    



                                    



                                    <p style="margin:0px;"><b>Terms & Conditions</b></p>



                                    <p style="margin:0px; margin-bottom:10px;">Style Buddy is owned and operated by Strike A Pose Fashion India Pvt. Ltd. 



                                    <br><a style="color:#000;text-decoration:none" href="'.base_url('terms-of-use').'">Terms & Conditions</a></p>



                                </div>



                                



                                <div style="padding: 0px 20px; float: right; width: 40%;">



                                    



                                    <table style="width:100%; font-family: \'Poppins\', sans-serif; margin-top: 0px; font-weight: bold;  padding: 12px; border-collapse: collapse;">



                                        <tr>



                                            <td style="width:70%; padding: 10px;">Total Invoice Value </td>



                                            <td style="text-align: right; padding: 10px;">INR '.($order->total_price) .'</td>



                                        </tr>



                                        <tr>



                                            <td style="width:70%; padding: 10px;">GST @ 18%</td>



                                            <td style="text-align: right; padding: 10px;">INR '.($order->tax_total) .'</td>



                                        </tr>



                                        <tr >



                                            <td style="width:70%; padding: 10px;background-color: #742ea0; color:#FFF;">Total Payable </td>



                                            <td style="text-align: right; padding: 10px;background-color: #742ea0; color:#FFF;">INR '.($order->grand_total) .'</td>



                                        </tr>



                                    </table>



                                </div>  



                            </div>';



                



                



                $mailContent =  mailHtmlHeader($this->site);



                    $mailContent .= '<h1 style="text-align: center;text-transform: uppercase;letter-spacing: 2px;color: #f62ac1;">Confirmation of Purchase</h1>';



                    $mailContent .= '<h3 style="margin-bottom: 0px;"><b><i class="fa fa-user" aria-hidden="true"></i> Dear : </b>Admin</h3>';



                    $mailContent .= $option;



                $mailContent .= mailHtmlFooter($this->site);



                



                $to = TO_EMAIL;



                $from = FROM_EMAIL;



                $from_name = $this->site->site_name;



                $cc = CC_EMAIL;



                $reply = REPLY_EMAIL;



                $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $attach);



                 



                // Send email to   user 



                $mailContent =  mailHtmlHeader($this->site);



                    //$mailContent .= '<p style="text-align: center;text-transform: uppercase;letter-spacing: 2px;color: #f62ac1;">Confirmation of Purchase</p>';



                    $mailContent .= '<p style="color: #f62ac1;">Confirmation of Purchase</p>';



                    $mailContent .= '<h3 style="margin-bottom: 0px;"><b><i class="fa fa-user" aria-hidden="true"></i> Dear : </b>'.ucwords($order->fname.' '.$order->lname).'</h3>';



                    $mailContent .= $option;



                $mailContent .= mailHtmlFooter($this->site);



                $attach_pdf = $invoiceEmailHeader;



                    $attach_pdf .= $invoiceOption;



                $attach_pdf .= $invoiceEmailFooter;







                $to      =  $order->user_email;



                $from = FROM_EMAIL;



                $from_name = $this->site->site_name;



                $cc = CC_EMAIL;



                $reply = REPLY_EMAIL;



                



                $pdf_name = 'invoice_'.time() .'.pdf';



                $pdfFilePath = FCPATH . "assets/images/pdf/" . $pdf_name;



                $sty = '<style type="text/css"> body { font-family: DejaVu Sans, sans-serif; }</style>';



                try {



                    /*$this->load->library('m_pdf'); 



                    $this->m_pdf->pdf->AddPage();



                    $this->m_pdf->pdf->WriteHTML($attach_pdf);



                    $this->m_pdf->pdf->Output($pdfFilePath, 'F');*/



                    //$this->createPDF($pdfFilePath, $option);



                    $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $pdfFilePath);



                    



                    unlink($pdfFilePath);



                    $this->session->set_flashdata('success','<span class="text-white bg-info p-2">Quote has been sent Successfully!!</span>'); 



                      



                } catch(Exception $e) {



                    echo 'Error';



                    echo $e;



                }



                



            }



        }else{



        }



    }







    



}
<?php



defined('BASEPATH') OR exit('No direct script access allowed');



require APPPATH . 'libraries/REST_Controller.php';



class Api_v_2 extends REST_Controller{



    function __construct() {



        parent::__construct();



		define('SALT', 'ap7sa0in50f4333x');



		$this->load->model('common_model');



		$this->img_base_url = base_url().'uploads/';



		$this->load->library('pagination');



		$this->load->model('Page_Model');



        $this->site = $this->Page_Model->allController();



	}



	



	function __encrip_password($password){



        $salt = SALT;



        return $hashInput = md5($password);



    }



    public function api_version_post() {



		try {



			$postData = $this->input->post();







			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$auth['access_token'] = $postData['access_token'];



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				$app_mode = $postData['app_mode'];



				$data = $this->common_model->get_all_details('app_version',array('app_mode'=>$app_mode))->row();



		        $response = array(



					'status' => $a['status'],



					'response' => $data,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		}



	}



    public function splash_screen_post() {



		try {



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$postData = $this->input->post();



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){







				$checkLogin = $this->common_model->get_all_details('site_setting',array())->row();







				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'response' => $checkLogin,



				);



			}else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



			}



			$this->set_response($response, REST_Controller::HTTP_OK);



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function check_api_auth($postData) {



		$email = 'admin@gleamingllp.com';



		$password = md5('123456');



		$wherCond= array('email' => $email, 'password' => $password);



		



		/*$email = !empty($postData['email']) ? $postData['email'] : '';



		$password = !empty($postData['password']) ? md5($postData['password']) : '';



		if (!empty($postData['access_token'])) {



			$wherCond= array('access_token' => $postData['access_token']);



		}else{



			$wherCond= array('email' => $email, 'password' => $password);



		}*/



		$checkLogin = $this->common_model->get_all_details('api_users',$wherCond)->row();



		if ($checkLogin) {



			if($checkLogin->active == 1){



				if($checkLogin->status != 1){



					$aa['status'] = 'failed';



					$aa['message'] = 'Your account has been disabled';



					return $aa;



				}



				$aa['status'] = 'success';



				$aa['message'] = 'Record fetched successfully';



				//$aa['response'] = $checkLogin;



				return $aa;



						



			}else{



				$aa['status'] = 'failed';



                $aa['message'] = 'Your account is not verified. So please check your email and click verification link';



                return $aa;



			}



        } 



		else {



			$aa['status'] = 'failed';



            $aa['message'] = 'Invalid credentials please try again';



			return $aa;



        }



    }



	public function login_post() {



		try {



			$postData = $this->input->post();



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$auth['access_token'] = $postData['access_token'];



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				$table = 'vender';



				$device_type 		= $postData['device_type'];



				$email 		= $postData['email'];



	            $password 	= md5($postData['password']);



	            $user_type = $this->input->post('user_type');







				if(empty($email) || empty($postData['password'])){



					$response = array(



						'status' => 'failed',



						'message' => 'Please provide sufficient credentials',



					);



				}else{



					$wherCond= array('email' => $email);



					$row1 = $this->common_model->get_all_details($table,$wherCond)->row();



					//echo $this->db->last_query();



					if($row1){



						$wherCond= array('email' => $email, 'password' => $password, 'user_type' => $user_type);



						$row = $this->common_model->get_all_details($table,$wherCond)->row();



						//echo $this->db->last_query();



						if($row){



							if(empty($row->status)){



								$response = array(



									'status' => 'failed',



									'message' => 'Your account is inactive, please contact to administrator',



								);



							}



							else{

                                $ins = array();

								if($row->registration_on){

                                	$registration_on = $row->registration_on;



									$registration_on_array = explode(',', $registration_on);

									if (!in_array('app',$registration_on_array)) {

										array_push($registration_on_array,'app');

									}

									 

                                    $ins['registration_on'] = implode(',', $registration_on_array);

								}else{

								    $ins['registration_on'] = 'app';

								}

								$this->common_model->commonUpdate('vender',$ins,array('id'=>$row->id));

								

								$row = $this->common_model->get_all_details($table,$wherCond)->row();

								

								unset($row->password);



								$response = array(



									'status' => $a['status'],



									'message' => $a['message'],



									'response' => $row,



								);

 



								if ($postData['device_id']) {



									$device_token = $postData['device_id'];



									$ins = array();



									$ins['device_id'] = $device_token;

                                    

                                     

									$this->common_model->commonUpdate('vender',$ins,array('id'=>$row->id));



                                    

									//$ins['user_id'] = $row->id;



									$row2 = $this->common_model->get_all_details('token_log',$ins)->row();



									if ($row2) {



										$insert['user_id'] = $row->id;



										$insert['device_id'] = $device_token;



										$insert['device_type'] = $device_type;



										$insert['ip_address'] = $this->input->ip_address();



										$insert['user_agent'] = $this->input->user_agent();



										$this->common_model->commonUpdate('token_log',$insert, $ins);



										



									}else{



										$insert['user_id'] = $row->id;



										$insert['device_id'] = $device_token;



										$insert['device_type'] = $device_type;



										$insert['ip_address'] = $this->input->ip_address();



										$insert['user_agent'] = $this->input->user_agent();







										$this->common_model->simple_insert('token_log',$insert);



									}







									/*$token_log 	=  $this->common_model->get_all_details('token_log',array('user_id'=>$row->id))->result_array();



						    		$device_array= array();			



									$payloaArray = array();



									foreach ($users as $key => $value) {



						    			if(!empty($value)){



						    				$device_token = $value['device_id'];



						    				$user_mobile_info = array($device_token);



						    				if($device_token){



												array_push($device_array,$value['device_id']);



											}



						    			}



						    		}



						    		$user_mobile_info = $device_array;



									$payloaArray['badge'] = 1;



									$payloaArray['sound'] = "default";



									$payloaArray['body'] = "Login successfully.";



									$payloaArray['title'] = "Login";



									$payloaArray['notification_type'] = 'login';



									$this->common_model->push_notification($user_mobile_info, $payloaArray);



									



									$activity_log['multicast_id'] = $noti->multicast_id;;



									$activity_log['message_id'] = json_encode($noti->results);



									$activity_log['success_count'] = $noti->success;



									$activity_log['error_count'] = $noti->failure;







									$this->common_model->simple_insert('push_notification_activity_log',$activity_log);







									*/



								}







							}



						}else{



							$response = array(



								'status' => 'failed',



								'message' => 'Invalid credentials',



							);



						}



					}



					else{



						$response = array(



							'status' => 'failed',



							'message' => 'Invalid credential',



						);



					}



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function register_get_data_post() {



		try {



			$postData = $this->input->post();



			 



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$auth['access_token'] = $postData['access_token'];



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				$gender = array(



					array('id'=>'1','name'=>'Male'),



					array('id'=>'2','name'=>'Female')



				);



				



				$list['gender'] =  $gender;



				$experience = array(



					array('id'=>1,'code'=>'0-2','name'=>'0-2 Years'),



					array('id'=>2,'code'=>'2-5','name'=>'2-5 Years'),



					array('id'=>3,'code'=>'5-10','name'=>'5-10 Years'),



					array('id'=>4,'code'=>'10-15','name'=>'10-15 Years'),



					array('id'=>5,'code'=>'15','name'=>'Above 15 Years')



				);



				$list['experience'] =  $experience;







				$list['states'] =  $this->common_model->get_all_details('states',array())->result_array();



		        $list['tags'] =  $this->common_model->get_all_details('idea_tag',array('status'=>1))->result_array();



		        



		        $list['expertise'] =  $this->common_model->get_all_details('area_expertise',array('status'=>1))->result_array();



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'response' => $list,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		}



	}



	public function country_post() {



		try {



			$postData = $this->input->post();



			 



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$auth['access_token'] = $postData['access_token'];



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				$list =  $this->common_model->get_all_details('countries',array())->result_array();



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'response' => $list,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		}



	}



	public function sliderApp_post() {



		try {



			$postData = $this->input->post();



			 



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$auth['access_token'] = $postData['access_token'];



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){

                $list = array();

				$home_slider  =  $this->common_model->get_all_details_query('slider','where id = 20 AND status = 1')->row();

				if($home_slider){

				    $list  =  $this->common_model->get_all_details_query('slides','where slider_id = "'.$home_slider->id.'" AND status = 1 ORDER by ui_order asc')->result();

                }

				

				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],

					'image_path' => 'assets/images/slider/',



					'response' => $list,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		}



	}



	

	public function state_by_country_post() {



		try {



			$postData = $this->input->post();



			 



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$auth['access_token'] = $postData['access_token'];



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				if ($postData['country_id']) {



					$list =  $this->common_model->get_all_details('states',array('country_id'=>$postData['country_id']))->result_array();



				}else{



					$list = array();



				}



		        $response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'response' => $list,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		}



	}



	public function city_by_state_post() {



		try {



			$postData = $this->input->post();



			 



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$auth['access_token'] = $postData['access_token'];



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				if ($postData['state_id']) {



					$list =  $this->common_model->get_all_details('cities',array('state_id'=>$postData['state_id']))->result_array();



				}else{



					$list = array();



				}



		        $response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'response' => $list,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		}



	}



	public function captcha_code_post() {



		try {



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$postData = $this->input->post();



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				$nums = range(0, 9);



				$alphas = range('a', 'z');



				shuffle($nums);



				shuffle($alphas);



				$nums = array_slice($nums, 0, 4);



				$alphas = array_slice($alphas, 0, 3);



				$set = array_merge($nums, $alphas);



				shuffle($set);



				$aa = array();



				$aa['response'] = implode($set);



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'response' => $aa,



				);



			}else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



			}



			$this->set_response($response, REST_Controller::HTTP_OK);



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function register_post() {



		try {



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$postData = $this->input->post();



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				



				$email		= trim($this->input->post('email'));



				$password      = trim($this->input->post('password'));



				$user_type	= 2;







				if(empty($password) || empty($email) || empty($user_type) ){



					$response = array(



						'status' => $a['status'],



						'message' => 'Please provide sufficient credentials',



					);



				}else{



					$table = 'vender';



					$email 		= $postData['email'];



		            $password 	= md5($postData['password']);



		            $wherCond= array('email' => $email);



					$row1 = $this->common_model->get_all_details($table,$wherCond)->row();



					if($row1){



						$response = array(



							'status' => 'failed',



							'message' => 'Email id already exist.Please user diffrent email ID',



						);



					}else{



						



						$data['user_type'] = $user_type;



	                    $data['created_at']  = date('Y-m-d h:i:s');







						$this->uploadPath = 'assets/images/vandor/';



						if (!file_exists($this->uploadPath)) {



				            mkdir($this->uploadPath, 0777, true);



				        }

	                     

	                    $c_c_s = array();

            			$c_c_s['about'] = $postData['about'];;

            			$c_c_s['more_about'] = $postData['more_about'];;

            			$c_c_s['fname'] = $postData['fname'];;

            			$c_c_s['lname'] = $postData['lname'];;

            			$c_c_s['address'] = $postData['address'];

            			$dd = check_content_sightengine($c_c_s);

            			if ($dd) {

            				$msg = 'Your request could not be submitted because you enter inappropriate content.';

            				$response = array(

        		                'status' => 'fail',

        		                'message' =>  $msg,

        	                );

            				$this->set_response($response, REST_Controller::HTTP_OK);

            				return;

            			}

            			$c_c_s = array(); 

                        $image = $this->uploadSingleImageOnly('image',$this->uploadPath);

                        if(!empty($image)){

                            $data['image'] = $image;

                            $c_c_s['image'] = base_url($this->uploadPath.$image);

                        }

                        

                        $dd = check_image_sightengine($c_c_s);

                        if ($dd) {

                            $msg = 'Your request could not be submitted because you enter inappropriate image.';

            				$response = array(

        		                'status' => 'fail',

        		                'message' =>  $msg,

        	                );

            				$this->set_response($response, REST_Controller::HTTP_OK);

            				return;

                        }

                        $image = $this->uploadSingleImageOnly('portfolio_pdf',$this->uploadPath);

                        if(!empty($image)){

                            $data['portfolio_pdf'] = $image;

                        }





	                    $fname = $postData['fname'];



	                    $email = $postData['email'];



	                    $lname = $postData['lname'];



	                    $password = $postData['password'];



	                    $gender = $postData['gender'];



	                    $mobile = $postData['mobile'];



	                    $dob = $postData['dob'];



	                    $address = $postData['address'];



	                    $pin = $postData['pin'];







	                     



	                    $country = $postData['country'];



	                    $state = $postData['state'];



	                    $city = $postData['city'];







	                    $experience = $postData['experience'];



	                    $about = $postData['about'];



	                    $more_about = $postData['more_about'];



	                    $linkedin_link = $postData['linkedin_link'];



	                    $behance_link = $postData['behance_link'];



	                    $facebook_link = $postData['facebook_link'];



	                    $twitter_link = $postData['twitter_link'];



	                    $instagram_nlink = $postData['instagram_nlink'];



	                    $portfolio_rlink = $postData['portfolio_rlink'];



	                    $expertise = $postData['expertise'];



	                    $project_deliverd = $postData['project_deliverd'];



	                    $favourite_wear = $postData['favourite_wear'];

                        

                        $referral_code = $this->input->post('referral_code');

                        if($referral_code){

                            $data['referral_code'] = $referral_code;

                            $referralRow = $this->common_model->get_all_details('referral',array('status'=>'1','referral_code'=>$referral_code))->row_array();

                            if ($referralRow) {

                                $data['referral_id'] = $referralRow['id'];

                            }

                        }

                        $data['registration_on'] = 'app';

	                    if($fname){



							$data['fname'] = $fname;



	                    }



	                    if($lname){



							$data['lname'] = $lname;



	                    }

                        $data['name'] = $fname.' '.$lname;

	                    if($email){



							$data['email'] = $email;



	                    }



	                    if($password){



							$data['password'] = md5($password);



	                    }



	                    if($gender){



							$data['gender'] = $gender;



	                    }



	                    if($mobile){



							$data['mobile'] = $mobile;



	                    }



	                     



	                    if($dob){



							$data['dob'] = date('Y-m-d',strtotime($dob));



	                    }



	                    if($address){



							$data['address'] = $address;



	                    }



	                    if($pin){



							$data['pin'] = $pin;



	                    }



	                    



	                    



	                     



	                    if($country){



							$data['country'] = $country;



		                    $countryRow = $this->db->get_where('countries',['id'=> $country ])->row();



		                    $data['country_name'] = $countryRow->name;



	                    }



	                    if($state){



							$data['state'] = $state;



		                    $statesRow = $this->db->get_where('states',['id'=> $state ])->row();



		                    $data['state_name'] = $statesRow->name;



	                    }



	                    if($city){



							$data['city'] = $city;



		                    $cityRow = $this->db->get_where('cities',['id'=> $city ])->row();



		                    $data['city_name'] = $cityRow->city;



						}







	                    if($experience){



							$data['experience'] = $experience;



		                }



	                    if($about){



							$data['about'] = $about;



		                }



	                    if($more_about){



							$data['more_about'] = $more_about;



		                }



	                    if($linkedin_link){



							$data['linkedin_link'] = $linkedin_link;



		                }



	                    if($behance_link){



							$data['behance_link'] = $behance_link;



		                }



	                    if($facebook_link){



							$data['facebook_link'] = $facebook_link;



		                }



	                    if($twitter_link){



							$data['twitter_link'] = $twitter_link;



		                }



	                    if($instagram_nlink){



							$data['instagram_nlink'] = $instagram_nlink;



		                }



	                    if($portfolio_rlink){



							$data['portfolio_rlink'] = $portfolio_rlink;



		                }



	                    if($expertise) { 



	                        //$data['expertise'] = $arrayVal = implode(',',$expertise); 



	                        $data['expertise'] = $arrayVal = $expertise; 



	                    }



	                    if($project_deliverd) { 



	                        $data['project_deliverd'] = $project_deliverd; 



	                    }



	                    if($favourite_wear) { 



	                        $data['favourite_wear'] = $favourite_wear; 



	                    }



	                    if(!empty($expertise)) { 



	                        $arrayVal = explode(',',$expertise); 



	                        //$arrayVal = $expertise; 



	                        



	                        $values = ""; 



	                        //$arrayVal = $expertise;        



	                        $expertises =  $this->db->get_where('area_expertise',['status'=>1])->result();



	                        foreach ($expertises as $expertise) { 



	                            if( in_array($expertise->id , $arrayVal)) {  $values .= ", $expertise->name"; }



	                        }



	                        $stylist = substr($values,1);    



	                    }



	                    if ($experience == 1) {



	                        $projectDeliverd = rand(10,20);



	                    }else if ($experience == 2) {



	                        $projectDeliverd = rand(20,40);



	                    }else if ($experience == 3) {



	                        $projectDeliverd = rand(40,50);



	                    }else if ($experience == 4) {



	                        $projectDeliverd = rand(50,70);



	                    }else if ($experience == 5) {



	                        $projectDeliverd = rand(50,200);



	                    }else if (!empty($experience)) {



	                        $projectDeliverd = rand(50,500);



	                    }else{



	                        $projectDeliverd = rand(1,5);



	                    }



	                    $data['project_deliverd'] = $projectDeliverd;



	                    



	                    



	                    $data['ip_address'] = $this->input->ip_address();



						$data['user_agent'] = $this->input->user_agent();



						$data['browser'] = $this->agent->browser();



						$data['browserVersion'] = $this->agent->version();



						$data['platform'] = $this->agent->platform();



						



						



						



            			



						$updateTrue 				= $this->common_model->simple_insert('vender',$data);



						$website_setting = getWebsiteDetail()->row_array();



                        $userRow = $this->common_model->get_all_details('vender',array('id'=>$updateTrue))->row_array();

                        $activate_string = base64_encode($updateTrue.'===='.$userRow['email'].'===='.$userRow['password']);

                        

                        



						if($updateTrue){



							 $subject = 'Welcome to Stylebuddy Fashion Platform';

                                

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



                             



                            $mailContent =  mailHtmlHeader_New($this->site);

                                $mailContent .= $option;

                                $mailContent .= '<div class="common_w" style="padding:20px 20px;text-align:center;background:#FFFA00;"><b>Welcome to STYLEBUDDY</b></div>';



                                $mailContent .= '<div style="clear: both;"></div>';

                                $mailContent.='<div class="common_w meddle_content" style="padding:30px 40px;background:#fff;">';

                                    $mailContent .= '<h4 style="font-weight: 700; font-size: 15px; line-height: 22px;">Hi '.ucwords($userRow['fname'].' '.$userRow['lname']).'</h4>';

                                   $mailContent .= '<p>Thank you for Signing up on the Stylebuddy platform! We\'re excited to have you on board and help you on your styling journey.</p>';

                                   $mailContent .= '<p style="margin-top:24px;">Your account will be activated only after verification and you can login after 24 hours.</p>';

                                     

                                $mailContent .= '</div>';

                            $mailContent .= mailHtmlFooter_New_1($this->site);

                         



                            $to      =  $userRow['email'];



		                    $from = FROM_EMAIL;



		                    $from_name = $this->site->site_name;



		                    $cc = CC_EMAIL;



		                    //$cc = 'mr.vijaybaghel@gmail.com,vijay@gleamingllp.com,joginder@gleamingllp.com';



		                    $reply = REPLY_EMAIL;

                            

                            /*$emailRow= $this->common_model->get_all_details('vender',array('email'=>$to,'email_notification_status'=>1))->row_array();

                            if($emailRow){

    		                    

                            }*/

                            $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $attach='');



							$response = array(



								'status' => $a['status'],



								'message' => 'Thank you for registering with StyleBuddy. Please verify your email address. A verification email has been to sent your email ID. Thank you.',





								//'response' => $userRow,



							);



						}else{



							$response = array(



								'status' => 'failed',



								'message' => 'Invalid credential',



							);



						}



					}



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function user_register_post() {



		try {



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$postData = $this->input->post();



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				



				$email		= $postData['email'];



				$password      = trim($postData['password']);



				$user_type	= 3;







				if(empty($password) || empty($email) || empty($user_type) ){



					$response = array(



						'status' => $a['status'],



						'message' => 'Please provide sufficient credentials',



					);



				}else{



					$table = 'vender';



					$email 		= $postData['email'];



		            $password 	= md5($postData['password']);



		            $wherCond= array('email' => $email);



					$row1 = $this->common_model->get_all_details($table,$wherCond)->row();



					if($row1){



						$response = array(



							'status' => 'failed',



							'message' => 'Email id already exist.Please user diffrent email ID',



						);



					}else{



						



						$insert_data['created_at']  = date("Y-m-d h:i:s");







						$fname = $postData['fname'];



						$lname = $postData['lname'];



						$email = $postData['email'];



						$password = $postData['password'];



						$favourite_wear = $postData['favourite_wear'];



						



						 





                        $insert_data['name'] = $fname.' '.$lname;

						$insert_data['email']		= trim($email);



						$insert_data['user_type']	= $user_type;



						$insert_data['status']	= '0';

						$insert_data['email_verification']	= '0';



						$insert_data['password']	= md5(trim($password));







						if(!empty($fname)){



							$insert_data['fname']	= $fname;



						}



						if(!empty($lname)){



							$insert_data['lname']	= $lname;



						}



						if(!empty($favourite_wear)){



							$insert_data['favourite_wear']	= $favourite_wear;



						}





						$check_content_sightengine = array();



            			$check_content_sightengine['fname'] = $postData['fname'];;



            			$check_content_sightengine['lname'] = $postData['lname'];;



            			$dd = check_content_sightengine($check_content_sightengine);



            			if ($dd) {



            				$msg = 'Your request could not be submitted because you enter inappropriate content.';



            				$response = array(



            		                'status' => 'fail',



            		                'message' =>  $msg,



            	                );



            				$this->set_response($response, REST_Controller::HTTP_OK);



            				return;



            



            			}



						



						$insert_data['updated_at']  = date("Y-m-d h:i:s");

                        $insert_data['registration_on'] = 'app';

						



						$insert_data['ip_address'] = $this->input->ip_address();



						$insert_data['user_agent'] = $this->input->user_agent();



						$insert_data['browser'] = $this->agent->browser();



						$insert_data['browserVersion']=$this->agent->version();



						$insert_data['platform'] = $this->agent->platform();



						$referral_code = $this->input->post('referral_code');

                        if($referral_code){

                            $insert_data['referral_code'] = $referral_code;

                            

                            $referralRow = $this->common_model->get_all_details('referral',array('status'=>'1','referral_code'=>$referral_code))->row_array();

                            if ($referralRow) {

                                $insert_data['referral_id'] = $referralRow['id'];

                            }

                        }



						$updateTrue 				= $this->common_model->simple_insert($table,$insert_data);



						$website_setting = getWebsiteDetail()->row_array();





                        $userRow = $this->common_model->get_all_details('vender',array('id'=>$updateTrue))->row_array();

                        $activate_string = base64_encode($updateTrue.'===='.$userRow['email'].'===='.$userRow['password']);

                            

                            

                            

						if($updateTrue){



							$subject = 'Welcome to Stylebuddy Fashion Platform';

                                

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

                             

                            $mailContent =  mailHtmlHeader_New($this->site);

                                $mailContent .= $option;

                                $mailContent .= '<div class="common_w" style="padding:20px 20px;text-align:center;background:#FFFA00;"><b>Welcome to STYLEBUDDY</b></div>';



                                $mailContent .= '<div style="clear: both;"></div>';

                                $mailContent.='<div class="common_w meddle_content" style="padding:30px 40px;background:#fff;">';

                                    $mailContent .= '<h4 style="font-weight: 700; font-size: 15px; line-height: 22px;">Hi '.ucwords($userRow['fname'].' '.$userRow['lname']).'</h4>';

                                   $mailContent .= '<p>Thank you for Signing up on the Stylebuddy platform! We\'re excited to have you on board and help you on your styling journey</p>';

                                    $mailContent .= '<p><a href="'.base_url('login/activeaccount/'.$activate_string).'" class="bt_box" style="background: #FF00A8; border-radius: 6px; color: #FFF; text-decoration: none; padding: 10px 20px; font-size: 15px; font-weight: 700; font-style: normal; letter-spacing: 0.5px; margin-top:24px; display: inline-block;">Confirm your account</a></p>';

                                $mailContent .= '</div>';

                            $mailContent .= mailHtmlFooter_New_1($this->site);

                         



                            $email      =  $userRow['email'];

                            



		                    $to      =  $email;



		                    $from = FROM_EMAIL;



		                    $from_name = $this->site->site_name;



		                    $cc = CC_EMAIL;



		                    $reply = REPLY_EMAIL;

                            /*$emailRow= $this->common_model->get_all_details('vender',array('email'=>$to,'email_notification_status'=>1))->row_array();

                            if($emailRow){

    		                   

                            }*/

                            $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $attach='');



							$response = array(



								'status' => $a['status'],



								'message' => 'Thank you for registering with StyleBuddy. Please verify your email address. A verification email has been to sent your email ID. Thank you.',



								'response' => $userRow,



							);



						}else{



							$response = array(



								'status' => 'failed',



								'message' => 'Invalid credential',



							);



						}



					}



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function forgot_password_post() {



		try {



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$postData = $this->input->post();



			$a = $this->check_api_auth($auth);



			$website_setting = getWebsiteDetail()->row_array();



			$table = 'vender';



			if($a['status'] == 'success'){



				$email = $postData['email'];



				if(empty($email)){



					$response = array(



						'status' => 'failed',



						'message' => 'Please provide sufficient credentials',



					);



				}else{



					$uRow = $this->common_model->get_all_details($table,array('email'=>$email))->row();

					$userRow = $this->common_model->get_all_details($table,array('email'=>$email))->row_array();



					if($uRow){



						$message = '';



						$fullname = $uRow->fname;



						$toEmail = $uRow->email;



						$message .= '<p>Hello '.$fullname.',</p>';



						$rand = rand(100000,999999);



						



						$p['otp'] = $rand;



						$updateTrue = $this->common_model->commonUpdate($table,$p,array('email'=>$toEmail));



						



						$subject = $website_setting['site_name']." Password Recovery";



						



						 



						$uname = ucwords($userRow['fname'].' '.$userRow['lname']);



						$option  = '<style>';

                            $option  .= '.banner{background: #FFFA00; }

                                    .banner h1{padding:45px; font-weight: 700; font-size: 32px; line-height: 44px; text-transform: uppercase;}

                                    .banner img {width: 100%; height: 190px; object-fit: cover; }

                                    .meddle_content{padding:30px 40px; background:#fff;}

                                    .meddle_content h4{font-weight: 700; font-size: 15px; line-height: 22px;}   

                                    .meddle_content p{font-weight: 400; font-size: 14px; line-height: 19px; width: 82%; margin-bottom: 0px;}

                                    .bt_box { background: #FF00A8; border-radius: 6px; color: #FFF; text-decoration: none; padding: 10px 20px; font-size: 15px; font-weight: 700; font-style: normal; letter-spacing: 0.5px; margin-top:24px; display: inline-block;}

                                    .bt_box:hover{text-decoration:none; color:#fff; background:#000;}

                                    ';

                        $option  .= '</style>';

                        

		                $subject = 'Forgot Password';  



		                $mailContent =  mailHtmlHeader_New($this->site);

		                    $mailContent .= $option;

                            $mailContent .= '<div class="common_w" style="padding:20px 20px;text-align:center;background:#FFFA00;"><b>Re-Set your password</b></div>';

		                    $mailContent .= '<div style="clear: both;"></div>';

		                    $mailContent .= '<div class="common_w meddle_content" style="padding:30px 40px;background:#fff;">';

		                        $mailContent .= '<h4 style="font-weight: 700; font-size: 15px; line-height: 22px;">Hi '.ucwords($fullname).'</h4>';

		                        $mailContent .= '<p style="font-weight: 400; font-size: 14px; line-height: 19px; width: 82%; margin-bottom: 0px;">Looks like you have re-set your password. <br>Kindly use this OTP while changing the password :  '.$rand.'<br/></p>';

		                        

		                    $mailContent .= '</div>';

		                $mailContent .= mailHtmlFooter_New_1($this->site);



	                    $to      =  $email;



	                    $from = FROM_EMAIL;



	                    $from_name = $this->site->site_name;



	                    $cc = CC_EMAIL;



	                    $reply = REPLY_EMAIL;

                        /*$emailRow= $this->common_model->get_all_details('vender',array('email'=>$to,'email_notification_status'=>1))->row_array();

                        if($emailRow){

	                        

                        }*/

                        $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $attach='');



					 



						$message = 'Please Check Your Registered Mail to Reset The Password';



						$response = array(



							'status' => $a['status'],



							'message' => $message,



							'response'=> $rand







						);







					}else{



						$message =  'Oops! Please enter the correct registered e-mail ID.';



						$response = array(



							'status' => 'fail',



							'message' => $message,



						);



					}



					



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function reset_password_post() {



		try {



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$postData = $this->input->post();



			$a = $this->check_api_auth($auth);



			$table = 'vender';



			if($a['status'] == 'success'){



				$email = $postData['email'];



				$password = $postData['new_password'];



				$otp = $postData['otp'];



				if(empty($otp) || empty($password) || empty($email)){



					$response = array(



						'status' => $a['status'],



						'message' => 'Please provide sufficient credentials',



					);



				}else{



					$userRow 	=  $this->common_model->get_all_details($table,array('otp'=>$otp,'email'=>$email))->row_array();



					if($userRow){



						$p['password'] = md5($password);



						$p['otp'] = '';



						$updateTrue = $this->common_model->commonUpdate($table,$p,array('otp'=>$otp));



						$message = 'Password has been changed succesfully';



						$response = array(



							'status' => $a['status'],



							'message' => $message,



							'response'=> $userRow



						);



					}else{



						$message =  'Wrong Otp';



						$response = array(



							'status' => $a['status'],



							'message' => $message,



						);



					}



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function change_password_post() {



		try {



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$postData = $this->input->post();



			$a = $this->check_api_auth($auth);



			$table = 'vender';











			if($a['status'] == 'success'){



				$email = !empty($postData['email']) ? $postData['email'] : '';



				$current_password = $postData['current_password'];



				$password = $postData['new_password'];



				 



				if(empty($password) || empty($current_password) || empty($email)){



					$response = array(



						'status' => $a['status'],



						'message' => 'Please provide sufficient credentials',



					);



				}else{



					$c = array();



					$c['email'] = $email;



					$c['password'] = md5($current_password);



					$userRow =  $this->common_model->get_all_details($table,$c)->row_array();



					if($userRow){



						$p['password'] = md5($password);



						$updateTrue = $this->common_model->commonUpdate($table,$p,$c);



						$message = 'Password has been changed succesfully';



						$response = array(



							'status' => $a['status'],



							'message' => $message,



							'response'=> $userRow



						);



					}else{



						$message =  'Incorrect current password.';



						$response = array(



							'status' => $a['status'],



							'message' => $message,



						);



					}



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function expertise_service_post() {







		try {







			$postData = $this->input->post();







			 







			$auth['email'] = $_SERVER['PHP_AUTH_USER'];







			$auth['password'] = $_SERVER['PHP_AUTH_PW'];







			$auth['access_token'] = $postData['access_token'];







			$a = $this->check_api_auth($auth);







			if($a['status'] == 'success'){







				$list['expertise'] =  $this->common_model->get_all_details('our_services',array('status'=>1))->result_array();







		        $response = array(







					'status' => $a['status'],







					'message' => $a['message'],



					'image_path' => 'assets/images/services/',







					'response' => $list,







				);







				$this->set_response($response, REST_Controller::HTTP_OK);







			}







			else{







				$response = array(







					'status' => $a['status'],







					'message' => $a['message'],







				);







				$this->set_response($response, REST_Controller::HTTP_OK);







			}







			







		} catch (Exception $exc) {







			$response = array(







				'status' => false,







				'message' => 'Something went wrong',







			);







			$this->set_response($response, REST_Controller::HTTP_OK);







		}



	}



	public function expertise_service_detail_post() {







		try {







			$postData = $this->input->post();







			 







			$auth['email'] = $_SERVER['PHP_AUTH_USER'];







			$auth['password'] = $_SERVER['PHP_AUTH_PW'];







			$auth['access_token'] = $postData['access_token'];







			$a = $this->check_api_auth($auth);







			if($a['status'] == 'success'){



				if ($postData['service_id']) {



					$service_id = $postData['service_id'];



					$expertise =  $this->common_model->get_all_details('our_services',array('status'=>1,'id'=>$service_id))->row_array();



					



					$where = "WHERE user_type = 2 and image != '' ORDER BY feedback_rating DESC  limit 0,30";



			        $query = $this->common_model->get_all_details_query("vender",$where);



			        $rows = $query->result();



			        foreach($rows as $k=>$v){



			            $where = "WHERE status = 1 AND user_id = '".$v->id."' ORDER BY id DESC";



			            $query = $this->common_model->get_all_details_query("review",$where);



			            $row = $query->row();



			            $rows[$k]->review = $row;



			        }



			        $section5  =  $this->common_model->get_all_details_query('cms_pages','where slug="our-customers-love-stylebuddy"')->row(); 



					$response = array(



						'status' => $a['status'],



						'message' => $a['message'],



						'image_path' => 'assets/images/services/',



						'response' => $expertise,



						'featured_stylist_row' => $section5,



						'featured_stylist' => $rows,



					);



				}else{



					 



					$response = array(



						'status' => 'fail',



						'message' => $a['message'],



						'image_path' => 'assets/images/services/',



						'response' => 'Please provice service ID',



					);



				}



				







		        







				$this->set_response($response, REST_Controller::HTTP_OK);







			}







			else{







				$response = array(







					'status' => $a['status'],







					'message' => $a['message'],







				);







				$this->set_response($response, REST_Controller::HTTP_OK);







			}







			







		} catch (Exception $exc) {







			$response = array(







				'status' => false,







				'message' => 'Something went wrong',







			);







			$this->set_response($response, REST_Controller::HTTP_OK);







		}



	}



	public function expertise_post() {



		try {



			$postData = $this->input->post();



			 



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$auth['access_token'] = $postData['access_token'];



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				$list['expertise'] =  $this->common_model->get_all_details('area_expertise_looking',array('status'=>1))->result_array();



		        $response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'response' => $list,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		}



	}



	public function expertise_list_post() {



		try {



			$postData = $this->input->post();



			 



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$auth['access_token'] = $postData['access_token'];



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){







				$list['expertise'] =  $this->common_model->get_all_details('area_expertise_looking',array('status'=>1))->result_array();



				



				if ($postData['expertise_slug']) {



					$segment2 = $postData['expertise_slug'];



					$this->db->where('status',1);



			        $this->db->where('slug',$segment2);



			        $expertises = $this->db->get('area_expertise_looking')->row(); 



			        $data['expertises'] = $expertises; 



			         







			        



			        $where = " where status = 1";



			        $expertisesArray = explode(',', $expertises->expertise);



			        if ($expertisesArray) {



			            $ss = '';



			            $i = 0;



			            foreach ($expertisesArray as $key => $value) {



			                if ($i>0) {



			                    $ss .= " OR ";



			                }



			                $ss .= " FIND_IN_SET('". $value ."',expertise)";



			                $i++;



			            }



			            $where .= "  AND (" .$ss. ")";



			        }



			        



			        $where .= "  order by experience desc";



			        $query = $this->db->query("select * from vender".$where);



			        $rows = $query->result();



			        foreach($rows as $k=>$v){



			            $review = $this->db->query('SELECT AVG(rating) as rating, count(rating) as feedbackCount from review'." WHERE status = 1 and  user_id = ".$v->id)->row();



			            $rows[$k]->feedbackRating = ($review->rating)?(string)round($review->rating):'0';



			            $rows[$k]->feedbackCount = $review->feedbackCount;



			            $rows[$k]->review = $review;



			            $ideas = $this->db->query('SELECT count(id) as count from ideas'." WHERE status = 1 and  vender_id = ".$v->id)->row();



			            $rows[$k]->total_portfolio = $ideas->count;



			        }



			        $data['venders'] = $rows;



			    }else{



			    	$data['venders'] = array();



			    }



		        $response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'response' => $data,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		}



	}



	public function stylist_detail_post() {



		try {



			$postData = $this->input->post();



			 



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$auth['access_token'] = $postData['access_token'];



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){







				$list['expertise'] =  $this->common_model->get_all_details('area_expertise_looking',array('status'=>1))->result_array();



				



				if ($postData['expertise_slug']) {



					$segment2 = $postData['expertise_slug'];



					$this->db->where('status',1);



			        $this->db->where('slug',$segment2);



			        $expertises = $this->db->get('area_expertise_looking')->row(); 



			        $data['expertises'] = $expertises; 



			         







			        



			        $where = " where status = 1 AND user_type = 2 ";



			        $expertisesArray = explode(',', $expertises->expertise);



			        if ($expertisesArray) {



			            $ss = '';



			            $i = 0;



			            foreach ($expertisesArray as $key => $value) {



			                if ($i>0) {



			                    $ss .= " OR ";



			                }



			                $ss .= " FIND_IN_SET('". $value ."',expertise)";



			                $i++;



			            }



			            $where .= "  AND (" .$ss. ")";



			        }



			        



			        $where .= "  order by experience desc";



			        $query = $this->db->query("select * from vender".$where);



			        $rows = $query->result();



			        foreach($rows as $k=>$v){



			            $review = $this->db->query('SELECT AVG(rating) as rating, count(rating) as feedbackCount from review'." WHERE status = 1 and  user_id = ".$v->id)->row();



			            $rows[$k]->feedbackRating = ($review->rating)?(string)round($review->rating):'0';



			            $rows[$k]->feedbackCount = $review->feedbackCount;



			            $rows[$k]->review = $review;



			            $ideas = $this->db->query('SELECT count(id) as count from ideas'." WHERE status = 1 and  vender_id = ".$v->id)->row();



			            $rows[$k]->total_portfolio = $ideas->count;



			        }



			        $data['venders'] = $rows;



			    }else{



			    	$data['venders'] = array();



			    }



		        $response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'response' => $data,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		}



	}



	public function myaccountupdate_post() {



		try {



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$postData = $this->input->post();



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				$user_id = $postData['user_id'];



				$currency = $postData['currency'];



				$currency_code = $postData['currency_code'];



				 



				 



				if(empty($user_id)){



					$response = array(



						'status' => $a['status'],



						'message' => 'Please provide sufficient credentials',



					);



				}else{

					$c_c_s = array();

					$this->uploadPath = 'assets/images/vandor/';

					$image = $this->uploadSingleImage('image',$this->uploadPath);

                    if(!empty($image)){



                        $data['image'] = $image;

                        $c_c_s['image'] = base_url($this->uploadPath.$image);

                    }

                    $dd = check_image_sightengine($c_c_s);

	                if ($dd) {

	                    $msg = 'Your request could not be submitted because you enter inappropriate image.';

	    				$response = array(

			                'status' => 'fail',

			                'message' =>  $msg,

		                );

	    				$this->set_response($response, REST_Controller::HTTP_OK);

	    				return;

	                }

                    $image = $this->uploadSingleImage('portfolio_pdf',$this->uploadPath);



                    if(!empty($image)){



                        $data['portfolio_pdf'] = $image;



                    }



                    $fname = $postData['fname'];



                    $email = $postData['email'];



                    $lname = $postData['lname'];



                    $password = $postData['password'];



                    $gender = $postData['gender'];



                    $mobile = $postData['mobile'];



                    $dob = $postData['dob'];



                    $address = $postData['address'];



                    $pin = $postData['pin'];







                    $country = $postData['country'];



                    $state = $postData['state'];



                    $city = $postData['city'];







                    $experience = $postData['experience'];



                    $about = $postData['about'];



                    $more_about = $postData['more_about'];



                    $linkedin_link = $postData['linkedin_link'];



                    $behance_link = $postData['behance_link'];



                    $facebook_link = $postData['facebook_link'];



                    $twitter_link = $postData['twitter_link'];



                    $instagram_nlink = $postData['instagram_nlink'];



                    $portfolio_rlink = $postData['portfolio_rlink'];



                    $expertise = $postData['expertise'];



                    $project_deliverd = $postData['project_deliverd'];



                    $favourite_wear = $postData['favourite_wear'];







                    if($fname){



						$data['fname'] = $fname;



                    }



                    if($lname){



						$data['lname'] = $lname;



                    }

                    $data['name'] = $fname.' '.$lname;

                    if($email){



						$data['email'] = $email;



                    }



                    if($password){



						$data['password'] = md5($password);



                    }



                    if($gender){



						$data['gender'] = $gender;



                    }



                    if($mobile){



						$data['mobile'] = $mobile;



                    }



                    if($dob){



						$data['dob'] = date('Y-m-d',strtotime($dob));



                    }



                    if($address){



						$data['address'] = $address;



                    }



                    if($pin){



						$data['pin'] = $pin;



                    }



                    



                     



                    



                    if($country){



						$data['country'] = $country;



	                    $countryRow = $this->db->get_where('countries',['id'=> $country ])->row();



	                    $data['country_name'] = $countryRow->name;



                    }



                    if($state){



						$data['state'] = $state;



	                    $statesRow = $this->db->get_where('states',['id'=> $state ])->row();



	                    $data['state_name'] = $statesRow->name;



                    }



                    if($city){



						$data['city'] = $city;



	                    $cityRow = $this->db->get_where('cities',['id'=> $city ])->row();



	                    $data['city_name'] = $cityRow->city;



					}



					



                    if($experience){



						$data['experience'] = $experience;



	                }



                    if($about){



						$data['about'] = $about;



	                }



                    if($more_about){



						$data['more_about'] = $more_about;



	                }



                    if($linkedin_link){



						$data['linkedin_link'] = $linkedin_link;



	                }



                    if($behance_link){



						$data['behance_link'] = $behance_link;



	                }



                    if($facebook_link){



						$data['facebook_link'] = $facebook_link;



	                }



                    if($twitter_link){



						$data['twitter_link'] = $twitter_link;



	                }



                    if($instagram_nlink){



						$data['instagram_nlink'] = $instagram_nlink;



	                }



                    if($portfolio_rlink){



						$data['portfolio_rlink'] = $portfolio_rlink;



	                }



                    if($expertise) { 



                        //$data['expertise'] = $arrayVal = implode(',',$expertise); 



                        $data['expertise'] = $arrayVal = $expertise; 



                    }



                    if($project_deliverd) { 



                        $data['project_deliverd'] = $project_deliverd; 



                    } 



                    if($favourite_wear) { 



                        $data['favourite_wear'] = $favourite_wear; 



                    }



					



					$check_content_sightengine = array();



        			$check_content_sightengine['about'] = $postData['about'];;



        			$check_content_sightengine['more_about'] = $postData['more_about'];;



        			$check_content_sightengine['experience'] = $postData['experience'];;



        			$check_content_sightengine['address'] = $postData['address'];;



        			$check_content_sightengine['fname'] = $postData['fname'];;



        			$check_content_sightengine['lname'] = $postData['lname'];;



        			$dd = check_content_sightengine($check_content_sightengine);



        			if ($dd) {



        				$msg = 'Your request could not be submitted because you enter inappropriate content.';



        				$response = array(



        		                'status' => 'fail',



        		                'message' =>  $msg,



        	                );



        				$this->set_response($response, REST_Controller::HTTP_OK);



        				return;



        



        			}



					$data['updated_at']  = date("Y-m-d h:i:s");







					$row = $this->common_model->get_all_details('vender',array('id'=>$user_id))->row_array();







					if($row){



						$updateTrue = $this->common_model->commonUpdate('vender',$data,array('id'=>$user_id));



						//echo $this->db->last_query();



						$row = $this->common_model->get_all_details('vender',array('id'=>$user_id))->row_array();



						$response = array(



							'status' => $a['status'],



							'message' => 'Profiles changes saved successfully.',



							'response' => $row,



						);



					}else{



						$response = array(



							'status' => 'failed',



							'message' => 'User Not exist.',



						);



					}



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function myprofilephoto_post() {



		try {



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$postData = $this->input->post();



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){

				$c_c_s = array();

				$user_id = $postData['user_id'];

				$insert_data 				= array();

				$this->uploadPath = 'assets/images/vandor/';

				$image = $this->uploadSingleImage('profilephoto',$this->uploadPath);

				if(!empty($image)){

					$insert_data['profilephoto'] = trim($image,',');

					$c_c_s['image'] = base_url($this->uploadPath.$image);

				}

				$dd = check_image_sightengine($c_c_s);

                if ($dd) {

                    $msg = 'Your request could not be submitted because you enter inappropriate image.';

    				$response = array(

		                'status' => 'fail',

		                'message' =>  $msg,

	                );

    				$this->set_response($response, REST_Controller::HTTP_OK);

    				return;

                }

				$insert_data['updated_at']  = date("Y-m-d h:i:s");

				$row = $this->common_model->get_all_details('users',array('id'=>$user_id))->row_array();



				if($row){



					$updateTrue = $this->common_model->commonUpdate('users',$insert_data,array('id'=>$user_id));



					$row = $this->common_model->get_all_details('users',array('id'=>$user_id))->row_array();



					$response = array(



						'status' => $a['status'],



						'message' => 'Profile picture update successfully',



						'response' => $row,



					);



				}else{



					$response = array(



						'status' => 'failed',



						'message' => 'User Not exist.',



					);



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	



	public function myprofile_post() {



		try {



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$postData = $this->input->post();



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				$user_id = $postData['user_id'];

                

                $followNum = 0;

				$following_statusNum = 0;

				$variable = $this->common_model->get_all_details('posts_follow',array('follow_status'=>1,'post_user_id'=>$user_id))->result();

			    foreach ($variable as $key => $value) {

                    $r = $this->common_model->get_all_details('vender',array('id'=>$value->post_user_id))->row();

                    //echo $this->db->last_query();

                    if($r){

                        $followNum = $followNum + 1;   

                    }

			    }

			    $variable = $this->common_model->get_all_details('posts_follow',array('following_status'=>1,'user_id'=>$user_id))->result();

			    foreach ($variable as $key => $value) {

                    $r = $this->common_model->get_all_details('vender',array('id'=>$value->post_user_id))->row();

                    //echo $this->db->last_query();

                    if($r){

                        $following_statusNum = $following_statusNum + 1;   

                    }

			    }

				 

				$inset['count_follow'] =$followNum; 

				$inset['count_following'] =$following_statusNum; 

				$this->common_model->commonUpdate('vender',$inset,array('id'=>$user_id));

				//echo $this->db->last_query();

				

                

				$row = $this->common_model->get_all_details('vender',array('id'=>$user_id))->row();

				$expertise_array = explode(',',$row->expertise);

				

				$expertise =  $this->common_model->get_all_details('area_expertise',array('status'=>1))->result_array();

				$aa = array();

				foreach ($expertise as $key => $value) {

		        	$a1 = array();

		        	$a1_id = trim($value['id']);

		        	$a1['id'] =$a1_id;

		        	$status = "0";

		        	if(in_array($a1_id,$expertise_array)){

		        	    $status = "1";

		        	}

		            $a1['status'] = $status;

		        	array_push($aa,$a1);

				}

                $row->expertise_array = $aa;

				



				$review = $this->db->query('SELECT AVG(rating) as rating, count(rating) as feedbackCount from review'." WHERE status = 1 and  user_id = ".$row->id)->row();



	            $row->feedbackRating = ($review->rating)?(string)round($review->rating):'0';



	            $row->feedbackCount = $review->feedbackCount;



	            $row->review = $review;



	            /*$ideas = $this->db->query('SELECT count(id) as count from ideas'." WHERE status = 1 and  vender_id = ".$v->id)->row();



	            $row->total_portfolio = $ideas->count;*/



	            $postsData = array();



	            $tbl_name = 'posts';



				$str = " where post_admin_id = '".$user_id."'  and media != ''  ORDER by id DESC";



				$rows =  $this->common_model->get_all_details_query($tbl_name,$str);



				$list = $rows->result_array();



				foreach ($list as $key => $value) {



					$row1 =  $this->common_model->get_all_details_query('vender','WHERE id = '.$value['post_admin_id'])->row_array();



					$list[$key]['userRow'] = $row1;







					$row1 = $this->common_model->get_all_details('vender',array('id'=>$value['post_admin_id']))->row();



					$list[$key]['full_name'] = $row1->fname.' '.$row1->lname;



					



					$ab = array();



					$abc = explode(',', $value['media']);



					foreach ($abc as $k => $va) {



						$b = array();



						$b['image'] = $va;



						array_push($ab, $b);



					}



					$list[$key]['media'] = $ab;



				}



				$postsData['posts_media'] = $list;



				$str = " where post_admin_id = '".$user_id."' and (media = ''  OR media is NULL) ORDER by id DESC";



				$rows =  $this->common_model->get_all_details_query($tbl_name,$str);



				$list = $rows->result_array();



				foreach ($list as $key => $value) {



					$row1 =  $this->common_model->get_all_details_query('vender','WHERE id = '.$value['post_admin_id'])->row_array();



					$list[$key]['userRow'] = $row1;







					$row1 = $this->common_model->get_all_details('vender',array('id'=>$value['post_admin_id']))->row();



					$list[$key]['full_name'] = $row1->fname.' '.$row1->lname;



					



					$ab = array();



					$abc = explode(',', $value['media']);



					foreach ($abc as $k => $va) {



						$b = array();



						$b['image'] = $va;



						array_push($ab, $b);



					}



					$list[$key]['media'] = $ab;



				}



				$postsData['posts_text'] = $list;



				 











				if($row){



					$response = array(



						'status' => $a['status'],



						'response' => $row,



						'posts' => $postsData,



					);



				}else{



					$response = array(



						'status' => 'failed',



						'message' => 'User Not exist.',



					);



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	







	public function top_slider_post() {



		try {



			$postData = $this->input->post();



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$auth['access_token'] = $postData['access_token'];



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				$tbl_name = 'menu';



				$tbl_name1 = 'menu_detail';



				$where = ' where '.$tbl_name.'.slug = "slider-banner-menu"  AND '.$tbl_name1.'.language = "'.$currLanguage.'"';



				$menuRow   =  $this->common_model->get_all_details_query($tbl_name,' INNER JOIN '.$tbl_name1.' on '.$tbl_name.'.id = '.$tbl_name1.'.main_id '.$where)->row_array();



				$main_menu =  json_decode($menuRow['menu_item']);



				$main_menuArray = array();



				foreach($main_menu as $key=>$value){



					if($value->children){



					}else{



						$_menuArray = array();



						$slug = $value->slug;



						



						if ($value->types == 'page') {



							$tbl_name = 'cms_pages';



							$tbl_name1 = 'cms_pages_detail';



						    $row  =  $this->common_model->get_all_details_query($tbl_name,' LEFT JOIN '.$tbl_name1.' on '.$tbl_name.'.id = '.$tbl_name1.'.main_id WHERE '.$tbl_name.'.id = "'.$value->id.'"')->row();



					        $_menuArray['id'] = $row->id;



					        $_menuArray['title'] = $row->title;



							$_menuArray['sub_title'] = $row->subtitle;



							$_menuArray['image'] = $row->top_image;



							$_menuArray['description'] = $row->description;



							$_menuArray['types'] = $value->types;



						}else if($value->types == 'user_type'){



							$row = $this->common_model->get_all_details('user_role',array('status'=>1,'id'=>$value->id))->row();



		 			        $_menuArray['id'] = $row->id;



					        $_menuArray['title'] = $row->title;



							$_menuArray['sub_title'] = $row->sub_title;



							$_menuArray['image'] = $row->top_image;



							$_menuArray['description'] = $row->description;



							$_menuArray['types'] = $value->types;



						}else{



							$tbl_name = 'category';



							$tbl_name1 = 'category_detail';



						    $row  =  $this->common_model->get_all_details_query($tbl_name,' LEFT JOIN '.$tbl_name1.' on '.$tbl_name.'.id = '.$tbl_name1.'.main_id WHERE '.$tbl_name.'.id = "'.$value->id.'"')->row();



					        $_menuArray['id'] = $row->id;



					        $_menuArray['title'] = $row->title;



							$_menuArray['sub_title'] = $row->subtitle;



							$_menuArray['image'] = $row->top_image;



							$_menuArray['description'] = $row->description;



							$_menuArray['types'] = $value->types;



						}



						array_push($main_menuArray,$_menuArray);



					}                   



				}



				 



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'response' => $main_menuArray,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}







	public function countries_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$auth['access_token'] = $postData['access_token'];



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				$list =  $this->common_model->get_all_details('countries',array('is_active'=>1))->result_array();



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'response' => $list,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		}



	}



	 



	public function feedback_post() {







		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$auth['access_token'] = $postData['access_token'];



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){







				if (!empty($postData['class_id'])  && !empty($postData['user_id'])) {



					$postData = $this->input->post();



					



					$user_id =  $postData['user_id'];



					$id =  $postData['class_id'];



					$comment =  $postData['comment'];



					$rating =  $postData['rating'];



					



					$insert['from_id'] = $user_id;



					$insert['to_id'] = $id;



					$insert['comment'] = $comment;



					$insert['rating'] = $rating;



					$insert['language'] = $this->currLanguage;



					$insert['created_at'] = date('Y-m-d h:i:s');



					



					$insert['ip_address'] = $this->input->ip_address();



					$insert['user_agent'] = $this->input->user_agent();



					$insert['browser'] = $this->agent->browser();



					$insert['browserVersion']=$this->agent->version();



					$insert['platform'] = $this->agent->platform();



					



					$check_content_sightengine = array();



        			$check_content_sightengine['comment'] = $postData['comment'];;



        			$dd = check_content_sightengine($check_content_sightengine);



        			if ($dd) {



        				$msg = 'Your request could not be submitted because you enter inappropriate content.';



        				$response = array(



        		                'status' => 'fail',



        		                'message' =>  $msg,



        	                );



        				$this->set_response($response, REST_Controller::HTTP_OK);



        				return;



        



        			}



				    $this->common_model->simple_insert('review',$insert);







					$response = array(



						'status' => $a['status'],



						'message' => 'Thank You For given feedback.',



					);



					 



					$this->set_response($response, REST_Controller::HTTP_OK);



					return;



				}else{



					$response = array(



						'status' => false,



						'message' => 'Please provide Course ID & user ID',



					);



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		}



	}



	



	public function testimonial_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$a = $this->check_api_auth($postData);



			if($a['status'] == 'success'){



				$tbl_name = 'cms_pages';



    			$tbl_name1 = 'cms_pages_detail';



				$post_list 	=  $this->common_model->get_all_details_query($tbl_name,' INNER JOIN '.$tbl_name1.' on '.$tbl_name.'.id = '.$tbl_name1.'.main_id WHERE '.$tbl_name.'.post_type = "testimonial" AND '.$tbl_name1.'.language = "'.$currLanguage.'" order by '.$tbl_name.'.id DESC ')->result();







				$response = array(



					//'img_base_url' => $this->img_base_url,



					'status' => $a['status'],



					'message' => $a['message'],



					'response' => $post_list,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	



	public function blogs_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$a = $this->check_api_auth($postData);



			if($a['status'] == 'success'){



				



				$tbl_name = 'category';



				$tbl_name1 = 'category_detail';



				$list 	=  $this->common_model->get_all_details_query($tbl_name,' INNER JOIN '.$tbl_name1.' on '.$tbl_name.'.id = '.$tbl_name1.'.main_id WHERE '.$tbl_name1.'.language = "'.$currLanguage.'" AND '.$tbl_name.'.cat_type = "blog_category" AND '.$tbl_name.'.status = "1"')->result();



				foreach ($list as $key => $value) {



					



					$tbl_name = 'cms_pages';



			    	$tbl_name1 = 'cms_pages_detail';



			    	$str = ' AND '.$tbl_name.'.category = '.$value->id;



					$post_list = $this->common_model->get_all_details_query($tbl_name,' INNER JOIN '.$tbl_name1.' on '.$tbl_name.'.id = '.$tbl_name1.'.main_id WHERE '.$tbl_name1.'.language = "'.$currLanguage.'" AND '.$tbl_name.'.status = "1"'.$str.' order by '.$tbl_name.'.id DESC')->result();



					$list[$key]->child = $post_list;



				}







				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'response' => $list,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	

    public function cmspage_after_login_content_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$a = $this->check_api_auth($postData);



			if($a['status'] == 'success'){



				$tbl_name = 'cms_pages';

                if($postData['user_type'] == 2){

                    $segment = 'stylist-dashboard';

                }else{

                    $segment = 'user-dashboard';

                    

                }

				

				 



			 



				$str = " WHERE ".$tbl_name.".slug = '".$segment."'";



				$rows =  $this->common_model->get_all_details_query($tbl_name,$str);



				$row = $rows->row_array();



			 

				



				



				   



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'response' => $row,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function cmspage_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$a = $this->check_api_auth($postData);



			if($a['status'] == 'success'){



				$tbl_name = 'cms_pages';

                

                $segmentArray = array('about-us-page-mobile-app','privacy-policy','terms-of-use','service-agreement','refund-cancellation-policy','cancellation-policy','service-provider-agreement');

                

				//$segmentArray = array('about-us-page-mobile-app','privacy-policy-app','terms-of-use-app','service-agreement-app','refund-cancellation-policy-app','cancellation-policy-app','service-provider-agreement-app');



				foreach ($segmentArray as $key => $value) {



					$segment = $value;



					$str = " WHERE ".$tbl_name.".slug = '".$segment."'";



					$rows =  $this->common_model->get_all_details_query($tbl_name,$str);



					$row = $rows->row_array();



					$this->data[$value] = $row; 



					



				}



				



				



				   



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'response' => $this->data,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function home_website_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$a = $this->check_api_auth($postData);



			if($a['status'] == 'success'){



				$tbl_name = 'area_expertise_looking';



				$str = " ";



				$rows =  $this->common_model->get_all_details_query($tbl_name,$str);



				$rows = $rows->result_array();



				$this->data['expertises'] = $rows; 



				$query = $this->db->query("select * from vender  WHERE user_type = 2 ORDER BY count_view DESC limit 0,4");







		        $rows = $query->result();



		        foreach($rows as $k=>$v){



		            $review = $this->db->query('SELECT AVG(rating) as rating, count(rating) as feedbackCount from review'." WHERE status = 1 and  user_id = ".$v->id)->row();



		            $rows[$k]->feedbackRating = ($review->rating)?(string)round($review->rating):'0';



		            $rows[$k]->feedbackCount = $review->feedbackCount;



		            $rows[$k]->review = $review;



		            $ideas = $this->db->query('SELECT count(id) as count from ideas'." WHERE status = 1 and  vender_id = ".$v->id)->row();



		            $rows[$k]->total_portfolio = $ideas->count;



		            $rows[$k]->area_expertiseRow = array();



		            if ($v->expertise) {



		                $area_expertise = explode(',', $v->expertise);



		                $ideas = $this->db->query('SELECT * from area_expertise'." WHERE status = 1 and  id = ".$area_expertise[0])->row();



		                $rows[$k]->area_expertiseRow = $ideas;



		            }



		        }



		        $this->data['tranding_vendors'] = $rows; 



				$blogs = $this->common_model->get_all_details_query('blog',' where status = 1 order BY ID desc  limit 0,3')->result();



		        foreach($blogs as $k=>$v){



		            if($v->vender_id){



		                $d = $this->common_model->get_all_details_query('vender','WHERE id='.$v->vender_id.'')->row_array();



		                $blogs[$k]->fname = $d['fname'];



		                $blogs[$k]->lname = $d['lname'];



		            }else{



		                $blogs[$k]->fname = 'ADIMN';



		                $blogs[$k]->lname = '';



		            }



		        }



		        $this->data['style_stories'] = $blogs;



				



				   



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'response' => $this->data,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function type_of_post_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$a = $this->check_api_auth($postData);



			if($a['status'] == 'success'){



				$tbl_name = 'posts_type';



				$str = " ";



				$rows =  $this->common_model->get_all_details_query($tbl_name,$str);



				$rows = $rows->result_array();



				 



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'response' => $rows,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function post_category_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$a = $this->check_api_auth($postData);



			if($a['status'] == 'success'){



				$tbl_name = 'posts_category';



				$str = " ";



				$rows =  $this->common_model->get_all_details_query($tbl_name,$str);



				$rows = $rows->result_array();



				 



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'Image_path' => 'assets/images/posts_category/',



					'response' => $rows,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	



	public function home_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$a = $this->check_api_auth($postData);



			if($a['status'] == 'success'){



				$tbl_name = 'posts';



				$str = " ORDER by id DESC";



				$rows =  $this->common_model->get_all_details_query($tbl_name,$str);



				$list = $rows->result_array();



				foreach ($list as $key => $value) {



					$row =  $this->common_model->get_all_details_query('vender','WHERE id = '.$value['post_admin_id'])->row_array();



					$list[$key]['userRow'] = $row;



					$row = $this->common_model->get_all_details('vender',array('id'=>$value['post_admin_id']))->row();



					$list[$key]['full_name'] = $row->fname.' '.$row->lname;



					



					$follow_status = '0';



					$like_status = '0';



					$rating_status = '0';



					$block_status = '0';



					



					if ($postData['user_id']) {



						/*$row11 = $this->common_model->get_all_details('users_block',array('to_user_id'=>$value['user_id'],'user_id'=>$postData['user_id']))->row();



						if ($row11) {



							$block_status = $row11->block_status;



						}



						*/



						$row11 = $this->common_model->get_all_details('posts_follow',array('post_user_id'=>$value['post_admin_id'],'user_id'=>$postData['user_id']))->row();



						if ($row11) {



							$follow_status = $row11->follow_status;



						}



						$row11 = $this->common_model->get_all_details('posts_like',array('post_id'=>$value['id'],'user_id'=>$postData['user_id']))->row();



						//echo $this->db->last_query();



						if ($row11) {



							$like_status = $row11->like_status;



						}



						$row11 = $this->common_model->get_all_details('posts_rating',array('post_id'=>$value['id'],'user_id'=>$postData['user_id']))->row();



						if ($row11) {



							$rating_status = 1;



						}



					}



					$list[$key]['follow_status'] = $follow_status;



					$list[$key]['like_status'] = $like_status;



					$list[$key]['rating_status'] = $rating_status;



					$list[$key]['block_status'] = $block_status;



					$list[$key]['media'] = explode(',', $value['media']);



				}



				$this->data['posts'] = $list; 



				 



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'response' => $this->data,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	



	public function shopCategoryHome_post() {



		try {



			$postData = $this->input->post();



			 



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$auth['access_token'] = $postData['access_token'];



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				$category =  $this->common_model->get_all_details('category',array('status'=>1,'parent_id'=>0));



				$nums = $category->num_rows();



				$categoryResult = $category->result_array();







				/*$category =  $this->common_model->get_all_details('category',array('status'=>1,'parent_id'=>0))->result_array();



				$category =  $this->common_model->get_all_details('category',array('status'=>1,'parent_id'=>0))->result_array();



				$i=0;



                $str = '';



                foreach ($category as $key => $value) {



                    if ($i>0) {



                        $str .= ' OR '; 



                    }



                    $str .= ' parent_id = '.$value['id'];



                    $i++;



                }



                $query .= " AND (". $str.") ";











				 



				$categoryArray = $this->common_model->get_all_details_query('category',' WHERE status=1 '.$query);



				$nums = $categoryArray->num_rows();



				$categoryResult = $categoryArray->result_array();



				 */



		        $response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'response' => $categoryResult,



					'nums' => $nums,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		}



	}



	public function userBlock_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$auth['access_token'] = $postData['access_token'];



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){







				$tbl_name = 'users_block';



				$tbl_name1 = 'vender';



				$postData = $this->input->post();



				if (!empty($postData['device_id']) && !empty($postData['user_id'])) {	



					$follow_status = 1;



					$user_id = $postData['user_id'];



					$post_user_id = $postData['post_user_id'];



					$ip_address = $postData['device_id'];



					$device_type = $postData['device_type'];







					$logsData['user_id'] = $user_id;



					$logsData['block_status'] = $follow_status;



					$logsData['ip_address'] = $ip_address;



					$logsData['user_agent'] = $device_type;



					$logsData['user_session_id'] = $this->session->session_id;



					$logsData['to_user_id'] = $post_user_id;







					$logsData['created_at']  = date("Y-m-d h:i:s");



					$logsData['updated_at']  = date("Y-m-d h:i:s");







					$row  = $this->common_model->get_all_details_query($tbl_name,' WHERE to_user_id = "'.$post_user_id.'" AND user_id = "'.$user_id.'"')->row_array();



					$ro  = $this->common_model->get_all_details_query($tbl_name1,' WHERE id = "'.$post_user_id.'"')->row_array();



					$follow_status = 1;	



					if($row){



						if ($row['block_status']) {



							$follow_status = 0;



						}else{



							$follow_status = 1;



						}



						$j['block_status']=$follow_status;



						$this->common_model->commonUpdate($tbl_name,$j,array('id'=>$row['id']));



					}else{



						$updateTrue= $this->common_model->simple_insert($tbl_name,$logsData); 



					}



					



					$activity_log = array();



					$content_id = $post_user_id;



					$table_name = $tbl_name;



					$to_id = $post_user_id;



					$tag = 'block';







					$userRow  = $this->common_model->get_all_details_query('vender',' WHERE id = "'.$to_id.'"')->row_array();



					$userName = $userRow['fname'].' '.$userRow['lname'];



					$userRow  = $this->common_model->get_all_details_query('vender',' WHERE id = "'.$user_id.'"')->row_array();



					$userNameTo = $userRow['fname'].' '.$userRow['lname'];







					



					$m = 'You have been unblocked '.ucwords(trim($userName,' '));



					$mTo = ucwords(trim($userNameTo,' ')).' unblock you';



					if ($follow_status) {



						$m = 'You have been blocked '.ucwords(trim($userName,' '));



						$mTo = ucwords(trim($userNameTo,' ')).' blocked you';



					}







					$activity_log['table_name'] = $table_name;



					$activity_log['from_id'] = $user_id;



					$activity_log['to_id'] = $to_id;



					$activity_log['tag'] = $tag;



					$activity_log['message'] = $m;



					$activity_log['message_to'] = $mTo;







					 



					



					$activity_logRow  = $this->common_model->get_all_details_query('activity_log',' WHERE tag = "'.$tag.'" AND from_id = "'.$user_id.'" AND to_id = "'.$to_id.'"')->row_array();



					/*if ($activity_logRow) {



						



					}else{*/



						$this->common_model->simple_insert('activity_log',$activity_log); 







						$toRow  = $this->common_model->get_all_details_query('vender',' WHERE id = "'.$to_id.'"')->row_array();



						$device_token = $toRow['device_id'];



						if ($device_token) {



							



							$token_log 	=  $this->common_model->get_all_details('token_log',array('user_id'=>$to_id))->result_array();

                            

                            $query = 'SELECT token_log.*,vender.notification_status FROM `token_log` INNER JOIN vender on vender.id = token_log.user_id WHERE token_log.user_id = "'.$to_id.'"';

                            $result = $this->db->query($query);

                            $token_log =  $result->result_array();

        

        

				    		$device_array= array();			



							$payloaArray = array();



							foreach ($token_log as $key => $value) {



				    			if(!empty($value)){



				    				$device_token = $value['device_id'];



				    				$user_mobile_info = array($device_token);



				    				if($device_token){



										array_push($device_array,$value['device_id']);



									}



				    			}



				    		}



				    		$user_mobile_info = $device_array;







							$payload['badge'] = 1;



							$payload['sound'] = "default";



							$payload['body'] = $mTo;



							$payload['title']= 'StyleBuddy';



							$payload['notification_type'] = 'block';



							//$noti = $this->common_model->push_notification($user_mobile_info, $payload);







							$activity_log['multicast_id'] = $noti->multicast_id;



							$activity_log['message_id'] = json_encode($noti->results);



							$activity_log['success_count'] = $noti->success;



							$activity_log['error_count'] = $noti->failure;



							$this->common_model->simple_insert('push_notification_activity_log',$activity_log);



						}







					//}



					$msg = 'User unblocked successfully';



					if ($follow_status) {



						$msg = 'User blocked successfully';



					}



					$response = array(



						'status' => $a['status'],



						'message' => $msg,



						'block_status' => strval($follow_status),



					);



				}else{



					$response = array(



						'status' => false,



						'message' => 'Please provide device ID & user ID',



					);



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		}



	}



	public function blockuserlist_post(){



		try {



			$postData = $this->input->post();



			if (array_key_exists('current_language', $postData)) { 			     



				$currLanguage = $postData['current_language']; 			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){







				$limit = array();



				$limit['l1'] = 0;



				$limit['l2'] = 6;



				$str = ' WHERE id != 0 AND block_status = 1 ';



				if ($postData['user_id']) {



					$str .= ' AND user_id = '.$postData['user_id'];



				}



				$result 	=  $this->common_model->get_all_details_field_query('to_user_id','users_block',$str);



				



				$num_rows = $result->num_rows();



				$list = $result->result_array();



				if ($list) {



					$str = ' WHERE id != 0 ';



					$str1 .= '';



					$i=0;



					foreach ($list as $key => $value) {



						if ($value['to_user_id']) {



							if ($i>0) {



								$str1 .= ' OR ';



							}



							$str1 .= 'id = '.$value['to_user_id'];



							$i++;



						}



					}



					if (!empty($str1)) {



						$str .= ' AND ('.$str1.')';



					}



					



					$tbl_name = "vender";



					$result 	=  $this->common_model->get_all_details_query($tbl_name,$str);



					$num_rows = $result->num_rows();



					$list = $result->result_array();



				}else{







				}



				



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'num_rows' => $num_rows,



					'response' => $list,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		}



	}



	



	public function get_to_user_detail_post() {



		try {



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$postData = $this->input->post();



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				$user_id = $postData['to_user_id'];

				$to_user_id = $postData['user_id'];



				$followNum = 0;

				$following_statusNum = 0;

				$variable = $this->common_model->get_all_details('posts_follow',array('follow_status'=>1,'post_user_id'=>$user_id))->result();

				//echo $this->db->last_query();

			    foreach ($variable as $key => $value) {

                    $r = $this->common_model->get_all_details('vender',array('id'=>$value->post_user_id))->row();

                    //echo $this->db->last_query();

                    if($r){

                        $followNum = $followNum + 1;   

                    }

			    }

			    $variable = $this->common_model->get_all_details('posts_follow',array('following_status'=>1,'user_id'=>$user_id))->result();

			    foreach ($variable as $key => $value) {

                    $r = $this->common_model->get_all_details('vender',array('id'=>$value->post_user_id))->row();

                    //echo $this->db->last_query();

                    if($r){

                        $following_statusNum = $following_statusNum + 1;   

                    }

			    }

				 

				$inset['count_follow'] =$followNum; 

				$inset['count_following'] =$following_statusNum; 

				$this->common_model->commonUpdate('vender',$inset,array('id'=>$user_id));

				//echo $this->db->last_query();

			    $userRow = $this->common_model->get_all_details('vender',array('id'=>$user_id))->row();

				//



				if($userRow){



					if($userRow->country){



						$r = $this->db->query("select * from countries where id = '".$userRow->country."'")->row();



	                    $userRow->country_name = $r->name;



	                }



	                if($userRow->state){



						$r = $this->db->query("select * from states where id = '".$userRow->state."'")->row();



	                    $userRow->state_name = $r->name;



	                }



	                if($userRow->city){



						$r = $this->db->query("select * from cities where id ='".$userRow->city."'")->row();



	                    $userRow->city_name = $r->city;



					}



					



					$review = $this->db->query('SELECT AVG(rating) as rating, count(rating) as feedbackCount from review'." WHERE status = 1 and  user_id = ".$userRow->id)->row();



		            $userRow->feedbackRating = ($review->rating)?(string)round($review->rating):'0';



		            $userRow->feedbackCount = $review->feedbackCount;



		            $userRow->review = $review;



		           

		            $follow_status = '0';



					$block_status = '0';



					



					if ($to_user_id) {



						$row11 = $this->common_model->get_all_details('users_block',array('to_user_id'=>$user_id,'user_id'=>$to_user_id,'block_status'=>1))->row();



						if ($row11) {



							$block_status = $row11->block_status;



						}



						



						$row11 = $this->common_model->get_all_details('posts_follow',array('follow_status'=>1,'post_user_id'=>$user_id,'user_id'=>$to_user_id))->row();



						//echo $this->db->last_query();



						if ($row11) {



							$follow_status = $row11->follow_status;



						}



					}



					$userRow->follow_status = $follow_status;



					$userRow->block_status = $block_status;











		            $tbl_name = 'posts';



					$postsData = array();



					$str = " where post_admin_id = '".$user_id."' and media != '' ORDER by id DESC";



					$rows =  $this->common_model->get_all_details_query($tbl_name,$str);



					$list = $rows->result_array();



					foreach ($list as $key => $value) {



						$row =  $this->common_model->get_all_details_query('vender','WHERE id = '.$value['post_admin_id'])->row_array();



						$list[$key]['userRow'] = $row;







						$row = $this->common_model->get_all_details('vender',array('id'=>$value['post_admin_id']))->row();



						$list[$key]['full_name'] = $row->fname.' '.$row->lname;



						



						$follow_status = '0';



						$like_status = '0';



						$rating_status = '0';



						$block_status = '0';



						$favorite_status = '0';



						



						if ($postData['user_id']) {



							$row11 = $this->common_model->get_all_details('users_block',array('to_user_id'=>$value['post_admin_id'],'user_id'=>$postData['user_id']))->row();



							if ($row11) {



								$block_status = $row11->block_status;



							}



							



							$row11 = $this->common_model->get_all_details('posts_follow',array('post_user_id'=>$value['post_admin_id'],'user_id'=>$postData['user_id']))->row();



							if ($row11) {



								$follow_status = $row11->follow_status;



							}



							$row11 = $this->common_model->get_all_details('posts_like',array('post_id'=>$value['id'],'user_id'=>$postData['post_admin_id']))->row();



							if ($row11) {



								$like_status = $row11->like_status;



							}



							$row11 = $this->common_model->get_all_details('posts_favorite',array('post_id'=>$value['id'],'user_id'=>$postData['post_admin_id']))->row();



							if ($row11) {



								$favorite_status = $row11->favorite_status;



							}



							$row11 = $this->common_model->get_all_details('posts_rating',array('post_id'=>$value['id'],'user_id'=>$postData['post_admin_id']))->row();



							if ($row11) {



								$rating_status = 1;



							}















						}



						$ab = array();



						$abc = explode(',', $value['media']);



						foreach ($abc as $k => $va) {



							$b = array();



							$b['image'] = $va;



							array_push($ab, $b);



						}



						$list[$key]['media'] = $ab;



						$list[$key]['follow_status'] = $follow_status;



						$list[$key]['like_status'] = $like_status;



						$list[$key]['rating_status'] = $rating_status;



						$list[$key]['block_status'] = $block_status;



						$list[$key]['favorite_status'] = $favorite_status;



					}



					$postsData['posts_media'] = $list;



					$str = " where post_admin_id = '".$user_id."' and (media = ''  OR media is NULL) ORDER by id DESC";



					$rows =  $this->common_model->get_all_details_query($tbl_name,$str);



					$list = $rows->result_array();



					foreach ($list as $key => $value) {



						$row =  $this->common_model->get_all_details_query('vender','WHERE id = '.$value['post_admin_id'])->row_array();



						$list[$key]['userRow'] = $row;







						$row = $this->common_model->get_all_details('vender',array('id'=>$value['post_admin_id']))->row();



						$list[$key]['full_name'] = $row->fname.' '.$row->lname;



						



						$follow_status = '0';



						$like_status = '0';



						$rating_status = '0';



						$block_status = '0';



						$favorite_status = '0';



						



						if ($postData['user_id']) {



							$row11 = $this->common_model->get_all_details('users_block',array('to_user_id'=>$value['post_admin_id'],'user_id'=>$postData['user_id']))->row();



							if ($row11) {



								$block_status = $row11->block_status;



							}



							



							$row11 = $this->common_model->get_all_details('posts_follow',array('post_user_id'=>$value['post_admin_id'],'user_id'=>$postData['user_id']))->row();



							if ($row11) {



								$follow_status = $row11->follow_status;



							}



							$row11 = $this->common_model->get_all_details('posts_like',array('post_id'=>$value['id'],'user_id'=>$postData['post_admin_id']))->row();



							if ($row11) {



								$like_status = $row11->like_status;



							}



							$row11 = $this->common_model->get_all_details('posts_favorite',array('post_id'=>$value['id'],'user_id'=>$postData['post_admin_id']))->row();



							if ($row11) {



								$favorite_status = $row11->favorite_status;



							}



							$row11 = $this->common_model->get_all_details('posts_rating',array('post_id'=>$value['id'],'user_id'=>$postData['post_admin_id']))->row();



							if ($row11) {



								$rating_status = 1;



							}















						}



						$ab = array();



						$abc = explode(',', $value['media']);



						foreach ($abc as $k => $va) {



							$b = array();



							$b['image'] = $va;



							array_push($ab, $b);



						}



						$list[$key]['media'] = $ab;



						$list[$key]['follow_status'] = $follow_status;



						$list[$key]['like_status'] = $like_status;



						$list[$key]['rating_status'] = $rating_status;



						$list[$key]['block_status'] = $block_status;



						$list[$key]['favorite_status'] = $favorite_status;



					}



					$postsData['posts_text'] = $list;



					



					$response = array(



						'status' => $a['status'],



						'response' => $userRow,



						'posts' => $postsData,



					);



				}else{



					$response = array(



						'status' => 'failed',



						'message' => 'User Not exist.',



					);



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function post_create_video_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$auth['access_token'] = $postData['access_token'];



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				$this->uploadPath = 'assets/images/posts/';



				if (!file_exists($this->uploadPath)) {



		            mkdir($this->uploadPath, 0777, true);



		        }



                $check_content_sightengine = array();



    			$check_content_sightengine['title'] = $postData['title'];;



    			$check_content_sightengine['description'] = $postData['description'];;



    			$dd = check_content_sightengine($check_content_sightengine);



    			if ($dd) {



    				$msg = 'Your request could not be submitted because you enter inappropriate content.';



    				$response = array(



    		                'status' => 'fail',



    		                'message' =>  $msg,



    	                );



    				$this->set_response($response, REST_Controller::HTTP_OK);



    				return;



    			}



    			$c_c_s = array(); 



				$image = $this->uploadMultipleImage('media',$this->uploadPath);



				if(!empty($image)){



					$insert_data['media'] = $image;



					$image_type_full = $_FILES['media']['type'];



					$image_type = explode('/',$image_type_full);



					$insert_data['media_type'] = $image_type[0];



					$insert_data['media_type_full'] = $image_type_full;



					$c_c_s['image'] = base_url($this->uploadPath.$image);



				}

				/*$dd = check_image_sightengine($c_c_s);

                if ($dd) {

                    $msg = 'Your request could not be submitted because you enter inappropriate image.';

    				$response = array(

		                'status' => 'fail',

		                'message' =>  $msg,

	                );

    				$this->set_response($response, REST_Controller::HTTP_OK);

    				return;

                }*/



				 



				 



				$post_category	= $postData['post_category'];



				$post_type	= $postData['post_type'];



				$title	= $postData['title'];



				$description	= $postData['description'];



				$user_id	= $postData['user_id'];



				$app_mode = $postData['app_mode'];







				$insert_data['title']	= $title;



				$insert_data['description']	= $description;



				$insert_data['post_type']	= $post_type;



				$insert_data['post_category']	= $post_category;



				$insert_data['post_admin_id']	= $user_id;



				$insert_data['browser'] = $app_mode;







				$insert_data['created_at']  = date("Y-m-d h:i:s");



				$insert_data['updated_at']  = date("Y-m-d h:i:s");



				



				$tbl_name = 'posts';



				



				$slugBase = $slug = url_title($title, '-', TRUE);



				$slug_check = '0';



				$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));



				if ($duplicate_url->num_rows()>0){



					$slug = $slugBase.'-'.$duplicate_url->num_rows();



				}else {



					$slug_check = '1';



				}



				$urlCount = $duplicate_url->num_rows();



				while ($slug_check == '0'){



					$urlCount++;



					$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));



					if ($duplicate_url->num_rows()>0){



						$slug = $slugBase.'-'.$urlCount;



					}else {



						$slug_check = '1';



					}



				}



				$insert_data['slug'] = $slug;



				$insert_data['ip_address'] = $this->input->ip_address();



				$insert_data['user_agent'] = $this->input->user_agent();



				$insert_data['browserVersion'] = $this->agent->version();



				$insert_data['platform'] = $this->agent->platform();



				$updateTrue = $this->common_model->simple_insert($tbl_name,$insert_data);



				$ro  = $this->common_model->get_all_details_query($tbl_name,' WHERE id = "'.$updateTrue.'"')->row_array();



				







 







				if($updateTrue){



					$response = array(



						'status' => $a['status'],



						'message_2' => ($_FILES),



						'message_1' => ($postData['media']),



						'message' => 'Post uploaded successfully.',



						'response' => $ro,



					);



				}else{



					$response = array(



						'status' => 'failed',



						'message' => 'Something went wrong',



					);



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		}



	}



	



	public function create_post_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$auth['access_token'] = $postData['access_token'];



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				$this->uploadPath = 'assets/images/posts/';



				if (!file_exists($this->uploadPath)) {



		            mkdir($this->uploadPath, 0777, true);



		        }



				 



				$check_content_sightengine = array();



    			$check_content_sightengine['title'] = $postData['title'];;



    			$check_content_sightengine['description'] = $postData['description'];;



    			$dd = check_content_sightengine($check_content_sightengine);



    			if ($dd) {



    				$msg = 'Your request could not be submitted because you enter inappropriate content.';



    				$response = array(



    		                'status' => 'fail',



    		                'message' =>  $msg,



    	                );



    				$this->set_response($response, REST_Controller::HTTP_OK);



    				return;



    



    			}



    			$c_c_s = array(); 

                $image = $this->uploadMultipleImage('media',$this->uploadPath);

                if(!empty($image)){

                    $insert_data['media'] = $image;

                    $insert_= trim($image,',');

                    $product_galary =  trim($insert_,',');



                    $aa = explode(',', $product_galary);

                    $j =0;

                    foreach ($aa as $key => $value) {$j++;

                        $c_c_s['image'.$j] = base_url($this->uploadPath.$value);

                    }

                }

                

                $dd = check_image_sightengine($c_c_s);

                if ($dd) {

                    $msg = 'Your request could not be submitted because you enter inappropriate image.';

    				$response = array(

		                'status' => 'fail',

		                'message' =>  $msg,

	                );

    				$this->set_response($response, REST_Controller::HTTP_OK);

    				return;

                }



				$post_category	= $postData['post_category'];



				$post_type	= $postData['post_type'];



				$title	= $postData['title'];



				$description	= $postData['description'];



				$user_id	= $postData['user_id'];



				$app_mode = $postData['app_mode'];







				$insert_data['title']	= $title;



				$insert_data['description']	= $description;



				$insert_data['post_type']	= $post_type;



				$insert_data['post_category']	= $post_category;



				$insert_data['post_admin_id']	= $user_id;



				$insert_data['browser'] = $app_mode;







				$insert_data['created_at']  = date("Y-m-d h:i:s");



				$insert_data['updated_at']  = date("Y-m-d h:i:s");



				



				$tbl_name = 'posts';



				



				$slugBase = $slug = url_title($title, '-', TRUE);



				$slug_check = '0';



				$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));



				if ($duplicate_url->num_rows()>0){



					$slug = $slugBase.'-'.$duplicate_url->num_rows();



				}else {



					$slug_check = '1';



				}



				$urlCount = $duplicate_url->num_rows();



				while ($slug_check == '0'){



					$urlCount++;



					$duplicate_url = $this->common_model->get_all_details($tbl_name,array('slug'=>$slug));



					if ($duplicate_url->num_rows()>0){



						$slug = $slugBase.'-'.$urlCount;



					}else {



						$slug_check = '1';



					}



				}



				$insert_data['slug'] = $slug;



				$insert_data['ip_address'] = $this->input->ip_address();



				$insert_data['user_agent'] = $this->input->user_agent();



				$insert_data['browserVersion'] = $this->agent->version();



				$insert_data['platform'] = $this->agent->platform();



				$updateTrue = $this->common_model->simple_insert($tbl_name,$insert_data);



				$ro  = $this->common_model->get_all_details_query($tbl_name,' WHERE id = "'.$updateTrue.'"')->row_array();



				







				if($updateTrue){



					$response = array(



						'status' => $a['status'],



						'message_2' => ($_FILES),



						'message_1' => ($postData['media']),



						'message' => 'Post uploaded successfully.',



						'response' => $ro,



					);



				}else{



					$response = array(



						'status' => 'failed',



						'message' => 'Something went wrong',



					);



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		}



	}



	public function post_detail_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$a = $this->check_api_auth($postData);



			$post_id = $postData['post_id'];



			$user_id = $postData['user_id'];



			







			if($a['status'] == 'success'){



				if ($post_id ) {



				 



					$tbl_name = 'posts';



					$str = " WHERE id = '".$post_id."' ORDER by id DESC";



					$rows =  $this->common_model->get_all_details_query($tbl_name,$str);



					$rows = $rows->row_array();



					 



					$userRow=$this->common_model->get_all_details_query('vender','WHERE id = '.$rows['post_admin_id'])->row_array();



					$rows['userRow'] = $userRow;



					



					$row = $this->common_model->get_all_details('vender',array('id'=>$userRow['user_id']))->row();



					$rows['full_name'] = $row->fname.' '.$row->lname;







					$follow_status = '0';



					$like_status = '0';



					$rating_status = '0';



					$block_status = '0';



					$favorite_status = '0';



					



					if ($postData['user_id']) {



						$row11 = $this->common_model->get_all_details('users_block',array('to_user_id'=>$rows['post_admin_id'],'user_id'=>$postData['user_id'],'block_status'=>1))->row();



						//echo $this->db->last_query();



						if ($row11) {



							$block_status = $row11->block_status;



						}







						$row11 = $this->common_model->get_all_details('posts_follow',array('post_user_id'=>$rows['post_admin_id'],'user_id'=>$postData['user_id']))->row();



						if ($row11) {



							$follow_status = $row11->follow_status;



						}



						$row11 = $this->common_model->get_all_details('posts_like',array('post_id'=>$rows['id'],'user_id'=>$postData['user_id']))->row();



						if ($row11) {



							$like_status = $row11->like_status;



						}



						$row11 = $this->common_model->get_all_details('posts_favorite',array('post_id'=>$rows['id'],'user_id'=>$postData['user_id']))->row();



						if ($row11) {



							$favorite_status = $row11->favorite_status;



						}



						



						 







						$row11 = $this->common_model->get_all_details('posts_rating',array('post_id'=>$rows['id'],'user_id'=>$postData['user_id']))->row();



						if ($row11) {



							$rating_status = 1;



						}



					}







					$ab = array();



					$abc = explode(',', $rows['media']);



					foreach ($abc as $k => $va) {



						$b = array();



						$b['image'] = $va;



						array_push($ab, $b);



					}



					$rows['media'] = $ab;



						 







					$rows['follow_status'] = $follow_status;



					$rows['like_status'] = $like_status;



					$rows['rating_status'] = $rating_status;



					$rows['block_status'] = $block_status;



					$rows['favorite_status'] = $favorite_status;







					$data['postrow'] = $rows; 



					 



					$rows = $this->common_model->get_all_details_query('posts_review',' where post_id = "'.$post_id.'" and review_id = 0 ORDER BY id DESC')->result_array();



					foreach ($rows as $key => $value) {

						$row111 = $this->common_model->get_all_details('posts_review',array('review_id'=>$value['id']))->result_array();

						if(!$row111){

						    $row11 = array(); 

						}else{

						    $row11 = $row111; 

						    foreach ($row11 as $key1 => $value1) {

        						$venderRow = $this->common_model->get_all_details('vender',array('id'=>$value1['user_id']))->row();

        						$row11[$key1]['image'] = $venderRow->image;

        					}

						}

						$rows[$key]['reply'] = $row11;

						$venderRow = $this->common_model->get_all_details('vender',array('id'=>$value['user_id']))->row();

						$rows[$key]['image'] = $venderRow->image;

					}



					$data['posts_review'] = $rows;



					$response = array(



						'status' => $a['status'],



						'message' => $a['message'],



						'response' => $data,



					);



				}else{



					$response = array(



						'status' => false,



						'message' => 'Please provide post ID',



					);



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function post_edit_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$a = $this->check_api_auth($postData);



			$post_id = $postData['post_id'];



			







			if($a['status'] == 'success'){



				if ($post_id ) {



				 



					$check_content_sightengine = array();



        			$check_content_sightengine['title'] = $postData['title'];;



        			$check_content_sightengine['description'] = $postData['description'];;



        			$dd = check_content_sightengine($check_content_sightengine);



        			if ($dd) {



        				$msg = 'Your request could not be submitted because you enter inappropriate content.';



        				$response = array(



        		                'status' => 'fail',



        		                'message' =>  $msg,



        	                );



        				$this->set_response($response, REST_Controller::HTTP_OK);



        				return;



        



        			}



        			



					$tbl_name = 'posts';



					 



					$title	= $postData['title'];



					$description	= $postData['description'];



					$user_id	= $postData['user_id'];



					$app_mode = $postData['app_mode'];







					$post_category	= $postData['post_category'];



					$post_type	= $postData['post_type'];







					$insert_data['title']	= $title;



					$insert_data['description']	= $description;



					$insert_data['browser'] = $app_mode;



					$insert_data['post_type']	= $post_type;



					$insert_data['post_category']	= $post_category;







					$insert_data['updated_at']  = date("Y-m-d h:i:s");



					$this->uploadPath = 'assets/images/posts/';



			         

			       /* $c_c_s = array(); 

	                $image = $this->uploadMultipleImage('media',$this->uploadPath);

	                if(!empty($image)){

	                    $insert_data['media'] = $image;

	                    $c_c_s['image'] = base_url($this->uploadPath.$image);

	                }

	                */

	                $c_c_s = array(); 

                    $image = $this->uploadMultipleImage('media',$this->uploadPath);

                    if(!empty($image)){

                        $insert_data['media'] = $image;

                        $insert_= trim($image,',');

                        $product_galary =  trim($insert_,',');

    

                        $aa = explode(',', $product_galary);

                        $j =0;

                        foreach ($aa as $key => $value) {$j++;

                            $c_c_s['image'.$j] = base_url($this->uploadPath.$value);

                        }

                    }

                    

	                $dd = check_image_sightengine($c_c_s);

	                if ($dd) {

	                    $msg = 'Your request could not be submitted because you enter inappropriate image.';

	    				$response = array(

			                'status' => 'fail',

			                'message' =>  $msg,

		                );

	    				$this->set_response($response, REST_Controller::HTTP_OK);

	    				return;

	                }



					 



					$updateTrue = $this->common_model->commonUpdate($tbl_name,$insert_data,array('id'=>$post_id));











					$str = " WHERE id = '".$post_id."' ORDER by id DESC";



					$rows =  $this->common_model->get_all_details_query($tbl_name,$str);



					$rows = $rows->row_array();



					//echo $this->db->last_query();



					$postRrow=$this->common_model->get_all_details_query('vender','WHERE id = '.$rows['post_admin_id'])->row_array();



					$rows['userRow'] = $postRrow;



					$row = $this->common_model->get_all_details('vender',array('id'=>$postRrow['post_admin_id']))->row();



					$rows['full_name'] = $row->fname.' '.$row->lname;



					



					$follow_status = '0';



					$like_status = '0';



					$rating_status = '0';



					$block_status = '0';



					



					if ($postData['user_id']) {



						$row11 = $this->common_model->get_all_details('users_block',array('to_user_id'=>$postRrow['post_admin_id'],'user_id'=>$postData['user_id'],'block_status'=>1))->row();



						if ($row11) {



							$block_status = $row11->block_status;



						}



						



						$row11 = $this->common_model->get_all_details('posts_follow',array('post_user_id'=>$postRrow['post_admin_id'],'user_id'=>$postData['user_id']))->row();



						if ($row11) {



							$follow_status = $row11->follow_status;



						}



						$row11 = $this->common_model->get_all_details('posts_like',array('post_id'=>$postRrow['id'],'user_id'=>$postData['post_admin_id']))->row();



						if ($row11) {



							$like_status = $row11->like_status;



						}



						$row11 = $this->common_model->get_all_details('posts_rating',array('post_id'=>$postRrow['id'],'user_id'=>$postData['post_admin_id']))->row();



						if ($row11) {



							$rating_status = 1;



						}



					}



					$rows['follow_status'] = $follow_status;



					$rows['like_status'] = $like_status;



					$rows['rating_status'] = $rating_status;



					$rows['block_status'] = $block_status;







					$this->data['postrow'] = $rows; 



					 



					$rows = $this->common_model->get_all_details('posts_review',array('post_id'=>$post_id))->result_array();



					foreach ($rows as $key => $value) {



						$row11 = $this->common_model->get_all_details('vender',array('id'=>$value['user_id']))->row();



						$rows[$key]['image'] = $row11->image;



					}



					$this->data['posts_review'] = $rows;



					$response = array(



						'status' => $a['status'],



						'message' => 'Post updated succesfully',



						'response' => $this->data,



					);



				}else{



					$response = array(



						'status' => false,



						'message' => 'Please provide post ID',



					);



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	



	public function post_delete_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$a = $this->check_api_auth($postData);



			$post_id = $postData['post_id'];



			$user_id = $postData['user_id'];



			







			if($a['status'] == 'success'){



				if ($post_id && $user_id) {



				 



					$tbl_name = 'posts';



					$str = array();



					$str['id'] = $post_id;



					$str['post_admin_id'] =$user_id;



					$rows =  $this->common_model->commonDelete($tbl_name,$str);



					 



					



					 



					$response = array(



						'status' => $a['status'],



						'message' => 'Post deleted successfully',



						'response' => 'Post deleted successfully',



					);



				}else{



					$response = array(



						'status' => false,



						'message' => 'Please provide post ID and user ID',



					);



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}







	public function posts_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$a = $this->check_api_auth($postData);



			if($a['status'] == 'success'){



				$tbl_name = 'posts';

				$tbl_name1 = 'vender';







				$str = " Where ".$tbl_name.".status=1";



				if ($postData['post_type']) {



					$str .= " AND ".$tbl_name.".post_type = '".$postData['post_type']."'";



				}



				if ($postData['post_category']) {



					$str .= " AND ".$tbl_name.".post_category = '".$postData['post_category']."'";



				}

				if ($postData['user_type']) {

				    $str .= " AND ".$tbl_name1.".user_type = '2'";

				}

				$str .= " ORDER by ".$tbl_name.".id DESC";

				if ($postData['user_type']) {

				    $rows =  $this->db->query("SELECT ".$tbl_name.".* FROM ".$tbl_name.' INNER JOIN '.$tbl_name1.' ON '.$tbl_name1.'.id='.$tbl_name.'.post_admin_id'.$str);

				}else{

				    $rows =  $this->common_model->get_all_details_query($tbl_name,$str); 

				}

				

                //echo $this->db->last_query();

				$list = $rows->result_array();



				foreach ($list as $key => $value) {



					$row =  $this->common_model->get_all_details_query('vender','WHERE id = '.$value['post_admin_id'])->row_array();



					$list[$key]['userRow'] = $row;



					$row = $this->common_model->get_all_details('vender',array('id'=>$value['post_admin_id']))->row();



					$list[$key]['full_name'] = $row->fname.' '.$row->lname;



					



					$follow_status = '0';



					$like_status = '0';



					$rating_status = '0';



					$block_status = '0';



					$favorite_status = '0';



					



					if ($postData['user_id']) {



						$row11 = $this->common_model->get_all_details('users_block',array('to_user_id'=>$value['post_admin_id'],'user_id'=>$postData['user_id'],'block_status'=>1))->row();



						//echo $this->db->last_query();



						if ($row11) {



							$block_status = $row11->block_status;



						}



						



						$row11 = $this->common_model->get_all_details('posts_follow',array('post_user_id'=>$value['post_admin_id'],'user_id'=>$postData['user_id']))->row();



						if ($row11) {



							$follow_status = $row11->follow_status;



						}



						$row11 = $this->common_model->get_all_details('posts_like',array('post_id'=>$value['id'],'user_id'=>$postData['user_id']))->row();



						if ($row11) {



							$like_status = $row11->like_status;



						}



						$row11 = $this->common_model->get_all_details('posts_favorite',array('post_id'=>$value['id'],'user_id'=>$postData['user_id']))->row();



						if ($row11) {



							$favorite_status = $row11->favorite_status;



						}



						$row11 = $this->common_model->get_all_details('posts_rating',array('post_id'=>$value['id'],'user_id'=>$postData['user_id']))->row();



						if ($row11) {



							$rating_status = 1;



						}



					}



					$list[$key]['follow_status'] = $follow_status;



					$list[$key]['like_status'] = $like_status;



					$list[$key]['rating_status'] = $rating_status;



					$list[$key]['block_status'] = $block_status;



					$list[$key]['favorite_status'] = $favorite_status;



					$ab = array();



					$abc = explode(',', $value['media']);



					foreach ($abc as $k => $va) {



						$b = array();



						$b['image'] = $va;



						array_push($ab, $b);



					}



					$list[$key]['media'] = $ab;



				}



				$data['numRows-1'] = count($list); 



				



				$ab = array();



				foreach ($list as $key => $value) {



					if ($value['block_status']==0) {



						array_push($ab,$value);



						unset($list[$key]);



					}







				}



				$data['numRows'] = count($ab); 



				$data['posts'] = $ab; 



				 



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'response' => $data,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function feedvideo_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$a = $this->check_api_auth($postData);



			if($a['status'] == 'success'){



				$tbl_name = 'posts';



				if ($postData['post_id']) {



					$post_id = $postData['post_id'];







					$str = " Where status=1 AND UPPER(media_type) = 'VIDEO' AND id='".$post_id."' ";



					if ($postData['post_type']) {



						$str .= " AND post_type = '".$postData['post_type']."'";



					}



					if ($postData['post_category']) {



						$str .= " AND post_category = '".$postData['post_category']."'";



					}



					$str .= " ORDER by id DESC";



					$rows =  $this->common_model->get_all_details_query($tbl_name,$str);



					$list1 = $rows->result_array();







					$str = " Where status=1 AND UPPER(media_type) = 'VIDEO' AND id!='".$post_id."' ";



					if ($postData['post_type']) {



						$str .= " AND post_type = '".$postData['post_type']."'";



					}



					if ($postData['post_category']) {



						$str .= " AND post_category = '".$postData['post_category']."'";



					}



					$str .= " ORDER by id DESC";



					$rows =  $this->common_model->get_all_details_query($tbl_name,$str);



					$list2 = $rows->result_array();



					$list = array_merge($list1,$list2);







					foreach ($list as $key => $value) {



						$row =  $this->common_model->get_all_details_query('vender','WHERE id = '.$value['post_admin_id'])->row_array();



						$list[$key]['userRow'] = $row;



						$row = $this->common_model->get_all_details('vender',array('id'=>$value['post_admin_id']))->row();



						$list[$key]['full_name'] = $row->fname.' '.$row->lname;



						



						$follow_status = '0';



						$like_status = '0';



						$rating_status = '0';



						$block_status = '0';



						$favorite_status = '0';



						



						if ($postData['user_id']) {



							$row11 = $this->common_model->get_all_details('users_block',array('to_user_id'=>$value['post_admin_id'],'user_id'=>$postData['user_id'],'block_status'=>1))->row();



							if ($row11) {



								$block_status = $row11->block_status;



							}



							



							$row11 = $this->common_model->get_all_details('posts_follow',array('post_user_id'=>$value['post_admin_id'],'user_id'=>$postData['user_id']))->row();



							if ($row11) {



								$follow_status = $row11->follow_status;



							}



							$row11 = $this->common_model->get_all_details('posts_like',array('post_id'=>$value['id'],'user_id'=>$postData['user_id']))->row();



							if ($row11) {



								$like_status = $row11->like_status;



							}



							$row11 = $this->common_model->get_all_details('posts_favorite',array('post_id'=>$value['id'],'user_id'=>$postData['user_id']))->row();



							if ($row11) {



								$favorite_status = $row11->favorite_status;



							}



							$row11 = $this->common_model->get_all_details('posts_rating',array('post_id'=>$value['id'],'user_id'=>$postData['user_id']))->row();



							if ($row11) {



								$rating_status = 1;



							}



						}



						$list[$key]['follow_status'] = $follow_status;



						$list[$key]['like_status'] = $like_status;



						$list[$key]['rating_status'] = $rating_status;



						$list[$key]['block_status'] = $block_status;



						$list[$key]['favorite_status'] = $favorite_status;



						$ab = array();



						$abc = explode(',', $value['media']);



						foreach ($abc as $k => $va) {



							$b = array();



							$b['image'] = $va;



							array_push($ab, $b);



						}



						$list[$key]['media'] = $ab;



					}



					$data['numRows-1'] = count($list); 



					



					$ab = array();



					foreach ($list as $key => $value) {



						if ($value['block_status']==0) {



							array_push($ab,$value);



							unset($list[$key]);



						}







					}



					$data['numRows'] = count($ab); 



					$data['posts'] = $ab; 



					$response = array(



						'status' => $a['status'],



						'message' => $a['message'],



						'response' => $data,



					);



				}else{



					$response = array(



						'status' => $a['status'],



						'message' => 'Please enter post ID',



					);



				}



				



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function posts_search_media_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$a = $this->check_api_auth($postData);



			if($a['status'] == 'success'){



				$tbl_name = 'posts';







				$str = " Where id!=0 AND media != '' ";



				if ($postData['post_type']) {



					$str .= " AND post_type = '".$postData['post_type']."'";



				}



				if ($postData['post_category']) {



					$str .= " AND post_category = '".$postData['post_category']."'";



				}



				



				$str .= " ORDER by id DESC";



				$rows =  $this->common_model->get_all_details_query($tbl_name,$str);



				$list = $rows->result_array();



				foreach ($list as $key => $value) {



					$row =  $this->common_model->get_all_details_query('vender','WHERE id = '.$value['post_admin_id'])->row_array();



					$list[$key]['userRow'] = $row;



					$row = $this->common_model->get_all_details('vender',array('id'=>$value['post_admin_id']))->row();



					$list[$key]['full_name'] = $row->fname.' '.$row->lname;



					



					$follow_status = '0';



					$like_status = '0';



					$rating_status = '0';



					$block_status = '0';



					$favorite_status = '0';



					



					if ($postData['user_id']) {



						$row11 = $this->common_model->get_all_details('users_block',array('to_user_id'=>$value['post_admin_id'],'user_id'=>$postData['user_id'],'block_status'=>1))->row();



						//echo $this->db->last_query();



						if ($row11) {



							$block_status = $row11->block_status;



						}



						



						$row11 = $this->common_model->get_all_details('posts_follow',array('post_user_id'=>$value['post_admin_id'],'user_id'=>$postData['user_id']))->row();



						if ($row11) {



							$follow_status = $row11->follow_status;



						}



						$row11 = $this->common_model->get_all_details('posts_like',array('post_id'=>$value['id'],'user_id'=>$postData['user_id']))->row();



						if ($row11) {



							$like_status = $row11->like_status;



						}



						$row11 = $this->common_model->get_all_details('posts_favorite',array('post_id'=>$value['id'],'user_id'=>$postData['user_id']))->row();



						if ($row11) {



							$favorite_status = $row11->favorite_status;



						}



						$row11 = $this->common_model->get_all_details('posts_rating',array('post_id'=>$value['id'],'user_id'=>$postData['user_id']))->row();



						if ($row11) {



							$rating_status = 1;



						}



					}



					$list[$key]['follow_status'] = $follow_status;



					$list[$key]['like_status'] = $like_status;



					$list[$key]['rating_status'] = $rating_status;



					$list[$key]['block_status'] = $block_status;



					$list[$key]['favorite_status'] = $favorite_status;



					$ab = array();



					$abc = explode(',', $value['media']);



					foreach ($abc as $k => $va) {



						$b = array();



						$b['image'] = $va;



						array_push($ab, $b);



					}



					$list[$key]['media'] = $ab;



				}



				$data['numRows-1'] = count($list); 



				



				$ab = array();



				foreach ($list as $key => $value) {



					if ($value['block_status']==0) {



						array_push($ab,$value);



						unset($list[$key]);



					}







				}



				$data['numRows'] = count($ab); 



				$data['posts'] = $ab; 



				 



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'response' => $data,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function post_favorite_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$auth['access_token'] = $postData['access_token'];



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){







				$tbl_name = 'posts_favorite';



				$tbl_name1 = 'posts';



				$postData = $this->input->post();



				if (!empty($postData['post_id']) && !empty($postData['device_id']) && !empty($postData['user_id'])) {	



					$favorite_status = 1;



					$user_id = $postData['user_id'];



					$post_id = $postData['post_id'];



					$ip_address = $postData['device_id'];



					$device_type = $postData['device_type'];







					$logsData['user_id'] = $user_id;



					$logsData['favorite_status'] = $favorite_status;



					$logsData['ip_address'] = $ip_address;



					$logsData['user_agent'] = $device_type;



					$logsData['user_session_id'] = $this->session->session_id;



					$logsData['post_id'] = $post_id;







					$logsData['created_at']  = date("Y-m-d h:i:s");



					$logsData['updated_at']  = date("Y-m-d h:i:s");







					



					$row  = $this->common_model->get_all_details_query($tbl_name,' WHERE post_id = "'.$post_id.'" AND user_id = "'.$user_id.'"')->row_array();



					



					$ro  = $this->common_model->get_all_details_query($tbl_name1,' WHERE id = "'.$post_id.'"')->row_array();



					$favorite_status = 1;



					if($row){



						if ($row['favorite_status']) {



							$favorite_status = 0;



						}else{



							$favorite_status = 1;



						}



						$j['favorite_status']=$favorite_status;



						$this->common_model->commonUpdate($tbl_name,$j,array('id'=>$row['id']));



					}else{



						$updateTrue= $this->common_model->simple_insert($tbl_name,$logsData); 



						$count_favorite = $count_favorite + 1;



					}



					



					$activity_log = array();



					$content_id = $post_id;



					$table_name = 'posts';



					$to_id = $ro['post_admin_id'];



					$tag = 'favorite';







					$userRow  = $this->common_model->get_all_details_query('vender',' WHERE id = "'.$to_id.'"')->row_array();



					$userName = $userRow['fname'].' '.$userRow['lname'];







					$userRow  = $this->common_model->get_all_details_query('vender',' WHERE id = "'.$user_id.'"')->row_array();



					$userNameTo = $userRow['fname'].' '.$userRow['lname'];







					



					



					$activity_log['content_id'] = $content_id;



					$activity_log['table_name'] = $table_name;



					$activity_log['from_id'] = $user_id;



					$activity_log['to_id'] = $to_id;



					$activity_log['tag'] = $tag;







					if ($favorite_status) {



						$activity_log['message'] =  $m = 'You favorite '.ucwords(trim($userName,' ')).'\'s post';



						$activity_log['message_to'] = $mTo = ucwords(trim($userNameTo,' ')).' has saved your post';



					}else{



						$activity_log['message'] =  $m = 'You unliked '.ucwords(trim($userName,' ')).'\'s post';



						$activity_log['message_to'] = $mTo = ucwords(trim($userNameTo,' ')).' has removed your post from saved list';



					}	







					



					



					$activity_logRow  = $this->common_model->get_all_details_query('activity_log',' WHERE tag = "'.$tag.'" AND content_id = "'.$content_id.'" AND from_id = "'.$user_id.'" AND to_id = "'.$to_id.'"')->row_array();



					/*if ($activity_logRow) {



						



					}else{*/



						$this->common_model->simple_insert('activity_log',$activity_log); 



						



						$toRow  = $this->common_model->get_all_details_query('vender',' WHERE id = "'.$to_id.'"')->row_array();



						$device_token = $toRow['device_id'];

                        

                        if($ro['post_admin_id'] != $user_id){

    						if ($device_token) {

    

    							

    

    							$token_log 	=  $this->common_model->get_all_details('token_log',array('user_id'=>$to_id))->result_array();

                                $query = 'SELECT token_log.*,vender.notification_status FROM `token_log` INNER JOIN vender on vender.id = token_log.user_id WHERE token_log.user_id = "'.$to_id.'"';

                                $result = $this->db->query($query);

                                $token_log =  $result->result_array();

            

    				    		$device_array= array();			

    

    							$payloaArray = array();

    

    							foreach ($token_log as $key => $value) {

    

    				    			if(!empty($value)){

    

    				    				$device_token = $value['device_id'];

    

    				    				$user_mobile_info = array($device_token);

    

    				    				if($device_token){

    

    										array_push($device_array,$value['device_id']);

    

    									}

    

    				    			}

    

    				    		}

    

    				    		$user_mobile_info = $device_array;

    

    							$payload['badge'] = 1;

    

    							$payload['sound'] = "default";

    

    							$payload['body'] = $mTo;

    

    							$payload['title']= 'StyleBuddy';

    

    							$payload['notification_type'] = 'favorite';

    							

                                if($token_log[0]['notification_status']){

    							    $noti = $this->common_model->push_notification($user_mobile_info, $payload);

                                }

    

    

    

    

    

    

    							$activity_log['multicast_id'] = $noti->multicast_id;;

    

    							$activity_log['message_id'] = json_encode($noti->results);

    

    							$activity_log['success_count'] = $noti->success;

    

    							$activity_log['error_count'] = $noti->failure;

    

    

    

    							$this->common_model->simple_insert('push_notification_activity_log',$activity_log);

    

    							

    

    						}

                        }





					//}











					$msg = 'Post removed favorite successfully';



					if ($favorite_status) {



						$msg = 'Post added favorite successfully';



					}







					$response = array(



						'status' => $a['status'],



						'message' => $msg,



						'favorite_status' => strval($favorite_status),



					);



				}else{



					$response = array(



						'status' => false,



						'message' => 'Please provide device ID , post ID & user ID',



					);



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		}



	}



	public function post_like_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$auth['access_token'] = $postData['access_token'];



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){







				$tbl_name = 'posts_like';



				$tbl_name1 = 'posts';



				$postData = $this->input->post();



				if (!empty($postData['post_id']) && !empty($postData['device_id']) && !empty($postData['user_id'])) {	



					$like_status = 1;



					$user_id = $postData['user_id'];



					$post_id = $postData['post_id'];



					$ip_address = $postData['device_id'];



					$device_type = $postData['device_type'];







					$logsData['user_id'] = $user_id;



					$logsData['like_status'] = $like_status;



					$logsData['ip_address'] = $ip_address;



					$logsData['user_agent'] = $device_type;



					$logsData['user_session_id'] = $this->session->session_id;



					$logsData['post_id'] = $post_id;







					$logsData['created_at']  = date("Y-m-d h:i:s");



					$logsData['updated_at']  = date("Y-m-d h:i:s");







					



					$row  = $this->common_model->get_all_details_query($tbl_name,' WHERE post_id = "'.$post_id.'" AND user_id = "'.$user_id.'"')->row_array();



					



					$ro  = $this->common_model->get_all_details_query($tbl_name1,' WHERE id = "'.$post_id.'"')->row_array();



					$count_like = $ro['count_like'];	



					$count_dislike = $ro['count_dislike'];	



					$like_status = 1;



					if($row){



						if ($row['like_status']) {



							$count_like = $count_like - 1;



							$count_dislike = $count_dislike + 1;



							$like_status = 0;



						}else{



							$count_like = $count_like + 1;



							if ($count_dislike) {



								$count_dislike = $count_dislike - 1;



							}



							$like_status = 1;



						}



						$j['like_status']=$like_status;



						$this->common_model->commonUpdate($tbl_name,$j,array('id'=>$row['id']));



					}else{



						$updateTrue= $this->common_model->simple_insert($tbl_name,$logsData); 



						$count_like = $count_like + 1;



					}



					$u = array();



					$u['count_like'] = $count_like;



					$u['count_dislike'] = $count_dislike;



					$this->common_model->commonUpdate($tbl_name1,$u,array('id'=>$post_id));







					$activity_log = array();



					$content_id = $post_id;



					$table_name = 'posts';



					$to_id = $ro['post_admin_id'];



					$tag = 'like';







					$userRow  = $this->common_model->get_all_details_query('vender',' WHERE id = "'.$to_id.'"')->row_array();



					$userName = $userRow['fname'].' '.$userRow['lname'];







					$userRow  = $this->common_model->get_all_details_query('vender',' WHERE id = "'.$user_id.'"')->row_array();



					$userNameTo = $userRow['fname'].' '.$userRow['lname'];







					



					



					$activity_log['content_id'] = $content_id;



					$activity_log['table_name'] = $table_name;



					$activity_log['from_id'] = $user_id;



					$activity_log['to_id'] = $to_id;



					$activity_log['tag'] = $tag;







					if ($like_status) {



						$activity_log['message'] =  $m = 'You like '.ucwords(trim($userName,' ')).'\'s post';



						$activity_log['message_to'] = $mTo = ucwords(trim($userNameTo,' ')).' liked your post';



					}else{



						$activity_log['message'] =  $m = 'You unliked '.ucwords(trim($userName,' ')).'\'s post';



						$activity_log['message_to'] = $mTo = ucwords(trim($userNameTo,' ')).' unliked your post';



					}	



					



					



					$activity_logRow  = $this->common_model->get_all_details_query('activity_log',' WHERE tag = "'.$tag.'" AND content_id = "'.$content_id.'" AND from_id = "'.$user_id.'" AND to_id = "'.$to_id.'"')->row_array();



					/*if ($activity_logRow) {



						



					}else{*/



						$this->common_model->simple_insert('activity_log',$activity_log); 



						$toRow  = $this->common_model->get_all_details_query('vender',' WHERE id = "'.$to_id.'"')->row_array();



						$device_token = $toRow['device_id'];

                        if($ro['post_admin_id'] != $user_id){

                        	if ($device_token) {

    

    							

    

    							$token_log 	=  $this->common_model->get_all_details('token_log',array('user_id'=>$to_id))->result_array();

                                $query = 'SELECT token_log.*,vender.notification_status FROM `token_log` INNER JOIN vender on vender.id = token_log.user_id WHERE token_log.user_id = "'.$to_id.'"';

                                $result = $this->db->query($query);

                                $token_log =  $result->result_array();

            

    				    		$device_array= array();			

    

    							$payloaArray = array();

    

    							foreach ($token_log as $key => $value) {

    

    				    			if(!empty($value)){

    

    				    				$device_token = $value['device_id'];

    

    				    				$user_mobile_info = array($device_token);

    

    				    				if($device_token){

    

    										array_push($device_array,$value['device_id']);

    

    									}

    

    				    			}

    

    				    		}

    

    				    		$user_mobile_info = $device_array;

    

    							$payload['badge'] = 1;

    

    							$payload['sound'] = "default";

    

    							$payload['body'] = $mTo;

    

    							$payload['title']= 'StyleBuddy';

    

    							$payload['notification_type'] = 'like';

    

    							$payload['target_id'] = $post_id;

    

    							$payload['target_url'] = 'posts';

    

    

                                if($token_log[0]['notification_status']){

    							    $noti = $this->common_model->push_notification($user_mobile_info, $payload);

                                }

    

    

    

    

    

    

    

    							$activity_log['multicast_id'] = $noti->multicast_id;;

    

    							$activity_log['message_id'] = json_encode($noti->results);

    

    							$activity_log['success_count'] = $noti->success;

    

    							$activity_log['error_count'] = $noti->failure;

    

    

    

    							$this->common_model->simple_insert('push_notification_activity_log',$activity_log);

    

    							

    

    						}



                        }



					//}











					



					$response = array(



						'status' => $a['status'],



						'message' => $a['message'],



						'like_status' => strval($like_status),



						'count_like' => strval($count_like),



						'count_dislike' => strval($count_dislike),



					);



				}else{



					$response = array(



						'status' => false,



						'message' => 'Please provide device ID , post ID & user ID',



					);



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		}



	}



	public function post_share_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$auth['access_token'] = $postData['access_token'];



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){







				$tbl_name = 'posts_share';



				$tbl_name1 = 'posts';



				$postData = $this->input->post();



				if (!empty($postData['post_id']) && !empty($postData['device_id'])) {	



					$like_status = 1;



					$user_id = $postData['user_id'];



					$post_id = $postData['post_id'];



					$ip_address = $postData['device_id'];



					$device_type = $postData['device_type'];







					$logsData['user_id'] = $user_id;



					$logsData['like_status'] = $like_status;



					$logsData['ip_address'] = $ip_address;



					$logsData['user_agent'] = $device_type;



					$logsData['user_session_id'] = $this->session->session_id;



					$logsData['post_id'] = $post_id;







					$logsData['created_at']  = date("Y-m-d h:i:s");



					$logsData['updated_at']  = date("Y-m-d h:i:s");







					$updateTrue= $this->common_model->simple_insert($tbl_name,$logsData); 







					$row  = $this->common_model->get_all_details_query($tbl_name,' WHERE post_id = "'.$post_id.'"')->row_array();



					



					$ro  = $this->common_model->get_all_details_query($tbl_name1,' WHERE id = "'.$post_id.'"')->row_array();



					$count_share = $ro['count_share'];	



					$count_share = $count_share + 1;



					$u = array();



					$u['count_share'] = $count_share;



					$this->common_model->commonUpdate($tbl_name1,$u,array('id'=>$post_id));















					$activity_log = array();



					$content_id = $post_id;



					$table_name = 'posts';



					$to_id = $ro['user_id'];



					$tag = 'share';







					$userRow  = $this->common_model->get_all_details_query('vender',' WHERE id = "'.$to_id.'"')->row_array();



					$userName = $userRow['fname'].' '.$userRow['lname'];







					$userRow  = $this->common_model->get_all_details_query('vender',' WHERE id = "'.$user_id.'"')->row_array();



					$userNameTo = $userRow['fname'].' '.$userRow['lname'];







					



					



					$activity_log['content_id'] = $content_id;



					$activity_log['table_name'] = $table_name;



					$activity_log['from_id'] = $user_id;



					$activity_log['to_id'] = $to_id;



					$activity_log['tag'] = $tag;



					$activity_log['message'] = $m ='You share '.ucwords(trim($userName,' ')).'\'s post';



					$activity_log['message_to'] = $mTo = ucwords(trim($userNameTo,' ')).' share your post';



					



					$activity_logRow  = $this->common_model->get_all_details_query('activity_log',' WHERE tag = "'.$tag.'" AND content_id = "'.$content_id.'" AND from_id = "'.$user_id.'" AND to_id = "'.$to_id.'"')->row_array();



					if ($activity_logRow) {



						



					}else{



						$this->common_model->simple_insert('activity_log',$activity_log);



						$toRow  = $this->common_model->get_all_details_query('users',' WHERE id = "'.$to_id.'"')->row_array();



						$device_token = $toRow['device_id'];



						if ($device_token) {



							



							$token_log 	=  $this->common_model->get_all_details('token_log',array('user_id'=>$to_id))->result_array();

                            $query = 'SELECT token_log.*,vender.notification_status FROM `token_log` INNER JOIN vender on vender.id = token_log.user_id WHERE token_log.user_id = "'.$to_id.'"';

                            $result = $this->db->query($query);

                            $token_log =  $result->result_array();

        

				    		$device_array= array();			



							$payloaArray = array();



							foreach ($token_log as $key => $value) {



				    			if(!empty($value)){



				    				$device_token = $value['device_id'];



				    				$user_mobile_info = array($device_token);



				    				if($device_token){



										array_push($device_array,$value['device_id']);



									}



				    			}



				    		}



				    		$user_mobile_info = $device_array;







							$payload['badge'] = 1;



							$payload['sound'] = "default";



							$payload['body'] = $mTo;



							$payload['title']= 'StyleBuddy';



							$payload['notification_type'] = 'share';

                            

                            if($token_log[0]['notification_status']){    

							    $noti = $this->common_model->push_notification($user_mobile_info, $payload);

                            }







							$activity_log['multicast_id'] = $noti->multicast_id;



							$activity_log['message_id'] = json_encode($noti->results);



							$activity_log['success_count'] = $noti->success;



							$activity_log['error_count'] = $noti->failure;



							$this->common_model->simple_insert('push_notification_activity_log',$activity_log);



						} 



					}











					



					$response = array(



						'status' => $a['status'],



						'message' => $a['message'],



						'count_share' => strval($count_share),



					);



				}else{



					$response = array(



						'status' => false,



						'message' => 'Please provide device ID , video ID',



					);



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		}



	}



	public function post_follow_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$auth['access_token'] = $postData['access_token'];



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){







				$tbl_name = 'posts_follow';



				$tbl_name1 = 'vender';



				$postData = $this->input->post();



				if (!empty($postData['post_user_id']) && !empty($postData['device_id']) && !empty($postData['user_id'])) {	



					$follow_status = 1;



					$user_id = $postData['user_id'];



					$post_user_id = $postData['post_user_id'];



					$ip_address = $postData['device_id'];



					$device_type = $postData['device_type'];







					$logsData['user_id'] = $user_id;



					$logsData['follow_status'] = $follow_status;



					$logsData['ip_address'] = $ip_address;



					$logsData['user_agent'] = $device_type;



					$logsData['user_session_id'] = $this->session->session_id;



					$logsData['post_user_id'] = $post_user_id;







					$logsData['created_at']  = date("Y-m-d h:i:s");



					$logsData['updated_at']  = date("Y-m-d h:i:s");



					



					$roUser  = $this->common_model->get_all_details_query($tbl_name1,' WHERE id = "'.$user_id.'"')->row_array();



					$count_following = $roUser['count_following'];	



					$count_unfollowing = $roUser['count_unfollowing'];



					



					$roToUser  = $this->common_model->get_all_details_query($tbl_name1,' WHERE id = "'.$post_user_id.'"')->row_array();



					$count_follow = $roToUser['count_follow'];	



					$count_unfollow = $roToUser['count_unfollow'];



					



					$follow_status = 1;	



					$following_status = 1;	



					







					$row  = $this->common_model->get_all_details_query($tbl_name,' WHERE post_user_id = "'.$post_user_id.'" AND user_id = "'.$user_id.'"')->row_array();







					 



					if($row){



						if ($row['follow_status']) {



							$count_follow = $count_follow - 1;



							$count_unfollow = $count_unfollow + 1;



							$follow_status = 0;







							$count_following = $count_following - 1;



							$count_unfollowing = $count_unfollowing + 1;



							$following_status = 0;







						}else{



							$count_follow = $count_follow + 1;



							if ($count_unfollow) {



								$count_unfollow = $count_unfollow - 1;



							}



							$follow_status = 1;



							$count_following = $count_following + 1;



							if ($count_unfollowing) {



								$count_unfollowing = $count_unfollowing - 1;



							}



							$following_status = 1;



						}



						$j['follow_status']=$follow_status;



						$j['following_status']=$following_status;



						$this->common_model->commonUpdate($tbl_name,$j,array('id'=>$row['id']));





					}else{



						$updateTrue= $this->common_model->simple_insert($tbl_name,$logsData); 



						$count_follow = $count_follow + 1;



						$count_following = $count_following + 1;



					}



					//echo $this->db->last_query();







					$u = array();



					$u['count_follow'] = $count_follow;



					$u['count_unfollow'] = $count_unfollow;



					$this->common_model->commonUpdate($tbl_name1,$u,array('id'=>$post_user_id));







					$u = array();



					$u['count_following'] = $count_following;



					$u['count_unfollowing'] = $count_unfollowing;



					$this->common_model->commonUpdate($tbl_name1,$u,array('id'=>$user_id));



					$activity_log = array();

					$content_id = $post_user_id;

					$table_name = 'posts';

					$to_id = $post_user_id;

					$tag = 'follow';

					$userName = $roUser['fname'].' '.$roUser['lname'];

					$userNameTo = $roToUser['fname'].' '.$roToUser['lname'];

					if ($follow_status) {

						$m = 'You are following '.ucwords(trim($userNameTo));

						$mTo = ucwords(trim($userName)).' is following you';

			 		}else{

			 			$m = 'You have unfollowed by '.ucwords(trim($userNameTo));

						$mTo = ucwords(trim($userName)).' unfollowed you';

			 		}



					$activity_log['content_id'] = $content_id;

					$activity_log['table_name'] = $table_name;

					$activity_log['from_id'] = $user_id;

					$activity_log['to_id'] = $to_id;

					$activity_log['tag'] = $tag;

					$activity_log['message'] = $m;

					$activity_log['message_to'] = $mTo;



					$activity_logRow  = $this->common_model->get_all_details_query('activity_log',' WHERE tag = "'.$tag.'" AND content_id = "'.$content_id.'" AND from_id = "'.$user_id.'" AND to_id = "'.$to_id.'"')->row_array();

					//if (!$activity_logRow) {

						$this->common_model->simple_insert('activity_log',$activity_log); 

						$toRow  = $this->common_model->get_all_details_query('vender',' WHERE id = "'.$to_id.'"')->row_array();

						$device_token = $toRow['device_id'];

						if ($device_token) {

							$token_log 	=  $this->common_model->get_all_details('token_log',array('user_id'=>$to_id))->result_array();

							$query = 'SELECT token_log.*,vender.notification_status FROM `token_log` INNER JOIN vender on vender.id = token_log.user_id WHERE token_log.user_id = "'.$to_id.'"';

                            $result = $this->db->query($query);

                            $token_log =  $result->result_array();

        

				    		$device_array= array();			

							$payloaArray = array();

							foreach ($token_log as $key => $value) {

				    			if(!empty($value)){

				    				$device_token = $value['device_id'];

				    				$user_mobile_info = array($device_token);

				    				if($device_token){

										array_push($device_array,$value['device_id']);

									}

				    			}

				    		}

				    		$user_mobile_info = $device_array;

							$payload['badge'] = 1;

							$payload['sound'] = "default";

							$payload['body'] = $mTo;

							$payload['title']= 'StyleBuddy';

							$payload['notification_type'] = 'follow';

							$payload['target_id'] = $content_id;;

							$payload['target_url'] = 'users';

							if($token_log[0]['notification_status']){

							    $noti = $this->common_model->push_notification($user_mobile_info, $payload);

							}

							$activity_log['multicast_id'] = $noti->multicast_id;

							$activity_log['message_id'] = json_encode($noti->results);

							$activity_log['success_count'] = $noti->success;

							$activity_log['error_count'] = $noti->failure;

							$this->common_model->simple_insert('push_notification_activity_log',$activity_log);

						}

					//}

					$roToUser  = $this->common_model->get_all_details_query($tbl_name1,' WHERE id = "'.$to_user_id.'"')->row_array();

					$count_follow = $roToUser['count_follow'];	

					$count_unfollow = $roToUser['count_unfollow'];

					$count_following = $roToUser['count_following'];	

					$count_unfollowing = $roToUser['count_unfollowing'];

					$follow_txt = 'Follow';

					if ($follow_status) {

						$follow_txt = 'Following';

					}

					$response = array(

						'status' => 'success',

						'message' => $m,

						'follow_status' => strval($follow_status),

						'follow_txt' => $follow_txt,

						'count_follow' => strval($count_follow),

						'count_following' => strval($count_following),

						'count_unfollow' => strval($count_unfollow),

						'count_unfollowing' => strval($count_unfollow),

					);

				}else{

					$response = array(

						'status' => false,

						'message' => 'Please provide device ID & user ID',

					);

				}

				$this->set_response($response, REST_Controller::HTTP_OK);

			}

			else{

				$response = array(

					'status' => $a['status'],

					'message' => $a['message'],

				);

				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);

			}

		} catch (Exception $exc) {

			$response = array(

				'status' => false,

				'message' => 'Something went wrong',

			);

			$this->set_response($response, REST_Controller::HTTP_OK);

		}

	}

	public function feedback_submit_post() {







		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$auth['access_token'] = $postData['access_token'];



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){







				if (!empty($postData['user_id'])) {



					$postData = $this->input->post();



					



					$check_content_sightengine = array();



        			$check_content_sightengine['comment'] = $postData['comment'];;



        			$dd = check_content_sightengine($check_content_sightengine);



        			if ($dd) {



        				$msg = 'Your request could not be submitted because you enter inappropriate content.';



        				$response = array(



        		                'status' => 'fail',



        		                'message' =>  $msg,



        	                );



        				$this->set_response($response, REST_Controller::HTTP_OK);



        				return;



        



        			}



					$user_id =  $postData['user_id'];



					$comment =  $postData['comment'];



					$name =  $postData['name'];



					if ($name) {



						$insert['name'] = $name;



					}



					if ($user_id) {



						$insert['user_id'] = $user_id;



					}



					if ($comment) {



						$insert['comment'] = $comment;



					}



					$insert['created_at'] = date('Y-m-d h:i:s');



					$last_id = $this->common_model->simple_insert('feedback',$insert);



                    

					



					$response = array(



						'status' => $a['status'],



						'message' => 'Thank you for your feedback.',



					);



					 



					$this->set_response($response, REST_Controller::HTTP_OK);



					return;



				}else{



					$response = array(



						'status' => false,



						'message' => 'Please provide  user ID',



					);



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		}



	}

	public function feedback_reply_submit_post() {

		try {

			$postData = $this->input->post();

			$currLanguage = $postData['current_language'];

			if (empty($currLanguage)) {

				$currLanguage = 'en' ; 

			}

			$auth['email'] = $_SERVER['PHP_AUTH_USER'];

			$auth['password'] = $_SERVER['PHP_AUTH_PW'];

			$auth['access_token'] = $postData['access_token'];

			$a = $this->check_api_auth($auth);

			if($a['status'] == 'success'){

				if (!empty($postData['user_id']) && !empty($postData['review_id'])) {

					$postData = $this->input->post();

					$check_content_sightengine = array();

        			$check_content_sightengine['comment'] = $postData['comment'];;

        			$dd = check_content_sightengine($check_content_sightengine);

        			if ($dd) {

        				$msg = 'Your request could not be submitted because you enter inappropriate content.';

        				$response = array(

        		                'status' => 'fail',

        		                'message' =>  $msg,

        	                );

        				$this->set_response($response, REST_Controller::HTTP_OK);

        				return;

        			}

					$review_id =  $postData['review_id'];

					$user_id =  $postData['user_id'];

					$comment =  $postData['comment'];

					$name =  $postData['name'];

					$post_id =  $postData['post_id'];

					

					

					if ($review_id) {

						$insert['review_id'] = $review_id;

					}

					if ($name) {

						$insert['name'] = $name;

					}

					if ($user_id) {

						$insert['user_id'] = $user_id;

					}

					if ($comment) {

						$insert['comment'] = $comment;

					}

					$insert['created_at'] = date('Y-m-d h:i:s');

					$this->common_model->simple_insert('posts_review',$insert);

					

					$tbl_name = 'posts';

					$str = " where id = '".$post_id."' ORDER by id DESC";

					$rows =  $this->common_model->get_all_details_query('posts',$str);

					$ro = $rows->row_array();

					//echo $this->db->last_query();

					$to_id = $ro['post_admin_id'];

					$toRow  = $this->common_model->get_all_details_query('vender',' WHERE id = "'.$to_id.'"')->row_array();

					$fromRow  = $this->common_model->get_all_details_query('vender',' WHERE id = "'.$user_id.'"')->row_array();

					$mTo = $fromRow['fname'].' '.$fromRow['lname'].' commented on your post';

					$m = 'You comment on '.$toRow['fname'].' '.$toRow['lname'].' post';

					$tag = 'post_feedback';

					$activity_log['table_name'] = 'posts_review';

					$activity_log['content_id'] = $lastId;

					$activity_log['from_id'] = $user_id;

					$activity_log['to_id'] = $to_id;

					$activity_log['tag'] = $tag;

					$activity_log['message'] = $m;

					$activity_log['message_to'] = $mTo;

					$this->common_model->simple_insert('activity_log',$activity_log); 



					$device_token = $toRow['device_id'];

                    if($ro['post_admin_id'] != $user_id){

    					if ($device_token) {

    						$token_log 	=  $this->common_model->get_all_details('token_log',array('user_id'=>$to_id))->result_array();

    						$query = 'SELECT token_log.*,vender.notification_status FROM `token_log` INNER JOIN vender on vender.id = token_log.user_id WHERE token_log.user_id = "'.$to_id.'"';

                            $result = $this->db->query($query);

                            $token_log =  $result->result_array();

        

    			    		$device_array= array();			

    						$payloaArray = array();

    						foreach ($token_log as $key => $value) {

    

    			    			if(!empty($value)){

    

    			    				$device_token = $value['device_id'];

    

    			    				$user_mobile_info = array($device_token);

    

    			    				if($device_token){

    

    									array_push($device_array,$value['device_id']);

    

    								}

    

    			    			}

    

    			    		}

    			    		$user_mobile_info = $device_array;

    						$payload['badge'] = 1;

    						$payload['sound'] = "default";

    						$payload['body'] = $mTo;

    						$payload['title']= 'StyleBuddy';

    						$payload['notification_type'] = 'posts_review';

    						$payload['target_id'] = $post_id;;

    						$payload['target_url'] = 'posts';

                            if($token_log[0]['notification_status']){

    						    $noti = $this->common_model->push_notification($user_mobile_info, $payload);

                            }

    						$activity_log['multicast_id'] = $noti->multicast_id;;

    						$activity_log['message_id'] = json_encode($noti->results);

    						$activity_log['success_count'] = $noti->success;

    						$activity_log['error_count'] = $noti->failure;

    						$this->common_model->simple_insert('push_notification_activity_log',$activity_log);

    					}

                    }

					$response = array(

						'status' => $a['status'],

						'message' => 'Thank you for your feedback.',

					);

					$this->set_response($response, REST_Controller::HTTP_OK);

					return;

				}else{

					$response = array(

						'status' => false,

						'message' => 'Please provide  user ID',

					);

				}

				$this->set_response($response, REST_Controller::HTTP_OK);

			}

			else{

				$response = array(

					'status' => $a['status'],

					'message' => $a['message'],

				);

				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);

			}

		} catch (Exception $exc) {

			$response = array(

				'status' => false,

				'message' => 'Something went wrong',

			);

			$this->set_response($response, REST_Controller::HTTP_OK);

		}

	}

	public function post_feedback_post() {







		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$auth['access_token'] = $postData['access_token'];



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){







				if (!empty($postData['post_id'])  && !empty($postData['user_id'])) {



					$postData = $this->input->post();



					



					$check_content_sightengine = array();



        			$check_content_sightengine['comment'] = $postData['comment'];;



        			$dd = check_content_sightengine($check_content_sightengine);



        			if ($dd) {



        				$msg = 'Your request could not be submitted because you enter inappropriate content.';



        				$response = array(



        		                'status' => 'fail',



        		                'message' =>  $msg,



        	                );



        				$this->set_response($response, REST_Controller::HTTP_OK);



        				return;



        



        			}



        			



					$user_id =  $postData['user_id'];



					$post_id =  $postData['post_id'];



					$comment =  $postData['comment'];



					$rating =  $postData['rating'];



					$name =  $postData['name'];



					$email =  $postData['email'];



					



					if ($name) {



						$insert['name'] = $name;



					}



					if ($email) {



						$insert['email'] = $email;



					}



					



					if ($user_id) {



						$insert['user_id'] = $user_id;



					}



					if ($post_id) {



						$insert['post_id'] = $post_id;



					}



					if ($comment) {



						$insert['comment'] = $comment;



					}



					if ($rating) {



						$insert['rating'] = $rating;



					}



					$insert['created_at'] = date('Y-m-d h:i:s');



					$lastId = $this->common_model->simple_insert('posts_review',$insert);



                



					$response = array(



						'status' => $a['status'],



						'message' => 'Thank You For given feedback.',



					);







					







					$tbl_name = 'posts';



					$str = " where id = '".$post_id."' ORDER by id DESC";



					$rows =  $this->common_model->get_all_details_query('posts',$str);



					$ro = $rows->row_array();



					



					$to_id = $ro['post_admin_id'];



					$toRow  = $this->common_model->get_all_details_query('vender',' WHERE id = "'.$to_id.'"')->row_array();



					$fromRow  = $this->common_model->get_all_details_query('vender',' WHERE id = "'.$user_id.'"')->row_array();



					



					$mTo = $fromRow['fname'].' '.$fromRow['lname'].' commented on your post';



					$m = 'You comment on '.$toRow['fname'].' '.$toRow['lname'].' post';











					$tag = 'post_feedback';



					$activity_log['table_name'] = 'posts_review';



					$activity_log['content_id'] = $lastId;



					$activity_log['from_id'] = $user_id;



					$activity_log['to_id'] = $to_id;



					$activity_log['tag'] = $tag;



					$activity_log['message'] = $m;



					$activity_log['message_to'] = $mTo;



					$this->common_model->simple_insert('activity_log',$activity_log); 



					



					$device_token = $toRow['device_id'];



                    if($ro['post_admin_id'] != $user_id){



    					if ($device_token) {

    

    						$token_log 	=  $this->common_model->get_all_details('token_log',array('user_id'=>$to_id))->result_array();

                            $query = 'SELECT token_log.*,vender.notification_status FROM `token_log` INNER JOIN vender on vender.id = token_log.user_id WHERE token_log.user_id = "'.$to_id.'"';

                            $result = $this->db->query($query);

                            $token_log =  $result->result_array();

        

    			    		$device_array= array();			

    

    						$payloaArray = array();

    

    						foreach ($token_log as $key => $value) {

    

    			    			if(!empty($value)){

    

    			    				$device_token = $value['device_id'];

    

    			    				$user_mobile_info = array($device_token);

    

    			    				if($device_token){

    

    									array_push($device_array,$value['device_id']);

    

    								}

    

    			    			}

    

    			    		}

    

    			    		$user_mobile_info = $device_array;

    

    

    

    						$payload['badge'] = 1;

    

    						$payload['sound'] = "default";

    

    						$payload['body'] = $mTo;

    

    						$payload['title']= 'StyleBuddy';

    

    						$payload['notification_type'] = 'posts_review';

    

    						$payload['target_id'] = $post_id;;

    

    						$payload['target_url'] = 'posts';

    

    

                            if($token_log[0]['notification_status']){

                                $noti = $this->common_model->push_notification($user_mobile_info, $payload);   

                            }

    						

    

    						$activity_log['multicast_id'] = $noti->multicast_id;;

    

    						$activity_log['message_id'] = json_encode($noti->results);

    

    						$activity_log['success_count'] = $noti->success;

    

    						$activity_log['error_count'] = $noti->failure;

    

    

    

    						$this->common_model->simple_insert('push_notification_activity_log',$activity_log);

    

    

    

    					}



                    }

					/**/ 



					$this->set_response($response, REST_Controller::HTTP_OK);



					return;



				}else{



					$response = array(



						'status' => false,



						'message' => 'Please provide Course ID & user ID',



					);



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		}



	}



	public function feedback_delete_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$a = $this->check_api_auth($postData);



			$post_id = $postData['feedback_id'];



			 







			if($a['status'] == 'success'){



				if ($post_id) {



				 



					$tbl_name = 'posts_review';



					$str = array();



					$str['id'] = $post_id;



					$rows =  $this->common_model->commonDelete($tbl_name,$str);



					 



					



					 



					$response = array(



						'status' => $a['status'],



						'message' => 'Feedback deleted successfully',



						'response' => 'Feedback deleted successfully',



					);



				}else{



					$response = array(



						'status' => false,



						'message' => 'Please provide post ID and user ID',



					);



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function report_type_list_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$auth['access_token'] = $postData['access_token'];



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				 



				$list = array(array('id'=>"Objectionable Content",'name'=>"Objectionable Content"),



                              array('id'=>"Porn Content",'name'=>"Porn Content"),



                              array('id'=>"Abusive",'name'=>"Abusive"),



                              array('id'=>"Racist",'name'=>"Racist"),



                              array('id'=>"Vulgar language used",'name'=>"Vulgar language used"),



                          );



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'response' => $list,



				);



			 



				



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		}



	}



	public function post_report_post() {







		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$auth['access_token'] = $postData['access_token'];



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){







				if (!empty($postData['post_id'])  && !empty($postData['user_id'])) {



					$website_setting = getWebsiteDetail()->row_array();



					$tbl_name = 'posts_report';



					$user_id = $postData['user_id'];



					$post_id = $postData['post_id'];	







					$row =  $this->common_model->get_all_details($tbl_name,array('post_id'=>$post_id,'user_id'=>$user_id))->row();



					if ($row) {



						$response = array(



							'status' => $a['status'],



							'message' => 'You have already report this post.',



						);



					}else{



                        $check_content_sightengine = array();



            			$check_content_sightengine['message'] = $postData['message'];;



            			$dd = check_content_sightengine($check_content_sightengine);



            			if ($dd) {



            				$msg = 'Your request could not be submitted because you enter inappropriate content.';



            				$response = array(



            		                'status' => 'fail',



            		                'message' =>  $msg,



            	                );



            				$this->set_response($response, REST_Controller::HTTP_OK);



            				return;



            



            			}



            			



						$postData['message'] = $postData['message'];



						$postData['report_type'] = $postData['report_type'];



						$postData['ip_address'] = $this->input->ip_address();



						$postData['user_agent'] = $this->input->user_agent();



						$postData['browser'] = $this->agent->browser();



						$postData['browserVersion'] = $this->agent->version();



						$postData['platform'] = $this->agent->platform();







						$insertId= $this->common_model->simple_insert($tbl_name,$postData);







						 



						$response = array(



							'status' => $a['status'],



							'message' => 'Thank you for reporting the post.',



						);



					}



					$this->set_response($response, REST_Controller::HTTP_OK);



					return;



				}else{



					$response = array(



						'status' => false,



						'message' => 'Please provide post ID & user ID',



					);



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		}



	}



	public function user_report_post() {







		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$auth['access_token'] = $postData['access_token'];



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){







				if (!empty($postData['to_user_id'])  && !empty($postData['user_id'])) {



					$website_setting = getWebsiteDetail()->row_array();



					$tbl_name = 'users_report';



					$user_id = $postData['user_id'];



					$to_user_id = $postData['to_user_id'];	







					$row =  $this->common_model->get_all_details($tbl_name,array('to_user_id'=>$to_user_id,'user_id'=>$user_id))->row();



					if ($row) {



						$response = array(



							'status' => $a['status'],



							'message' => 'You have already report this user.',



						);



					}else{



                        $check_content_sightengine = array();



            			$check_content_sightengine['message'] = $postData['message'];;



            			$dd = check_content_sightengine($check_content_sightengine);



            			if ($dd) {



            				$msg = 'Your request could not be submitted because you enter inappropriate content.';



            				$response = array(



            		                'status' => 'fail',



            		                'message' =>  $msg,



            	                );



            				$this->set_response($response, REST_Controller::HTTP_OK);



            				return;



            



            			}



            			



						$postData['message'] = $postData['message'];



						$postData['report_type'] = $postData['report_type'];



						$postData['ip_address'] = $this->input->ip_address();



						$postData['user_agent'] = $this->input->user_agent();



						$postData['browser'] = $this->agent->browser();



						$postData['browserVersion'] = $this->agent->version();



						$postData['platform'] = $this->agent->platform();







						$insertId= $this->common_model->simple_insert($tbl_name,$postData);







						 



						$response = array(



							'status' => $a['status'],



							'message' => 'Thank you for reporting the user.',



						);



					}



					$this->set_response($response, REST_Controller::HTTP_OK);



					return;



				}else{



					$response = array(



						'status' => false,



						'message' => 'Please provide user ID & to user ID',



					);



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		}



	}



	public function favorite_list_post(){



		try {



			$postData = $this->input->post();



			if (array_key_exists('current_language', $postData)) { 			     



				$currLanguage = $postData['current_language']; 			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){







				$limit = array();



				$limit['l1'] = 0;



				$limit['l2'] = 6;



				$str = ' WHERE id != 0 AND favorite_status = 1 ';



				if ($postData['user_id']) {



					$str .= ' AND user_id = '.$postData['user_id'];



				 	$str .= ' order by id desc ';



					$result 	=  $this->common_model->get_all_details_field_query('post_id','posts_favorite',$str);



					



					$num_rows = $result->num_rows();



					$list = $result->result_array();







					 







					if ($list) {



						$str = ' WHERE id != 0 ';



						$str1 .= '';



						$i=0;



						foreach ($list as $key => $value) {



							if ($value['post_id']) {



								if ($i>0) {



									$str1 .= ' OR ';



								}



								$str1 .= 'id = '.$value['post_id'];



								$i++;



							}



						}



						if (!empty($str1)) {



							$str .= ' AND ('.$str1.')';



						}



						



						$str .= ' order by id desc ';



						$tbl_name = "posts";



						$result 	=  $this->common_model->get_all_details_query($tbl_name,$str);



						$num_rows = $result->num_rows();



						$list = $result->result_array();







						/*foreach ($list as $key => $value) {



							$ab = array();



							$abc = explode(',', $value['media']);



							foreach ($abc as $k => $va) {



								$b = array();



								$b['image'] = $va;



								array_push($ab, $b);



							}



							$list[$key]['media'] = $ab;



						}*/







						foreach ($list as $key => $value) {



							$row =  $this->common_model->get_all_details_query('vender','WHERE id = '.$value['post_admin_id'])->row_array();



							$list[$key]['userRow'] = $row;



							$row = $this->common_model->get_all_details('vender',array('id'=>$value['post_admin_id']))->row();



							$list[$key]['full_name'] = $row->fname.' '.$row->lname;



							



							$follow_status = '0';



							$like_status = '0';



							$rating_status = '0';



							$block_status = '0';



							$favorite_status = '0';



							



							if ($postData['user_id']) {



								$row11 = $this->common_model->get_all_details('users_block',array('to_user_id'=>$value['post_admin_id'],'user_id'=>$postData['user_id'],'block_status'=>1))->row();



								//echo $this->db->last_query();



								if ($row11) {



									$block_status = $row11->block_status;



								}



								



								$row11 = $this->common_model->get_all_details('posts_follow',array('post_user_id'=>$value['post_admin_id'],'user_id'=>$postData['user_id']))->row();



								if ($row11) {



									$follow_status = $row11->follow_status;



								}



								$row11 = $this->common_model->get_all_details('posts_like',array('post_id'=>$value['id'],'user_id'=>$postData['user_id']))->row();



								if ($row11) {



									$like_status = $row11->like_status;



								}



								$row11 = $this->common_model->get_all_details('posts_favorite',array('post_id'=>$value['id'],'user_id'=>$postData['user_id']))->row();



								if ($row11) {



									$favorite_status = $row11->favorite_status;



								}



								$row11 = $this->common_model->get_all_details('posts_rating',array('post_id'=>$value['id'],'user_id'=>$postData['user_id']))->row();



								if ($row11) {



									$rating_status = 1;



								}



							}



							$list[$key]['follow_status'] = $follow_status;



							$list[$key]['like_status'] = $like_status;



							$list[$key]['rating_status'] = $rating_status;



							$list[$key]['block_status'] = $block_status;



							$list[$key]['favorite_status'] = $favorite_status;



							$ab = array();



							$abc = explode(',', $value['media']);



							foreach ($abc as $k => $va) {



								$b = array();



								$b['image'] = $va;



								array_push($ab, $b);



							}



							$list[$key]['media'] = $ab;



						}



					}else{







					}



				}else{



					$num_rows = 0;



					$list = array();



				}



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'num_rows' => $num_rows,



					'response' => $list,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		}



	}



	public function book_styling_session_post() {







		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$auth['access_token'] = $postData['access_token'];



			$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				$user_id	= $postData['user_id'];







				$postData['book_styling_type'] = $postData['book_styling_type'];



				$postData['book_styling_date'] = $postData['book_styling_date'];



				$postData['fashion_preferences'] = $postData['fashion_preferences'];



				$postData['book_styling_share'] = $postData['book_styling_share'];



				$postData['ip_address'] = $this->input->ip_address();



				$postData['user_agent'] = $this->input->user_agent();



				$postData['browser'] = $this->agent->browser();



				$postData['browserVersion'] = $this->agent->version();



				$postData['platform'] = $this->agent->platform();



				$postData['user_id']	= $user_id;







				 



    			$dd = check_content_sightengine($postData);



    			if ($dd) {



    				$msg = 'Your request could not be submitted because you enter inappropriate content.';



    				$response = array(



    		                'status' => 'fail',



    		                'message' =>  $msg,



    	                );



    				$this->set_response($response, REST_Controller::HTTP_OK);



    				return;



    



    			}







				$insertId= $this->common_model->simple_insert('book_styling_session',$postData);



				



				$message = 'Thank you for sending us your styling query. We have received your information and our team will get back to you soon. We have sent you a confirmation email for the same.';



				







				







				$response = array(



					'status' => $a['status'],



					'message' => $message,



				);



			 



				$this->set_response($response, REST_Controller::HTTP_OK);



                if($user_id){



                    $userRow= $this->common_model->get_all_details('vender',array('id'=>$user_id))->row_array();







    				$subject = 'Book Styling Session';



    				$option = '';



 



     



                    

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

    				$mailContent =  mailHtmlHeader_New($this->site);



    				    $mailContent .= $option;

                        $mailContent .= '<div class="common_w" style="padding:20px 20px;text-align:center;background:#FFFA00;"><b>Book Styling Session</b></div>';

                            





                        $mailContent .= '<div style="clear: both;"></div>';



    



                        $mailContent .= '<div class="common_w meddle_content" style="padding:30px 40px;background:#fff;width:100%">';



    



                            $mailContent .= '<h4>'.ucwords($userRow['fname'].' '.$userRow['lname']).', Thank you for book styling session from Stylebuddy</h4>';



                            $mailContent .= $message;



                        $mailContent .= '</div>';



                    $mailContent .= mailHtmlFooter_New_2($this->site);



                    



                    $to      =  $userRow['email'];



                    //$to      =  'vijay@gleamingllp.com';



                    $from = FROM_EMAIL;



                    $from_name = $this->site->site_name;



                    $cc = CC_EMAIL;



                    $reply = REPLY_EMAIL;

                    

                    

                    /*$emailRow= $this->common_model->get_all_details('vender',array('email'=>$to,'email_notification_status'=>1))->row_array();

                    if($emailRow){

                           

                    }*/

                    $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $attach=''); 



    



                }



				







				return;



				 



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		}



	}







	public function account_delete_post() {



		try {



			$auth['email'] = $_SERVER['PHP_AUTH_USER'];



			$auth['password'] = $_SERVER['PHP_AUTH_PW'];



			$postData = $this->input->post();



			$a = $this->check_api_auth($auth);



			/*$tabls = $this->db->query('SHOW TABLES');



			var_dump($tabls->result());



			var_dump($tabls);



			die;*/



			if($a['status'] == 'success'){



				if ($postData['user_id']) {



					$id = $postData['user_id'];



					$this->common_model->commonDelete('vender',array('id'=>$id));	



					$this->common_model->commonDelete('posts',array('post_admin_id'=>$id));	



					$this->common_model->commonDelete('posts_favorite',array('user_id'=>$id));



					$this->common_model->commonDelete('posts_follow',array('user_id'=>$id));



					$this->common_model->commonDelete('posts_like',array('user_id'=>$id));



					$this->common_model->commonDelete('posts_rating',array('user_id'=>$id));



					$this->common_model->commonDelete('posts_report',array('user_id'=>$id));

					

					$this->common_model->commonDelete('users_report',array('user_id'=>$id));



					$this->common_model->commonDelete('posts_review',array('user_id'=>$id));



					$this->common_model->commonDelete('posts_share',array('user_id'=>$id));



					$this->common_model->commonDelete('posts_view',array('user_session_id'=>$id));







					$response = array(



						'status' => $a['status'],



						'response' => 1,



						'message' => $a['message'],



						 



					);



				}else{



					$response = array(



						'status' => $a['status'],



						'response' => 'error',



						'message' => 'User not exist',



						 



					);



				}



				 



				



			}else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					 



				);



			}



			$this->set_response($response, REST_Controller::HTTP_OK);



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function search_user_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$a = $this->check_api_auth($postData);



			if($a['status'] == 'success'){



				$tbl_name = 'vender';







				$str = " Where user_type=3";



				if ($postData['search_text']) {



					$str .= " AND (fname LIKE '".$postData['search_text']."%' OR lname LIKE '".$postData['search_text']."%') ";



				}



				



				$str .= " ORDER by fname DESC";



				$rows =  $this->common_model->get_all_details_query($tbl_name,$str);



				$list = $rows->result_array();



				foreach ($list as $key => $value) {



					$block_status = '0';



					if ($postData['user_id']) {



						$row11 = $this->common_model->get_all_details('users_block',array('to_user_id'=>$value['id'],'user_id'=>$postData['user_id'],'block_status'=>1))->row();



						if ($row11) {



							$block_status = $row11->block_status;



						}



					}



					$list[$key]['block_status'] = $block_status;



				}



				$data['numRows-1'] = count($list); 



				



				$ab = array();



				foreach ($list as $key => $value) {



					if ($value['block_status']==0) {



						array_push($ab,$value);



						unset($list[$key]);



					}







				}



				$data['numRows'] = count($ab); 



				$data['posts'] = $ab; 



				 



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'response' => $data,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}







	public function search_posts_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$a = $this->check_api_auth($postData);



			if($a['status'] == 'success'){



				$tbl_name = 'posts';







				$str = " Where id!=0 AND media != '' ";

				$str = " Where id!=0 ";



				if ($postData['search_text']) {

                    $str .= " AND (title LIKE '%".$postData['search_text']."%' OR description LIKE '%".$postData['search_text']."%' OR post_category LIKE '%".$postData['search_text']."%' OR post_type LIKE '%".$postData['search_text']."%') ";



				}



				



				$str .= " ORDER by title DESC";



				$rows =  $this->common_model->get_all_details_query($tbl_name,$str);



				$list = $rows->result_array();



				foreach ($list as $key => $value) {



					$row =  $this->common_model->get_all_details_query('vender','WHERE id = '.$value['post_admin_id'])->row_array();



					$list[$key]['userRow'] = $row;



					$row = $this->common_model->get_all_details('vender',array('id'=>$value['post_admin_id']))->row();



					$list[$key]['full_name'] = $row->fname.' '.$row->lname;



					



					$follow_status = '0';



					$like_status = '0';



					$rating_status = '0';



					$block_status = '0';



					$favorite_status = '0';



					



					if ($postData['user_id']) {



						$row11 = $this->common_model->get_all_details('users_block',array('to_user_id'=>$value['post_admin_id'],'user_id'=>$postData['user_id'],'block_status'=>1))->row();



						//echo $this->db->last_query();



						if ($row11) {



							$block_status = $row11->block_status;



						}



						



						$row11 = $this->common_model->get_all_details('posts_follow',array('post_user_id'=>$value['post_admin_id'],'user_id'=>$postData['user_id']))->row();



						if ($row11) {



							$follow_status = $row11->follow_status;



						}



						$row11 = $this->common_model->get_all_details('posts_like',array('post_id'=>$value['id'],'user_id'=>$postData['user_id']))->row();



						if ($row11) {



							$like_status = $row11->like_status;



						}



						$row11 = $this->common_model->get_all_details('posts_favorite',array('post_id'=>$value['id'],'user_id'=>$postData['user_id']))->row();



						if ($row11) {



							$favorite_status = $row11->favorite_status;



						}



						$row11 = $this->common_model->get_all_details('posts_rating',array('post_id'=>$value['id'],'user_id'=>$postData['user_id']))->row();



						if ($row11) {



							$rating_status = 1;



						}



					}



					$list[$key]['follow_status'] = $follow_status;



					$list[$key]['like_status'] = $like_status;



					$list[$key]['rating_status'] = $rating_status;



					$list[$key]['block_status'] = $block_status;



					$list[$key]['favorite_status'] = $favorite_status;



					$ab = array();



					$abc = explode(',', $value['media']);



					foreach ($abc as $k => $va) {



						$b = array();



						$b['image'] = $va;



						array_push($ab, $b);



					}



					$list[$key]['media'] = $ab;



				}



				$data['numRows-1'] = count($list); 



				



				$ab = array();



				foreach ($list as $key => $value) {



					if ($value['block_status']==0) {



						array_push($ab,$value);



						unset($list[$key]);



					}







				}



				$data['numRows'] = count($ab); 



				$data['posts'] = $ab;







				$str = " Where id!=0 AND (media = '' OR media IS NULL) ";



				if ($postData['search_text']) {



					$str .= " AND (title LIKE '%".$postData['search_text']."%' OR description LIKE '%".$postData['search_text']."%' OR post_category LIKE '%".$postData['search_text']."%' OR post_type LIKE '%".$postData['search_text']."%') ";



				}



				



				$str .= " ORDER by title DESC";



				$rows =  $this->common_model->get_all_details_query($tbl_name,$str);



				$list = $rows->result_array();



				foreach ($list as $key => $value) {



					$row =  $this->common_model->get_all_details_query('vender','WHERE id = '.$value['post_admin_id'])->row_array();



					$list[$key]['userRow'] = $row;



					$row = $this->common_model->get_all_details('vender',array('id'=>$value['post_admin_id']))->row();



					$list[$key]['full_name'] = $row->fname.' '.$row->lname;



					



					$follow_status = '0';



					$like_status = '0';



					$rating_status = '0';



					$block_status = '0';



					$favorite_status = '0';



					



					if ($postData['user_id']) {



						$row11 = $this->common_model->get_all_details('users_block',array('to_user_id'=>$value['post_admin_id'],'user_id'=>$postData['user_id'],'block_status'=>1))->row();



						//echo $this->db->last_query();



						if ($row11) {



							$block_status = $row11->block_status;



						}



						



						$row11 = $this->common_model->get_all_details('posts_follow',array('post_user_id'=>$value['post_admin_id'],'user_id'=>$postData['user_id']))->row();



						if ($row11) {



							$follow_status = $row11->follow_status;



						}



						$row11 = $this->common_model->get_all_details('posts_like',array('post_id'=>$value['id'],'user_id'=>$postData['user_id']))->row();



						if ($row11) {



							$like_status = $row11->like_status;



						}



						$row11 = $this->common_model->get_all_details('posts_favorite',array('post_id'=>$value['id'],'user_id'=>$postData['user_id']))->row();



						if ($row11) {



							$favorite_status = $row11->favorite_status;



						}



						$row11 = $this->common_model->get_all_details('posts_rating',array('post_id'=>$value['id'],'user_id'=>$postData['user_id']))->row();



						if ($row11) {



							$rating_status = 1;



						}



					}



					$list[$key]['follow_status'] = $follow_status;



					$list[$key]['like_status'] = $like_status;



					$list[$key]['rating_status'] = $rating_status;



					$list[$key]['block_status'] = $block_status;



					$list[$key]['favorite_status'] = $favorite_status;



					$ab = array();



					$abc = explode(',', $value['media']);



					foreach ($abc as $k => $va) {



						$b = array();



						$b['image'] = $va;



						array_push($ab, $b);



					}



					$list[$key]['media'] = $ab;



				}



				$data['text-numRows'] = count($list); 



				



				$ab = array();



				foreach ($list as $key => $value) {



					if ($value['block_status']==0) {



						array_push($ab,$value);



						unset($list[$key]);



					}







				}



				$data['text_numRows'] = count($ab); 



				$data['text_posts'] = $ab;  



				



				$tbl_name = 'vender';



				$str = " Where user_type=3";



				if ($postData['search_text']) {



					$str .= " AND (fname LIKE '".$postData['search_text']."%' OR lname LIKE '".$postData['search_text']."%') ";



				}



				



				$str .= " ORDER by fname DESC";



				$rows =  $this->common_model->get_all_details_query($tbl_name,$str);



				$list = $rows->result_array();



				foreach ($list as $key => $value) {



					$block_status = '0';



					if ($postData['user_id']) {



						$row11 = $this->common_model->get_all_details('users_block',array('to_user_id'=>$value['id'],'user_id'=>$postData['user_id'],'block_status'=>1))->row();



						if ($row11) {



							$block_status = $row11->block_status;



						}



					}



					$list[$key]['block_status'] = $block_status;



				}



				$data['usersNumRows-1'] = count($list); 



				



				$ab = array();



				foreach ($list as $key => $value) {



					if ($value['block_status']==0) {



						array_push($ab,$value);



						unset($list[$key]);



					}







				}



				$data['usersNumRows'] = count($ab); 



				$data['users'] = $ab; 



				



				$tbl_name = 'products';



				$str = " Where status = 1 and vendor_status = 1 and admin_status = 1 ";



				if ($postData['search_text']) {



					$str .= " AND (product_name LIKE '".$postData['search_text']."%') ";



				}



				



				$str .= " ORDER by product_name ASC";



				$rows =  $this->common_model->get_all_details_query($tbl_name,$str);



				$data['productsNumRows'] = $rows->num_rows(); 



				$list = $rows->result_array();



				$data['products'] = $list; 



				



				$tbl_name = 'our_services';



				$str = " Where status = 1 ";



				if ($postData['search_text']) {



					$str .= " AND (title LIKE '".$postData['search_text']."%') ";



				}



				



				$str .= " ORDER by title ASC";



				$rows =  $this->common_model->get_all_details_query($tbl_name,$str);



				$data['servicesNumRows'] = $rows->num_rows(); 



				$list = $rows->result_array();



				$data['services'] = $list; 



				



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'response' => $data,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function notificaton_update_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$a = $this->check_api_auth($postData);



			if($a['status'] == 'success'){



				$tbl_name = 'vender';



				$user_id = $postData['user_id'];



				 







				$insert_data 				= array();



				$notification_status = 1;



				if ($postData['notification_status'] == '1') {



					$notification_status = 0;



				}



				$email_notification_status = 1;



				if ($postData['email_notification_status'] == '1') {



					$email_notification_status = 0;



				}



				$insert_data['notification_status']	= $notification_status;



				$insert_data['email_notification_status']	= $email_notification_status;











				$uRow = $this->common_model->commonUpdate($tbl_name,$insert_data,array('id'=>$user_id));







				 



				$response = array(



					'status' => $a['status'],



					'message' => 'Notification status changed.',



					'response' => $uRow,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function test_FCM_post() {



		try {



			$postData = $this->input->post();



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				$device_token = $postData['device_id'];







				$user_role['device_id'] = $device_token;



				$row = $this->common_model->get_all_details('token_log',$user_role)->row();



				if (!$row) {



					$device_type = 'iOS';



					if ($postData['device_type']) {



						$device_type = $postData['device_type'];



					}



					$user_role['device_type'] = $device_type;



					$user_role['ip_address'] = $this->input->ip_address();



					$user_role['user_agent'] = $this->input->user_agent();



					$this->common_model->simple_insert('token_log',$user_role);



				}



				



				if ($device_token) {



					$device_token = "cg33beX2v0N7t2AfxXBW_4:APA91bFuEAIRbAbeo49reMQZpBhW4KcLFHNDQl_SwRWj0jnevEqE6xfObsqXnjbGqqSf1uK_HopPasETFVLRgWyt5OEhQYp5PkT0KLrbWznNbwVO_r6mIXjwUtsBs3dZ3wisTJNPcsn2";







					$user_mobile_info = array($device_token);



					$payload['badge'] = 1;



					$payload['sound'] = "default";



					$payload['body']="Stylebuddy is the right platform for you to show your talent and get noticed.";



					$payload['title']="StyleBuddy";



					$payload['notification_type'] = 'New Test';

                    if($token_log[0]['notification_status']){

					    $noti = $this->common_model->push_notification($user_mobile_info, $payload);

                    }

					 



					$activity_log['multicast_id'] = $noti->multicast_id;;



					$activity_log['message_id'] = json_encode($noti->results);



					$activity_log['success_count'] = $noti->success;



					$activity_log['error_count'] = $noti->failure;







					$this->common_model->simple_insert('push_notification_activity_log',$activity_log);



					



					$response = array(



						'status' => $a['status'],



						'payload' => $payload,



						'response' => $response,



						'device_token' => $device_token,



					);



				}else{



					$response = array(



						'status' => $a['status'],



						'message' => 'Please enter device id',



						'response' => array(),



					);



				}



				



			}else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					 



				);



			}



			$this->set_response($response, REST_Controller::HTTP_OK);



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function notifications_post___() {



		try {



			$postData = $this->input->post();



			if (array_key_exists('current_language', $postData)) {



			    $currLanguage = $postData['current_language']; 			



			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				$wh = 'where id != 0 ';



				if ($postData['user_id']) {



					$wh .= ' AND to_id = "'.$postData['user_id'].'" ';



					$wh .= ' ORDER BY id DESC';



					$list1 = $this->common_model->get_all_details_query('push_notification_activity_log',$wh)->result_array();



					



					$wh = 'where id != 0 ';



					$wh .= ' AND notification_id !=0 ';



					$wh .= ' ORDER BY id DESC';



					$list2 = $this->common_model->get_all_details_query('push_notification_activity_log',$wh)->result_array();



					$list  = array_merge($list1,$list2);



				}else{



					$wh = 'where id != 0 ';



					$wh .= ' AND notification_id !=0 ';



					$wh .= ' ORDER BY id DESC';



					$list = $this->common_model->get_all_details_query('push_notification_activity_log',$wh)->result_array();



				}



				



				//var_dump($list);



				foreach ($list as $key => $value) {



					$content_id = $value['content_id'];



					



					if ($value['tag'] == 'post_feedback') {



						$r = $this->common_model->get_all_details('posts_review',array('id'=>$content_id))->row_array();



						$list[$key]['target_id'] = $r['post_id'];



						$list[$key]['target_url'] = 'posts';



					}else if ($value['tag'] == 'follow') {



						$list[$key]['target_id'] = $content_id;



						$list[$key]['target_url'] = 'users';



					}else if ($value['tag'] == 'like') {



						$list[$key]['target_id'] = $content_id;



						$list[$key]['target_url'] = 'posts';



					}else{



						$list[$key]['target_id'] = '';



						$list[$key]['target_url'] = '';



					}



				}

                foreach ($list as $key => $value) {

					$content_id = $value['content_id'];

					$table_name = $value['table_name'];

					$from_id = $value['from_id'];



					$list[$key]['reviewFrom']=null;

					$list[$key]['user_image']=null;

					$list[$key]['user_name_full']=null;

					if ($content_id && $table_name) {

						$r1 = $this->common_model->get_all_details($table_name,array('id'=>$content_id))->row_array();

						$list[$key]['reviewFrom']=$r1;

					}

					if ($from_id) {

						$r2 = $this->common_model->get_all_details('vender',array('id'=>$from_id))->row_array();

						

						$list[$key]['user_name_full']=$r2['fname'].' '.$r2['lname'];

						$list[$key]['user_image']=($r2['image'])?base_url('assets/images/vandor/'.$r2['image']):null;

					}

				}

				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'num' => count($list),



					'response' => $list,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}

    public function notifications_post() {



		try {



			$postData = $this->input->post();



			if (array_key_exists('current_language', $postData)) {



			    $currLanguage = $postData['current_language']; 			



			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				$wh = 'where id != 0 ';



				if ($postData['user_id']) {



					$wh .= ' AND to_id = "'.$postData['user_id'].'" ';



					$wh .= ' ORDER BY id DESC';



					$list1 = $this->common_model->get_all_details_query('push_notification_activity_log',$wh)->result_array();



					



					$wh = 'where id != 0 ';



					$wh .= ' AND notification_id !=0  AND message !="" AND message_to !=""';



					$wh .= ' ORDER BY id DESC';



					$list2 = $this->common_model->get_all_details_query('push_notification_activity_log',$wh)->result_array();



					$list  = array_merge($list1,$list2);



				}else{



					$wh = 'where id != 0 ';



					$wh .= ' AND notification_id !=0 AND message !="" AND message_to !="" ';



					$wh .= ' ORDER BY id DESC';



					$list = $this->common_model->get_all_details_query('push_notification_activity_log',$wh)->result_array();



				}



				



				//var_dump($list);



				foreach ($list as $key => $value) {



					$content_id = $value['content_id'];



					



					if ($value['tag'] == 'post_feedback') {



						$r = $this->common_model->get_all_details('posts_review',array('id'=>$content_id))->row_array();



						$list[$key]['target_id'] = $r['post_id'];



						$list[$key]['target_url'] = 'posts';



					}else if ($value['tag'] == 'follow') {



						$list[$key]['target_id'] = $content_id;



						$list[$key]['target_url'] = 'users';



					}else if ($value['tag'] == 'like') {



						$list[$key]['target_id'] = $content_id;



						$list[$key]['target_url'] = 'posts';



					}else{



						$list[$key]['target_id'] = '';



						$list[$key]['target_url'] = '';



					}



				}

                foreach ($list as $key => $value) {

					$content_id = $value['content_id'];

					$table_name = $value['table_name'];

					$from_id = $value['from_id'];



					$list[$key]['reviewFrom']=null;

					$list[$key]['user_image']=null;

					$list[$key]['user_name_full']=null;

					if ($content_id && $table_name) {

						$r1 = $this->common_model->get_all_details($table_name,array('id'=>$content_id))->row_array();

						$list[$key]['reviewFrom']=$r1;

					}

					if ($from_id) {

						$r2 = $this->common_model->get_all_details('vender',array('id'=>$from_id))->row_array();

						

						$list[$key]['user_name_full']=$r2['fname'].' '.$r2['lname'];

						$list[$key]['user_image']=($r2['image'])?base_url('assets/images/vandor/'.$r2['image']):null;

					}

				}

				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'num' => count($list),



					'response' => $list,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}

	public function followers_post() {



		try {



			$postData = $this->input->post();



			if (array_key_exists('current_language', $postData)) {



			    $currLanguage = $postData['current_language']; 			



			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				if ($postData['user_id']) {



				 	$user_id = $postData['user_id'];



				 	$keyId = 'post_user_id';



					$wh = 'where follow_status = 1 AND '.$keyId.' = "'.$user_id.'" ';



					$wh .= ' ORDER BY id DESC';



					$list = $this->common_model->get_all_details_query('posts_follow',$wh)->result_array();

                    //echo $this->db->last_query();

					



					$wh = 'where id != 0 ';



					$keyId = 'user_id';



					$userIdArray = array();



					$i=0;



					$wh1 = '';



					foreach ($list as $key => $value) {



						$iid = $value[$keyId];



						if (!in_array($iid, $userIdArray)) {



							array_push($userIdArray,$iid);



							if ($i!=0) {



								$wh1 .= ' OR ';



							}



							$wh1 .= ' id = "'.$iid.'"';



							$i++;



						}



					}



					if ($wh1) {



						$wh .= ' AND ('.$wh1.')';



						$wh .= ' ORDER BY id DESC';



						$list = $this->common_model->get_all_details_query('vender',$wh)->result_array();



						



						$response = array(



							'status' => $a['status'],



							'message' => $a['message'],



							'num' => count($list),



							'response' => $list,



						);



					}else{



						$response = array(



							'status' => $a['status'],



							'message' => $a['message'],



							'num' => 0,



							'response' => array(),



						);



						



					}



					



				}else{



					$response = array(



						'status' => $a['status'],



						'message' => 'Please enter userId',



					);



					



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function following_post() {



		try {



			$postData = $this->input->post();



			if (array_key_exists('current_language', $postData)) {



			    $currLanguage = $postData['current_language']; 			



			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				if ($postData['user_id']) {



				 	$user_id = $postData['user_id'];



				 	$keyId = 'user_id';



					$wh = 'where following_status = 1 AND '.$keyId.' = "'.$user_id.'" ';



					$wh .= ' ORDER BY id DESC';



					$list = $this->common_model->get_all_details_query('posts_follow',$wh)->result_array();



					



					$wh = 'where id != 0 ';



					



					



					$keyId = 'post_user_id';



					$userIdArray = array();



					$i=0;



					$wh1 = '';



					foreach ($list as $key => $value) {



						$iid = $value[$keyId];



						if (!in_array($iid, $userIdArray)) {



							array_push($userIdArray,$iid);



							if ($i!=0) {



								$wh1 .= ' OR ';



							}



							$wh1 .= ' id = "'.$iid.'"';



							$i++;



						}



					}



					if ($wh1) {



						$wh .= ' AND ('.$wh1.')';



						$wh .= ' ORDER BY id DESC';



						$list = $this->common_model->get_all_details_query('vender',$wh)->result_array();



						



						$response = array(



							'status' => $a['status'],



							'message' => $a['message'],



							'num' => count($list),



							'response' => $list,



						);



					}else{



						$response = array(



							'status' => $a['status'],



							'message' => $a['message'],



							'num' => 0,



							'response' => array(),



						);



						



					}



				}else{



					$response = array(



						'status' => $a['status'],



						'message' => 'Please enter userId',



					);



					



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function recursive($tbl_name,$k,$parent_id) {



        $rs = $this->common_model->get_all_details($tbl_name,array('parent_id'=>$parent_id,'status'=>1))->result_array();



        if($rs){



            foreach($rs as $key=>$value){



                $rs[$key]['child'] = $this->recursive($tbl_name,$k,$value['id']);



            }



        }else{



            $rs = array();



        }



        return $rs;



    }



	public function uploadSingleImage($filename,$path){



        $files = $_FILES;



        $timeImg = '';



        if(!empty($_FILES[$filename]['name'])){



            $tempFile = $files[$filename]['tmp_name'];



            //$temp = $files[$filename]["name"];



            $temp = strtolower(basename($files[$filename]["name"]));



            $path_parts = pathinfo($temp);



            $t =  time();



            $ImageName = 'image'. $t . '.' . $path_parts['extension'];



            $targetFile = $path . $ImageName ;



            move_uploaded_file($tempFile, $targetFile);



             



            $p = str_replace('uploads/','',$path);



            //return trim($p.$ImageName);



            return trim($ImageName);



        }



        



    }



    public function uploadMultipleImage($filename,$path){



        if(is_array($_FILES[$filename]['name'])){



            $cpt = count($_FILES[$filename]);



            $ImageName = '';



            $timeImg = '';



            for($i=0; $i<$cpt; $i++){



                if(!empty($_FILES[$filename]['name'][$i])){



                    $tempFile = $_FILES[$filename]['tmp_name'][$i];



                    //$temp = $_FILES[$filename]['name'][$i];



                    $temp = strtolower(basename($_FILES[$filename]["name"][$i]));



                    $path_parts = pathinfo($temp);



                    $t =  time();



                    $fileName_ = 'img_'.$i.'_'. $t . '.' . $path_parts['extension'];



                    $targetFile = $path . $fileName_ ;



                    move_uploaded_file($tempFile, $targetFile);



                     



                    $p = str_replace('uploads/','',$path);



                    //$ImageName .= ','.$p.$fileName_;



                    $ImageName .= ','.$fileName_;



                }



            }



            return trim($ImageName,',');



        }else{



            $files = $_FILES;



            if(!empty($_FILES[$filename]['name'])){



                $tempFile = $_FILES[$filename]['tmp_name'];



                $temp = $_FILES[$filename]["name"];



                $path_parts = pathinfo($temp);



                $t =  time();



                $ImageName = 'imgs_'. $t . '.' . $path_parts['extension'];



                $targetFile = $path . $ImageName ;



                move_uploaded_file($tempFile, $targetFile);



                $p = str_replace('uploads/','',$path);  



                //return trim($p.$ImageName);



                return trim($ImageName);



            }



        }



    }



    



	public function shop_category_post() {



		try {



			$postData = $this->input->post();



			if (array_key_exists('current_language', $postData)) {



			    $currLanguage = $postData['current_language']; 			



			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				$wh = ' WHERE parent_id = 0 and status= 1 order by ui_order ASC';



		        $rows = $this->common_model->get_all_details_query('category',$wh)->result_array();



		        foreach ($rows as $k => $v) {



		            $rs = array();



		            $wh1 = ' WHERE parent_id = '.$v['id'].' and status= 1 order by ui_order ASC';



		            $rs = $this->common_model->get_all_details_query('category',$wh1)->result_array();



		            $rows[$k]['child'] = $rs;



		            foreach($rs as $k1=>$v1){



		                $rows[$k]['child'][$k1]['child']  = $this->recursive('category',$k1,$v1['id']);



		            }



		        }



		         



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'num' => count($rows),



					'response' => $rows,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function featured_category_post() {



		try {



			$postData = $this->input->post();



			if (array_key_exists('current_language', $postData)) {



			    $currLanguage = $postData['current_language']; 			



			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				$wh = ' WHERE featured = 1  and status= 1 order by ui_order ASC';



		        $rows = $this->common_model->get_all_details_query('category',$wh)->result_array();



		        $response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'num' => count($rows),



					'response' => $rows,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function shop_category_detail_post() {



		try {



			$postData = $this->input->post();



			if (array_key_exists('current_language', $postData)) {



			    $currLanguage = $postData['current_language']; 			



			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				if($postData['cat_id']){



				



					$cat_id = $postData['cat_id'];



					$wh = ' WHERE id = "'.$cat_id.'" and status= 1 order by ui_order ASC';



			        $v = $this->common_model->get_all_details_query('category',$wh)->row_array();



			        



			        $rs = array();



			        if($v['id']){



    			        $wh1 = ' WHERE parent_id = '.$v['id'].' and status= 1 order by ui_order ASC';



    		            $rs = $this->common_model->get_all_details_query('category',$wh1)->result_array();



		            }



			        



		            $v['child'] = $rs;



		            foreach($rs as $k1=>$v1){



		                $v['child'][$k1]['child']  = $this->recursive('category',$k1,$v1['id']);



		            }







			        $response = array(



						'status' => $a['status'],



						'message' => $a['message'],



						'response' => $v,



					);



				}



				else{



					$response = array(



						'status' => $a['status'],



						'message' => 'Please provide category id',



					);



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}







	public function products_post(){



		try {



			$postData = $this->input->post();



			$getData = $this->input->get();



			if (array_key_exists('current_language', $postData)) {



			    $currLanguage = $postData['current_language']; 			



			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				$query = "select * from products where status = 1 and vendor_status = 1 and admin_status = 1 ";



        



				$where_in = '';



		        if ($postData['search_text']) {



		            $catid =  $postData['search_text'];



		            $str = '';



			        



		            $str .= ' product_name LIKE  "'.$catid.'%"' ;



			         



		            if ($str) {



		            	$query .= " AND (". $str.") ";



		            }



		        }



		        



		        if ($postData['price']) {



		            $catid =  $postData['price'];



		            $str = '';



			        if (is_array($catid)) {



			            $i=0;



			            foreach ($catid as $key => $value) {



			                if ($i>0) {



			                    $str .= ' OR '; 



			                }



			                $f = explode('-',$value);



			                if(strtoupper($f[1]) == 'ABOVE'){



			                    $str .= ' ( price >= "'.$f[0].'" AND price <= "100000") ' ;



			                }else{



			                    $str .= ' ( price >= "'.$f[0].'" AND price <= "'.$f[1].'") ' ;



			                }



			                $i++;



			            }



			        }else{



			        	$f = explode('-',$catid);



			        	if(strtoupper($f[1]) == 'ABOVE'){



		                    $str .= ' ( price >= "'.$f[0].'" AND price <= "100000") ' ;



		                }else{



		                    $str .= ' ( price >= "'.$f[0].'" AND price <= "'.$f[1].'") ' ;



		                }



			        }



		            if ($str) {



		            	$query .= " AND (". $str.") ";



		            }



		        }



		        



		        if ($postData['discount']) {



		            $catid =  $postData['discount'];



		            $str = '';



			        if (is_array($catid)) {



			            $i=0;



			            foreach ($catid as $key => $value) {



			                if ($i>0) {



			                    $str .= ' OR '; 



			                }



			                $f = explode('-',$value);



			                if(strtoupper($f[1]) == 'ABOVE'){



			                    $str .= ' ( discount >= "'.$f[0].'" AND discount <= "100000") ' ;



			                }else{



			                    $str .= ' ( discount >= "'.$f[0].'" AND discount <= "'.$f[1].'") ' ;



			                }



			                $i++;



			            }



			        }else{



			        	$f = explode('-',$catid);



			            if(strtoupper($f[1]) == 'ABOVE'){



		                    $str .= ' ( discount >= "'.$f[0].'" AND discount <= "100000") ' ;



		                }else{



		                    $str .= ' ( discount >= "'.$f[0].'" AND discount <= "'.$f[1].'") ' ;



		                }



			        }



		            if ($str) {



		            	$query .= " AND (". $str.") ";



		            }



		        }



		        



		        if ($postData['size']) {



		            $catid =  $postData['size'];



		            $str = '';



		            if (is_array($catid)) {



		                $i=0;



		                foreach ($catid as $key => $value) {



		                    if ($i>0) {



		                        $str .= ' OR '; 



		                    }



		                    $str .= ' FIND_IN_SET("'.$value.'",size) ';



		                    $i++;



		                }



		            }else{



		                $str .= ' FIND_IN_SET("'.$catid.'",size) ';



		            }



		            if ($str) {



		            	$query .= " AND (". $str.") ";



		            }



		        }



		        



		        if ($postData['cat_id']) {



		            $catid =  $postData['cat_id'];



		            if (is_array($catid)) {



		                $i=0;



		                $str = '';



		                foreach ($catid as $key => $value) {



		                    if ($i>0) {



		                        $str .= ' OR '; 



		                    }



		                    $str .= ' FIND_IN_SET("'.$value.'",cat_id)';



		                    $i++;



		                }



		                if ($str) {



			            	$query .= " AND (". $str.") ";



			            }



		            }else{



		                $wh = ' WHERE parent_id = '.$catid.' order by ui_order ASC';



		                $rowsCatF = $this->common_model->get_all_details_query('category',$wh)->result_array();



		                foreach ($rowsCatF as $k => $v) {



		                    $rs = array();



		                    $wh1 = ' WHERE parent_id = '.$v['id'].' order by ui_order ASC';



		                    $rs = $this->common_model->get_all_details_query('category',$wh1)->result_array();



		                    $rowsCatF[$k]['child'] = $rs;



		                    foreach($rs as $k1=>$v1){



		                        $rowsCatF[$k]['child'][$k1]['child']  = $this->recursive('category',$k1,$v1['id']);



		                    }



		                }



		                if ($rowsCatF) {



		                    $i=0;



		                    $str = '';



		                    foreach ($rowsCatF as $key => $value) {



		                        if ($i>0) {



		                            $str .= ' OR '; 



		                        }



		                        $str .= ' cat_id = '.$value['id'];



		                        foreach ($value['child'] as $key1 => $value1) {



		                            $str .= ' OR '; 



		                            $str .= ' cat_id = '.$value1['id'];



		                            foreach ($value1['child'] as $key2 => $value2) {



		                                $str .= ' OR '; 



		                                $str .= ' cat_id = '.$value2['id'];



		                                $i++;



		                            }



		                            $i++;



		                        }



		                        $i++;



		                    }



		                    if ($str) {



		                        $query .= " AND (". $str." OR  FIND_IN_SET(".$catid.",cat_id) ) ";



		                        //$query .= " AND (". $str." OR cat_id = ".$catid.") ";



		                    }



		                }else{



		                    $query .= ' AND FIND_IN_SET("'.$catid.'",cat_id)';



		                    //$query .= " AND cat_id = ". $catid;



		                }



		            }



		        }



		        



		        $sortBy = ' order by id desc';



		        if ($postData['orderBy']) {



		            $ss = explode('-',$postData['orderBy']);



		            $sortBy = ' order by '.$ss[1].' '.$ss[0];



		        }







		        $query .= $sortBy;



		        $result = $this->db->query($query);



		        $rowCount  = $result->num_rows();



                



                $page = 1;



		        $par_page = 20;



		        if($postData['device_type'] == 'IOS'){



                    $par_page = $rowCount;  



                }



		        if ($postData['par_page']) {



		        	$par_page = $postData['par_page'];



		        }



		        if ($postData['page']) {



		        	$page = $postData['page'];



		        }



		        



		        if($page != 0){ $page = ($page-1) * $par_page; }



		        $query .= ' LIMIT '.$page.','.$par_page;



		        $result = $this->db->query($query);



		        



		        



		        $start_limit = $page + 1;



				$end_limit = $page + $par_page;



				if($rowCount > $end_limit){



					$end_limit = $end_limit;



				}else{



					$end_limit = $rowCount;



				}



				$products =  $result->result();



		        foreach ($products as $key => $productDetails) {



		        	$discount = '0'; 



					$discountAmt = '0'; 



					$saleAmt = $productDetails->price; 



					if($productDetails->discount) {



					 	$discount = ($productDetails->discount / 100) * $productDetails->price; 



					 	$discountAmt = round(($productDetails->discount / 100) * $productDetails->price); 



					 	$saleAmt = round($productDetails->price - $discount); 



					} 



					//$products[$key]->discount = $discount;



					$products[$key]->discountAmt = (string)$discountAmt;



					$products[$key]->saleAmt = (string)$saleAmt;







		        	$products[$key]->gallary_path = 'assets/images/gallery/';



		            $products[$key]->gallary_image=$this->db->get_where('product_galary',['product_id'=>$productDetails->id ])->result();



		        	$wishListStatus = 0;



		            if($postData['user_id']){



		                $wishListStatusRow = $this->db->get_where('wishlist',['product_id' => $productDetails->id,'user_id' => $postData['user_id'] ])->row();



		                if ($wishListStatusRow) {



		                    $wishListStatus = 1;



		                }



		            }



		            $products[$key]->wishListStatus = $wishListStatus;



		            



		            $review = $this->db->query('SELECT AVG(rating) as rating, count(rating) as feedbackCount from product_review'." WHERE status = 1 and  product_id = ".$productDetails->id)->row();



		            $products[$key]->feedbackRating = ($review->rating)?(string)round($review->rating):'0';



		    



		            $products[$key]->feedbackCount = $review->feedbackCount;



		    



		            $products[$key]->review = $review;



		    



		            $reviews = $this->db->query('select * from product_review'." WHERE status = 1 AND product_id = ".$productDetails->id.' order by id DESC')->result_array();



		    



		            foreach ($reviews as $ke => $val11) { 



		                $reviewUser = array();



		                if ($val11['from_user_id']) {



		                    $reviewUser = $this->db->query('select * from vender'." WHERE id = ".$val11['from_user_id'])->row_array();



		                }



		                $reviews[$ke]['reviewUser'] = $reviewUser;



		            }



		            $products[$key]->reviews = $reviews;



		            



		            $row = $this->common_model->get_all_details('vender',array('id'=>$productDetails->vender_id))->row_array();



		            $products[$key]->vendor_fname = $row['fname'];



	            	$products[$key]->vendor_lname = $row['lname'];



		            



		            $row = $this->common_model->get_all_details('vender',array('id'=>$productDetails->user_id))->row_array();



			        $products[$key]->boutique_fname = $row['fname'];



			        $products[$key]->boutique_lname = $row['lname'];



			        



		            $row = $this->common_model->get_all_details('category',array('id'=>$productDetails->cat_id))->row_array();



		            $products[$key]->category_name = $row['name'];



		            $products[$key]->category_slug = $row['slug'];







		            if($productDetails->size){



		                $this->db->select('*');  



		                $this->db->where_in('id',$productDetails->size,false);



		                $this->db->order_by("ui_order", "asc");



		                $products[$key]->sizesArray = $this->db->get('product_size')->result();  



		            }else{



		                $products[$key]->sizesArray = array();  



		            }



		        }



		         











				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'image_path' => 'assets/images/product/',



					'start_limit' => $start_limit,



					'end_limit' => $end_limit,



					'num_rows' => $rowCount,



					'par_page' => $par_page,



					'response' => $products,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function product_detail_post(){



		try {



			$postData = $this->input->post();



			$getData = $this->input->get();



			if (array_key_exists('current_language', $postData)) {



			    $currLanguage = $postData['current_language']; 			



			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				if($postData['product_id']){



					$query = " where id = '".$postData['product_id']."' AND status = 1 and vendor_status = 1 and admin_status = 1 ";



	        



					$result = $this->db->query('select * from products'.$query);



			        $rowCount  = $result->num_rows();



			        $products =  $result->result();







			        foreach ($products as $key => $productDetails) {



			        	$discount = '0'; 



						$discountAmt = '0'; 



						$saleAmt = $productDetails->price; 



						if($productDetails->discount) {



						 	$discount = ($productDetails->discount / 100) * $productDetails->price; 



						 	$discountAmt = round(($productDetails->discount / 100) * $productDetails->price); 



						 	$saleAmt = round($productDetails->price - $discount); 



						} 



						//$products[$key]->discount = $discount;



						$products[$key]->discountAmt = (string)$discountAmt;



						$products[$key]->saleAmt = (string)$saleAmt;







			        	$products[$key]->gallary_path = 'assets/images/gallery/';



			        	$products[$key]->gallary_image=$this->db->get_where('product_galary',['product_id'=>$productDetails->id ])->result();



			        	



			            $wishListStatus = 0;



			            if($postData['user_id']){



			                $wishListStatusRow = $this->db->get_where('wishlist',['product_id' => $productDetails->id,'user_id' => $postData['user_id'] ])->row();



			                if ($wishListStatusRow) {



			                    $wishListStatus = 1;



			                }



			            }



			            $products[$key]->wishListStatus = (string)$wishListStatus;



			            



			            $review = $this->db->query('SELECT AVG(rating) as rating, count(rating) as feedbackCount from product_review'." WHERE status = 1 and  product_id = ".$productDetails->id)->row();



			            $products[$key]->feedbackRating = ($review->rating)?(string)round($review->rating):'0';



			    



			            $products[$key]->feedbackCount = $review->feedbackCount;



			    



			            $products[$key]->review = $review;



			    



			            $reviews = $this->db->query('select * from product_review'." WHERE status = 1 AND product_id = ".$productDetails->id.' order by id DESC')->result_array();



			    



			            foreach ($reviews as $ke => $val11) { 



			                $reviewUser = array();



			                if ($val11['from_user_id']) {



			                    $reviewUser = $this->db->query('select * from vender'." WHERE id = ".$val11['from_user_id'])->row_array();



			                }



			                $reviews[$ke]['reviewUser'] = $reviewUser;



			            }



			            $products[$key]->reviews = $reviews;



			            



			            $row = $this->common_model->get_all_details('vender',array('id'=>$productDetails->vender_id))->row_array();



			            $products[$key]->vendor_fname = $row['fname'];



		            	$products[$key]->vendor_lname = $row['lname'];



			            



			            $row = $this->common_model->get_all_details('vender',array('id'=>$productDetails->user_id))->row_array();



				        $products[$key]->boutique_fname = $row['fname'];



				        $products[$key]->boutique_lname = $row['lname'];







			            $row = $this->common_model->get_all_details('category',array('id'=>$productDetails->cat_id))->row_array();



			            $products[$key]->category_name = $row['name'];



			            $products[$key]->category_slug = $row['slug'];



			            



			            if($productDetails->size){



			                $this->db->select('*');  



			                $this->db->where_in('id',$productDetails->size,false);



			                $this->db->order_by("ui_order", "asc");



			                $products[$key]->sizesArray = $this->db->get('product_size')->result();  



			            }else{



			                $products[$key]->sizesArray = array();  



			            }



			        }



			        $response = array(



						'status' => $a['status'],



						'message' => $a['message'],



						'image_path' => 'assets/images/product/',



						'num_rows' => $rowCount,



						'response' => $products[0],



					);



				}



				else{



					$response = array(



						'status' => $a['status'],



						'message' => 'Please enter product ID',



					);



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



    



    public function product_review_post(){



		try {



			$postData = $this->input->post();



			$getData = $this->input->get();



			if (array_key_exists('current_language', $postData)) {



			    $currLanguage = $postData['current_language']; 			



			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				if(!empty($postData['product_id']) && !empty($postData['user_id'])){



					



					$id =  $postData['product_id'];



					$comment =  $postData['comment'];



                    $rating =  $postData['rating'];



                    



                    



        			$dd = check_content_sightengine($postData);



        			if ($dd) {



        				$msg = 'Your request could not be submitted because you enter inappropriate content.';



        				$response = array(



        		                'status' => 'fail',



        		                'message' =>  $msg,



        	                );



        				$this->set_response($response, REST_Controller::HTTP_OK);



        				return;



        



        			}



                    



                    $user_id =  $postData['user_id'];



                    $rs = $this->common_model->get_all_details('vender',array('id'=>$user_id))->row_array();



                    



                    $name =  $rs['fname'].' '.$rs['lname'];



                    $email =  $rs['email'];



                    



                    $curlPost = array();



                    $curlPost['product_id'] = $id;



                    $curlPost['email'] = $email;



                    $reviewRow = $this->db->query("select * from product_review where product_id =  '".$id."' and email =  '".$email."'")->row();



                    if ($reviewRow) {



                        $msg = 'You have aready given rating';



                    }else{



                        $curlPost['from_user_id'] = $this->session->userdata('userId');



                        $curlPost['name'] = $name;



                        $curlPost['comment'] = $comment;



                        $curlPost['rating'] = $rating;



                        $curlPost['created_at'] = date('Y-m-d h:i:s');



                        $this->db->insert('product_review',$curlPost);



                        $msg = 'Thanks you for given feedback!';



                    }



                    $response = array(



						'status' => $a['status'],



						'message' => $msg,



						'response' => $userRow,



					);



						 



				    $this->set_response($response, REST_Controller::HTTP_OK);



				



				}



				else{



					$response = array(



						'status' => $a['status'],



						'message' => 'Please enter product ID && user ID',



					);



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



    public function shipping_address_post(){



		try {



			$postData = $this->input->post();



			$getData = $this->input->get();



			if (array_key_exists('current_language', $postData)) {



			    $currLanguage = $postData['current_language']; 			



			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				if($postData['user_id']){



					$query = " where user_id = '".$postData['user_id']."' ";



	        



					$result = $this->db->query('select * from user_shipping_address'.$query);



			        $rowCount  = $result->num_rows();



			        $products =  $result->result();







			        $response = array(



						'status' => $a['status'],



						'message' => $a['message'],



						'num_rows' => $rowCount,



						'response' => $products,



					);



				}



				else{



					$response = array(



						'status' => $a['status'],



						'message' => 'Please enter User ID',



					);



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



    public function shipping_address_add_post(){



		try {



			$postData = $this->input->post();



			$getData = $this->input->get();



			if (array_key_exists('current_language', $postData)) {



			    $currLanguage = $postData['current_language']; 			



			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				if($postData['user_id']){



				    



				    $check_content_sightengine = array();



        			$check_content_sightengine['state_name'] = $postData['state_name'];;



        			$check_content_sightengine['city_name'] = $postData['city_name'];;



        			$check_content_sightengine['address'] = $postData['address'];;



        			$check_content_sightengine['fname'] = $postData['fname'];;



        			$check_content_sightengine['lname'] = $postData['lname'];;



        			$dd = check_content_sightengine($check_content_sightengine);



        			if ($dd) {



        				$msg = 'Your request could not be submitted because you enter inappropriate content.';



        				$response = array(



        		                'status' => 'fail',



        		                'message' =>  $msg,



        	                );



        				$this->set_response($response, REST_Controller::HTTP_OK);



        				return;



        



        			}



        			



                    $insert['fname'] = $postData['fname'];



                    $insert['lname'] = $postData['lname'];



                    $insert['address'] = $postData['address'];



                    $insert['city_name'] = $postData['city_name'];



                    $insert['state_name'] = $postData['state_name'];



                    $insert['country'] = $postData['country'];



                    $insert['zip'] = $postData['zip'];



                    $insert['mobile'] = $postData['mobile'];



                    $insert['user_id'] = $postData['user_id'];



                    $lastId = $this->common_model->simple_insert('user_shipping_address',$insert);



                    $response = array(



						'status' => $a['status'],



						'message' => 'Address added successfully',



						'response' => $lastId,



					);



				}



				else{



					$response = array(



						'status' => $a['status'],



						'message' => 'Please enter User ID',



					);



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



    public function shipping_address_update_post(){



		try {



			$postData = $this->input->post();



			$getData = $this->input->get();



			if (array_key_exists('current_language', $postData)) {



			    $currLanguage = $postData['current_language']; 			



			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				if(!empty($postData['user_id']) && !empty($postData['address_id'])){



				    $check_content_sightengine = array();



        			$check_content_sightengine['state_name'] = $postData['state_name'];;



        			$check_content_sightengine['city_name'] = $postData['city_name'];;



        			$check_content_sightengine['address'] = $postData['address'];;



        			$check_content_sightengine['fname'] = $postData['fname'];;



        			$check_content_sightengine['lname'] = $postData['lname'];;



        			$dd = check_content_sightengine($check_content_sightengine);



        			if ($dd) {



        				$msg = 'Your request could not be submitted because you enter inappropriate content.';



        				$response = array(



        		                'status' => 'fail',



        		                'message' =>  $msg,



        	                );



        				$this->set_response($response, REST_Controller::HTTP_OK);



        				return;



        



        			}



                    $insert['fname'] = $postData['fname'];



                    $insert['lname'] = $postData['lname'];



                    $insert['address'] = $postData['address'];



                    $insert['city_name'] = $postData['city_name'];



                    $insert['state_name'] = $postData['state_name'];



                    $insert['country'] = $postData['country'];



                    $insert['zip'] = $postData['zip'];



                    $insert['mobile'] = $postData['mobile'];



                    $insert['user_id'] = $postData['user_id'];



                    $lastId = $this->common_model->commonUpdate('user_shipping_address',$insert,array('id'=>$postData['address_id']));



                    $response = array(



						'status' => $a['status'],



						'message' => 'Address updated successfully',



						'response' => $lastId,



					);



				}



				else{



					$response = array(



						'status' => $a['status'],



						'message' => 'Please enter User ID && address ID',



					);



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



    public function shipping_address_detail_post(){



		try {



			$postData = $this->input->post();



			$getData = $this->input->get();



			if (array_key_exists('current_language', $postData)) {



			    $currLanguage = $postData['current_language']; 			



			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				if(!empty($postData['address_id'])){



				    $lastId = $this->common_model->get_all_details('user_shipping_address',array('id'=>$postData['address_id']))->row_array();



                    $response = array(



						'status' => $a['status'],



						'message' => 'Address updated successfully',



						'response' => $lastId,



					);



				}



				else{



					$response = array(



						'status' => $a['status'],



						'message' => 'Please enter address ID',



					);



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



    public function shipping_address_delete_post(){



		try {



			$postData = $this->input->post();



			$getData = $this->input->get();



			if (array_key_exists('current_language', $postData)) {



			    $currLanguage = $postData['current_language']; 			



			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				if(!empty($postData['address_id'])){



				    $lastId = $this->common_model->commonDelete('user_shipping_address',array('id'=>$postData['address_id']));



                    $response = array(



						'status' => $a['status'],



						'message' => 'Address deleted successfully',



						'response' => $lastId,



					);



				}



				else{



					$response = array(



						'status' => $a['status'],



						'message' => 'Please enter address ID',



					);



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



    public function filters_post(){



		try {



			$postData = $this->input->post();



			$getData = $this->input->get();



			if (array_key_exists('current_language', $postData)) {



			    $currLanguage = $postData['current_language']; 			



			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



			    $catLists = $this->common_model->get_all_details('category',array('status'=>1))->result_array();



			    $data['catLists'] =  $catLists;



			    $product_size = $this->common_model->get_all_details('product_size',array('status'=>1))->result_array();



			    $data['sizes'] =  $product_size;



               



               



                $priceList =array(



                        array('id'=>'0-1000','value'=>'0-1000'),



                        array('id'=>'1000-2000','value'=>'1000-2000'),



                        array('id'=>'2000-5000','value'=>'2000-5000'),



                        array('id'=>'5000-10000','value'=>'5000-10000'),



                        array('id'=>'10000-20000','value'=>'10000-20000'),



                    );



                $priceList1 = $this->common_model->get_all_details('filter_price',array('status'=>1))->result_array();



                $priceList2 = array();



                foreach ($priceList1 as $key => $value) {



                	$p = array();



                	$p['id'] = $value['value'];



                	$p['value'] = $value['label'];



                	array_push($priceList2,$p);



                }



                $data['priceList2'] =  $priceList2;        



                $data['priceList'] =  $priceList;        



			 



			    $orderBy =array('asc-price'=>'Price : Low to High','desc-price'=>'Price : High to Low','desc-discount'=>'Offer');



                $data['orderBy'] =  $orderBy;        



			    



			    



			    $offerList =array(



    			        array('id'=>'10','value'=>'10%'),



    			        array('id'=>'25','value'=>'25%'),



    			        array('id'=>'30','value'=>'30%')



			        );



			    $data['offerList'] =  $offerList;  



				



				$offerList1 = $this->common_model->get_all_details('filter_discount',array('status'=>1))->result_array();



                $offerList2 = array();



                foreach ($offerList1 as $key => $value) {



                	$p = array();



                	$p['id'] = $value['value'];



                	$p['value'] = $value['label'];



                	array_push($offerList2,$p);



                }



                $data['offerList2'] =  $offerList2;			



                $response = array(



					'status' => $a['status'],



					'message' => $a['message'],



					'response' => $data,



				);



				 



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function cartupdate_ajax($user_id){



		$cartArray = $this->common_model->get_all_details('user_cart',array('user_id'=>$user_id,'in_stock'=>1))->result_array();



        $bag_total= 0;



        $bag_mrp_price_total= 0;



        $totalcount= 0;



        $coupon_id = 0;



        $coupon_code = '';



        $coupon_value = 0;



        $coupon_price = 0;



        $discount_total = 0;



        $redeem_point = 0;



        $redeem_record = '';



        foreach($cartArray as $key=>$value){



            if($value['in_stock']){



                $totalcount += $value['quantity'];



                $bag_total += $value['total'];



                $discount_total += $value['discount_total'];



                $bag_mrp_price_total += $value['mrp_price_total'];



            }



        }



        $this->data['totalcount'] = $totalcount;



         



        



        



        $shipping_total = 0;







        $display_total = $shipping_total + $bag_total;



        $display_mrp_price_total = $shipping_total + $bag_mrp_price_total;



        



        



        $cart_record = array();



        $cart_record['bag_total'] = numberFormat($bag_total);



        $cart_record['discount_total'] = numberFormat($discount_total);



        $cart_record['sub_total'] = numberFormat($bag_total);



        $cart_record['bag_mrp_price_total'] = numberFormat($bag_mrp_price_total);



        $cart_record['shipping_total'] = numberFormat($shipping_total);



        $cart_record['total'] = numberFormat($display_total);



        $cart_record['mrp_price_total'] = numberFormat($display_mrp_price_total);







        $cart_record['display_bag_total'] = numberFormat($bag_total);



        $cart_record['display_discount_total'] = numberFormat($discount_total);



        $cart_record['display_sub_total'] = numberFormat($bag_total);



        $cart_record['display_bag_mrp_price_total'] = numberFormat($bag_mrp_price_total);







        $cart_record['display_shipping_total'] = numberFormat($shipping_total);



        $cart_record['display_total'] = numberFormat($display_total);



        $cart_record['display_mrp_price_total'] = numberFormat($display_mrp_price_total);



        



        $sess_array = array();



        $sess_array['user_id'] = $user_id;



        $sess_array['cart_record'] = json_encode($cart_record);



        $sess_array['coupon_id'] = $coupon_id;



        $sess_array['coupon_code'] = $coupon_code;



        $sess_array['coupon_value'] = $coupon_value;



        $sess_array['display_coupon_price'] = $coupon_value;



        $sess_array['coupon_price'] = numberFormat($coupon_price);



        $sess_array['redeem_point'] = $redeem_point;



        $sess_array['redeem_record'] = $redeem_record;



        $sess_array['created_at'] = date('Y-m-d h:i:s');



        







        $conSession = array('user_id'=>$user_id);



        $sessionRow = $this->common_model->get_all_details('user_cart_session',$conSession);



        //echo $this->db->last_query();



        $num_rows = $sessionRow->num_rows();



        if ($num_rows) {



            $this->common_model->commonUpdate('user_cart_session',$sess_array,$conSession);



            $sessionRow = $this->common_model->get_all_details('user_cart_session',$conSession);



            $num_rows = $sessionRow->num_rows();



            if ($num_rows > 1) {



                $this->common_model->commonDelete('user_cart_session',$conSession);



                $this->common_model->simple_insert('user_cart_session',$sess_array);



            }



        }else {



            $this->common_model->simple_insert('user_cart_session',$sess_array);



            //echo $this->db->last_query();



        }



	}







    public function cart_add_post(){



		try {



			$postData = $this->input->post();



			$getData = $this->input->get();



			if (array_key_exists('current_language', $postData)) {



			    $currLanguage = $postData['current_language']; 			



			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



			    



			    $user_id = $this->input->post('user_id');



			    $product_id = $this->input->post('product_id');



                $qty  = $this->input->post('qty'); 



                $size = $this->input->post('size');



                if(!empty($user_id) && !empty($product_id) && !empty($qty)){



                    $wh = array();



                    $wh['user_id'] = $user_id;



                    $wh['product_id'] = $product_id;



                    if($size){



                        $wh['size'] = $size;



                    }



                    $rr = $this->common_model->get_all_details('user_cart',$wh)->row();



                    //echo $this->db->last_query();



                    if($rr){



                        $this->db->select('products.*, vender.fname,vender.lname'); 



                        $this->db->from('products');



                        $this->db->join('vender', 'vender.id = products.vender_id');



                        $this->db->where('products.id', $product_id);



                        $this->db->where('products.vendor_status', 1);



                        $this->db->where('products.admin_status', 1);



                        $this->db->where('products.status', 1);



                        



                        $productDetails  = $this->db->get()->row();



                        



                        $discountAmt = '0'; 



    					$saleAmt = $productDetails->price; 



    					if($productDetails->discount) {



    					 	$discount = ($productDetails->discount / 100) * $productDetails->price; 



    					 	$discountAmt = ($productDetails->discount / 100) * $productDetails->price; 



    					 	$saleAmt = round($productDetails->price - $discount); 



    					} 



    					$price = $saleAmt;



    					$mrpprice = $productDetails->price;



    					



                        $name = str_replace('-',' ',$productDetails->slug);



                        $image = $productDetails->image;



                        $catId = $productDetails->cat_id;



                        $discount = ($productDetails->discount)?$productDetails->discount:0;



                        $discountPrice = ($discountAmt)?(int)$discountAmt:0;



                        $venderId = $productDetails->vender_id;



                       



                        



                        



                        



                        $optionArray = array (



                            'image' => $image, 'catId' => $catId,'discount'=>$discount,'discountPrice' => $discountPrice,'mrpprice' => $mrpprice,'venderId'=>$venderId,'size' =>$size);



                        $data = array(



                            'user_id' => $user_id,



                            'product_id' => $product_id,



                            'name' => $name,



                            'size' => $size,



                            'mrp_price' => $mrpprice,



                            'sale_price' => $price,



                            'price' => $price,



                            'discount' => $discount,



                            'discount_price' => $discountPrice,



                            'quantity' => $qty,



                            'created_at' => date('Y-m-d h:i:s'),



                            'total' => $qty * $price,



                            'mrp_price_total' => $qty * $mrpprice,



                            'discount_total' => $qty * $discountPrice,



                            'options' => json_encode($optionArray),



                        );              



                        $lastId = $this->common_model->commonUpdate('user_cart',$data,array('id'=>$rr->id));



                        $response = array(



        					'status' => $a['status'],



        					'message' => 'Cart update successfully',



        					'response' => $lastId,



        				);



                    }else{



                        $this->db->select('products.*, vender.fname,vender.lname'); 



                        $this->db->from('products');



                        $this->db->join('vender', 'vender.id = products.vender_id');



                        $this->db->where('products.id', $product_id);



                        $this->db->where('products.vendor_status', 1);



                        $this->db->where('products.admin_status', 1);



                        $this->db->where('products.status', 1);



                        



                        $productDetails  = $this->db->get()->row();



                        



                        $discountAmt = '0'; 



    					$saleAmt = $productDetails->price; 



    					if($productDetails->discount) {



    					 	$discount = ($productDetails->discount / 100) * $productDetails->price; 



    					 	$discountAmt = ($productDetails->discount / 100) * $productDetails->price; 



    					 	$saleAmt = round($productDetails->price - $discount); 



    					} 



    					$price = $saleAmt;



    					$mrpprice = $productDetails->price;



    					



                        $name = str_replace('-',' ',$productDetails->slug);



                        $image = $productDetails->image;



                        $catId = $productDetails->cat_id;



                        $discount = ($productDetails->discount)?$productDetails->discount:0;



                        $discountPrice = ($discountAmt)?(int)$discountAmt:0;



                        $venderId = $productDetails->vender_id;



                       



                        



                        



                        



                        $optionArray = array (



                            'image' => $image, 'catId' => $catId,'discount'=>$discount,'discountPrice' => $discountPrice,'mrpprice' => $mrpprice,'venderId'=>$venderId,'size' =>$size);



                        $data = array(



                            'user_id' => $user_id,



                            'product_id' => $product_id,



                            'product_image' => $image,



                            'name' => $name,



                            'size' => $size,



                            'mrp_price' => $mrpprice,



                            'sale_price' => $price,



                            'price' => $price,



                            'discount' => $discount,



                            'discount_price' => $discountPrice,



                            'quantity' => $qty,



                            'created_at' => date('Y-m-d h:i:s'),



                            'total' => $qty * $price,



                            'mrp_price_total' => $qty * $mrpprice,



                            'discount_total' => $qty * $discountPrice,



                            'options' => json_encode($optionArray),



                        );              



                        $lastId = $this->common_model->simple_insert('user_cart',$data);



                        $response = array(



        					'status' => $a['status'],



        					'message' => 'Product added into cart successfully',



        					'response' => $lastId,



        				);



                    }



                    



                    $this->cartupdate_ajax($user_id); 



    			}else{



    			    $response = array(



    					'status' => $a['status'],



    					'message' => 'Please enter user ID, product ID and qty',



    					'response' => $lastId,



    				);



    			}



            	$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function cart_add_service_post(){



        try {



			$postData = $this->input->post();



			$getData = $this->input->get();



			if (array_key_exists('current_language', $postData)) {



			    $currLanguage = $postData['current_language']; 			



			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



		        $id = $this->input->post('service_id');



		        $qty  = $this->input->post('qty');



		        $user_id = $this->input->post('user_id');



		        if(!empty($user_id) && !empty($id) && !empty($qty)){







			        $datas = $this->db->get_where('our_services',['id'=> $id])->row();







			        $price = $datas->price;



			        $mrpprice = $datas->mrp_price;



			        $activity = 'service';



			        







			        if (file_exists($image_path = FCPATH . 'assets/images/services/' . $datas->image)) {  



			            $image = 'assets/images/services/'.$datas->image;



			        } else {



			            $image = 'assets/images/no-image.jpg';



			        }







			        $name = $datas->title;



			        



			        $wh = array();



			        $wh['user_id'] = $user_id;



			        $wh['product_id'] = $id;



			        $wh['cart_type'] = 'service';



			        $rr = $this->common_model->get_all_details('user_cart',$wh)->row();







			        $discountAmt = $mrpprice - $price;



			        $discountPrice = ($discountAmt)?(int)$discountAmt:0;



			        



			        $discount_ = (($discountAmt*100) / $mrpprice);



			        $discount = ($discount_)?(int)$discount_:0;







			        $mrp_price_total =  $qty * $mrpprice;



			        $discount_total =  $qty * $discountPrice;



			        



			        $optionArray = array ('image' => $image, 'discount'=>$discount,'discountPrice' => $discountPrice,'mrpprice' => $mrpprice);







			        $data = array(



			            'product_image' => $image,



			            'cart_type' => 'service',



			            'user_id' => $user_id,



			            'product_id' => $id,



			            'name' => $name,



			            'mrp_price' => $mrpprice,



			            'sale_price' => $price,



			            'price' => $price,



			            'discount' => $discount,



			            'discount_price' => $discountPrice,



			            'quantity' => $qty,



			            'created_at' => date('Y-m-d h:i:s'),



			            'total' => $qty * $price,



			            'mrp_price_total' => $mrp_price_total,



			            'discount_total' => $discount_total,



			            'options' => json_encode($optionArray),



			        );



			        if($rr){



			            $lastId = $rr->id;



			            $this->common_model->commonUpdate('user_cart',$data,array('id'=>$rr->id));



			            $msg = 'Cart updated successfully';



			        }else{



			            $lastId = $this->common_model->simple_insert('user_cart',$data);



			            $msg = 'Service added into cart successfully';



			        }



			        $response = array(



						'status' => $a['status'],



						'message' => $msg,



						'response' => $lastId,



					);



		        }else{



				    $response = array(



						'status' => $a['status'],



						'message' => 'Please enter user ID, service ID and qty',



					);



				}



		        $this->set_response($response, REST_Controller::HTTP_OK);



		    }



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



    }



    public function cart_post(){



		try {



			$postData = $this->input->post();



			$getData = $this->input->get();



			if (array_key_exists('current_language', $postData)) {



			    $currLanguage = $postData['current_language']; 			



			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



			    



			    $user_id = $this->input->post('user_id');



			    $this->cartupdate_ajax($user_id);



                if(!empty($user_id)){



                    



                    $wh = ' WHERE user_id = "'.$user_id.'"';



                    $rs = $this->common_model->get_all_details_query('user_cart',$wh)->result();



                    $data['cartArray'] = $rs;



            



                    if($rs) {



                        $wh = ' WHERE user_id = "'.$user_id.'"';



                        $rs = $this->common_model->get_all_details_query('user_cart_session',$wh)->row_array();



                        



                        



                        $rs['cart_record_app'] = json_decode($rs['cart_record']);



                        $data['user_cart_session'] = $rs;



                        $response = array(



        					'status' => $a['status'],



        					'message' => $a['message'],



        					'response' => $data,



        				);



                    }else{



                        $response = array(



        					'status' => $a['status'],



        					'message' => 'Cart Empty',



        				);



                    }   



                    



    			}else{



    			    $response = array(



    					'status' => $a['status'],



    					'message' => 'Please enter user ID',



    					'response' => $data,



    				);  



    			}



                $this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



    public function cart_delete_post(){



		try {



			$postData = $this->input->post();



			$getData = $this->input->get();



			if (array_key_exists('current_language', $postData)) {



			    $currLanguage = $postData['current_language']; 			



			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



			    



			    $user_id = $this->input->post('user_id');



			    $cart_id = $this->input->post('cart_id');



                if(!empty($user_id) && !empty($cart_id)){



                    $wh = array();



                    $wh['user_id'] = $user_id;



                    $wh['id'] = $cart_id;



                    $this->common_model->commonDelete('user_cart',$wh);



                    $this->cartupdate_ajax($user_id); 



                    $response = array(



    					'status' => $a['status'],



    					'message' => 'Deleted successfully',



    				);



    			}else{



    			    $response = array(



    					'status' => $a['status'],



    					'message' => 'Please enter user ID, cart ID',



    				);



    			}



                $this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function checkout_post(){



		try {



			$postData = $this->input->post();



			$getData = $this->input->get();



			if (array_key_exists('current_language', $postData)) {



			    $currLanguage = $postData['current_language']; 			



			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



			    $user_id = $this->input->post('user_id');



			    if(!empty($user_id)){



                    $wh = ' WHERE user_id = "'.$user_id.'"';



                    $rs = $this->common_model->get_all_details_query('user_cart',$wh)->result();



                    $data['cartArray'] = $rs;



            



                    if($rs) {



                        $wh = ' WHERE user_id = "'.$user_id.'"';



                        $rs = $this->common_model->get_all_details_query('user_cart_session',$wh)->row_array();



                        



                        



                        $rs['cart_record_app'] = json_decode($rs['cart_record']);



                        $data['user_cart_session'] = $rs;



                        $response = array(



        					'status' => $a['status'],



        					'message' => $a['message'],



        					'response' => $data,



        				);



                    }else{



                        $response = array(



        					'status' => $a['status'],



        					'message' => 'Cart Empty',



        				);



                    }   



                    



    			}else{



    			    $response = array(



    					'status' => $a['status'],



    					'message' => 'Please enter user ID',



    					'response' => $data,



    				);  



    			}



                $this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



    



	public function wishlist_add_remove_post(){



		try {



			$postData = $this->input->post();



			$getData = $this->input->get();



			if (array_key_exists('current_language', $postData)) {



			    $currLanguage = $postData['current_language']; 			



			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



			    



			    $user_id = $postData['user_id'];



			    $product_id = $postData['product_id'];



                



                if(!empty($user_id) && !empty($product_id)){



                    $wh = array();



                    $wh['user_id'] = $user_id;



                    $wh['product_id'] = $product_id;



                    $rr = $this->common_model->get_all_details('wishlist',$wh)->row();



                    if($rr){



                        $lastId = $this->common_model->commonDelete('wishlist',$wh);



                        $response = array(



        					'status' => $a['status'],



        					'message' => 'Wishlist removed successfully',



        				);



                    }else{



                        $data = array(



                            'user_id' => $user_id,



                            'product_id' => $product_id,



                            'created_at' => date('Y-m-d h:i:s'),



                        );              



                        $lastId = $this->common_model->simple_insert('wishlist',$data);



                        $response = array(



        					'status' => $a['status'],



        					'message' => 'Wishlist added successfully',



        					'response' => $lastId,



        				);



                    }



                }else{



    			    $response = array(



    					'status' => $a['status'],



    					'message' => 'Please enter user ID, product ID',



    				);



    			}



        		$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function wishlist_post(){



		try {



			$postData = $this->input->post();



			$getData = $this->input->get();



			if (array_key_exists('current_language', $postData)) {



			    $currLanguage = $postData['current_language']; 			



			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



			    $user_id = $this->input->post('user_id');



			    if(!empty($user_id)){



			        $wh = array();



                    $wh['user_id'] = $user_id;



                    $wishlist = $this->common_model->get_all_details('wishlist',$wh);



                    $wishlistNum = $wishlist->num_rows();



                    $wishlistArray = $wishlist->result();



                    foreach ($wishlistArray as $key => $value) {



                        $this->db->select('products.*, vender.fname,vender.lname'); 



                        $this->db->from('products');



                        $this->db->join('vender', 'vender.id = products.vender_id');



                        $this->db->where('products.id', $value->product_id);



                        $productDetails  = $this->db->get()->row();



            



                        $wishlistArray[$key]->productRow = $productDetails;



                    }



                    



                    if($wishlistArray) {



                        $response = array(



        					'status' => $a['status'],



        					'message' => $a['message'],



        					'num_rows' => $wishlistNum,



        					'response' => $wishlistArray,



        				);



                    }else{



                        $response = array(



        					'status' => $a['status'],



        					'message' => 'Wishlist Empty',



        				);



                    }   



                    



    			}else{



    			    $response = array(



    					'status' => $a['status'],



    					'message' => 'Please enter user ID',



    					'response' => $data,



    				);  



    			}



                $this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



    public function offers_post(){



		try {



			$postData = $this->input->post();



			$getData = $this->input->get();



			if (array_key_exists('current_language', $postData)) {



			    $currLanguage = $postData['current_language']; 			



			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



			     



			        $wh = array();



                    //$wishlist = $this->common_model->get_all_details('offers',$wh)->result();



                    $wishlist = $this->common_model->get_all_details('filter_discount',array('featured'=>1))->result();



                    if($wishlist) {



                        $response = array(



        					'status' => $a['status'],



        					'message' => $a['message'],



        					'response' => $wishlist,



        				);



                    }else{



                        $response = array(



        					'status' => $a['status'],



        					'message' => 'Offers Empty',



        				);



                    }   



                    



    			 



                $this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



    



    public function coupan_apply_post(){



		try {



			$postData = $this->input->post();



			$getData = $this->input->get();



			if (array_key_exists('current_language', $postData)) {



			    $currLanguage = $postData['current_language']; 			



			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



			    $user_id = $postData['user_id']; 



			    $gift_code = $postData['coupon_code'];



			    if($user_id){



		        	if($gift_code){



                		$c['user_id'] = $user_id;



                		$rows = $this->common_model->get_all_details_field('*','user_cart',$c)->result();



                		



                		$price = 0;



                		$price1 = 0;



                		foreach ($rows as $key => $value) {



                			$price1 += $value->display_total;



                			$price += $value->total;



                		}



                		$postData['price'] = $price;



                		if(!empty($price)){



                		    $couponRow=$this->common_model->get_all_details('giftcard_booking',array('gift_code'=>$gift_code,'is_used'=>0))->row_array();



                			if ($couponRow) {



                				$price = $postData['price'];



                				$couponPrice =  $couponRow['total_price'];



                				if($couponPrice > $price){



                					$coupon_price = ($price);



                				}else{



                					$coupon_price = ($couponPrice);



                				}



                				



                				$couponRow['coupon_price'] = ($coupon_price);



                				



                				$finalPrice = $price - $coupon_price;



                				$p = (($finalPrice));



                				



                



                				$sess_array = array();



                				$sess_array['coupon_id'] = $couponRow['id'];



                				$sess_array['coupon_code'] = $couponRow['gift_code'];



                				$sess_array['coupon_value'] = $couponRow['total_price'];



                				$sess_array['coupon_price'] = ($coupon_price);



                				$sess_array['display_coupon_price'] = $coupon_price;



                



                				$conSession = array('user_id'=>$user_id);



                				



                				$sessionRow = $this->common_model->get_all_details('user_cart_session',$conSession)->row();



                				if ($sessionRow) {



                					$this->common_model->commonUpdate('user_cart_session',$sess_array,$conSession);



                				}



                				



                				



                				$cartArray = $this->common_model->get_all_details('user_cart',array('user_id'=>$user_id))->result_array();



                        		$sessionRow = $this->common_model->get_all_details('user_cart_session',array('user_id'=>$user_id))->row();



                        



                        		$discount_total = $sessionRow->coupon_price;



                        		$price= 0;



                        		$bag_mrp_price_total= 0;



                        		foreach($cartArray as $key=>$value){



                        			$price += $value['total'];



                        			$bag_mrp_price_total += $value['mrp_price_total'];



                        		}



                        		$delivery_charge = 0;



                                $shipping_total =  ($delivery_charge);



                                



                        		



                        		$total = $price - $discount_total;



                                $display_mrp_price_total = $shipping_total + $bag_mrp_price_total;



                                



                                



                        		$chargePrice = $delivery_charge + $total;



                        	 



                        		$sessionArray = json_decode($sessionRow->cart_record);



                        



                        		$cart_record = array();



                        		



                        		$cart_record['bag_total'] = $bag_total = numberFormat($price);



                        		$cart_record['discount_total'] = $sessionArray->discount_total;



                        		$cart_record['coupon_discount_total'] = numberFormat($discount_total);



                        		$cart_record['sub_total'] = $sub_total = numberFormat($total);



                        		$cart_record['shipping_total'] = numberFormat($shipping_total);



                        		$cart_record['total'] = numberFormat($chargePrice);



                        		$cart_record['mrp_price_total'] = numberFormat($display_mrp_price_total);



                        		



                        		



                        		$cart_record['display_bag_total'] = (($bag_total));



                        		$cart_record['display_discount_total'] = $sessionArray->display_discount_total;



                        		$cart_record['display_coupon_discount_total'] = (numberFormat($discount_total));



                        		$cart_record['display_sub_total'] = (($sub_total));



                        		$cart_record['display_shipping_total'] = numberFormat($shipping_total);



                        		$cart_record['display_total'] = numberFormat($chargePrice);



                                $cart_record['display_mrp_price_total'] = numberFormat($display_mrp_price_total);



                        



                                



                        		$sess_array = array();



                        		$sess_array['user_id'] = $user_id;



                        		$sess_array['cart_record'] = json_encode($cart_record);



                        		



                        		$conSession = array('user_id'=>$user_id);



                        		$sessionRow = $this->common_model->get_all_details('user_cart_session',$conSession)->row();



                        		if ($sessionRow) {



                        			$this->common_model->commonUpdate('user_cart_session',$sess_array,$conSession);



                        		}



                        		



                



                				$response = array(



                					'status' => 'success',



                					'result' => $couponRow,



                					'discount' => numberFormat($coupon_price),



                					'total' => numberFormat($p),



                					'message' => 'Coupon applied successfully',



                				);



                				$this->set_response($response, REST_Controller::HTTP_OK);



                			}



                			else {



                				$response = array(



                					'status' => 'failed',



                					'total' => numberFormat($price),



                					'discount' => numberFormat(0),



                					'message'=>'Gift code entered is not valid',



                				);



                			}



                		    $this->set_response($response, REST_Controller::HTTP_OK);



                		}else{



                			$response = array(



                				'status' => 'failed',



                				'total' => numberFormat($price),



                				'discount' => numberFormat(0),



                				'message' => 'Cart Empty',



                			);



                			$this->set_response($response, REST_Controller::HTTP_OK);



                		}



		        	}else{



        			    $response = array(



            				'status' => 'failed',



            				'message' => 'Please enter Gift Card Code',



            			);



            			$this->set_response($response, REST_Controller::HTTP_OK); 



        			}



    			}else{



    			    $response = array(



        				'status' => 'failed',



        				'message' => 'Please enter user ID',



        			);



        			$this->set_response($response, REST_Controller::HTTP_OK); 



    			}



			    



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



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



    public function sendMail($data){







        $this->cart->destroy();







        







        







        if ($data['order_table'] == 'order') { 







            $id = $data['order_id'];







            $order = $this->db->get_where('user_order',['id'=> $id,'sentMailFlag'=>0])->row_array();

            $user_id  = $order['user_id'];

	        $conSession = array('user_id'=>$user_id);

	        $this->common_model->commonDelete('user_cart',$conSession);

	        $this->common_model->commonDelete('user_cart_session',$conSession);

            //$order = $this->db->get_where('user_order',['id'=> $id])->row_array();







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



 

                $cart_typeArray = array();







                $mailContent =  mailHtmlHeader_New($this->site);







                    $mailContent .= $option;

                    $mailContent .= '<div class="common_w" style="padding:20px 20px;text-align:center;background:#FFFA00;"><b>Purchase confirmation</b></div>';

                        





                    $mailContent .= '<div style="clear: both;"></div>';







                    $mailContent .= '<div class="common_w meddle_content" style="padding:30px 40px;background:#fff;width:100%">';







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







                                                $option .= '<p> <b>Coupon Discount('.$order['coupon_code'].') : - Rs. '.number_format($order['coupon_value']) .'</b></p>';







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







                    $this->createPDF($pdfFilePath, $mailContent);







                





                    /*$emailRow= $this->common_model->get_all_details('vender',array('email'=>$to,'email_notification_status'=>1))->row_array();

                    if($emailRow){

                        

                    }*/

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





                        /*$emailRow= $this->common_model->get_all_details('vender',array('email'=>$to,'email_notification_status'=>1))->row_array();

                        if($emailRow){

                            

                        }*/

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







                        







                $subject =  $this->site->site_name.'';







                







                







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





                /*$emailRow= $this->common_model->get_all_details('vender',array('email'=>$to,'email_notification_status'=>1))->row_array();

                if($emailRow){

                    

                }*/

                $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc='',$reply, $attach);



                 







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















                    $this->createPDF($pdfFilePath, $attach_pdf);













                    /*$emailRow= $this->common_model->get_all_details('vender',array('email'=>$to,'email_notification_status'=>1))->row_array();

                    if($emailRow){

                        

                    }*/

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





                /*$emailRow= $this->common_model->get_all_details('vender',array('email'=>$to,'email_notification_status'=>1))->row_array();

                if($emailRow){

                    

                }*/

                $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc='',$reply, $attach);



                 







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















                    $this->createPDF($pdfFilePath, $option);





                    /*$emailRow= $this->common_model->get_all_details('vender',array('email'=>$to,'email_notification_status'=>1))->row_array();

                    if($emailRow){

                        

                    }*/



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







                        







                                                





                        /*$emailRow= $this->common_model->get_all_details('vender',array('email'=>$to,'email_notification_status'=>1))->row_array();

                        if($emailRow){

                            

                        }*/

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

                

                $mailContent =  mailHtmlHeader_New($this->site);







                    $mailContent .= $option;



                    $mailContent .= '<div class="common_w" style="padding:20px 20px;text-align:center;background:#FFFA00;"><b>Purchase confirmation</b></div>';

                     



                    $mailContent .= '<div style="clear: both;"></div>';







                    $mailContent .= '<div class="common_w meddle_content"  style="padding:30px 40px;background:#fff;">';







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





                /*$emailRow= $this->common_model->get_all_details('vender',array('email'=>$to,'email_notification_status'=>1))->row_array();

                if($emailRow){

                    

                }*/

                $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc,$reply, $pdfFilePath);



                



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







                            $mailContent .= '<a href="'.base_url().'" class="visit">VISIT</a>';







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







                $this->createPDF($pdfFilePath, $option);





                /*$emailRow= $this->common_model->get_all_details('vender',array('email'=>$to,'email_notification_status'=>1))->row_array();

                if($emailRow){

                    

                }*/

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





                /*$emailRow= $this->common_model->get_all_details('vender',array('email'=>$to,'email_notification_status'=>1))->row_array();

                if($emailRow){

                    

                }*/

                $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc='',$reply, $attach);



                 







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







                    $this->createPDF($pdfFilePath, $option);





                    /*$emailRow= $this->common_model->get_all_details('vender',array('email'=>$to,'email_notification_status'=>1))->row_array();

                    if($emailRow){

                        

                    }*/

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







                        







                $subject =  $this->site->site_name.'';







                







                















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





                /*$emailRow= $this->common_model->get_all_details('vender',array('email'=>$to,'email_notification_status'=>1))->row_array();

                if($emailRow){

                    

                }*/

                $this->send_email($to, $from,$from_name, $subject, $mailContent, $cc='',$reply, $attach);



                 







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







                    $this->createPDF($pdfFilePath, $option);





                    /*$emailRow= $this->common_model->get_all_details('vender',array('email'=>$to,'email_notification_status'=>1))->row_array();

                    if($emailRow){

                        

                    }*/

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











    public function payment_online_post(){



        try {



			$postData = $this->input->post();



			$getData = $this->input->get();



			if (array_key_exists('current_language', $postData)) {



			    $currLanguage = $postData['current_language']; 			



			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



			    



			    $user_id = trim($postData['user_id']);



			    $orderId = trim($postData['order_id']);



			    $razorpay_payment_id=$this->input->post('razorpay_payment_id');



			    $pay_type=$this->input->post('pay_type');



			    



			    $order = $this->db->get_where('user_order',['id'=> $orderId])->row();



			    $sendmail = $order->user_email;



			    if (strtoupper($pay_type) == 'RAZORPAY') {



                    if (!empty($razorpay_payment_id)) {



                        $merchant_order_id = $orderId;



                        $currency_code = 'INR';



                        $amount = $order->total_price;



                        $success = true;



                        $error = '';



                        $payment_status = 'APPROVED';



                        $payment_method = 'RAZORPAY';



                        /*try {                



                            $ch = $this->curl_handler($razorpay_payment_id, $amount);



                            $result = curl_exec($ch);



                            var_dump($result);



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



                        }*/



                        



                        if ($success === true) {



                            



                            $up['txn_id'] = $razorpay_payment_id;



                            $up['payment_status'] = $payment_status;



                            $up['method'] = $payment_method;



                            $up['order_status'] = 'Pending';



                            //$up['order_id'] = $orderId;



                            //$up['order_id'] = "STYLE-".date("YmdHis").'-'.$orderId;



                            $this->common_model->commonUpdate('user_order',$up,array('id'=>$orderId));



                            



                            //unset($up['order_id']);



                            $this->common_model->commonUpdate('user_order_details',$up,array('orderId'=>$orderId));



                            



                            try {



                                $postData['order_table'] = 'order';



                                $postData['orderId'] = $orderId;



                                $postData['email'] = $sendmail;



                                $this->sendMail($postData);



                            } catch (Exception $e) {



                                $message = 'error';



                            }



                            $message = 'success';



                        } else {



                            $message = 'fail';



                        }



                    } else {



                        $message = 'fail';



                    }



                }



                



                $order = $this->db->get_where('user_order',['id'=> $orderId])->row();



                //echo $this->db->last_query();



                $data['order'] = $order;



                



                $this->db->select ( 'user_order.*, user_order_details.*' ); 



                $this->db->from ( 'user_order' );



                $this->db->join ( 'user_order_details','user_order_details.invoiceNo = user_order.id');



                $this->db->order_by("user_order.id", "DESC");



                $this->db->where ( 'user_order.id',$orderId);



                $query = $this->db->get();



                



                $data['orderDetails'] = $orderDetails = $query->result();



                



                if($message == 'success'){



                    $msg = 'Order placed successfully';



                }else if($message == 'error'){



                    $msg = 'Order placed failed';



                }else{



                    $msg = 'Something went wrong';



                }



                $response = array(



    				'status' => 'success',



    				'response' => $data,



    				'message' => $msg,



    			);



    			$this->set_response($response, REST_Controller::HTTP_OK);



    			



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



    }	



    public function create_order_post(){



        try {



			$postData = $this->input->post();



			$getData = $this->input->get();



			if (array_key_exists('current_language', $postData)) {



			    $currLanguage = $postData['current_language']; 			



			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



			    



			    $user_id = trim($postData['user_id']);



			    



			    $wh = ' WHERE user_id = "'.trim($user_id).'"';



                $cartArray = $this->common_model->get_all_details_query('user_cart',$wh)->result_array();



                $wh = ' WHERE user_id = "'.$user_id.'"';



                $user_cart_session = $this->common_model->get_all_details_query('user_cart_session',$wh)->row_array();



                



                $sessionArray = json_decode($user_cart_session['cart_record']);



                $total = str_replace(",", '', $sessionArray->display_total);



                $bag_total_price = str_replace(",", '', $sessionArray->bag_total);



        



                $email = $this->input->post('email');



                $userId = $user_id;



        



                $productList = array();



                $uploadData = array();



                $postData = $this->input->post();



                $data['bag_total_price'] = $bag_total_price;



                $data['total_price'] = $total;



                $data['pay_type'] = $this->input->post('pay_type');



                $data['payment_gateway'] = $this->input->post('pay_type');



                



                if($this->input->post('address_id')){



                    $address_id = $this->input->post('address_id');



                    $address_row = $this->common_model->get_all_details('user_shipping_address',array('id'=>$address_id))->row_array();



                    



                    $data['address_id'] = $address_id;



                    $data['fname'] = $address_row['fname'];



                    $data['lname'] = $address_row['lname'];



                    $data['address'] = $address_row['address']; 



                    $data['city'] = $address_row['city_name'];



                    $data['state'] = $address_row['state_name'];



                    $data['pincode'] = $address_row['zip'];



                    $data['country'] = $address_row['country'];



                    $data['mobile'] = $address_row['mobile'];



                    



                    



                    $dataa = array();



                    $dataa['save_address'] = 1; 



                    $dataa['current_address_id'] = $address_id;



                    $this->db->where('id', $userId);



                    $this->db->update('vender',$dataa); 



                         



                    



                }



                



                $coupon_id = $user_cart_session['coupon_id'];



                $data['coupon_id'] = $coupon_id;



                $data['coupon_value'] = $user_cart_session['coupon_value'];



                $data['coupon_code'] = $user_cart_session['coupon_code'];



                $guest = 0;



                if (!$userId) {



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



                        $userId = $user->id;



                        $guest = 1;



                    }else{



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

                

                $time = "STYLE-".date("YmdHis");

               

                

                if(!empty($cartArray)) {    



                    $this->db->insert('user_order',$data);



                    $orderId = $this->db->insert_id();

                    

                    $up = array();

                    $up['order_id'] = $time.''.$orderId;

                    $this->db->where('id', $orderId);

                    $this->db->update('user_order',$up); 

         



                    $couponRow = $this->common_model->get_all_details('giftcard_booking',array('id'=>$coupon_id))->row_array();



                    if ($couponRow) {



                        $dataa = array();



                        $dataa['is_used'] = 1; 



                        $this->db->where('id', $coupon_id);



                        $this->db->update('giftcard_booking',$dataa); 



                    }



                    



                    



                    if ($this->input->post('notify_latest_product')) {



                        $dataa = array();



                        $dataa['notify_latest_product'] = 1;



                        $this->db->where('id', $userId);



                        $this->db->update('vender',$dataa);  



                    }



                     



                }



                 



                foreach ($cartArray as $key => $cartval) {



                    $ss = json_decode($cartval['options']);



                    $productList[] = array(



                            'productId' =>  $cartval['id'],



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



                    $r = $this->common_model->get_all_details('products',array('id'=>$productList[$i]['productId']))->row();



                    



                    $uploadData[$i]['orderId'] = $orderId;    



                    $uploadData[$i]['vendor_id'] = $productList[$i]['venderId'];



                    $uploadData[$i]['vendor_vendor_id'] = $productList[$i]['venderId'];



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



                    $uploadData[$i]['cart_type'] =$productList[$i]['cart_type'];



                    $uploadData[$i]['catId'] = $productList[$i]['catId'];



                    $uploadData[$i]['discount'] = $productList[$i]['discount'];



                    $uploadData[$i]['discountPrice'] = $productList[$i]['discountPrice']; 



                    $uploadData[$i]['totalDiscount'] = $productList[$i]['totalDiscount']; 



                    $uploadData[$i]['venderId'] = $productList[$i]['venderId'];



                    $uploadData[$i]['size'] = $productList[$i]['size'];



                    $uploadData[$i]['created_at'] = date('Y-m-d H:i:s');



                    



                    $uploadData[$i]['payment_status'] = 'NONE';



                    $uploadData[$i]['order_status'] = 'Unfinished order';



                    



                    $uploadData[$i]['ip_address'] = $this->input->ip_address();



                    $uploadData[$i]['user_agent'] = $this->input->user_agent();



                    $uploadData[$i]['browser'] = $this->agent->browser();



                    $uploadData[$i]['browserVersion'] = $this->agent->version();



                    $uploadData[$i]['platform'] = $this->agent->platform();



                    $uploadData[$i]['order_id']=$time.''.$orderId;



                



                }



                $this->db->insert_batch('user_order_details',$uploadData);



                



                $userInvoice = ['orderId'=> $orderId,'guest'=>$guest];



                



                



                $sendmail = $email;



                if (strtoupper($this->input->post('pay_type')) == 'RAZORPAY') {



                    



                }else{



                    $payment_status = 'Pending';



                    $payment_method = 'COD';



                     



                    $up['txn_id'] = 'COD'.($orderId+1);



                    $up['payment_status'] = $payment_status;



                    $up['method'] = $payment_method;



                    $up['order_status'] = 'Pending';



                    



                    //$up['order_id'] = "STYLE-".date("YmdHis").'-'.$orderId;



                    $this->db->where('id', $orderId);



                    $update_password = $this->db->update('user_order',$up); 



                    try {



                        $postData['orderId'] = $orderId;



                        $postData['email'] = $sendmail;



                        $this->sendMail($postData);



                        $message = 'success';



                    } catch (Exception $e) {



                        $message = 'error';



                    }



                }



                



                $data['order'] = $order = $this->db->get_where('user_order',['id'=> $orderId])->row();



                $this->db->select ( 'user_order.*, user_order_details.*' ); 



                $this->db->from ( 'user_order' );



                $this->db->join ( 'user_order_details','user_order_details.invoiceNo = user_order.id');



                $this->db->order_by("user_order.id", "DESC");



                $this->db->where ( 'user_order.id',$orderId);



                $query = $this->db->get();



                $data['orderDetails'] = $orderDetails = $query->result();



                



                



                $response = array(



    				'order_id' => $orderId,



    				'status' => 'success',



    				'response' => $data,



    			);



    			$this->set_response($response, REST_Controller::HTTP_OK);



    		}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



    }	



    public function myorders_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$a = $this->check_api_auth($postData);



			if($a['status'] == 'success'){



				$tbl_name = 'user_order';



                if($postData['user_id']){



                    /*$str = " Where user_id=".$postData['user_id'];



    				$str .= " ORDER by id DESC";



    				$rows =  $this->common_model->get_all_details_query($tbl_name,$str);



    				$numRows = $rows->num_rows();



    				$list = $rows->result_array();



    				foreach($list as $key=>$v){



    				    



    				    $tbl_name1 = 'user_order_details';



                        $str = " Where user_id='".$postData['user_id']."' AND orderId='".$v['id']."'";



        				$str .= " ORDER by id DESC";



        				$rows =  $this->common_model->get_all_details_query($tbl_name1,$str);



        				$numRowsDetail = $rows->num_rows();



        				$listDetail = $rows->result_array();



        				 



        				$list[$key]['numRows'] = $numRowsDetail; 



        				$list[$key]['order_detail'] = $listDetail;



        				



    				    



    				}*/



    				$tbl_name = 'user_order_details';



    				$str = " Where user_id=".$postData['user_id'];



    				$str .= " ORDER by id DESC";



    				$rows =  $this->common_model->get_all_details_query($tbl_name,$str);



    				$numRows = $rows->num_rows();



    				$list = $rows->result_array();



    				



    				$data['numRows'] = $numRows; 



    				$data['orders'] = $list;



    				$message = 'Your order list';



                }else{



                    $data['numRows'] = 0; 



                    $data['orders'] = array();



                    $message = 'Please provide user ID';



                }



            	$response = array(



					'status' => $a['status'],



					'message' => $message,



					'response' => $data,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function myorder_detail_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$a = $this->check_api_auth($postData);



			if($a['status'] == 'success'){



				



                if($postData['user_id']){



                    if($postData['order_id']){



                        /**/



        				



        				$tbl_name = 'user_order_details';



                        $str = " Where user_id='".$postData['user_id']."' AND id='".$postData['order_id']."'";



        				$str .= " ORDER by id DESC";



        				$rows =  $this->common_model->get_all_details_query($tbl_name,$str);



        				$numRows = $rows->num_rows();



        				$list = $rows->result_array();

                        $data['numRows'] = $numRows; 



        				$data['order_detail'] = $list;

        				 

                        $tbl_name = 'user_order';



                        $str = " Where user_id='".$postData['user_id']."' AND id='".$list[0]['orderId']."'";



        				$str .= " ORDER by id DESC";



        				$rows =  $this->common_model->get_all_details_query($tbl_name,$str);



        				$list = $rows->row_array();



        				$data['order'] = $list;

        				

        				



        				$message = 'Your order detail';



                    }else{



                        $data['numRows'] = 0; 



                        $data['order_detail'] = array();



                        $message = 'Please provide order ID';



                    }



                }else{



                    $data['numRows'] = 0; 



                    $data['orders'] = array();



                    $message = 'Please provide user ID';



                }



            	$response = array(



					'status' => $a['status'],



					'message' => $message,



					'response' => $data,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function report_an_issue_question_post() {



		try {



			$postData = $this->input->post();



			$currLanguage = $postData['current_language'];



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$a = $this->check_api_auth($postData);



			if($a['status'] == 'success'){



				



                $rows  =  $this->common_model->get_all_details('report_an_issue_question',array('status'=>1))->result();



                $data['report_an_issue_question'] = $rows;



            	$response = array(



					'status' => $a['status'],



					'response' => $data,



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}



	public function report_an_issue_submit_post(){



        try {



			$postData = $this->input->post();



			$getData = $this->input->get();



			if (array_key_exists('current_language', $postData)) {



			    $currLanguage = $postData['current_language']; 			



			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



    			$dd = check_content_sightengine($postData);



    			if ($dd) {



    				$msg = 'Your request could not be submitted because you enter '.$dd[0]['type'].' content.';



    				$response = array(



    		                'status' => 'fail',



    		                'message' =>  $msg,



    	                );



    				$this->set_response($response, REST_Controller::HTTP_OK);



    				return;



    			}else{



    				$insert = array();



                    $insert['fname'] = $this->input->post('fname');



                    $insert['lname'] = $this->input->post('lname');



                    $insert['country'] = $this->input->post('country');



                    $insert['mobile'] = $this->input->post('mobile');



                    $insert['email'] = $this->input->post('email');



                    $insert['message'] = $this->input->post('message');



                    



                    



                    if(!empty($this->input->post('issue'))) { 



                        $insert['issue'] = $this->input->post('issue'); 



                    }











                    $insert['created_at']  = date('Y-m-d h:i:s');



                    $insert['ip_address'] = $this->input->ip_address();



                    $insert['user_agent'] = $this->input->user_agent();



                    $insert['browser'] = $this->agent->browser();



                    $insert['browserVersion'] = $this->agent->version();



                    $insert['platform'] = $this->agent->platform();



                    $updateTrue = $this->common_model->simple_insert('report_an_issue',$insert);



                    



                    $response = array(



    		                'status' => 'success',



    		                'message' =>  'Thank you for submitting your query. Our team will review this shortly.',



    	                );



    				$this->set_response($response, REST_Controller::HTTP_OK);



    				return;



				}



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



    }



    public function notification_read_post() {



		try {



			$postData = $this->input->post();



			if (array_key_exists('current_language', $postData)) {



			    $currLanguage = $postData['current_language']; 			



			}



			if (empty($currLanguage)) {



				$currLanguage = 'en' ; 



			}



			$auth = array();$a = $this->check_api_auth($auth);



			if($a['status'] == 'success'){



				if ($postData['user_id'] && $postData['id']) {



					$wh = array();



					$wh['id']=$postData['id'];



					$wh['to_id']=$postData['user_id'];







					$list1=$this->common_model->commonUpdate('push_notification_activity_log',array('from_read_status'=>1,'to_read_status'=>1),$wh);



					$response = array(



						'status' => $a['status'],



						'message' => $a['message'],



					);



				}else{



					$response = array(



						'status' => 'fail',



						'message' => 'Please enter user Id',



					);



				}



				$this->set_response($response, REST_Controller::HTTP_OK);



			}



			else{



				$response = array(



					'status' => $a['status'],



					'message' => $a['message'],



				);



				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);



			}



			



		} catch (Exception $exc) {



			$response = array(



				'status' => false,



				'message' => 'Something went wrong',



			);



			$this->set_response($response, REST_Controller::HTTP_OK);



		} 



	}

    public function recent_search_result_post() {

		try {

			$postData = $this->input->post();

			$currLanguage = $postData['current_language'];

			if (empty($currLanguage)) {

				$currLanguage = 'en' ; 

			}

			//root_tag,search_id,search_text,device_id,user_id

			$tbl_name = 'our_services';

			if($postData['root_tag']){

    			if($postData['root_tag'] == 'services'){

    			    $tbl_name = 'our_services';  

    			}elseif($postData['root_tag'] == 'users'){

    			    $tbl_name = 'vender';  

    			}elseif($postData['root_tag'] == 'products'){

    			    $tbl_name = 'products';  

    			}else{

    			    $tbl_name = 'posts'; 

    			}

			}

			

			

			$a = $this->check_api_auth($postData);

			if($a['status'] == 'success'){

    			if(!empty($postData['search_text']) && !empty($postData['search_id'])){

    			

    				$search = array();

    			    $search['search_type'] = 'result';

    			    $search['search_keyword'] = $postData['search_text'];

                    $search['table_name'] = $tbl_name;

                    if ($postData['user_id']) {

                        $search['user_id'] = $postData['user_id'];

                    }

                    if ($postData['search_id']) {

                        $search['search_id'] = $postData['search_id'];

                        $row =  $this->common_model->get_all_details($tbl_name,array('id'=>$postData['search_id']))->row_array();

                        $search['search_image'] = $row['image'];

                    }

                    $search['device_id'] = $postData['device_id'];

                    $search['ip_address'] = $this->input->ip_address();

                    $search['user_agent'] = $this->input->user_agent();

                    $search['browser'] = $this->agent->browser();

                    $search['browserVersion'] = $this->agent->version();

                    $search['platform'] = $this->agent->platform();

                    $this->common_model->simple_insert('recent_search',$search);

    			}else{

    			    

    			}    

				$message = 'Search result';

                $response = array(

					'status' => $a['status'],

					 

				);

				$this->set_response($response, REST_Controller::HTTP_OK);

			}

			else{

				$response = array(

					'status' => $a['status'],

					'message' => $a['message'],

				);

				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);

			}

		} catch (Exception $exc) {

			$response = array(

				'status' => false,

				'message' => 'Something went wrong',

			);

			$this->set_response($response, REST_Controller::HTTP_OK);

		} 

	}

	public function recent_search_post() {

		try {

			$postData = $this->input->post();

			$currLanguage = $postData['current_language'];

			if (empty($currLanguage)) {

				$currLanguage = 'en' ; 

			}

			$a = $this->check_api_auth($postData);

			if($a['status'] == 'success'){

				$tbl_name = 'recent_search';

                $str = " WHERE ip_address ='".$this->input->ip_address()."'";

                

				if(!empty($postData['user_id']) && !empty($postData['device_id'])){

                    $str = " WHERE user_id ='".$postData['user_id']."' OR device_id ='".$postData['device_id']."' ";

				}else if(empty($postData['user_id']) && !empty($postData['device_id'])){

                    $str = " WHERE device_id ='".$postData['device_id']."' ";

				}else if(!empty($postData['user_id']) && empty($postData['device_id'])){

                    $str = " WHERE user_id ='".$postData['user_id']."' ";

				} 

                $str = " order by id desc";

				$rows =  $this->common_model->get_all_details_query($tbl_name,$str);

				//echo $this->db->last_query();

				$numRows = $rows->num_rows();

				$list = $rows->result_array();

				$data['numRows'] = $numRows; 

				$data['result'] = $list;

				$message = 'Search result';

                $response = array(

					'status' => $a['status'],

					'message' => $message,

					'response' => $data,

				);

				$this->set_response($response, REST_Controller::HTTP_OK);

			}

			else{

				$response = array(

					'status' => $a['status'],

					'message' => $a['message'],

				);

				$this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);

			}

		} catch (Exception $exc) {

			$response = array(

				'status' => false,

				'message' => 'Something went wrong',

			);

			$this->set_response($response, REST_Controller::HTTP_OK);

		} 

	}

}




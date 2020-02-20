<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class TestApi extends REST_Controller
{

	public function __construct()
	{
	 parent::__construct();
	 $this->load->model('home_model');
	 $this->load->library(array('form_validation','session'));
	 $this->load->helper(array('url','html','form'));
	}


///////User registeration
	public function register_post()
	{       

            //notes:we also need country.

			$fname = $this->post('fname');
			$lname = $this->post('lname');
			$email = $this->post('email');
			$password = md5($this->post('password'));
			$phone = $this->post('phone');

			$picture = 'noimage.jpg';

			$profile_image_name = time() . ' ' . $_FILES['picture_upload']['name'];
			$target = 'asset/images/' . $profile_image_name;
			move_uploaded_file($_FILES['picture_upload']['tmp_name'], $target);

			//generate simple random code
			$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$code = substr(str_shuffle($set), 0, 12);

			//generate simple random topic
			$set = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$topic = substr(str_shuffle($set), 0, 6);


			$data = array(
				'fname' => $fname,
				'lname' => $lname,
				'email' => $email,
				'password' => $password,
				'phone' => $phone,
				'picture' => $profile_image_name,
				'code' => $code,
				'topic' => $topic,
				'activation' => true
			);

			$user_found = $this->home_model->check_user($email);
			if (!$user_found) {
				$return_data = $this->home_model->create_user($data, $email);
				if ($return_data) {
                    $message = [
                        'error' => FALSE,
                        'message' => "User account created"
                    ];
                    $this->response($message, REST_Controller::HTTP_OK);
				} else {
					$message = [
                        'error' => true,
                        'message' => "sorry something wrong"
                    ];
                    $this->response($message, REST_Controller::HTTP_NOT_FOUND);
				}
			} else {
				$message = [
                    'error' => true,
                    'message' => "Email address already exist"
                ];
                $this->response($message, REST_Controller::HTTP_NOT_FOUND);

		}
	}

////////activate account
// public function activate(){
// 	$id =  $this->uri->segment(3);
// 	$code = $this->uri->segment(4);

// 	//fetch user details
// 	$user = $this->home_model->check_user($id);
// 	//if code matches
// 	if($user['code'] == $code) {
// 		//update user active status
// 		$data['activation'] = true;
// 		$query = $this->home_model->activate($data, $id);

// 		if ($query) {

// 		$data['message'] = 'Thank you for activation please login';
// 		$data['class'] = 'alert-success';
// 		$this->load->view('pages/signin', $data);

// 	}

// }
// }

//////////user login
public function login_post(){

		$data = array(
		'email' => $this->post('email'),
		'password' => md5($this->post('password'))
		);

		$check = $this->home_model->login($data);

		if($check != false){

					$user = array(
					'user_id' => $check->id,
					'email' => $check->email,
					'first_name' => $check->fname,
					'last_name' => $check->lname
				);

				//create session
                $this->session->set_userdata($user);
                
                $this->show_groups_post();
		}
			
		$message = [
            'error' => true,
            'message' => "username password is not correct"
        ];
        $this->response($message, REST_Controller::HTTP_NOT_FOUND);
    }
    
 	//////show groups
	public function show_groups_post(){
			
		 if(empty($this->session->userdata('email'))){
            $message = [
                'error' => true,
                'message' => "Please login"
            ];
            $this->response($message, REST_Controller::HTTP_NOT_FOUND);
		 }else{
				
			$id = $this->session->userdata('user_id');
			$data = $this->home_model->userdata($id);
			$fname = $data["fname"];
			$lname = $data["lname"];
			$upicture = $data["picture"];
				
	
				
			$g_record = $this->home_model->show_group($id);
			$ufriends = $this->home_model->show_friends($id);
			$friend_requests = $this->home_model->get_friend_requests($id);
			$request_no = count($friend_requests);
			#check if user exist.
			if ($data) {
				$g_data = array();
					$g_data = [
						"id" => $id,
						"fname" => $fname,
						"lname" => $lname,
						"upicture" => $upicture,
						"groups" => $g_record,
						"ufriends" => $ufriends,
						"friend_requests" => $friend_requests,
						"request_no" => $request_no
					 ];
                     $this->response($g_data, REST_Controller::HTTP_OK);
				} else {
					$message = [
                        'error' => true,
                        'message' => "username password is not correct"
                    ];
                    $this->response($message, REST_Controller::HTTP_NOT_FOUND);
				}
		}
			
	}

	
//////show group detail
	public function group_detail_post(){
		$id = $this->post('group_id');
		if(empty($this->session->userdata('email'))){
			$message = [
                'error' => true,
                'message' => "Please login first"
            ];
            $this->response($message, REST_Controller::HTTP_NOT_FOUND);
		}else{

		$group_detail = $this->home_model->group_detail($id);
			
		//retreive group members
		$user_id = $group_detail["user_id"];
		$group_members = $this->home_model->group_members($user_id,$group_detail['id']);
			
		$data = [
			"id" => $group_detail["id"],
			"title" => $group_detail["title"],
			"pic" => $group_detail["pic"],
			"group_member" => $group_members,
			"total_members" => count($group_members)

		];
		$this->response($data, REST_Controller::HTTP_OK);
		}

    }
    
 ///////store groups
 	public function store_group_post(){
        if(empty($this->session->userdata('email'))){
            $message = [
                'error' => true,
                'message' => "Please login first"
            ];
            $this->response($message, REST_Controller::HTTP_NOT_FOUND);
        }else{
 		
		$g_name = $this->post('grouptitle');

		$g_image_name = time() . ' ' . $_FILES['group_picture_upload']['name'];
		$target = 'asset/group_images/' . $g_image_name;
		move_uploaded_file($_FILES['group_picture_upload']['tmp_name'], $target);


		$id = $this->session->userdata('user_id');

		$data = array(
			"title" => $g_name,
			"pic" => $g_image_name,
			"user_id" => $id
		);
		$return_data = $this->home_model->create_group($data);
		if ($return_data = true){
            $this->show_groups_post();
		}else{
			$message = [
                'error' => true,
                'message' => "group not created"
            ];
            $this->response($message, REST_Controller::HTTP_NOT_FOUND);
		}
    }
}

///get all friends
    public function search_friends_get(){
		if(empty($this->session->userdata('email'))){
			$message = [
                'error' => true,
                'message' => "Please login first"
            ];
            $this->response($message, REST_Controller::HTTP_NOT_FOUND);
		}else{
			$id = $_SESSION['user_id'];
			$all_friends =  $this->home_model->all_friends($id);
			$f_data = [
				"allfriends" => $all_friends
			];
			$this->response($f_data, REST_Controller::HTTP_OK);
			}
	}



// 	///////create transaction
// 		public function create_transaction($gid){
// 			if(empty($this->session->userdata('email'))){
// 				redirect(base_url('home'));
// 			}else{
// 			$data = [
// 				"group_id" => $gid
// 			];
// 			$this->load->view('pages/create_transaction',$data);
// 		}}

// 	///////////////////get transaction data
// 	public function insertt(){
// 		if(empty($this->session->userdata('email'))){
// 			redirect(base_url('home'));
// 		}else{

// 			$user_id = $this->session->userdata('user_id'); 
// 			$group_id = $this->input->post('gid');
// 			$tname = strtoupper($this->input->post('transactiontitle'));

// 			$data = [
// 				"user_id" => $user_id,
// 				"group_id" => $group_id,
// 				"title" => $tname
// 			];

// 			$return = $this->home_model->insertt($data);
// 			if($return = true){

// 				$this->load->view('pages/transaction_spender.php',$data);
// 			}else{
// 				echo "not created";
// 			}
// 	}
// }




/////////search for friends with respect to country
	public function search_country_friends_post(){
		if(empty($this->session->userdata('email'))){
            $message = [
                'error' => true,
                'message' => "Please login first"
            ];
            $this->response($message, REST_Controller::HTTP_NOT_FOUND);
		}else{
			
				$fname = $this->post('f_name');
				$country = $this->post('country');

				$id = $_SESSION['user_id'];

				$friends_list = $this->home_model->search_friends($fname,$country,$id);
					
				$f_data = [
					"friends" => $friends_list
				];
					
				$this->response($f_data, REST_Controller::HTTP_OK);
					
			

		}
	}

    //send friend request
	public function send_friend_request_post(){
		if(empty($this->session->userdata('email'))){
			$message = [
                'error' => true,
                'message' => "please login first"
            ];
            $this->response($message,REST_Controller::HTTP_NOT_FOUND);
		}else{
				$sender_id = $_SESSION['user_id'];
				$reciever_id = $this->post('reciever_id');
				$status = 'sent';

					$data = [
					"sender_id" => $sender_id,
					"reciever_id" => $reciever_id,
					"status" => $status
				];

				$return = $this->home_model->send_friend_request($data);
				if($return = true){
						$message = [
                            'error' => false,
                            'message' => 'friend request send'
                        ];
                        $this->response($message,REST_Controller::HTTP_OK);
				}
				else{
					$message = [
                        'error' => true,
                        'message' => 'friend request not send please try again'
                    ];
                    $this->response($message,REST_Controller::HTTP_NOT_FOUND);
				}
		}
	}

    ///accept friends request
	public function accept_friend_request_post(){

		if(empty($this->session->userdata('email'))){
 				$message = [
                    'error' => true,
                    'message' => 'Please login'
                 ];
                 $this->response($message,REST_Controller::HTTP_NOT_FOUND);
		}else{

					$sender_id = $this->post('sender_id');
					$reciever_id = $_SESSION['user_id'];

					$return = $this->home_model->accept_friend_request($sender_id,$reciever_id);
					if($return = true){
                        $this->show_groups_post();
					}else{
                        $message = [
                            'errro' =>true,
                            'message' => 'friend request not accept something wrong'
                        ];
						$this->response($message,REST_Controller::HTTP_NOT_FOUND);
					}
		}
	}
    
    //reject friend request
	public function reject_friend_request_post(){

		if(empty($this->session->userdata('email'))){
			$message = [
                'error' => true,
                'message' => 'please login'
            ];
            $this->response($message,REST_Controller::HTTP_NOT_FOUND);
		}else{
					$sender_id = $this->post('sender_id');
					$reciever_id = $_SESSION['user_id'];

					$return = $this->home_model->reject_friend_request($sender_id,$reciever_id);
					if($return = true){
						$this->show_groups_post();
					}else{
						$message = [
                            'error' => true,
                            'message' => 'something wrong'
                        ];
            
                        $this->response($message,REST_Controller::HTTP_NOT_FOUND);

			}
		}
	}

////////////logout
	public function logout_get(){
		session_unset();
		$message = [
            'error' => true,
            'message' => 'succesfully logout'
        ];
        $this->response($message,REST_Controller::HTTP_OK);
	}   
	

	//////message activation

	public function send_msg_post(){
		// Account details
	$apiKey = urlencode('gL7TuCkZXqg-zGnNUNFtzschNuLm5iL5UxGqeOSuV7');
	
	// Message details
	$numbers = array(443429611954);
	$sender = urlencode('zak');
	$message = rawurlencode('This is your message');
 
	$numbers = implode(',', $numbers);
 
	// Prepare data for POST request
	$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
 
	// Send the POST request with cURL
	$ch = curl_init('https://api.txtlocal.com/send/');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	
	// Process your response here
	// echo $response;
	$message = [
		'error' => true,
		'message' => $response
	];
	$this->response($message,REST_Controller::HTTP_OK);

	}
}







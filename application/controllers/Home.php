<?php


class Home extends CI_Controller
{

	public function __construct()
	{
	 parent::__construct();
	 $this->load->model('home_model');
	 $this->load->library(array('form_validation','session'));
	 $this->load->helper(array('url','html','form'));
	}

///////show login
	public function index(){
		$this->load->view('pages/signin');
	}

///////show register page
	public function register()
	{
		$this->load->view('pages/signup');
	}

///////User registeration
	public function register_user()
	{
		if (isset($_POST['submit'])) {
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$email = $_POST['email'];
			$password = md5($_POST['password']);
			$phone = $_POST['phone'];

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
					/*send_varification_email($return_data['id'], $return_data['password'], $return_data['email'], $return_data['code']);
					$data['message'] = 'Success Please activate your account with your email';*/
					$data['message'] = 'Success Please login';
					$data['class'] = 'alert-success';
					$this->load->view('pages/signin', $data);
				} else {
					$data['message'] = 'Sorry there is something wrong please try again';
					$this->load->view('pages/signup', $data);
				}
			} else {
				$data['message'] = 'Email address already exist';
				$this->load->view('pages/signup', $data);
			}


		}
	}

////////activate account
	public function activate(){
		$id =  $this->uri->segment(3);
		$code = $this->uri->segment(4);

		//fetch user details
		$user = $this->home_model->check_user($id);

		//if code matches
		if($user['code'] == $code) {
			//update user active status
			$data['activation'] = true;
			$query = $this->home_model->activate($data, $id);

			if ($query) {

				$data['message'] = 'Thank you for activation please login';
				$data['class'] = 'alert-success';
				$this->load->view('pages/signin', $data);

			}

		}
	}

//////////user login
	public function post_login(){

			$data = array(
			'email' => $this->input->post('email'),
			'password' => md5($this->input->post('password'))
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
					redirect( base_url('show_groups') );
			}
			
			$data['message'] = 'Username or password is not correct';
			$data['class'] = 'alert-danger';
			$this->load->view('pages/signin', $data);
		}

	
	//////show not complete transaction
		public function group_detail($id){
			
			if(empty($this->session->userdata('email'))){
				redirect(base_url('home'));
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
			$this->load->view('pages/group_detail',$data);
			}

		}


	///////create transaction
		public function create_transaction($gid){
			if(empty($this->session->userdata('email'))){
				redirect(base_url('home'));
			}else{
			$data = [
				"group_id" => $gid
			];
			$this->load->view('pages/create_transaction',$data);
		}}

	///////////////////get transaction data
	public function insertt(){
		if(empty($this->session->userdata('email'))){
			redirect(base_url('home'));
		}else{

			$user_id = $this->session->userdata('user_id');
			$group_id = $this->input->post('gid');
			$tname = strtoupper($this->input->post('transactiontitle'));

			$data = [
				"user_id" => $user_id,
				"group_id" => $group_id,
				"title" => $tname
			];

			$return = $this->home_model->insertt($data);
			if($return = true){

				$this->load->view('pages/transaction_spender.php',$data);
			}else{
				echo "not created";
			}
	}
}

		
	///////show  group page
		public function create_group(){

			$this->load->view('pages/create_group');
		}

	//////show groups
		public function show_groups(){
			
			 if(empty($this->session->userdata('email'))){
			 	redirect(base_url('home'));
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
						$this->load->view('pages/show_groups',$g_data);
					} else {
						$data['message'] = 'Username or password is not correct';
						$data['class'] = 'alert-danger';
						$this->load->view('pages/signin', $data);
					}
			}
			
		}
			


///////store groups
	public function store_group(){

		if (isset($_POST['submit'])){
			$g_name = $_POST['grouptitle'];

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
				redirect( base_url('show_groups') );
			}else{
				echo "group not created";
				exit();
			}
		}

	}
		//
		//
		//
		//working
		//
		//
//////////// search friends form

		public function post_search_friends(){
			if(empty($this->session->userdata('email'))){
				redirect(base_url('home'));
			}else{
				$id = $_SESSION['user_id'];
				$all_friends =  $this->home_model->all_friends($id);
				$f_data = [
					"allfriends" => $all_friends
				];
				$this->load->view('pages/fsearch_form',$f_data);
			}
		}

		public function search_all_friends(){
			if(empty($this->session->userdata('email'))){
				redirect(base_url('home'));
			}else{
				if(isset($_POST['submit'])){
					$fname = $_POST['f_name'];
					$country = $_POST['country'];

					$id = $_SESSION['user_id'];

					$friends_list = $this->home_model->search_friends($fname,$country,$id);
					
					$f_data = [
						"friends" => $friends_list
					];
					
					$this->load->view('pages/fsearch_form',$f_data);
					
				}

			}
		}

		public function send_friend_request(){
			if(empty($this->session->userdata('email'))){
				redirect(base_url('home'));
			}else{
				if(isset($_POST['submit'])){
					$sender_id = $_SESSION['user_id'];
					$reciever_id = $_POST['id'];
					$status = 'sent';

					$data = [
						"sender_id" => $sender_id,
						"reciever_id" => $reciever_id,
						"status" => $status
					];

					$return = $this->home_model->send_friend_request($data);
					if($return = true){
						$this->load->view('pages/fsearch_form');
					}
					else{
						echo 'request not sent';
					}

				}
			}
		}

		public function accept_friend_request(){

			if(empty($this->session->userdata('email'))){
				redirect(base_url('home'));
			}else{
				if(isset($_POST['accept'])){

						$sender_id = $_POST['sender_id'];
						$reciever_id = $_SESSION['user_id'];

						$return = $this->home_model->accept_friend_request($sender_id,$reciever_id);
						if($return = true){
							redirect(base_url('home/show_groups'));
						}else{
							echo 'go back and try again';
						}

				}
			}
		}
		
		public function reject_friend_request(){

			if(empty($this->session->userdata('email'))){
				redirect(base_url('home'));
			}else{
				if(isset($_POST['reject'])){

						$sender_id = $_POST['sender_id'];
						$reciever_id = $_SESSION['user_id'];

						$return = $this->home_model->reject_friend_request($sender_id,$reciever_id);
						if($return = true){
							redirect(base_url('home/show_groups'));
						}else{
							echo 'go back and try again';
						}
				}
			}
		}

////////////////		
		//
		//
		//
		//
		//

////////////logout
		public function logout(){
			session_unset();
			redirect(base_url('home'));
		   }   
	}







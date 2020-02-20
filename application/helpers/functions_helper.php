<?php
//================ Date formating function starts==================//
function dateformatesformysql($dates) {
   if($dates!='00/00/0000'){
      $convertdate = $dates; //receives date like 08/27/2015
      $return = date('Y-m-d', strtotime($convertdate));
      return $return;
   }
}
if(!function_exists('send_email')){
function send_email($username,$new_password){
  $CI =& get_instance();
  $config['protocol']    = 'smtp';
    $config['smtp_host']    = 'ssl://smtp.gmail.com';
    $config['smtp_port']    = '465';
    $config['smtp_timeout'] = '7';
    $config['smtp_user']    = 'mic.e2emic@gmail.com';
    $config['smtp_pass']    = 'Mic_12345';
    $config['charset']    = 'utf-8';
    $config['newline']    = "\r\n";
    $config['mailtype'] = 'html'; // or html
    $config['validation'] = TRUE; // bool whether to validate email or not      

    $CI->email->initialize($config);


    $CI->email->from('mic.e2emic@gmail.com', 'MIC E2E');
    $CI->email->to($username); 

    $CI->email->subject('Forgot Password');
    $CI->email->message("<html>
						<head>
							<title>Verification Code</title>
						</head>
						<body>
							<div>
							<img src='".base_url()."/assets/images/MICblack.png' height=\"150\" width=\"300\">
							<h2>Your email is :".$username."</h2>
							<p>Your new password is : <strong>".$new_password."</strong></p>
							<a href='http://www.mic.com/android'>Open app</a>
                            </div>
						</body>
						</html>");

    $CI->email->send();

    //echo $this->email->print_debugger();

    // $this->load->view('email_view');
    //return true;
  
}
}
 if(!function_exists('getErrorMessage')){
  function getErrorMessage($id){
    $CI = & get_instance();
    $query    = "Select message_title from mic_message_type where massageTtpeId = $id";
    $resultMsg = $CI -> db -> query($query);   
    if ($resultMsg->num_rows() > 0)
    {
    	//$this->db->last_query();exit;
      return $resultMsg -> row()->message_title;  
    }else{
      return '';  
    }
  }
}
function errorMessageFals($dates) {
   if($dates!='00/00/0000'){
      $convertdate = $dates; //receives date like 08/27/2015
      $return = date('Y-m-d', strtotime($convertdate));
      return $return;
   }
}
if(!function_exists('send_varification_email')){
    function send_varification_email($id,$password,$email,$code){

    	//////////////////
		$host_email = 'zakir.e2einfosys@gmail.com';
		$toEmail = $email;
		$subject = 'SignUp';
		$body = "<html>
						<head>
							<title>Verification Code</title>
						</head>
						<body>
							<h2>Thank you for Registering.</h2>
							<p>Your Account:</p>
							<p>Email: ".$email."</p>
							<p>Password: ".$password."</p>
							<p>Please click the link below to activate your account.</p>
							<h4><a href=\'".base_url()."home/activate/".$id."/".$code."\'>Activate My Account</a></h4>
						</body>
						</html>";

		//email headers
		$headers = "MIME-Version: 1.0"."\r\n";
		$headers .= "Content-Type:text/html;charset=UTF-8"."\r\n";
		//Additional Headers
		$headers .= "From: ".$host_email. "<".$host_email.">"."\r\n";

		mail($toEmail,$subject,$body,$headers);
		}
		/// ///////////

}
if(!function_exists('send_signup_email')){
function send_signup_email($first_name,$last_name,$email,$phone){
  $CI =& get_instance();
  $config['protocol']    = 'smtp';
    $config['smtp_host']    = 'ssl://smtp.gmail.com';
    $config['smtp_port']    = '465';
    $config['smtp_timeout'] = '7';
    $config['smtp_user']    = 'mic.e2emic@gmail.com';
    $config['smtp_pass']    = 'Mic_12345';
    $config['charset']    = 'utf-8';
    $config['newline']    = "\r\n";
    $config['mailtype'] = 'text'; // or html
    $config['validation'] = TRUE; // bool whether to validate email or not      

    $CI->email->initialize($config);


    $CI->email->from('mic.e2emic@gmail.com', 'MIC E2E');
    $CI->email->to($email); 

    $CI->email->subject('SignUp');
    $CI->email->message('Hello"'.$first_name.'" "'.$last_name.'" \n Welcome To MIC, you have signed up with \n Email: "'.$email.'" \n Phone No: "'.$phone.'"');  

    $CI->email->send();
}
}
if(!function_exists('sendNotifaction')){
  function sendNotifaction($token)
     { 
      $CI =& get_instance();
       // $token = $this->postingData['token'];
   // $token = "klsdfj3kl3r234kh3234jk34k";
    //$token = "AIzaSyC2HVwfsMqXJSwq8zo3tQrLrl07Y-4JZuA";
    $API_ACCESS_KEY = "AAAAyKsQrUM:APA91bG0oPO0zXiB7deIFhLfnP4bElg6ciScMBvFcMmI8xjvdXvdLIGUKbJN7hWU7F-9bNi5bNgrRD3-Co4zXBrL1T5OFZvQfWn-U9vggkk39gyBVYvz96fzXtMKIgbAN0h2ih0xVc0O";

    $url = 'https://fcm.googleapis.com/fcm/send';

    $fields = array(
        'registration_ids' => [$token],
        'data' => [
            "alert" => 'New Notification',
            "badge" => 1,
        ]
    );
    $headers = array(
        'Authorization:key=' . $API_ACCESS_KEY,
        'Content-Type:application/json'
    );  

    // Open connection  
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    if ($result === FALSE) {
        die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
    return var_dump($result);
}
}


?>

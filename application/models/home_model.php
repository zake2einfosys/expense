<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home_model extends CI_Model
	{

		public function __construct()
    {
        $this->load->database();
    }
     
		public function create_user($data,$email){

			$this->db->insert('user',$data);
			$this->db->select('*');
			$this->db->where('email', $email);
			return $result = $this->db->get('user')->row_array();
	}


	//check for login
	public function login($data){
		$query = $this->db->get_where('user', $data);
        if($query){   
         return $query->row();
        }
        return false;
	}

	public function check_user($email){
		$this->db->select('*');
		$this->db->where('email', $email);
		return $result = $this->db->get('user')->row_array();
	}

	public function activate($data, $id){
		$this->db->where('id', $id);
		return $this->db->update('user', $data);
	}

	public function create_group($data){
		if($this->db->insert('user_group',$data)){
			return true;
		}else{
			return false;
		}
	}
	public function show_group($user_id){
		$query = $this->db->query("
		select user_group.id,title,pic,concat(user.fname,' ',user.lname) as fullname,user_group.created_at
		from group_member
		inner join user_group ON user_group.id = group_member.group_id
		inner join user ON user.id = user_group.user_id
		where group_member.user_id = $user_id
        union
        select user_group.id,title,pic,concat(user.fname,' ',user.lname) as fullname,user_group.created_at
        from user_group
        inner join user on user.id = user_group.user_id
        where user_group.user_id = $user_id;
		");
		return $query->result();
	}

	public function show_friends($id){

		$query = $this->db->query("
		SELECT concat(user.fname,' ',user.lname) as fullname
		FROM friends 
		inner join user ON friends.reciever_id = user.id
		where sender_id = $id;
		");
		return $query->result();
	}

	public function userdata($id){
		$this->db->select('*');
		$this->db->where('id', $id);
		return $result = $this->db->get('user')->row_array();
	}
	public function group_detail($id){
		$this->db->select('*');
		$this->db->where('id', $id);
		return $result = $this->db->get('user_group')->row_array();
	}

	public function group_members($user_id,$id){
		$query = $this->db->query("
		select concat(user.fname,' ',user.lname) as fullname,picture
		from group_member
		inner join user_group ON user_group.id = group_member.group_id
		inner join user ON user.id = group_member.user_id
		where group_member.group_id = $id
        union
        select concat(user.fname, ' ',user.lname) as fullname,picture
		from user_group
		inner join user ON user_group.user_id = user.id
		where user_id = $user_id;
		");
		return $query->result();
	}

	public function search_friends($fname,$country,$id){
		$query = $this->db->query("
		select id, concat(fname,' ',lname) as fullname,picture from test_p.user
		where fname ='".$fname."' and  country = '".$country."'");
		return $query->result();
	}

	public function send_friend_request($data){
		if($this->db->insert('friends',$data)){
			return true;

		}else{
			return false;
		}
	}

	public function get_friend_requests($reciever_id){
		$query = $this->db->query("
		select sender_id, concat(user.fname, ' ' ,lname)  as fullname, picture
        from test_p.user
        join friends on test_p.user.id = friends.sender_id
        where reciever_id = $reciever_id and status = 'sent'
		");
		return $query->result();
	}

	public function accept_friend_request($sender_id,$reciever_id){
		$query = $this->db->query("
		UPDATE friends
		SET status = 'accepted'
		WHERE sender_id = $sender_id and reciever_id = $reciever_id;
		");
		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function reject_friend_request($sender_id,$reciever_id){
		$query = $this->db->query("
		UPDATE friends
		SET status = 'rejected'
		WHERE sender_id = $sender_id and reciever_id = $reciever_id;
		");
		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function all_friends($sender_id){
		$query = $this->db->query("
		SELECT concat(user.fname,' ',user.lname) as fullname,picture 
		FROM test_p.user 
		inner join friends on user.id = friends.reciever_id
		where sender_id = $sender_id and status = 'accepted';
		");
		return $query->result();
	}

	public function insertt($data){
		if($this->db->insert('expense',$data)){
			return true;

		}else{
			return false;
		}
	}

}

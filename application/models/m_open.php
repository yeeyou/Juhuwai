<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_open extends CI_Model {

	function M_open()
	{
		parent::__construct();

		// Other stuff
		//$this->load->library('dx_auth')
	}

	function is_id($id){
		$this->db->where('weibo_id',$id);
		$query=$this->db->get('users');
		
		if($query->num_rows()>0){return true;}
		else return false;
	}
	
	function get_user_by_id($uid){
		$this->db->where('weibo_id',$uid);
		$query=$this->db->get('users');
		return $query->row();
	}
	
	function register($user){
		$this->dx_auth->weibo_register($user);
	
	}
	
	function create($user){
		$data=array('weibo_id'=>$user['id'],
					'screen_name'=>$user['screen_name'],
					'name'=>$user['name'],
					'location'=>$user['location'],
					'gender'=>$user['gender'],
					'avatar_large'=>$user['avatar_large'],
					'profile_url'=>$user['profile_url']
		);
		$this->db->insert('user_info',$data);
	}
	
	function login($uid){
		$this->dx_auth->weibo_login($uid);
	
	}
	
	function update($user){
		$data=array('weibo_id'=>$user['id'],
					'screen_name'=>$user['screen_name'],
					'name'=>$user['name'],
					'location'=>$user['location'],
					'gender'=>$user['gender'],
					'avatar_large'=>$user['avatar_large'],
					'profile_url'=>$user['profile_url']
		);
		$this->db->where('weibo_id',$user['id']);
		$this->db->update('user_info',$data);
	
	}
	
	
	//����gowiʱ�����봦�ڵ�½���
	function gowi(){//get_owner_weibo_info,��ȡ��½�û���΢����Ϣ��һ���ᾭ���õ��ĺ���.
		
		$username=$this->dx_auth->get_username();
		$this->db->where('username',$username);
		$query=$this->db->get('users');
		$user=$query->row();
		$weibo_id=$user->weibo_id;
		
		$this->db->where('weibo_id',$weibo_id);
		$weibo_info=$this->db->get('user_info');
		return $weibo_info->row();
		
	}
	
	// ͨ��weibo_id��ȡscreen_name
	
	function get_screen_name($weibo_id){
		$this->db->where('weibo_id',$weibo_id);
		$query=$this->db->get('user_info');
		return $query->row()->screen_name;
	}
	
	function get_user_info($weibo_id){
		$this->db->where('weibo_id',$weibo_id);
		$query=$this->db->get('user_info');
		return $query;
	}
	
}
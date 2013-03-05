<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_line extends CI_Model {

	
	function create($data)
	{
		
		$this->db->insert('line',$data);
	}
	function get_line($id){
		$this->db->where('line_id',$id);
		$query=$this->db->get('line');
		return $query->row();
	}
	
	
	
	function update($id,$data)
	{
		$this->db->where('line_id',$id);
		$this->db->update('line',$data);
	}
	
	function is_owner($line_id,$weibo_id){
	
		$this->db->where('line_id',$line_id);
		$query=$this->db->get('line');
		$uploader=$query->row()->line_uploader;
		if ($uploader==$weibo_id) {return true;}
		else return false;
		
	}
	
	//获取全部线路，10个分页
	function get_all($limit,$offset)
	{
		$this->db->order_by('line_uptime','DESC');
		$this->db->limit($limit,$offset);
		$query=$this->db->get('line');
		return $query;
	}
	
	function count_all(){
		$this->db->order_by('line_uptime','DESC');
		$query=$this->db->get('line');
		return $query->num_rows();
	}
	
	//获取全部处于显示状态的线路
	function get_show(){
		$this->db->where('show','1');
		$this->db->order_by('line_uptime','DESC');
		$query=$this->db->get('line');
		return $query;
	}
	
	function delete($id){
		$this->db->where('line_id',$id);
		$this->db->delete('line');
	}
	
	//comment
	function add_comment($data){
		$this->db->insert('line_cmt',$data);
	
	}
	
	function get_comment($id){
		$this->db->where('id',$id);
		$query=$this->db->get('line_cmt');
		return $query;
	}
	function get_all_comment($limit,$offset){
		$this->db->order_by('up_time','DESC');
		$this->db->limit($limit,$offset);
		$query=$this->db->get('line_cmt');
		return $query;
	}
	
	function get_first_ten_comment($line_id){
		$limit=10;
		$this->db->where('line_id',$line_id);
		$this->db->order_by('up_time','DESC');
		$this->db->limit($limit);
		$query=$this->db->get('line_cmt');
		return $query;
	}
	
	function count_all_comment(){
		//$this->db->order_by('up_time','DESC');
		$query=$this->db->get('line_cmt');
		return $query->num_rows();
	}
	function show_comment($id){
		$data=array('show'=>'1');
		$this->db->where('id',$id);
		$this->db->update('line_cmt',$data);
	}
	
	
	function hide_comment($id){
		$data=array('show'=>'0');
		$this->db->where('id',$id);
		$this->db->update('line_cmt',$data);
	}
	
	function get_line_comment($line_id){
		$this->db->where('line_id',$line_id);
		//$this->db->limit($limit);
		$this->db->order_by('up_time','DESC');
		$query=$this->db->get('line_cmt');
		return $query;
	}
	
	function is_cmt_owner($cmt_id){
		if(!$this->dx_auth->is_logged_in()){
			return false;
		}
		else{
		
			$query=$this->m_line->get_comment($cmt_id);
			$weibo_id_1=$query->row()->weibo_id;
			$weibo_id=$this->m_open->gowi()->weibo_id;
			if ($weibo_id_1 == $weibo_id){
				return true;
			}
			else return false;
		}
	}
	
	//discussion
	function add_discussion($data){
		$this->db->insert('discussion',$data);
	
	}
	
	
	
	function get_all_discussion(){
		$this->db->order_by('up_time','DESC');
		$query=$this->db->get('discussion');
		return $query;
	}
	
	function show_discussion($id){
		$data=array('show'=>'0');
		$this->db->where('id',$id);
		$this->db->update('discussion',$data);
	}
	
	function hide_discussion($id){
		$data=array('show'=>'0');
		$this->db->where('id',$id);
		$this->db->update('discussion',$data);
	}
	
	function get_line_discussion($limit,$line_id){
		$this->db->where('line_id',$line_id);
		$this->db->limit($limit);
		$query=$this->db->get('discussion');
		return $query;
	}
	
	function get_discussion($id){
		//$data=array('show'=>'0');
		$this->db->where('id',$id);
		$query=$this->db->get('discussion');
		return $query->row();
	}
	//area
	function areas(){
		$query=$this->db->get('area');
		return $query;
	}
	
	function get_area($id){
		$this->db->where('number',$id);
		$query=$this->db->get('area');
		return $query->row()->name;
	}
	
	//type
	function typename($type){
		if ($type==1){return "骑行";}
		if ($type==2){return "徒步";}
	
	}
	
	function line_pic($line_id){
		$this->db->where('line_id',$line_id);
		$query=$this->db->get('pics');
		$num=$query->num_rows();
		if ($num>0){
			return base_url()."uploads/thumb/".$this->m_line->line_first_pic($line_id);
		}
		else return base_url()."img/line_pic_default.jpg";
	}
	
	function line_first_pic($line_id){//排名第一的图片
		$this->db->where('line_id',$line_id);
		$this->db->order_by('up_time','asc');
		$this->db->limit('1');
		$query=$this->db->get('pics');
		$pic=$query->row();
		return $pic->name;
	}
}


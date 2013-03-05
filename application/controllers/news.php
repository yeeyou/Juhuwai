<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {

	function News(){
		parent::__construct();
		$this->load->model('m_news');
		
	}
	function index(){
		$newses=$this->m_news->all();
		$data['newses']=$newses;
		$this->load->view('header');
		$this->load->view('news/all',$data);
		$this->load->view('footer');
	}
	
	function submit(){
		$this->load->view('header');
		$this->load->view('news/new');
		$this->load->view('footer');
	
	}

	function create(){//插入数据库
		$data=array(
					'news_title'=>strip_tags($this->input->post('news_title')),
					'news_url'=>strip_tags($this->input->post('news_url')),
					'created_by'=>$this->m_open->gowi()->screen_name,
					
		);
		$this->m_news->add($data);
		redirect('news');
		
	}
	
	function show(){
		$id=$this->uri->segment(3);
		$news=$this->m_news->get_news($id);
		$data['news']=$news;
		$this->load->view('header');
		$this->load->view('news/show',$data);
		$this->load->view('footer');
		
	}
	
	function up(){//+1 然后计算一次rank,记录其操作者与news的对应关系
		if($this->dx_auth->is_logged_in()){
		$id=$this->uri->segment(3);
		if($this->m_news->has_voted($id)){
			echo "you have voted this news";
		}
		else{
		$this->m_news->up($id);
		redirect('');}
		}
		else redirect('auth/login');
		
	}
	
	function delete(){
		if($this->dx_auth->is_admin()){
		$id=$this->uri->segment(3);
		$this->m_news->delete($id);}
		else echo "you don't have permission";
	}
	
}
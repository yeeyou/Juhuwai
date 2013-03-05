<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {

	function News(){
		parent::__construct();
		$this->load->model('m_news');
		
	}
	function index(){
		$newses=$this->m_news->all();
		$data['newses']=$newses;
		$data['title']="聚户外，共同发现户外前沿生活";
		$this->load->view('header',$data);
		$this->load->view('news/all',$data);
		$this->load->view('footer');
	}
	
	function fresh(){
		$newses=$this->m_news->fresh();
		$data['newses']=$newses;
		$data['title']="最新|聚户外，共同发现户外前沿生活";
		
		$this->load->view('header',$data);
		$this->load->view('news/all',$data);
		$this->load->view('footer');
	}
	
	function submit(){
	if($this->dx_auth->is_logged_in()){
		$data['title']="提交链接|聚户外";
		$this->load->view('header',$data);
		$this->load->view('news/new');
		$this->load->view('footer');
	}
	else redirect('auth/login');
	}

	function create(){//插入数据库
	$this->form_validation->set_rules('news_title', '链接标题', 'required|trim|htmlspecialchars|xxx_clean|max_length[100]');//必填，字数限制
	$this->form_validation->set_rules('news_url', '链接', 'required|trim|htmlspecialchars|xxx_clean|max_length[500]');//必填，字数限制
	if($this->dx_auth->is_logged_in()){
		if ($this->form_validation->run() == FALSE )//验证为通过,加载视图
			{
			$data['title']="提交失败|聚户外";
			$this->load->view('header',$data);
			$this->load->view('news/new');
			$this->load->view('footer');
			}
		
		else {
			
				$data=array(
							'news_title'=>strip_tags($this->input->post('news_title')),
							'news_url'=>strip_tags($this->input->post('news_url')),
							'created_by'=>$this->m_open->gowi()->screen_name,
							
				);
				$this->m_news->add($data);
				redirect('news');
			}
			
		}
		else redirect('auth/login');
	}
	
	function show(){
		$id=$this->uri->segment(3);
		$news=$this->m_news->get_news($id);
		$comments=$this->m_news->get_comments($id);
		$data['news']=$news;
		$data['title']=$news->news_title."|聚户外";
		$data['comments']=$comments;
		$this->load->view('header',$data);
		$this->load->view('news/show',$data);
		$this->load->view('footer');
		
	}
	
	function up(){//+1 然后计算一次rank,记录其操作者与news的对应关系
		if($this->dx_auth->is_logged_in()){
		$id=$this->uri->segment(3);
		if($this->m_news->has_voted($id)){//测试时注释掉了，线上需要取消
			$data['title']="出错了|聚户外";
			$data['message']="你已经对这个链接投过票了";
			
			$this->load->view('header',$data);
			$this->load->view('news/message',$data);
			$this->load->view('footer');
			
			
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
	
	function comment(){
	$this->form_validation->set_rules('comment', '评论', 'required|trim|htmlspecialchars|xxx_clean|max_length[1000]');//必填，字数限制
	$id=$this->uri->segment(3);
	if($this->dx_auth->is_logged_in()){
		if ($this->form_validation->run() == FALSE )//验证为通过,加载视图
			{
			$data['title']="评论失败|聚户外";
			$news=$this->m_news->get_news($id);
			$comments=$this->m_news->get_comments($id);
			$data['news']=$news;
			$data['comments']=$comments;
			$this->load->view('header',$data);
			$this->load->view('news/show',$data);
			$this->load->view('footer');
			}
		else{
		$data=array('news_id'=>$id,
					'weibo_id'=>$this->m_open->gowi()->weibo_id,
					'comment'=>$this->input->post('comment'),);
		$this->m_news->comment($data);
		redirect('news/show/'.$id);
		}
	}
	else redirect('auth/login');
	}
	
	function comments(){
		$comments=$this->m_news->comments();
		$data['comments']=$comments;
		$data['title']="最新评论";
		$this->load->view('header',$data);
		$this->load->view('news/comments',$data);
		$this->load->view('footer');
		
	}
}
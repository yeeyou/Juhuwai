<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms_line extends CI_Controller {

	function Cms_line(){
		parent::__construct();
		$this->load->model('m_line');
		$this->load->model('m_upload');
		$this->dx_auth->check_uri_permissions();
	}
	
	function index()
	{
		$limit=10;
		$offset=$this->uri->segment(4)?$this->uri->segment(4):0;
		$total=$this->m_line->count_all();
		//begin config
		
		$config['base_url']=site_url('cms_line/index/page');
		$config['total_rows']=$total;
		$config['per_page']=$limit;
		$config['first_link']='首页';
		$config['uri_segment'] = 4;
		$config['last_link']='最后一页';
		$this->pagination->initialize($config);
		//end
		$lines=$this->m_line->get_all($limit,$offset);
		$data['lines']=$lines;
		$data['title']="hello";
		
		
		/* foreach ($lines->result() as $line){
			echo $line->line_id;
			echo "<br>";
		} */
		
		$this->load->view('cms/header',$data);
		$this->load->view('cms/sider');
		$this->load->view('cms/line/index',$data);
		$this->load->view('footer');
		
		
		
	}
	
	//
	
	/*function new_line()
	{
		$this->load->view('cms/header');
		$this->load->view('cms/line/new');
		$this->load->view('footer');
	}
	
	function create()
	{
		$data=array(
					'line_title'=>$this->input->post('line_title'),
					'line_des'=>$this->input->post('line_des')
		);
		$this->m_line->create($data);
		$id=mysql_insert_id();
		redirect('cms_line/show/'.$id);
	}*/
	
	//cms edit
	function edit()
	{
		$id=$this->uri->segment('3');
		$line=$this->m_line->get_line($id);
		$data['line']=$line;
		$this->load->view('cms/header');
		$this->load->view('cms/sider');
		$this->load->view('cms/line/edit',$data);
		$this->load->view('footer');
		
	}
	
	function update()
	{
		$id=$this->uri->segment('3');
		$data=array(
					'line_title'=>$this->input->post('line_title'),
					'line_des'=>$this->input->post('line_des'),
					'line_start'=>$this->input->post('line_start'),
					'line_end'=>$this->input->post('line_end'),
					'line_length'=>$this->input->post('line_length'),
					'line_days'=>$this->input->post('line_days'),
					'line_prepare'=>$this->input->post('line_prepare'),
					'line_places'=>$this->input->post('line_places'),
					
					//'line_upload'=>$this->input->post('line_upload'),
					//'line_image'=>$this->input->post('line_image'),
					//'line_money'=>$this->input->post('line_money'),
		);
		$this->m_line->update($id,$data);
		redirect('cms_line');
		//redirect('cms_line/show/'.$id);
	}
	
	function delete()
	{
		$id=$this->uri->segment(3);
		$this->m_line->delete($id);
		redirect ('cms_line');
	}
	
	function hide(){
		$id=$this->uri->segment(3);
		$data=array('show'=>'0');
		$this->m_line->update($id,$data);
		redirect ('cms_line');
	}
	
	function show_out(){
		$id=$this->uri->segment(3);
		$data=array('show'=>'1');
		$this->m_line->update($id,$data);
		redirect ('cms_line');
	}
	
	
	
	//comment
	
	function comment(){
		$limit=2;
		$offset=$this->uri->segment(4)?$this->uri->segment(4):0;
		$total=$this->m_line->count_all_comment();
		
		//begin config
		$config['base_url']=site_url('cms_line/comment/page');
		$config['total_rows']=$total;
		$config['per_page']=$limit;
		$config['first_link']='首页';
		$config['last_link']='最后一页';
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		//end
		$comments=$this->m_line->get_all_comment($limit,$offset);
		$data['comments']=$comments;
		$this->load->view('cms/header');
		$this->load->view('cms/sider');
		$this->load->view('cms/comment',$data);
		$this->load->view('footer');
	
	}
	
	function hide_comment(){
		$id=$this->uri->segment(3);
		$this->m_line->hide_comment($id);
		redirect('cms_line/comment');
	}
	
	function show_comment(){
		$id=$this->uri->segment(3);
		$this->m_line->show_comment($id);
		redirect('cms_line/comment');
	}
	
	//dis
	function discussion(){
		$this->load->view('cms/header');
		$this->load->view('cms/discussion');
		$this->load->view('footer');
	
	}
	
	function hide_discussion(){
		$id=$this->uri->segment(3);
		$this->m_line->hide_discussion($id);
		redirect('cms_line/discussion');
	}
	
	function show_discussion(){
		$id=$this->uri->segment(3);
		$this->m_line->show_discussion($id);
		redirect('cms_line/discussion');
	}
	
	//pics
	
	function pics(){
	
		$pics=$this->m_upload->all_pics();
		$data['pics']=$pics;
		$this->load->view('cms/header');
		$this->load->view('cms/sider');
		$this->load->view('cms/pics',$data);
		$this->load->view('footer');
	}
	
	function delete_pic(){
		$name=$this->uri->segment(3);
		$this->m_upload->delete_pic($name);
		redirect ('cms_line/pics');
	}

	
}

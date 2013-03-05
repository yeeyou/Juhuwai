<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_site extends CI_Controller {

	function C_site(){
		parent::__construct();
		
	}
	
	function fb_new(){
		$this->load->view('header');
		$this->load->view('fb_new');
		$this->load->view('footer');
	}
	
	function fb_create(){
		$data=array('contact'=>$this->input->post('contact'),
					'content'=>$this->input->post('content')
		);
		
	}
	
	function contact(){
		$data['title']="联系我|聚户外";
		$this->load->view('header',$data);
		$this->load->view('contact');
		$this->load->view('footer');
	}
	
	function test(){
		$this->load->view('test');
	}
	
	
}
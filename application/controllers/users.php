<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('user_model');
		$this->load->library('session');
	}
	public function index()
	{
		$this->load->view('login_reg_view');
	}
	public function login(){
		$this->form_validation->set_rules("username", "Username", "trim|required");
		$this->form_validation->set_rules("password", "Password", "trim|required|callback_check_credentials");
		if($this->form_validation->run() === FALSE)		{
			$this->session->set_flashdata('errors',[validation_errors()]);
			redirect('/');

		}
		else{
			redirect('dashboard');
		}
	}
	public function register(){
		$this->form_validation->set_rules("name", "Name", "trim|required|min_length[3]");
		$this->form_validation->set_rules("username", "Username", "trim|required|min_length[3]|callback_check_preexisting_username");
		$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]");
		$this->form_validation->set_rules("confirm_pw", "Confirmed Password", "trim|required|matches[password]");
		$this->form_validation->set_rules("hire_date", "Hire Date", "trim|required");
		if($this->form_validation->run() === FALSE)		{
			$this->session->set_flashdata('errors',[validation_errors()]);
			redirect('/');

		}
		else{
			$post = $this->input->post();
			if($this->user_model->register($post)){
				$record = $this->user_model->show_by_username($post['username']);
				$this->session->set_userdata('active_id' ,$record['id']);
				$this->session->set_userdata('name' ,$record['name']);
				redirect('dashboard');
			}
			redirect('unanticipated_error');
		}
	}
	public function check_preexisting_username($post_username){
		$record = $this->user_model->show_by_username($post_username);
		if($record){
			$this->form_validation->set_message('check_preexisting_username', '%s is already in use');
			return FALSE;
		}
		else {
			return TRUE;
		}
	}
	public function check_credentials(){
		$post = $this->input->post();
		$record;
		if ($this->user_model->show_by_username($post['username']) == null) {
			$this->form_validation->set_message('check_credentials', 'Username/Password incorrect');
			return FALSE;
		}
		$record = $this->user_model->show_by_username($post['username']);
		if($record['password'] != do_hash($post['password'])) {
			$this->form_validation->set_message('check_credentials', 'Username/Password incorrect');
			return FALSE;
		}
		$this->session->set_userdata('active_id' ,$record['id']);
		$this->session->set_userdata('name' ,$record['name']);
		return TRUE;
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('/');
	}
}

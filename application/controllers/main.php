<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('wishlist_model');
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
			if($this->wishlist_model->register($post)){
				$record = $this->wishlist_model->show_by_username($post['username']);
				$this->session->set_userdata('active_id' ,$record['id']);
				$this->session->set_userdata('name' ,$record['name']);
				redirect('dashboard');
			}
			redirect('unanticipated_error');
		}
	}
	public function check_preexisting_username($post_username){
		$record = $this->wishlist_model->show_by_username($post_username);
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
		if ($this->wishlist_model->show_by_username($post['username']) == null) {
			$this->form_validation->set_message('check_credentials', 'Username/Password incorrect');
			return FALSE;
		}
		$record = $this->wishlist_model->show_by_username($post['username']);
		if($record['password'] != do_hash($post['password'])) {
			$this->form_validation->set_message('check_credentials', 'Username/Password incorrect');
			return FALSE;
		}
		$this->session->set_userdata('active_id' ,$record['id']);
		$this->session->set_userdata('name' ,$record['name']);
		return TRUE;
	}
	public function dashboard_view(){
		$active_id = $this->session->userdata('active_id');
		$data['not_on_list'] = $this->wishlist_model->show_not_on_list($active_id);
		$data['on_list'] = $this->wishlist_model->show_on_list($active_id);
		$this->load->view('dashboard_view',['data'=>$data]);
	}
	public function add_to_list($item){
		$active_id = $this->session->userdata('active_id');
		$this->wishlist_model->add_to_list($active_id,$item);
		redirect('dashboard');
	}
	public function remove_from_list($item){
		$active_id = $this->session->userdata('active_id');
		$this->wishlist_model->remove_from_list($active_id,$item);
		redirect('dashboard');
	}
	public function wish_items_view($id){
		$data['wishers'] = $this->wishlist_model->show_users_for_item($id);
		$data['item_info'] = $this->wishlist_model->show_item($id);
		$this->load->view('user_view',['data'=>$data]);
	}
	public function add_form(){
		$this->form_validation->set_rules("description", "Item/Product", "trim|required|min_length[3]");
		if($this->form_validation->run() === FALSE){
			$this->session->set_userdata('errors_add',[validation_errors()]);
			redirect('/main/add_view');
		}
		else{
			$post = $this->input->post();
			$this->wishlist_model->create_item($post);
			redirect('/dashboard');
		}
	}
	public function delete_item($id){
		$this->wishlist_model->delete_item($id);
		redirect('/dashboard');
	}
	public function add_view(){
		$this->load->view('add_view');
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('/');
	}
}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

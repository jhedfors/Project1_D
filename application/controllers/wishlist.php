<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wishlist extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('wishlist_model');
		$this->load->library('session');
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
			redirect('/wishlist/add_view');
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
}

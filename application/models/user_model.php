<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
	public function __construct(){
		$this->load->helper('security');
	}
	public function register($post){
		$password = do_hash($post['password']);
		$query = "INSERT INTO users (name, username, password, hire_date, created_at, modified_at) VALUES(?,?,?,?,NOW(),NOW());
";
		$values =
			 ["{$post['name']}","{$post['username']}",$password,"{$post['hire_date']}"];
		$this->db->query($query, $values);
		return true;
	}
	public function show_by_id($id){
		$query =
			"SELECT * FROM users WHERE id = ?";
		$values = [$id];
		return $this->db->query($query,$values)->row_array();
	}
	public function show_by_username($username){
		$query =
			"SELECT * FROM users WHERE username = ?";
		$values = [$username];
		return $this->db->query($query,$values)->row_array();
	}
}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wishlist_model extends CI_Model {
	public function __construct(){
		$this->load->helper('security');
	}
	public function create_item($post){
		$active_id = $this->session->userdata('active_id');
		$query =
			 "INSERT INTO items (user_id, description, created_at, modified_at) VALUES(?,?,NOW(),NOW());";
	 	$values = [$active_id,$post['description']];
		$this->db->query($query,$values);
	}
	public function delete_item($id){
		$query1 =
			 "DELETE FROM wishlist WHERE item_id=?;";
	 $query2 =
				"DELETE FROM items WHERE id=?";
		$values = [$id];
		$this->db->query($query1,$values);
		$this->db->query($query2,$values);
	}
	public function show_not_on_list($active_id){
		$query =
			"SELECT items.id as item_id, users.id as user_id, users.name as name, description, items.created_at as date_added from items
			LEFT JOIN users ON users.id = items.user_id
			LEFT JOIN wishlist on wishlist.item_id = items.id
			WHERE NOT items.id in
			(SELECT items.id from items
			LEFT JOIN users ON users.id = items.user_id
			LEFT JOIN wishlist on wishlist.item_id = items.id
			WHERE wishlist.user_id = ? OR items.user_id = ?); ";
			$values = [$active_id, $active_id];
		return $this->db->query($query,$values)->result_array();
	}
	public function show_on_list($active_id){
		$query =
			"SELECT DISTINCT items.id as item_id, users.id as user_id, users.name as name, description, items.created_at as date_added from items
			LEFT JOIN users ON users.id = items.user_id
			LEFT JOIN wishlist on wishlist.item_id = items.id
			WHERE wishlist.user_id = ? OR items.user_id = ?";
			$values = [$active_id, $active_id];
		return $this->db->query($query,$values)->result_array();
	}
	public function add_to_list($active_id,$item_id){
		$query =
		"INSERT INTO wishlist (user_id, item_id) VALUES (?,?)";
	$values = [$active_id,$item_id];
	$this->db->query($query,$values);
	}
	public function remove_from_list($active_id,$item_id){
		$query =
			"DELETE FROM wishlist WHERE user_id = ? AND item_id =?";
		$values = [$active_id,$item_id];
		$this->db->query($query,$values);
	}
	public function show_users_for_item($id){
		$query =
			"SELECT users.name as name, items.description as item_description from wishlist
			LEFT JOIN users on users.id = wishlist.user_id
			LEFT JOIN items on items.id = wishlist.item_id
			WHERE item_id = ?";
		$values = [$id];
		$results =  $this->db->query($query,$values)->result_array();
		return $results;
	}
	public function show_item($id){
		$query =
			"SELECT * from items
			WHERE 	id = ?";
		$values = [$id];
		$results =  $this->db->query($query,$values)->result_array();
		return $results;
	}
}

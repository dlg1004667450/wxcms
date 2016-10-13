<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Member_model extends CI_Model {

	public function __construct() {
		parent::__construct();

	}

	//添加
	public function insert($data) {
		$this -> db -> insert('member', $data);
		return $this -> db -> affected_rows();
	}

	//获取
	public function get_member($id = FALSE, $num = FALSE, $offset = FALSE) {
		if ($id) {
			$query = $this -> db -> get_where('member', array('uid' => $id));
			return $query -> row_array();
		} else {
			$this -> db -> order_by('add_date', 'DESC');
			$query = $this -> db -> get('wxuser', $num, $offset);
			return $query -> result_array();
		}
	}

	//更新
	public function update($data, $id) {
		$this -> db -> where('uid', $id);
		$this -> db -> update('member', $data);
		return $this -> db -> affected_rows();
	}
	
	

}

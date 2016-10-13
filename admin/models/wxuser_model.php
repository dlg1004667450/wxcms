<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Wxuser_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //添加
    public function insert($data) {
        $this->db->insert('wxuser', $data);
        return $this->db->affected_rows();
    }

    //获取
    public function get_wxuser($id = FALSE, $num = FALSE, $offset = FALSE) {
        if ($id) {
            $query = $this->db->get_where('wxuser', array('uid' => $id));
            return $query->row_array();
        } else {
            $this->db->order_by('add_date', 'DESC');
            $query = $this->db->get('wxuser', $num, $offset);
            return $query->result_array();
        }
    }

    //获取
    public function get_wxuserbyopenid($openid = FALSE) {
        if ($openid) {
            $query = $this->db->get_where('wxuser', array('openid' => $openid));
            return $query->row_array();
        }
        return array();
    }

// 	//查询
// 	public function search_wxuser($cid = FALSE, $title = FALSE, $num, $offset) {
// 		$this -> db -> order_by('id', 'DESC');
// 		$this -> db -> join('categoryes', 'categoryes.cid = wxuser.cid', 'left');
// 		if ($cid) {
// 			$this -> db -> where('wxuser.cid', $cid);
// 		}
// 		if ($title) {
// 			$this -> db -> like('wxuser.title', $title);
// 		}
// 		$query = $this -> db -> get('wxuser', $num, $offset);
// 		return $query -> result_array();
// 	}
// 	//查询总数
// 	public function search_wxuser_nums($cid = FALSE, $title = FALSE) {
// 		$this -> db -> join('categoryes', 'categoryes.cid = wxuser.cid', 'left');
// 		if ($cid) {
// 			$this -> db -> where('wxuser.cid', $cid);
// 		}
// 		if ($title) {
// 			$this -> db -> like('wxuser.title', $title);
// 		}
// 		return $this -> db -> count_all_results('wxuser');
// 	}
// 	//删除
// 	public function delete($id) {
// 		$this -> db -> delete('wxuser', array('id' => $id));
// 		return $this -> db -> affected_rows();
// 	}
// 	//批量删除
// 	public function deletec($data) {
// 		$this -> db -> where_in('id', $data);
// 		$this -> db -> delete('wxuser');
// 		return $this -> db -> affected_rows();
// 	}
// 	//移动
// 	public function movec($cid, $data) {
// 		$this -> db -> where_in('id', $data);
// 		$this -> db -> update('wxuser', array('cid' => $cid));
// 		return $this -> db -> affected_rows();
// 	}
    //更新
    public function update($data, $id) {
        $this->db->where('uid', $id);
        $this->db->update('wxuser', $data);
        return $this->db->affected_rows();
    }

    //更新
    public function updatebyopenid($data, $openid) {
        $this->db->where('openid', $openid);
        $this->db->update('wxuser', $data);
        return $this->db->affected_rows();
    }

}

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
            $this->db->order_by('uid', 'DESC');
            $query = $this->db->get('wxuser', $num, $offset);
            return $query->result_array();
        }
    }

    public function delete($id) {
        $this->db->delete('wxuser', array('uid' => $id));
        return $this->db->affected_rows();
    }

    public function deletec($data) {
        $this->db->where_in('uid', $data);
        $this->db->delete('wxuser');
        return $this->db->affected_rows();
    }

}

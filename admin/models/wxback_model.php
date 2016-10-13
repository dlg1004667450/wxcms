<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Wxback_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //添加
    public function insert($data) {
        $this->db->insert('wxback', $data);
        return $this->db->affected_rows();
    }

    //获取
    public function get_wxback($id = FALSE, $num = FALSE, $offset = FALSE) {
        if ($id) {
            $query = $this->db->get_where('wxback', array('id' => $id));
            return $query->row_array();
        } else {
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get('wxback', $num, $offset);
            return $query->result_array();
        }
    }

    //获取
    public function get_wxbackbycode($code = '') {
        if ($code) {
            $query = $this->db->get_where('wxback', array('code' => $code));
            return $query->row_array();
        }
        return array();
    }

    //查询
    public function search_wxback($code = FALSE, $num, $offset) {
        $this->db->order_by('id', 'DESC');
        if ($code) {
            $this->db->like('code', $code);
        }
        $query = $this->db->get('wxback', $num, $offset);
        return $query->result_array();
    }

    //查询总数
    public function search_wxback_nums($code = FALSE) {
        if ($code) {
            $this->db->like('code', $code);
        }
        return $this->db->count_all_results('wxback');
    }

    //删除
    public function delete($id) {
        $this->db->delete('wxback', array('id' => $id));
        return $this->db->affected_rows();
    }

    //批量删除
    public function deletec($data) {
        $this->db->where_in('id', $data);
        $this->db->delete('wxback');
        return $this->db->affected_rows();
    }

    //移动
    public function movec($cid, $data) {
        $this->db->where_in('id', $data);
        $this->db->update('wxback', array('cid' => $cid));
        return $this->db->affected_rows();
    }

    //更新
    public function update($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('wxback', $data);
        return $this->db->affected_rows();
    }

}

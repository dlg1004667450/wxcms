<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Wxmenu_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //添加
    public function insert($data) {
        $this->db->insert('wxmenu', $data);
        return $this->db->affected_rows();
    }

    //获取
    public function get_wxmenu($id = FALSE, $num = FALSE, $offset = FALSE) {
        if ($id) {
            $query = $this->db->get_where('wxmenu', array('id' => $id));
            return $query->row_array();
        } else {
            $this->db->order_by('sort', 'DESC');
            $query = $this->db->get('wxmenu', $num, $offset);
            return $query->result_array();
        }
    }

    //获取
    public function get_wxmenubyopenid($openid = FALSE) {
        if ($openid) {
            $query = $this->db->get_where('wxmenu', array('openid' => $openid));
            return $query->row_array();
        }
        return array();
    }

    //删除
    public function delete($id) {
        $this->db->delete('wxmenu', array('id' => $id));
        return $this->db->affected_rows();
    }

    //批量删除
    public function deletec($data) {
        $this->db->where_in('id', $data);
        $this->db->delete('wxmenu');
        return $this->db->affected_rows();
    }
    
    //清空所有
    public function deleteall($data) {
        $this->db->delete('wxmenu');
        return $this->db->affected_rows();
    }

    //更新
    public function update($data, $id) {
        $this->db->where('uid', $id);
        $this->db->update('wxmenu', $data);
        return $this->db->affected_rows();
    }

    //更新
    public function updatebyopenid($data, $openid) {
        $this->db->where('openid', $openid);
        $this->db->update('wxmenu', $data);
        return $this->db->affected_rows();
    }

}

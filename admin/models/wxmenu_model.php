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
    public function get_wxmenu_by_parent($id = FALSE) {
        $query = $this->db->get_where('wxmenu', array('parent_id' => $id));
        return $query->result_array();
    }

    public function delete($id) {
        $this->db->delete('wxmenu', array('id' => $id));
        return $this->db->affected_rows();
    }

    public function deletec($data) {
        $this->db->where_in('id', $data);
        $this->db->delete('wxmenu');
        return $this->db->affected_rows();
    }

}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Smsset_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //获取
    public function get_smsset() {
        $query = $this->db->get_where('smsset', array('id' => 1));
        return $query->row_array();
    }

    //更新
    public function update($data) {
        $this->db->where('id', 1);
        $this->db->update('smsset', $data);
        return $this->db->affected_rows();
    }

}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Wxset_model extends CI_Model {

    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    public function __construct() {
        parent::__construct();
    }

    // ------------------------------------------------------------------------

    /**
     * 根据用户ID获取用户信息
     *
     * @access  public
     * @param   int
     * @return  object
     */
    public function get_wxset() {
        $query = $this->db->get_where('wxset', array('id' => 1));
        return $query->row_array();
    }

    // ------------------------------------------------------------------------

    /**
     * 更新用户
     *
     * @access  public
     * @param   uid
     * @return  bool
     */
    public function update($data) {
        $this->db->where('id', 1);
        $this->db->update('wxset', $data);
        return $this->db->affected_rows();
    }

    // ------------------------------------------------------------------------
}

/* End of file user_model.php */
/* Location: ./models/wxset_model.php */
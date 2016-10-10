<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_model extends CI_Model
{
	
	/**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
	public function __construct()
	{
		parent::__construct();
	}
	
	// ------------------------------------------------------------------------

    /**
     * 根据角色ID获取角色信息
     *
     * @access  public
     * @param   int
     * @return  object
     */
	public function get_role_by_id($id = 0)
	{
		return $this->db->where('id', $id)->get($this->db->dbprefix('role'))->row();
	}

	// ------------------------------------------------------------------------

    /**
     * 根据角色ID获取角色信息
     *
     * @access  public
     * @param   int
     * @return  object
     */
	public function get_role_by_name($name = '')
	{
		return $this->db->where('role_name', $name)->get($this->db->dbprefix('role'))->row();
	}

	// ------------------------------------------------------------------------
	
    /**
     * 获取角色组列表
     *
     * @access  public
     * @return  object
     */
	public function get_roles()
	{
		return $this->db->get($this->db->dbprefix('role'))->result();
	}
	
	// ------------------------------------------------------------------------

    /**
     * 添加角色
     *
     * @access  public
     * @param   array
     * @return  bool
     */
	public function add_role($data)
	{	
		return $this->db->insert($this->db->dbprefix('role'), $data);
	}
	
	// ------------------------------------------------------------------------

    /**
     * 删除角色
     *
     * @access  public
     * @param   array
     * @return  bool
     */
	public function del_role($id)
	{	
		return $this->db->where('id', $id)->delete($this->db->dbprefix('role'));
	}
	// ------------------------------------------------------------------------
	
	/**
     * 更新授权
     *
     * @access  public
     * @param   uid
     * @return  bool
     */
	public function update_permit($id, $items)
	{
		if ($items) {
			$itemstr = implode(',', $items);
			return $this->db->where('id', $id)->update($this->db->dbprefix('role'), array('action_list'=>$itemstr));
		}
	}

	// ------------------------------------------------------------------------
	
}

/* End of file role_model.php */
/* Location: ./models/role_model.php */
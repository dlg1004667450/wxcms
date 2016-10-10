<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Action_model extends CI_Model
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
	
	public function get_actions()
	{
		return $this->db->get($this->db->dbprefix('action'))->result();
	}
	
	public function add_action($data)
	{	
		return $this->db->insert($this->db->dbprefix('action'), $data);
	}
	
	public function add_action_log($data)
	{	
		return $this->db->insert($this->db->dbprefix('action_log'), $data);
	}
	
	public function get_action_by_id($id = '')
	{
		return $this->db->where('id', $id)->get($this->db->dbprefix('action'))->row();
	}
	
	public function get_action_by_name($name = '')
	{
		return $this->db->where('name', $name)->get($this->db->dbprefix('action'))->row();
	}
	
	public function change_status($id, $change = 0)
	{
		return $this->db->where('id', $id)->update($this->db->dbprefix('action'), array('status'=>$change));
	}
}

/* End of file action_model.php */
/* Location: ./models/action_model.php */
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model
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
	
	public function get_menus()
	{
		return $this->db->get($this->db->dbprefix('menu'))->result();
	}
	
	public function get_pids()
	{
		return $this->db->where('pid', 0)->get($this->db->dbprefix('menu'))->result();
	}
	
	public function add_menu($data)
	{	
		return $this->db->insert($this->db->dbprefix('menu'), $data);
	}
	
	public function get_menu_by_name($name = '')
	{
		return $this->db->where('title', $name)->get($this->db->dbprefix('menu'))->row();
	}
	
	public function get_menu_by_url($url = '')
	{
		return $this->db->where('url', $url)->get($this->db->dbprefix('menu'))->row();
	}
	
	public function del_menu($id)
	{
		return $this->db->where('id', $id)->delete($this->db->dbprefix('menu'));
	}
}

/* End of file menu_model.php */
/* Location: ./models/menu_model.php */
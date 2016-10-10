<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
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
     * 根据用户ID获取用户信息
     *
     * @access  public
     * @param   int
     * @return  object
     */
	public function get_user_by_uid($uid = 0)
	{
		return $this->db->where('uid', $uid)->get($this->db->dbprefix('user'))->row();
	}

	// ------------------------------------------------------------------------

    /**
     * 根据用户名获取用户信息
     *
     * @access  public
     * @param   string
     * @return  object
     */
	public function get_user_by_name($name)
	{
		return $this->db->where('username', $name)->get($this->db->dbprefix('user'))->row();
	}

	// ------------------------------------------------------------------------

    /**
     * 获取某个用户组下所有用户
     *
     * @access  public
     * @param   int
     * @param   int
     * @param   int
     * @return  object
     */
	public function get_users($keyword, $limit = 0, $offset = 0)
	{
		$table_admins = $this->db->dbprefix('user');
		$table_roles = $this->db->dbprefix('role');
		$this->db->where("$table_admins.uid <>", 1);
		if ($limit)
		{
			$this->db->limit($limit);
		}
		if ($offset)
		{
			$this->db->offset($offset);
		}
		if ($keyword)
		{
			$this->db->like('username', $keyword);
		}
		return $this->db->from($table_admins)
						->join($table_roles, "$table_roles.id = $table_admins.role_id")
						->order_by('uid', 'asc')
						->get()
						->result();
	}
	
	// ------------------------------------------------------------------------
	
	/**
     * 获取用户行为列表
     */
	public function get_logs($condition, $limit, $offset)
	{
		foreach ($condition as $key=>$val) {
			if (empty($val[1])) {
				continue;
			}
			if ($val[0] == 'like') {
				$this->db->like($key,  $val[1]);
			} else {
				$this->db->where($key, $val[1]);
			}
		}
		
		if ($limit)
		{
			$this->db->limit($limit);
		}
		if ($offset)
		{
			$this->db->offset($offset);
		}
		
		$table_user = $this->db->dbprefix('user');
		$table_action_log = $this->db->dbprefix('action_log');

		return $this->db->from($table_user)
						->join($table_action_log, "$table_action_log.user_id = $table_user.uid")
						->order_by('time', 'desc')
						->get()
						->result();
	}
	
	// ------------------------------------------------------------------------
	
	/**
     * 获取用户行为总数
     */
	public function get_log_count($condition)
	{
		foreach ($condition as $key=>$val) {
			if (empty($val[1])) {
				continue;
			}
			if ($val[0] == 'like') {
				$this->db->like($key,  $val[1]);
			} else {
				$this->db->where($key, $val[1]);
			}
		}
		
		$table_user = $this->db->dbprefix('user');
		$table_action_log = $this->db->dbprefix('action_log');
		
		return $this->db->from($this->db->dbprefix('user'))
		                ->join($table_action_log, "$table_action_log.user_id = $table_user.uid")
		                ->count_all_results();
	}
	
	// ------------------------------------------------------------------------

    /**
     * 添加用户
     *
     * @access  public
     * @param   array
     * @return  bool
     */
	public function add_user($data)
	{
		$data['salt'] = substr(sha1(time()), -10);
		$data['password'] = sha1($data['password'].$data['salt']);
		return $this->db->insert($this->db->dbprefix('user'), $data);
	}
	
	// ------------------------------------------------------------------------

    /**
     * 删除用户
     *
     * @access  public
     * @param   uid
     * @return  bool
     */
	public function del_user($uid)
	{
		return $this->db->where('uid', $uid)->delete($this->db->dbprefix('user'));
	}

	// ------------------------------------------------------------------------
	
	/**
     * 更新用户
     *
     * @access  public
     * @param   uid
     * @return  bool
     */
	public function edit_user($uid, $role_id)
	{
		if ($role_id) {
			return $this->db->where('uid', $uid)->update($this->db->dbprefix('user'), array('role_id'=>$role_id));
		}
	}

	// ------------------------------------------------------------------------
	
	/**
     * 获取用户总数
     */
	public function get_user_count($keyword)
	{
		$this->db->like('username', $keyword);
		$this->db->from($this->db->dbprefix('user'));
		return $this->db->count_all_results();
	}

	// ------------------------------------------------------------------------
	
	/**
     * 删除用户
     */
	public function del_user_by_uid($uid)
	{
		return $this->db->where('uid', $uid)->delete($this->db->dbprefix('user'));
	}

	// ------------------------------------------------------------------------
	
	/**
     * 更新头像
     */
	public function update_head($uid, $head)
	{
		return $this->db->where('uid', $uid)->update($this->db->dbprefix('user'), array('head'=>$head));
	}

	// ------------------------------------------------------------------------
}

/* End of file user_model.php */
/* Location: ./models/user_model.php */
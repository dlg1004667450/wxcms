<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends MY_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->_check_permit();
        $this->load->model('role_model');
	}
	
	public function add()
	{
		if (IS_POST) {
			// 过滤
			$this->form_validation->set_rules('role_name', '角色', 'required', 
			    array('required' => '请输入%s')
			);
            if ($this->form_validation->run() == FALSE) {
            	$this->load->view('role_add');
            } else {
				// 根据用户名查询用户信息 匹配密码是否相同
				// 查询用户信息
				$row = $this->role_model->get_role_by_name($this->input->post('role_name', true));
				if ($row) {
					$this->_message('角色已经存在。', 'role/add');
				} else {
					$data = array(
						'role_name' => $this->input->post('role_name', true),
					);
					$this->role_model->add_role($data);
					$this->_message('账号添加成功。', 'role/index');
				}
            }
		} else {
			$this->load->view('role_add');
		}
	}
	
	public function index()
	{
		$data['roles'] = $this->role_model->get_roles();
		$this->load->view('role_index', $data);
	}
	
	public function del()
	{
		$this->role_model->del_role($this->uri->segment(3));
		$this->_message('删除成功。', 'role/index');
	}
	
	public function set_permit()
	{
		if (IS_POST) {
			$id = $this->input->post('id', true);
			if (!$id) {
				$this->_message('缺少参数。', 'role/index');
			}
			$result = $this->role_model->update_permit($id, $this->input->post('item', true));
			if ($result) {
				$this->_message('授权成功。', 'role/index');
			} else {
				$this->_message('授权失败。', 'role/index');
			}
		} else {
			// 查询角色权限
			$row = $this->role_model->get_role_by_id($this->uri->segment(3));

			// 获取menu
			$this->load->model('menu_model');
			$result = $this->menu_model->get_menus();
			foreach ($result as $key=>$val) {
				if ($val->pid == 0) {
					$data['menus'][] = "<p><b>$val->title</b>：";
					foreach ($result as $j=>$k) {
						$checked = ''; // 初始化
						if ($k->pid == $val->id) {
							if (strstr(','.$row->action_list.',', ','.$k->id.',')) {
								$checked = 'checked';
							}
							$data['menus'][] = "<label style=\"font-weight:100\"><input type=\"checkbox\" name=\"item[]\" value=\"$k->id\" $checked>$k->title</label>&nbsp;";
						}
					}
					$data['menus'][] = '</p>';
				}
			}
			
			$data['id'] = $this->uri->segment(3);
			$this->load->view('role_set_permit', $data);
		}
	}
}

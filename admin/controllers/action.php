<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Action extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->_check_permit();
        $this->load->model('action_model');
    }

    public function add() {
        if (IS_POST) {
            // 过滤
            $this->form_validation->set_rules('name', '标识', 'required', array('required' => '请输入%s')
            );
            $this->form_validation->set_rules('title', '描述', 'required', array('required' => '请输入%s')
            );
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('action_add');
            } else {
                // 根据用户名查询用户信息 匹配密码是否相同
                // 查询用户信息
                $row = $this->action_model->get_action_by_name($this->input->post('name', true));
                if ($row) {
                    $this->_message('行为已经存在。', 'action/add');
                } else {
                    $data = array(
                        'name' => $this->input->post('name', true),
                        'title' => $this->input->post('title', true),
                        'status' => 1,
                    );
                    $this->action_model->add_action($data);
                    $this->_message('行为添加成功。', 'action/index');
                }
            }
        } else {
            $this->load->view('action_add');
        }
    }

    public function index() {
        $data['actions'] = $this->action_model->get_actions();
        $this->load->view('action_index', $data);
    }

    public function ajax() {
        // 查询
        $row = $this->action_model->get_action_by_id($this->input->post('id', true));
        if ($row->status == 1) {
            $change = 0;
        } else {
            $change = 1;
        }
        // 更新
        $row = $this->action_model->change_status($this->input->post('id', true), $change);
        echo json_encode(array('result' => $change));
    }

}

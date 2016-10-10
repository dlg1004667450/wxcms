<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->_check_permit();
        $this->load->model('menu_model');
    }

    public function add() {
        if (IS_POST) {
            // 过滤
            $this->form_validation->set_rules('title', '节点', 'required', array('required' => '请输入%s')
            );
            $this->form_validation->set_rules('url', '链接', 'required', array('required' => '请输入%s')
            );
            if ($this->form_validation->run() == FALSE) {
                $data['pids'] = $this->menu_model->get_pids();
                $this->load->view('menu_add', $data);
            } else {
                // 根据用户名查询用户信息 匹配密码是否相同
                // 查询用户信息
                $row = $this->menu_model->get_menu_by_name($this->input->post('title', true));
                if ($row) {
                    $this->_message('节点已经存在。', 'menu/add');
                } else {
                    $data = array(
                        'title' => $this->input->post('title', true),
                        'url' => $this->input->post('url', true),
                        'pid' => $this->input->post('pid', true),
                    );
                    $this->menu_model->add_menu($data);
                    $this->_message('节点添加成功。', 'menu/index');
                }
            }
        } else {
            $data['pids'] = $this->menu_model->get_pids();
            $this->load->view('menu_add', $data);
        }
    }

    public function index() {
        $data['menus'] = $this->menu_model->get_menus();
        $this->load->view('menu_index', $data);
    }

    public function del() {
        $this->menu_model->del_menu($this->uri->segment(3));
        $this->_message('节点删除成功。', 'menu/index');
    }

}

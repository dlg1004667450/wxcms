<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Privilege extends CI_Controller {

    public function login() {
        if (IS_POST) {
            // 过滤
            $this->form_validation->set_rules('username', '账号', 'required', array('required' => '请输入%s')
            );
            $this->form_validation->set_rules('password', '密码', 'required', array('required' => '请输入%s')
            );
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('privilege_login');
            } else {
                // 根据用户名查询用户信息 匹配密码是否相同
                // 查询用户信息
                $this->load->model('user_model');
                $row = $this->user_model->get_user_by_name($this->input->post('username', true));
                if (!$row) {
                    $data['message'] = '不存在的用户。';
                    $data['goto'] = 'privilege/login';
                    $this->load->view('form_message', $data);
                } elseif ($row->password == sha1($this->input->post('password', true) . $row->salt)) {
                    // 记录日志
                    $this->load->model('action_model');
                    $data['action_id'] = 1;
                    $data['user_id'] = $row->uid;
                    $data['ip'] = $_SERVER["REMOTE_ADDR"];
                    $data['remark'] = '用户登录';
                    $data['time'] = time();
                    $this->action_model->add_action_log($data);
                    // 登录写session
                    $array = array(
                        'user_id' => $row->uid,
                        'user_name' => $this->input->post('username', true), // 为向后兼容官方推荐使用global_xss_filtering设置false 也就是加上第二个参数 实现XSS过滤 另外使用AR避免SQL注入
                        'head' => $row->head ? $row->head : 'upload_pic/nopic.jpg',
                        'role_id' => $row->role_id,
                    );
                    $this->session->set_userdata($array);
                    redirect('index/main');
                } else {
                    $data['message'] = '账号或密码不正确。';
                    $data['goto'] = 'privilege/login';
                    $this->load->view('form_message', $data);
                }
            }
        } else {
            $this->load->view('privilege_login');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('privilege/login');
    }

}

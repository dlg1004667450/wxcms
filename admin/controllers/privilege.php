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

    public function pwd() {
        $this->load->library('email');
//
//        $this->email->from('17785195258m@sina.cn', 'Name');
//        $this->email->to('1004667450@qq.com');
////        $this->email->cc('another@another-example.com');
////        $this->email->bcc('them@their-example.com');
//
//        $this->email->subject('Email Test');
//        $this->email->message('Testing the email class.');
//
//        $this->email->send();
        
        
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.sina.com';
$config['smtp_user'] = '17785195258m@sina.cn';
$config['smtp_pass'] = '041207DLG';
$config['mailtype'] = 'html';
$config['validate'] = true;
$config['priority'] = 1;
$config['crlf'] = "\r\n";
$config['smtp_port'] = 25;
$config['charset'] = 'utf-8';
$config['wordwrap'] = TRUE;
$this->email->initialize($config);


$this->email->from('17785195258m@sina.cn', 'AAA');
$this->email->to('17785195258@163.com');
//$this->email->cc('another@another-example.com');
//$this->email->bcc('them@their-example.com');

$this->email->subject('你好啊');
$this->email->message('我是！');

$this->email->send();
echo $this->email->print_debugger();
        
//        $this->load->library('email');
//        $config['protocol'] = 'smtp';
//        $config['smtp_host'] = 'smtp.sina.cn';
//        $config['smtp_user'] = '17785195258m@sina.cn';
//        $config['smtp_pass'] = '041207DLG'; //	填写腾讯邮箱开启POP3/SMTP服务时的授权码，即核对密码正确 在邮箱设置 账号里面
//        $config['smtp_port'] = 465;
//        $config['smtp_timeout'] = 30;
//        $config['mailtype'] = 'text';
//        $config['charset'] = 'utf-8';
//        $config['wordwrap'] = TRUE;
//        $config['newline'] = PHP_EOL;
//        $config['crlf'] = "\r\n";
//        $this->email->initialize($config);
//        $this->email->set_newline("\r\n");
//        $this->email->from('17785195258m@sina.cn', '宇');
//        $this->email->to('1004667450@qq.com');
//        $this->email->subject('email'); // 发送标题
//        $this->email->message('Testing the email class.'); //	内容
//        echo $this->email->send();
//        $status = $this->email->print_debugger();
//        if ($status) {
//            echo '发送成功！';
//        } else {
//            echo '发送失败！';
//        }
    }

}

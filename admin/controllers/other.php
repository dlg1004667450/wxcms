<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Other extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->_check_permit();
        $this->load->model('user_model');
    }

    public function emailset() {
        $this->load->model('emailset_model');
        if (IS_POST) {
            $this->form_validation->set_rules('smpt', '文章标题', 'trim|required', array(
                'required' => '必须填写SMPT!'
            ));
            $this->form_validation->set_rules('emailname', '文章内容', 'trim|required', array(
                'required' => '必须填写邮箱名称!'
            ));
            $this->form_validation->set_rules('emailpwd', '文章内容', 'trim|required', array(
                'required' => '必须填写邮箱密码!'
            ));

            if ($this->form_validation->run() == FALSE) {
                $this->_message(validation_errors(), 'other/emailset');
            } else {
                $data = array(
                    'status' => $this->input->post('status')?1:0,
                    'smpt' => $this->input->post('smpt'),
                    'emailname' => $this->input->post('emailname'),
                    'emailpwd' => $this->input->post('emailpwd')
                );

                $result = $this->emailset_model->update($data);

                if ($result) {
                    $this->_message('编辑成功。', 'other/emailset');
                } else {
                    $this->_message('编辑失败。', 'other/emailset');
                }
            }
        }
        $data['email'] = $this->emailset_model->get_emailset();

        $this->load->view('emailset_index', $data);
    }
    
    public function smsset() {
        $this->load->model('smsset_model');
        if (IS_POST) {
            $this->form_validation->set_rules('smsname', '文章内容', 'trim|required', array(
                'required' => '必须填写名称!'
            ));
            $this->form_validation->set_rules('smspwd', '文章内容', 'trim|required', array(
                'required' => '必须填写密码!'
            ));

            if ($this->form_validation->run() == FALSE) {
                $this->_message(validation_errors(), 'other/smsset');
            } else {
                $data = array(
//                    'status' => $this->input->post('status')?1:0,
                    'name' => $this->input->post('name'),
                    'smsname' => $this->input->post('smsname'),
                    'smspwd' => $this->input->post('smspwd')
                );

                $result = $this->smsset_model->update($data);

                if ($result) {
                    $this->_message('编辑成功。', 'other/smsset');
                } else {
                    $this->_message('编辑失败。', 'other/smsset');
                }
            }
        }
        $data['email'] = $this->smsset_model->get_smsset();

        $this->load->view('smsset_index', $data);
    }
    
    public function othertpl() {
        $this->_message('此功能尚未开放！。', 'other/emailset');
    }
    
    
    public function pay() {
        $this->_message('此功能尚未开放！。', 'other/emailset');
        $this->load->model('smsset_model');
        if (IS_POST) {
            $this->form_validation->set_rules('smsname', '文章内容', 'trim|required', array(
                'required' => '必须填写名称!'
            ));
            $this->form_validation->set_rules('smspwd', '文章内容', 'trim|required', array(
                'required' => '必须填写密码!'
            ));

            if ($this->form_validation->run() == FALSE) {
                $this->_message(validation_errors(), 'other/smsset');
            } else {
                $data = array(
//                    'status' => $this->input->post('status')?1:0,
                    'name' => $this->input->post('name'),
                    'smsname' => $this->input->post('smsname'),
                    'smspwd' => $this->input->post('smspwd')
                );

                $result = $this->smsset_model->update($data);

                if ($result) {
                    $this->_message('编辑成功。', 'other/smsset');
                } else {
                    $this->_message('编辑失败。', 'other/smsset');
                }
            }
        }
        $data['email'] = $this->smsset_model->get_smsset();

        $this->load->view('smsset_index', $data);
    }
}

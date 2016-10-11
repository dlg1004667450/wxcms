<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Wx extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->_check_permit();
        $this->load->model(array('wxset_model', 'wxuser_model', 'wxback_model', 'wxmenu_model'));
    }

    public function _get_msgtype() {
        return $data['msgtype'] = array(
            '1' => '链接',
            '2' => '文本',
            '3' => '图文'
        );
    }

    //----------------------------- back ------------------------------------

    public function wxback() {
        // 获取参数
        $offset = $this->uri->segment(3) > 0 ? $this->uri->segment(3) : 0;

        // 用户总数
        $config['total_rows'] = $this->wxback_model->search_wxback_nums($this->input->get('keyword', true));
        $config['base_url'] = site_url() . '/wx/wxback';
        $config['per_page'] = 15; // 单页显示多少个记录
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        // 分页字符
        $data['pages'] = $this->pagination->create_links();

        // 分页查询
        $data['total'] = $config['total_rows'];
        $data['wxbackarr'] = $this->wxback_model->search_wxback($this->input->get('keyword', true), $config['per_page'], $offset);
        $data['msgtype'] = $this->_get_msgtype();
        $this->load->view('wx_back', $data);
    }

    //修改页面
    public function edit_wxback() {
        if (IS_POST) {
            $uid = $this->input->post('uid', true);
            if (!$uid) {
                $this->_message('缺少参数。', 'user/index');
            }
            $result = $this->user_model->edit_user($uid, $this->input->post('role_id', true));
            if ($result) {
                $this->_message('编辑成功。', 'user/index');
            } else {
                $this->_message('编辑失败。', 'user/index');
            }
        } else {
            // 查询详细内容
            $data['wxback'] = $this->wxback_model->get_wxback($this->uri->segment(3));
            $this->load->view('wxback_edit', $data);
        }
    }

    //删除wxback
    public function del_wxback() {
        $query = $this->wxback_model->delete($this->uri->segment(3));
        if ($query) {
            $this->_message('删除回复成功。', 'wx/wxback');
        }
    }

    public function add_wxback() {
        if (IS_POST) {
            $this->form_validation->set_rules('code', '咨询码', 'trim|required');

            $this->form_validation->set_rules('msgtype', '类型', 'required');

            $msgtype = $this->input->post('msgtype');

            if (!in_array($msgtype, array('1', '2', '3'))) {
                $this->load->view('wxback_add');
                exit();
            }

            if ($msgtype == 1) {
                $this->form_validation->set_rules('lj_title', '标题', 'required');
                $this->form_validation->set_rules('lj_link', '链接', 'required');
            } elseif ($msgtype == 2) {
                $this->form_validation->set_rules('wb_content', '内容', 'required');
            } elseif ($msgtype == 3) {
                /* $biaoti = IReq::get('biaoti');
                  $miaoshu = IReq::get('miaoshu');
                  $tupian = IReq::get('tupian');
                  $lianjie = IReq::get('lianjie'); */
            }

            if ($this->form_validation->run() == FALSE) {
                $this->_message(validation_errors(), "wx/wxback_add");
            } else {
                $data = array(
                    'code' => $this->input->post('code'),
                    'msgtype' => $msgtype
                );

                if ($msgtype == 1) {
                    $datainfo['lj_title'] = $this->input->post('lj_title');
                    $datainfo['lj_link'] = $this->input->post('lj_link');
                    $data['values'] = serialize($datainfo);
                } elseif ($msgtype == 2) {
                    $data['values'] = $this->input->post('wb_content');
                } elseif ($msgtype == 3) {
                    $data['values'] = '空的没有图片';
                }

                $query = $this->wxback_model->insert($data);
                if ($query) {
                    $this->_message('添加成功', "wx/wxback");
                }
            }
        } else {
            $this->load->view('wxback_add');
        }
    }

    //------------------ wxuser ----------------------

    public function wxuser() {
        // 获取参数
        $offset = $this->uri->segment(3) > 0 ? $this->uri->segment(3) : 0;

        // 用户总数
        $config['total_rows'] = $this->db->count_all('wxuser');
        $config['base_url'] = site_url() . '/wx/wxuser';
        $config['per_page'] = 15; // 单页显示多少个记录
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        // 分页字符
        $data['pages'] = $this->pagination->create_links();

        // 分页查询
        $data['total'] = $config['total_rows'];
        $data['wxusers'] = $this->wxuser_model->get_wxuser('', $config['per_page'], $offset);
        $this->load->view('wxuser_index', $data);
    }

    //------------------ wxset ----------------------

    public function wxset() {
        if (IS_POST) {
            $this->form_validation->set_rules('token', '文章标题', 'trim|required', array(
                'required' => '必须填写token!'
            ));
            $this->form_validation->set_rules('appid', '文章内容', 'required', array(
                'required' => '必须填写appid!'
            ));
            $this->form_validation->set_rules('appsecret', '文章内容', 'required', array(
                'required' => '必须填写secret!'
            ));

            if ($this->form_validation->run() == FALSE) {
                $this->_message(validation_errors(), 'wx/wxset');
            } else {
                $data = array(
                    'token' => $this->input->post('token'),
                    'appid' => $this->input->post('appid'),
                    'appsecret' => $this->input->post('appsecret')
                );

                $result = $this->wxset_model->update($data);

                if ($result) {
                    $this->_message('编辑成功。', 'wx/wxset');
                } else {
                    $this->_message('编辑失败。', 'wx/wxset');
                }
            }
        }
        $data['wxinfo'] = $this->wxset_model->get_wxset();

        $this->load->view('wx_set', $data);
    }

    //----------------------------- wxmenu ------------------------------------

    public function wxmenu() {
        // 获取参数
        $offset = $this->uri->segment(3) > 0 ? $this->uri->segment(3) : 0;


        $menus = $this->wxmenu_model->get_wxmenu();

        $newmenu = array();
        foreach ($menus as $PValue) {
            if ($PValue['parent_id'] == 0) {
                $newmenu[] = $PValue;
                foreach ($menus as $SValue) {
                    if ($PValue['id'] == $SValue['parent_id']) {
                        $newmenu[] = $SValue;
                    }
                }
            }
        }
        $data['menus'] = $newmenu;
        $this->load->view('wxmenu_index', $data);
    }

    //修改页面
    public function edit_wxmenu() {
        if (IS_POST) {
            $uid = $this->input->post('uid', true);
            if (!$uid) {
                $this->_message('缺少参数。', 'user/index');
            }
            $result = $this->user_model->edit_user($uid, $this->input->post('role_id', true));
            if ($result) {
                $this->_message('编辑成功。', 'user/index');
            } else {
                $this->_message('编辑失败。', 'user/index');
            }
        } else {
            // 查询详细内容
            $data['wxback'] = $this->wxback_model->get_wxback($this->uri->segment(3));
            $this->load->view('wxmenu_edit', $data);
        }
    }

    //删除wxback
    public function del_wxmenu() {
        $menu = $this->wxmenu_model->get_wxmenu($this->uri->segment(3));
        if ($menu['parent_id'] == 0) {
            $sonmenu = $this->wxmenu_model->get_wxmenu_by_parent($menu['id']);
            if ($sonmenu) {
                $this->_message('有子类，删除失败。', 'wx/wxmenu');
            }
        }
        $query = $this->wxmenu_model->delete($this->uri->segment(3));
        if ($query) {
            $this->_message('删除回复成功。', 'wx/wxmenu');
        }
    }

    public function add_wxmenu() {
        if (IS_POST) {
            $this->form_validation->set_rules('code', '咨询码', 'trim|required');

            $this->form_validation->set_rules('msgtype', '类型', 'required');

            $msgtype = $this->input->post('msgtype');

            if (!in_array($msgtype, array('1', '2', '3'))) {
                $this->load->view('wxback_add');
                exit();
            }

            if ($msgtype == 1) {
                $this->form_validation->set_rules('lj_title', '标题', 'required');
                $this->form_validation->set_rules('lj_link', '链接', 'required');
            } elseif ($msgtype == 2) {
                $this->form_validation->set_rules('wb_content', '内容', 'required');
            } elseif ($msgtype == 3) {
                /* $biaoti = IReq::get('biaoti');
                  $miaoshu = IReq::get('miaoshu');
                  $tupian = IReq::get('tupian');
                  $lianjie = IReq::get('lianjie'); */
            }

            if ($this->form_validation->run() == FALSE) {
                $this->_message(validation_errors(), "wx/wxback_add");
            } else {
                $data = array(
                    'code' => $this->input->post('code'),
                    'msgtype' => $msgtype
                );

                if ($msgtype == 1) {
                    $datainfo['lj_title'] = $this->input->post('lj_title');
                    $datainfo['lj_link'] = $this->input->post('lj_link');
                    $data['values'] = serialize($datainfo);
                } elseif ($msgtype == 2) {
                    $data['values'] = $this->input->post('wb_content');
                } elseif ($msgtype == 3) {
                    $data['values'] = '空的没有图片';
                }

                $query = $this->wxback_model->insert($data);
                if ($query) {
                    $this->_message('添加成功', "wx/wxback");
                }
            }
        } else {
            $this->load->view('wxback_add');
        }
    }

    public function postwxmenu() {
        $post = ' {
		     "button":[
		      {	
		          "name":"关于我们",
		          "sub_button":[
		            {
		          		"type":"click",
		          		"name":"我们的故事",
		          		"key":"STORY"
		          	},
		            {
		          		"type":"click",
		          		"name":"么么哒",
		          		"key":"MMD"
		          	},		  
		          	{
		          		"type":"view",
		          		"name":"官网地址",
		          		"url":"http://www.baidu.com"
		          	}
		          	
		          ]
		      },
		      {
		           "name":"走全国",
		           "type":"view",
		           "url":"http://www.moocba.com"		   
		       }]
		 }';

        $access_token = $this->getAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$access_token}";
        $query = $this->curlRequest($url, $post);

        if ($query['errcode'] == 0) {
            $this->_message('成功了！', 'wx/wxmenu');
        } else {
            $this->_message('失败了！', 'wx/wxmenu', 3);
        }
    }

    //清空微信平台上的menu
    public function delwxmenu() {
        $post = array();
        $access_token = $this->getAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token={$access_token}";
        $query = $this->curlRequest($url, $post);

        if (empty($query['errcode'])) {
            $this->_message('成功了！', 'wx/wxmenu', 3);
        } else {
            $this->_message('失败了！', 'wx/wxmenu', 3);
        }
    }

    //获取微信平台上的menu
    public function getwxmenu() {
        $post = array();
        $access_token = $this->getAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/menu/get?access_token={$access_token}";
        $query = $this->curlRequest($url, $post);

        if (empty($query['errcode'])) {
            $this->_message('成功了！', 'home/index', 3);
        } else {
            $this->_message('失败了！', 'home/index', 3);
        }
    }

}

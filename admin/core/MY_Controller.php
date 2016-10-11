<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
abstract class MY_Controller extends CI_Controller {

    public $menu = array();

    /**
     * Class constructor
     *
     * @return	void
     */
    public function __construct() {
        parent::__construct();
        $this->_check_login();
        $this->_create_menu();
        $this->_check_action();
    }

    protected function _check_login() {
        if (!$this->session->userdata('user_id')) {
            $this->_message('请登录后操作。', 'privilege/login');
        }
    }

    protected function _check_action() {
        // 查找行为是否存在
        $this->load->model('action_model');
        $action = $this->action_model->get_action_by_name($this->uri->segment(1) . '_' . $this->uri->segment(2));
        // 不存在
        if (!$action) {
            return;
        }
        // 状态
        if ($action->status != 1) {
            return;
        }
        // 记录日志
        if (IS_POST) {
            $this->_action_log($action->id, $action->title);
        }
    }

    protected function _check_permit() {
        // 查找检查节点ID，查不到返回没有此操作的权限message
        // 查找用户角色权限
        // 节点ID是否在角色权限里，查不到则返回用户没有此权限message
        $this->load->model('menu_model');
        $menu = $this->menu_model->get_menu_by_url($this->uri->segment(1) . '/' . $this->uri->segment(2));
        if (!$menu) {
            //$this->_message('节点不存在', 'index/main');
            return;
        }
        $this->load->model('user_model');
        $user = $this->user_model->get_user_by_uid($this->session->userdata('user_id'));
        $this->load->model('role_model');
        $role = $this->role_model->get_role_by_id($user->role_id);
        if ($user->role_id == 0) {
            // 超级管理不检测权限
            return;
        }
        if (!strstr(',' . $role->action_list . ',', ',' . $menu->id . ',')) {
            $this->_message('权限不存在', 'index/main');
        }
    }

    public function _message($msg, $goto = '') {
        $data['message'] = $msg;
        $data['goto'] = $goto ? $goto : 'index/main';
        $this->load->view('form_message', $data);
        echo $this->output->get_output();
        exit();
    }

    public function _action_log($action_id, $title) {
        $this->load->model('action_model');
        $data['action_id'] = $action_id;
        $data['user_id'] = $this->session->userdata('user_id');
        $data['ip'] = $_SERVER["REMOTE_ADDR"];
        $data['remark'] = $title;
        $data['time'] = time();
        $this->action_model->add_action_log($data);
    }

    /*
      <li class="active">
      <a href="#"><i class="fa fa-files-o fa-fw"></i> 简单页面<span class="fa arrow"></span></a>
      <ul class="nav nav-second-level">
      <li>
      <a class="active" href="blank.html">空页面</a>
      </li>
      </ul>
      </li>
     */

    public function _create_menu() {
        // 开启cache
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $this->load->model('menu_model');
        if (!$this->menu = $this->cache->get('menu_' . $this->session->userdata('user_id'))) {
            // 获取menu
            $result = $this->menu_model->get_menus();
            foreach ($result as $key => $val) {
                if ($val->pid == 0) {
                    $temp[] = "<li><a href=\"#\"><i class=\"fa fa-files-o fa-fw\"></i> $val->title<span class=\"fa arrow\"></span></a>";
                    $temp[] = '<ul class="nav nav-second-level">';
                    foreach ($result as $j => $k) {
                        if ($k->pid == $val->id) {
                            $temp[] = "<li><a href=" . site_url($k->url) . ">$k->title</a></li>";
                        }
                    }
                    $temp[] = '</ul>';
                }
            }
            $this->menu = $temp;
            // 缓存menu
            $this->cache->save('menu_' . $this->session->userdata('user_id'), $this->menu, 86400);
        }
    }

    /**
     * 创建一个CURL网络访问
     *
     * @param string $url  要访问的地址
     * @param array $data  要POST的值
     * @param array $headers  要附加的HTTP头信息
     * 
     * @return string  返回服务器的响应, false请求失败
     */
    public function curlRequest($url = '', $data = array(), $headers = array()) {
        if (empty($url))
            return false;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

        if ($headers) {
            $temp = array();
            foreach ($headers as $key => $val)
                $temp[] = "{$key}: {$val}";
            curl_setopt($ch, CURLOPT_HTTPHEADER, $temp);
        }

        if ($data) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        $output = curl_exec($ch);
        curl_close($ch);

        $startVar = substr($output, 0, 1);
        $endVar = substr($output, strlen($output) - 1, 1);
        if ($startVar == '{' && $endVar == '}' || $startVar == '[' && $endVar == ']') {
            $temp = @json_decode($output, true);
            if ($temp !== false)
                $output = $temp;
        }

        return $output;
    }

    public function getAccessToken() {
        $this->load->model('wxset_model');
        $wxinfo = $this->wxset_model->get_wxset();

        if (empty($wxinfo['access_token']) || $wxinfo['atendtime'] < time()) {
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$wxinfo['appid']}&secret={$wxinfo['appsecret']}";
            $reinfo = $this->curlRequest($url);
            $data['access_token'] = $reinfo['access_token'];
            $data['atendtime'] = time() + 7000;
            $this->wxset_model->update($data);
            $wxinfo['access_token'] = $data['access_token'];
        }

        return $wxinfo['access_token'];
    }

}

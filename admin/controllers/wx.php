<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Wx extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->_check_permit();
        $this->load->model('user_model');
    }

    public function add() {
        if (IS_POST) {
            // 过滤
            $this->form_validation->set_rules('username', '账号', 'required', array('required' => '请输入%s')
            );
            $this->form_validation->set_rules('password', '密码', 'required', array('required' => '请输入%s')
            );
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('user_add');
            } else {
                // 根据用户名查询用户信息 匹配密码是否相同
                // 查询用户信息
                $row = $this->user_model->get_user_by_name($this->input->post('username', true));
                if ($row) {
                    $this->_message('账号已经存在。', 'user/add');
                } else {
                    $data = array(
                        'username' => $this->input->post('username', true),
                        'password' => $this->input->post('password', true),
                        'add_time' => time(),
                    );
                    $this->user_model->add_user($data);
                    $this->_message('账号添加成功。', 'user/index');
                }
            }
        } else {
            $this->load->view('user_add');
        }
    }

    public function edit() {
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
            // 查询角色权限
            $row = $this->user_model->get_user_by_uid($this->uri->segment(3));
            // 查询所有角色
            $this->load->model('role_model');
            $data['roles'] = $this->role_model->get_roles();
            $data['role_id'] = $row->role_id;
            $data['uid'] = $this->uri->segment(3);
            $this->load->view('user_edit', $data);
        }
    }

    public function del() {
        $row = $this->user_model->del_user_by_uid($this->uri->segment(3));
        $this->_message('删除会员成功。', 'user/index');
    }

    public function index() {
        // 获取参数
        $offset = $this->uri->segment(3) > 0 ? $this->uri->segment(3) : 0;

        // 用户总数
        $config['total_rows'] = $this->user_model->get_user_count($this->input->get('keyword', true));
        $config['base_url'] = site_url() . '/user/index';
        $config['per_page'] = 15; // 单页显示多少个记录
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        // 分页字符
        $data['pages'] = $this->pagination->create_links();

        // 分页查询
        $data['total'] = $config['total_rows'];
        $data['users'] = $this->user_model->get_users($this->input->get('keyword', true), $config['per_page'], $offset);
        $this->load->view('user_index', $data);
    }

    public function action() {
        // 获取参数
        $offset = $this->uri->segment(3) > 0 ? $this->uri->segment(3) : 0;
        $condition['username'] = array('eq', $this->input->get('user', true));
        $condition['remark'] = array('like', $this->input->get('remark', true));

        // 用户总数
        $config['total_rows'] = $this->user_model->get_log_count($condition);
        $config['base_url'] = site_url() . '/user/action';
        $config['per_page'] = 5; // 单页显示多少个记录
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        // 分页字符
        $data['pages'] = $this->pagination->create_links();

        // 分页查询
        $data['total'] = $config['total_rows'];
        $data['action_logs'] = $this->user_model->get_logs($condition, $config['per_page'], $offset);
        $this->load->view('user_action', $data);
    }

    public function info() {
        if (IS_POST) {
            $this->_message('编辑会员信息成功。', 'user/info');
        }
        $this->load->model('role_model');
        $data['role'] = $this->role_model->get_role_by_id($this->session->userdata('role_id'));
        $this->load->view('user_info', $data);
    }

    public function wxset() {
        $this->load->model('wxset_model');
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

    public function head() {
        if (isset($_POST["upload_thumbnail"]) && $this->session->userdata('large_image_location')) {
            $x1 = $_POST["x1"];
            $y1 = $_POST["y1"];
            $x2 = $_POST["x2"];
            $y2 = $_POST["y2"];
            $w = $_POST["w"];
            $h = $_POST["h"];
            $scale = 100 / $w;
            $cropped = $this->resizeThumbnailImage($_SESSION['thumb_image_location'], $_SESSION['large_image_location'], $w, $h, $x1, $y1, $scale);
            // 更新用户
            $this->user_model->update_head($this->session->userdata('user_id'), $_SESSION['thumb_image_location']);
            // 更新当前头像session
            $this->session->set_userdata('head', $_SESSION['thumb_image_location']);

            unset($_SESSION['random_key']);
            unset($_SESSION['user_file_ext']);
            unset($_SESSION['thumb_image_location']);
            unset($_SESSION['large_image_location']);

            $this->_message('修改头像成功。', 'user/info');
        }
        if ($this->session->userdata('large_image_location')) {
            $data['current_large_image_width'] = $this->getWidth($_SESSION['large_image_location']);
            $data['current_large_image_height'] = $this->getHeight($_SESSION['large_image_location']);
        }
        $data['thumb_width'] = "100";
        $data['thumb_height'] = "100";
        $this->load->view('user_head', $data);
    }

    public function upload() {
        // 上传设置
        if (!isset($_SESSION['random_key']) || strlen($_SESSION['random_key']) == 0) {
            $_SESSION['random_key'] = strtotime(date('Y-m-d H:i:s')); //assign the timestamp to the session variable
            $_SESSION['user_file_ext'] = "";
        }
        $upload_dir = "upload_pic";
        $upload_path = $upload_dir . "/";
        $large_image_prefix = "resize_";
        $thumb_image_prefix = "thumbnail_";
        $large_image_name = $large_image_prefix . $_SESSION['random_key'];
        $thumb_image_name = $thumb_image_prefix . $_SESSION['random_key'];
        $max_file = "3";
        $max_width = "500";
        $thumb_width = "100";
        $thumb_height = "100";
        $allowed_image_types = array('image/pjpeg' => "jpg", 'image/jpeg' => "jpg", 'image/jpg' => "jpg", 'image/png' => "png", 'image/x-png' => "png", 'image/gif' => "gif");
        $large_image_location = $upload_path . $large_image_name . $_SESSION['user_file_ext'];
        $thumb_image_location = $upload_path . $thumb_image_name . $_SESSION['user_file_ext'];

        // 检查目录
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777);
            chmod($upload_dir, 0777);
        }

        // 提交
        if (isset($_POST["upload"])) {
            // 上传文件信息
            $userfile_name = $_FILES['image']['name'];
            $userfile_tmp = $_FILES['image']['tmp_name'];
            $userfile_size = $_FILES['image']['size'];
            $userfile_type = $_FILES['image']['type'];
            $filename = basename($_FILES['image']['name']);
            $file_ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
            // 检查上传文件
            if ((!empty($_FILES["image"])) && ($_FILES['image']['error'] == 0)) {
                $_temp = false;
                foreach ($allowed_image_types as $mime_type => $ext) {
                    if ($file_ext == $ext && $userfile_type == $mime_type) {
                        $_temp = true;
                    }
                }
                if (!$_temp) {
                    $this->_message('请上传图片格式文件。', 'user/head');
                }
                if ($userfile_size > ($max_file * 1048576)) {
                    $this->_message("请上传小于$max_file的图片。", 'user/head');
                }
            } else {
                $this->_message('请选择图片上传。', 'user/head');
            }
            // 检测通过，上传
            if (isset($_FILES['image']['name'])) {
                // 重新命名
                $large_image_location = $large_image_location . "." . $file_ext;
                $thumb_image_location = $thumb_image_location . "." . $file_ext;
                // 文件格式
                $_SESSION['user_file_ext'] = "." . $file_ext;

                move_uploaded_file($userfile_tmp, $large_image_location);
                chmod($large_image_location, 0777);

                $width = $this->getWidth($large_image_location);
                $height = $this->getHeight($large_image_location);
                // 如果太大重新定义它不超过最大宽度
                if ($width > $max_width) {
                    $scale = $max_width / $width;
                    $uploaded = $this->resizeImage($large_image_location, $width, $height, $scale);
                } else {
                    $scale = 1;
                    $uploaded = $this->resizeImage($large_image_location, $width, $height, $scale);
                }
                // 如果有旧的缩略图，删除
                if (file_exists($thumb_image_location)) {
                    unlink($thumb_image_location);
                }
            }
            $_SESSION['large_image_location'] = $large_image_location;
            $_SESSION['thumb_image_location'] = $thumb_image_location;
            $this->_message('上传成功。', 'user/head');
        }
    }

    private function resizeImage($image, $width, $height, $scale) {
        list($imagewidth, $imageheight, $imageType) = getimagesize($image);
        $imageType = image_type_to_mime_type($imageType);
        $newImageWidth = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth, $newImageHeight);
        switch ($imageType) {
            case "image/gif":
                $source = imagecreatefromgif($image);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                $source = imagecreatefromjpeg($image);
                break;
            case "image/png":
            case "image/x-png":
                $source = imagecreatefrompng($image);
                break;
        }
        imagecopyresampled($newImage, $source, 0, 0, 0, 0, $newImageWidth, $newImageHeight, $width, $height);

        switch ($imageType) {
            case "image/gif":
                imagegif($newImage, $image);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                imagejpeg($newImage, $image, 90);
                break;
            case "image/png":
            case "image/x-png":
                imagepng($newImage, $image);
                break;
        }

        chmod($image, 0777);
        return $image;
    }

    //You do not need to alter these functions
    private function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale) {
        list($imagewidth, $imageheight, $imageType) = getimagesize($image);
        $imageType = image_type_to_mime_type($imageType);

        $newImageWidth = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth, $newImageHeight);
        switch ($imageType) {
            case "image/gif":
                $source = imagecreatefromgif($image);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                $source = imagecreatefromjpeg($image);
                break;
            case "image/png":
            case "image/x-png":
                $source = imagecreatefrompng($image);
                break;
        }
        imagecopyresampled($newImage, $source, 0, 0, $start_width, $start_height, $newImageWidth, $newImageHeight, $width, $height);
        switch ($imageType) {
            case "image/gif":
                imagegif($newImage, $thumb_image_name);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                imagejpeg($newImage, $thumb_image_name, 90);
                break;
            case "image/png":
            case "image/x-png":
                imagepng($newImage, $thumb_image_name);
                break;
        }
        chmod($thumb_image_name, 0777);
        return $thumb_image_name;
    }

    //You do not need to alter these functions
    private function getHeight($image) {
        $size = getimagesize($image);
        $height = $size[1];
        return $height;
    }

    //You do not need to alter these functions
    private function getWidth($image) {
        $size = getimagesize($image);
        $width = $size[0];
        return $width;
    }

}

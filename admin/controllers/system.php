<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class System extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->_check_permit();
    }

    public function clear() {
        // 删除菜单缓存
        $this->cache->clean();
        // ...
        $this->_message('更新缓存成功。', 'index/main');
    }

}

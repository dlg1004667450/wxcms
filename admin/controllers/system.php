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

    public function dbback() {
        if (IS_POST) {
            $this->load->dbutil();
            $prefs = array(
                'tables' => array(), // 包含了需备份的表名的数组.
                'ignore' => array(), // 备份时需要被忽略的表
                'format' => 'txt', // gzip, zip, txt
                'filename' => 'mybackup.sql', // 文件名 - 如果选择了ZIP压缩,此项就是必需的
                'add_drop' => TRUE, // 是否要在备份文件中添加 DROP TABLE 语句
                'add_insert' => TRUE, // 是否要在备份文件中添加 INSERT 语句
                'newline' => "\n"               // 备份文件中的换行符
            );
            $backup = $this->dbutil->backup($prefs);

            $this->load->helper('file');
            $query = write_file('./dbback/database.sql', $backup);
            if ($query) {
                $this->_message('成功', 'system/dbback');
            } else {
                $this->_message('失败', 'system/dbback');
            }
        } else {
            $data['list'] = $this->db->list_tables();
            $this->load->view('db_index', $data);
        }
    }

    //还原备份 （调试中）
    function dbrest() {
        
         $this->_message('此功能尚未开发！', 'system/dbback');
         die;
        $this->load->helper('file');

    //$content = read_file('./database.sql');
    //$content = preg_replace("/#(.*)\\s#(.*)TABLE(.*)(.*)\\s#/i","",$content);//去掉注释部分

        $conn = mysql_connect("localhost", "root", ""); //指定数据库连接参数

        mysql_select_db("test");

        $file = BASEPATH . "database.sql";

        mysql_query("source '" . $file . "';");

        mysql_close($conn);

        /* $sqls = explode(";\\r",$content);
          foreach($sqls as $sql){
          if(str_replace(" ","",$sql)){
                $this->db->query($sql);
          }
         */
    }

}

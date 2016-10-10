<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>CI基础后台</title>
        <?php $this->load->view('head'); ?>
    </head>
    <body>
        <div id="wrapper">
            <?php $this->load->view('navigate'); ?>
            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="page-header">设置</h2>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php echo validation_errors(); ?>
                            <?php echo form_open('wx/wxset'); ?>
                            <div class="form-group">
                                <label>微信自定义token</label>
                                <input type="text" name="token" value="<?php echo $wxinfo['token']?$wxinfo['token']:set_value('token'); ?>" class="form-control">
                                <label>微信appid</label>
                                <input type="text" name="appid" value="<?php echo $wxinfo['appid']?$wxinfo['appid']:set_value('appid'); ?>" class="form-control">
                                <label>微信secret</label>
                                <input type="text" name="appsecret" value="<?php echo $wxinfo['appsecret']?$wxinfo['appsecret']:set_value('appsecret'); ?>" class="form-control">
                            </div>
                            <input type="submit" name="sub1" class="btn btn-default" value="保存">
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->
        <?php $this->load->view('foot'); ?>
    </body>
</html>
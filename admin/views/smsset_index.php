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
        <title>短信设置</title>
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
                            <h2 class="page-header">邮箱设置</h2>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php echo validation_errors(); ?>
                            <?php echo form_open('other/smsset'); ?>
                            <div class="form-group">
                                
                                <label>短信账号</label>
                                <input type="text" name="smsname" value="<?php echo $email['smsname']?$email['smsname']:set_value('smsname'); ?>" class="form-control">
                                
                                <label>短信密码</label>
                                <input type="text" name="smspwd" value="<?php echo $email['smspwd']?$email['smspwd']:set_value('smspwd'); ?>" class="form-control">
                                
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
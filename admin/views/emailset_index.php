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
                            <h2 class="page-header">邮箱设置</h2>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php echo validation_errors(); ?>
                            <?php echo form_open('other/emailset'); ?>
                            <div class="form-group">
                                
                                <label>是否启用SMTP邮箱</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="1" name="status" <?php echo $email['status']?'checked':''; ?>>勾选后下面设置才能生效
                                    </label>
                                </div>
                                
                                <label>SMTP邮局地址</label>
                                <input type="text" name="smpt" value="<?php echo $email['smpt']?$email['smpt']:set_value('smpt'); ?>" class="form-control">
                                
                                <label>发件邮箱</label>
                                <input type="text" name="emailname" value="<?php echo $email['emailname']?$email['emailname']:set_value('emailname'); ?>" class="form-control">
                                
                                <label>邮箱密码</label>
                                <input type="text" name="emailpwd" value="<?php echo $email['emailpwd']?$email['emailpwd']:set_value('emailpwd'); ?>" class="form-control">
                                
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
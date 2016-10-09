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
    <?php $this->load->view('head');?>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">管理后台</h3>
                    </div>
                    <div class="panel-body">
						<?php echo form_open('privilege/login'); ?>
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="账号" name="username" type="text" value="<?php echo set_value('username'); ?>">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="密码" name="password" type="password" value="<?php echo set_value('password'); ?>">
                                </div>
                                <div>
                                    <?php echo validation_errors(); ?>
                                </div>
                                <input type="submit" name="sub1" class="btn btn-lg btn-success btn-block" value="登录">
                            </fieldset>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('foot');?>
</body>
</html>

	    
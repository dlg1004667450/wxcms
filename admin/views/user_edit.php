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
                            <h2 class="page-header">编辑用户</h2>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php echo validation_errors(); ?>
                            <?php echo form_open('user/edit', '', array('uid' => $uid)); ?>
                            <div class="form-group">
                                <label>角色</label>
                                <select name="role_id" class="form-control">
                                    <?php foreach ($roles as $key => $val): ?>
                                        <?php
                                        $selected = '';
                                        if ($val->id == $role_id) {
                                            $selected = 'selected';
                                        }
                                        ?>
                                        <option value="<?php echo $val->id; ?>" <?php echo $selected ?>><?php echo $val->role_name ?></option>
                                    <?php endforeach; ?>
                                </select></p>
                            </div>
                            <input type="submit" name="sub1" class="btn btn-default" value="编辑">
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
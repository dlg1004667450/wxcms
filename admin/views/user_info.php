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
    <div id="wrapper">
        <?php $this->load->view('navigate');?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header">用户资料</h2>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                	<div class="col-lg-12">
                	<div class="form-group">
						<label>账号</label>
						<?php echo $this->session->userdata('user_name'); ?>
					</div>
					<div class="form-group">
						<label>角色</label>
						<?php if ($this->session->userdata('role_id') == 0) {echo '超级管理';} else {echo $role->role_name;}?>
					</div>
					<div class="form-group">
						<label>头像</label>
						<a href="<?php echo site_url('user/head');?>" title="修改头像"><img src="<?php echo base_url().$this->session->userdata('head');?>" width="100px" height="100px" style="border:1px #e5e5e5 solid; padding:3px;"></a>
					</div>
					</div>
				</div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <?php $this->load->view('foot');?>
</body>
</html>
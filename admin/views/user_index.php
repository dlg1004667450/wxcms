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
                        <h2 class="page-header">用户列表</h2>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                	<div class="col-lg-12">
                		<div class="form-inline">
	                		<div class="form-group">
					    		<a href="<?php echo site_url('user/add'); ?>" class="btn btn-success">添加用户</a>
					    	</div>
					    	<div class="form-group">
						    <?php $attributes = array('method' => 'get'); echo form_open('user/index', $attributes); ?>
		                        用户 <input type="text" name="keyword" value="<?php echo $this->input->get('keyword', true); ?>" class="form-control">
							<?php echo form_close(); ?>
							</div>
							<button type="submit" name="sub1" class="btn btn-default" value="">查询</button>
						</div>
						<table class="table table-striped">
							<thead>
							<tr>
								<th>#</th><th>账号</th><th>角色</th><th>操作</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($users as $key=>$val): ?>
							<tr>
								<td><?php echo $val->uid?></td>
								<td><?php echo $val->username?></td>
								<td><?php echo $val->role_name?></td>
								<td><a href="<?php echo site_url('user/edit/'.$val->uid)?>" class="btn btn-primary btn-xs">编辑</a> <a href="<?php echo site_url('user/del/'.$val->uid)?>" class="btn btn-danger btn-xs">删除</a></td>
							</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
						<?php echo $pages;?>
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
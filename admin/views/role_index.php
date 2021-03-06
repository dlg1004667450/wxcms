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
                        <h2 class="page-header">角色列表</h2>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                	<div class="col-lg-12">
				    <a href="<?php echo site_url('role/add'); ?>" class="btn btn-success">添加角色</a>
					<table class="table table-striped">
						<thead>
						<tr>
							<th>角色</th><th>操作</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($roles as $key=>$val): ?>
						<tr>
							<td><?php echo $val->role_name?></td>
							<td>
							<a href="<?php echo site_url('role/set_permit/'.$val->id)?>" class="btn btn-primary btn-xs">权限</a>
							<a href="<?php echo site_url('role/del/'.$val->id)?>" class="btn btn-danger btn-xs">删除</a>
							</td>
						</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
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
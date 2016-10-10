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
                        <h2 class="page-header">节点列表</h2>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                	<div class="col-lg-12">
				    <a href="<?php echo site_url('menu/add'); ?>" class="btn btn-success">添加节点</a>
					<table class="table table-striped">
						<thead>
						<tr>
							<th>ID</th><th>节点</th><th>url</th><th>pid</th><th>操作</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($menus as $key=>$val): ?>
						<tr>
							<td><?php echo $val->id?></td>
							<td><?php echo $val->title?></td>
							<td><?php echo $val->url?></td>
							<td><?php echo $val->pid?></td>
							<td><a href="<?php echo site_url('menu/del/'.$val->id)?>" class="btn btn-danger btn-xs">删除</a></td>
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
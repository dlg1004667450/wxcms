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
                        <h2 class="page-header">添加节点</h2>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                	<div class="col-lg-12">
					    <?php echo validation_errors(); ?>
						<?php echo form_open('menu/add'); ?>
						<div class="form-group">
							<label>节点</label>
							<input type="text" name="title" value="<?php echo set_value('title'); ?>" class="form-control">
							<label>链接</label>
							<input type="text" name="url" value="<?php echo set_value('url'); ?>" class="form-control">
							<label>父节</label>
							<select name="pid" class="form-control">
							<?php foreach ($pids as $key=>$val): ?>
							<option value="<?php echo $val->id?>"><?php echo $val->title?></option>
							<?php endforeach; ?>
							</select>
						</div>
						<input type="submit" name="sub1" value="添加" class="btn btn-default">
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
    <?php $this->load->view('foot');?>
</body>
</html>
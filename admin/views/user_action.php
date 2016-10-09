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
                        <h2 class="page-header">用户行为</h2>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                	<div class="col-lg-12">
                		<div class="form-inline">
                			<?php $attributes = array('method' => 'get'); echo form_open('user/action', $attributes); ?>
	                		<div class="form-group">
					    		用户 <input type="text" name="user" value="<?php echo $this->input->get('user', true); ?>" class="form-control">
					    	</div>
					    	<div class="form-group">
		                        备注 <input type="text" name="remark" value="<?php echo $this->input->get('remark', true); ?>" class="form-control">
							</div>
							<button type="submit" name="sub1" class="btn btn-default">查询</button>
							<?php echo form_close(); ?>
						</div>
						<table class="table table-striped">
							<thead>
							<tr>
								<th>#</th><th>用户</th><th>ip</th><th>备注</th><th>时间</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($action_logs as $key=>$val): ?>
							<tr>
								<td><?php echo $val->id?></td>
								<td><?php echo $val->username?></td>
								<td><?php echo $val->ip?></td>
								<td><?php echo $val->remark?></td>
								<td><?php echo date('Y-m-d H:i:s', $val->time)?></td>
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
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
                        <h2 class="page-header">行为列表</h2>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                	<div class="col-lg-12">
				    <a href="<?php echo site_url('action/add'); ?>" class="btn btn-success">添加行为</a>
					<table class="table table-striped">
						<thead>
						<tr>
							<th>行为标识</th><th>行为说明</th><th>状态</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($actions as $key=>$val): ?>
						<tr>
							<td><?php echo $val->name?></td><td><?php echo $val->title?></td><td><span id="<?php echo $val->id?>" onclick="change(<?php echo $val->id?>)" style="padding:10px;font-size:16px;cursor:pointer;"><?php if ($val->status == 1):?><b style="color:green;">√</b><?php else:?><b style="color:red;">×</b><?php endif;?></span></td>
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
<script>
function change(id) {
	$.ajax({
		type: "POST",
		url: "<?php echo site_url('action/ajax')?>",
		data: {id: id},
		dataType: "json",
		success: function(data){
			if (data.result == 1) {
				$("#"+id).html('<b style="color:green;">√</b>');
			} else {
				$("#"+id).html('<b style="color:red;">×</b>');
			}
		}
	});
}
</script>	
</body>
</html>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="3; url=<?php echo site_url($goto)?>">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>提示消息</title>
    <?php $this->load->view('head');?>
</head>
<body>
    <div id="wrapper">
        <div style="width:450px; margin:50px auto;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header">提示消息</h2>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                	<div class="col-lg-12">
                        <?php echo $message; ?> 3秒跳转 <a href="<?php echo site_url($goto)?>">返回</a>
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
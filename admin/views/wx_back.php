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
                            <h2 class="page-header">自动回复列表</h2>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-inline">
                                <?php $attributes = array('method' => 'get');echo form_open('wx/wxback', $attributes); ?>
                                <div class="form-group">
                                    <a href="<?php echo site_url('wx/add_wxback'); ?>" class="btn btn-success">添加回复</a>
                                </div>
                                <div class="form-group">
                                    Code <input type="text" name="keyword" value="<?php echo $this->input->get('keyword', true); ?>" class="form-control">
                                </div>
                                <button type="submit" name="sub1" class="btn btn-default" value="">查询</button>
                                <?php echo form_close(); ?>
                            </div>
                            
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Code</th><th>类型</th><th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($wxbackarr as $key => $val): ?>
                                        <tr>
                                            <td><?php echo $val['id']; ?></td>
                                            <td><?php echo $val['code']; ?></td>
                                            <td><?php echo $msgtype[$val['msgtype']]; ?></td>
                                            <td><a href="<?php echo site_url('wx/edit_wxback/' . $val['id']) ?>" class="btn btn-primary btn-xs">编辑</a> <a href="<?php echo site_url('wx/del_wxback/' . $val['id']) ?>" class="btn btn-danger btn-xs">删除</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php echo $pages; ?>
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
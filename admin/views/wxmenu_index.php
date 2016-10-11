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
                            <h2 class="page-header">节点列表</h2>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="<?php echo site_url('wx/add'); ?>" class="btn btn-success">添加菜单</a>
                            <a href="<?php echo site_url('wx/postwxmenu'); ?>" class="btn btn-primary">更新到微信Menu</a>
                            <a href="<?php echo site_url('wx/delwxmenu'); ?>" class="btn btn-info">获取到本地Menu</a>
                            <a href="<?php echo site_url('wx/getwxmenu'); ?>" class="btn btn-warning">清空微信Menu</a>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>导航名</th><th>菜单类型</th><th>内容</th><th>排序</th><th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($menus as $val): ?>
                                        <tr>
                                            <td><?php echo $val['parent_id'] > 0 ? '&nbsp;&nbsp;&nbsp;&nbsp;' : ''; ?><?php echo $val['name'] ?></td>
                                            <td><?php echo $val['type'] == 'view' ? '跳转连接' : '回复信息'; ?></td>
                                            <td><?php echo $val['type'] == 'view' ? '编辑连接' : '编辑内容' ?></td>
                                            <td><?php echo $val['sort'] ?></td>
                                            <td><a href="<?php echo site_url('wx/edit_wxmenu/' . $val['id']) ?>" class="btn btn-primary btn-xs">编辑</a> <a href="<?php echo site_url('wx/del_wxmenu/' . $val['id']) ?>" class="btn btn-danger btn-xs">删除</a></td>
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
        <?php $this->load->view('foot'); ?>
    </body>
</html>
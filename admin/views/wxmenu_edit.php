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
                            <h2 class="page-header">添加回复</h2>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php echo validation_errors(); ?>
                            <?php echo form_open('wx/add_wxback'); ?>
                            <div class="form-group">
                                <label>导航名</label>
                                <input type="text" name="name" value="<?php echo set_value('name'); ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Code</label>
                                <input type="text" name="code" value="<?php echo set_value('code'); ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>所在分类</label>
                                <select name="parent_id" class="form-control">
                                    <option>顶级分类</option>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>排序ID</label>
                                <input type="text" name="sort" value="<?php echo set_value('sort'); ?>" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <input type="radio" name="msgtype" value="1" checked>跳转连接
                                <input type="radio" name="msgtype" value="2">回复信息
                            </div>
                            
                            <div class="form-group form form1">
                                <label>链接描述</label>
                                <input type="text" name="lj_link" value="<?php echo set_value('lj_link'); ?>" class="form-control">
                            </div>
                            <div class="form-group form form1">
                                <label>链接</label>
                                <input type="text" name="lj_link" value="<?php echo set_value('lj_link'); ?>" class="form-control">
                            </div>
                            
                            <div class="form-group form form2" style="display: none;">
                                <label>内容</label>
                                <input type="text" name="wb_content" value="<?php echo set_value('wb_content'); ?>" class="form-control">
                            </div>
                            
                            <button type="submit" class="btn btn-default">添加</button>
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
        <?php $this->load->view('foot'); ?>
        <script>
            $('input[type=radio]').on('change', function(){
                $('.form').each(function(){
                    $(this).hide();
                });
                
                $('.form'+$("input[type=radio][name=msgtype]:checked").val()).each(function(){
                    $(this).show();
                });
            });
        </script>
    </body>
</html>

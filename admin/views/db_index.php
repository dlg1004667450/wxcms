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
                            <h2 class="page-header">用户列表</h2>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php $attributes = array('method' => 'post'); echo form_open('system/dbback', $attributes); ?>
                            <div class="form-inline">
                                <div class="form-group">
                                    <input type="submit" name="submit" class="btn btn-success disabled" disabled="disabled" value="备份数据" />
                                </div>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="deletec" name="deletec" onclick="setC()"></th>
                                        <th>表名称</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list as $val): ?>
                                    <tr>
                                        <td><input type="checkbox" name="id[]" class="deletec" value="<?php echo $val?>" ></td>
                                        <td><?php echo $val?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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
        <script type="text/javascript">
            $(document).ready(function(){
                $(".deletec").change(function(){
                    console.log('点击你阿');
//                    if($("input:checkbox[name='id[]']:checked").length > 0){//至少有一个复选框选中
                        $("input[name='submit']").attr("disabled",false).removeClass('disabled');
//                    } else {
//                        $("input[name='submit']").attr("disabled",true).addClass('disabled');
//                    }
                });
            });

            function setC() {
                if( $('#deletec').is(':checked') ) {
                    $(".deletec").attr("checked",true);
                } else {
                    $(".deletec").attr("checked",false);
                }
            }
        </script>
    </body>
</html>
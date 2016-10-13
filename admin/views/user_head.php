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
                            <h2 class="page-header">修改头像</h2>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if ($this->session->userdata('large_image_location')): ?>
                                <img src="<?php echo base_url() . $this->session->userdata('large_image_location'); ?>" style="border:1px #e5e5e5 solid; float: left; margin-right: 10px; margin-bottom: 10px;" id="thumbnail" alt="截取头像" />
                                <div style="border:1px #e5e5e5 solid; float:left; position:relative; overflow:hidden; width:100px; height:100px;">
                                    <img src="<?php echo base_url() . $this->session->userdata('large_image_location'); ?>" style="position: relative;" alt="Thumbnail Preview" />
                                </div>
                                <br style="clear:both;"/>
                                <div class="form-group">
                                    <form name="thumbnail" action="<?php echo site_url('user/head'); ?>" method="post">
                                        <input type="hidden" name="x1" value="" id="x1" />
                                        <input type="hidden" name="y1" value="" id="y1" />
                                        <input type="hidden" name="x2" value="" id="x2" />
                                        <input type="hidden" name="y2" value="" id="y2" />
                                        <input type="hidden" name="w" value="" id="w" />
                                        <input type="hidden" name="h" value="" id="h" />
                                        <input type="submit" name="upload_thumbnail" value="保存头像" id="save_thumb" class="btn btn-default"/>
                                    </form>
                                </div>
                                <hr>
                            <?php endif; ?>

                            <form name="photo" action="<?php echo site_url('user/upload'); ?>" enctype="multipart/form-data"  method="post">
                                <div class="form-group">
                                    <input type="file" name="image" size="30" class="form-control"/>
                                </div>
                                <input type="submit" name="upload" class="btn btn-default" value="上传">
                            </form>
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

        <?php if ($this->session->userdata('large_image_location')): ?>
            <script type="text/javascript" src="<?php echo base_url(); ?>style/admin/js/jquery-pack.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>style/admin/js/jquery.imgareaselect.min.js"></script>
            <script type="text/javascript">
                function preview(img, selection) {
                    var scaleX = <?php echo $thumb_width; ?> / selection.width;
                    var scaleY = <?php echo $thumb_height; ?> / selection.height;

                    $('#thumbnail + div > img').css({
                        width: Math.round(scaleX * <?php echo $current_large_image_width; ?>) + 'px',
                        height: Math.round(scaleY * <?php echo $current_large_image_height; ?>) + 'px',
                        marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px',
                        marginTop: '-' + Math.round(scaleY * selection.y1) + 'px'
                    });
                    $('#x1').val(selection.x1);
                    $('#y1').val(selection.y1);
                    $('#x2').val(selection.x2);
                    $('#y2').val(selection.y2);
                    $('#w').val(selection.width);
                    $('#h').val(selection.height);
                }
                var jq = jQuery.noConflict();
                jq(document).ready(function () {
                    jq('#save_thumb').click(function () {
                        var x1 = jq('#x1').val();
                        var y1 = jq('#y1').val();
                        var x2 = jq('#x2').val();
                        var y2 = jq('#y2').val();
                        var w = jq('#w').val();
                        var h = jq('#h').val();
                        if (x1 == "" || y1 == "" || x2 == "" || y2 == "" || w == "" || h == "") {
                            alert("请选择一块区域作为您的头像。");
                            return false;
                        } else {
                            return true;
                        }
                    });
                });

                jq(window).load(function () {
                    jq('#thumbnail').imgAreaSelect({aspectRatio: '1:<?php echo $thumb_height / $thumb_width; ?>', onSelectChange: preview});
                });
            </script>
        <?php endif; ?>
    </body>
</html>
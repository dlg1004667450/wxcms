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
                        <h2 class="page-header">后台首页</h2>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                	<div class="row">
		                <div class="col-lg-3 col-md-6">
		                    <div class="panel panel-primary">
		                        <div class="panel-heading">
		                            <div class="row">
		                                <div class="col-xs-3">
		                                    <i class="fa fa-comments fa-5x"></i>
		                                </div>
		                                <div class="col-xs-9 text-right">
		                                    <div class="huge">26</div>
		                                    <div>New Comments!</div>
		                                </div>
		                            </div>
		                        </div>
		                        <a href="#">
		                            <div class="panel-footer">
		                                <span class="pull-left">View Details</span>
		                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
		                                <div class="clearfix"></div>
		                            </div>
		                        </a>
		                    </div>
		                </div>
		                <div class="col-lg-3 col-md-6">
		                    <div class="panel panel-green">
		                        <div class="panel-heading">
		                            <div class="row">
		                                <div class="col-xs-3">
		                                    <i class="fa fa-tasks fa-5x"></i>
		                                </div>
		                                <div class="col-xs-9 text-right">
		                                    <div class="huge">12</div>
		                                    <div>New Tasks!</div>
		                                </div>
		                            </div>
		                        </div>
		                        <a href="#">
		                            <div class="panel-footer">
		                                <span class="pull-left">View Details</span>
		                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
		                                <div class="clearfix"></div>
		                            </div>
		                        </a>
		                    </div>
		                </div>
		                <div class="col-lg-3 col-md-6">
		                    <div class="panel panel-yellow">
		                        <div class="panel-heading">
		                            <div class="row">
		                                <div class="col-xs-3">
		                                    <i class="fa fa-shopping-cart fa-5x"></i>
		                                </div>
		                                <div class="col-xs-9 text-right">
		                                    <div class="huge">124</div>
		                                    <div>New Orders!</div>
		                                </div>
		                            </div>
		                        </div>
		                        <a href="#">
		                            <div class="panel-footer">
		                                <span class="pull-left">View Details</span>
		                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
		                                <div class="clearfix"></div>
		                            </div>
		                        </a>
		                    </div>
		                </div>
		                <div class="col-lg-3 col-md-6">
		                    <div class="panel panel-red">
		                        <div class="panel-heading">
		                            <div class="row">
		                                <div class="col-xs-3">
		                                    <i class="fa fa-support fa-5x"></i>
		                                </div>
		                                <div class="col-xs-9 text-right">
		                                    <div class="huge">13</div>
		                                    <div>Support Tickets!</div>
		                                </div>
		                            </div>
		                        </div>
		                        <a href="#">
		                            <div class="panel-footer">
		                                <span class="pull-left">View Details</span>
		                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
		                                <div class="clearfix"></div>
		                            </div>
		                        </a>
		                    </div>
		                </div>
		            </div>
		            <!-- /.row -->
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
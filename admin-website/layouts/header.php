<?php require_once '../src/model.php'; ?>
<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/jquery.tosrus.all.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
    <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
    
    <link rel="icon" type="image/png" href="images/favicon.png">    
    <title>Admin | Dashboard</title>
</head>
<body>
  <img src="../images/loader.gif" id="loader" class="hidden-xs hidden-sm">
  <nav class="navbar navbar-default" role="navigation">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <a class="navbar-brand" target="_blank" href="../../index.php">Website</a>
        </div>
    
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="">
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle user-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;Settings <b class="caret"></b></a>
              <ul class="dropdown-menu user-menu">
                <!-- <li><a href="#"><span class="glyphicon glyphicon-edit"></span> Change Password</a></li> -->
                <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>                
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div>
    </nav> <!-- End of nav -->
 <div class="container-fluid">
    <div class="row content-biginer">
      <div class="col-md-3 col-lg-2 col-sm-5 col-xs-12 left-container">
            <div class="row user">
                <div class="col-md-12">                                      
                    <div class="col-md-12 user-section">
                      <img src="../images/logo.png" class="pull-center">
                      <div class="clearfix"></div>
                      <!--
                      <a class="btn btn-primary" href="#" role="button"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Admin</a>
                      &nbsp;&nbsp;&nbsp;<a class="btn btn-primary" href="#" role="button"><span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;Chat</a>
                      -->
                    </div> 
                </div>
            </div>
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex2-collapse" style="border:1px solid white;">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar" style="background: gray;"></span>
              <span class="icon-bar" style="background: gray;"></span>
              <span class="icon-bar" style="background: gray;"></span>
            </button>
            <a class="navbar-brand visible-xs" href="#">Navigation Menu</a>
          </div>
          <div class="panel-group collapse navbar-collapse navbar-ex2-collapse" id="accordion">
              <br/>
            <div class="panel panel-default noborder main-menu">
              <div class="panel-heading menu-head">
                <h4 class="panel-title"><a style="display: block;" href="index.php"><span class="glyphicon glyphicon-home"></span>&nbsp;Dashboard</a>
                </h4>
              </div>
            </div>
            <div class="panel panel-default noborder main-menu">
              <div class="panel-heading menu-head">
                <h4 class="panel-title"><a style="display: block;" data-toggle="collapse" data-parent="#accordion" href="#collapse0"><span class="glyphicon glyphicon-list"></span>&nbsp;Author</a>
                </h4>
              </div>
              <div id="collapse0" class="panel-collapse collapse">
                  <div class="list-group">
                    <a href="index.php?page=Author_read" class="list-group-item">List</a>
                    <a href="index.php?page=Author_create" class="list-group-item">Create</a>        
                  </div>
              </div>
            </div>
            <div class="panel panel-default noborder main-menu">
              <div class="panel-heading menu-head">
                <h4 class="panel-title"><a style="display: block;" data-toggle="collapse" data-parent="#accordion" href="#collapse1"><span class="glyphicon glyphicon-list"></span>&nbsp;Category</a>
                </h4>
              </div>
              <div id="collapse1" class="panel-collapse collapse">
                  <div class="list-group">
                    <a href="index.php?page=Category_read" class="list-group-item">List</a>
                    <a href="index.php?page=Category_create" class="list-group-item">Create</a>        
                  </div>
              </div>
            </div>
            <div class="panel panel-default noborder main-menu">
              <div class="panel-heading menu-head">
                <h4 class="panel-title"><a style="display: block;" data-toggle="collapse" data-parent="#accordion" href="#collapse3"><span class="glyphicon glyphicon-list"></span>&nbsp;Tags</a>
                </h4>
              </div>
              <div id="collapse3" class="panel-collapse collapse">
                  <div class="list-group">
                    <a href="index.php?page=Tags_read" class="list-group-item">List</a>
                    <a href="index.php?page=Tags_create" class="list-group-item">Create</a>        
                  </div>
              </div>
            </div>
            
            <div class="panel panel-default noborder main-menu">
              <div class="panel-heading menu-head">
                <h4 class="panel-title"><a style="display: block;" data-toggle="collapse" data-parent="#accordion" href="#collapse4"><span class="glyphicon glyphicon-list"></span>&nbsp;Images</a>
                </h4>
              </div>
              <div id="collapse4" class="panel-collapse collapse">
                  <div class="list-group">
                    <a href="index.php?page=Images_read" class="list-group-item">List</a>
                    <a href="index.php?page=Images_create" class="list-group-item">Create</a>        
                  </div>
              </div>
            </div>
            
            <div class="panel panel-default noborder main-menu">
              <div class="panel-heading menu-head">
                <h4 class="panel-title"><a style="display: block;" data-toggle="collapse" data-parent="#accordion" href="#collapse5"><span class="glyphicon glyphicon-list"></span>&nbsp;Blog Content</a>
                </h4>
              </div>
              <div id="collapse5" class="panel-collapse collapse">
                  <div class="list-group">
                    <a href="index.php?page=Content_read" class="list-group-item">List</a>
                    <a href="index.php?page=Content_create" class="list-group-item">Create</a>        
                  </div>
              </div>
            </div>
            
            <div class="panel panel-default noborder main-menu">
              <div class="panel-heading menu-head">
                <h4 class="panel-title"><a style="display: block;" data-toggle="collapse" data-parent="#accordion" href="#collapse6"><span class="glyphicon glyphicon-list"></span>&nbsp;Subcribe</a>
                </h4>
              </div>
              <div id="collapse6" class="panel-collapse collapse">
                  <div class="list-group">
                    <a href="index.php?page=Subcribe_read" class="list-group-item">List</a>        
                  </div>
              </div>
            </div>
            
            <div class="panel panel-default noborder main-menu">
              <div class="panel-heading menu-head">
                <h4 class="panel-title"><a style="display: block;" data-toggle="collapse" data-parent="#accordion" href="#collapse7"><span class="glyphicon glyphicon-list"></span>&nbsp;About</a>
                </h4>
              </div>
              <div id="collapse7" class="panel-collapse collapse">
                  <div class="list-group">
                    <a href="index.php?page=About_read" class="list-group-item">List</a>       
                  </div>
              </div>
            </div>
            
            <div class="panel panel-default noborder main-menu">
              <div class="panel-heading menu-head">
                <h4 class="panel-title"><a style="display: block;" data-toggle="collapse" data-parent="#accordion" href="#collapse8"><span class="glyphicon glyphicon-list"></span>&nbsp;Social</a>
                </h4>
              </div>
              <div id="collapse8" class="panel-collapse collapse">
                  <div class="list-group">
                    <a href="index.php?page=Social_read" class="list-group-item">List</a>      
                  </div>
              </div>
            </div>
            
            
            <div class="panel panel-default noborder main-menu">
              <div class="panel-heading menu-head">
                <h4 class="panel-title"><a style="display: block;" data-toggle="collapse" data-parent="#accordion" href="#collapse9"><span class="glyphicon glyphicon-list"></span>&nbsp;Advertise</a>
                </h4>
              </div>
              <div id="collapse9" class="panel-collapse collapse">
                  <div class="list-group">
                    <a href="index.php?page=Advertise_read" class="list-group-item">List</a>
                    <a href="index.php?page=Advertise_create" class="list-group-item">Create</a>        
                  </div>
              </div>
            </div>
          </div> <!-- End of panel -->
      </div>
      <!-- End of End of header part -->
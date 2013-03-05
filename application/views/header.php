<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>聚户外，共同发现户外前沿生活</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link rel='stylesheet' type='text/css' href='<?php echo base_url() ?>css/bootstrap.css' />
	<link rel='stylesheet' type='text/css' href='<?php echo base_url() ?>css/bootstrap-responsive.css' />
	<script type="text/javascript" src="<?php echo base_url() ?>js/jquery-1.6.2.min.js"></script>
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    
  </head>
    <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="<?php echo site_url('')?>">聚户外</a>
          <div class="nav-collapse collapse">
		  <?php if($this->dx_auth->is_logged_in()== False){?>
		  
            <p class="navbar-text pull-right">
              <a href="<?php echo site_url('open/weibo')?>" class="navbar-link">微博登陆</a>
			  
            </p>
			<?php }else {?>
			<p class="navbar-text pull-right">
			<img src="<?php echo $this->m_open->gowi()->avatar_large;?>" style="height:24px;">
              <a href="#" class="navbar-link"><?php echo $this->m_open->gowi()->screen_name?></a>
			  <a href="<?php echo site_url('auth/logout')?>" class="navbar-link">退出</a>
            </p>
			<?php }?>
			
            <ul class="nav">
              <li ><a href="<?php echo site_url('')?>">首页</a></li>
              <li><a href="<?php echo site_url('news/submit')?>">+链接</a></li>
              <li><a href="<?php echo site_url('c_site/contact')?>">联系我</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
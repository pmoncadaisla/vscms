<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title><?php echo TITLE; echo (defined('PAGE_TITLE'))?' - ' . PAGE_TITLE:''; ?></title>
<link rel="stylesheet" type="text/css" href="css/main.css" media="all" />
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

</head>
<body>


	<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#"><?php echo TITLE; ?></a>
        </div>
      </div>
    </div>
	<div class="container" id="container">
	<div id="main-menu">
		<div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Men&uacute;</li>
              <li><a href="index.php" title="Manager Home"><i class="icon-home"></i>Inicio</a></li>
              <li><a href="authors.php" title="Manage Authors"><i class="icon-user"></i>Autores</a></li>
              <li><a href="posts.php" title="Manage Posts"><i class="icon-file"></i>Entradas</a></li>
              <li><a href="categories.php" title="Manage Posts"><i class="icon-folder-open"></i>Categor&iacute;as</a></li>
			  <li class="nav-header">Otros</li>
              <li><a href="../" title="View Blog" class="last">Ver Blog</a></li>
            </ul>
          </div><!--/.well -->
	</div>
	<div class="span3">
          
        </div>
	
	<div id="content">
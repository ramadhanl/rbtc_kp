<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<title>RBTC Tools</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<script type='text/javascript' src='//code.jquery.com/jquery-1.9.1.js'></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,300italic,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Ubuntu:400,400italic,600,600italic' rel='stylesheet' type='text/css'>
	<link href='<?php echo base_url(); ?>static/css/rbtc.css' rel='stylesheet' type='text/css'>
	<link href='<?php echo base_url(); ?>static/css/kp.css' rel='stylesheet' type='text/css'>
</head>
<body style="padding-top: 20px;">
	<div class="container">
			<div class="top_box"></div>
			<h1 class="title text-center">RBTC Tools</h1>
			<nav style="margin-top:60px;"  class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li><a href="<?php echo base_url(); ?>">Beranda</a></li>
							<li><a href="<?php echo site_url('anotasi') ?>">Anotasi</a></li>
							<li><a href="<?php echo site_url('TA') ?>">TA / Thesis</a></li>
							<li><a href="<?php echo site_url('KP') ?>">Kerja Praktik</a></li>
						</ul>
					</div>
				</div>
			</nav>
			<div class="row">
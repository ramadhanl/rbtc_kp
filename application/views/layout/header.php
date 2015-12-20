<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
<title>Qonimax</title>
<link href="<?php echo base_url(); ?>static/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo base_url(); ?>static/css/qonimax.css" rel='stylesheet' type='text/css' />
<link href="<?php echo base_url(); ?>static/css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="<?php echo base_url(); ?>static/css/style.css" rel="stylesheet" type="text/css" media="all" />
<script src="<?php echo base_url(); ?>static/js/jquery.min.js"></script>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
  
</head>
<body>
	<div class="full">
			<div class="menu">
				<ul><?php if($this->session->userdata('privilege') && $this->session->userdata('privilege')=='pegawai'){?>
					<li><a <?php if($display=='displayvoucher') echo "class='active'";?> href="<?php echo base_url(); ?>menu/display_voucher"><div class="video"><i class="videos"></i><i class="videos1"></i></div></a></li>
					<li><a <?php if($display=='tambahfilm') echo "class='active'";?> href="<?php echo base_url(); ?>menu/tambahfilm"><div class="cat"><i class="watching"></i><i class="watching1"></i></div></a></li>

					<?php }else{ ?>
					<li><a <?php if($display=='home') echo "class='active'";?> href="<?php echo base_url(); ?>"><div class="hm"><i class="home1"></i><i class="home2"></i></div></a></li>
					<li><a <?php if($display=='nowplaying') echo "class='active'";?> href="<?php echo base_url(); ?>menu/nowplaying"><div class="video"><i class="videos"></i><i class="videos1"></i></div></a></li>
					<li><a <?php if($display=='comingsoon') echo "class='active'";?> href="<?php echo base_url(); ?>menu/comingsoon"><div class="cat"><i class="watching"></i><i class="watching1"></i></div></a></li>
					<?php if($this->session->userdata('name')){?>
					<li><a <?php if($display=='saldo') echo "class='active'";?> href="<?php echo base_url(); ?>menu/saldo"><div class="bk"><i class="booking"></i><i class="booking1"></i></div></a></li>
					<li><a <?php if($display=='transaksi') echo "class='active'";?> href="<?php echo base_url(); ?>menu/transaksi"><div class="bk"><i class="booking"></i><i class="booking1"></i></div></a></li>
					<?php }}?>
				</ul>
			</div>
		<div class="main">
		<?php if($display=='home'){?>
		<div class="header" >
		<?php }?>
		<?php if($display=='nowplaying'){?>
		<div class="review-content">
		<?php }?>
			<div class="top-header">
				<div class="logo">
					<a href="index.html"><img src="<?php echo base_url(); ?>static/images/logo.png" alt="" /></a>
					<p>Qonimax</p>
				</div>
				<div class="login-box">
				<?php if($this->session->userdata('name')){?>
					<p>Hai, <?php echo $this->session->userdata('name'); ?> 
					<a style="border: solid black 2px; padding : 5px; font-size:16px;" href="<?php echo base_url()?>menu/logout">Logout</a>
					</p>
				<?php }if(!$this->session->userdata('name')){?>
					<form action="<?php echo base_url(); ?>menu/login" method="POST">
						<input name="username" type="text">
						<input name="password" type="password">
						<input type="submit" value="Sign in">
					</form>
				<?php }?>
				</div>
				<div class="clearfix"></div>
			</div>
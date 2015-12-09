<div class="error-404 text-center">
	<?php if($data['status_beli']==1){?>
	<h2 style="font-size:63px;">No voucher anda</h2>
	<p style="margin-top : 50px;margin-bottom:50px;font-size:55px;"><?php echo $data['voucher']->no_voucher;?></p>
	<a class="b-home" href="<?php echo base_url();?>menu/display_voucher">Selesai</a>
	<?php
	}else{ ?>

	<h2 style="font-size:63px;">Beli Voucher</h2>
	<form action="<?php echo base_url();?>menu/beli_voucher" method="POST">
	<input name="harga" style="width: 302px;height:55px;font-size:26px;text-align:center;display:inline-block;color: #b3b3b3;padding: 5px;border: solid #b3b3b3 1px;" type="text" placeholder="Masukkan harga"><br>
		<input style="width: 302px;" class="b-home" type="submit" value="Beli">
	</form>
	<?php } ?>
</div>
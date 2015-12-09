<div class="error-404 text-center">
	<h2 style="font-size:63px;">Isi saldo</h2>
	<form action="<?php echo base_url();?>menu/isi_saldo" method="POST">
	<input name="no_voucher" style="width: 302px;height:55px;font-size:26px;text-align:center;display:inline-block;color: #b3b3b3;padding: 5px;border: solid #b3b3b3 1px;" type="text" placeholder="no token"><br>
	<?php if($data && $data['status']==1){?>
	<p style="font-size:18px;margin-top:10px;margin-bottom:-5px;color:blue;">Saldo berhasil ditambahkan</p>
	<?php }if($data && $data['status']==0){?>
	<p style="font-size:18px;margin-top:10px;margin-bottom:-5px;color:red;">Voucher sudah tidak berlaku</p>
	<?php }?>
	<input style="width: 302px;" class="b-home" type="submit" value="Proses">
	</form>
	<p style="margin-top:20px;font-size:17px;color:#b3b3b3;">Saldo anda sekarang : Rp <?php echo number_format($this->session->userdata('saldo'),2,',','.');?></p>
</div>
<?php var_dump($data['status']);
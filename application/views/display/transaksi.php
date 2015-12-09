<h3 style="text-align:center;">
	TransaksiKU
</h3>
<?php
foreach ($data['transaksi'] as $key => $value) {
?>
<!-- <div style="margin-left: 30px;border :solid black 2px;padding: 5px;margin-bottom:10px;">
	<h4 style="text-align:center;"><?php echo $value->judul_film;?></h4>
	<p>Jam tayang : <?php echo $value->jam_tayang;?></p>
	<p>Teater : <?php echo $value->teater;?></p>
	<p>No kursi : <?php echo $value->no_kursi;?></p>
	<p>Kode transaksi : <?php echo $value->kode_transaksi;?></p>

</div> -->

<div class="col-md-4 mb" style="margin-top:30px;color:black;">
	<div class="white-panel pn">
		<div class="white-header">
			<h5><?php echo $value->judul_film;?></h5>
		</div>
		<p><b><?php echo date('D, d F Y')?></b></p>
		<p>Kode transaksi : <b><?php echo $value->kode_transaksi;?></b></p>
		<p>Jam tayang : <b><?php echo $value->jam_tayang;?></b></p>

		<div class="row">
			<div class="col-md-6">
				<p>No kursi</p>
				<p style="font-size:25px;"><?php echo $value->no_kursi;?></p>
			</div>
			<div class="col-md-6">
				<p>Teater</p>
				<p style="font-size:25px;"><?php echo $value->teater;?></p>
			</div>
		</div>
	</div>
</div>
<?php
}
?>
<div class="clearfix"></div>
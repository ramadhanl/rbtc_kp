<div class="error-404 text-center">
	<?php if($data['sukses'] && $data['sukses']=1){?>
	<h2 style="font-size:63px;">Tambah Film</h2>
	<p>Film berhasil ditambahkan</p>
	<a style="margin-bottom :60px;width: 302px;" class="b-home"  href="<?php echo base_url();?>menu/tambahfilm">Selesai</a>
	<?php }else if($data['sukses'] && $data['sukses']=0){?>
	<h2 style="font-size:63px;">Tambah Film</h2>
	<p>Film gagal ditambahkan</p>
	<a style="margin-bottom :60px;width: 302px;" class="b-home"  href="<?php echo base_url();?>menu/tambahfilm">Coba lagi</a>
	<?php }else{ ?>
	<h2 style="font-size:63px;">Tambah Film</h2>
	<form action="<?php echo base_url();?>menu/proses_tambahfilm" method="POST" enctype="multipart/form-data">
		<label for="msg">Judul film:</label><br>
		<input name="judul_film" style="margin-bottom :20px;width: 302px;height:50px;font-size:20px;text-align:center;display:inline-block;color: #b3b3b3;padding: 5px;border: solid #b3b3b3 1px;" type="text" placeholder="Judul film"><br>
		<label for="msg">Sinopsis:</label><br>
        	<textarea id="msg" style="margin-bottom: 20px;width: 700px;height:80px;font-size:26px;"></textarea>
		<br><label for="msg">Durasi (menit):</label><br>
		<input name="judul_film" style="margin-bottom :20px;width: 302px;height:50px;font-size:20px;text-align:center;display:inline-block;color: #b3b3b3;padding: 5px;border: solid #b3b3b3 1px;" type="text" placeholder="Durasi (menit)"><br>
		<label for="msg">Kategori:</label><br>
		<input name="judul_film" style="margin-bottom :20px;width: 302px;height:50px;font-size:20px;text-align:center;display:inline-block;color: #b3b3b3;padding: 5px;border: solid #b3b3b3 1px;" type="text" placeholder="Kategori"><br>
		<label for="msg">Tanggal awal tayang:</label><br>
		<input name="awal_tayang" style="margin-bottom :20px;width: 302px;height:50px;font-size:20px;text-align:center;display:inline-block;color: #b3b3b3;padding: 5px;border: solid #b3b3b3 1px;" type="date"><br>
		<label for="msg">Tanggal akhir tayang:</label><br>
		<input name="akhir_tayang" style="margin-bottom :20px;width: 302px;height:50px;font-size:20px;text-align:center;display:inline-block;color: #b3b3b3;padding: 5px;border: solid #b3b3b3 1px;" type="date"><br>
		<label for="msg">Pilih cover:</label><br>
		<input name="userfile" style="margin-bottom :20px;height:50px;font-size:20px;text-align:center;display:inline-block;color: #b3b3b3;" type="file"><br>

		<input style="margin-bottom :60px;width: 302px;" class="b-home" type="submit" value="Tambahkan">
	</form>
	<?php }?>
</div>
<div class="col-md-3" style="height:541px;background:none;">
	<?php 
	if(isset($query) || isset($taglist))
		echo '<div style="overflow: auto;height:670px;">';
	else
		echo '<div style="overflow: auto;height:543px;">';
	$limit=20;
	$total_display=6;
	$tahun_mulai=$tags['tags'][$limit*$total_display]->tahun-($total_display-1);
	$tahun_selesai=$tags['tags'][$limit*$total_display]->tahun;
	for ($x=$tahun_selesai;$x>=$tahun_mulai; $x--) { 
	?>
	<div class="panel-group" role="tablist">
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" style="text-align:center;">
				<h4 class="panel-title">
					<a class="collapsed" role="button" data-toggle="collapse" href="#collapseListGroup<?php echo $x;?>" aria-expanded="false" aria-controls="collapseListGroup1">
					<?php 
					if($x==$tahun_selesai)
						echo "Popular tags of all time";
					else
						echo "Popular tags in ".$x;
						?>
					</a>
				</h4>
			</div>
			<div id="collapseListGroup<?php echo $x;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseListGroupHeading1">
				<ul class="list-group">
				<li class="list-group-item" style="text-align:center">
				<?php 
					$y=$x;$z=$x;
					if ($x==$tahun_selesai){
						$y=9999;$z='all';
					}
					foreach ($tags['tags'] as $value) {
						if($value->tahun==$y)
							echo '<a style="font-size:30px;" class="pop-tag" href="'.base_url().'KP/tag/'.$value->tags.'_'.$z.'" style="font-size:16px;">#'.$value->tags.'&nbsp</a> ';
					}
				?>
				</li>
				</ul>
			</div>
		</div>
	</div>
	<?php }?>
	</div>
</div>
<div class="col-md-9">
	
	<div class="search v-search">
		<form action="<?php echo base_url();?>KP/search" method="POST">
			<input name="searchbox" type="text" value="Search.." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search..';}"/>
			<input type="submit" value="">
		</form>
	</div>
	<?php if(isset($query)){ ?>
	<p style="font-size:19px;margin-top:60px;">Hasil pencarian dengan kata kunci : <b><i><?php echo $query;?></i></b></p>
	<p style="font-size:15px;margin-top:7px;margin-bottom:20px;">Didapatkan <?php echo $total; ?> data laporan kerja praktek yang sesuai (<?php echo number_format($totaltime,2);?> detik)</p>
	<?php if($total>0){ ?>
	<div style="overflow: auto;height:530px;">
	<?php 
		$flag=0;
			foreach ($search_results as $key => $value) {
				if($value['judul'] != NULL){
					echo '<div style="margin-bottom:0px;background-color:';
					if($flag++%2==0)
						echo '#F1F1F1;';
					else 
						echo '#EBEBEB;';
					echo 	'padding: 5px 15px;">
							<a class="judul" href="http://rbtc.if.its.ac.id/v3/index.php?p=show_detail&id='.$value['id_doc'].'" target="_blank"><p style="font-size:23px;color:#00A6CC;">'.ucwords(strtolower($value['judul'])).'</p></a>
							<p style="font-size:16px;color: #34A853;margin-top:-10px;">Penulis : '.$value['penulis'].'</p>
							<p style="font-size:16px;color: #34A853;margin-top:-10px;";>Tahun : '.$value['tahun'].'</p>';
					echo '<p style="font-size:16px;color: #34A853;margin-top:-10px;";margin-bottom:90px;>Tags : ';
					$tag = explode("_", $value['tags']);
					foreach ($tag as $key) {
						echo '<a class="pop-tag" href="'.base_url().'KP/tag/'.$key.'_all">#'.$key."</a>";
					}
					echo '</p></div>';
				}
			}
		?>
	</div>
	<?php }}?>
	<?php if(isset($taglist)){ ?>
	<p style="font-size:19px;margin-top:60px;">Laporan buku kerja praktek dengan tag <b><i><?php echo $selected_tag;?></i></b><?php if($tag_tahun==9999) echo " di semua data"; else echo " di tahun ".$tag_tahun;?></p>
	<p style="font-size:15px;margin-top:7px;margin-bottom:20px;">Didapatkan <?php echo count($taglist); ?> data laporan kerja praktek</p>
	<div class="search-results" style="overflow: auto;height:530px;">
	<?php 
		$flag=0;
		// foreach ($taglist as $value) {
		// echo $value->id_doc;}
			foreach ($taglist as $value) {
				if($value->judul != NULL){
					echo '<div style="margin-bottom:0px;background-color:';
					if($flag++%2==0)
						echo '#F1F1F1;';
					else 
						echo '#EBEBEB;';
					echo 	'padding: 5px 15px;">
							<a class="judul" href="http://rbtc.if.its.ac.id/v3/index.php?p=show_detail&id='.$value->id_doc.'" target="_blank"><p style="font-size:23px;color:#00A6CC;">'.ucwords(strtolower($value->judul)).'</p></a>
							<p style="font-size:16px;color: #34A853;margin-top:-10px;">Penulis : '.$value->penulis.'</p>
							<p style="font-size:16px;color: #34A853;margin-top:-10px;";>Tahun : '.$value->tahun.'</p>';
					echo '<p style="font-size:16px;color: #34A853;margin-top:-10px;";margin-bottom:90px;>Tags : ';
					$tag = explode("_", $value->tags);
					foreach ($tag as $key) {
						echo '<a class="pop-tag" href="'.base_url().'KP/tag/'.$key.'_all">#'.$key." </a>";
					}
					echo '</p></div>';
				}
			}
		?>
	<?php }?>
</div></div></div></div>
<div style="">
<div><div>
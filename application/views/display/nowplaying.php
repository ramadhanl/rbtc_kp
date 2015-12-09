<div class="reviews-section">
	<h3 class="head">Now Playing</h3>
	
	<?php 
	foreach ($data['nowplaying'] as $key => $value) {
	?>
	<div style="margin-top:50px;margin-bottom:550px;">
		<div class="col-md-3" style="padding-left:0px;">
			<a href="#"><img style="width:100%;" src="<?php echo base_url(); ?>static/images/film/<?php echo $value->judul;?>.jpg" alt="" /></a>
		</div>
		<div class="col-md-5" style="padding-left:0px;">
			<a class="span" href="#"><?php echo $value->judul;?></a>
			<!-- <p class="dirctr">Keterangan</p>								 -->
			<p>Rating: <?php echo $value->rating;?>/10 (from <?php echo count($data['reviews'][$value->id_film]);?> users)</p>
			<div class="clearfix"></div>
			<div style="display:inline-block;">
				<h4>Sinopsis : </h4>
				<p><?php echo $value->sinopsis;?></p>
					<div class="clearfix"></div>
				<!-- <a class="book" href="#" style="text-align:center;border-bottom: 0px;display:block;height:50px;;width:205px;"><i class="book1"></i>BOOK TICKET</a> -->
				<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal<?php echo $value->id_film; ?>">Beli tiket</button>
				<!-- Modal pilih jadwal-->
				<div class="modal fade" id="myModal<?php echo $value->id_film; ?>" role="dialog">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h3 style="text-align:center;" class="modal-title"><?php echo $value->judul;?></h3>
							</div>
							<div class="modal-body">
							<p>Pilih jadwal : </p>
							<?php 
							foreach ($data['jadwal'][$value->id_film] as $key2 => $value2) {
								echo '<button style="margin-left:10px;text-decoration:none;" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#kursi'.$value2->id_jadwal.'">'.$value2->jam_mulai.'</button>';
							}?>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php 
			foreach ($data['jadwal'][$value->id_film] as $key2 => $value2) {
		?>
		<!-- Modal pilih jadwal-->
		<div class="modal fade" id="kursi<?php echo $value2->id_jadwal;?>" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3 style="text-align:center;" class="modal-title">Pilih nomor kursi</h3>
					</div>
					<div class="modal-body">
						<p style="font-size:17px;">Pilih kursi : </p>
						<form action="<?php echo base_url();?>menu/beli_tiket" method="POST">
							<input name="id_jadwal" type="hidden" value="<?php echo $value2->id_jadwal;?>">
							<select name="no_kursi" style="width:200px;height:50px;font-size:26px;">
							<?php 
							foreach ($data['kursi'][$value2->id_jadwal] as $key3 => $value3) {
								echo '<option value="'.$value3->no_kursi.'">'.$value3->no_kursi.'</option>';
							}?>
							</select>
							<input style="height:50px;margin-top:-100px;" class="b-home" type="submit" value="Beli">
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>


		<?php }?>
		<div class="col-md-4" style="padding-left:0px;padding-right:0px;">
			<h1>User Reviews</h1>
			<div style=" max-height:500px;height:auto !important;overflow:auto;height:330px;width:100%;padding:10px;">
			<?php 
				$reviewed=0;
				foreach ($data['reviews'][$value->id_film] as $key2 => $value2) {
					if ($value2->user==$this->session->userdata('username'))
						$reviewed=1;
			?>
				<div class="comments">
					<h4 style="font-size:20px;color:#4786A9;"><?php echo $value2->user;?></h4>
					<p><?php echo $value2->tanggal_review;?></p>
					<div style="display:block; margin-left:-10px;">
						<div class="rating c-rating">
						<?php 
						for ($i=$value2->rating+1; $i<=10 ; $i++) { 
							echo '<span>☆</span>';
						}
						
						for($i=1;$i<=$value2->rating;$i++){
							echo '<span style="color:#f9dd04;">☆</span>';
						}
						?>
						</div> 	
						<p class="ratingview c-rating"> &nbsp;<?php echo $value2->rating;?>/10</p><br><br>
						<p style="display:block; margin-left:20px;"><?php echo $value2->review;?></p>
					</div>
				</div>
				<?php }?>
			</div>
			<?php 
				if($reviewed!=1){
			?>
			<div class="post-comment">
				<form action="<?php echo base_url();?>menu/add_rating" method="POST">
					<input name="id_film" type="hidden" value="<?php echo $value->id_film;?>">
					<select name="rating">
						<option value="0">Your rating</option>	
						<option value="1">1.Poor</option>
						<option value="2">2.(Below average)</option>
						<option value="3">3.Average</option>
						<option value="4">4.(Above average)</option>
						<option value="5">5.Watchable</option>
						<option value="6">6(Good)</option>
						<option value="7">7.(Very good)</option>
						<option value="8">8.Outstanding</option>
						<option value="9">9.(Legend!)</option>
						<option value="10">10.(Perfect!!)</option>
					</select>
					<textarea style="display:block;" name="review" style="display:block;"></textarea>
					<input type="submit" value="Submit">
				</form>
			</div>
			<?php }
			else{?>
				<div class="post-comment" style="height:60px;">
				</div>
			<?php }?>
		</div>
	</div>
<?php }?>


</div>
		<div class="clearfix"></div>
		<div class="review-slider" style="margin-top:120px;">
			<ul id="flexiselDemo1">
				<li><img src="<?php echo base_url(); ?>static/images/r1.jpg" alt=""/></li>
				<li><img src="<?php echo base_url(); ?>static/images/r2.jpg" alt=""/></li>
				<li><img src="<?php echo base_url(); ?>static/images/r3.jpg" alt=""/></li>
				<li><img src="<?php echo base_url(); ?>static/images/r4.jpg" alt=""/></li>
				<li><img src="<?php echo base_url(); ?>static/images/r5.jpg" alt=""/></li>
				<li><img src="<?php echo base_url(); ?>static/images/r6.jpg" alt=""/></li>
			</ul>
			<script type="text/javascript">
				$(window).load(function() {

					$("#flexiselDemo1").flexisel({
						visibleItems: 6,
						animationSpeed: 1000,
						autoPlay: true,
						autoPlaySpeed: 3000,    		
						pauseOnHover: false,
						enableResponsiveBreakpoints: true,
						responsiveBreakpoints: { 
							portrait: { 
								changePoint:480,
								visibleItems: 2
							}, 
							landscape: { 
								changePoint:640,
								visibleItems: 3
							},
							tablet: { 
								changePoint:768,
								visibleItems: 3
							}
						}
					});
				});
			</script>
			<script type="text/javascript" src="<?php echo base_url(); ?>static/js/jquery.flexisel.js"></script>	
		</div>
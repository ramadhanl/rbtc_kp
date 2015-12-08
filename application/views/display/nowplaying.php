<div class="reviews-section">
	<h3 class="head">Now Playing</h3>
	
	<?php 
	foreach ($data['nowplaying'] as $key => $value) {
	?>
	<div style="margin-top:40px;margin-top:40px;">
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
								echo '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#kursi'.$value2->id_jadwal.'">'.$value2->jam_mulai.'</button>';
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
						<p>Pilih kursi : </p>
						<form>
							<select name="no_kursi">
							<?php 
							foreach ($data['kursi'][$value2->id_jadwal] as $key3 => $value3) {
								echo '<option value="'.$value3->no_kursi.'">'.$value3->no_kursi.'</option>';
							}?>
							</select>
							<input type="submit" value="Beli">
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
			<div style="overflow:auto;height:330px;width:100%;">
			<?php 
				foreach ($data['reviews'][$value->id_film] as $key2 => $value2) {
			?>
				<div class="comments">
					<h4><?php echo $value2->user;?></h4>
					<p><?php echo $value2->tanggal_review;?></p>
					<div style="display:block; margin-left:-10px;">
						<div class="rating c-rating">
							<span>☆</span>
							<span>☆</span>
							<span>☆</span>
							<span>☆</span>
							<span>☆</span>
							<span>☆</span>
							<span>☆</span>
							<span>☆</span>
							<span>☆</span>
							<span>☆</span>
						</div> 	
						<p class="ratingview c-rating"> &nbsp;<?php echo $value2->rating;?>/10</p><br><br>
						<p><?php echo $value2->review;?></p>
					</div>
				</div>
				<?php }?>
			</div>
			<div class="post-comment">
				<form>
					<select name="rating">
						<option value="0">Your rating</option>	
						<option value="1">1.Poor</option>
						<option value="2">1.5(Below average)</option>
						<option value="3">2.Average</option>
						<option value="4">2.5(Above average)</option>
						<option value="5">3.Watchable</option>
						<option value="6">3.5(Good)</option>
						<option value="7">4.5(Very good)</option>
						<option value="8">5.Outstanding</option>
					</select>
					<input style="display:block;" type="text" name="comment">
					<input type="submit" value="Submit">
				</form>
			</div>
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
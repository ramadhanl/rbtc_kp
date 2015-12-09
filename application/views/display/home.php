<h2 style="text-align:center;margin-bottom:-20px;color:#DFB636;">Film terlaris minggu ini</h2>
<div>
	<div class="col-md-6">
		<a href="#"><img style="float:right;height:450px;margin-top:57px" src="<?php echo base_url(); ?>static/images/film/<?php echo $data['top_rated'][0]->judul;?>.jpg" alt="" /></a>
	</div>
	<div class="header-info" style="float:left;color:black;">
			<h1 style="color:black;"><?php echo $data['top_rated'][0]->judul;?></h1>
			<p style="color:black;" class="review">Rating	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;  <?php echo $data['top_rated'][0]->rating;?>/10</p>
			<p style="color:black;" class="review">Duration	&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;  <?php echo $data['top_rated'][0]->durasi;?></p>
			<p style="color:black;" class="review reviewgo">Genre	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp; <?php echo $data['top_rated'][0]->kategori;?></p>
			<p style="color:black;" class="review">Release &nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp; <?php echo $data['top_rated'][0]->awal_tayang;?></p>
			<p style="color:black;" class="special"><?php echo $data['top_rated'][0]->sinopsis;?></p>
			<a style="color:black;" class="book" href="<?php echo base_url();?>menu/nowplaying"><i class="book1"></i>BOOK TICKET</a>
		</div>

</div>

		</div>
		<div class="review-slider">
			<ul id="flexiselDemo1">
			 <?php foreach ($data['nowplaying'] as $key => $value) {?>
				<li><img src="<?php echo base_url(); ?>static/images/film/<?php echo $value->judul;?>.jpg" alt=""/></li>
			<?php }?>
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
						visibleItems: 4
					}
				}
			});
			});
		</script>
		<script type="text/javascript" src="<?php echo base_url(); ?>static/js/jquery.flexisel.js"></script>	
		</div>
		<div class="video">
			<iframe  src="https://www.youtube.com/embed/uVdV-lxRPFo" frameborder="0" allowfullscreen></iframe>
		</div>
		<div class="more-reviews">
			<ul id="flexiselDemo2">
				<?php foreach ($data['daftar_film'] as $key => $value) {?>
					<li><img src="<?php echo base_url(); ?>static/images/film/<?php echo $value->judul;?>.jpg" alt=""/></li>
				<?php }?>
			</ul>
			<script type="text/javascript">
		$(window).load(function() {
			
		  $("#flexiselDemo2").flexisel({
				visibleItems: 4,
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
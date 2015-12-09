<div class="header-info">
				<h1><?php echo $data['top_rated'][0]->judul;?></h1>
				<p class="review">Rating	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;  <?php echo $data['top_rated'][0]->rating;?>/10</p>
				<p class="review">Duration	&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;  <?php echo $data['top_rated'][0]->durasi;?></p>
				<p class="review reviewgo">Genre	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp; <?php echo $data['top_rated'][0]->kategori;?></p>
				<p class="review">Release &nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp; <?php echo $data['top_rated'][0]->awal_tayang;?></p>
				<p class="special"><?php echo $data['top_rated'][0]->sinopsis;?></p>
				<a class="book" href="<?php echo base_url();?>menu/nowplaying""><i class="book1"></i>BOOK TICKET</a>
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
		<div class="news">
			<div class="col-md-6 news-left-grid">
				<h3>Don’t be late,</h3>
				<h2>Book your ticket now!</h2>
				<h4>Easy, simple & fast.</h4>
				<a href="#"><i class="book"></i>BOOK TICKET</a>
				<p>Get Discount up to <strong>10%</strong> if you are a member!</p>
			</div>
			<div class="col-md-6 news-right-grid">
				<h3>News</h3>
				<div class="news-grid">
					<h5>Lorem Ipsum Dolor Sit Amet</h5>
					<label>Nov 11 2014</label>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.</p>
				</div>
				<div class="news-grid">
					<h5>Lorem Ipsum Dolor Sit Amet</h5>
					<label>Nov 11 2014</label>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.</p>
				</div>
				<a class="more" href="#">MORE</a>
			</div>
			<div class="clearfix"></div>
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
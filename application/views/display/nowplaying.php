			<div class="reviews-section">
			<h3 class="head">Now Playing</h3>
			<div class="review">
				<div class="movie-pic">
					<a href="#"><img src="<?php echo base_url(); ?>static/images/r4.jpg" alt="" /></a>
				</div>
			<div class="col-md-6">
				<div class="review-info">
					<a class="span" href="single.html">Judul</a>
					<p class="dirctr">Keterangan</p>								
					<p class="ratingview c-rating">Rating:</p>
					<div class="rating c-rating">
						<span>☆</span>
						<span>☆</span>
						<span>☆</span>
						<span>☆</span>
						<span>☆</span>
					</div> 	
					<p class="ratingview c-rating"> &nbsp; 3.3/5</p><br>
					
					<div class="clearfix"></div>
					<div class="yrw">
						<div class="dropdown-button">           			
							<select class="dropdown" tabindex="9" data-settings='{"wrapperClass":"flat"}'>
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
						</div>
					</div>
					<div style="display:inline-block;">
						<h4>Sinopsis : </h4>
						<p>Apa jadinya jika asteroid yang pernah menabrak bumi dan memusnahkan dinosaurus tidak jadi menabrak bumi dan Dinosaurus tidak pernah punah?
							Dalam sebuah perjalanan epik ke dunia Dinosaurus, Arlo, dari jenis Apatosaurus, Dinosaurus yang baik berteman dengan manusia. Keduanya berpetualang ke sebuah daerah yang misterius, belajar menghadapi ketakutan dan mengetahui kemampuan yang dimilikinya.</p>
							<div class="clearfix"></div>
					</div>
					<a class="book" href="#" style="text-align:center;border-bottom: 0px;display:block;height:50px;;width:205px;"><i class="book1"></i>BOOK TICKET</a>
				</div>
				</div>
				<div class="col-md-6">
					<h1>Ninja Warriors</h1>
					<div style="overflow:auto;height:275px;width:330px;">
						<div style="display:inline-block;">
							<h4>Sinopsis : </h4>
							<p>Apa jadinya jika asteroid yang pernah menabrak bumi dan memusnahkan dinosaurus tidak jadi menabrak bumi dan Dinosaurus tidak pernah punah?
								Dalam sebuah perjalanan epik ke dunia Dinosaurus, Arlo, dari jenis Apatosaurus, Dinosaurus yang baik berteman dengan manusia. Keduanya berpetualang ke sebuah daerah yang misterius, belajar menghadapi ketakutan dan mengetahui kemampuan yang dimilikinya.</p>
								<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>
		<div class="review-slider">
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
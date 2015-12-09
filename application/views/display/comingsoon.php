<div class="reviews-section">
	<h3 class="head">Coming Soon</h3>
	
	<?php 
	foreach ($data['comingsoon'] as $key => $value) {
	?>
	<div style="margin-top:40px;margin-top:40px;">
		<div class="col-md-3" style="padding-left:0px;">
			<a href="#"><img style="width:100%;" src="<?php echo base_url(); ?>static/images/film/<?php echo $value->judul;?>.jpg" alt="" /></a>
		</div>
		<div class="col-md-9" style="padding-left:0px;">
			<a class="span" href="#"><?php echo $value->judul;?></a>
			<div style="display:inline-block;">
				<h4>Sinopsis : </h4>
				<p><?php echo $value->sinopsis;?></p>
					<div class="clearfix"></div>
				<a class="book" href="#" style="text-align:center;border-bottom: 0px;display:block;height:50px;;width:205px;"><i class="book1"></i>BOOK TICKET</a>
			</div>
		</div>
	</div>
<?php }?>


</div>
		<div class="clearfix"></div>
		<div class="review-slider" style="margin-top:120px;">
			<ul id="flexiselDemo1">
			<?php foreach ($data['comingsoon'] as $key => $value) {?>
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
								visibleItems: 3
							}
						}
					});
				});
			</script>
			<script type="text/javascript" src="<?php echo base_url(); ?>static/js/jquery.flexisel.js"></script>	
		</div>
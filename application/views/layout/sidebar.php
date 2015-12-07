				<div class="col-md-3">
					<div class="panel-group" role="tablist">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="collapseListGroupHeading1">
								<h4 class="panel-title">
									<a class="collapsed" role="button" data-toggle="collapse" href="#collapseListGroup1" aria-expanded="false" aria-controls="collapseListGroup1">
									<?php echo $sidebar['name']; ?>
									</a>
								</h4>
							</div>
							<div id="collapseListGroup1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseListGroupHeading1">
							<ul class="list-group">
								<?php 
								$section = $this->uri->segment(1);
								$detail_url = $sidebar['detail_url'];
								foreach ($sidebar['list'] as $key => $value) { ?>
									<li class="list-group-item"><a href="<?php echo site_url("$section/$detail_url/$key"); ?>"><?php echo $value; ?></a></li>
								<?php }
								?>
							</ul>
							</div>
						</div>
					</div>
				</div>
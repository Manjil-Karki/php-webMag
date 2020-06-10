<?php
	$header = 'index';
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	include "inc/header.php";
?>

		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">	
				<?php
					$blogs = $Blog->getMostReadFeaturedBlogsWithLimit(0, 2);
					if($blogs){
						foreach($blogs as $key => $blog){
							if(isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH.'blog/'.$blog->image)){
								$thumbnail = UPLOAD_URL.'blog/'.$blog->image;
							}else{
								$thumbnail = UPLOAD_URL.'noimage.png';
							}
				?>

						<!-- post -->
						<div class="col-md-6">
							<div class="post post-thumb">
								<a class="post-img" href="blog-post?id=<?php echo $blog->id?>"><img src="<?php echo $thumbnail?>" alt=""></a>
								<div class="post-body">
									<div class="post-meta">
										<a class="post-category <?php echo CAT_COLOR[$blog->categoryid%4]?>" href="category?id=<?php echo $blog->categoryid?>"><?php echo $blog->category?></a>
										<span class="post-date"><?php date("M d, Y", strtotime($blog->created_date)) ?></span>
									</div>
									<h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id?>"><?php echo $blog->title?></a></h3>
								</div>
							</div>
						</div>
						<!-- /post -->

				<?php
						}
					}
				?>
				</div>
				<!-- /row -->

				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="section-title">
							<h2>Recent Posts</h2>
						</div>
					</div>
					<?php
						$blogs = $Blog->getMostRecentBlogsWithLimit(0, 13);
						//debugger($blogs);
						if($blogs){
							foreach ($blogs as $key => $blog) {						
								if(isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH.'blog/'.$blog->image)){
									$thumbnail = UPLOAD_URL.'blog/'.$blog->image;
								}else{
									$thumbnail = UPLOAD_URL.'noimage.png';
								}
								if($key == 3){
					?>
									<div class="clearfix visible-md visible-lg"></div>
					<?php				
								}
								if($key<6){							
					?>
						<!-- post -->
					<div class="col-md-4">
						<div class="post">
							<a class="post-img" href="blog-post?id=<?php echo $blog->id?>"><img src="<?php echo $thumbnail?>" alt=""></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category <?php echo CAT_COLOR[$blog->categoryid%4]?>" href="category?id=<?php echo $blog->categoryid?>"> <?php echo $blog->category?> </a>
									<span class="post-date"><?php echo date("M d, Y", strtotime($blog->created_date))?></span>
								</div>
								<h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id?>"> <?php echo $blog->title?> </a></h3>
							</div>
						</div>
					</div>
					<!-- /post -->
					<?php
								}else if($key == 6){
					?>
									</div>
				<!-- /row -->

				<!-- row -->
				<div class="row">
					<div class="col-md-8">
						<div class="row">
							<!-- post -->
							<div class="col-md-12">
								<div class="post post-thumb">
									<a class="post-img" href="blog-post?id=<?php echo $blog->id?>"><img src="<?php echo $thumbnail?>" alt=""></a>
									<div class="post-body">
										<div class="post-meta">
											<a class="post-category <?php echo CAT_COLOR[$blog->categoryid%4]?>" href="category?id=<?php echo $blog->categoryid?>"><?php echo $blog->category?></a>
											<span class="post-date"><?php echo date("M d, Y", strtotime($blog->created_date))?></span>
										</div>
										<h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id?>"><?php echo $blog->title?></a></h3>
									</div>
								</div>
							</div>
							<!-- /post -->

					<?php
								}else{
									if($key == 9 || $key == 11){
					?>
										<div class="clearfix visible-md visible-lg"></div>
					<?php					
									}
					?>
									<!-- post -->
							<div class="col-md-6">
								<div class="post">
									<a class="post-img" href="blog-post?id=<?php echo $blog->id?>"><img src="<?php echo $thumbnail?>" alt=""></a>
									<div class="post-body">
										<div class="post-meta">
											<a class="post-category <?php echo CAT_COLOR[$blog->categoryid%4]?>" href="category?id=<?php echo $blog->categoryid?>"><?php echo $blog->category?></a>
											<span class="post-date"><?php echo date("M d, Y", strtotime($blog->created_date))?></span>
										</div>
										<h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id?>"><?php echo $blog->title?></a></h3>
									</div>
								</div>
							</div>
							<!-- /post -->

					<?php		
								}
							}
						}
					?>							
						</div>
					</div>

					<div class="col-md-4">
						<!-- post widget -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Most Read</h2>
							</div>
							<?php
								$blogs = $Blog->getMostReadBlogsWithLimit(0,4);
								if($blogs){
									foreach ($blogs as $key => $blog) {
										if(isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH.'blog/'.$blog->image)){
											$thumbnail = UPLOAD_URL.'blog/'.$blog->image;
										}else{
											$thumbnail = UPLOAD_URL.'noimage.png';
										}
							?>
									<div class="post post-widget">
										<a class="post-img" href="blog-post?id=<?php echo $blog->id?>"><img src="<?php echo $thumbnail?>" alt=""></a>
										<div class="post-body">
											<h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id?>"><?php echo $blog->title?></a></h3>
										</div>
									</div>
							<?php
									}
								}
							
							?>
					</div>
						<!-- /post widget -->

						<!-- post widget -->
						<div class="aside-widget">
						
							<div class="section-title">
								<h2>Featured Posts</h2>
							</div>

							<?php
								$blogs = $Blog->getAllFeaturedBlogsWithLimit(0, 5);
								if($blogs){					
									foreach($blogs as $key => $blog){
										if(isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH.'blog/'.$blog->image)){
											$thumbnail = UPLOAD_URL.'blog/'.$blog->image;
										}else{
											$thumbnail = UPLOAD_URL.'noimage.png';
										}if($key<2){
							?>
							<div class="post post-thumb">
								<a class="post-img" href="blog-post?id=<?php echo $blog->id?>"><img src="<?php echo $thumbnail?>" alt=""></a>
								<div class="post-body">
									<div class="post-meta">
										<a class="post-category <?php echo CAT_COLOR[$blog->categoryid%4]?>" href="category?id=<?php echo $blog->categoryid?>"><?php echo $blog->category?></a>
										<span class="post-date"><?php echo date("M d, Y", strtotime($blog->created_date))?></span>
									</div>
									<h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id?>"><?php echo $blog->title?></a></h3>
								</div>
							</div>


							<?php	
										}else if($key >= 2){
											if($key == 2){
							?>
								</div>
						<!-- /post widget -->
						<?php 
							include 'inc/simpleAd.php';
							$thumbnail = UPLOAD_URL.'blog/'.$blog->image;
						?>
						
						
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->
		
		<!-- section -->
		<div class="section section-grey">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="section-title text-center">
							<h2>Featured Posts</h2>
						</div>
					</div>
							<?php
											}
							?>

							<!-- post -->
					<div class="col-md-4">
						<div class="post">
							<a class="post-img" href="blog-post?id=<?php echo $blog->id?>"><img src="<?php echo $thumbnail?>" alt=""></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category <?php echo CAT_COLOR[$blog->categoryid%4]?>" href="category?id=<?php echo $blog->categoryid?>"> <?php echo $blog->category?> </a>
									<span class="post-date"><?php echo date("M d, Y", strtotime($blog->created_date))?></span>
								</div>
								<h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id?>"> <?php echo $blog->title?> </a></h3>
							</div>
						</div>
					</div>
					<!-- /post -->

							<?php
										}			
									}
								}
							?>
					
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->

		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-12">
								<div class="section-title">
									<h2>Most Read</h2>
								</div>
							</div>

							<?php
								$blogs = $Blog->getMostReadBlogsWithLimit(0, 4);
								if($blog){
									foreach($blogs as $key => $blog){
										if(isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH.'blog/'.$blog->image)){
											$thumbnail = UPLOAD_URL.'blog/'.$blog->image;
										}else{
											$thumbnail = UPLOAD_URL.'noimage.png';
										}
							?>


											<!-- post -->
											<div class="col-md-12">
												<div class="post post-row">
													<a class="post-img" href="blog-post?id=<?php echo $blog->id?>"><img src="<?php echo $thumbnail?>" alt=""></a>
													<div class="post-body">
														<div class="post-meta">
															<a class="post-category <?php echo CAT_COLOR[$blog->categoryid%4]?>" href="category?id=<?php echo $blog->categoryid?>"><?php echo $blog->category?></a>
															<span class="post-date"><?php echo date("M d, Y", strtotime($blog->created_date))?></span>
														</div>
														<h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id?>"><?php echo $blog->title?></a></h3>
														<p><?php echo substr(html_entity_decode($blog->content), 0, 100)?>...</p>
													</div>
												</div>
											</div>
											<!-- /post -->

							<?php
									}
								}							
							?>												
							<div class="col-md-12">
								<div class="section-row">
									<button class="primary-button center-block">Load More</button>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<?php include 'inc/simpleAd.php';?>
												
						<?php 
							include 'inc/catTagArc.php';
						?>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->

<?php
	include "inc/footer.php";
?>

<?php
	$header = 'Category';
	$bread = 'Category';
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$cat_id = $_GET['id'];
		if ($cat_id) {
			$Category = new category();
			$category_info = $Category->getCategoryById($cat_id);
			if ($category_info) {
				$category_info = $category_info[0];
				$bread = $category_info->categoryname;
			}else{
				redirect('index');
			}
		}else{
			redirect('index');
		}
	}else{
		redirect('index');
	}
	include 'inc/header.php';

?>
		
		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-8">
						<div class="row">

							<?php
								$Blog = new blogs();
								$featuredBlogs = $Blog->getAllFeaturedBlogsByCategoryWithLimit($cat_id, 0, 3);
								if (isset($featuredBlogs[0]) && !empty($featuredBlogs[0])) {
								?>
									<!-- post -->
									<div class="col-md-12">
										<div class="post post-thumb">
											<?php
												if (isset($featuredBlogs[0]->image) && !empty($featuredBlogs[0]->image) && file_exists(UPLOAD_PATH.'blog/'.$featuredBlogs[0]->image)) {
													$thumbnail = UPLOAD_URL.'blog/'.$featuredBlogs[0]->image;
												}else{
													$thumbnail = UPLOAD_URL.'noimage.png';
												}
											?>
											<a class="post-img" href="blog-post?id=<?php echo $featuredBlogs[0]->id?>"><img src="<?php echo $thumbnail?>" alt=""></a>
											<div class="post-body">
												<div class="post-meta">
													<a class="post-category <?php echo CAT_COLOR[$cat_id%4]?>" href="blog-post?id=<?php echo $featuredBlogs[0]->id?>"><?php echo $bread?></a>
													<span class="post-date"><?php echo date("M d, Y", strtotime($featuredBlogs[0]->created_date))?></span>
												</div>
												<h3 class="post-title"><a href="blog-post?id=<?php echo $featuredBlogs[0]->id?>"><?php echo $featuredBlogs[0]->title?></a></h3>
											</div>
										</div>
									</div>
									<!-- /post -->
								<?php	
								}if(isset($featuredBlogs[1]) && !empty($featuredBlogs[1]) && isset($featuredBlogs[2]) && !empty($featuredBlogs[2])){
								?>
									<!-- post -->
									<div class="col-md-6">
										<div class="post">
										<?php
												if (isset($featuredBlogs[1]->image) && !empty($featuredBlogs[1]->image) && file_exists(UPLOAD_PATH.'blog/'.$featuredBlogs[1]->image)) {
													$thumbnail = UPLOAD_URL.'blog/'.$featuredBlogs[1]->image;
												}else{
													$thumbnail = UPLOAD_URL.'noimage.png';
												}
											?>
											<a class="post-img" href="blog-post?id=<?php echo $featuredBlogs[1]->id?>"><img src="<?php echo $thumbnail?>" alt=""></a>
											<div class="post-body">
												<div class="post-meta">
												<a class="post-category <?php echo CAT_COLOR[$cat_id%4]?>" href="blog-post?id=<?php echo $featuredBlogs[1]->id?>"><?php echo $bread?></a>
													<span class="post-date"><?php echo date("M d, Y", strtotime($featuredBlogs[1]->created_date))?></span>
												</div>
												<h3 class="post-title"><a href="blog-post?id=<?php echo $featuredBlogs[1]->id?>"><?php echo $featuredBlogs[1]->title?></a></h3>
											</div>
										</div>
									</div>
									<!-- /post -->

									<!-- post -->
									<div class="col-md-6">
										<div class="post">
										<?php
												if (isset($featuredBlogs[2]->image) && !empty($featuredBlogs[2]->image) && file_exists(UPLOAD_PATH.'blog/'.$featuredBlogs[2]->image)) {
													$thumbnail = UPLOAD_URL.'blog/'.$featuredBlogs[2]->image;
												}else{
													$thumbnail = UPLOAD_URL.'noimage.png';
												}
											?>
											<a class="post-img" href="blog-post?id=<?php echo $featuredBlogs[2]->id?>"><img src="<?php echo $thumbnail?>" alt=""></a>
											<div class="post-body">
												<div class="post-meta">
												<a class="post-category <?php echo CAT_COLOR[$cat_id%4]?>" href="blog-post?id=<?php echo $featuredBlogs[2]->id?>"><?php echo $bread?></a>
													<span class="post-date"><?php echo date("M d, Y", strtotime($featuredBlogs[2]->created_date))?></span>
												</div>
												<h3 class="post-title"><a href="blog-post?id=<?php echo $featuredBlogs[2]->id?>"><?php echo $featuredBlogs[2]->title?></a></h3>
											</div>
										</div>
									</div>
									<!-- /post -->
							<?php
								}
							?>
							<div class="clearfix visible-md visible-lg"></div>
							
							<!-- ad -->
							<div class="col-md-12">
								<?php include 'inc/wideAd.php'?>
							</div>
							<!-- ad -->
							<?php
								$recentBlog = $Blog->getAllRecentBlogsByCategoryWithLimit($cat_id, 0, 4);
								if(isset($recentBlog) && !empty($recentBlog)){
									foreach($recentBlog as $key => $blog){
										if (isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH.'blog/'.$blog->image)) {
											$thumbnail = UPLOAD_URL.'blog/'.$blog->image;
										}else{
											$thumbnail = UPLOAD_URL.'noimg.jpg';
										}
							?>
									<!-- post -->
									<div class="col-md-12">
										<div class="post post-row">
											<a class="post-img" href="blog-post>id=<?php $blog->id?>"><img src="<?php echo $thumbnail?>" alt=""></a>
											<div class="post-body">
												<div class="post-meta">
													<a class="post-category <?php echo CAT_COLOR[$cat_id%4]?>" href="blog-post>id=<?php $blog->id?>"><?php echo $bread?></a>
													<span class="post-date"><?php echo date("M d, Y", strtotime($blog->created_date))?></span>
												</div>
												<h3 class="post-title"><a  href="blog-post>id=<?php $blog->id?>"><?php echo $blog->title?></a></h3>
												<p><?php echo substr(html_entity_decode($blog->content), 0, 100)?>...<br></p>
												<a href="blog-post?id=<?php echo $blog->id?>">Read More</a>
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
						
						<!-- post widget -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Most Read</h2>
							</div>
							<?php
								$populagBlogs = $Blog->getAllPopulartBlogsByCategoryWithLimit($cat_id, 0, 4);
								if ($populagBlogs) {
									foreach($populagBlogs as $key => $populagBlog){
										if (isset($populagBlog->image) && !empty($populagBlog->image) && pathinfo(UPLOAD_PATH.'blog/'.$populagBlog->image)) {
											$thumbnail = UPLOAD_URL.'blog/'.$populagBlog->image;
										}else{
											$thumbnail = UPLOAD_URL.'noimage.png';
										}
									?>

										<div class="post post-widget">
											<a class="post-img" href="blog-post?id=<?php echo $populagBlog->id?>"><img src="<?php echo $thumbnail?>" alt=""></a>
											<div class="post-body">
												<h3 class="post-title"><a href="blog-post?id=<?php echo $populagBlog->id?>"><?php echo $populagBlog->title?></a></h3>
											</div>
										</div>

									<?php
									}
								}
							?>
							

							
						<!-- /post widget -->
						
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
			include 'inc/footer.php';
		?>

<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	$header = 'Blog-post';
	if(isset($_GET['id']) && !empty($_GET['id'])){
		$blog_id = $_GET['id'];
		if($blog_id){
			$Blog = new blogs();
			$blog_info = $Blog->getBlogById($blog_id);
			if($blog_info){
				$blog_info = $blog_info[0];
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
					<!-- Post content -->
					<div class="col-md-8">
						<div class="section-row sticky-container">
							<div class="main-post">
								<?php echo html_entity_decode($blog_info->content)?>
							</div>
							<div class="post-shares sticky-shares">
								<a href="#" class="share-facebook"><i class="fa fa-facebook"></i></a>
								<a href="#" class="share-twitter"><i class="fa fa-twitter"></i></a>
								<a href="#" class="share-google-plus"><i class="fa fa-google-plus"></i></a>
								<a href="#" class="share-pinterest"><i class="fa fa-pinterest"></i></a>
								<a href="#" class="share-linkedin"><i class="fa fa-linkedin"></i></a>
								<a href="#"><i class="fa fa-envelope"></i></a>
							</div>
						</div>

						<!-- ad -->
						<?php include 'inc/wideAd.php'?>
						<!-- ad -->
						
						<!-- comments -->
						<div class="section-row">
							<div class="section-title">
								<h2>
								<?php
									$Comment = new comment();
									$count = $Comment->getNumberOfCommentsByBlog($blog_id);
									echo($count[0]->total);
			
								?>
								Comments
								</h2>
							</div>

							<div class="post-comments">
								<!-- comment -->
								<?php
									$comments = $Comment->getAllAcceptedCommentsByBlog($blog_id);
									if($comments){
										foreach ($comments as $key => $comment){
								?>
									<div class="media">
										<div class="media-left">
											<img class="media-object" src="./assets/img/avatar.png" alt="">
										</div>
										<div class="media-body">
											<div class="media-heading">
												<h4> <?php echo $comment->name?> </h4>
												<span class="time"><?php echo date("M d, Y  h:m a", strtotime($comment->created_date))?></span>
												<a href="#Reply" class="reply" onclick = "comment(this);" data-commentId = "<?php echo $comment -> id?>">Reply</a>
											</div>
											<p><?php echo $comment->message?></p>
											<?php
												$reply_info = $Comment->getAllAcceptedReplyByBlogOnComment($blog_id, $comment->id);
												if($reply_info){
													foreach ($reply_info as $key => $reply) {
											?>

														<!-- comment -->
														<div class="media">
															<div class="media-left">
																<img class="media-object" src="./assets/img/avatar.png" alt="">
															</div>
															<div class="media-body">
																<div class="media-heading">
																	<h4><?php echo $reply->name?></h4>
																	<span class="time"><?php echo date("M d, Y h:m a", strtotime($reply->created_date))?></span>
																	<a href="#Reply" class="reply" onclick = "comment(this);" data-commentId = "<?php echo $comment -> id?>">Reply</a>
																</div>
																<p><?php echo $reply->message?></p>
															</div>
														</div>
														<!-- /comment -->
											<?php
													}
												}
											?>
										</div>
									</div>
								<?php	
										}
									}
								?>
								<!-- /comment -->

							</div>
						</div>
						<!-- /comments -->



						<!-- reply -->
						<div class="section-row" id = "Reply">
							<div class="section-title">
								<h2>Leave a reply</h2>
								<p>your email address will not be published. required fields are marked *</p>
							</div>
							<form class="post-reply" action="process/comment" method="post">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<span>Name *</span>
											<input class="input" type="text" name="name">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<span>Email *</span>
											<input class="input" type="email" name="email">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<span>Website</span>
											<input class="input" type="text" name="website">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<textarea class="input" name="message" placeholder="Message"></textarea>
										</div>
										<input type = "hidden" name="commentid" id = "commentid"value=<?php echo $blog_id?>>
										<input type = "hidden" name="blogid" value=<?php echo $blog_id?>>
										
										<button class="primary-button" type="submit">Submit</button>
									</div>
								</div>
							</form>
						</div>
						<!-- /reply -->

						
					</div>
					<!-- /Post content -->

					<!-- aside -->
					<div class="col-md-4">
						<!-- ad -->
						<?php include 'inc/simpleAd.php';?>
						<!-- /ad -->

						<!-- post widget -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Most Read</h2>
							</div>

							<div class="post post-widget">
								<a class="post-img" href="blog-post.html"><img src="./assets/img/widget-1.jpg" alt=""></a>
								<div class="post-body">
									<h3 class="post-title"><a href="blog-post.html">Tell-A-Tool: Guide To Web Design And Development Tools</a></h3>
								</div>
							</div>

							<div class="post post-widget">
								<a class="post-img" href="blog-post.html"><img src="./assets/img/widget-2.jpg" alt=""></a>
								<div class="post-body">
									<h3 class="post-title"><a href="blog-post.html">Pagedraw UI Builder Turns Your Website Design Mockup Into Code Automatically</a></h3>
								</div>
							</div>

							<div class="post post-widget">
								<a class="post-img" href="blog-post.html"><img src="./assets/img/widget-3.jpg" alt=""></a>
								<div class="post-body">
									<h3 class="post-title"><a href="blog-post.html">Why Node.js Is The Coolest Kid On The Backend Development Block!</a></h3>
								</div>
							</div>

							<div class="post post-widget">
								<a class="post-img" href="blog-post.html"><img src="./assets/img/widget-4.jpg" alt=""></a>
								<div class="post-body">
									<h3 class="post-title"><a href="blog-post.html">Tell-A-Tool: Guide To Web Design And Development Tools</a></h3>
								</div>
							</div>
						</div>
						<!-- /post widget -->

						<!-- post widget -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Featured Posts</h2>
							</div>
							<div class="post post-thumb">
								<a class="post-img" href="blog-post.html"><img src="./assets/img/post-2.jpg" alt=""></a>
								<div class="post-body">
									<div class="post-meta">
										<a class="post-category cat-3" href="#">Jquery</a>
										<span class="post-date">March 27, 2018</span>
									</div>
									<h3 class="post-title"><a href="blog-post.html">Ask HN: Does Anybody Still Use JQuery?</a></h3>
								</div>
							</div>

							<div class="post post-thumb">
								<a class="post-img" href="blog-post.html"><img src="./assets/img/post-1.jpg" alt=""></a>
								<div class="post-body">
									<div class="post-meta">
										<a class="post-category cat-2" href="#">JavaScript</a>
										<span class="post-date">March 27, 2018</span>
									</div>
									<h3 class="post-title"><a href="blog-post.html">Chrome Extension Protects Against JavaScript-Based CPU Side-Channel Attacks</a></h3>
								</div>
							</div>
						</div>
						<!-- /post widget -->
						
						<?php
							include 'inc/catTagArc.php';
						?>
					</div>
					<!-- /aside -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->

		<?php 
			include 'inc/footer.php';
		?>

<script>
	$('blockquote').addClass('blockquote');

	function comment(element){
		var commentid = $(element).data();
		$('#commentid').val(commentid.commentid);
	}
</script>

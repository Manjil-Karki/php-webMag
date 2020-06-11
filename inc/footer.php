	<!-- Footer -->
    <footer id="footer">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-5">
						<div class="footer-widget">
							<div class="footer-logo">
								<a href="index" class="logo"><img src="./assets/img/logo.png" alt=""></a>
							</div>
							<ul class="footer-nav">
								<li><a href="blank">Privacy Policy</a></li>
								<li><a href="blank">Advertisement</a></li>
							</ul>
							<div class="footer-copyright">
								<span>&copy; <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></span>
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="row">
							<div class="col-md-6">
								<div class="footer-widget">
									<h3 class="footer-title">About Us</h3>
									<ul class="footer-links">
										<li><a href="about">About Us</a></li>
										<li><a href="blank">Join Us</a></li>
										<li><a href="contact">Contacts</a></li>
									</ul>
								</div>
							</div>
							<div class="col-md-6">
								<div class="footer-widget">
									<h3 class="footer-title">Catagories</h3>
									<ul class="footer-links">
									<?php
										$Category = new category();
										$categories= $Category->getAllCategories();
										if($categories){
											foreach ($categories as $key => $category) {
									?>										
										<li><a href="category?id=<?php echo $category->id?>"><?php echo $category->categoryname?></a></li>
									<?php
											}

										}
									?>
									</ul>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-3">
						<div class="footer-widget">
							<h3 class="footer-title">Join our Newsletter</h3>
							<div class="footer-newsletter">
								<form action="process/newsletter" method="post">
									<input class="input" type="email" name="email" placeholder="Enter your email">
									<button class="newsletter-btn" type="submit"><i class="fa fa-paper-plane"></i></button>
								</form>
							</div>
							<ul class="footer-social">
							<?php
								$Link = new link();
								$links = $Link->getAllLinks();
								if ($links){
									foreach ($links as $key => $link){
								?>
									<li><a href="<?php echo $link->url ?>"><i class="fa fa-<?php echo $link->name?>"></i></a></li>
								<?php
									}
								}
							?>
							</ul>
						</div>
					</div>

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</footer>
		<!-- /Footer -->

		<!-- jQuery Plugins -->
		<script src="./assets/js/jquery.min.js"></script>
		<script src="./assets/js/bootstrap.min.js"></script>
		<script src="./assets/js/main.js"></script>
		<script>
			$(document).ready(function(){
				$("#listSearch").on("keyup", function() {
					var value = $(this).val().toLowerCase();
					$('#myList').removeClass('hidden');
					if(value == ''){
						$('#myList').addClass('hidden');
					}
					$("#myList li").filter(function() {
						$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
					});
				});
				post = 3;
				$('#load-more-btn').click(function(){
					post = post + 3;
						$.ajax({
						url: 'inc/loadMostread.php',
						type: 'post',
						data: {offset: post},						
						success: function(response){
							$("div.load-more-post:last").after(response).show();
							if(response.length == 0){
								$('#load-more-btn').text('All caught up');
								$('#load-more-btn').removeClass('primary-button');
								$('#load-more-btn').addClass('btn-success');
							}
						}
					});					
				});
			});
		</script>

	</body>
</html>
<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	$header = $bread = 'Archieve';
    include 'inc/header.php';
    
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $archive_id = $_GET['id'];
        if($archive_id){
            $Archive = new archive();
            $archive_info = $Archive->getArchiveById($archive_id);
            if($archive_info){
                $archive_info = $archive_info[0];
            }else{
                redirect('index');
            }
        }else{
             redirect('index');   
        }
    }else{
        redirect('index');
    }
?>

		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					
					<div class="col-md-8">
						<!-- post widget -->
						<div class="aside-widget">
							<div class="section-title">
								<h2> <?php echo date("M d, Y", strtotime($archive_info->date))?> </h2>
							</div>
                            <?php
                                $Blog = new blogs();
                                $blogs = $Blog->getAllBlogsByCreatedDate($archive_info->date);
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
					</div>
					<!-- /aside -->
                    <div class="col-md-4">
                    <?php
                            include 'inc/simpleAd.php';
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
<?php
    include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
    define('CAT_COLOR', ['cat-1', 'cat-2', 'cat-3', 'cat-4']);
    $offset = $_POST['offset'];
    $Blog = new blogs();
    for ($i=0; $i <= 3; $i++) {     
    
    $blogs = $Blog->getMostReadBlogsWithLimit($offset, 1);
    if($blogs){
        foreach($blogs as $key => $blog){
            if(isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH.'blog/'.$blog->image)){
                $thumbnail = UPLOAD_URL.'blog/'.$blog->image;
            }else{
                $thumbnail = UPLOAD_URL.'noimage.png';
            }
?>
                <!-- post -->
                <div class="col-md-12 load-more-post">
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
        $offset = $offset + 1;
    }else{
        break;
    }
}							
?>

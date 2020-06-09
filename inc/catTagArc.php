<!-- catagories -->
<div class="aside-widget">
    <div class="section-title">
        <h2>Catagories</h2>
    </div>
    <div class="category-widget">
    <ul>
    <?php
        if ($categories) {
            foreach($categories as $key => $category){
    ?>

            <li><a href="category?id=<?php echo $category->id?>" class="<?php echo CAT_COLOR[$category->id%4]?>"><?php echo $category->categoryname?><span>
            <?php
                $total = $Blog->getNumberOfBlogsByCategory($category->id);
                echo $total[0]->total;
            ?>
            
            </span></a></li>

    <?php
            }
        }
    
    ?>
        </ul>
    </div>
</div>
<!-- /catagories -->

<!-- tags -->
<div class="aside-widget">
    <div class="tags-widget">
        <ul>
        <?php
            if($categories){
                foreach($categories as $key => $category){
        ?>
                    <li><a href="category?id=<?php echo $category->id?>"><?php echo $category->categoryname?></a></li>
        <?php
                }
            }
        ?>
        </ul>
    </div>
</div>
<!-- /tags -->
<?php 
    if(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) != 'index'){
?>
    <!-- archive -->
    <div class="aside-widget">
        <div class="section-title">
            <h2>Archive</h2>
        </div>
        <div class="archive-widget">
            <ul>
                <?php 
                    $Archive = new archive();
                    $archives = $Archive->getAllArchives();
                    if (isset($archives) && !empty($archives)){
                        foreach ($archives as $key => $archive) {
                ?>
                            <li><a href="archive?id=<?php echo $archive->id?>"><?php echo date("M d, Y", strtotime($archive->date))?></a></li>
                <?php	
                        }
                    }

                ?>

            </ul>
        </div>
    </div>
    <!-- /archive -->
<?php
    }
?>
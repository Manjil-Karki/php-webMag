<?php 
  $header = 'Blog List';
  include 'inc/header.php';
  include 'inc/checkLogin.php';
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <?php
            flashMessage();
          ?>
            <div class="page-title">
              <div class="title_left">
                <h3>Blogs</h3>
              </div>

             
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Blogs</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <a href="addblog" class = "btn btn-primary"> Add Blogs </a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <table id = "datatable" class = "table table-strip table-bodered">
                        <thead>
                            <th>S.N.</th>
                            <th>Blog Title</th>
                            <th>Contents</th>
                            <th>Featured</th>
                            <th>Category</th>
                            <th>Views</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            <?php
                              $blog = new blogs();
                              $blogs = $blog -> getAllBlogs();
                              if($blogs){
                                foreach ($blogs as $key => $value) {
                                  ?>
                                  <tr>
                                    <td><?php echo $key+1?></td>
                                    <td><?php echo $value -> title?></td>
                                    <td><?php echo html_entity_decode($value -> content)?></td>
                                    <td><?php echo $value -> featured?></td>
                                    <td><?php echo $value -> category?></td>
                                    <td><?php echo (isset($value->view) && !empty($value->view))?$value -> view:'0'?></td>
                                    <?php
                                      if (isset($value->image) && !empty($value->image) && file_exists(UPLOAD_PATH.'blog/'.$value->image)) {
                                        $thumbnail = UPLOAD_URL.'blog/'.$value->image;
                                      }else{
                                        $thumbnail = UPLOAD_URL.'noimg.png';
                                      }
                                    ?>
                                    
                                    <td><img src="<?php echo $thumbnail?>" style="width:200px;height:auto;"></td>
                                    <td>
                                    <a href="addblog?id=<?php echo($value -> id)?>&amp;act=<?php echo substr(md5("Edit-Blog-".$value->id.$_SESSION['token']), 5, 20)?>" class="btn btn-info"><i class="fa fa-pencil"></i></a>    
                                    <a href="process/blogs?id=<?php echo($value -> id)?>&amp;act=<?php echo substr(md5("Delete-Blog-".$value->id.$_SESSION['token']), 5, 20)?>" class = "btn btn-danger" onclick= "return confirm('Are u sure u want to delete this blog?')"> <i class = "fa fa-trash"></i> </a>
                                    </td>
                                  </tr>
                              <?php
                                }
                              }else{
                                echo('No data hera');
                              }
                            ?>
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

  <?php include 'inc/footer.php';?>
  <script src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js"></script>
  <script src = ./assets/js/datatables.js></script>
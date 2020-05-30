<?php 
  $header = 'Add Blogs';
  include 'inc/header.php';
  include 'inc/checkLogin.php';

  $action = "Add";
  if ($_GET) {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
      $blog_id = (int)$_GET['id'];
      if ($blog_id) {
          $act = substr(md5("Edit_Blog-".$blog_id.$_SESSION['token']), 5, 20);
        }if ($act = $_GET['act']) {
          $Blog = new blogs();
          $blog_info = $Blog->getBlogById($blog_id);
          if ($blog_info) {
            $blog_info = $blog_info[0];
            $action = "Edit";
          }
        }
    }
  }
  
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
                    <h2><?php echo $action?> Blogs</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form action="process/blogs" method = "post" enctype="multipart/form-data">
                      <div class="form-group col-md-8">
                        <label for="title"> Blog Title </label>
                        <input type="text" class = "form-control" name = "title" id = "title" placeholder = "Blog Title" value = "<?php echo (isset($blog_info->title) && !empty($blog_info->title))?$blog_info->title:''?>">
                      </div>
                      <div class="form-group col-md-8">
                        <label for="content"> Blog Content </label>
                        <textarea name="content" id="content" cols="30" rows="10" class = "form-control">
                          <?php 
                            echo (isset($blog_info->content) && !empty($blog_info->content)?$blog_info->content:'')
                          ?>
                        </textarea>
                      </div>
                      <div class="form-group col-md-8">
                        <label for="featured"> Featured </label><br>
                        <input type="radio" name = "featured" id = "featured" value = "Featured" <?php echo ((isset($blog_info->featured) && !empty($blog_info->featured) && $blog_info->featured == 'Featured')?'checked':'')?>>Featured<br>
                        <input type="radio" name = "featured" id = "featured" value = "notFeatured" <?php echo ((isset($blog_info->featured) && !empty($blog_info->featured) && $blog_info->featured == 'notFeatured')?'checked':'')?>>Not Featured<br>
                      </div>
                      <div class="form-group col-md-8">
                        <label for="categotyid"> Category </label>
                        <select name="categoryid" id="categotyid" class = "form-control">
                          <option value="" selected = "selected" disabled = "disabled">--Select category--</option>
                          <?php
                            $Category = new category();
                            $categories = $Category->getAllCategories();
                            if($categories){
                              foreach ($categories as $key => $category){
                            ?>
                              <option value="<?php echo($category->id) ?>" <?php echo ($blog_info->categoryid==$category->id)?"selected":""; ?>><?php echo $category->categoryname; ?></option>
                            <?php
                              }
                            }
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-md-8">
                        <label for="image"> Blog Image </label>
                        <input type="file" name = "image" id = "image" accept = "image/*">
                      </div>
                      <?php
                        if (isset($blog_info->image) && !empty($blog_info->image) && file_exists(UPLOAD_PATH.'blog/'.$blog_info->image)) {
                          $thumbnail = UPLOAD_URL.'blog/'.$blog_info->image;
                        }else{
                          $thumbnail = UPLOAD_URL.'noimg.jpg';
                        }
                      ?>
                      <div class="form-group col-md-8">
                          <img src = "<?php echo ($thumbnail)?>" id = "thumbnail" style = "width:300px; height:auto;">
                      </div>
                      <div class="form-group col-md-8">
                      <input type="hidden" name="old_img" id="old_img" value="<?php echo (isset($blog_info->image) && !empty($blog_info->image))?$blog_info->image:"" ?>">
                        <input type="hidden" name="id" id="id" value="<?php echo (isset($blog_info->id) && !empty($blog_info->id))?$blog_info->id:"" ?>">
                        <button type="submit" class = "btn btn-success"> Submit </button>
                      </div>
                    
                    
                    </form>
                  
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
    <script>
        var content = $('#content').val();
        ckeditor(content);

        function ckeditor(data){
          $('.ck').remove();
        ClassicEditor
        .create( document.querySelector( '#content' ) )
        .then(editor => {
          editor.setData(data);
        })
        .catch( error => {
            console.error( error );
        } );
        }

        document.getElementById('image').onchange = function(){
          var reader = new FileReader();

        reader.onload = function (e) {
            document.getElementById("thumbnail").src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);
        };
    </script>
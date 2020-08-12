<?php 
  $header = 'Category';
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
                <h3>Category</h3>
              </div>

             
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of category</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <a href="#" class = "btn btn-primary" onclick = "addCategory()"> Add Categories </a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <table id = "datatable" class = "table table-strip table-bodered">
                        <thead>
                            <th>S.N.</th>
                            <th>Category Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            <?php
                              $category = new category();
                              $categories = $category -> getAllCategories();
                              if($categories){
                                foreach ($categories as $key => $value) {
                                  ?>
                                  <tr>
                                    <td><?php echo $key+1?></td>
                                    <td><?php echo $value -> categoryname?></td>
                                    <td><?php echo html_entity_decode($value -> description)?></td>
                                    <td>
                                    <a href="javascript:;" class="btn btn-info" onclick="editCategory(this);" data-category_info='<?php echo(json_encode($value, JSON_HEX_APOS))?>'><i class="fa fa-pencil"></i></a>    
                                    <a href="process/category?id=<?php echo($value -> id)?>&amp;act=<?php echo substr(md5("Delete-Category-".$value->id.$_SESSION['token']), 5, 20)?>" class = "btn btn-danger" onclick = "return continue('Are u sure u want to delete this category?');"> <i class = "fa fa-trash"></i> </a>
                                    </td>
                                  </tr>
                              <?php
                                }
                              }
                            ?>
                        </tbody>
                      </table>
                      <div class="modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id = "title"> Add category </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="process/category" method = "post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="categoryname">Category Name</label>
                                    <input class = "form-control" type="text" name="categoryname" placeholder="Category Name" id = "categoryname">
                                </div>
                                <div class="form-group">
                                    <label for="categoryname">Category Description</label>
                                    <textarea name="description" id="description" cols="30" rows="10" class = "form-control"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <input type="hidden" id = "id" name = "id">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </form>
                            </div>
                        </div>
                        </div>
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
        function editCategory(element){
          var category_info = $(element).data('category_info');
          if (typeof(category_info) != 'object') {
            category_info=JSON.parse(category_info);
         }
          $('#title').html('Edit Category');
          $('#categoryname').val(category_info.categoryname);
          $('#id').val(category_info.id);
          showModal(category_info.description);
        }

        function addCategory(){
          $('#title').html('Add Category');
          $('#categoryname').val('');
          $('#id').removeAttr('value');
            showModal();
        }
        function showModal(data = ""){
          ckeditor(data);
            $('.modal').modal();
        }
        function ckeditor(data){
          $('.ck').remove();
        ClassicEditor
        .create( document.querySelector( '#description' ) )
        .then(editor => {
          editor.setData(data);
        })
        .catch( error => {
            console.error( error );
        } );
        }
    </script>

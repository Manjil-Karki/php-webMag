<?php 
  $header = 'Archive';
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
                <h3>Archive</h3>
              </div>

             
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of archive</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <a href="#" class = "btn btn-primary" onclick = "addArchive()"> Add Archives </a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <table id = "datatable" class = "table table-strip table-bodered">
                        <thead>
                            <th>S.N.</th>
                            <th>Archive Name</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            <?php
                              $archive = new archive();
                              $archives = $archive -> getAllArchives();
                              if($archives){
                                foreach ($archives as $key => $value) {
                                  ?>
                                  <tr>
                                    <td><?php echo $key+1?></td>
                                    <td><?php echo $value -> date?></td>
                                    <td>
                                    <a href="javascript:;" class="btn btn-info" onclick="editArchive(this);" data-archive_info='<?php echo(json_encode($value))?>'><i class="fa fa-pencil"></i></a>    
                                    <a href="process/archive?id=<?php echo($value -> id)?>&amp;act=<?php echo substr(md5("Delete-Archive-".$value->id.$_SESSION['token']), 5, 20)?>" class = "btn btn-danger" onclick = "return continue('Are u sure u want to delete this archive?');"> <i class = "fa fa-trash"></i> </a>
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
                                <h5 class="modal-title" id = "title"> Add archive </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="process/archive" method = "post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="date">Archive Date</label>
                                    <input class = "form-control" type="date" name="date" placeholder="date" id = "date">
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
        function editArchive(element){
          var archive_info = $(element).data('archive_info');
          if (typeof(archive_info) != 'object') {
            archive_info=JSON.parse(archive_info);
         }
          $('#title').html('Edit Archive');
          $('#date').val(archive_info.date);
          $('#id').val(archive_info.id);
          showModal();
        }

        function addArchive(){
          $('#title').html('Add Archive');
          $('#date').val('');
          $('#id').removeAttr('value');
            showModal();
        }
        function showModal(){
            $('.modal').modal();
        }
        
    </script>
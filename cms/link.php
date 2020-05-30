<?php 
  $header = 'Links';
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
                <h3>Links</h3>
              </div>

             
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Links</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <a href="#" class = "btn btn-primary" onclick = "addLink()"> Add Links </a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <table id = "datatable" class = "table table-strip table-bodered">
                        <thead>
                            <th>S.N.</th>
                            <th>Link Name</th>
                            <th>URL</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            <?php
                              $Link = new link();
                              $links = $Link -> getAllLinks();
                              if($links){
                                foreach ($links as $key => $link) {
                                  ?>
                                  <tr>
                                    <td><?php echo $key+1?></td>
                                    <td><?php echo $link -> name?></td>
                                    <td><?php echo $link -> url?></td>
                               
                                    <td>
                                    <a href="javascript:;" class="btn btn-info" onclick="editLink(this);" data-ad_info='<?php echo(json_encode($link))?>'><i class="fa fa-pencil"></i></a>    
                                    <a href="process/link?id=<?php echo($link -> id)?>&amp;act=<?php echo substr(md5("Delete-Link-".$link->id.$_SESSION['token']), 5, 20)?>" class = "btn btn-danger" onclick = "return continue('Are u sure u want to delete this ad?');"> <i class = "fa fa-trash"></i> </a>
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
                                <h5 class="modal-title" id = "title"> Add Link </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="process/link" method = "post" enctype = "multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name">Link Name</label>
                                    <input class = "form-control" type="text" name="name" placeholder="Link Title" id = "name">
                                </div>
                                <div class="form-group">
                                    <label for="URL">Link Url</label>
                                    <input class = "form-control" type="url" name="url" placeholder="URL" id = "url">
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
        
        function editLink(element){
          var ad_info = $(element).data('ad_info');
          if (typeof(ad_info) != 'object') {
            ad_info=JSON.parse(ad_info);
         }
          $('#title').html('Edit ad');
          $('#name').val(ad_info.name);
          $('#url').val(ad_info.url);
          

          $('#id').val(ad_info.id);
          showModal();
        }

        function addLink(){
          $('#title').html('Add ad');
          $('#name').val('');
          $('#url').val('');
          
          $('#id').removeAttr('value');
            showModal();
        }
        function showModal(){
            $('.modal').modal();
        }
    </script>
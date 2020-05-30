<?php 
  $header = 'Ads';
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
                <h3>Ads</h3>
              </div>

             
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Ads</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <a href="#" class = "btn btn-primary" onclick = "addAd()"> Add Ads </a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <table id = "datatable" class = "table table-strip table-bodered">
                        <thead>
                            <th>S.N.</th>
                            <th>Ad Name</th>
                            <th>URL</th>
                            <th>type</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            <?php
                              $Ad = new ad();
                              $ads = $Ad -> getAllAds();
                              if($ads){
                                foreach ($ads as $key => $ad) {
                                  ?>
                                  <tr>
                                    <td><?php echo $key+1?></td>
                                    <td><?php echo $ad -> title?></td>
                                    <td><?php echo $ad -> url?></td>
                                    <td><?php echo $ad -> type?></td>
              
                                    <?php
                                      if(isset($ad->image) && !empty($ad->image) && file_exists(UPLOAD_PATH.'ad/'.$ad->image)){
                                        $thumbnail = UPLOAD_URL.'ad/'.$ad->image;
                                      }else{
                                        $thumbnail = UPLOAD_URL.'noimage.png';
                                      }                         
                                    ?>
                                    <td><img src="<?php echo $thumbnail?>" alt="" style = "width:100px;height:auto;" id="thumbnail"></td>
                                    <td>
                                    <a href="javascript:;" class="btn btn-info" onclick="editAd(this);" data-ad_info='<?php echo(json_encode($ad))?>'><i class="fa fa-pencil"></i></a>    
                                    <a href="process/ad?id=<?php echo($ad -> id)?>&amp;act=<?php echo substr(md5("Delete-Ad-".$ad->id.$_SESSION['token']), 5, 20)?>" class = "btn btn-danger" onclick = "return continue('Are u sure u want to delete this ad?');"> <i class = "fa fa-trash"></i> </a>
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
                                <h5 class="modal-title" id = "title"> Add Ad </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="process/ad" method = "post" enctype = "multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="adtitle">Ad Title</label>
                                    <input class = "form-control" type="text" name="title" placeholder="Ad Title" id = "adtitle">
                                </div>
                                <div class="form-group">
                                    <label for="URL">Ad Url</label>
                                    <input class = "form-control" type="url" name="url" placeholder="URL" id = "url">
                                </div>
                                <div class="form-group">
                                    <label for="type">Ad Type</label><br>
                                    <input type="radio" name="type" id = "type" value = "Wide" checked = "checked"> Wide <br>
                                    <input type="radio" name="type" id = "type" value = "Simple"> Simple <br>
                                </div>
                                <div class="form-group">
                                    <label for="image">Ad Image</label>
                                    <input type="file" name = "image" id = "image" accept = "image/*">
                                </div>
                                <div class="form-group col-md-8">
                                    <img id="adthumbnail" style = "width:100px;height:auto;">
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
        document.getElementById('image').onchange = function(){
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById("adthumbnail").src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        };
        function editAd(element){
          var ad_info = $(element).data('ad_info');
          if (typeof(ad_info) != 'object') {
            ad_info=JSON.parse(ad_info);
         }
          $('#title').html('Edit ad');
          $('#adtitle').val(ad_info.title);
          $('#url').val(ad_info.url);

          $('#id').val(ad_info.id);
          showModal();
        }

        function addAd(){
          $('#title').html('Add ad');
          $('#adtitle').val('');
          $('#url').val('');
          
          $('#id').removeAttr('value');
            showModal();
        }
        function showModal(){
            $('.modal').modal();
        }
    </script>
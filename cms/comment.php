<?php 
  $header = 'Comment';
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
                <h3>Comment</h3>
              </div>

             
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of comment</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <table id = "datatable" class = "table table-strip table-bodered">
                        <thead>
                            <th>S.N.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Website</th>
                            <th>Message</th>
                            <th>Time</th>
                            <th>Comment Type</th>
                            <th>Comment Id</th>
                            <th>Blog Id</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            <?php
                              $comment = new comment();
                              $comments = $comment -> getAllWaitingComments();
                              if($comments){
                                foreach ($comments as $key => $value) {
                                  ?>
                                  <tr>
                                    <td><?php echo $key+1?></td>
                                    <td><?php echo $value -> name?></td>
                                    <td><?php echo $value -> email?></td>
                                    <td><?php echo $value -> website?></td>
                                    <td><?php echo html_entity_decode($value -> message)?></td>
                                    <td><?php echo date("M d,Y h:i:s a", strtotime($value->created_date))?></td>
                                    <td><?php echo$value -> commentType?></td>
                                    <td><?php echo (isset($value->commentid) && !empty($value->commentid))?$value->commentid:""?></td>
                                    <td><?php echo $value -> blogid?></td>
                                    <td>
                                    <a href="process/comment?id=<?php echo($value -> id)?>&amp;act=<?php echo substr(md5("Accept-Comment-".$value->id.$_SESSION['token']), 5, 20)?>" class = "btn btn-success" onclick = "return continue('Are u sure u want to Accept this comment?');"> Accept </a>
                                    <a href="process/comment?id=<?php echo($value -> id)?>&amp;act=<?php echo substr(md5("Reject-Comment-".$value->id.$_SESSION['token']), 5, 20)?>" class = "btn btn-danger" onclick = "return continue('Are u sure u want to Reject this comment?');"> Reject </a>
                                    
                                    </td>
                                  </tr>
                              <?php
                                }
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
        </div>
        <!-- /page content -->

  <?php include 'inc/footer.php';?>
  <script src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js"></script>
  <script src = ./assets/js/datatables.js></script>

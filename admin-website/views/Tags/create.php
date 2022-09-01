<?php 
      if(isset($_POST['btn-save'])) {
        if(isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
          $Tags->attach($_FILES['file']);
        }
        if($Tags->prepare($_POST)->save()) {
          $session->set_message("data inserted successfully.");
          Helper::redirect_to("index.php?page=Tags_create");
        } else {
          $session->set_message($Tags->errors);
        }
      }
     ?>
      <div class="col-md-9 col-lg-10 col-sm-7 col-xs-12 right-container">
        <div class="row header-section">
            <div class="col-md-12 header-title">
                <h2 class="h2"><span class="glyphicon glyphicon-tasks"></span><?php include '../layouts/title.php'; ?></h2>
            </div><!-- End of header-title -->
        </div><!-- End of row -->
        <?php Helper::message($session->get_message()); ?>
        <div class="panel-group" id="body-accordion">
          <div class="panel panel-default main-body">
            <div class="panel-heading body-head">
              <h4 class="panel-title">                 
                 <a data-toggle="collapse" data-parent="#body-accordion" href="#body-collapse">
                <span class="glyphicon glyphicon-plus"></span>&nbsp;Tags</a>
              </h4>
            </div>
            <div id="body-collapse" class="panel-collapse collapse in">
               <div class="row main-part">
                  <div class="col-md-12 inner-part">
                    <div class="row section">
                      <form method="post" enctype="multipart/form-data">
                        <div class="col-md-6 left-part">
                            <legend>Tags Details</legend>        
                            <div class="form-group">
                                <input class="form-control" placeholder="Tags" name="title" type="text" autofocus value="<?php if(isset($_POST['title'])) { echo $_POST['title']; } ?>">
                                <p></p>
                            </div> 
                            <script>
                                $( "input" )
                                  .keyup(function() {
                                    var value = $( this ).val();
                                    $( "p" ).text( value );
                                  })
                                  .keyup();
                            </script>
                        </div><!-- End of left-part -->
                        <div class="col-md-12 submit">
                            <button type="submit" class="btn btn-primary" name="btn-save">Submit</button>
                            <a href="index.php?page=Tags_read" class="btn btn-success"><span class="glyphicon glyphicon-backward"></span>&nbsp; Cancel</a>                  
                        </div><!-- End of submit -->
                      </form>
                    </div><!-- End of section -->
                  </div><!-- End of inner-part -->
               </div><!-- End of main-part -->
            </div>
          </div>
        </div>
      </div><!-- End of right-container -->
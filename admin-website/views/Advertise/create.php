<?php 
      if(isset($_POST['btn-save'])) {
        if(isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
          $Advertise->attach($_FILES['file']);
        }
        if($Advertise->prepare($_POST)->save()) {
          $session->set_message("data inserted successfully.");
          Helper::redirect_to("index.php?page=Advertise_create");
        } else {
          $session->set_message($Advertise->errors);
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
                <span class="glyphicon glyphicon-plus"></span>&nbsp;Advertise</a>
              </h4>
            </div>
            <div id="body-collapse" class="panel-collapse collapse in">
               <div class="row main-part">
                  <div class="col-md-12 inner-part">
                    <div class="row section">
                      <form method="post" enctype="multipart/form-data">
                        <div class="col-md-6 left-part">
                            <legend>Advertise Details</legend>                            
                            <div class="form-group">
                                <input name="title" type="hidden">
                            </div>                           
                            <div class="form-group">
                                <input class="form-control" placeholder="top/bottom" name="category" type="text" value="<?php if(isset($_POST['category'])) { echo $_POST['category']; } ?>">
                            </div>                           
                            <div class="form-group">
                                <input class="form-control" placeholder="Links" name="links" type="text" value="<?php if(isset($_POST['links'])) { echo $_POST['links']; } ?>">
                            </div>                                                                                     
                        </div><!-- End of left-part -->
                        <div class="col-md-6 right-part">
                            <legend>Advertise Details</legend>  
                              <div class="form-group">                                
                                <input type="file" accept="image/*" onchange="loadFile(event)" id="image" name="file">
                                <label for="image" id="uploader"><span id="up_img"><span class="glyphicon glyphicon-camera"></span> Upload image</span></label>
                              </div>                          
                              <div class="row img-upload-section">
                                <div class="image-loader">
                                      <img src="../images/progress.gif">
                                </div><!-- End of image-loader -->
                                <div class="col-md-2">
                                  <div class="image-container">
                                    <div class="image-holder">
                                      <img id="output">
                                    </div><!-- End of image-holder -->
                                    <div class="text-holder">
                                      <h1 id="img-name"></h1>
                                    </div><!-- End of text-holder -->
                                  </div><!-- End of image-container -->
                                  <span class="glyphicon glyphicon-trash" id="img-remover"></span>
                                </div><!-- End of col-md-2 -->
                              </div><!-- End of image-upload-section -->
                        </div><!-- End of right-part -->
                        <div class="col-md-12 submit">
                            <button type="submit" class="btn btn-primary" name="btn-save">Submit</button>
                            <a href="index.php?page=Advertise_read" class="btn btn-success"><span class="glyphicon glyphicon-backward"></span>&nbsp; Cancel</a>                  
                        </div><!-- End of submit -->
                      </form>
                    </div><!-- End of section -->
                  </div><!-- End of inner-part -->
               </div><!-- End of main-part -->
            </div>
          </div>
        </div>
      </div><!-- End of right-container -->
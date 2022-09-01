<?php 
      
      if(isset($_POST['btn-update'])) {

        if(isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
          $Author->attach($_FILES['file']);   
        }
        if($Author->prepare($_POST)->save()) {
          $session->set_message("data updated successfully.");
        } else {
          $session->set_message($Author->errors);
        }
      }

      ?>

      <?php 
        if(isset($_GET['id'])) {
          $record = $Author->prepare($_GET)->fetch();
          if(!$record) {
            Helper::redirect_to("index.php");     
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
                <span class="glyphicon glyphicon-plus"></span>&nbsp;Author</a>
              </h4>
            </div>
            <div id="body-collapse" class="panel-collapse collapse in">
               <div class="row main-part">
                  <div class="col-md-12 inner-part">
                    <div class="row section">
                      <?php if($record) { ?>
                      <form method="post" enctype="multipart/form-data">
                        <div class="col-md-6 left-part">
                              <legend>Author Details</legend>                            
                              <div class="form-group">
                                <input type="hidden" value="<?php if(isset($record)) {echo $record->id;} ?>" name="id">
                                <input class="form-control" placeholder="Name" name="title" type="text" value="<?php if(isset($record)){echo $record->title;} ?>">
                              </div>
                              
                              
                              <button type="submit" class="btn btn-primary" name="btn-update">
                                <span class="glyphicon glyphicon-edit"></span> Update Record
                              </button>
                              <a href="index.php?page=Author_read" class="btn btn-success"><span class="glyphicon glyphicon-backward"></span>&nbsp; Cancel</a>                  
                        </div><!-- End of left-part -->
                        <div class="col-md-6 right-part">
                              <legend>Author Details</legend> 
                              
                              <div class="form-group">
                                <div class="row">
                                    <?php if (!empty($record->file)): ?>
                                      <div class="col-md-5">
                                        <h5>Current image</h5>
                                        <img src="../<?php if(isset($record)) { echo $Author->image_path()."/".$record->file;}?>" class="img-thumbnail file">
                                       
                                      </div>
                                    <?php endif ?>
                                    <div class="col-md-6">
                                      <h5>Changed image</h5>
                                      <input type="file" accept="image/*" onchange="loadFile(event)" id="image" name="file">
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
                                      <label for="image" id="uploader"><span id="up_img"><span class="glyphicon glyphicon-camera"></span> Update image</span></label>
                                    </div>
                                </div>                              
                                
                              </div>
                               
                             <!--  <div class="form-group">
                                <input class="form-control" placeholder="Father Name" name="father_name" type="text" value="<?php if(isset($record)){echo $record->father_name;} ?>">
                              </div>
                              <div class="form-group">
                                <input class="form-control" placeholder="Mother Name" name="mother_name" type="text" value="<?php if(isset($record)){echo $record->mother_name;} ?>">
                              </div> -->
                        </div> <!-- End of right-part -->
                        
                        <?php } ?>
                      </form>
                    </div><!-- End of section -->
                  </div><!-- End of inner-part -->
               </div><!-- End of main-part -->
            </div>
          </div>
        </div>
      </div><!-- End of right-container -->
      
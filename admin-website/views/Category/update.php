<?php 
      
      if(isset($_POST['btn-update'])) {

        if(isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
          $Category->attach($_FILES['file']);   
        }
        if($Category->prepare($_POST)->save()) {
          $session->set_message("data updated successfully.");
        } else {
          $session->set_message($Category->errors);
        }
      }

      ?>

      <?php 
        if(isset($_GET['id'])) {
          $record = $Category->prepare($_GET)->fetch();
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
                <span class="glyphicon glyphicon-plus"></span>&nbsp;Category</a>
              </h4>
            </div>
            <div id="body-collapse" class="panel-collapse collapse in">
               <div class="row main-part">
                  <div class="col-md-12 inner-part">
                    <div class="row section">
                      <?php if($record) { ?>
                      <form method="post" enctype="multipart/form-data">
                        <div class="col-md-6 left-part">
                              <legend>Category Details</legend>         
                              <div class="form-group">
                                <input type="hidden" value="<?php if(isset($record)) {echo $record->id;} ?>" name="id">
                                <input class="form-control" placeholder="Category Name" name="title" type="text" value="<?php if(isset($record)){echo $record->title;} ?>">
                              </div>
                              <button type="submit" class="btn btn-primary" name="btn-update">
                                <span class="glyphicon glyphicon-edit"></span> Update Record
                              </button>
                              <a href="index.php?page=Category_read" class="btn btn-success"><span class="glyphicon glyphicon-backward"></span>&nbsp; Cancel</a>                  
                        </div><!-- End of left-part -->
                        
                        <?php } ?>
                      </form>
                    </div><!-- End of section -->
                  </div><!-- End of inner-part -->
               </div><!-- End of main-part -->
            </div>
          </div>
        </div>
      </div><!-- End of right-container -->
      
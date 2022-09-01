<?php 
      if(isset($_POST['btn-save'])) {
          $title = $_POST['title'];
          //$des = mysql_real_escape_string($_POST['des']);
          $des = $_POST['des'];
          $nowdatetime = date('Y-m-d H:i:s');
          $create_at = $nowdatetime;
          //$create_at = date('Y-m-d');
          
          //echo $datetime = date('Y-m-d H:i:s a', time());
          /*
          $today = date("Y-m-d");
          $date = new DateTime($today);
          echo $date->format('Y-m-d H:i:s');
          */
          $visits = 0;
          $category_id = $_POST['category_id'];
          $author_id = $_POST['author_id'];
          $file = $_POST['file'];
          $tags = implode(',', $_POST['tags']);
        
        if($Content->custome_create($title, $des, $create_at, $visits, $category_id, $author_id, $file, $tags)) {
          $session->set_message("data inserted successfully.");
          Helper::redirect_to("index.php?page=Content_create");
        } else {
          $session->set_message($Content->errors);
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
                <span class="glyphicon glyphicon-plus"></span>&nbsp;Content</a>
              </h4>
            </div>
            <div id="body-collapse" class="panel-collapse collapse in">
               <div class="row main-part">
                  <div class="col-md-12 inner-part">
                    <div class="row section">
                      <form method="post" enctype="multipart/form-data">
                        <div class="col-md-6 left-part">
                            <legend>Content Details</legend>                            
                            <div class="form-group">
                                <input class="form-control" name="visits" type="hidden" value="0">
                            </div>        
                            <div class="form-group">
                                <input class="form-control" placeholder="Content Title" name="title" type="text" value="<?php if(isset($_POST['title'])) { echo $_POST['title']; } ?>">
                            </div>        
                            <div class="form-group">
                                <textarea id="mytextarea" class="form-control" placeholder="Description" name="des"></textarea>
                            </div>
                                     
                            <div class="form-group">
                                <select class="form-control" name="category_id" value="<?php if(isset($_POST['category_id'])) {echo $_POST['category_id']; } ?>">
                                    <option>Category</option>
                                    <?php $categories = $Category->fetch_all(); foreach($categories as $category){ ?>
                                    <option value="<?php echo $category->id; ?>"><?php echo $category->id." ".$category->title; ?></option>
                                    <?php } ?>
                                    
                                </select>
                            </div>          
                            <div class="form-group">
                                <select class="form-control" name="author_id" value="<?php if(isset($_POST['author_id'])) {echo $_POST['author_id']; } ?>">
                                    <option>Author</option>
                                    <?php $authors = $Author->fetch_all(); foreach($authors as $author){ ?>
                                    <option value="<?php echo $author->id; ?>"><?php echo $author->id." ".$author->title; ?></option>
                                    <?php } ?>
                                </select>
                            </div>          
                            <div class="form-group">
                                <select class="form-control" name="file" value="<?php if(isset($_POST['file'])) {echo $_POST['file']; } ?>">
                                    <option>Images</option>
                                    <?php $images = $Images->fetch_all(); foreach($images as $image) { ?>
                                    <option value="<?php echo $image->file; ?>"><?php echo $image->id." ".$image->title; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-check-label"><input type="checkbox" id="checkAll">Check All Tags</label><br />
                                <?php $tags_table = $Tags->fetch_all(); foreach($tags_table as $tags_data){ ?>
                                <label class="checkbox-inline"><input type="checkbox" id="checkItem" name="tags[]" value="<?php echo $tags_data->title; ?>"><?php echo $tags_data->title; ?></label>
                                <?php } ?>
                            </div>
                            
                        </div><!-- End of left-part -->
                        <div class="col-md-12 submit">
                            <button type="submit" class="btn btn-primary" name="btn-save">Submit</button>
                            <a href="index.php?page=Content_read" class="btn btn-success"><span class="glyphicon glyphicon-backward"></span>&nbsp; Cancel</a>                  
                        </div><!-- End of submit -->
                      </form>
                    </div><!-- End of section -->
                  </div><!-- End of inner-part -->
               </div><!-- End of main-part -->
            </div>
          </div>
        </div>
      </div><!-- End of right-container -->
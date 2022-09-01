<?php
	if(isset($_POST['btn-del'])) {
		$Slide->prepare($_GET)->delete();
		$session->set_message("data deleted successfully.");
		Helper::redirect_to("index.php?page=Slide_read");
	}
 ?>

      <div class="col-md-9 col-lg-10 col-sm-7 col-xs-12 right-container">
        <div class="row header-section">
            <div class="col-md-12 header-title">
                <h2 class="h2"><span class="glyphicon glyphicon-tasks"></span><?php include '../layouts/title.php'; ?></h2>
            </div><!-- End of header-title -->
        </div><!-- End of header-section -->
        
        <div class="panel-group" id="body-accordion">
          <div class="panel panel-default main-body">
            <div class="panel-heading body-head">
              <h4 class="panel-title">                 
                 <a data-toggle="collapse" data-parent="#body-accordion" href="#body-collapse">
                <span class="glyphicon glyphicon-plus"></span>&nbsp;Slide</a>
              </h4>
            </div>
            <div id="body-collapse" class="panel-collapse collapse in">
               <div class="row main-part">
                  <div class="col-md-12 inner-part">
                   	<div class="alert alert-danger">
			    		<strong>Sure !</strong> to remove the following record ? 
					</div>
			        	
				<?php if(isset($_GET['id'])) { 
					$record = $Slide->prepare($_GET)->fetch();
					if($record) { ?>

						<form method="post">
							<table class="table table-bordered">
								<tr class="">
									<th>#</th>
									<th>Title</th>
									<th>Image</th>									
								</tr>							
								<tr class="">
									<td><?php echo $record->id; ?></td>
									<td><?php echo $record->title; ?></td>
									<td><img src="../<?php if(isset($record)) { echo $Slide->image_path()."/".$record->file;}?>" class="img-thumbnail file"></td>
																	
								</tr>							
							</table>
							<button class="btn btn-large btn-danger" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> &nbsp; YES</button>
							<a class="btn btn-primary" href="index.php?page=Slide_read"> <span class="glyphicon glyphicon-backward"></span> Cancel</a>	
						</form>
					<?php } else { ?>						
							<div class="alert alert-info">
						    	<strong>SORRY!</strong> No Record Found. <a href="index.php?page=Slide_read">HOME</a>!
							</div>						
					<?php } ?>
			<?php } ?>
						
                  </div><!-- End of inner-part -->
               </div><!-- End of main-part -->
            </div>
          </div>
        </div>
      </div><!-- End of right-container -->


<?php

	$rec = $Advertise->count_all(); 	
	$page = !empty($_GET['rows']) ? (int)$_GET['rows'] : 1;
	$per_page = $Advertise->per_page;	
	$total_count = $rec->total;
	$pagination = new Pagination($page, $per_page, $total_count);
	$Advertise->offset = $pagination->offset();
	$records = $Advertise->read();
 ?>

      <div class="col-md-9 col-lg-10 col-sm-7 col-xs-12 right-container">
        <div class="row header-section">
            <div class="col-md-12 header-title">
                <h2 class="h2"><span class="glyphicon glyphicon-tasks"></span><?php include '../layouts/title.php'; ?> </h2>
            </div><!-- End of header-title -->
        </div><!-- End of header-section -->
        <div class="row">
          <div class="col-md-3 col-md-offset-9 search-box">            
                <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
                    <input type="search" name="" id="key" class="form-control" title="" placeholder="Search" onkeyup="get()">
                </div><!-- End of input-group -->
                <br>
          </div><!-- End of search-box -->
        </div><!-- End of search-filter -->
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
                   
						<?php Helper::message($session->get_message()); ?>
						<a class="btn btn-primary" href="index.php?page=Advertise_create"><span class="glyphicon glyphicon-plus"></span> Add Record</a><br><br>
						<?php 

							if($records) { ?>
								<img src="../images/loader.gif" id="animate">
								<div id="values">
									<table class="table table-bordered">
										<tr class="">
											<th>#</th>
											<th>Category</th>
											<th>Links</th>
											<th>Image</th>
																				
											<th class="text-center">Action</th>
										</tr>
										<?php foreach ($records as $record) { ?>
											<tr class="">
												<td><?php echo $record->id; ?></td>
												<td><?php echo $record->category; ?></td>
												<td><?php echo $record->links; ?></td>
												<td><img src="../<?php if(isset($record)) { echo $Advertise->image_path()."/".$record->file;}?>" class="img-thumbnail file"></td>
												
												
												<td class="text-center">
													<a href="index.php?page=Advertise_update&id=<?php echo $record->id; ?>"><span class="glyphicon glyphicon-edit"></span></a>
													<a href="index.php?page=Advertise_delete&id=<?php echo $record->id; ?>"><span class="glyphicon glyphicon-remove-circle"></span></a>
												</td>
											</tr>
										<?php } ?>
									</table>
								</div>

								

								<?php 
									if($pagination->total_pages() > 1) {
									echo "<ul class=\"pagination\">";
										if($pagination->has_previous_page()) { 
								    		echo "<li><a href=\"index.php?page=Advertise_read&rows=";
									      	echo $pagination->previous_page();
									     	echo "\">&laquo; Previous</a></li> "; 
								    	}

										for($i=1; $i <= $pagination->total_pages(); $i++) {
											if($i == $page) {
												echo " <li class=\"active\"><span>{$i}</span></li> ";
											} else {
												echo " <li><a href=\"index.php?page=Advertise_read&rows={$i}\">{$i}</a></li> "; 
											}
										}

										if($pagination->has_next_page()) { 
											echo " <li><a href=\"index.php?page=Advertise_read&rows=";
											echo $pagination->next_page();
											echo "\">Next &raquo;</a></li> "; 
								    	}
								    echo "</ul";
										
									} // end of pagination

								 
							} else { ?>
								<div class="alert alert-info">No Record Found.</div>
							<?php }

						 ?>
                  </div><!-- End of inner-part -->
               </div><!-- End of main-part -->
            </div>
          </div>
        </div>
      </div><!-- End of right-container -->
    <script>
	   $('#animate').hide();
	   function get() {
	   		if($('#key').val() == "") {
	    		location.reload();
	    	}
	   		$('.pagination').hide();
	    	var val;
	    	val = $('#key').val();
	    	$.ajax({
		        type: "POST",
		        url: "../views/Advertise/search.php",
		        data:'find='+val,
		        beforeSend: function() {
		        	$('#animate').show();
		        },
		        success: function(data){
		        	$("#values").html(data);
		        },
		        complete: function() {
		        	$('#animate').hide();
		        }
		    });
	    }
	</script>


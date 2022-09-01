<?php

	$rec = $Social->count_all(); 	
	$page = !empty($_GET['rows']) ? (int)$_GET['rows'] : 1;
	$per_page = $Social->per_page;	
	$total_count = $rec->total;
	$pagination = new Pagination($page, $per_page, $total_count);
	$Social->offset = $pagination->offset();
	$records = $Social->read();
 ?>

      <div class="col-md-9 col-lg-10 col-sm-7 col-xs-12 right-container">
        <div class="row header-section">
            <div class="col-md-12 header-title">
                <h2 class="h2"><span class="glyphicon glyphicon-tasks"></span><?php include '../layouts/title.php'; ?> </h2>
            </div><!-- End of header-title -->
        </div><!-- End of header-section -->
        
        <div class="panel-group" id="body-accordion">
          <div class="panel panel-default main-body">
            <div class="panel-heading body-head">
              <h4 class="panel-title">                 
                 <a data-toggle="collapse" data-parent="#body-accordion" href="#body-collapse">
                <span class="glyphicon glyphicon-plus"></span>&nbsp;Social</a>
              </h4>
            </div>
            <div id="body-collapse" class="panel-collapse collapse in">
               <div class="row main-part">
                  <div class="col-md-12 inner-part">
                   
						<?php Helper::message($session->get_message()); ?>
						
						<?php 

							if($records) { ?>
								<img src="../images/loader.gif" id="animate">
								<div id="values">
									<table class="table table-bordered">
										<tr class="">
											<th>#</th>
											<th>Title</th>
											<th>Links</th>
																				
											<th class="text-center">Action</th>
										</tr>
										<?php foreach ($records as $record) { ?>
											<tr class="">
												<td><?php echo $record->id; ?></td>
												<td><?php echo $record->title; ?></td>
												<td><?php echo $record->link; ?></td>
												<td class="text-center">
													<a href="index.php?page=Social_update&id=<?php echo $record->id; ?>"><span class="glyphicon glyphicon-edit"></span></a>
												</td>
											</tr>
										<?php } ?>
									</table>
								</div>

								

								<?php 
									if($pagination->total_pages() > 1) {
									echo "<ul class=\"pagination\">";
										if($pagination->has_previous_page()) { 
								    		echo "<li><a href=\"index.php?page=Social_read&rows=";
									      	echo $pagination->previous_page();
									     	echo "\">&laquo; Previous</a></li> "; 
								    	}

										for($i=1; $i <= $pagination->total_pages(); $i++) {
											if($i == $page) {
												echo " <li class=\"active\"><span>{$i}</span></li> ";
											} else {
												echo " <li><a href=\"index.php?page=Social_read&rows={$i}\">{$i}</a></li> "; 
											}
										}

										if($pagination->has_next_page()) { 
											echo " <li><a href=\"index.php?page=Social_read&rows=";
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


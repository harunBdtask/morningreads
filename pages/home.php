<?php include'layouts/header.php'; ?> 
    <section class="clear-fixed">
    	<div class="fluid-container">
        	<div class="content-row">
        	    <script type="text/javascript">
                	$(document).ready(function(){
                		$('.single-item').slick({
                			autoplay: true,
                		  	autoplaySpeed: 2000,
                		});
                	});
                </script>
        	    <div class="grid-4 single-item">
            		<!--<button type="button" data-role="none" class="slick-prev slick-arrow" aria-label="Previous" role="button" style="display: block;">Previous</button>-->
            		<?php $contents = $Content->fetch_substring(); foreach($contents as $slide) { ?>
            		<div>
            		  	<a class="blog-thumb" href="index.php?page=innerpage&id=<?php echo $slide->id; ?>">
            		    	<div class="">
            		        	<div class="news-big-thumb" style="background-image: url(admin-website/<?php if(isset($slide)) { echo $Content->image_path()."/".$slide->file;}?>);">
            		            </div>
            		            <h2 class="thumb-title"><?php echo $slide->title; ?></h2>
            		            <p class="thumb-text"><?php echo $slide->des; ?></p>
            		        </div>
            	    	</a>
                	</div>
                	<?php } ?>
            	</div>
                
                
                <div class="grid-8">
                	<div class="content-row">
                	    <?php if(isset($_GET['category'])) { $category_id = $_GET['category']; ?>
                	    <?php $contents = $Content->fetch_substringCategory($category_id); foreach($contents as $slide) { ?>
                    	<div class="grid-6 margin-bottom-10">
                            <div class="content-row">
                                <a name='btn-update' class="blog-thumb" href="index.php?page=innerpage&id=<?php echo $slide->id; ?>">
                                    <div class="grid-4">
                                        <div class="small-thumb" style="background-image: url(admin-website/<?php if(isset($slide)) { echo $Content->image_path()."/".$slide->file;}?>);">
                                        </div>
                                    </div>
                                    <div class="grid-8 padding-zero">
                                        <h2 class="thumb-title-small"><?php echo $slide->title; ?>  </h2>
                                        <!--<p class="thumb-text"></p>-->
                                        <?php echo $slide->des; ?>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php } ?>
                        <?php }else{ ?>
                        <?php $contents = $Content->fetch_substring(); foreach($contents as $slide) { ?>
                    	<div class="grid-6 margin-bottom-10">
                            <div class="content-row">
                                <a name='btn-update' class="blog-thumb" href="index.php?page=innerpage&id=<?php echo $slide->id; ?>">
                                    <div class="grid-4">
                                        <div class="small-thumb" style="background-image: url(admin-website/<?php if(isset($slide)) { echo $Content->image_path()."/".$slide->file;}?>);">
                                        </div>
                                    </div>
                                    <div class="grid-8 padding-zero">
                                        <h2 class="thumb-title-small"><?php echo $slide->title; ?>  </h2>
                                        <!--<p class="thumb-text"></p>-->
                                        <?php echo $slide->des; ?>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php } } ?>
                    </div>
                    <?php $categories='top'; $advertisess = $Advertise->fetch_byCategory($categories); foreach($advertisess as $advertises) { ?>
                    <div class="content-row">
                    	<div class="grid-12">
                        	<div class="banner-ad padding-left-15">
                        	    <a class="blog-thumb" href="<?php echo $advertises->links; ?>" target="_blank">
                            	    <img src="admin-website/<?php if(isset($advertises)) { echo $Advertise->image_path()."/".$advertises->file;}?>" height="94" width="690">
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                
            </div>
        </div>
    </section>
    
    <section class="clear-fixed innersection">
    	<div class="fluid-container">
        	<div class="content-row">
            	<div class="grid-12">
                	<ul class="blog-category">
                    	<li><a class="active" href="index.php?page=homepage">all</a></li>
                    	<?php $categories = $Category->fetch_all(); foreach($categories as $category){ $category_id = $category->id;?>
                        <li><a href="index.php?page=categoryHomepage&category=<?php echo $category_id; ?>"><?php echo $category->title; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="content-row">
                <?php if(isset($_GET['category'])) {$categories = $_GET['category']; $content_table=$Content->fetch_byCategory($categories);foreach($content_table as $content_data){?>
                <div class="grid-3 blog-thumb-wrapper">
                	<a class="blog-thumb" href="index.php?page=innerpage&id=<?php echo $content_data->id; ?>">
                    	<div class="news-listing-thumb" style="background-image: url(admin-website/<?php if(isset($content_data)) { echo $Content->image_path()."/".$content_data->file;}?>);">
                        </div>
                        <h2 class="thumb-title-small"><?php echo $content_data->title; ?>  </h2>
                        <!--<p class="thumb-text"></p>-->
                        <?php echo $content_data->des; ?>
                    </a>
                </div>
                <?php } } else{ ?>
                <?php $slides = $Content->fetch_visitCount(); foreach($slides as $slide) { ?>
            	<div class="grid-3 blog-thumb-wrapper">
                	<a class="blog-thumb" href="index.php?page=innerpage&id=<?php echo $slide->id; ?>">
                    	<div class="news-listing-thumb" style="background-image: url(admin-website/<?php if(isset($slide)) { echo $Content->image_path()."/".$slide->file;}?>);">
                        </div>
                        <h2 class="thumb-title-small"><?php echo $slide->title; ?>  </h2>
                        <!--<p class="thumb-text"></p>-->
                        <?php echo $slide->des; ?>
                    </a>
                </div>
                <?php } } ?>
            </div>
        </div>
    </section>
    <?php $category='bottom'; $advertises = $Advertise->fetch_byCategory($category); foreach($advertises as $advertise) { ?>
    <section class="clear-fixed innersection">
    	<div class="fluid-container">
        	<div class="content-row">
            	<div class="grid-12">
            	    <a class="blog-thumb" href="<?php echo $advertise->links; ?>" target="_blank">
                	    <img class="responsive-img" src="admin-website/<?php if(isset($advertise)) { echo $Advertise->image_path()."/".$advertise->file;}?>" height="138" width="1120">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
<?php include 'layouts/footer.php'; ?>    
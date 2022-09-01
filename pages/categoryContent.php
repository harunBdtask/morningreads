<?php include'layouts/header.php'; ?> 
    
    <section class="clear-fixed innersection">
    	<div class="fluid-container">
            <div class="content-row">
                <?php if(isset($_GET['category'])) {$categories = $_GET['category']; $content_table=$Content->fetch_byCategory($categories);foreach($content_table as $content_data){?>
                <div class="grid-3">
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
            	<div class="grid-3">
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
            	    <a class="blog-thumb" href="<?php echo $advertise->links; ?>">
                	    <img class="responsive-img" src="admin-website/<?php if(isset($advertise)) { echo $Advertise->image_path()."/".$advertise->file;}?>" height="138" width="1120">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
<?php include 'layouts/footer.php'; ?>    
<?php include'layouts/header.php'; ?>
<?php if(isset($_GET['author_id'])) { $author_id = $_GET['author_id']; 
    $recs = $Author->fetch_authorCode($author_id);
} ?>
    <section class="clear-fixed innersection profile-banner">
    	<div class="fluid-container">
    		<div class="content-row">
    			<div class="grid-12">
    				<div class="profile-cover" style="background-image: url(images/profile/cover.png);"></div>
    				<?php foreach($recs as $rec) { ?>
    				<div class="profile-info">
    					<div class="profile-image" style="background-image: url(<?php $file = $rec->file; if(!empty($file)){ //if(isset($author_data)){ ?>admin-website/<?php echo $Author->image_path()."/".$rec->file;}else{ ?> images/author.png<?php } ?>);"></div>
    					<div class="basic-info inline">
							<h2 class="author-name" style="text-transform: uppercase;"><?php echo $rec->title; ?></h2>
							<p class="ultralight margin-zero">Writing since: <?php $create_at = $rec->create_at; echo date("jS F, Y", strtotime($create_at)); ?></p>
						</div>
						<?php $content_amount = $Content->fetch_authorContent($author_id); foreach($content_amount as $ca){ ?>
   						<div class="author-stats">
   							<h3><?php echo $ca->total_content; ?></h3>
   							<p>Total Blogs</p>
   						</div>
   						<div class="author-stats">
   							<h3><?php echo $ca->total_visits; ?></h3>
   							<p>Total Views</p>
   						</div>
   						<?php } ?>
    				</div>
    				<?php } ?>
    			</div>
    		</div>
    	</div>
    </section>
    <script type="text/javascript">
    	$(document).ready(function(){
    		$(".blog-category li a").click(function(event){
    			event.preventDefault();
    			var menuName = $(this).html();
    			setCookie("menu_name", menuName, 365);
    			var route = $(this).attr("href");
    			$(location).attr('href', route);
    		})
    		
    		
    			if (menuVal == "" && menuVal == null) {
    			  	setCookie("menu_name", "page 1", 365);
    				$(".blog-category li:first-child").children("a").addClass("active");
    			}else{
    				var menuVal = getCookie("menu_name");
    				$(".blog-category li a").removeClass("active");
    				$(".blog-category li").each(function(){
    					if($(this).children("a").html() == menuVal){
    						$(this).children("a").addClass("active");
    					}
    				});
    				
    			}
    		
    		
    		function setCookie(cname, cvalue, exdays) {
    		  var d = new Date();
    		  d.setTime(d.getTime() + (exdays*24*60*60*1000));
    		  var expires = "expires="+ d.toUTCString();
    		  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    		}
    		
    		function getCookie(cname) {
    		  var name = cname + "=";
    		  var decodedCookie = decodeURIComponent(document.cookie);
    		  var ca = decodedCookie.split(';');
    		  for(var i = 0; i <ca.length; i++) {
    			var c = ca[i];
    			while (c.charAt(0) == ' ') {
    			  c = c.substring(1);
    			}
    			if (c.indexOf(name) == 0) {
    			  return c.substring(name.length, c.length);
    			}
    		  }
    		  return "";
    		}
    	});
    </script>
    <section class="clear-fixed innersection">
    	<div class="fluid-container">
        	<div class="content-row">
            	<div class="grid-12">
                	<ul class="blog-category">
                    	<li><a class="active" href="index.php?page=profile&author_id=2">all</a></li>
                    	<?php $content_category = $Content->fetch_contentCategory($author_id); foreach($content_category as $cc){ ?>
                        <li><a href="index.php?page=profile&author_id=2&category=<?php echo $cc->cat_id; ?>"><?php echo $cc->category; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="content-row">
                <?php if(isset($_GET['category'])) {$category_id = $_GET['category']; $content_table=$Content->fetch_byCategory_authorid($category_id, $author_id);foreach($content_table as $content_data){?>
            	<div class="grid-3 blog-thumb-wrapper">
                	<a class="blog-thumb" href="index.php?page=innerpage&id=<?php echo $content_data->id; ?>">
                    	<div class="news-listing-thumb" style="background-image: url(admin-website/<?php if(isset($content_data)) { echo $Content->image_path()."/".$content_data->file;}?>);">
                        </div>
                        <h2 class="thumb-title-small"><?php echo $content_data->title; ?></h2>
                        <p class="thumb-text"><?php echo $content_data->des; ?></p>
                    </a>
                </div>
                <?php } } else{ ?>
                <?php $slides = $Content->fetch_visitCount_authorId($author_id); foreach($slides as $slide) { ?>
                <div class="grid-3 blog-thumb-wrapper">
                	<a class="blog-thumb" href="index.php?page=innerpage&id=<?php echo $slide->id; ?>">
                    	<div class="news-listing-thumb" style="background-image: url(admin-website/<?php if(isset($slide)) { echo $Content->image_path()."/".$slide->file;}?>);">
                        </div>
                        <h2 class="thumb-title-small"><?php echo $slide->title; ?></h2>
                        <p class="thumb-text"><?php echo $slide->des; ?></p>
                    </a>
                </div>
                <?php } } ?>
            </div>
        </div>
    </section>
    
    <section class="clear-fixed innersection">
    	<div class="fluid-container">
        	<div class="content-row">
            	<div class="grid-12">
                	<img class="responsive-img" src="images/temp/ad2.jpg">
                </div>
            </div>
        </div>
    </section>
<?php include 'layouts/footer.php'; ?>
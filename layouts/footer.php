
    <section class="clear-fixed footer-top">
    	<div class="fluid-container">
        	<div class="content-row">
            	<div class="grid-3">
                	<h2 class="sub-title">Subscribe</h2>
                	<?php if(isset($_POST['btn-save'])) {
                	    if($Subscribe->prepare($_POST)->save()) {
                          echo "<script type='text/javascript'>alert(' Email Subscribed ! ');</script>";
                        } else {
                          echo "<script type='text/javascript'>alert(' Something Wrong ! ');</script>";
                        }
                	} ?>
                	<form method="POST">
                        <div class="form-elem">
                        	<input type="hidden" name="title" value="<?php if(isset($_POST['title'])){ echo $_POST['title']; } ?>">
                        	<input type="email" name="email" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>" class="form-control" placeholder="Email Address">
                        </div>
                        <div class="form-elem text-right">
                        	<input type="submit" name="btn-save" class="button-medium button-blue" value="Subscribe Now">
                        </div>
                    </form>
                </div>
                <div class="grid-6">
                	<h2 class="sub-title">About Us</h2>
                    <p class="white light"><?php $abouts = $About->fetch_all(); foreach($abouts as $about){ echo $about->des; } ?></p>
                </div>
                <div class="grid-3 social-icons">
                	<h2 class="sub-title">Follow Us On</h2>
                    <a target="_blank" href="<?php $title = 'facebook'; $socials = $Social->fetch_byTitle($title); foreach($socials as $social){ echo $social->link; } ?>"><span class="icon-facebook"></span></a>
                    <a target="_blank" href="<?php $title = 'twitter'; $socials = $Social->fetch_byTitle($title); foreach($socials as $social){ echo $social->link; } ?>"><span class="icon-twitter"></span></a>
                    <a target="_blank" href="<?php $title = 'linkedin'; $socials = $Social->fetch_byTitle($title); foreach($socials as $social){ echo $social->link; } ?>"><span class="icon-linkedin"></span></a>
                    <a target="_blank" href="<?php $title = 'instagram'; $socials = $Social->fetch_byTitle($title); foreach($socials as $social){ echo $social->link; } ?>"><span class="icon-instagram"></span></a>
                    <br>
                    <a target="_blank" href="<?php $title = 'tumblr'; $socials = $Social->fetch_byTitle($title); foreach($socials as $social){ echo $social->link; } ?>"><span class="icon-tumblr"></span></a>
                    <a target="_blank" href="<?php $title = 'googleplus'; $socials = $Social->fetch_byTitle($title); foreach($socials as $social){ echo $social->link; } ?>"><span class="icon-googleplus"></span></a>
                    <a target="_blank" href="<?php $title = 'behance'; $socials = $Social->fetch_byTitle($title); foreach($socials as $social){ echo $social->link; } ?>"><span class="icon-behance"></span></a>
                    <a target="_blank" href="<?php $title = 'pinterest'; $socials = $Social->fetch_byTitle($title); foreach($socials as $social){ echo $social->link; } ?>"><span class="icon-pinterest"></span></a>
                </div>
            </div>
        </div>
    </section>
    
    <footer class="clear-fixed">
    	<div class="fluid-container">
    		<div class="content-row">
    			<div class="grid-12">
    				<p class="ultralight">Copyright <?php echo date('Y'); ?> | Morning Reads</p>
    			</div>
    		</div>
    	</div>
    </footer>
<!--    
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Cookies.js/0.3.1/cookies.js"></script>    
-->
<script>
/*
$(document).ready(function () {
    var index = Cookies.get('active');
    $('.clearfix').find('a').removeClass('active');
    $(".clearfix").find('a').eq(index).addClass('active');
    $('.clearfix').on('click', 'li a', function (e) {
        e.preventDefault();
        $('.clearfix').find('a').removeClass('active');
        $(this).addClass('active');
        Cookies.set('active', $('.clearfix a').index(this));
    });
});
*/
</script>
</body>
</html>
<?php include'layouts/header.php'; ?>
<?php if(isset($_GET['id'])) {
  $update_count = $Content->update_count($_GET['id']);
  $record = $Content->prepare($_GET)->fetch(); $author_id = $record->author_id;
} ?>
    <section class="clear-fixed">
    	<div class="container">
    		<div class="content-row">
    			<div class="grid-12">
    				<h2 class="sub-title margin-top-zero"><?php echo $record->title; ?></h2>
    				<p class="autherinfo">Total visited <?php echo $record->visits; ?></p>
    				<span class="author-info">
    				    <a class="blog-thumb" href="index.php?page=profile&author_id=<?php echo $author_id; ?>">
    				        <?php $author_table = $Author->fetch_authorCode($author_id); foreach($author_table as $author_data){ ?>
        					<span class="pic">
        						<img style="border-radius: 50%;" height="52" width="52" src="<?php $file = $author_data->file; if(!empty($file)){ //if(isset($author_data)){ ?>admin-website/<?php echo $Author->image_path()."/".$author_data->file;}else{ ?> images/author.png<?php } ?>">
        					</span>
        					<span class="autherinfo">
        						<span class="name"><?php echo $author_data->title; ?></span>
        						<!--<br/><span class="date">Jun 20, 2019</span>-->
        					</span>
        					<?php } ?>
    						<span class="date" style="display: block;margin-top: -25px;margin-left: 63px;"><?php $create_at = $record->create_at; echo date("jS F, Y", strtotime($create_at)); ?></span>
    						
        				</a>
    				</span>
    			</div>
    		</div>
    		<div class="content-row margin-top-20">
    			<div class="grid-12">
    				<div class="blog-content">
    					<img class="responsive-img" src="admin-website/<?php if(isset($record)) { echo $Content->image_path()."/".$record->file;}?>">
    					<p><?php echo $record->des; ?></p>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>
<?php include 'layouts/footer.php'; ?>
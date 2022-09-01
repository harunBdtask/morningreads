<?php require_once 'src/model.php'; ?>
<?php
if($session->is_logged_in()) {
	Helper::redirect_to("views/index.php");
}
if(isset($_POST['submit'])) {	
	$User->prepare($_POST);

	$found_user = $User->authenticate();

	if($found_user) {
		$session->login($found_user);
		
		Helper::redirect_to("views/index.php");
	} else {
		$message = "username or password doesnot match";
	}
} else {
	$username = "";
	$password = "";
}
 ?>
<html>
<head>
	<title>login</title>
	<link rel="stylesheet" type="text/css" href="css/style_login.css">
</head>
<body>
	<div id="container">
		<div id="login">
			<div id="error-options">
				<!-- start of success -->
				<?php if (isset($_SESSION['success']))  { ?>
					  <div id="alert" class="group">
						<ul>
							<li><img src="images/tick.png"></li>
							<li>
								<p>
									<?php echo $_SESSION['success']; ?>
									<?php $_SESSION['success'] = null; ?>
								</p>
							</li>
						</ul>
					</div>  
				<?php } ?>
				<!-- end of success -->

				<!-- start error section -->
				
				<?php if(isset($message)) { ?>
				<div id="errors">
				  <ul id="form-errors"> 				  
					<li class="group">
						<?php if($message != "") { ?>
								<div style="float:left;margin-left:-50px;"><img src="images/errors.png"></div>
						<?php } ?>
						<div id="two"><?php echo $message; ?></div>
					</li>		
				  </ul>
				 </div> <!-- End of errors -->
				 <?php }
					
				 ?>
				 <!-- end error section -->
			</div>

			<form action="index.php" method="post">
				<div id="form-options">
					<input type="email" name="username" placeholder="Email" value=""><br>
					<input type="password" name="password" placeholder="Password"><br>
					<div id="submit-design">
						<div id="submit-inside">
							<div id="submit-center">
								<label for="sub" id="go">Go</label>
								<input type="submit" id="sub" value="" name="submit">
							</div>
						</div>
					</div>
					<div id="forgot">
						<a href="#">Forgot Your Password?</a>
					</div>
				</div>	
			</form>
		</div> 
	</div>
</body>
</html>
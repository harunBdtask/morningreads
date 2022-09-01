<?php require_once 'admin-website/src/model.php'; ?>
<?php 
	if(isset($_GET['page'])) {
		switch ($_GET['page']) {
			case 'homepage':
				include 'pages/home.php';
				break;
			case 'categoryHomepage':
				include 'pages/categoryContent.php';
				break;
			case 'innerpage':
				include 'pages/innerpage.php';
				break;
			case 'profile':
				include 'pages/profile.php';
				break;
			default:
				include 'pages/home.php';
				break;
		}
	} else {
		include 'pages/home.php';
	}

 ?>
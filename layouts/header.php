<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Morning Reads</title>
<link rel="stylesheet" type="text/css" href="css/sleek.ui.css">
<link rel="stylesheet" type="text/css" href="css/font.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="js/sleek.ui.js"></script>
<script type="text/javascript" src="js/script.js"></script>

<style>
.news-big-thumb {
	height: 250px;
	overflow: hidden;
	background-position: top center;
	background-repeat: no-repeat;
	background-size: cover;
}

.small-thumb {
	width: 100%;
	height: 100px;
	overflow: hidden;
	background-position: top center;
	background-repeat: no-repeat;
	background-size: cover;
}  

.news-listing-thumb {
	width: 100%;
	height: 200px;
	overflow: hidden;
	margin-bottom: 15px;
	background-position: top center;
	background-repeat: no-repeat;
	background-size: cover;
}

.blog-thumb-wrapper{
    min-height: 270px;
}
</style>
<style>
    nav ul li a.active, nav ul li a:hover {
    color: #3F73E0;
    /*border-bottom: 3px solid #fd9625;*/
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$("nav ul li a").click(function(event){
			event.preventDefault();
			var menuName = $(this).html();
			setCookie("menu_name", menuName, 365);
			var route = $(this).attr("href");
			$(location).attr('href', route);
		})
		
		
			if (menuVal == "" && menuVal == null) {
			  	setCookie("menu_name", "page 1", 365);
				$("nav ul li:first-child").children("a").addClass("active");
			}else{
				var menuVal = getCookie("menu_name");
				$("nav ul li a").removeClass("active");
				$("nav ul li").each(function(){
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

<!-- slick slider -->
<link rel="stylesheet" type="text/css" href="https://kenwheeler.github.io/slick/slick/slick.css">
<link rel="stylesheet" type="text/css" href="https://kenwheeler.github.io/slick/slick/slick-theme.css">
<script type="text/javascript" src="https://kenwheeler.github.io/slick/slick/slick.min.js"></script>

<!-- end slick slider -->

</head>

<body>
	<header class="clear-fixed top-fixed">
    	<div class="fluid-container">
        	<div class="content-row">
            	<div class="grid-12 text-center">
                	<a class="brandname" href="index.php?page=homepage">
                	    <img src="images/morning-reads.jpg" alt="Morning Reads">
            	    </a>
            	    <span class="thumb-title-small inline float-right" style="margin-top: 20px;"><?php echo date('l, F d, Y'); ?></span>
                </div>
            </div>
        </div>
        <nav>
        	<ul>
            	<li><a href="index.php?page=homepage" class="active">Home</a></li>
                <?php $categories = $Category->fetch_all(); foreach($categories as $category){ $category_id = $category->id;?>
                <li><a href="index.php?page=categoryHomepage&category=<?php echo $category_id; ?>"><?php echo $category->title; ?></a></li>
                <?php } ?>
            </ul>
        </nav>
    </header>
 
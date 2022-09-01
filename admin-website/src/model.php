<?php
	defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);
	defined("SITE_ROOT") ? null : define("SITE_ROOT", realpath(dirname(__FILE__).DS."..".DS));
	defined("LIB_PATH") ? null : define("LIB_PATH", SITE_ROOT.DS.'src');
    require_once LIB_PATH.DS.'session.php';
    require_once LIB_PATH.DS.'User.php';
    require_once LIB_PATH.DS.'Subscribe.php';
    require_once LIB_PATH.DS.'About.php';
    require_once LIB_PATH.DS.'Social.php';
    require_once LIB_PATH.DS.'Category.php';
    require_once LIB_PATH.DS.'Tags.php';
    require_once LIB_PATH.DS.'Author.php';
    require_once LIB_PATH.DS.'Images.php';
    require_once LIB_PATH.DS.'Content.php';
    require_once LIB_PATH.DS.'Advertise.php';
    
    require_once LIB_PATH.DS.'helper.php';
    require_once LIB_PATH.DS.'pagination.php';

 ?>
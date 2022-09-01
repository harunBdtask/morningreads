<?php require_once '../layouts/header.php'; ?>
<?php if(!$session->is_logged_in()) { Helper::redirect_to("../index.php"); } ?> 
<?php 
  if(isset($_GET['page'])) {
      switch ($_GET['page']) {
        case 'Advertise_create':
          include 'Advertise/create.php';
          break;
        case 'Advertise_read':
          include 'Advertise/index.php';
          break;
        case 'Advertise_update':
          include 'Advertise/update.php';
          break;
        case 'Advertise_delete':
          include 'Advertise/delete.php';
          break;
          
          
        case 'Subscribe_read':
          include 'Subscribe/index.php';
          break;
        case 'Subscribe_delete':
          include 'Subscribe/delete.php';
          break;
          
          
        case 'Social_read':
          include 'Social/index.php';
          break;
        case 'Social_update':
          include 'Social/update.php';
          break;
          
          
        case 'About_read':
          include 'About/index.php';
          break;
        case 'About_update':
          include 'About/update.php';
          break;
          
          
          
        case 'Content_create':
          include 'Content/create.php';
          break;
        case 'Content_read':
          include 'Content/index.php';
          break;
        case 'Content_update':
          include 'Content/update.php';
          break;
        case 'Content_delete':
          include 'Content/delete.php';
          break;
          
          
        case 'Category_create':
          include 'Category/create.php';
          break;
        case 'Category_read':
          include 'Category/index.php';
          break;
        case 'Category_update':
          include 'Category/update.php';
          break;
        case 'Category_delete':
          include 'Category/delete.php';
          break;
          
          
          
          
        case 'Tags_create':
          include 'Tags/create.php';
          break;
        case 'Tags_read':
          include 'Tags/index.php';
          break;
        case 'Tags_update':
          include 'Tags/update.php';
          break;
        case 'Tags_delete':
          include 'Tags/delete.php';
          break;
          
          
        case 'Profile_create':
          include 'Profile/create.php';
          break;
        case 'Profile_read':
          include 'Profile/index.php';
          break;
        case 'Profile_update':
          include 'Profile/update.php';
          break;
        case 'Profile_delete':
          include 'Profile/delete.php';
          break;
          
          
        case 'Author_create':
          include 'Author/create.php';
          break;
        case 'Author_read':
          include 'Author/index.php';
          break;
        case 'Author_update':
          include 'Author/update.php';
          break;
        case 'Author_delete':
          include 'Author/delete.php';
          break;
          
          
        case 'Images_create':
          include 'Images/create.php';
          break;
        case 'Images_read':
          include 'Images/index.php';
          break;
        case 'Images_update':
          include 'Images/update.php';
          break;
        case 'Images_delete':
          include 'Images/delete.php';
          break;
          
        default:
          include '../layouts/main_section.php';
          break;
      }
  } else {
    include '../layouts/main_section.php';
  }
 ?>

<?php require_once '../layouts/footer.php'; ?>
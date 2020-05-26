<?php 
	include '../lib/Session.php';
	Session::checkSession()
?>
<?php include '../config/config.php';?>
<?php include '../lib/Database.php';?>
<?php 
$db = new Database();
?>


<?php
    if(!isset($_GET['delpage']) || $_GET['delpage']==null){
        echo "<script>window.location = 'index.php';</script>";

    }else{
        $pageid = $_GET['delpage'];
        $delquery = "delete from tbl_page where id='$pageid'";
        $deldata  = $db->delete($delquery);
        if($deldata){
            echo "<sript>alert('Page deleted successfully.');</script>";
            echo "<sript>window.location = 'index.php';</script>";
        }else{
            echo "<sript>alert('Page Not deleted !.');</script>";
            echo "<sript>window.location = 'index.php';</script>";
        }
    }
    
    ?> 
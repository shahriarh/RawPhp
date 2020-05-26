<?php 
	include '../lib/Session.php';
	Session::checkSession()
?>
<?php include '../config/config.php';?>
<?php include '../lib/Database.php';?>
<?php include '../helpers/Format.php';?>
<?php 
$db = new Database();
?>


<?php
    if(!isset($_GET['delpostid']) || $_GET['delpostid']==null){
        echo "<script>window.location = 'postlist.php';</script>";

    }else{
        $postid = $_GET['delpostid'];
        $query = "select * from tbl_post where id='$postid'";
        $getdata = $db->select($query);
        if($getdata){
            while($delimg=$getdata->fetch_assoc()){
                $dellink = $delimg['image'];
                unlink($dellink);
            }

        }
        $delquery = "delete from tbl_post where id='$postid'";
        $deldata  = $db->delete($delquery);
        if($deldata){
            echo "<sript>alert('Data deleted successfully.');</script>";
            echo "<sript>window.location = 'postlist.php';</script>";
        }else{
            echo "<sript>alert('Data Not deleted !.');</script>";
            echo "<sript>window.location = 'postlist.php';</script>";
        }
    }
    ?> 
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Social Media</h2>

    
                <?php
             if($_SERVER['REQUEST_METHOD']=='POST'){
                $fb = $fm->validation($_POST['fb']);
                $ln = $fm->validation($_POST['ln']);
                $tw = $fm->validation($_POST['tw']);
                $gp = $fm->validation($_POST['gp']);

                $fb = mysqli_real_escape_string($db->link,$fb);
                $ln = mysqli_real_escape_string($db->link,$ln);
                $tw = mysqli_real_escape_string($db->link,$tw);
                $gp = mysqli_real_escape_string($db->link,$gp);
                
                if($fb == "" || $ln == "" || $tw == "" || $gp == "" ){
                    echo "<span class='error'>Field must not be empty!</span>";
            }else{ 
                $query = "update tbl_social
                SET
                fb  ='$fb',
                ln   ='$ln',
                tw   ='$tw',
                gp   ='$gp'
                where id='1'";

                $updated_row = $db->update($query);
                if ($updated_row) {
                    echo "<span class='success'>Post Updated Successfully.
                    </span>";
                }else {
                    echo "<span class='error'>Post Not Updated !</span>";
                }
                        
                        }

                    }

                ?>





                <div class="block">   
                <?php
                    $query = "select * from tbl_social where id='1'";
                    $social_media = $db->select($query);
                    if($social_media){
                        while($result = $social_media->fetch_assoc()){
                            
                        
                ?>    

                 <form  action="" method="post">

                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="fb" value="<?php echo $result['fb'];?>" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="tw" value="<?php echo $result['tw'];?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="ln" value="<?php echo $result['ln'];?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
                                <input type="text" name="gp" value="<?php echo $result['gp'];?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php }}?>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <?php include 'inc/footer.php'?>

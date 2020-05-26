<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>

				<?php
		if(isset($_GET['pubid'])){
			$pubid = $_GET['pubid'];
			$query = "update tbl_post
					set 
					status = '1'
					where   id = '$pubid'";
			$updatedrow = $db->update($query);
			if($updatedrow){
				echo "<span class='suceess'>Post  published successfully.</span>";
			}else{
				echo "<span class='error'>Something wrong!</span>";
			}
			}
	?>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5%">No</th>
							<th width="10%">Post Title</th>
							<th width="20%">Description</th>
							<th width="10%">Category</th>
							<th width="10%">Image</th>
							<th width="10%">Author</th>
							<th width="10%">Tags</th>
							<th width="10%">Date</th>
							<th width="10%">Action</th>
						<?php if(Session::get('userRole')=="0"){ ?>
							<th width="5%">Draft</th>
						<?php }?>	
						</tr>
					</thead>
					<tbody>

				<?php $query = "select tbl_post.*,tbl_category.name from tbl_post
								inner join tbl_category
								on tbl_post.cat = tbl_category.id
								order by tbl_post.title
								";

						$post = $db->select($query);
						if($post){
							$i = 0;
							while($result = $post->fetch_assoc()){
							$i++;		
							

								
				?>	
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['title']; ?></td>
							<td><?php echo $fm->textShorten($result['body'],50); ?></td>
							<td><?php echo $result['name']; ?></td>
							<td><img src="<?php echo $result['image']; ?>"height="40px" weight="60px"/></td>
							<td><?php echo $result['author']; ?></td>
							<td><?php echo $result['tags']; ?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td>

								<a href="viewpost.php?viewpostid=<?php echo $result['id']; ?>">View</a> 
						<?php
							If(Session::get('userId') == $result['userid'] || Session::get('userRole') =='0'){ 
						?>		
									||<a href="editpost.php?editpostid=<?php echo $result['id']; ?>">Edit</a> ||	
									<a onclick="return confirm('Are you sure to delete')"; href="deletepost.php?delpostid=<?php echo $result['id']; ?>">Delete</a>
							
						
						<?php }?>			
							 
							
							</td>
							<td>
							<?php
								if(Session::get('userRole') =='0'){

								

							?>
								<a onclick="return confirm('Are you sure to publish this post!');" href="?pubid=<?php echo $result['id'];?>">Publish</a>
								<a onclick="return confirm('Are you sure to unpublish this post!');" href="?unpubid=<?php echo $result['id'];?>">Unpublish</a>
							<?php }?>
							</td>
							
						</tr>
					<?php }}?>	
					</tbody>
				</table>
	
               </div>
            </div>


								

        </div>
       
	<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
			setSidebarHeight();
        });
    </script>
    <?php include 'inc/footer.php'?>
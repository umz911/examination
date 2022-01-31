<!DOCTYPE html>
<html lang="en">
<?php 
	require "head.php";
	require ('db.php');
	$obj->is_logged_in();
	
	if (isset($_GET['id'])){
		$id 	   = $_GET['id'];
		$classes   = $obj->get_class($id);
		if(!($classes)){
			header("location:classes.php");
		}			
	}
?>
<body>
	<div class="wrapper">
		<div class="main-header" data-background-color="purple">
			<?php require "logo_header.php";?>
			<?php require "nav_bar.php";?>
		</div>
		<?php require "sidebar.php";?>
			<div class="main-panel">
				<div class="content">
					<div class="page-inner">
						<div class="page-header">
							<h4 class="page-title">Edit Class</h4>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<div class="d-flex align-items-center">
											<h4 class="card-title">Edit Class</h4>
											<a href="classes.php" class="btn btn-primary btn-round ml-auto"><i class="fas fa-chevron-left"></i></a>
										</div>
									</div>
									<div class="card-body">
										<form action="process.php" method="POST">
											<div class="form-group">
												<input type="hidden"  name = "id" value = "<?php echo $classes['id'];?>">

												<label for="cls_name">Class name</label>
												<input type="text" class="form-control" name = "cls_name" value = "<?php echo $classes['cls_name'];?>" id="cls_name" placeholder="Class Name" required  minlength="6" maxlength="15" size="15">
											</div>
										</form>
									</div>
									<div  class="card-footer" style="text-align: center;">
										<button type="submit" name="submit_btn" value="update_class" class="btn btn-primary btn-lg">Submit</button>
									</div>
								</div>	
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>

<?php require "footbar.php";?>
</body>
</html>
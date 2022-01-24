<!DOCTYPE html>
<html lang="en">
<?php 
	  require ("head.php");
	  require ('db.php');
	  $obj->is_logged_in();
?>
<body>
	<div class="wrapper">
		<div class="main-header" data-background-color="purple">
		<?php require "logo_header.php";?>
		<?php require "nav_bar.php";?>
		</div>
		<?php require "sidebar.php";?>
		<form action="process.php" method="POST">
			<div class="main-panel">
				<div class="content">
					<div class="page-inner">
						<div class="page-header">
							<h4 class="page-title">Add New Class</h4>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<div class="d-flex align-items-center">
											<h4 class="card-title">New Class</h4>
											<a href="classes.php" class="btn btn-primary btn-round ml-auto"><i class="fas fa-chevron-left"></i></a>
										</div>
									</div>
									<div class="card-body">
										<div class="form-group">
											<label for="cls_name">Class Name</label>
											<input type="name" class="form-control" name = "cls_name" id="cls_name" placeholder=" cls_name">
										</div>
										<div class="form-group">
											<button type="submit" name="submit_btn" value="add_class" class="btn btn-primary btn-lg">Submit</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>	
			</div>			
		</form>
	</div>
<?php require "footbar.php";?>
</body>
</html>
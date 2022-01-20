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
		
		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Update Student</h4>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Update Student</h4>
										<a href="students.php" class="btn btn-primary btn-round ml-auto"><i class="fas fa-chevron-left"></i></a>
									</div>
								</div>
								<form action="process_update.php" method="POST">
									<div class="card-body">
										<div class="form-group">
											<label for="fname">First Name</label>
											<input type="text" class="form-control" name = "fname" id="fname" placeholder="First Name">
										</div>
										<div class="form-group">
											<label for="email">Email Address</label>
											<input type="email" class="form-control" name = "email" id="email" placeholder="Email Address">
										</div>
										<div class="form-group">
											<label for="class">Class</label>
											<input type="text" class="form-control" name = "class" id="class" placeholder="class">
										</div>
										<button type="submit" name="sub" value="submit" class="btn btn-primary btn-lg">Submit</button>
									</div>	
								</form>
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
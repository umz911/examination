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
							<h4 class="page-title">Add New Teacher</h4>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<div class="d-flex align-items-center">
											<h4 class="card-title">New Teacher</h4>
											<a href="teachers.php" class="btn btn-primary btn-round ml-auto"><i class="fas fa-chevron-left"></i></a>
										</div>
									</div>
									<div class="card-body">
										<div class="form-group">
											<label for="fname">First Name</label>
											<input type="text" class="form-control" name = "fname" id="fname">
										</div>
										<div class="form-group">
											<label for="lname">Last Name</label>
											<input type="lname" class="form-control" name = "lname" id="lname">
										</div>
										<div class="form-group">
											<label for="qualification">qualification</label>
											<input type="text" class="form-control" name = "qualification" id="qualification">
										</div>
										<div class="form-group">
										<label for="gender">Gender</label>
										<select class="form-select form-select-sm">
											<option value="0">Female</option>
											<option value="1">Male</option>
											<option value="2">Other</option>
										</select>		
										</div>
										<div class="form-group">
											<label for="phone_no">phone_no</label>
											<input type="tel:" class="form-control" name = "phone_no" id="phone_no">
										</div>
										<div class="form-group">
											<label for="address">address</label>
											<input type="textarea" class="form-control" name = "address" id="address">
										</div>
										<div class="form-group">
											<label for="subject_id">subject_id</label>
											<input type="number" class="form-control" name = "subject_id" id="subject_id">
										</div>
										<div class="form-group">
											<label for="class_id">class_id</label>
											<input type="number" class="form-control" name = "class_id" id="class_id">
										</div>
										<div class="form-group">
											<label for="salary">Salary</label>
											<input type="number" class="form-control" name = "salary" id="salary">
										</div>
										<button type="submit" name="submit_btn" value="add_teacher" class="btn btn-primary btn-lg">Submit</button>
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
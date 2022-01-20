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
							<h4 class="page-title">Add New Student</h4>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<div class="d-flex align-items-center">
											<h4 class="card-title">New Student</h4>
											<a href="students.php" class="btn btn-primary btn-round ml-auto"><i class="fas fa-chevron-left"></i></a>
										</div>
									</div>
									<div class="card-body">
										<div class="form-group">
											<label for="fname">First Name</label>
											<input type="text" class="form-control" name = "fname" id="fname" placeholder=" fname">
										</div>
										<div class="form-group">
											<label for="lname">Last Name</label>
											<input type="lname" class="form-control" name = "lname" id="lname" placeholder=" lname">
										</div>
										<div class="form-group">
											<label for="fees">Fees</label>
											<input type="text" class="form-control" name = "fees" id="fees" placeholder="fees">
										</div>
										<div class="form-group">
											<label for="date_of_birth">Date_of_Birth</label>
											<input type="date" class="form-control" name = "date_of_birth" id="fees" placeholder="date_of_birth">
										</div>
										<div class="form-group">
											<label for="date_of_admission">Date_of_admission</label>
											<input type="date" class="form-control" name = "date_of_admission" id="date_of_admission" placeholder="date_of_admission">
										</div>
										<div class="form-group">
											<label for="qualification">Qualification</label>
											<input type="text" class="form-control" name = "qualification" id="qualification" placeholder="qualification">
										</div>
										<div class="form-group">
											<label for="age">Age</label>
											<input type="number" class="form-control" name = "age" id="age" placeholder="age">
										</div>
										<div class="form-group">
											<label for="gender">Gender</label>
											<input type="text" class="form-control" name = "gender" id="gender" placeholder="gender">
										</div>
										<div class="form-group">
											<label for="martial_status">Martial Status</label>
											<input type="text" class="form-control" name = "martial_status" id="martial_status" placeholder="martial_status">
										</div>
										<div class="form-group">
											<label for="phone_no">Phone Number</label>
											<input type="tel" class="form-control" name = "phone_no" id="phone_no" placeholder="phone_no">
										</div>
										<div class="form-group">
											<label for="address">Address</label>
											<input type="textarea" class="form-control" name = "address" id="address" placeholder="address">
										</div>
										<button type="submit" name="submit_btn" value="add_student" class="btn btn-primary btn-lg">Submit</button>
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
<!DOCTYPE html>
<html lang="en">
<?php 
	require "head.php";
	require ('db.php');
	$obj->is_logged_in();
	
	if (isset($_GET['id'])){
		$id 	   = $_GET['id'];
		$student   = $obj->get_student($id);
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
							<h4 class="page-title">Edit Student</h4>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<div class="d-flex align-items-center">
											<h4 class="card-title">Edit Student</h4>
											<a href="students.php" class="btn btn-primary btn-round ml-auto"><i class="fas fa-chevron-left"></i></a>
										</div>
									</div>
									<div class="card-body">

										<form action="process.php" method="POST">
											<div class="form-group">
												<input type="hidden"  name = "id" value = "<?php echo $student['id'];?>">

												<label for="fname">First Name</label>
												<input type="text" class="form-control" name = "fname" value = "<?php echo $student['fname'];?>" id="fname" placeholder="First Name">
											</div>
											<div class="form-group">
												<label for="lname">Last Name</label>
												<input type="lname" class="form-control" name = "lname"  value = "<?php echo $student['lname'];?>" id="lname" placeholder="Email Address">
											</div>
											<div class="form-group">
												<label for="fees">Fees</label>
												<input type="text" class="form-control" name = "fees"  value = "<?php echo $student['fees'];?>" id="fees" placeholder="fees">
											</div>
											<div class="form-group">
												<label for="date_of_birth">date_of_birth</label>
												<input type="date" class="form-control" name = "date_of_birth"  value = "<?php echo $student['date_of_birth'];?>" id="date_of_birth" placeholder="date_of_birth">
											</div>
											<div class="form-group">
												<label for="date_of_admission">date_of_admission</label>
												<input type="date" class="form-control" name = "date_of_admission"  value = "<?php echo $student['date_of_admission'];?>" id="date_of_admission" placeholder="date_of_admission">
											</div>
											<div class="form-group">
												<label for="qualification">qualification</label>
												<input type="text" class="form-control" name = "qualification"  value = "<?php echo $student['qualification'];?>" id="qualification" placeholder="qualification">
											</div>
											<div class="form-group">
												<label for="age">age</label>
												<input type="number" class="form-control" name = "age"  value = "<?php echo $student['age'];?>" id="age" placeholder="age">
											</div>
											<div class="form-group">
												<label for="gender">gender</label>
												<input type="text" class="form-control" name = "gender"  value = "<?php echo $student['gender'];?>" id="gender" placeholder="gender">
											</div>
											<div class="form-group">
												<label for="martial_status">martial_status</label>
												<input type="text" class="form-control" name = "martial_status"  value = "<?php echo $student['martial_status'];?>" id="martial_status" placeholder="martial_status">
											</div>
											<div class="form-group">
												<label for="phone_no">phone_no</label>
												<input type="tel" class="form-control" name = "phone_no"  value = "<?php echo $student['phone_no'];?>" id="phone_no" placeholder="phone_no">
											</div>
											<div class="form-group">
												<label for="address">address</label>
												<input type="text" class="form-control" name = "address"  value = "<?php echo $student['address'];?>" id="address" placeholder="address">
											</div>																													
											<button type="submit" name="submit_btn" value="update_student" class="btn btn-primary btn-lg">Submit</button>
									</form>
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
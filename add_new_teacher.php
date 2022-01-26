<!DOCTYPE html>
<html lang="en">
<?php 
	  require ("head.php");
	  require ('db.php');
	  $obj->is_logged_in();
	  $data  = $obj->fetch_qualifications();
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
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="fname">First Name</label>
												<input type="text" class="form-control" name = "fname" id="fname" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="lname">Last Name</label>
												<input type="lname" class="form-control" name = "lname" id="lname" required>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="qualification">Qualification</label>
													<select name="qualification" id="qualification" class="form-control" required>
														<option selected=" " disabled=" ">Please Select</option>
														<?php foreach ($data as $key => $value) { ?>
														<option value="<?php echo $value['name']?>"><?php echo ucwords($value['name'])?> </option>
														<?php }?>
													</select>
										<!-- 		<input type="name" class="form-control" name = "qualification" id="qualification" placeholder="qualification"> -->
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="gender">Gender</label>
												<select type="number" class="form-control" name = "gender" id="gender" required>
													<option selected=" " disabled=" ">Please Select</option>
													<option value="0">Male</option>
													<option value="1">Female</option>
													<option value="2">Other</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label for="subject_id">Subject Id</label>
												<input type="number" class="form-control" name = "subject_id" id="subject_id" required>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="salary">Salary</label>
												<input type="number" class="form-control" name = "salary" id="salary" required>
											</div>
										</div>										
										<div class="col-md-3">
											<div class="form-group">
												<label for="class_id">Class Id</label>
												<input type="number" class="form-control" name = "class_id" id="class_id" required>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="phone_no">Phone_no</label>
												<input type="tel:" class="form-control" name = "phone_no" id="phone_no" required>
											</div>
										</div>										
									</div>								
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="address">Address</label>
												<textarea type="text" class="form-control" name = "address" id="address" required></textarea>
											</div>
										</div>										
									</div>
									<div class="card-footer" style="text-align: center;">
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
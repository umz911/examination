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
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="fname">First name <span class="text-danger">*</span> </label>
													<input type="text" class="form-control" name = "fname" id="fname" required placeholder="First name">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="lname">Last name <span class="text-danger">*</span> </label>
													<input type="text" class="form-control" name = "lname" id="lname"  required placeholder="Last name">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="date_of_admission">Date of admission <span class="text-danger">*</span> </label>
													<input type="date" class="form-control" name = "date_of_admission" id="Date of admission" required>
												</div>												
											</div>											
											<div class="col-md-6">
												<div class="form-group">
													<label for="date_of_birth">Date of birth <span class="text-danger">*</span> </label>
													<input type="date" class="form-control" name = "date_of_birth" id="Date of birth" required>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="qualification">Qualification <span class="text-danger">*</span> </label>
														<select name="qualification" id="qualification" class="form-control" required>
															<option selected disabled value="">--- Please select ---</option>
															<?php foreach ($data as $key => $value) { ?>
															<option value="<?php echo $value['name']?>"><?php echo ucwords($value['name'])?> </option>
															<?php }?>
														</select>
											<!-- 		<input type="name" class="form-control" name = "qualification" id="qualification" placeholder="qualification"> -->
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="gender">Gender <span class="text-danger">*</span> </label>
													<select type="number" class="form-control" name = "gender" id="gender" required>
														<option selected disabled value="">--- Please select ---</option>
														<option value="1">Male</option>
														<option value="2">Female</option>
														<option value="3">Other</option>
													</select>
													<!-- <input type="number" class="form-control" name = "gender" id="gender" placeholder="gender"> -->
												</div>												 
											</div>					
										</div>	
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label for="age">Age <span class="text-danger">*</span> </label>
													<input type="number" class="form-control" name = "age" min="2" max="16" id="age" required placeholder="Enter age">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label for="fees">Fees <span class="text-danger">*</span> </label>
													<input type="number" class="form-control" name = "fees" min="1000" id="fees" required placeholder="Enter fees">
												</div>												
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label for="martial_status">Martial status <span class="text-danger">*</span> </label>
													<select type="number" class="form-control" name = "martial_status" id="martial_status" required>
														<option selected disabled value="">--- Please select ---</option>
														<option value="1">Single</option>
														<option value="2">Married</option>
														<option value="3">Divorced</option>
													</select>
											<!-- 		<input type="name" class="form-control" name = "martial_status" id="martial_status" placeholder="martial_status"> -->
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label for="phone_no">Phone number <span class="text-danger">*</span> </label>
													<input type="tel" class="form-control" name = "phone_no" id="phone_no" pattern=".{11}"  required placeholder="Enter phone number">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="address">Address <span class="text-danger">*</span> </label>
													<textarea class="form-control" name = "address" id="address" placeholder="Address"  required maxlength="50"></textarea>
													<!-- <input type="textarea" class="form-control" name = "address" id="address" placeholder="address"> -->
												</div>												
											</div>											
										</div>
										<div class="card-footer" style="text-align: center;">
											<button type="submit" name="submit_btn" value="add_student" class="btn btn-primary btn-lg">Submit</button>
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
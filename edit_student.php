<!DOCTYPE html>
<html lang="en">
<?php 
	require "head.php";
	require ('db.php');
	$obj->is_logged_in();
	$data  = $obj->fetch_qualifications();
	
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
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<input type="hidden"  name = "id" value = "<?php echo $student['id'];?>">

														<label for="fname">First Name</label>
														<input type="text" class="form-control" name = "fname" value = "<?php echo $student['fname'];?>" id="fname" placeholder="First Name" required>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="lname">Last Name</label>
														<input type="lname" class="form-control" name = "lname"  value = "<?php echo $student['lname'];?>" id="lname" required>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="date_of_admission">Date_of_Admission</label>
														<input type="date" class="form-control" name = "date_of_admission"  value = "<?php echo $student['date_of_admission'];?>" id="date_of_admission" placeholder="date_of_admission" required>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="date_of_birth">Date_of_Birth</label>
														<input type="date" class="form-control" name = "date_of_birth"  value = "<?php echo $student['date_of_birth'];?>" id="date_of_birth" placeholder="date_of_birth" required>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="qualification">Qualification</label>
														<select name="qualification" id="qualification" class="form-control" required>
															<!-- <option>Please Select</option> -->
															<?php foreach ($data as $key => $value) { ?>

															<?php if($value['name'] == $student['qualification']){?>

																<option selected value="<?php echo $value['name']?>"><?php echo ucwords($value['name'])?> </option>
															<?php }else{ ?>
																<option value="<?php echo $value['name']?>"><?php echo ucwords($value['name'])?> </option>
															<?php }?>

															<?php }?>
														</select>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="gender">Gender</label>
														<select type="number" class="form-control" name = "gender" id="gender" required>

															<!-- <option>Please Select</option> -->
															<?php if($student['gender'] == 1){?>
																
																<option value="1" selected>Male</option>
																<option value="2">Female</option>
																<option value="3">Other</option>

															<?php }else  if($student['gender'] == 2){?>
																<option value="1" >Male</option>
																<option value="2"selected>Female</option>
																<option value="3">Other</option>
															<?php }else{?>

																<option value="1" >Male</option>
																<option value="2">Female</option>
																<option value="3" selected>Other</option>
															<?php }?>
														</select>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-3">
													<div class="form-group">
														<label for="age">Age</label>
														<input type="number"  class="form-control" name = "age" min="2" value = "<?php echo $student['age'];?>" id="age" placeholder="age" required>

													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label for="fees">Fees</label>
														<input type="number" min="1000" class="form-control" name = "fees"  value = "<?php echo $student['fees'];?>" id="fees" placeholder="fees" required>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label for="martial_status">Martial Status</label>
														<select type="name" class="form-control" name = "martial_status" id="martial_status" required>
															<!-- <option>Please Select</option> -->
															<?php if($student['martial_status'] == 1){?>
																
																<option value="1" selected>Single</option>
																<option value="2">Married</option>
																<option value="3">Divorced</option>

															<?php }else  if($student['martial_status'] == 2){?>
																<option value="1" >Single</option>
																<option value="2"selected>Married</option>
																<option value="3">Divorced</option>
															<?php }else{?>

																<option value="1" >Single</option>
																<option value="2">Married</option>
																<option value="3" selected>Divorced</option>
															<?php }?>
														</select>													
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label for="phone_no">Phone Number</label>
														<input type="tel" class="form-control" name = "phone_no"  value = "<?php echo $student['phone_no'];?>" id="phone_no" placeholder="phone_no" required>
													</div>
												</div>						
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="address">Address</label>
														<input type="text" class="form-control" name = "address"  value = "<?php echo ucwords($student['address']);?>" id="address" placeholder="address" required></input>
													</div>
												</div>
											</div>
											<div class="card-footer" style="text-align: center;">
												<button type="submit" name="submit_btn" value="update_student" class="btn btn-primary btn-lg">Submit</button>  
											</div>
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
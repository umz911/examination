<!DOCTYPE html>
<html lang="en">
<?php 
	require "head.php";
	require ('db.php');
	$obj->is_logged_in();
	$data  = $obj->fetch_qualifications();

	
	if (isset($_GET['id'])){
		$id 	   = $_GET['id'];
		$teacher   = $obj->get_teacher($id);
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
							<h4 class="page-title">Edit Teacher</h4>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<div class="d-flex align-items-center">
											<h4 class="card-title">Edit Teacher</h4>
											<a href="teachers.php" class="btn btn-primary btn-round ml-auto"><i class="fas fa-chevron-left"></i></a>
										</div>
									</div>
									<div class="card-body">
										<form action="process.php" method="POST">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<input type="hidden"  name = "id" value = "<?php echo $teacher['id'];?>">
														<label for="fname">First Name</label>
														<input type="text" class="form-control" name = "fname" value = "<?php echo $teacher['fname'];?>" id="fname" placeholder="First Name">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="lname">Last Name</label>
														<input type="lname" class="form-control" name = "lname"  value = "<?php echo $teacher['lname'];?>" id="lname" placeholder="Email Address">
													</div>												
												</div>												
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="qualification">Qualification</label>
														<select name="qualification" id="qualification" class="form-control">
																<!-- <option>Please Select</option> -->
																<?php foreach ($data as $key => $value) { ?>

																<?php if($value['name'] == $teachers['qualification']){?>

																	<option selected value="<?php echo $value['name']?>"><?php echo ucwords($value['name'])?> </option>
																<?php }else{ ?>
																	<option value="<?php echo $value['name']?>"><?php echo ucwords($value['name'])?> </option>S
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
															<?php if($teachers['gender'] == 0){?>
																
																<option value="0" selected>Male</option>
																<option value="1">Female</option>
																<option value="2">Other</option>

															<?php }else  if($teachers['gender'] == 1){?>
																<option value="0" >Male</option>
																<option value="1"selected>Female</option>
																<option value="2">Other</option>
															<?php }else{?>

																<option value="0" >Male</option>
																<option value="1">Female</option>
																<option value="2" selected>Other</option>
															<?php }?>
														</select>
													</div>													
												</div>
											</div>
											<div class="row">
												<div class="col-md-3">
													<div class="form-group">
														<label for="subject_id">Subject Id</label>
														<input type="number" class="form-control" name = "subject_id"  value = "<?php echo $teacher['subject_id'];?>" id="subject_id" placeholder="subject_id">
													</div>													
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label for="salary">Salary</label>
														<input type="number" class="form-control" name = "salary"  value = "<?php echo $teacher['salary'];?>" id="salary" placeholder="salary">
													</div>													
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label for="class_id">Class Id</label>
														<input type="number" class="form-control" name = "class_id"  value = "<?php echo $teacher['class_id'];?>" id="class_id" placeholder="class_id">
													</div>													
												</div>												
												<div class="col-md-3">
													<div class="form-group">
														<label for="phone_no">Phone_no</label>
														<input type="tel" class="form-control" name = "phone_no"  value = "<?php echo $teacher['phone_no'];?>" id="phone_no" placeholder="phone_no">
													</div>													
												</div>												
											</div>												

											<div class="form-group">
												<label for="address">Address</label>
												<input type="text" class="form-control" name = "address"  value = "<?php echo $teacher['address'];?>" id="address" placeholder="address">
											</div>																							
											<button type="submit" name="submit_btn" value="update_teacher" class="btn btn-primary btn-lg">Submit</button>
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
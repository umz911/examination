<!DOCTYPE html>
<html lang="en">
<?php 
	require "head.php";
	require ('db.php');
	$obj->is_logged_in();
	$data   = $obj->fetch_qualifications();
	$sub    = $obj->fetch_subjects();
	$class  = $obj->fetch_class();


	
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
														<label for="fname">First name <span class="text-danger">*</span> </label>
														<input type="text" class="form-control" name = "fname" value = "<?php echo ucwords($teacher['fname']);?>" id="fname" placeholder="First name" required>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="lname">Last name <span class="text-danger">*</span></label>
														<input type="text" class="form-control" name = "lname"  value = "<?php echo ucwords($teacher['lname']);?>" id="lname" placeholder="Last name" required>
													</div>												
												</div>												
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="qualification">Qualification <span class="text-danger">*</span></label>
														<select name="qualification" id="qualification" class="form-control" required>
																<option selected disabled value="">--- Please select ---</option>					
																<?php foreach ($data as $key => $value) { ?>
																<?php if($value['name'] == $teacher['qualification']){?>

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
														<label for="gender">Gender <span class="text-danger">*</span> </label>
														<select type="number" class="form-control" name = "gender" id="gender" required>
															<option selected disabled value="">--- Please select ---</option>
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
														<label for="subject">Subject <span class="text-danger">*</span> </label>
														<select name="subject" id="subject"  class="form-control" required>
															<option selected disabled value="">--- Please select ---</option>
															<?php foreach ($sub as $key => $value) { ?>
															<?php if($value['subject_name'] == $teacher['subject']){?>
																<option selected value="<?php echo $value['subject_name']?>"><?php echo ucwords($value['subject_name'])?> </option>
															<?php }else{ ?>
																<option value="<?php echo $value['subject_name']?>"><?php echo ucwords($value['subject_name'])?> </option>
															<?php }?>

															<?php }?>
														</select>
													</div>													
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label for="salary">Salary <span class="text-danger">*</span></label>
														<input type="number" class="form-control" name = "salary"  value = "<?php echo $teacher['salary'];?>" id="salary" placeholder="Enter salary" required min="15000" >
													</div>													
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label for="class_name">Class<span class="text-danger">*</span> </label>
														<select name="class_name" id="class_name"  class="form-control" required>
															<option selected disabled value="">--- Please select ---</option>
															<?php foreach ($class as $key => $value) { ?>
															<?php if($value['cls_name'] == $teacher['class_name']){?>
																<option selected value="<?php echo $value['cls_name']?>"><?php echo ucwords($value['cls_name'])?> </option>
															<?php }else{ ?>
																<option value="<?php echo $value['cls_name']?>"><?php echo ucwords($value['cls_name'])?> </option>
															<?php }?>

															<?php }?>
														</select>
													</div>													
												</div>												
												<div class="col-md-3">
													<div class="form-group">
														<label for="phone_no">Phone Number <span class="text-danger">*</span></label>
														<input type="tel" class="form-control" name = "phone_no"  value = "<?php echo $teacher['phone_no'];?>" id="phone_no" pattern=".{11}" placeholder="Enter phone number">
													</div>													
												</div>												
											</div>												

											<div class="form-group">
												<label for="address">Address <span class="text-danger">*</span> </label>
												<textarea class="form-control" name = "address" id="address"><?php echo $teacher['address'];?></textarea>
											</div>
											<div class="card-footer" style="text-align: center;">
												<button type="submit" name="submit_btn" value="update_teacher" class="btn btn-primary btn-lg">Submit</button>
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
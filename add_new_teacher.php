<!DOCTYPE html>
<html lang="en">
<?php 
	  require ("head.php");
	  require ('db.php');
	  $obj->is_logged_in();
	  $data   = $obj->fetch_qualifications();
	  $sub    = $obj->fetch_subjects();
	  $class  = $obj->fetch_class();
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
												<label for="fname">First name <span class="text-danger">*</span></label>
												<input type="text" class="form-control" name = "fname" id="fname"  required placeholder="First name">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="lname">Last name <span class="text-danger">*</span></label>
												<input type="lname" class="form-control" name = "lname" id="lname"  required placeholder="Last name">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="qualification">Qualification <span class="text-danger">*</span></label>
													<select name="qualification_id" id="qualification_id" class="form-control" required>
														<option selected disabled value="">--- Please select ---</option>
														<?php foreach ($data as $key => $value) { ?>
														<option value="<?php echo $value['id']?>"><?php echo ucwords($value['name'])?> </option>
														<?php }?>
													</select>
										<!-- 		<input type="name" class="form-control" name = "qualification" id="qualification" placeholder="qualification"> -->
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="gender">Gender <span class="text-danger">*</span></label>
												<select type="number" class="form-control" name = "gender_id" id="gender_id" required>
													<option selected disabled value="">--- Please select ---</option>
													<option value="1">Male</option>
													<option value="2">Female</option>
													<option value="3">Other</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label for="subject">Subject <span class="text-danger">*</span></label>
													<select name="subject_id" id="subject_id"  class="form-control" required>
														<option selected disabled value="">--- Please select ---</option>
														<?php foreach ($sub as $key => $value) { ?>
														<option value="<?php echo $value['id']?>"><?php echo ucwords($value['subject_name'])?> </option>
														<?php }?>
													</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="salary">Salary <span class="text-danger">*</span></label>
												<input type="number" min="15000" class="form-control" name = "salary" id="salary" required placeholder="Enter salary" required>
											</div>
										</div>										
										<div class="col-md-3">
											<div class="form-group">
												<label for="class_id">Class <span class="text-danger">*</span></label>
														<select class="form-control" name = "class_id" id="class_id" required style="padding: 0px 14px;">
														<option selected disabled value="">--- Please select ---</option>
														<?php foreach ($class as $key => $value) { ?>
														<option value="<?php echo $value['id']?>"><?php echo ucwords($value['cls_name'])?> </option>
														<?php }?>
													</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="phone_no">Phone number <span class="text-danger">*</span></label>
												<input type="tel"  class="form-control" name = "phone_no" id="phone_no" pattern="[0-9]{11}" required placeholder="+92">
											</div>
										</div>										
									</div>								
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="address">Address <span class="text-danger">*</span></label>
												<textarea type="text" class="form-control" name = "address" id="address" required placeholder="Address" required maxlength="50"></textarea>
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
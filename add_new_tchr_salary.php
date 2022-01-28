<!DOCTYPE html>
<html lang="en">
<?php 
	  require ("head.php");
	  require ('db.php');
	  $obj->is_logged_in();

	  $teachers  = $obj->fetch_teacher();
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
							<h4 class="page-title">Add New Teacher Salary</h4>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<div class="d-flex align-items-center">
											<h4 class="card-title">New Teacher Salary</h4>
											<a href="teachers_salary.php" class="btn btn-primary btn-round ml-auto"><i class="fas fa-chevron-left"></i></a>
										</div>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="teacher_id">Teachers <span class="text-danger">*</span></label>
													<select name="teacher_id" id="teacher_id" class="form-control">
														<option selected=" " disabled=" ">Please Select</option>
														<?php foreach ($teachers as $key => $value) { ?>

														<option value="<?php echo $value['id']?>"><?php echo ucwords($value['fname']) . " ". ucwords($value['lname'])?> </option>
													<?php }?>
														
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="salary">Salary <span class="text-danger">*</span></label>
													<input type="number" class="form-control" name = "salary" id="salary" placeholder=" Enter salary " readonly>
												</div>
											</div>
										</div>
										<!-- <div class="form-group">
											<label for="created_at">Created_at</label>
											<input type="date" class="form-control" name = "created_at" id="created_at" placeholder=" created_at">
										</div> -->
										<div class="card-footer" style="text-align: center;">
											<div class="form-group">
												<button type="submit" name="submit_btn" value="add_tchr_salary" class="btn btn-primary btn-lg">Submit</button>
											</div>
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
	<script type="text/javascript">
		$(document).ready(function (){
			$('#teacher_id').change(function (){
				var teacher_id = $('#teacher_id').val();
				$.ajax({
					type: "POST",
					url: "request.php",
					data:{
						id  : teacher_id,
						fn  :'fetch_tchr_salary_by_id'
					},
					success: function (result){
						var res = $.parseJSON(result);
						$('#salary').val(res.salary)
					}
				});
			})
		})
	</script>	
<?php require "footbar.php";?>
</body>
</html>
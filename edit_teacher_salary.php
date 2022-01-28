<!DOCTYPE html>
<html lang="en">
<?php 
	require "head.php";
	require ('db.php');
	$obj->is_logged_in();
	$teachers  = $obj->fetch_teacher();


	
	if (isset($_GET['id'])){
		$id 	          = $_GET['id'];
		$teacher_salary   = $obj->get_tchr_salary($id);
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
							<h4 class="page-title">Edit Teacher Salary</h4>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<div class="d-flex align-items-center">
											<h4 class="card-title">Edit Teacher Salary</h4>
											<a href="teachers_salary.php" class="btn btn-primary btn-round ml-auto"><i class="fas fa-chevron-left"></i></a>
										</div>
									</div>
									<div class="card-body">
										<form action="process.php" method="POST">
											<div class="form-group">	
												<label for="teacher_id">Teacher Name <span class="text-danger">*</span></label>
												<select name="teacher_id" id="teacher_id" class="form-control">
													<?php foreach ($teachers as $key => $value) { ?>
														
													<option value="<?php echo $value['id']?>" <?php echo $selected = ($value['id'] == $teacher_salary['teacher_id']) ? 'selected': ''; ?>><?php echo ucwords($value['fname']) . " ". ucwords($value['lname'])?> </option>
													<?php }?>
												</select>
											</div>
											<div class="form-group">
												<label for="salary">Salary <span class="text-danger">*</span></label>
												<input type="text" class="form-control" name = "salary" value = "<?php echo $teacher_salary['salary'];?>" id="salary" placeholder="salary" readonly>
											</div>
											<div class="card-footer" style="text-align: center;">
												<button type="submit" name="submit_btn" value="update_tchr_salary" class="btn btn-primary btn-lg">Submit</button>
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
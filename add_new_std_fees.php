<!DOCTYPE html>
<html lang="en">
<?php 
	  require ("head.php");
	  require ('db.php');
	  $obj->is_logged_in();

	  $students  = $obj->fetch_student();
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
							<h4 class="page-title">Add New Student Fees</h4>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<div class="d-flex align-items-center">
											<h4 class="card-title">New Student Fees</h4>
											<a href="student_fees.php" class="btn btn-primary btn-round ml-auto"><i class="fas fa-chevron-left"></i></a>
										</div>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="std_id">Students <span class="text-danger">*</span></label>
													<select name="std_id" id="std_id" class="form-control" required>
														<option selected disabled value="">--- Please select ---</option>
														<?php foreach ($students as $key => $value) { ?>
														<option value="<?php echo $value['id']?>"><?php echo ucwords($value['fname']) . " ". ucwords($value['lname'])?> </option>
														<?php }?>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="fees">Fees <span class="text-danger">*</span></label>
													<input type="number" class="form-control" name = "fees" id="fees" placeholder=" Enter Fees" required readonly>
												</div>
											</div>
										</div>
										<!-- <div class="form-group">
											<label for="created_at">Created_at</label>
											<input type="date" class="form-control" name = "created_at" id="created_at" placeholder=" created_at">
										</div> -->
										<div class="card-footer" style="text-align: center;">
											<div class="form-group">
												<button type="submit" name="submit_btn" value="add_std_fees" class="btn btn-primary btn-lg">Submit</button>
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
			$('#std_id').change(function (){
				var std_id = $('#std_id').val();
				$.ajax({
					type: "POST",
					url: "request.php",
					data:{
						id  : std_id,
						fn  :'fetch_std_fees_by_id'
					},
					success: function (result){
						var res = $.parseJSON(result);
						$('#fees').val(res.fees)
					}
				});
			})
		})
	</script>
<?php require "footbar.php";?>
</body>
</html>
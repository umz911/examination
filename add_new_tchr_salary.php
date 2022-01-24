<!DOCTYPE html>
<html lang="en">
<?php 
	  require ("head.php");
	  require ('db.php');
	  $obj->is_logged_in();
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
										<div class="form-group">
											<label for="teacher_id">Teacher Id</label>
											<input type="number" class="form-control" name = "teacher_id" id="teacher_id" placeholder=" teacher_id">
										</div>
										<div class="form-group">
											<label for="salary">Salary</label>
											<input type="number" class="form-control" name = "salary" id="salary" placeholder=" salary">
										</div>
										<div class="form-group">
											<label for="created_at">Created_at</label>
											<input type="date" class="form-control" name = "created_at" id="created_at" placeholder=" created_at">
										</div>																				
										<div class="form-group">
											<button type="submit" name="submit_btn" value="tchr_salary" class="btn btn-primary btn-lg">Submit</button>
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
<!DOCTYPE html>
<html lang="en">
<?php 
	require "head.php";
	require ('db.php');
	$obj->is_logged_in();
	
	if (isset($_GET['id'])){
		$id 	          = $_GET['id'];
		$student_fees     = $obj->get_std_fees($id);
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
							<h4 class="page-title">Edit Student Fees</h4>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<div class="d-flex align-items-center">
											<h4 class="card-title">Edit Student Fees</h4>
											<a href="student_fees.php" class="btn btn-primary btn-round ml-auto"><i class="fas fa-chevron-left"></i></a>
										</div>
									</div>
									<div class="card-body">
										<form action="process.php" method="POST">
											<div class="form-group">
												<input type="hidden"  name = "id" value = "<?php echo $student_fees['id'];?>">

												<label for="std_id">Student Id</label>
												<input type="text" class="form-control" name = "std_id" value = "<?php echo $student_fees['std_id'];?>" id="std_id" placeholder="std_id">
											</div>
											<div class="form-group">
												<label for="fees">Fees</label>
												<input type="text" class="form-control" name = "fees" value = "<?php echo $student_fees['fees'];?>" id="fees" placeholder="fees">
											</div>
											<div class="form-group">
												<label for="created_at">Created_at</label>
												<input type="text" class="form-control" name = "created_at" value = "<?php echo $student_fees['created_at'];?>" id="created_at" placeholder="created_at">
											</div>																						
											<button type="submit" name="submit_btn" value="update_std_fees" class="btn btn-primary btn-lg">Submit</button>
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

<?php require "footbar.php";?>
</body>
</html>
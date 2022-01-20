<!DOCTYPE html>
<html lang="en">
<?php 
	require "head.php";
	require ('db.php');
	$obj->is_logged_in();
		
	if (isset($_GET['id'])){
		$id 	   = $_GET['id'];
		$students  = $obj->get_student($id);
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
						<h4 class="page-title">View Student</h4>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="card">
									<div class="card-header">
										<div class="d-flex align-items-center">
											<h4 class="card-title">View Student</h4>
											<a href="students.php" class="btn btn-primary btn-round ml-auto"><i class="fas fa-chevron-left"></i></a>
										</div>
									</div>
								<div class="card-body">
									<div class="form-group">
										<label for="id"><h3>Id:</h3></label>
										<label for="id"><h3><?php echo $students['id'];?></h3></label>
									</div>
									<div class="form-group">
										<label for="fname"><h3>First Name:</h3></label>
										<label for="fname"><h3><?php echo $students['fname'];?></h3></label>
									</div>
									<div class="form-group">
										<label for="lname"><h3>Last Name:</h3></label>
										<label for="lname"><h3><?php echo $students['lname'];?></h3></label>
									</div>
									<div class="form-group">
										<label for="fees"><h3>Fees:</h3></label>
										<label for="fees"><h3><?php echo $students['fees'];?></h3></label>
									</div>
									<div class="form-group">
										<label for="date_of_birth"><h3>Date_of_Birth:</h3></label>
										<label for="date_of_birth"><h3><?php echo $students['date_of_birth'];?></h3></label>
									</div>
									<div class="form-group">
										<label for="date_of_admission"><h3>Date_of_admission:</h3></label>
										<label for="date_of_admission"><h3><?php echo $students['date_of_admission'];?></h3></label>
									</div>
									<div class="form-group">
										<label for="qualification"><h3>qualification:</h3></label>
										<label for="qualification"><h3><?php echo $students['qualification'];?></h3></label>
									</div>
									<div class="form-group">
										<label for="age"><h3>Age:</h3></label>
										<label for="age"><h3><?php echo $students['age'];?></h3></label>
									</div>
									<div class="form-group">
										<label for="gender"><h3>Gender:</h3></label>
										<label for="gender"><h3><?php echo $students['gender'];?></h3></label>
									</div>
									<div class="form-group">
										<label for="martial_status"><h3>Martial_status:</h3></label>
										<label for="martial_status"><h3><?php echo $students['martial_status'];?></h3></label>
									</div>
									<div class="form-group">
										<label for="phone_no"><h3>Phone_no:</h3></label>
										<label for="phone_no"><h3><?php echo $students['phone_no'];?></h3></label>
									</div>
									<div class="form-group">
										<label for="address"><h3>Address:</h3></label>
										<label for="address"><h3><?php echo $students['address'];?></h3></label>
									</div>			
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>		
	</div>
</body>
	<?php require "footbar.php";?>
		<script>
		$(document).ready(function() {
			$('#basic-datatables').DataTable({
			});

			$('#multi-filter-select').DataTable( {
				"pageLength": 5,
				initComplete: function () {
					this.api().columns().every( function () {
						var column = this;
						var select = $('<select class="form-control"><option value=""></option></select>')
						.appendTo( $(column.footer()).empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
								);

							column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
						} );

						column.data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					} );
				}
			});

			// Add Row
			$('#add-row').DataTable({
				"pageLength": 5,
			});

			var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

			$('#addRowButton').click(function() {
				$('#add-row').dataTable().fnAddData([
					$("#addName").val(),
					$("#addPosition").val(),
					$("#addOffice").val(),
					action
					]);
				$('#addRowModal').modal('hide');

			});
		});
	</script>
</html>
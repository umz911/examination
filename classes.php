<!DOCTYPE html>
<html lang="en">
<?php 
	require ("head.php");
	require ('db.php');
	$obj->is_logged_in();
	$classes  = $obj->fetch_class();
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
							<h4 class="page-title">Classes</h4>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<div class="d-flex align-items-center">
											<h4 class="card-title">Class</h4>
											<a href="add_new_class.php" class="btn btn-primary btn-round ml-auto"><i class="fa fa-plus"></i> Add New Class </a>
										</div>
									</div>
									<div class="card-body">
									
										<div class="table-responsive">
											<table id="add-row" class="display table table-striped table-hover" >
												<thead>
													<tr>
														<th>Id</th>
														<th>Class Name</th>
														<th style="width: 20=%">Action</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($classes as $key => $value) { ?>
													<tr>
														<td><?php echo $value['id']?></td>
														<td><?php echo $value['cls_name']?></td>
														<td>
															<a href="view_class.php?id=<?php echo $value['id']?> "class="btn btn-link"><i class="fa fa-eye"></i></a>
															<a href="edit_class.php?id=<?php echo $value['id']?>"class="btn btn-link btn-primary btn-lg"><i class="fa fa-edit"></i></a>
															<a href="process.php?id=<?php echo $value['id']?>&submit_dlt=delete_class"class="btn btn-link btn-danger"><i class="fas fa-trash"></i></a>
														</td>
													</tr>
												<?php }?>
												</tbody>
											</table>
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
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<?php 
	  require ("head.php");
	  require ('db.php');
	  $obj->is_logged_in();

?>
	<?php 
		if(isset($_GET['msg'])){ ?>
			<script>
				alert('<?php echo ($_GET['msg'])?>');
			</script>
		<?php }

	?>

<style type="text/css">
	.cus_error{
		color:red;
		font-style: italic;
		font-size: 10px;"
	}
</style>
<body>
	<div class="wrapper">
		<div class="main-header" data-background-color="purple">
			<?php require "logo_header.php";?>
			<?php require "nav_bar.php";?>
		</div>
		<?php require "sidebar.php";?>
		<form  id ="form">
			<div class="main-panel">
				<div class="content">
					<div class="page-inner">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<div class="d-flex align-items-center">
											<h4 class="card-title">Add user</h4>
											<a href="users.php" class="btn btn-primary btn-round ml-auto"><i class="fas fa-chevron-left"></i></a>
										</div>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="fname">First name <span class="text-danger">*</span> </label>
													<input type="text" class="form-control" name = "fname" id="fname" placeholder="First name" >
													<span id="fname-error" class="cus_error"></span>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="lname">Last name <span class="text-danger">*</span> </label>
													<input type="text" class="form-control" name = "lname" id="lname" placeholder="Last name">
														<span id="lname-error" class="cus_error"></span>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="username">Username <span class="text-danger">*</span> </label>
													<input type="text" class="form-control" name = "username" id="username" placeholder="Username" >
														<span id="username-error" class="cus_error"></span>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="password">Password <span class="text-danger">*</span> </label>
													<input type="password" class="form-control" name = "password" id="password"  placeholder="Password">
													<span id="password-error" class="cus_error"></span>
												</div>
											</div>
										</div>
										<div class="card-footer" style="text-align: center;">
											<a href="javascript:void(0)" name="submit_btn" id = "submit_btn" value="add_student" class="btn btn-primary btn-lg">Submit</a>
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

			function cus_message( title,mes, icon, typee){
				var content = {};
				content.message = mes;
				content.title = title;
				content.icon = icon

				$.notify(content,{
					type: typee,
					placement: {
						from: "top",
						align: "right"
					},
					time: 1000,
					delay: 1000,
				});
			}
			// validate the field in which you are typing using input ID
			function cus_validate(id){

				// console.log(($.trim($('#'+id).val())).length);



				// var len = ( ($('#'+id).val().length));
				var len = ( ($.trim($('#'+id).val()).length));


				// var len = ($.trim($('#'+id).val())).length);


				if( len <= 0){

					$('#'+id).css('border','1px solid red');
					$('#'+id).focus();
					$('#'+id).val("");

					$('#'+id+'-error').text("Please fill this field");
					return false;

				}else{
					$('#'+id).css('border','1px solid green');
					$('#'+id+'-error').text("");
					return true;

				}
			}

			// getting Id of input field in which you are typing
			$("input").focusout(function(){
				 var id = $(this).attr('id');
				 return cus_validate(id)
;	
			});

			// validate all the fields in the forms
			function validate_all_fields(){

				if( (cus_validate("fname")) && (cus_validate("lname")) && (cus_validate("username")) && (cus_validate("password"))  ){
					 	return true;
					}else{
						return false;
					}
				
			}


			$('#submit_btn').click(function (){
				// call validate_all_fields functions before submit.
				// console.log("click");
				var res =  validate_all_fields();
				if(res){
						// alert("Wow, You have entered all fields");

						$.ajax({
							type: "POST",
							url: "request.php",
							data:{
							  	data: $('#form').serialize(),
								fn  :'add_user'
							},
							success: function (result){
								// console.log("adfasdfadsf");

								var rec = $.parseJSON(result);

								if(rec.status == "success"){
									cus_message("Submitted", "Record has been submitted successfully", "fas fa-check", "success")
								}else{
									cus_message("Error", "Record has not been submitted", "fas fa-times", "danger")
								}
									
								$('#fname').val("")
								$('#lname').val("")
								$('#username').val("")
								$('#password').val("")
								// window.location.replace("users.php");
							}
						});
					}else{
						alert("Please fill all the field");
					}
			  })
		})
	</script>	
<?php require "footbar.php";?>
</body>
</html>
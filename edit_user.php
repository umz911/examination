<!DOCTYPE html>
<html lang="en">
<?php 
	require "head.php";
	require ('db.php');
	$obj->is_logged_in();
	
	if (isset($_GET['id'])){
		$id 	   = $_GET['id'];
		$user  	   = $obj->get_user($id);
		if(!($user)){
			header("location:users.php");
		}
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
							<h4 class="page-title">Edit user</h4>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<div class="d-flex align-items-center">
											<h4 class="card-title">Edit user</h4>
											<a href="users.php" class="btn btn-primary btn-round ml-auto"><i class="fas fa-chevron-left"></i></a>
										</div>
									</div>
									<div class="card-body">
										<form id ="form">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<input type="hidden"  name = "id" value = "<?php echo $user['id'];?>">
														<label for="fname">First name <span class="text-danger">*</span> </label>
														<input type="text" class="form-control" name = "fname" value = "<?php echo ucwords($user['fname']);?>" id="fname" placeholder="First name" required>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="lname">Last name <span class="text-danger">*</span></label>
														<input type="text" class="form-control" name = "lname"  value = "<?php echo ucwords($user['lname']);?>" id="lname" placeholder="Last name" required>
													</div>												
												</div>												
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<input type="hidden"  name = "id" value = "<?php echo $user['id'];?>">
														<label for="username">Username <span class="text-danger">*</span> </label>
														<input type="text" class="form-control" name = "username" value = "<?php echo ucwords($user['username']);?>" id="username" placeholder="First name" required>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="password">Last name <span class="text-danger">*</span></label>
														<input type="password" class="form-control" name = "password"  value = "<?php echo ucwords($user['password']);?>" id="password" placeholder="Last name" required>
													</div>												
												</div>												
											</div>											
  										
											<div class="card-footer" style="text-align: center;">
												<a href="javascript:void(0)" name="submit_btn" id = "submit_btn" value="update_user" class="btn btn-primary btn-lg">Submit</a>
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

			// validate the field in which you are typing using input ID
			function cus_validate(id){
				var len = ( ($('#'+id).val().length));

				if( len <= 0){
					$('#'+id).css('border','1px solid red');
					$('#'+id).focus();
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

				if( (cus_validate("fname"))  && (cus_validate("lname")) && (cus_validate("username")) && (cus_validate("password"))  ){
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
								fn  :'update_user'
							},
							success: function (result){

								var res = $.parseJSON(result);

								if(res.status == "success"){
									alert(res.msg)
								}else{
									alert(res.msg)
								}
									
								$('#fname').val("")
								$('#lname').val("")
								$('#username').val("")
								$('#password').val("")
								window.location.replace("users.php");
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
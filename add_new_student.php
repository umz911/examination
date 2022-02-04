<!DOCTYPE html>
<html lang="en">
<?php 
	  require ("head.php");
	  require ('db.php');
	  $obj->is_logged_in();
	  $data  = $obj->fetch_qualifications();
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
		<form action="process.php" method="POST">
			<div class="main-panel">
				<div class="content">
					<div class="page-inner">
						<div class="page-header">
							<h4 class="page-title">Add New Student</h4>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<div class="d-flex align-items-center">
											<h4 class="card-title">New Student</h4>
											<a href="students.php" class="btn btn-primary btn-round ml-auto"><i class="fas fa-chevron-left"></i></a>
										</div>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="fname">First name <span class="text-danger">*</span> </label>
													<input type="text" class="form-control" name = "fname" id="fname" required placeholder="First name" >
													<span id="fname-error" class="cus_error"></span>

												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="lname">Last name <span class="text-danger">*</span> </label>
													<input type="text" class="form-control" name = "lname" id="lname" required  placeholder="Last name">
													<span id="lname-error" class="cus_error"></span>

												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="date_of_admission">Date of admission <span class="text-danger">*</span> </label>
													<input type="date" class="form-control" name = "date_of_admission" id="date_of_admission" required>
													<span id="date-of-error" class="cus_error"></span>

												</div>												
											</div>											
											<div class="col-md-6">
												<div class="form-group">
													<label for="date_of_birth">Date of birth <span class="text-danger">*</span> </label>
													<input type="date" class="form-control" name = "date_of_birth" id="date_of_birth" required>
													<span id="fname-error" class="cus_error"></span>

												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="qualification_id">Qualification <span class="text-danger">*</span> </label>
														<select name="qualification_id" id="qualification_id" class="form-control" required>
															<option selected disabled value="">--- Please select ---</option>
															<span id="fname-error" class="cus_error"></span>

															<?php foreach ($data as $key => $value) { ?>
															<option value="<?php echo $value['id']?>"><?php echo ucwords($value['name'])?> </option>
															<?php }?>
														</select>
											<!-- 		<input type="name" class="form-control" name = "qualification" id="qualification" placeholder="qualification"> -->
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="gender_id">Gender <span class="text-danger">*</span> </label>
													<select type="number" class="form-control" name = "gender_id" id="gender_id" required>
														<option selected disabled value="">--- Please select ---</option>
														<option value="1">Male</option>
														<option value="2">Female</option>
														<option value="3">Other</option>
													</select>
													<!-- <input type="number" class="form-control" name = "gender" id="gender" placeholder="gender"> -->
												</div>												 
											</div>					
										</div>	
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label for="age">Age <span class="text-danger">*</span> </label>
													<input type="number" class="form-control" name = "age" min="2" max="16" id="age" required placeholder="Enter age">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label for="fees">Fees <span class="text-danger">*</span> </label>
													<input type="number" class="form-control" name = "fees" min="1000" id="fees" required placeholder="Enter fees">
												</div>												
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label for="martial_status_id">Marital Status <span class="text-danger">*</span> </label>
													<select type="number" class="form-control" name = "martial_status_id" id="martial_status_id" required style="padding: 0px 18.5px;">
														<option selected disabled value="">--- Please select ---</option>
														<option value="1">Single</option>
														<option value="2">Married</option>
														<option value="3">Divorced</option>
													</select>
											<!-- 		<input type="name" class="form-control" name = "martial_status" id="martial_status" placeholder="martial_status"> -->
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label for="phone_no">Phone number <span class="text-danger">*</span> </label>
													<input type="tel" class="form-control" name = "phone_no" id="phone_no" pattern="[0-9]{11}"  required placeholder="+92" min="11">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="address">Address <span class="text-danger">*</span> </label>
													<textarea class="form-control" name = "address" id="address" placeholder="Address"  required maxlength="50"></textarea>
													<!-- <input type="textarea" class="form-control" name = "address" id="address" placeholder="address"> -->
												</div>												
											</div>											
										</div>
										<div class="card-footer" style="text-align: center;">
											<button type="submit" name="submit_btn" value="add_student" class="btn btn-primary btn-lg">Submit</button>
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
		// $(document).ready(function (){

		// 	// validate the field in which you are typing using input ID
		// 	function cus_validate(id){
		// 		var len = ( ($('#'+id).val().length));

		// 		if( len <= 0){
		// 			$('#'+id).css('border','1px solid red');
		// 			$('#'+id).focus();
		// 			$('#'+id+'-error').text("Please fill this field");
		// 			return false;

		// 		}else{
		// 			$('#'+id).css('border','1px solid green');
		// 			$('#'+id+'-error').text("");
		// 			return true;

		// 		}
		// 	}

		// 	// getting Id of input field in which you are typing
		// 	$("input").focusout(function(){
		// 		 var id = $(this).attr('id');
		// 		 return cus_validate(id);	
		// 	});
		// 	$("select").focusout(function(){
		// 		 var id = $(this).attr('id');
		// 		 return cus_validate(id);	
		// 	});
		// 	// validate all the fields in the forms
		// 	function validate_all_fields(){

		// 		if( (cus_validate("fname"))  && (cus_validate("lname")) 
		// 								 	 && (cus_validate("date_of_admission")) 
		// 									 && (cus_validate("date_of_birth")) 
		// 			              			 && (cus_validate("qualification_id"))
		// 			              			 && (cus_validate("gender_id"))
		// 			              			 && (cus_validate("age")) 
		// 			              			 && (cus_validate("fees"))
		// 			              			 && (cus_validate("martial_status_id"))
		// 			              			 && (cus_validate("phone_no"))
		// 			              			 && (cus_validate("address"))    ){
					              			   
		// 			 	return true;
		// 			}else{
		// 				return false;
		// 			}
				
		// 	}


		// 	$('#submit_btn').click(function (){
		// 		// call validate_all_fields functions before submit.
		// 		var res =  validate_all_fields();
		// 		if(res){
		// 				// alert("Wow, You have entered all fields");

		// 				$.ajax({
		// 					type: "POST",
		// 					url: "request.php",
		// 					data:{
		// 					  	data: $('#form').serialize(),
		// 						fn  :'add_student'
		// 					},
		// 					success: function (result){


		// 						var res = $.parseJSON(result);
		// 						$('#salary').val(res.salary)
		// 					}
		// 				});
		// 			}else{
		// 				alert("soory");
		// 			}

		// 	})
		// })
	</script>	
<?php require "footbar.php";?>
</body>
</html>
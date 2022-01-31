<?php 
	session_start();
	class MyDb{
		
		public $conn = "";

		function __construct($servername = "localhost", $username = "root", $password = "",$db='school_ms'){
			$this->conn = new mysqli($servername, $username, $password,$db) or die("Connection failed");
		}	
		
		// CREATING SESSION
		public function set_session($data){
			$_SESSION['user'] = $data;
		}
		public function is_logged_in(){
			if((!isset($_SESSION['user']))){
				header("location:login.php");
			}
		}
		public function logout(){
			session_unset();
			session_destroy();
			header("location:login.php");
		}
		public function login($data){	

			extract($data);
			$query	= "SELECT * FROM `users` where `username` = '$username' and `password` = '$password' ";
			// $this->debug($query)		;
			$res 	= $this->conn->query($query);

			if ($res->num_rows>0) {	
				$record = $res->fetch_assoc();
				if (isset($record['username'])) {	
					$this->set_session($record);
					return true;
				}
				else{
					return false;
				}
			}			
		}
		public function add_student($data){
			extract($data);
			$fname   = ltrim($fname);
			$fname   = rtrim($fname);
			$lname   = ltrim($lname);
			$lname   = rtrim($lname);
			$address = ltrim($address);
			$address = rtrim($address);

			$query  =  "INSERT INTO `students`(
												`fname`, 
												`lname`, 
												`fees`,
												`date_of_birth`,
												`date_of_admission`,
												`qualification_id`,
												`age`,
												`gender_id`,
												`martial_status_id`,
												`phone_no`,
												`address`
											  ) 
									VALUES 	(
												'$fname',
												'$lname',
												'$fees',
												'$date_of_birth',
												'$date_of_admission',
												'$qualification_id',
												'$age',
												'$gender_id',
												'$martial_status_id',
												'$phone_no',
												'$address'
											 )";
			$res 	= $this->conn->query($query);
			return $res;
		}
		public function update_student($data){	
			extract($data);
			$fname   = ltrim($fname);
			$fname   = rtrim($fname);
			$lname   = ltrim($lname);
			$lname   = rtrim($lname);
			$address = ltrim($address);
			$address = rtrim($address);			
			$query	= "UPDATE `students` SET 
												`fname` = '$fname',
												`lname` = '$lname',
												`fees`='$fees',
												`date_of_birth`='$date_of_birth',
												`date_of_admission`='$date_of_admission',
												`qualification_id`='$qualification_id',
												`age`='$age',
												`gender_id`='$gender_id',
												`martial_status_id`='$martial_status_id',
												`phone_no`='$phone_no',
												`address`='$address' 
										WHERE `id` = '$id' ";
			$res 	= $this->conn->query($query);
			return $res;
		}
		public function get_student($id){
			$query	= "SELECT * FROM `students` WHERE `id` = '$id' ";
			$res 	= $this->conn->query($query);
			
			if ($res->num_rows>0) {	
				$record = $res->fetch_assoc();
				return $record;
			}
		}
		public function delete_student($data){	
			$query	= "DELETE FROM `students` WHERE `id` = '$data'";
			$res 	= $this->conn->query($query);
			return $res;
		}
		public function count_students(){
			$query = "SELECT count(*) as `total_std` FROM `students`";
			$res = $this->conn->query($query);
			return ($res->fetch_assoc());
		}
		public function sum_students_fees(){
			$query = "SELECT sum(`fees`) as `total_std_fees` FROM `students`";
			$res = $this->conn->query($query);
			return ($res->fetch_assoc());
		}
		public function fetch_student_fees(){
			$query = "SELECT
							   `std_fees`.`id`,
							   `std_fees`.`std_id`,
							   `std_fees`.`fees`,
							   `std_fees`.`created_at`,
							   `students` .`name`
							   
			 		  FROM 	   `std_fees`
			 		  INNER JOIN `students`
			 		  ON 		   `students`.`id` = `std_fees`.`std_id` ";
			$res 	= $this->conn->query($query);
			$i = 0;
			$data = array();
			while ($rows = $res->fetch_assoc()) {
				foreach ($rows as $key => $value) {
					$data[$i][$key] = $value;
				}
				$i++;
			}
			
			return $data;
		}	
		public function fetch_student(){
			$query = "SELECT 	`students`.`id`,
							    `students`.`fname`,
							    `students`.`lname`,

							    `students`.`age`,

							    `qualifications`.`name` as 	`qualification`,
							    `gender`.`name` as 	`gender`
						   
		 		  FROM 	   		`students`
		 		  LEFT JOIN 	`qualifications`
		 		  ON 		   	`students`.`qualification_id` = `qualifications`.`id` 

		 		  LEFT JOIN 	`gender`
		 		  ON 		   	`students`.`gender_id` = `gender`.`id` ";

			$res 	= $this->conn->query($query);
			$i = 0;
			$data = array();
			while ($rows = $res->fetch_assoc()) {
				foreach ($rows as $key => $value) {
					$data[$i][$key] = $value;
				}
				$i++;
			}
			
			return $data;
		}

		public function fetch_qualifications(){
			$query = "SELECT * FROM `qualifications` ";
			$res 	= $this->conn->query($query);
			$i = 0;
			$data = array();
			while ($rows = $res->fetch_assoc()) {
				foreach ($rows as $key => $value) {
					$data[$i][$key] = $value;
				}
				$i++;
			}
			
			return $data;
		}

		public function fetch_subjects(){
			$query = "SELECT * FROM `subjects` ";
			$res 	= $this->conn->query($query);
			$i = 0;
			$data = array();
			while ($rows = $res->fetch_assoc()) {
				foreach ($rows as $key => $value) {
					$data[$i][$key] = $value;
				}
				$i++;
			}
			
			return $data;
		}


		public function add_teacher($data){
			
			extract($data);
			$fname   = ltrim($fname);
			$fname   = rtrim($fname);
			$lname   = ltrim($lname);
			$lname   = rtrim($lname);
			$address = ltrim($address);
			$address = rtrim($address);

			$query  =  "INSERT INTO `teachers`(
												`fname`,
												`lname`, 
												`age`,
												`qualification_id`,
												`gender_id`,
												`phone_no`,
												`address`,
												`subject_id`,
												`class_id`,
												`salary`
											   ) 
									  VALUES (
												'$fname',
												'$lname',
												'$age',
												'$qualification_id',
												'$gender_id',
												'$phone_no',
												'$address',
												'$subject_id',
												'$class_id',
												'$salary'
											   )";
			$res 	= $this->conn->query($query);
			return $res;
		}
		public function update_teacher($data){	
			extract($data);
			$fname   = ltrim($fname);
			$fname   = rtrim($fname);
			$lname   = ltrim($lname);
			$lname   = rtrim($lname);
			$address = ltrim($address);
			$address = rtrim($address);
						
			$query	= "UPDATE `teachers` SET `fname` = '$fname',`lname` = '$lname',`age`='$age',`qualification_id`='$qualification_id',`gender_id`='$gender_id',`phone_no`='$phone_no',`address`='$address',`subject_id`='$subject_id',`class_id`='$class_id',`salary`='$salary' WHERE `id` = '$id' ";
			$res 	= $this->conn->query($query);
			return $res;
		}
		public function get_teacher($id){
			$query	= "SELECT * FROM `teachers` WHERE `id` = '$id' ";
			$res 	= $this->conn->query($query);
			
			if ($res->num_rows>0) {	
				$record = $res->fetch_assoc();
				return $record;
			}
		}
		public function delete_teacher($data){	
			$query	= "DELETE FROM `teachers` WHERE `id` = '$data'";
			$res 	= $this->conn->query($query);
			return $res;
		}
		public function count_teachers(){
			$query = "SELECT count(*) as `total_tchr` FROM `teachers`";
			$res = $this->conn->query($query);
			return ($res->fetch_assoc());
		}
		public function sum_teachers_salary(){
			$query = "SELECT sum(`salary`) as `total_tchr_salary` FROM `teachers`";
			$res = $this->conn->query($query);
			return ($res->fetch_assoc());
		}
		public function fetch_teachers_salary(){
				$query = "SELECT
							    `tchr_salary`.`id`,
							    `tchr_salary`.`salary`,
							    `tchr_salary`.`created_at`,
							    `teachers`.`fname`,
							    `teachers`.`lname`
						   
		 		  FROM 	   		`tchr_salary`
		 		  INNER JOIN 	`teachers`
		 		  ON 		   	`teachers`.`id` = `tchr_salary`.`teacher_id` ";
			$res 	= $this->conn->query($query);
			$i = 0;
			$data = array();
			while ($rows = $res->fetch_assoc()) {
				foreach ($rows as $key => $value) {
					$data[$i][$key] = $value;
				}
				$i++;
			}
			
			return $data;
		}	
		public function fetch_teacher(){
		$query = "SELECT 	`teachers`.`id`,
						    `teachers`.`fname`,
						    `teachers`.`lname`,

						    `teachers`.`age`,

						    `qualifications`.`name` as 	`qualification`,
						    `gender`.`name` as 		`gender`,
						    `classes`.`cls_name` as 	`classes`

					   
	 		  FROM 	   		`teachers`
	 		  LEFT JOIN 	`qualifications`
	 		  ON 		   	`teachers`.`qualification_id` = `qualifications`.`id` 

	 		  LEFT JOIN 	`gender`
	 		  ON 		   	`teachers`.`gender_id` = `gender`.`id`
	 		  LEFT JOIN 	`classes`
	 		  ON 		   	`teachers`.`class_id` = `classes`.`id` ";


			$res 	= $this->conn->query($query);
			$i = 0;
			$data = array();
			while ($rows = $res->fetch_assoc()) {
				foreach ($rows as $key => $value) {
					$data[$i][$key] = $value;
				}
				$i++;
			}
			
			return $data;
		}
		public function add_class($data){
			extract($data);
			$query  =  "INSERT INTO `classes`(`cls_name`) VALUES ('$cls_name')";
			$res 	= $this->conn->query($query);
			return $res;
		}
		public function update_class($data){	
			extract($data);
			$query	= "UPDATE `classes` SET `cls_name` = '$cls_name' WHERE `id` = '$id' ";
			$res 	= $this->conn->query($query);
			return $res;
		}
		public function get_class($id){
			$query	= "SELECT * FROM `classes` WHERE `id` = '$id' ";
			$res 	= $this->conn->query($query);
			
			if ($res->num_rows>0) {	
				$record = $res->fetch_assoc();
				return $record;
			}
		}
		public function delete_class($data){	
			$query	= "DELETE FROM `classes` WHERE `id` = '$data'";
			$res 	= $this->conn->query($query);
			return $res;
		}
		public function count_classes(){
			$query = "SELECT count(*) as `total_cls` FROM `classes`";
			$res = $this->conn->query($query);
			return ($res->fetch_assoc());
		}			
		public function fetch_class(){
			$query = "SELECT * FROM `classes` ";
			$res 	= $this->conn->query($query);
			$i = 0;
			$data = array();
			while ($rows = $res->fetch_assoc()) {
				foreach ($rows as $key => $value) {
					$data[$i][$key] = $value;
				}
				$i++;
			}
			return $data;
		}
		public function add_tchr_salary($data){
			extract($data);
			$query  =  "INSERT INTO `tchr_salary`(`teacher_id`, `salary`) 
						VALUES ('$teacher_id','$salary')";
			$res 	= $this->conn->query($query);
			return $res;
		}
		public function update_tchr_salary($data){	
			extract($data);
			$query	= "UPDATE `tchr_salary` SET `teacher_id` = '$teacher_id',`salary` = '$salary' ";
			$res 	= $this->conn->query($query);
			return $res;
		}
		public function get_tchr_salary($id){
			$query	= "SELECT * FROM `tchr_salary` WHERE `id` = '$id' ";
			$res 	= $this->conn->query($query);
			
			if ($res->num_rows>0) {	
				$record = $res->fetch_assoc();
				return $record;
			}
		}
		public function delete_tchr_salary($data){	
			$query	= "DELETE FROM `tchr_salary` WHERE `id` = '$data'";
			$res 	= $this->conn->query($query);
			return $res;
		}		
		public function fetch_tchr_salary(){

			$query = "SELECT
							    `tchr_salary`.`id`,
							    `tchr_salary`.`salary`,
							    `tchr_salary`.`created_at`,
							    `teachers`.`fname`,
							    `teachers`.`lname`
						   
		 		  FROM 	   		`tchr_salary`
		 		  INNER JOIN 	`teachers`
		 		  ON 		   	`teachers`.`id` = `tchr_salary`.`teacher_id` ";

			$res 	= $this->conn->query($query);
			$i = 0;
			$data = array();
			while ($rows = $res->fetch_assoc()) {
				foreach ($rows as $key => $value) {
					$data[$i][$key] = $value;
				}
				$i++;
			}
			
			return $data;
		}
		public function fetch_tchr_salary_by_id($data){
			extract($data);
			$query	= "SELECT salary FROM `teachers` WHERE `id` = '$id' ";
			$res    = $this->conn->query($query);
			
			if ($res->num_rows>0) {
				$record = $res->fetch_assoc();
				
				echo json_encode(array("salary"=>$record['salary']));
				return true;
			}
		}		
		public function add_std_fees($data){
			extract($data);
			$query  =  "INSERT INTO `std_fees`(`std_id`, `fees`) 
						VALUES ('$std_id','$fees')";
			$res 	= $this->conn->query($query);
			return $res;
		}
		public function update_std_fees($data){	
			extract($data);
			$query	= "UPDATE `std_fees` SET `std_id` = '$std_id',`fees` = '$fees' ";
			$res 	= $this->conn->query($query);
			return $res;
		}
		public function get_std_fees($id){
			$query	= "SELECT * FROM `std_fees` WHERE `id` = '$id' ";
			$res 	= $this->conn->query($query);
			
			if ($res->num_rows>0) {	
				$record = $res->fetch_assoc();
				return $record;
			}
		}
		public function delete_std_fees($data){	
			$query	= "DELETE FROM `std_fees` WHERE `id` = '$data'";
			$res 	= $this->conn->query($query);
			return $res;
		}		
		public function fetch_std_fees(){

			$query = "SELECT
							    `std_fees`.`id`,
							    `std_fees`.`fees`,
							    `std_fees`.`created_at`,
							    `students`.`fname`,
							    `students`.`lname`
						   
		 		  FROM 	   		`std_fees`
		 		  INNER JOIN 	`students`
		 		  ON 		   	`students`.`id` = `std_fees`.`std_id` ";

			$res 	= $this->conn->query($query);
			$i = 0;
			$data = array();
			while ($rows = $res->fetch_assoc()) {
				foreach ($rows as $key => $value) {
					$data[$i][$key] = $value;
				}
				$i++;
			}
			
			return $data;
		}
		public function fetch_std_fees_by_id($data){
			extract($data);
			$query	= "SELECT fees FROM `students` WHERE `id` = '$id' ";
			$res    = $this->conn->query($query);
			
			if ($res->num_rows>0) {
				$record = $res->fetch_assoc();
				
				echo json_encode(array("fees"=>$record['fees']));
				return true;
			}
		}
		
		public function username(){
			$query = "SELECT * FROM `users`";
			$res   = $this->conn->query($query);
			return ($res->fetch_assoc());
		}



		public function debug($data){
			echo "<pre>";
			print_r($data);
			echo "</pre>";
			exit();
		}
		
	}
	$obj = new MyDb();
?>
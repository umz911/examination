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
			$query  =  "INSERT INTO `students`(
												`fname`, `lname`, 
												`fees`,`date_of_birth`,
												`date_of_admission`,`qualification`
												,`age`,`gender`,`martial_status`
												,`phone_no`,`address`) 
						VALUES (
								'$fname','$lname',
								'$fees','$date_of_birth',
								'$date_of_admission',
								'$qualification','$age',
								'$gender','$martial_status',
								'$phone_no','$address')";
			$res 	= $this->conn->query($query);
			return $res;
		}
		public function update_student($data){	
			extract($data);
			$query	= "UPDATE `students` SET `fname` = '$fname',`lname` = '$lname',`fees`='$fees',`date_of_birth`='$date_of_birth',`date_of_admission`='$date_of_admission',`qualification`='$qualification',`age`='$age',`gender`='$gender',`martial_status`='$martial_status',`phone_no`='$phone_no',`address`='$address' WHERE `id` = '$id' ";
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
			$query = "SELECT * FROM `students` ";
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
			$query  =  "INSERT INTO `teacher`(`name`, `email`, `class`) VALUES ('$fname','$email','$class')";
			$res 	= $this->conn->query($query);
			return $res;
		}
		public function update_teacher($data){	
			extract($data);
			$query	= "UPDATE `teacher` SET `name` = '$fname',`email` = '$email',`subject`='$subject' WHERE `id` = '$id' ";
			$res 	= $this->conn->query($query);
			return $res;
		}
		public function get_teacher($id){
			$query	= "SELECT * FROM `teacher` WHERE `id` = '$id' ";
			$res 	= $this->conn->query($query);
			
			if ($res->num_rows>0) {	
				$record = $res->fetch_assoc();
				return $record;
			}
		}
		public function delete_teacher($data){	
			$query	= "DELETE FROM `teacher` WHERE `id` = '$data'";
			$res 	= $this->conn->query($query);
			return $res;
		}
		public function fetch_teacher(){
			$query = "SELECT * FROM `teacher` ";
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
		public function debug($data){
			echo "<pre>";
			print_r($data);
			echo "</pre>";
			exit();
		}
		
	}
	$obj = new MyDb();
?>
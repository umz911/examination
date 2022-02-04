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

			$username   = ltrim($username);
			$username   = rtrim($username);
			$password   = ltrim($password);
			$password   = rtrim($password);

			$password 	= md5($password);


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
			$query	= "SELECT phone_no FROM students WHERE EXISTS (SELECT phone_no FROM students WHERE students.phone_no = $phone_no)";


			$data = $this->unserializeForm($data['data']) ;
			
			extract($data);

			$fname   = ltrim($fname);
			$fname   = rtrim($fname);
			$lname   = ltrim($lname);
			$lname   = rtrim($lname);
			$address = ltrim($address);
			$address = rtrim($address);

			$query   =  "INSERT INTO `students`(
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
			if($res){
				echo json_encode(array("status"=>"success",'msg'=>"submitted successfully"));
				return true;
			}else{
				echo json_encode(array("status"=>"failed",'msg'=>"not submitted successfully"));
				return false;
			}
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
			 		  ON 		 `students`.`id` = `std_fees`.`std_id` ";
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
		
		public function number_to_word( $num = '' ){

		    $num    = ( string ) ( ( int ) $num );
		   
		    if( ( int ) ( $num ) && ctype_digit( $num ) )
		    {
		        $words  = array( );
		       
		        $num    = str_replace( array( ',' , ' ' ) , '' , trim( $num ) );
		       
		        $list1  = array('','one','two','three','four','five','six','seven',
		            'eight','nine','ten','eleven','twelve','thirteen','fourteen',
		            'fifteen','sixteen','seventeen','eighteen','nineteen');
		       
		        $list2  = array('','ten','twenty','thirty','forty','fifty','sixty',
		            'seventy','eighty','ninety','hundred');
		       
		        $list3  = array('','thousand','million','billion','trillion',
		            'quadrillion','quintillion','sextillion','septillion',
		            'octillion','nonillion','decillion','undecillion',
		            'duodecillion','tredecillion','quattuordecillion',
		            'quindecillion','sexdecillion','septendecillion',
		            'octodecillion','novemdecillion','vigintillion');
		       
		        $num_length = strlen( $num );
		        $levels = ( int ) ( ( $num_length + 2 ) / 3 );
		        $max_length = $levels * 3;
		        $num    = substr( '00'.$num , -$max_length );
		        $num_levels = str_split( $num , 3 );
		       
		        foreach( $num_levels as $num_part )
		        {
		            $levels--;
		            $hundreds   = ( int ) ( $num_part / 100 );
		            $hundreds   = ( $hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ( $hundreds == 1 ? '' : 's' ) . ' ' : '' );
		            $tens       = ( int ) ( $num_part % 100 );
		            $singles    = '';
		           
		            if( $tens < 20 ) { $tens = ( $tens ? ' ' . $list1[$tens] . ' ' : '' ); } else { $tens = ( int ) ( $tens / 10 ); $tens = ' ' . $list2[$tens] . ' '; $singles = ( int ) ( $num_part % 10 ); $singles = ' ' . $list1[$singles] . ' '; } $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_part ) ) ? ' ' . $list3[$levels] . ' ' : '' ); } $commas = count( $words ); if( $commas > 1 )
		        {
		            $commas = $commas - 1;
		        }
		       
		        $words  = implode( ', ' , $words );
		       
		        $words  = trim( str_replace( ' ,' , ',' , ucwords( $words ) )  , ', ' );
		        if( $commas )
		        {
		            $words  = str_replace( ',' , ' and' , $words );
		        }
		       
		        return $words;
		    }
		    else if( ! ( ( int ) $num ) )
		    {
		        return 'Zero';
		    }
		    return '';
		}

		public function fetch_users(){
			
			$query = 	"SELECT 	`users`.`id`,
							    	`users`.`fname`,
							   		`users`.`lname`,
							   		`users`.`username`
		 		  	    FROM 	   	`users`";

			$res 	= $this->conn->query($query);
			$i 		= 0;
			$data 	= array();
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

		public function unserializeform($str) {
			$returndata 	= array();
			$strArray 		= explode("&", $str);
			$i 				= 0;

			foreach ($strArray as $item) {
				$array 		= explode("=", $item);
				$returndata[$array[0]] = $array[1];
			}
			return $returndata;
		}



		// public function add_user($data){
		// 	$data = $this->unserializeform($data['data']);		
		// 	extract($data);

		// 	$rec =  $this->is_exist('users','username',$username);

		// 	if($rec){
		// 			$result['type'] = 'error';
		// 			$result['msg'] 	= 'Username already exist';
		// 			return $result;
		// 	}else{
		// 			$fname    = ltrim($fname);
		// 			$fname    = rtrim($fname);
		// 			$lname    = ltrim($lname);
		// 			$lname    = rtrim($lname);
		// 			$username = ltrim($username);
		// 			$username = rtrim($username);	 
		// 			$password = rtrim($password);	 
		// 			$password = rtrim($password);

		// 			$password 	= md5($password);
		// 			$query  	=  "INSERT INTO `users`(`fname`,`lname`,`username`,`password`) VALUES ('$fname','$lname','$username','$password')";
		// 			$res 		= $this->conn->query($query);
		// 			$result 	= array();
		// 			if($res == 1){

		// 				$result['type'] = 'success';
		// 				$result['msg'] 	= 'Your data has been submitted!!!';
		// 				echo json_encode(array("status"=>"success",'msg'=>"submitted successfully"));

		// 				return $result;

		// 			}else{
						
		// 				$result['type'] = 'error';
		// 				$result['msg'] 	= 'Your data has not been submitted!!!';
		// 				echo json_encode(array("status"=>"failed",'msg'=>"not submitted successfully"));

		// 				return $result;
		// 			}
		// 	}
		public function add_user($data){

			$data = $this->unserializeForm($data['data']) ;
		
			  extract($data);
				   
			  $fname     = ltrim($fname);
			  $fname     = rtrim($fname);
			  $lname     = ltrim($lname);
			  $lname     = rtrim($lname);
			  $username  = ltrim($username);
			  $username  = rtrim($username);
			  $password  = ltrim($password);
			  $password  = rtrim($password);
		
			  $msg       = array();
		
			  $result    = $this->is_exist('users','username',$username);
		
			  $password  = md5($password);
		
			  if ($result) {
				$msg['type'] = "error";
				$msg['msg'] = "Sorry data already exists";
				echo json_encode(array("status"=>"failed",'msg'=>"not submitted successfully"));
				return false;
			  }else{
				$query = "INSERT INTO `users`(`fname`,`lname`,`username`,`password`) VALUES ('$fname','$lname','$username','$password')";
				$res   = $this->conn->query($query);
				$msg['type'] = "error";
				$msg['msg'] = "Sorry data already exists";
				echo json_encode(array("status"=>"success",'msg'=>"submitted successfully"));
				return true;
			  }		

			// $fname    = ltrim($fname);
			// $fname    = rtrim($fname);
			// $lname    = ltrim($lname);
			// $lname    = rtrim($lname);
			// $username = ltrim($username);
			// $username = rtrim($username);	 
			// $password = rtrim($password);	 
			// $password = rtrim($password);


			// $password = md5($password);



		
			// $query  	=  "INSERT INTO `users`(`fname`,`lname`,`username`,`password`) 
			// 				VALUES ('$fname','$lname','$username','$password')";
			// $res 		= $this->conn->query($query);
			// $result 	= array();
			
			// if($res){
			// 	echo json_encode(array("status"=>"success",'msg'=>"submitted successfully"));
			// 	return $result;
			// }else{
			// 	echo json_encode(array("status"=>"failed",'msg'=>"not submitted successfully"));
			// 	return $result;
			// }
		}
		
		public function is_exist($table, $col, $data){
			
			$query		 = "SELECT * FROM `$table` where `$col` = '$data' ";
		
			$res 		 = $this->conn->query($query);
			
			// $this->debug($res->num_rows);

			if (($res->num_rows) >0) {
				return true; // data exist kart ha
			}else{
				return false; // data exist kart ha
			}
		}

		// public function add_user($data){
		// 	extract($data);
		// 	if($rec){
		// 			$result['type'] = 'error';
		// 			$result['msg'] 	= 'Username already exist';
		// 			return $result;
		// 	}else{
		// 			$password 	= md5($password);
		// 			$query  	=  "INSERT INTO `users` (`username`,`password`) VALUES ('$username','$password')";
		// 			$res 		= $this->conn->query($query);
		// 			$result 	= array();
		// 			if($res == 1 ){
		// 				$result['type'] = 'success';
		// 				$result['msg'] 	= 'Your data has been submitted!!!';
		// 				return $result;
		// 			}else{
		// 				$result['type'] = 'error';
		// 				$result['msg'] 	= 'Your data has not been submitted!!!';
		// 				return $result;
		// 			}
		// 	}

		// }


		public function add_qualification($data){
			$data = $this->unserializeform($data['data']);
			
			extract($data);

			$name    = ltrim($name);
			$name    = rtrim($name);

			$query  =  "INSERT INTO `qualifications`(`name`) 
							VALUES ('$name')";
			$res 	= $this->conn->query($query);

			
			if($res){
				echo json_encode(array("status"=>"success",'msg'=>"submitted successfully"));
				return true;
			}else{
				echo json_encode(array("status"=>"failed",'msg'=>"not submitted successfully"));
				return false;
			}
		}
		public function update_qualification($data){
  
			$data = $this->unserializeform($data['data']);
			extract($data);

			$quali_name    = ltrim($quali_name);
			$quali_name    = rtrim($quali_name);

			
			$query = "UPDATE `qualifications` SET `name`='$quali_name'WHERE `id` = '$quali_id'";
			$res   = $this->conn->query($query);
			
			if($res){
				echo json_encode(array("status"=>"success",'msg'=>"Updated successfully"));
				return true;
			}else{
				echo json_encode(array("status"=>"failed",'msg'=>"not Updated successfully"));
				return false;
			}
		}
		public function get_qualification($id){
			$query	= "SELECT * FROM `qualifications` WHERE `id` = '$id' ";
			$res 	= $this->conn->query($query);
			
			if ($res->num_rows>0) {	
				$record = $res->fetch_assoc();
				return $record;
			}
		}
		
		public function view_qualification($id){
			extract($id);
			$query	= "SELECT * FROM `qualifications` WHERE `id` = '$data' ";

			$res 	= $this->conn->query($query);
			
			if ($res->num_rows>0) {	
				$record = $res->fetch_assoc();
				echo json_encode(array("status"=>"success",'data'=>$record['name']));
				
				return true;
			}
		}

		public function delete_qualification($data){	
		
			$query	= "DELETE FROM `qualifications` WHERE `id` = '$data'";
			$res 	= $this->conn->query($query);
			return $res;
		}


		public function delete_user($data){	
		
			$query	= "DELETE FROM `users` WHERE `id` = '$data'";
			$res 	= $this->conn->query($query);
			return $res;
		}
		public function update_user($data){
  
			$data = $this->unserializeform($data['data']) ;
			extract($data);
			
			

			$fname     = ltrim($fname);
			$fname     = rtrim($fname);
			$lname     = ltrim($lname);
			$lname     = rtrim($lname);
			$username  = ltrim($username);
			$username  = rtrim($username);
			$password  = ltrim($password);
			$password  = rtrim($password);  


			$password = md5($password);

			
			
			$query = "UPDATE `users` SET `fname`='$fname',`lname`='$lname',`username`='$username',`password`='$password' WHERE `id` = '$id'";
			$res   = $this->conn->query($query);
			if($res){
				echo json_encode(array("status"=>"success",'msg'=>"Updated successfully"));
				return true;
			}else{
				echo json_encode(array("status"=>"failed",'msg'=>"not Updated successfully"));
				return false;
			}
		}

		public function get_user($id){
			$query	= "SELECT * FROM `users` WHERE `id` = '$id' ";
			$res 	= $this->conn->query($query);
			
			if ($res->num_rows>0) {	
				$record = $res->fetch_assoc();
				return $record;
			}
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
						
			$query	= "UPDATE `teachers` SET `fname` = '$fname',
			`lname` = '$lname',
			`age`='$age',
			`qualification_id`='$qualification_id',
			`gender_id`='$gender_id',
			`phone_no`='$phone_no',
			`address`='$address',
			`subject_id`='$subject_id',
			`class_id`='$class_id',`salary`='$salary' WHERE `id` = '$id' ";
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

			$cls_name     = ltrim($cls_name);
			$cls_name     = rtrim($cls_name);

			$query = "SELECT * FROM `classes` where `cls_name` = '$cls_name' ";
			$res   = $this->conn->query($query);
			
			if(($res->num_rows) > 0){
				return false;
			}else{
				$query = "INSERT INTO `classes`(`cls_name`) VALUES ('$cls_name')";
				$res   = $this->conn->query($query);
				return $res;
			}
			
		}		
		// public function add_class($data){
		
		// 	extract($data);
			
		// 	$cls_name   = ltrim($cls_name);
		// 	$cls_name   = rtrim($cls_name);

		// 	$query  =  "INSERT INTO `classes`(`cls_name`) VALUES ('$cls_name')";
		// 	$res 	= $this->conn->query($query);
		// 	return $res;
		// }
		
		public function update_class($data){	
		
			extract($data);
			
			$cls_name   = ltrim($cls_name);
			$cls_name   = rtrim($cls_name);

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
			// exit();
		}
		
	}
	$obj = new MyDb();
?>
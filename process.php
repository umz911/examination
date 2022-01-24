<?php
	require ('db.php');
	
	if (isset($_POST['submit_btn'])) {
		switch ($_POST['submit_btn']) {
			case 'add_student':
				$res = $obj->add_student($_POST);
		
				if( $res == 1){
					header("location:students.php");
				}
				else{
					echo "sorry";
				}
			break;
			case 'update_student':
				$res = $obj->update_student($_POST);
				if( $res == 1){
					header("location:students.php");
				}
			break;
			case 'add_teacher':
				$res = $obj->add_teacher($_POST);
		
				if( $res == 1){
					header("location:teachers.php");
				}
				else{
					echo "sorry";
				}
			break;
			case 'update_teacher':
				$res = $obj->update_teacher($_POST);
				if( $res == 1){
					header("location:teachers.php");
				}
			break;
			case 'add_class':
				$res = $obj->add_class($_POST);
		
				if( $res == 1){
					header("location:classes.php");
				}
				else{
					echo "sorry";
				}
			break;
			case 'update_class':
				$res = $obj->update_class($_POST);
				if( $res == 1){
					header("location:classes.php");
				}
			break;
			case 'add_tchr_salary':
				$res = $obj->add_tchr_salary($_POST);
		
				if( $res == 1){
					header("location:teachers_salary.php");
				}
				else{
					echo "sorry";
				}
			break;
			case 'update_tchr_salary':
				$res = $obj->update_tchr_salary($_POST);
				if( $res == 1){
					header("location:teachers_salary.php");
				}
			break;				
			default:
				header("location:index.php");
			break;			
		}
	}
	else{
		switch ($_GET['submit_dlt']){
			case 'delete_student':
				$id = $_GET['id'];
				$res = $obj->delete_student($id);
				if ($res) {
					header("location:students.php");
				}
			break;	
			case 'delete_teacher':
				$id = $_GET['id'];
				$res = $obj->delete_teacher($id);
				if ($res) {
					header("location:teachers.php");
				}				
			break;
			case 'delete_class':
				$id = $_GET['id'];
				$res = $obj->delete_class($id);
				if ($res) {
					header("location:classes.php");
				}				
			break;
			case 'delete_tchr_salary':
				$id = $_GET['id'];
				$res = $obj->delete_tchr_salary($id);
				if ($res) {
					header("location:teachers_salary.php");
				}				
			break;								
		}	
	}
?>
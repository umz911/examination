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
			default:
				header("location:students.php");
			break;
		}
	}else{
		switch ($_GET['submit_dlt']){
			case 'delete_student':
				$id = $_GET['id'];
				$res = $obj->delete_student($id);
				if ($res) {
					header("location:students.php");
				}
			break;
		}	
	}
?>
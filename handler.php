<?php

	require ("db.php");

	if(!(isset($_POST['btn_submit']))){
		header("location:login.php");
	}

	switch ($_POST['btn_submit']) {
		case 'sign_in':
			$data = $obj->login($_POST);
			if ($data){
				header("location:index.php");
			}
			else{
				header("location:login.php");
			}
		break;
		default:
				header("location:login.php");
		break;
	}
 ?>
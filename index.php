<!DOCTYPE html>
<html lang="en">
<?php 

	require "head.php";
	require ('db.php');
	$obj->is_logged_in();
?>

<body>
	<div class="wrapper">
		<div class="main-header" data-background-color="purple">
			<?php require "logo_header.php";?>
			<?php require "nav_bar.php";?>
		</div>
		<?php require "sidebar.php";?>
		<?php require "mainpanel.php";?>
	</div>
</div>
<?php require "footbar.php";?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<?php

session_start();

include('header.php')

?>

<style>
	#content {
		width: 100%;
		padding: 20px;
		min-height: 100vh;
		transition: all 0.3s;
	}
</style>


<body>
	<div class="wrapper">

		<?php include('sidebar.php') ?>

		<div id="content">

			<?php include('navbar.php') ?>

			<?php include('dashboard_content.php') ?>
		</div>
	</div>
</body>

</html>
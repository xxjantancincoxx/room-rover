<!DOCTYPE html>
<html lang="en">
<?php

session_start();


require_once('../backend/DBconn.php');

include('header.php')
?>

<body>
	<div class="wrapper">

		<?php include('sidebar.php') ?>

		<div id="content">

			<?php include('navbar.php') ?>

			<div class="container">
				<div class="alert alert-container" role="alert">
					<h3 class="text-secondary font-weight-bold" style="font-size:1.5rem;">Welcome Admin!</h3>
					<div>Dashboard Page</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="row mb-3">
							<?php
							// Fetch and display the average rating based on reviews
							$sql_active = "SELECT COUNT(status) AS num_status_active FROM accounts
                            WHERE user_type = 'owner' and status = 'active'";
							$result_count_temp_active = mysqli_query($conn, $sql_active);
							$count_result_active = mysqli_fetch_assoc($result_count_temp_active);

							$sql_inactive = "SELECT COUNT(status) AS num_status_inactive FROM accounts
                            WHERE user_type = 'owner' and status = 'inactive'";
							$result_count_temp_inactive = mysqli_query($conn, $sql_inactive);
							$count_result_inactive = mysqli_fetch_assoc($result_count_temp_inactive);

							$pending_owners_count = "SELECT COUNT(status) AS pending_owners FROM accounts
                            WHERE user_type = 'owner' and status = 'pending'";
							$pending_temp_result = mysqli_query($conn, $pending_owners_count);
							$pending_result = mysqli_fetch_assoc($pending_temp_result);

							?>
							<div class="col-sm-4">
								<div class="widget-stat card bg-secondary">
									<div class="card-body p-4">
										<div class="media">
											<span class="mr-3 m-auto">
												<i class="fa fa-users" style="color:white;font-size:50px"></i>
											</span>
											<div class="media-body text-white text-right">
												<p class="text-white mb-1">Active Owners</p>
												<h3 class="text-white"><?php echo $count_result_active["num_status_active"]; ?></h3>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="widget-stat card bg-secondary">
									<div class="card-body p-4">
										<div class="media">
											<span class="mr-3 m-auto">
												<i class="fa fa-user-times" style="color:white;font-size:50px"></i>
											</span>
											<div class="media-body text-white text-right">
												<p class="text-white mb-1">Inactive Owners</p>
												<h3 class="text-white"><?php echo $count_result_inactive["num_status_inactive"]; ?></h3>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="widget-stat card bg-secondary">
									<div class="card-body p-4">
										<div class="media">
											<span class="mr-3 m-auto">
												<i class="fa fa-user-times" style="color:white;font-size:50px"></i>
											</span>
											<div class="media-body text-white text-right">
												<p class="text-white mb-1">Pending Owners</p>
												<h3 class="text-white"><?php echo $pending_result["pending_owners"]; ?></h3>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
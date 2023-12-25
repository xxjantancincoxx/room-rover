<?php
session_start();

// Check if the user is logged in and has a valid session ID
$session_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;

?>
<!DOCTYPE html>
<html lang="en">

<?php include('header.php'); ?>

<body>

	<!--*******************
        Preloader start
    ********************-->
	<?php include('../layouts/loader.php'); ?>
	<!--*******************
        Preloader end
    ********************-->

	<!--**********************************
        Main wrapper start
    ***********************************-->
	<div id="main-wrapper">

		<!--**********************************
            Nav header start
        ***********************************-->
		<div class="nav-header">
			<a href="index.html" class="brand-logo">
				<img class="logo-abbr" src="../assets/images/logo.png" alt="">
				<img class="logo-compact" src="../assets/images/logo-text.png" alt="">
				<img class="brand-title" src="../assets/images/logo-text.png" alt="">
			</a>

			<div class="nav-control">
				<div class="hamburger">
					<span class="line"></span><span class="line"></span><span class="line"></span>
				</div>
			</div>
		</div>
		<!--**********************************
            Nav header end
        ***********************************-->

		<!--**********************************
            Sub-Header start
        ***********************************-->
		<?php include('sub-header.php'); ?>
		<!--**********************************
            Sub-Header end ti-comment-alt
        ***********************************-->

		<!--**********************************
            Sidebar start
        ***********************************-->
		<?php include('navigation.php'); ?>
		<!--**********************************
            Sidebar end
        ***********************************-->

		<!--**********************************
            Content body start
        ***********************************-->
		<div class="content-body">

			<!-- row -->
			<div class="container-fluid">
				<div class="row">
					<div class="col-xl-12 col-xxl-12">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">User Profile</h4>
								<?php
								// Fetch user information from the database
								$sqlSelectUser = "SELECT * FROM users WHERE id = :session_id";
								$stmtSelectUser = $pdo->prepare($sqlSelectUser);
								$stmtSelectUser->bindParam(':session_id', $session_id, PDO::PARAM_INT);
								$stmtSelectUser->execute();

								// Check if user exists
								if ($stmtSelectUser->rowCount() > 0) {
									$user = $stmtSelectUser->fetch(PDO::FETCH_ASSOC);
								?>
									<div class="container mt-5">
										<div class="row justify-content-center">
											<div class="col-md-8">
												<div class="card">
													<div class="card-body">
														<h4 class="card-title">User Profile</h4>
														<form id="profileForm">
															<div class="row">
																<!-- First Column -->
																<div class="col-md-6">
																	<!-- Personal Information -->
																	<div class="mb-3">
																		<label for="firstname" class="form-label">First Name:</label>
																		<input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>">
																	</div>

																	<div class="mb-3">
																		<label for="middlename" class="form-label">Middle Name:</label>
																		<input type="text" class="form-control" id="middlename" name="middlename" value="<?php echo $user['middlename']; ?>">
																	</div>

																	<div class="mb-3">
																		<label for="contact_no" class="form-label">Contact Number:</label>
																		<input type="tel" class="form-control" id="contact_no" name="contact_no" value="<?php echo $user['contact_no']; ?>">
																	</div>

																	<!-- Add a field for the current password -->
																	<div class="mb-3">
																		<label for="current_password" class="form-label">Current Password:</label>
																		<input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter current password">
																	</div>

																	<div class="mb-3">
																		<label for="new_password" class="form-label">New Password:</label>
																		<input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter new password">
																	</div>
																</div>

																<!-- Second Column -->
																<div class="col-md-6">
																	<!-- Additional Information -->
																	<div class="mb-3">
																		<label for="lastname" class="form-label">Last Name:</label>
																		<input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>">
																	</div>

																	<div class="mb-3">
																		<label for="age" class="form-label">Age:</label>
																		<input type="number" class="form-control" id="age" name="age" value="<?php echo $user['age']; ?>">
																	</div>

																	<div class="mb-3">
																		<label for="gender" class="form-label">Gender:</label>
																		<select class="form-select" id="gender" name="gender">
																			<option value="male" <?php echo ($user['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
																			<option value="female" <?php echo ($user['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
																			<option value="other" <?php echo ($user['gender'] == 'other') ? 'selected' : ''; ?>>Other</option>
																		</select>
																	</div>

																	<div class="mb-3">
																		<label for="email" class="form-label">Email:</label>
																		<input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>">
																	</div>

																	<!-- Add a password field for updating the password -->

																</div>
															</div>

															<!-- Additional form fields go here -->

															<button type="submit" class="btn btn-primary">Update Profile</button>

														</form>
													</div>
												</div>
											</div>
										</div>
									</div>

									<!-- Add jQuery library -->
									<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

									<script>
										$(document).ready(function() {
											// Handle form submission using AJAX
											$('#profileForm').submit(function(event) {
												event.preventDefault();

												// Collect form data
												var formData = $(this).serialize();

												// Perform AJAX request
												$.ajax({
													type: 'POST',
													url: '../backend/api/update_profile.php',
													data: formData,
													success: function(response) {
														switch (response) {
															case 'success':
																Swal.fire('Success', 'Profile updated successfully.', 'success');
																break;
															case 'error':
																Swal.fire('Error', 'An error occurred during the update.', 'error');
																break;
															case 'incorrect_password':
																Swal.fire('Error', 'Incorrect current password.', 'error');
																break;
															case 'user_not_found':
																Swal.fire('Error', 'User not found.', 'error');
																break;
															case 'invalid_request':
																Swal.fire('Error', 'Invalid request.', 'error');
																break;
																// Add more cases as needed
														}
													},
													error: function() {
														Swal.fire('Error', 'An error occurred during the AJAX request.', 'error');
													}
												});
											});
										});
									</script>

								<?php
								} else {
									echo "<p>User not found.</p>";
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

</body>

</html>
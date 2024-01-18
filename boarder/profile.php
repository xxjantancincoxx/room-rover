<?php
session_start();
require_once('../backend/DBconn.php');

// Check if the user is logged in and has a valid session ID
$session_id = $_SESSION["session_id"];

?>
<!DOCTYPE html>
<html lang="en">

<?php include('header.php'); ?>

<body>

	<div class="wrapper">

		<?php include('sidebar.php') ?>

		<div id="content">

			<?php include('../layouts/navbar.php') ?>

			<!-- row -->
			<div class="container-fluid">
				<div class="row">
					<div class="col-xl-12 col-xxl-12">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">User Profile</h4>
								<?php
								// Fetch user information from the database
								$sqlSelectUser = "SELECT * FROM users WHERE session_id = '$session_id';";
								$result = mysqli_query($conn, $sqlSelectUser);
								// Check if user exists
								if (mysqli_num_rows($result) === 1) {
									$user = mysqli_fetch_assoc($result);
								?>
									<div class="mt-5">
										<div class="row">
											<div class="col-md-12">
												<form id="profileForm">
													<div class="card">
														<div class="card-body">
															<div class="row">
																<div class="col col-md-4 border-right">
																	<h5>Guardian</h5>
																	<br>
																	<div class="mb-3">
																		<label for="g_fullname" class="form-label">Full Name:</label>
																		<input type="text" class="form-control" id="g_fullname" name="g_fullname" value="<?php echo $user['g_fullname']; ?>">
																	</div>
																	<div class="mb-3">
																		<label for="g_address" class="form-label">Address:</label>
																		<input type="text" class="form-control" id="g_address" name="g_address" value="<?php echo $user['g_address']; ?>">
																	</div>
																	<div class="mb-3">
																		<label for="g_contact_no" class="form-label">Contact Number:</label>
																		<input type="text" class="form-control" id="g_contact_no" name="g_contact_no" value="<?php echo $user['g_contact_no']; ?>">
																	</div>
																</div>

																<div class="col col-md-8 border-left">
																	<h5>Boarder</h5>
																	<br>
																	<div class="row">
																		<div class="col col-md-6">
																			<div class="mb-3">
																				<label for="fullname" class="form-label">Full Name:</label>
																				<input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $user['fullname']; ?>">
																			</div>

																			<div class="mb-3">
																				<label for="contact_no" class="form-label">Contact Number:</label>
																				<input type="tel" class="form-control" id="contact_no" name="contact_no" value="<?php echo $user['contact_no']; ?>">
																			</div>

																			<div class="mb-3">
																				<label for="age" class="form-label">Age:</label>
																				<input type="number" class="form-control" id="age" name="age" value="<?php echo $user['age']; ?>">
																			</div>
																		</div>
																		<div class="col col-md-6">
																			<div class="mb-3">
																				<label for="gender" class="form-label">Gender:</label>
																				<select class="form-control" id="gender" name="gender">
																					<option value="male" <?php echo ($user['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
																					<option value="female" <?php echo ($user['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
																					<!-- <option value="other" < ?php echo ($user['gender'] == 'other') ? 'selected' : ''; ?>>Other</option> -->
																				</select>
																			</div>

																			<div class="mb-3">
																				<label for="email" class="form-label">Email:</label>
																				<input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>">
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col col-md-6">
																			<div class="mb-3">
																				<label for="current_password" class="form-label">Current Password:</label>
																				<input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter current password">
																			</div>
																		</div>
																		<div class="col col-md-6">
																			<div class="mb-3">
																				<label for="new_password" class="form-label">New Password:</label>
																				<input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter new password">
																			</div>
																		</div>

																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="d-flex justify-content-end mt-4">
														<button type="submit" class="btn btn-primary ">Update Profile</button>

													</div>
												</form>
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
<!DOCTYPE html>
<html lang="en">

<?php
session_start();
require_once('../backend/DBconn.php');

// Set the BASE_URL
$BASE_URL = 'http://localhost/room_rover/';
include('header.php') ?>

<body>

	<div class="wrapper">

		<?php include('sidebar.php') ?>

		<div id="content">

			<?php include('navbar.php') ?>

			<!-- row -->
			<div class="container-fluid">
				<div class="form-head d-flex mb-3 mb-md-5 align-items-start">
					<div class="mr-auto d-none d-lg-block">
						<h3 class="text-primary font-w600">Welcome!</h3>
						<p class="mb-0">Reservations Page</p>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-12 col-xxl-12 mb-3">
						<div class="row">
							<div class="col-xl-4 col-lg-6 col-sm-6">
								<div class="widget-stat card bg-info">
									<div class="card-body p-4">
										<div class="media">
											<span class="mr-3">
												<i class="flaticon-381-home"></i>
											</span>
											<div class="media-body text-white text-right">
												<p class="mb-1 text-white">Reservations</p>
												<h3 class="text-white">
													<?php
													// Fetch and display the count of reservations
													$session_id = $_SESSION['id'];
													$sqlCountReservations = "SELECT COUNT(*) AS reservationCount FROM tbl_reservations WHERE uid = '$session_id'";
													$result_temp = mysqli_query($conn, $sqlCountReservations);
													$result = mysqli_fetch_assoc($result_temp);
													echo $result["reservationCount"];
													?>
												</h3>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xl-12 col-xxl-12">
						<div class="row">
							<!-- <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12"> -->

							<div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">Reservations List</h4>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-bordered" id="reserve">
												<thead>
													<tr>


														<th>Room Name</th>
														<th>Location</th>
														<th>Image</th>
														<th>Status</th>
														<th>Price</th>
														<th>Aircon</th>
														<th>Free Water/Electric</th>
														<th>Free WiFi</th>
														<th>Has Own CR</th>
														<th>Date Added</th>
														<th>Actions</th>

													</tr>
												</thead>
												<tbody>
													<?php
													// Assuming you have a PDO database connection established, and your PDO instance is named $pdo

													$session_id = $_SESSION['id']; // Replace with the actual session ID

													// Your SQL query
													$sql = "SELECT r.rs_id, r.lid, r.uid, r.status, r.date_created,
                                                            l.listing_id, l.name,l.location, l.owner_id, l.price, l.is_aircon, l.free_water_electric, l.free_wifi, l.own_cr, l.pic, l.date_added
                                                            FROM tbl_reservations r
                                                            LEFT JOIN tbl_listings l ON r.lid = l.listing_id
                                                            WHERE r.uid = '$session_id'
                                                            ORDER BY r.rs_id ASC;
                                                            ";

													// Prepare and execute the query
													$temp_result = mysqli_query($conn, $sql);
													// $stmt = $pdo->prepare($sql);
													// $stmt->bindParam(':session_id', $session_id, PDO::PARAM_STR);
													// $stmt->execute();

													// Check if there are results
													if (mysqli_num_rows($temp_result) >= 1) {
														// Fetch results using PDO fetch
														while ($row = mysqli_fetch_assoc($temp_result)) {
															echo "<tr>";
															$obj = json_decode($row["pic"]);
															$pic1 = null;
															foreach ($obj as $key => $value) {
																$pic1 = $value;
																break;
															}


															echo "<td>" . ($row['name'] ? $row['name'] : 'Listing not available') . "</td>";
															echo "<td>" . ($row['location'] ? $row['location'] : 'Listing not available') . "</td>";
															// Display the image in the 'Image' column
															$imagePath = '../backend/api/uploads/OWNER' . $row['owner_id'] . '/' . $pic1;
															echo "<td><img src='{$imagePath}' alt='{$row['name']}' class='img-fluid' style='max-height: 100px; max-width: 100px;'></td>";

															echo "<td>" . ($row['status'] ? 'Approved' : 'Pending') . "</td>";
															echo "<td>₱" . number_format($row['price']) . "</td>";

															// Display "Yes" if has CR, "None" if not
															echo "<td>" . ($row['is_aircon'] ? 'Yes' : 'None') . "</td>";
															// Display "Yes" if has CR, "None" if not
															echo "<td>" . ($row['own_cr'] ? 'Yes' : 'None') . "</td>";

															// Display "Yes" if free water and electric, "None" if not
															echo "<td>" . ($row['free_water_electric'] ? 'Yes' : 'None') . "</td>";

															// Display "Yes" if free WiFi, "None" if not
															echo "<td>" . ($row['free_wifi'] ? 'Yes' : 'None') . "</td>";
															echo "<td>{$row['date_created']}</td>";
															echo "<td>";
															// Add a confirmation prompt before deletion
															echo "<button class='btn btn-sm btn-danger btn-delete' data-rs-id='{$row['rs_id']}'><i class='fas fa-trash'></i> Cancel</button>";
															echo "</td>";
															echo "</tr>";
														}
													} else {
														// Handle the case where the query fails
														echo "Error: " . $conn->close();
													}
													?>
												</tbody>
											</table>
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

	<!-- SweetAlert JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
	<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

	<script>
		$(document).ready(function() {
			// Add a confirmation prompt before deletion
			$('.btn-delete').click(function() {
				var rsId = $(this).data('rs-id');


				// Display a SweetAlert confirmation prompt
				Swal.fire({
					title: '10% Deducted! Are you sure?',
					text: 'You won\'t be able to revert this!',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, cancel it!',
					cancelButtonText: 'No!'
				}).then((result) => {
					if (result.isConfirmed) {

						// If confirmed, send an AJAX request to delete the reservation
						$.ajax({
							type: 'POST',
							url: '../backend/api/cancel_reservation.php',
							data: {
								rsId: rsId
							},
							dataType: 'json',
							success: function(response) {
								if (response.success) {

									$('#reserveModal').modal('hide');

									// If the reservation is successfully canceled, show a success message
									Swal.fire({
										icon: 'success',
										title: 'Reservation Canceled!',
										text: 'Your reservation has been canceled.',
									}).then(() => {
										// Reload the page
										window.location.reload();
									});
								} else {
									// If an error occurs, show an error message
									Swal.fire({
										icon: 'error',
										title: 'Error!',
										text: 'Error occurred during cancellation.',
									});
								}
							},
							error: function() {
								// If an error occurs, show an error message
								Swal.fire({
									icon: 'error',
									title: 'Error!',
									text: 'Error occurred during cancellation.',
								});
							}
						});
					}
				});
			});
		});
	</script>

	<script>
		$(document).ready(function() {
			$('#reserve').DataTable({});
		});
	</script>

</body>

</html>
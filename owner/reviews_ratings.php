<!DOCTYPE html>
<html lang="en">

<?php
session_start();
require_once('../backend/DBconn.php');
include('header.php');

// Calculate the average rating based on the owner's ID
$userId = $_SESSION['id'];
$avgRatingSql = "SELECT AVG(r.rating) as avg_rating
								FROM reviews r
								JOIN tbl_listings l ON r.listing_id = l.listing_id
								WHERE l.owner_id = '$userId'";

$temp_result = mysqli_query($conn, $avgRatingSql);
$avgRating = mysqli_fetch_assoc($temp_result);

// Get reviews
$sqlRatings = "SELECT l.name AS listing_name, r.rating, r.review_text
							FROM reviews r
							JOIN tbl_listings l ON r.listing_id = l.listing_id
							WHERE l.owner_id = '$userId'";

$temp_ratings = mysqli_query($conn, $sqlRatings);

?>


<body>

	<div class="wrapper">
		<?php include('sidebar.php') ?>

		<div id="content">
			<?php include('../layouts/navbar.php') ?>

			<div class="container-fluid">
				<div class="form-head d-flex mb-3 mb-md-5 align-items-start">
					<div class="mr-auto d-none d-lg-block">
						<h3 class="text-primary font-w600">Welcome Owner!</h3>
						<p class="mb-0">Reviews and Ratings Page</p>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-12 col-xxl-12">
						<div class="row">
							<div class="col-xl-4 col-lg-6 col-sm-6">
								<div class="widget-stat card bg-secondary">
									<div class="card-body  p-4">
										<div class="media">
											<span class="mr-3">
												<i class="flaticon-381-star"></i>
											</span>
											<div class="media-body text-white text-right">
												<p class="mb-1 text-white">Average Ratings</p>
												<h3 class="text-white">
													<?php echo number_format($avgRating['avg_rating'], 2); ?>
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
							<div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">My Reviews</h4>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table header-border" id="Orating">
												<thead>
													<tr>
														<th>Listing Name</th>
														<th>Rating</th>
														<th>Review Text</th>
													</tr>
												</thead>
												<tbody>
													<?php
													if (mysqli_num_rows($temp_ratings) >= 1) {
														while ($row = mysqli_fetch_assoc($temp_ratings)) {
															echo '<tr>';
															echo '<td>' . $row['listing_name'] . '</td>';
															echo '<td>' . $row['rating'] . '</td>';
															echo '<td>' . $row['review_text'] . '</td>';
															echo '</tr>';
														}
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

	<script>
		$(document).ready(function() {
			$('#Orating').DataTable({});
		});
	</script>
</body>

</html>
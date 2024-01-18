<!DOCTYPE html>
<html lang="en">

<?php
session_start();
require_once('../backend/DBconn.php');

include('header.php')

?>
<style>

</style>

<body>

	<div class="wrapper">

		<?php include('sidebar.php') ?>

		<div id="content">

			<?php include('navbar.php') ?>

			<!-- row -->
			<div class="row">
				<!-- Create a table to display reviews -->
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">My Reviews</h4>
							<div class="table-responsive">
								<table class="table header-border" id="reviews">
									<thead>
										<tr>
											<th>Listing Name</th>
											<th>Rating</th>
											<th>Review Text</th>
											<!-- Add more columns as needed -->
										</tr>
									</thead>
									<tbody>
										<?php
										// Fetch reviews based on the user's session ID
										$userId = $_SESSION['id'];
										$sqlReviews = "SELECT l.name AS listing_name, r.rating, r.review_text
                                               FROM reviews r
                                               JOIN tbl_listings l ON r.listing_id = l.listing_id
                                               WHERE r.user_id = '$userId'";

										$temp_result = mysqli_query($conn, $sqlReviews);
										// $stmtReviews = $pdo->prepare($sqlReviews);
										// $stmtReviews->bindParam(':userId', $userId, PDO::PARAM_INT);
										// $stmtReviews->execute();

										while ($review = mysqli_fetch_assoc($temp_result)) {
											echo '<tr>';
											echo '<td>' . $review['listing_name'] . '</td>';
											echo '<td>' . $review['rating'] . '</td>';
											echo '<td>' . $review['review_text'] . '</td>';
											// Add more columns as needed
											echo '</tr>';
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
      <br>
      <div class="row">
				<!-- Create a table to display reviews -->
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Owner's Reviews</h4>
							<div class="table-responsive">
								<table class="table header-border" id="reviews">
									<thead>
										<tr>
											<th>Owner Name</th>
											<th>Rating</th>
											<th>Review Text</th>
											<!-- Add more columns as needed -->
										</tr>
									</thead>
									<tbody>
										<?php
										// Fetch reviews based on the user's session ID
										$userId2 = $_SESSION['id'];
										$sqlOwnerReviews = "SELECT * FROM `accounts` acc
                                    INNER JOIN `users` usr
                                    ON usr.session_id = acc.session_id
                                    INNER JOIN `owner_review` o_r
                                    ON o_r.owner_id = acc.id
                                    WHERE o_r.boarder_id = $userId2
                                    and acc.id IN (SELECT DISTINCT(owner_id) FROM `owner_review`)";

										$temp_owner_result = mysqli_query($conn, $sqlOwnerReviews);
										// $stmtReviews = $pdo->prepare($sqlReviews);
										// $stmtReviews->bindParam(':userId', $userId, PDO::PARAM_INT);
										// $stmtReviews->execute();

										while ($owner_review = mysqli_fetch_assoc($temp_owner_result)) {
											echo '<tr>';
											echo '<td>' . $owner_review['fullname'] . '</td>';
											echo '<td>' . $owner_review['rating'] . '</td>';
											echo '<td>' . $owner_review['review_text'] . '</td>';
											// Add more columns as needed
											echo '</tr>';
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

	<script>
		$(document).ready(function() {
			$('#reviews').DataTable({
				"dom": 'lrtip'
			});
		});
	</script>
</body>

</html>
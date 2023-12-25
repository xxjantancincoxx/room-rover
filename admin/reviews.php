<!DOCTYPE html>
<html lang="en">
<?php

session_start();
require_once('../backend/DBconn.php');

include('header.php');

$sqlReviews = "SELECT reviews.review_id, reviews.user_id, reviews.listing_id, reviews.review_text, reviews.rating, reviews.created_at, accounts.user_type, accounts.id, accounts.status, tbl_listings.name, users.fullname 
							FROM reviews, accounts, tbl_listings, users 
							WHERE reviews.user_id = accounts.id AND accounts.status = 'active' and accounts.session_id = users.session_id 
							GROUP BY reviews.review_id";
$queryRun = mysqli_query($conn, $sqlReviews);
?>

<body>
	<div class="wrapper">

		<?php include('sidebar.php') ?>

		<div id="content">

			<?php include('navbar.php') ?>
			<div class="row">
				<div class="col-xl-12 col-xxl-12">
					<div class="row">
						<div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Reviews</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table header-border" id="reviewsTable">
											<thead>
												<tr>
													<th>Full name</th>
													<th>Listing Name</th>
													<th>Rating</th>
													<th>Review Text</th>
												</tr>
											</thead>
											<tbody>
												<?php
												if (mysqli_num_rows($queryRun) >= 1) {
													while ($row = mysqli_fetch_assoc($queryRun)) {
														echo '<tr>';
														echo '<td>' . $row['fullname'] . '</td>';
														echo '<td>' . $row['name'] . '</td>';
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
</body>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

<script>
	$(document).ready(function() {
		$('#reviewsTable').DataTable({

		});
	});
</script>

</html>
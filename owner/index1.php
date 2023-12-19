<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from gymove.dexignzone.com/xhtml/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 20 Aug 2023 01:21:51 GMT -->

<?php include('header.php') ?>

<body>

	<!--*******************
        Preloader start
    ********************-->
	<div id="js-preloader" class="js-preloader">
		<div class="preloader-inner">
			<span class="dot"></span>
			<div class="dots">
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>
	</div>

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
		<?php include('sub-header.php') ?>
		<!--**********************************
            Sub-Header end ti-comment-alt
        ***********************************-->

		<!--**********************************
            Sidebar start
        ***********************************-->
		<?php include('navigation.php') ?>
		<!--**********************************
            Sidebar end
        ***********************************-->

		<!--**********************************
            Content body start
        ***********************************-->
		<div class="content-body">
			<!-- row -->
			<div class="container-fluid">
				<div class="form-head d-flex mb-3 mb-md-5 align-items-start">
					<div class="mr-auto d-none d-lg-block">
						<h3 class="text-primary font-w600">Welcome Owner!</h3>
						<p class="mb-0">Dashboard Panel</p>
					</div>


				</div>
				<div class="row">
					<div class="col-xl-12 col-xxl-12">
						<div class="row">
							<?php
							// Fetch and display the count of listings
							$session_owner_id = $_SESSION['id'];
							$sqlCountListings = "SELECT COUNT(*) AS listingCount FROM tbl_listings WHERE owner_id = :session_owner_id";
							$stmtCountListings = $pdo->prepare($sqlCountListings);
							$stmtCountListings->bindParam(':session_owner_id', $session_owner_id, PDO::PARAM_STR);
							$stmtCountListings->execute();
							$countListings = $stmtCountListings->fetch(PDO::FETCH_ASSOC)['listingCount'];
							?>

							<div class="col-xl-4 col-lg-6 col-sm-6">
								<div class="widget-stat card bg-danger">
									<div class="card-body  p-4">
										<div class="media">
											<span class="mr-3">
												<i class="flaticon-381-home"></i>
											</span>
											<div class="media-body text-white text-right">
												<p class="mb-1">Listings</p>
												<h3 class="text-white"><?php echo $countListings; ?></h3>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Assuming you have a PDO database connection established, and your PDO instance is named $pdo -->
							<?php
							// Fetch and display the sum of all num_rooms for boarder reservations
							$session_owner_id = $_SESSION['id'];
							$sqlSumNumRooms = "SELECT SUM(num_Rooms) AS totalNumRooms FROM tbl_reservations 
                                        JOIN tbl_listings ON tbl_reservations.lid = tbl_listings.listing_id
                                        WHERE tbl_listings.owner_id = :session_owner_id";
							$stmtSumNumRooms = $pdo->prepare($sqlSumNumRooms);
							$stmtSumNumRooms->bindParam(':session_owner_id', $session_owner_id, PDO::PARAM_STR);
							$stmtSumNumRooms->execute();
							$totalNumRooms = $stmtSumNumRooms->fetch(PDO::FETCH_ASSOC)['totalNumRooms'];
							?>

							<div class="col-xl-4 col-lg-6 col-sm-6">
								<div class="widget-stat card bg-success">
									<div class="card-body p-4">
										<div class="media">
											<span class="mr-3">
												<i class="flaticon-381-user"></i>
											</span>
											<div class="media-body text-white text-right">
												<p class="mb-1">Boarders</p>
												<h3 class="text-white"><?php echo $totalNumRooms; ?></h3>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Assuming you have a PDO database connection established, and your PDO instance is named $pdo -->
							<?php
							// Fetch and display the average rating based on reviews
							$session_owner_id = $_SESSION['id'];
							$sqlAverageRating = "SELECT AVG(rating) AS averageRating FROM reviews
                                                JOIN tbl_listings ON reviews.listing_id = tbl_listings.listing_id
                                                WHERE tbl_listings.owner_id = :session_owner_id";
							$stmtAverageRating = $pdo->prepare($sqlAverageRating);
							$stmtAverageRating->bindParam(':session_owner_id', $session_owner_id, PDO::PARAM_STR);
							$stmtAverageRating->execute();
							$averageRating = $stmtAverageRating->fetch(PDO::FETCH_ASSOC)['averageRating'];
							?>

							<div class="col-xl-4 col-lg-6 col-sm-6">
								<div class="widget-stat card bg-info">
									<div class="card-body p-4">
										<div class="media">
											<span class="mr-3">
												<i class="flaticon-381-star"></i>
											</span>
											<div class="media-body text-white text-right">
												<p class="mb-1">Ratings</p>
												<h3 class="text-white"><?php echo number_format($averageRating, 1); ?></h3>
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
										<h4 class="card-title">My Listings</h4>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table id="example3" class="display">
												<thead>
													<tr>
														<th>#</th>
														<th>Listing Name</th>
														<th>E-wallet</th>
														<th>QR CODE</th>
														<th>Location</th>
														<th>Price</th>
														<th>Rooms Available</th>
														<th>Airconditioned</th>
														<th>Free Water and Electricity</th>
														<th>Free Wifi</th>
														<th>Has Own CR</th>
														<th>Date Added</th>
														<th>Pic</th>
													</tr>
												</thead>
												<tbody>


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
		<!--**********************************
            Content body end
        ***********************************-->

		<!--**********************************
            Footer start
        ***********************************-->
		<div class="footer">
			<div class="copyright">
				<p>BSIT 4 Capstone Project 2023</p>
			</div>
		</div>
		<!--**********************************
            Footer end
        ***********************************-->


	</div>
	<!--**********************************
        Main wrapper end
    ***********************************-->

	<!--**********************************
        Scripts
    ***********************************-->
	<?php include('footer_links.php') ?>
	<!--**********************************
        End Scripts
    ***********************************-->
</body>

</html>
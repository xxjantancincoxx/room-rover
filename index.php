<?php

session_start();

use function PHPSTORM_META\type;

include('layouts/header.php');
require_once('backend/DBconn.php');

if (isset($_SESSION["username"])) {
	if ($_SESSION["user_type"] === "boarder") {
		header("Location: /room_rover/boarder?session=" . $_SESSION["session"]);
		exit();
	} else if ($_SESSION["user_type"] === "owner") {
		header("Location: /room_rover/owner?session=" . $_SESSION["session"]);
		exit();
	}
}


// Set the BASE_URL
$BASE_URL = 'http://localhost/room_rover/';

$sql = "SELECT l.*, COUNT(r.review_id) AS review_count, IFNULL(AVG(r.rating), 0) AS average_rating FROM tbl_listings l LEFT JOIN reviews r ON l.listing_id = r.listing_id GROUP BY l.listing_id LIMIT 3";

$resultset = mysqli_query($conn, $sql);

?>

<body>
	<?php include('layouts/navigation.php') ?>

	<style>
		.card-body {
			height: 290px;
		}

		.carousel-inner img {
			width: 100%;
			height: 75%;
		}
	</style>

	<?php include('layouts/carousel.php') ?>

	<?php include('layouts/homepage_card.php') ?>

	<div class="col-lg-12">
		
		<!-- Services -->
		<div class="services">
			<div class="col-lg-12">
				<div class="section-heading">
					<h2 style="color:#FFFFFF">Our Services</h2>
				</div>
			</div>
			<div class="container">
				<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
					<div class="col">
						<div class="card">
							<img src="assets/images/service1.jpg" class="card-img-top" alt="Service 1">
							<div class="card-body">
								<h4 class="card-title">Post your Rental Room</h4>
								<p class="card-text">
								Attractive and cozy rental room available! Showcase your ideal living space online with vibrant photos, detailed amenities, and contact information. Don't miss out on the perfect tenant for your space!
								</p>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card">
							<img src="assets/images/service2.jpg" class="card-img-top" alt="Service 2">
							<div class="card-body">
								<h4 class="card-title">Manage your Boarders</h4>
								<p class="card-text">
								<ul>
									<p>Collecting Rent</p>
									<p>Property Maintenance</p>
									<p>Enforcing House Rules</p>
									<p>Addressing Concerns</p>
									<p>Screening and Selecting Boarders</p>
									<p>Record Keeping</p>
									<p>Providing Notice</p>
									<p>Compliance with Local Regulations</p>
								</ul>
								</p>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card">
							<img src="assets/images/service3.jpg" class="card-img-top" alt="Service 3">
							<div class="card-body">
								<h5 class="card-title">Online Reservation</h5>
								<p class="card-text">Experience the convenience of securing your dream apartment online. Simply choose your desired move-in date, floor plan, and amenities to effortlessly reserve your future home for a seamless living experience.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>




		<!-- *** Message *** -->
		<div class="feedback">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<h4>What's your feedback?</h4>
					</div>
					<div class="col-lg-8">
						<form id="feedback" action="" method="get">
							<div class="row">
								<div class="col-lg-9">
									<fieldset>
										<input name="feedback" type="text" id="feedback" placeholder="Your message to us" required="">
									</fieldset>
								</div>
								<div class="col-lg-3">
									<fieldset>
										<button type="submit" id="form-submit" class="main-dark-button">Submit</button>
									</fieldset>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
</body>

</html>
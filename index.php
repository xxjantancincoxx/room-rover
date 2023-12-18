<?php

use function PHPSTORM_META\type;

include('layouts/header.php');
if (isset($_GET['code'])) {
	// Get Token
	$token = $gclient->fetchAccessTokenWithAuthCode($_GET['code']);

	// Check if fetching token did not return any errors
	if (!isset($token['error'])) {
		// Setting Access token
		$gclient->setAccessToken($token['access_token']);

		// store access token
		//$_SESSION['access_token'] = $token['access_token'];

		// Get Account Profile using Google Service
		//$gservice = new Google_Service_Oauth2($gclient);

		// Get User Data
		// $udata = $gservice->userinfo->get();
		// echo $udata;
	}
}

session_start();
require_once('backend/DBconn.php');

// Set the BASE_URL
$BASE_URL = 'http://localhost/room_rover/';

$sql = "SELECT l.*, COUNT(r.review_id) AS review_count, IFNULL(AVG(r.rating), 0) AS average_rating FROM tbl_listings l LEFT JOIN reviews r ON l.listing_id = r.listing_id GROUP BY l.listing_id LIMIT 3";

$resultset = mysqli_query($conn, $sql);

?>

<body>

	<!-- ***** Navigation ****** -->
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

	<div id="demo" class="carousel slide" data-ride="carousel">
		<ul class="carousel-indicators">
			<li data-target="#demo" data-slide-to="0" class="active"></li>
			<li data-target="#demo" data-slide-to="1"></li>
			<li data-target="#demo" data-slide-to="2"></li>
		</ul>
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img src="assets/images/carousel1.jpg" alt="Los Angeles" width="1100" height="500">
				<div class="carousel-caption">
					<h3>Go Big, or Go Home.</h3>
					<h6>- ELiza Dushku -</h6>
				</div>
			</div>
			<div class="carousel-item">
				<img src="assets/images/carousel2.jpg" alt="Chicago" width="1100" height="500">
				<div class="carousel-caption">
					<h3>Home isn't a place. It's a feeling.</h3>
					<h6>- Cecilia Ahern -</h6>
				</div>
			</div>
			<div class="carousel-item">
				<img src="assets/images/carousel3.jpg" alt="New York" width="1100" height="500">
				<div class="carousel-caption">
					<h3>Price is what you pay, value is what you get.</h3>
					<h6>- Warren Buffet -</h6>
				</div>
			</div>
		</div>
		<a class="carousel-control-prev" href="#demo" data-slide="prev">
			<span class="carousel-control-prev-icon"></span>
		</a>
		<a class="carousel-control-next" href="#demo" data-slide="next">
			<span class="carousel-control-next-icon"></span>
		</a>
	</div>

	<div class="col-lg-12">
		<div class="section-heading">
			<h2>Available Boarding Houses</h2>
		</div>
		<?php foreach ($resultset as $result) : ?>
			<label><?= $result['name']; ?> </label>
			<div class="row">
				<div class="col-md-4" style="padding: 30px;">
					<div class="card hovercard text-center">
						<div class="cardheader">
							<div class="avatar">
								<img alt="" src="<?php echo $BASE_URL . 'backend/api/uploads/OWNER' . $result['owner_id'] . '/' . $record['pic']; ?>" class="img-fluid" style="max-height: 200px; max-width: 100%;">
							</div>
						</div>
						<div class="card-body info">
							<div class="title">
								<a href="#" style="font-size: 18px; font-weight: bold; color: #333;"><?php echo $result['name']; ?></a>
							</div>
							<div class="desc loc" style="font-size: 15px; color: #666;">
								<?php echo ($result['location']); ?>
							</div>
							<div class="desc price-per-room" style="font-size: 18px; color: #666; font-weight: bold;">
								<?php echo '₱' . number_format($result['price']); ?>
							</div>
							<div class="desc text-left">
								<strong>E-wallet/Contact Number:</strong> <?php echo $result['e_wallet']; ?>
							</div>
							<div class="desc text-left">
								<strong>Condition:</strong> <?php echo $result['is_aircon'] ? 'Air Conditioned' : 'No Air Condition'; ?>
							</div>
							<div class="desc text-left">
								<strong>Water & Electric:</strong> <?php echo $result['free_water_electric'] ? 'Free Water and Electric' : 'No Free Water and Electric'; ?>
							</div>
							<div class="desc text-left">
								<strong>WiFi:</strong> <?php echo $result['free_wifi'] ? 'Free WiFi' : 'No Free WiFi'; ?>
							</div>
							<div class="desc text-left">
								<strong>Own CR:</strong> <?php echo $result['own_cr'] ? 'Own CR' : 'No Own CR'; ?>
							</div>
							<div class="desc text-left">
								<strong>Rooms Available:</strong> <?php echo $result['rooms_Available']; ?>
							</div>
							<div class="desc text-left">
								<strong>Number of Reviews:</strong> <?php echo $result['review_count']; ?>
							</div>
							<div class="desc text-left">
								<strong>Rating:</strong>
								<!-- Use the average_rating column in the star-indicator data-rating attribute -->
								<div class="star-indicator" data-rating="<?php echo $result['average_rating']; ?>"></div>
								<!-- Display the average rating value -->
								<span><?php echo number_format($result['average_rating'], 2); ?></span>
							</div>

						</div>

						<div class="card-footer bottom">
							<!-- Update Reserve Button -->
							<a class="btn btn-primary btn-reserve btn-sm reserve-button" href="../room_rover/login.php">Reserve
							</a>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>

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
									This helps people looking for a place to rent find available options and contact the person offering the room for rent.
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
								<p class="card-text">The process of booking and reserving rooms or accommodations within a boarding house through an online platform or website.</p>
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
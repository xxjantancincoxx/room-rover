<!DOCTYPE html>
<html lang="en">

<?php

session_start();

if (!isset($_SESSION["session_id"])) {
	header("Location: ../index.php");
	exit();
}

include('header.php')

?>

<style>
	#content {
		width: 100%;
		padding: 20px;
		min-height: 100vh;
		transition: all 0.3s;
	}
</style>


<body>
	<div class="wrapper">

		<?php include('sidebar.php') ?>

		<div id="content">

			<?php include('./layouts/navbar.php') ?>

			<?php include('dashboard_content.php') ?>
		</div>
	</div>


	<!-- < ?php include('sub-header.php') ?> -->

	<!-- < ?php include('navigation.php') ?> -->

	<!-- <div class="content-body"> -->
	<!-- <div class="container-fluid">
				<div class="form-head d-flex mb-3 mb-md-5 align-items-start">
					<div class="mr-auto d-none d-lg-block">
						<h3 class="text-primary font-w600">Welcome!</h3>
						<p class="mb-0">Dashboard Panel</p>
					</div>
				</div>

				<div class="row">
					<div class="col-xl-4 col-lg-6 col-sm-6">
						<div class="widget-stat card bg-info">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="flaticon-381-home"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Reservations</p>
										<h3 class="text-white">
											< ?php -->
	<!-- // Fetch and display the count of reservations
											// $session_id = $_SESSION['id'];
											// $sqlCountReservations = "SELECT COUNT(*) AS reservationCount FROM tbl_reservations WHERE uid = :session_id";
											// $stmtCountReservations = $pdo->prepare($sqlCountReservations);
											// $stmtCountReservations->bindParam(':session_id', $session_id, PDO::PARAM_STR);
											// $stmtCountReservations->execute();
											// $countReservations = $stmtCountReservations->fetch(PDO::FETCH_ASSOC)['reservationCount'];
											// echo $countReservations;
											?>
										</h3>
									</div>
								</div>
							</div>
						</div>
					</div>


				</div>

				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Active Reservations</h4>
							</div>
							<div class="card-body"> -->
	<!-- Assuming you have a PDO database connection established, and your PDO instance is named $pdo -->
	<!-- < ?php
								// Fetch reservations data
								$sqlReservations = "SELECT tbl_reservations.rs_id, tbl_reservations.lid, tbl_reservations.uid, tbl_reservations.num_Rooms, tbl_reservations.status, tbl_reservations.date_created, tbl_listings.name
                    FROM tbl_reservations
                    JOIN tbl_listings ON tbl_reservations.lid = tbl_listings.listing_id
                    WHERE tbl_reservations.uid = :session_id";
								$stmtReservations = $pdo->prepare($sqlReservations);
								$stmtReservations->bindParam(':session_id', $session_id, PDO::PARAM_STR);
								$stmtReservations->execute();
								$reservations = $stmtReservations->fetchAll(PDO::FETCH_ASSOC);
								?> -->

	<!-- Display reservations in cards with images -->
	<!-- < ?php
								foreach (array_chunk($reservations, 3) as $reservationChunk) :
									echo '<div class="row">';
									foreach ($reservationChunk as $reservation) :
								?>
										<div class="col-xl-4 col-lg-6 col-sm-6">
											<div class="card">


												<div class="card-body">
													<h5 class="card-title">Reservation < ?php echo $reservation['rs_id']; ?></h5>
													<p class="card-text">Listing: < ?php echo $reservation['name']; ?></p>
													<p class="card-text">Number of Rooms: < ?php echo $reservation['num_Rooms']; ?></p>
													<p class="card-text">Status: < ?php echo $reservation['status'] == 1 ? 'Confirmed' : 'Pending'; ?></p>
													<p class="card-text">Date Created: < ?php echo $reservation['date_created']; ?></p>
												</div>
											</div>
										</div>
								< ?php endforeach;
									echo '</div>';
								endforeach;
								?> -->


	<!-- </div> -->
	<!-- </div> -->
	<!-- </div>
	</div>

	</div>
	</div>
	</div> -->
</body>

</html>
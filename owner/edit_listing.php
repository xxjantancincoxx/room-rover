<!DOCTYPE html>
<html lang="en">

<?php
session_start();

if (!isset($_SESSION["id"])) {
	header("Location: ../index.php");
	exit();
}

require_once('../backend/DBconn.php');

include('header.php');

$session_id = $_SESSION["session_id"];
if (!isset($_GET["listingId"])) {
	header("Location: my_listings.php?session=" . $_SESSION["session"]);
	exit();
}

$id = $_GET["listingId"];
$sql = "SELECT * FROM tbl_listings as tbl WHERE listing_id = '$id';";
$temp_result = mysqli_query($conn, $sql);
$result = mysqli_fetch_assoc($temp_result);
?>

<body>

	<div class="wrapper">

		<?php include('sidebar.php') ?>

		<div id="content">

			<?php include('../layouts/navbar.php') ?>

			<div class="container-fluid">
				<div class="form-head d-flex mb-3 mb-md-5 align-items-start">
					<div class="mr-auto d-none d-lg-block">
						<h3 class="text-secondary font-w600">Welcome Owner!</h3>
						<p class="mb-0">Edit Listings Page</p>
						<!-- < ?php print_r($result); ?> -->
					</div>


				</div>
				<div class="row">

					<div class="col-xl-12 col-xxl-12">
						<div class="row">
							<!-- <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12"> -->
							<div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">Add a New Listing</h4>
									</div>
									<div class="card-body">
										<div class="basic-form">
											<form enctype="multipart/form-data" action="../backend/api/edit_listing.php" method="POST">
												<div class="row">
													<div class="col-xl-12">
														<div class="form-group row">
															<label class="col-sm-3 col-form-label">Listing Name:</label>
															<div class="col-sm-6">
																<input type="text" id="li_name" name="newLiName" class="form-control" value="<?php echo $result["name"] ?>" placeholder="Name" required>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-sm-3 col-form-label">E-wallet No.:</label>
															<div class="col-sm-6">
																<input type="text" id="li_wal" name="newLiWal" class="form-control" value="<?php echo $result["e_wallet"] ?>" placeholder="09098....." required>
															</div>
														</div>
														<!-- Input for QR code upload -->
														<div class="form-group row">
															<label class="col-sm-3 col-form-label">E-Wallet QR Code</label>
															<div class="col-sm-6">
																<input type="file" class="form-control" id="ewallet_qr_code" name="ewallet_qr_code" accept="image/*">
															</div>
														</div>
														<div class="form-group row">
															<label class="col-sm-3 col-form-label">Location:</label>
															<div class="col-sm-6">
																<input type="text" id="li_loc" name="newLiLoc" class="form-control" value="<?php echo $result["location"] ?>" placeholder="Location" required>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-sm-3 col-form-label">Price: </label>
															<div class="col-sm-6">
																<input type="number" name="newPrice" id="price" class="form-control" value="<?php echo $result["price"] ?>" placeholder="Price" required>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-sm-3 col-form-label">Rooms Available: </label>
															<div class="col-sm-6">
																<input type="number" name="newRooms" id="rooms" value="<?php echo $result["rooms_Available"] ?>" class="form-control" placeholder="Number of rooms available" required>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-sm-3 col-form-label">Listing Pic:</label>
															<div class="col-sm-6">
																<div class="form-file">
																	<input type="file" id='listingpic' multiple="multiple" name="editListingPic[]" class="form-file-input form-control" accept="image/*">
																</div>
															</div>
														</div>
														<hr>
														<h3>Amenities</h3>
														<div class="form-group row">
															<label class="col-sm-3 col-form-label">Free Water and Electricity?</label>
															<div class="col-sm-4">
																<select id="we" name="newWe" class="form-control form-control-lg" required>
																	<option value="1" <?php if ($result["free_water_electric"] == 1) echo 'selected';  ?>>Yes</option>
																	<option value="0" <?php if ($result["free_water_electric"] == 0) echo 'selected';  ?>>No</option>
																</select>
															</div>
														</div>

														<div class="form-group row">
															<label class="col-sm-3 col-form-label">Airconditioned?</label>
															<div class="col-sm-4">
																<select id="aircon" name="newAircon" class="form-control form-control-lg" required>
																	<option value="1" <?php if ($result["is_aircon"] == 1) echo 'selected';  ?>>Yes</option>
																	<option value="0" <?php if ($result["is_aircon"] == 0) echo 'selected';  ?>>No</option>
																</select>
															</div>
														</div>

														<div class="form-group row">
															<label class="col-sm-3 col-form-label">Free Wifi?</label>
															<div class="col-sm-4">
																<select id="wifi" name="newWifi" class="form-control form-control-lg" required>
																	<option value="1" <?php if ($result["free_wifi"] == 1) echo 'selected';  ?>>Yes</option>
																	<option value="0" <?php if ($result["free_wifi"] == 0) echo 'selected';  ?>>No</option>
																</select>
															</div>
														</div>

														<div class="form-group row">
															<label class="col-sm-3 col-form-label">Own CR?</label>
															<div class="col-sm-4">
																<select id="own_cr" name="newOwnCr" class="form-control form-control-lg" required>
																	<option value="1" <?php if ($result["own_cr"] == 1) echo 'selected';  ?>>Yes</option>
																	<option value="0" <?php if ($result["own_cr"] == 0) echo 'selected';  ?>>No</option>
																</select>
															</div>
														</div>
														<div class="form-group row">
															<div class="col-sm-12 d-flex justify-content-end">
																<a id="clear" type="button" href="<?php echo "my_listings.php?session=" . $_SESSION["session"]; ?>" class="btn btn-danger btn-square mr-2">Cancel</a>
																<button id="save_listing" type="submit" class="btn btn-success btn-square">Save</button>
															</div>
														</div>
													</div>
												</div>
											</form>
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
</body>

</html>
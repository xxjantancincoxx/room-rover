<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>
<?php require_once('../backend/DBconn.php'); ?>

<?php include('header.php') ?>
<?php
// Set sessionId in a script tag
echo "<script>const sessionId = " . json_encode($_SESSION['id']) . ";</script>";
$id = $_SESSION["id"];
$session_id = $_SESSION["session_id"];

$sql = "SELECT * from tbl_listings WHERE owner_id = '$id';";
$temp_result = mysqli_query($conn, $sql);

$session_owner_id = $_SESSION['id'];
$sqlCountListings = "SELECT COUNT(*) AS listingCount FROM tbl_listings WHERE owner_id = '$session_owner_id';";
$resultCountListings_temp = mysqli_query($conn, $sqlCountListings);
$resultCountListings = mysqli_fetch_assoc($resultCountListings_temp);

$result_collector = array();
?>

<body>
  <div class="wrapper">
    <?php include('sidebar.php') ?>

    <div id="content">
      <?php include('../layouts/navbar.php') ?>

      <!-- row -->
      <div class="container-fluid">
        <div class="form-head d-flex mb-3 mb-md-5 align-items-start">
          <div class="mr-auto d-none d-lg-block">
            <h3 class="text-primary font-w600">Welcome Owner!</h3>
            <p class="mb-0">My Listings Page</p>
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
                        <i class="flaticon-381-home"></i>
                      </span>
                      <div class="media-body text-white text-right">
                        <p class="mb-1 text-white">Listings</p>
                        <h3 class="text-white" id="listing_count"><?php echo $resultCountListings["listingCount"]; ?></h3>
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
                    <a href="add_listing.php" class="btn btn-success shadow btn-md ">Add Listing</a>
                  </div>
                  <div class="card-body p-4">
                    <div class="table-responsive">
                      <table id="example3" class="display">
                        <thead>
                          <tr>
                            <!-- <th>#</th> -->
                            <th>Listing Name</th>
                            <!-- <th>E-wallet</th> -->
                            <!-- <th>QR CODE</th> -->
                            <th>Location</th>
                            <th>Price</th>
                            <th>Rooms Available</th>
                            <!-- <th>Airconditioned</th> -->
                            <!-- <th>Free Water and Electricity</th> -->
                            <!-- <th>Free Wifi</th> -->
                            <!-- <th>Has Own CR</th> -->
                            <th>Date Added</th>
                            <!-- <th>Pic</th> -->
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if (mysqli_num_rows($temp_result) >= 1) {
                            while ($row = mysqli_fetch_assoc($temp_result)) {
                              $listing_id = $row["listing_id"];
                              $result_collector[$listing_id] = $row;
                              echo "<tr class=\"pb-5\">";
                              echo "<td >" . $row["name"] . "</td>";
                              echo "<td>" . $row["location"] . "</td>";
                              echo "<td>" . $row["price"] . "</td>";
                              echo "<td>" . $row["rooms_Available"] . "</td>";
                              echo "<td>" . $row["date_added"] . "</td>";
                              echo "<td><a class=\"btn btn-sm btn-primary mt-1\">View</a><a class=\"btn btn-sm btn-secondary ml-2 mr-2 mt-1\" href=\"edit_listing.php?session=" . $_SESSION["session"] . "&listingId=" . $listing_id . "\"" . ">Edit</a><a class=\"btn btn-sm btn-danger mt-1\">Delete</a></td>";
                              echo "</tr>";
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

    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="agreement" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="agreement">Agreement to the Admin</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>In this collaborative venture, the Owner and Administrator mutually agree to abide by the terms and conditions outlined herein. The Owner entrusts the Administrator with specified responsibilities, encompassing: Oversee the maintenance, cleanliness, and overall condition of the boarding house property. Interact with tenants, addressing concerns, and ensuring a positive living environment. Draft, review, and manage lease agreements, outlining terms and conditions for tenants. Handle rent collection, financial transactions, and budgeting for the boarding house. Ensure the boarding house complies with safety regulations and local housing codes. Implement and maintain security measures to safeguard both property and tenants. Coordinate utility services and address any issues related to water, electricity, heating, and other amenities. Develop and communicate emergency procedures, responding promptly to any urgent situations.Market and attract tenants through effective advertising and tenant screening processes.Screen potential tenants, conduct interviews, and select suitable individuals based on established criteria. Mediate disputes between tenants and address conflicts to maintain a harmonious living environment.


              Conduct regular inspections of the property to identify and address maintenance needs promptly.

              Maintain accurate records of lease agreements, payments, and any communication with tenants.

              Foster a sense of community among tenants through organized events or activities.

              Stay informed about and adhere to local, state, and federal laws related to property management and tenant rights. while maintaining ultimate authority over critical decisions. The Administrator acknowledges and accepts these responsibilities, committing to execute them diligently. Both parties commit to transparent communication, promptly addressing concerns and seeking amicable resolutions. Violation of these terms may result in termination of the agreement. This agreement establishes a framework akin to terms and conditions, fostering a cooperative and productive working relationship.</p>
          </div>
        </div>
      </div>
    </div>

    <!--**********************************
            Content body end
        ***********************************-->
    <!-- Edit Listing Modal -->
    <div class="modal fade" id="editListingModal" tabindex="-1" role="dialog" aria-labelledby="editListingModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editListingModalLabel">Edit Listing</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Input fields for editing listing details -->
            <div class="form-group">
              <label for="editLiName">Listing Name</label>
              <input type="text" class="form-control" id="editLiName" placeholder="Enter Listing Name">
            </div>
            <div class="form-group">
              <label for="editLiWal">E-wallet</label>
              <input type="text" class="form-control" id="editLiWal" placeholder="Enter e-wallet">
            </div>
            <div class="form-group">
              <label for="editLiName">Location</label>
              <input type="text" class="form-control" id="editLiLoc" placeholder="Enter Listing Name">
            </div>
            <div class="form-group">
              <label for="editPrice">Price</label>
              <input type="number" class="form-control" id="editPrice" placeholder="Enter Price">
            </div>
            <div class="form-group">
              <label for="editRooms">Rooms Available</label>
              <input type="number" class="form-control" id="editRooms" placeholder="Enter Number of Rooms Available">
            </div>
            <!-- Add an img tag to display the image -->

            <!-- Input for file upload -->
            <input type="file" class="form-control" id="editListingPicInput" accept="image/*" style="display: none;">

            <!-- Custom display for file name -->
            <div class="form-group">
              <label for="editListingPic">Listing Pic</label>
              <img src="" alt="Listing Pic" id="editListingPicPreview" style="max-width: 100%; height: auto;">

              <!-- Update the file input name attribute -->
              <input type="file" class="form-control" id="editListingPicInput" name="editListingPicInput" accept="image/*" style="display: none;">

              <button type="button" class="btn btn-primary" onclick="$('#editListingPicInput').click();">Choose File</button>
            </div>

            <hr>

            <h3>Amenities</h3>

            <div class="form-group">
              <label for="editWe">Free Water and Electricity?</label>
              <select id="editWe" class="form-control">
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
            </div>

            <div class="form-group">
              <label for="editAircon">Airconditioned?</label>
              <select id="editAircon" class="form-control">
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
            </div>

            <div class="form-group">
              <label for="editWifi">Free Wifi?</label>
              <select id="editWifi" class="form-control">
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
            </div>

            <div class="form-group">
              <label for="editOwnCr">Own CR?</label>
              <select id="editOwnCr" class="form-control">
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveEditListingBtn">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
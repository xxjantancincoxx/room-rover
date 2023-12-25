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

<script>
  function callPhp() {

  }
</script>

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
                              echo "<td><a class=\"btn btn-sm btn-primary mt-1\" data-toggle=\"modal\"\" data-target=\"#viewListingModal" . $row['listing_id'] . "\" \">View</a><a class=\"btn btn-sm btn-secondary ml-2 mr-2 mt-1\" href=\"edit_listing.php?session=" . $_SESSION["session"] . "&listingId=" . $listing_id . "\"" . ">Edit</a><a class=\"btn btn-sm btn-danger mt-1\" data-toggle=\"modal\"\" data-target=\"#deleteModal" . $row['listing_id'] . "\" \">Delete</a></td>";
                              echo "</tr>";
                          ?>
                              <div class="modal fade" id="viewListingModal<?php echo $row['listing_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="viewListingModal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="editListingModalLabel">View Listing</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <!-- Input fields for editing listing details -->
                                      <div class="row">
                                        <div class="col col-md-6">
                                          <div class="form-group">
                                            <label for="editLiName">Listing Name</label>
                                            <input type="text" class="form-control" disabled value="<?php echo $row["name"]; ?>">
                                          </div>
                                          <div class="form-group">
                                            <label for="editLiWal">E-wallet</label>
                                            <input type="text" class="form-control" disabled value="<?php echo $row["e_wallet"]; ?>">
                                          </div>
                                          <div class="form-group">
                                            <label for="editLiName">Location</label>
                                            <input type="text" class="form-control" id="editLiLoc" disabled value="<?php echo $row["location"]; ?>">
                                          </div>
                                          <div class=" form-group">
                                            <label for="editPrice">Price</label>
                                            <input type="number" class="form-control" id="editPrice" disabled value="<?php echo $row["price"]; ?>">
                                          </div>
                                          <div class="form-group">
                                            <label for="editRooms">Rooms Available</label>
                                            <input type="number" class="form-control" id="editRooms" disabled value="<?php echo $row["rooms_Available"]; ?>">
                                          </div>
                                          <!-- Add an img tag to display the image -->

                                          <!-- Input for file upload -->
                                          <!-- <input type="file" class="form-control" id="editListingPicInput" accept="image/*" style="display: none;"> -->

                                          <!-- Custom display for file name -->
                                          <div class="form-group">
                                            <label for="editListingPic">Listing Pic</label>
                                            <br>
                                            <?php
                                            $obj = json_decode($row["pic"]);
                                            foreach ($obj as $key => $value) {
                                              echo "<img src=\"../backend/api/uploads/OWNER" . $row["owner_id"] . "/" . $value . "\" style=\"max-width: 100%; height: auto;\">";
                                            }
                                            ?>
                                            <!-- <img src="" alt="Listing Pic" id="editListingPicPreview" style="max-width: 100%; height: auto;"> -->

                                            <!-- Update the file input name attribute -->
                                            <!-- <input type="file" class="form-control" id="editListingPicInput" name="editListingPicInput" accept="image/*" style="display: none;">

                                        <button type="button" class="btn btn-primary" onclick="$('#editListingPicInput').click();">Choose File</button> -->
                                          </div>
                                        </div>
                                        <div class="col col-md-6">
                                          <div class="form-group">
                                            <label for="editWe">Free Water and Electricity?</label>
                                            <select id="editWe" disabled class="form-control">
                                              <option value="1" <?php if ($row["free_water_electric"] == 1) echo 'selected="selected"'; ?> >Yes</option>
                                              <option value="0" <?php if ($row["free_water_electric"] == 0) echo 'selected="selected"'; ?>>No</option>
                                            </select>
                                          </div>

                                          <div class="form-group">
                                            <label for="editAircon">Air conditioned?</label>
                                            <select id="editAircon" disabled class="form-control">
                                              <option value="1" <?php if ($row["is_aircon"] == 1) echo 'selected';  ?>>Yes</option>
                                              <option value="0" <?php if ($row["is_aircon"] == 0) echo 'selected';  ?>>No</option>
                                            </select>
                                          </div>

                                          <div class="form-group">
                                            <label for="editWifi">Free Wifi?</label>
                                            <select id="editWifi" disabled class="form-control">
                                              <option value="1" <?php if ($row["free_wifi"] == 1) echo 'selected';  ?>>Yes</option>
                                              <option value="0" <?php if ($row["free_wifi"] == 0) echo 'selected';  ?>>No</option>
                                            </select>
                                          </div>

                                          <div class="form-group">
                                            <label for="editOwnCr">Own CR?</label>
                                            <select id="editOwnCr" disabled class="form-control">
                                              <option value="1" <?php if ($row["own_cr"] == 1) echo 'selected';  ?>>Yes</option>
                                              <option value="0" <?php if ($row["own_cr"] == 0) echo 'selected';  ?>>No</option>
                                            </select>
                                          </div>
                                          <div class="form-group">
                                            <label for="editOwnCr">QR Code:</label>
                                            <br>
                                            <?php
                                            echo "<img src=\"../backend/api/uploads/OWNER" . $row["owner_id"] . "/" . $row["qr_pic"] . "\" style=\"max-width: 100%; height: auto;\">";
                                            ?>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="modal fade" id="deleteModal<?php echo $row['listing_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModal">
                                <div class="modal-dialog modal-sm" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                      Are you sure you want to delete this Listing?
                                    </div>
                                    <div class="modal-footer">
                                      <form action="../backend/api/delete_listing.php" method="POST">
                                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                        <input type="number" name="listingId" value="<?php echo $row["listing_id"] ?>" style="display:none;">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          <?php }
                          } ?>
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
</body>

</html>
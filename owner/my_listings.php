<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>
<?php require_once('../backend/DBconn.php'); ?>

<?php include('header.php') ?>
<?php
// Set sessionId in a script tag
echo '<script>const sessionId = ' . json_encode($_SESSION['id']) . ';</script>';
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
                        <h3 class="text-white" id="listing_count">0</h3>
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
                            <th>Action</th>
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
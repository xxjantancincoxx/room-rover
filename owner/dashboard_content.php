<div class="container">
  <div class="alert alert-container" role="alert">
    <h3 class="text-secondary font-weight-bold" style="font-size:1.5rem;">Welcome Owner!</h3>
    <div>Reviews Page</div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <?php
        // Fetch and display the count of listings
        $session_owner_id = $_SESSION['id'];
        $sqlCountListings = "SELECT COUNT(*) AS listingCount FROM tbl_listings WHERE owner_id = '$session_owner_id';";
        $resultCountListings_temp = mysqli_query($conn, $sqlCountListings);
        $resultCountListings = mysqli_fetch_assoc($resultCountListings_temp);
        ?>

        <div class="col-sm-4">
          <div class="widget-stat card bg-danger">
            <div class="card-body  p-4">
              <div class="media">
                <span class="mr-3">
                  <i class="flaticon-381-home"></i>
                </span>
                <div class="media-body text-white text-right">
                  <p class="text-white mb-1">Listings</p>
                  <h3 class="text-white"><?php echo $resultCountListings["listingCount"]; ?></h3>
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
                                        WHERE tbl_listings.owner_id = '$session_owner_id'";
        $resultNumRooms_temp = mysqli_query($conn, $sqlSumNumRooms);
        $resultNumRooms = mysqli_fetch_assoc($resultNumRooms_temp);
        ?>

        <div class="col-sm-4">
          <div class="widget-stat card bg-success">
            <div class="card-body p-4">
              <div class="media">
                <span class="mr-3">
                  <i class="flaticon-381-user"></i>
                </span>
                <div class="media-body text-white text-right">
                  <p class="text-white mb-1">Boarders</p>
                  <h3 class="text-white"><?php echo $resultNumRooms["totalNumRooms"]; ?></h3>
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
                                                WHERE tbl_listings.owner_id = '$session_owner_id'";
        $resultAverage_temp = mysqli_query($conn, $sqlAverageRating);
        $resultAverageRating = mysqli_fetch_assoc($resultAverage_temp);
        ?>

        <div class="col-sm-4">
          <div class="widget-stat card bg-info">
            <div class="card-body p-4">
              <div class="media">
                <span class="mr-3">
                  <i class="flaticon-381-star"></i>
                </span>
                <div class="media-body text-white text-right">
                  <p class="text-white mb-1">Ratings</p>
                  <h3 class="text-white"><?php echo number_format($resultAverageRating["averageRating"], 1); ?></h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card" style="width: auto;">
      <div class="card-header">
        <h4 class="card-title">My Listings</h4>
        <a href="add_listing.php" class="btn btn-success shadow btn-md ">Add Listing</a>
      </div>
      <div class="card-body ">
        <div class="table-responsive">
          <div id="example3_wrapper" class="dataTables_wrapper no-footer">
            <div class="dataTables_length" id="example3_length"><label>Show <select name="example3_length" aria-controls="example3" class="">
                  <option value="15">15</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                  <option value="-1">All</option>
                </select> entries</label></div>
            <div id="example3_filter" class="dataTables_filter"><label><input type="search" class="" placeholder="Search Listings...." aria-controls="example3"></label></div>
            <table id="example3" class="display dataTable no-footer" role="grid" aria-describedby="example3_info">
              <thead>
                <tr role="row">
                  <th class="sorting_asc" rowspan="1" colspan="1" aria-label="#" style="width: 12.4219px;">#</th>
                  <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" aria-label="Listing Name: activate to sort column ascending" style="width: 92.4531px;">Listing Name</th>
                  <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" aria-label="E-wallet: activate to sort column ascending" style="width: 58.7812px;">E-wallet</th>
                  <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" aria-label="QR CODE: activate to sort column ascending" style="width: 62.5625px;">QR CODE</th>
                  <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" aria-label="Location: activate to sort column ascending" style="width: 60.7969px;">Location</th>
                  <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending" style="width: 35.1406px;">Price</th>
                  <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" aria-label="Rooms Available: activate to sort column ascending" style="width: 119.672px;">Rooms Available</th>
                  <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" aria-label="Airconditioned: activate to sort column ascending" style="width: 105.219px;">Airconditioned</th>
                  <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" aria-label="Free Water and Electricity: activate to sort column ascending" style="width: 181.75px;">Free Water and Electricity</th>
                  <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" aria-label="Free Wifi: activate to sort column ascending" style="width: 60.6406px;">Free Wifi</th>
                  <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" aria-label="Has Own CR: activate to sort column ascending" style="width: 85.625px;">Has Own CR</th>
                  <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" aria-label="Date Added: activate to sort column ascending" style="width: 84.0781px;">Date Added</th>
                  <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" aria-label="Pic: activate to sort column ascending" style="width: 20.8438px;">Pic</th>
                </tr>
              </thead>
              <tbody>
                <tr class="odd">
                  <td valign="top" colspan="13" class="dataTables_empty">No Listings found</td>
                </tr>
              </tbody>
            </table>
            <div class="dataTables_info" id="example3_info" role="status" aria-live="polite">Showing 0 to 0 of 0 entries</div>
            <div class="dataTables_paginate paging_full_numbers" id="example3_paginate"><a class="paginate_button first disabled" aria-controls="example3" data-dt-idx="0" tabindex="0" id="example3_first">First</a><a class="paginate_button previous disabled" aria-controls="example3" data-dt-idx="1" tabindex="0" id="example3_previous">Previous</a><span></span><a class="paginate_button next disabled" aria-controls="example3" data-dt-idx="2" tabindex="0" id="example3_next">Next</a><a class="paginate_button last disabled" aria-controls="example3" data-dt-idx="3" tabindex="0" id="example3_last">Last</a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
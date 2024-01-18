<!DOCTYPE html>
<html lang="en">

<?php
session_start();
require_once('../backend/DBconn.php');

$userId = $_SESSION['id'];

// Set the BASE_URL
$BASE_URL = 'http://localhost/room_rover/';
include('header.php') ?>

<body>

  <div class="wrapper">

    <?php include('sidebar.php') ?>

    <div id="content">

      <?php include('navbar.php') ?>

      <!-- row -->
      <div class="container-fluid">
        <div class="form-head d-flex mb-3 mb-md-5 align-items-start">
          <div class="mr-auto d-none d-lg-block">
            <h3 class="text-primary font-w600">Welcome!</h3>
            <p class="mb-0">Reservations Page</p>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-12 col-xxl-12 mb-3">
            <div class="row">
              <div class="col-xl-4 col-lg-6 col-sm-6">
                <div class="widget-stat card bg-info">
                  <div class="card-body p-4">
                    <div class="media">
                      <span class="mr-3">
                        <i class="flaticon-381-home"></i>
                      </span>
                      <div class="media-body text-white text-right">
                        <p class="mb-1 text-white">Reservations</p>
                        <h3 class="text-white">
                          <?php
                          // Fetch and display the count of reservations
                          $session_id = $_SESSION['id'];
                          $sqlCountReservations = "SELECT COUNT(*) AS reservationCount FROM tbl_reservations WHERE uid = '$session_id'";
                          $result_temp = mysqli_query($conn, $sqlCountReservations);
                          $result = mysqli_fetch_assoc($result_temp);
                          echo $result["reservationCount"];
                          ?>
                        </h3>
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
                    <h4 class="card-title">Reservations List</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered" id="reserve">
                        <thead>
                          <tr>


                            <th>Room Name</th>
                            <th>Location</th>
                            <th>Image</th>
                            <th>QR Pic</th>
                            <th>Status</th>
                            <th>Months to Stay</th>
                            <th>Price</th>
                            <th>Aircon</th>
                            <th>Free Water/Electric</th>
                            <th>Free WiFi</th>
                            <th>Has Own CR</th>
                            <th>Date Added</th>
                            <th>Review</th>
                            <th>Actions</th>

                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          // Assuming you have a PDO database connection established, and your PDO instance is named $pdo

                          $session_id = $_SESSION['id']; // Replace with the actual session ID

                          // Your SQL query
                          $sql = "SELECT r.rs_id, r.lid, r.uid, r.status, r.date_created, r.stay,
                                                            l.listing_id, l.name,l.location, l.qr_pic, l.owner_id, l.price, l.is_aircon, l.free_water_electric, l.free_wifi, l.own_cr, l.pic, l.date_added
                                                            FROM tbl_reservations r
                                                            LEFT JOIN tbl_listings l ON r.lid = l.listing_id
                                                            WHERE r.uid = '$session_id'
                                                            ORDER BY r.rs_id ASC;
                                                            ";

                          // Prepare and execute the query
                          $temp_result = mysqli_query($conn, $sql);

                          // Check if there are results
                          if (mysqli_num_rows($temp_result) >= 1) {
                            // Fetch results using PDO fetch
                            while ($row = mysqli_fetch_assoc($temp_result)) {
                              echo "<tr>";
                              $obj = json_decode($row["pic"]);
                              $pic1 = null;
                              foreach ($obj as $key => $value) {
                                $pic1 = $value;
                                break;
                              }


                              echo "<td>" . ($row['name'] ? $row['name'] : 'Listing not available') . "</td>";
                              echo "<td>" . ($row['location'] ? $row['location'] : 'Listing not available') . "</td>";
                              // Display the image in the 'Image' column
                              $imagePath = '../backend/api/uploads/OWNER' . $row['owner_id'] . '/' . $pic1;
                              $qrPath = '../backend/api/uploads/OWNER' . $row['owner_id'] . '/' . $row["qr_pic"];
                              echo "<td><img src='{$imagePath}' alt='{$row['name']}' class='img-fluid' style='max-height: 100px; max-width: 100px;'></td>";
                              echo "<td><img src='{$qrPath}' alt='{$row['name']}' class='img-fluid' style='max-height: 100px; max-width: 100px;'></td>";
                              echo "<td>" . ($row['status'] ? 'Approved' : 'Pending') . "</td>";
                              echo "<td>" . $row['stay'] . "</td>";
                              echo "<td>₱" . number_format($row['price']) . "</td>";

                              // Display "Yes" if has CR, "None" if not
                              echo "<td>" . ($row['is_aircon'] ? 'Yes' : 'None') . "</td>";
                              // Display "Yes" if has CR, "None" if not
                              echo "<td>" . ($row['own_cr'] ? 'Yes' : 'None') . "</td>";

                              // Display "Yes" if free water and electric, "None" if not
                              echo "<td>" . ($row['free_water_electric'] ? 'Yes' : 'None') . "</td>";

                              // Display "Yes" if free WiFi, "None" if not
                              echo "<td>" . ($row['free_wifi'] ? 'Yes' : 'None') . "</td>";
                              echo "<td>{$row['date_created']}</td>";
                              echo "<td><button class='btn btn-info btn-success btn-sm review-button' data-toggle='modal' data-target='#reviewModal' data-card-id='" . $row['listing_id'] . "' data-card-name='" . $row['name'] . "'>Review</button><td>";
                              // Add a confirmation prompt before deletion
                              echo "<button class='btn btn-sm btn-danger btn-delete m-1' data-rs-id='{$row['rs_id']}'><i class='fas fa-trash'></i> Cancel</button>";
                              echo "<button class='btn btn-sm btn-warning btn-terminate m-1' data-listing-id='" . $row['listing_id'] . "' data-owner-id='" . $row['owner_id'] . "' data-toggle='modal' data-target='#terminateModal' id='terminate'><i class='fas fa-stop'></i> Terminate</button>";
                              echo "</td>";
                              echo "</tr>";
                            }
                          } else {
                            // Handle the case where the query fails
                            echo "Error: " . $conn->close();
                          }
                          ?>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Review modal -->
            <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h2 class="modal-title" id="reviewModalLabel">Leave a Review</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!-- Review Form Section -->
                    <form id="reviewForm" method="post" action="">
                      <!-- Add a hidden input field to store the listing ID -->
                      <input type="hidden" id="listingIdReview" name="listingIdReview" value="">
                      <!-- Other review details can be added here -->
                      <div class="form-group">
                        <label for="reviewText">Your Review:</label>
                        <textarea class="form-control" id="reviewText" name="reviewText" rows="4" required></textarea>
                      </div>
                      <div class="form-group">
                        <label for="rating">Rating:</label>
                        <select class="form-control" id="rating" name="rating" required>
                          <option value="5">5 - Excellent</option>
                          <option value="4">4 - Very Good</option>
                          <option value="3">3 - Good</option>
                          <option value="2">2 - Fair</option>
                          <option value="1">1 - Poor</option>
                        </select>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit Review</button>
                        <button type="button" class="btn btn-secondary" id="closeModal" data-dismiss="modal">Close</button>
                      </div>
                    </form>
                  </div>

                </div>
              </div>
            </div>
            <!--end Review modal -->

            <!-- The Modal -->
            <div class="modal" id="terminateModal">
              <div class="modal-dialog">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Confirm termination?</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <!-- Modal body -->
                  <form id="terminate-form" method="POST" action="">
                    <div class="modal-body">
                      <label for="reason_termination">Please provide reason:</label>
                      <textarea class="form-control" name="reason_termination" id="reason_termination" rows="3"></textarea>
                      <div>
                        <span class="text-danger">Note: This will also delete your account.</span>
                      </div>
                    </div>
                    <div class="modal-footer">

                      <a type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</a>
                      <a type="button" id="terminate-confirm-button" class="btn btn-sm btn-secondary">Terminate</a>
                    </div>
                    <!-- Modal footer -->
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- SweetAlert JS -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
  <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

  <script>
    $(document).ready(function() {
      let owner_id_temp;
      let listing_id_temp;
      $('#terminate').on('click', function() {
        owner_id_temp = $(this).data('owner-id');
        listing_id_temp = $(this).data('listing-id')
        console.log("test ", owner_id_temp);
        console.log("test ", listing_id_temp);
      });

      // Add a confirmation prompt before deletion


      $('#terminate-confirm-button').on('click', function() {
        console.log("test 2 ", owner_id_temp);
        console.log("test 2 ", listing_id_temp);
        console.log("test 2 ", <?php echo $userId; ?>);
        console.log('test 2 ', $('#reason_termination').val());
        $.ajax({
          type: 'POST',
          url: '../backend/api/terminate.php',
          data: {
            owner_id: owner_id_temp,
            user_id: <?php echo $userId; ?>,
            listing_id: listing_id_temp,
            reason: $('#reason_termination').val()
          },
          dataType: 'json',
          success: function(response) {
            if (response.success) {

              // If the reservation is successfully canceled, show a success message
              Swal.fire({
                icon: 'success',
                title: 'Status',
                text: 'Termination Success.',
              }).then(() => {
                // Reload the page
                window.location.replace('../backend/logout.php');
              });
            } else {
              // If an error occurs, show an error message
              Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Error occurred during termination.',
              });
            }
          },
          error: function() {
            // If an error occurs, show an error message
            Swal.fire({
              icon: 'error',
              title: 'Error!',
              text: 'Error occurred during termination.',
            });
          }
        });
      });


      $('.btn-delete').click(function() {
        var rsId = $(this).data('rs-id');


        // Display a SweetAlert confirmation prompt
        Swal.fire({
          title: '10% Deducted! Are you sure?',
          text: 'You won\'t be able to revert this!',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, cancel it!',
          cancelButtonText: 'No!'
        }).then((result) => {
          if (result.isConfirmed) {

            // If confirmed, send an AJAX request to delete the reservation
            $.ajax({
              type: 'POST',
              url: '../backend/api/cancel_reservation.php',
              data: {
                rsId: rsId
              },
              dataType: 'json',
              success: function(response) {
                if (response.success) {

                  // $('#reserveModal').modal('hide');
                  // $("#reserveModal").trigger("click");

                  // If the reservation is successfully canceled, show a success message
                  Swal.fire({
                    icon: 'success',
                    title: 'Reservation Canceled!',
                    text: 'Your reservation has been canceled.',
                  }).then(() => {
                    // Reload the page
                    window.location.reload();
                  });
                } else {
                  // If an error occurs, show an error message
                  Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Error occurred during cancellation.',
                  });
                }
              },
              error: function() {
                // If an error occurs, show an error message
                Swal.fire({
                  icon: 'error',
                  title: 'Error!',
                  text: 'Error occurred during cancellation.',
                });
              }
            });
          }
        });
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      $('#reserve').DataTable({});
    });
  </script>

  <script>
    // Update review modal content when Review button is clicked
    $('.review-button').click(function() {
      var cardId = $(this).data('card-id');
      console.log('test ', cardId);
      $('#listingIdReview').val(cardId);
    });

    // Handle the review submission action
    $('#reviewForm').submit(function(e) {
      e.preventDefault();

      // Retrieve the review details from the form
      var listingIdReview = $('#listingIdReview').val();
      var reviewText = $('#reviewText').val();
      var rating = $('#rating').val();

      // Perform your review submission logic here
      // Example: sendAjaxRequestForReview(listingIdReview, reviewText, rating);

      // Check if the user has already submitted a review for the selected listing
      $.ajax({
        type: 'POST',
        url: '../backend/api/check_review.php', // Adjust the URL to your server-side script
        data: {
          isOwnerReview: "boarder",
          listingIdReview: listingIdReview,
          userId: <?php echo $userId; ?>,
        },
        dataType: 'json',
        success: function(response) {
          if (response.alreadyReviewed) {
            // User has already submitted a review for this listing
            Swal.fire({
              icon: 'error',
              title: 'Error!',
              text: 'You have already submitted a review for this listing.',
            });
          } else {
            // User has not submitted a review, proceed with the review submission
            // Send an AJAX request to insert the review into the 'reviews' table
            $.ajax({
              type: 'POST',
              url: '../backend/api/submit_review.php', // Adjust the URL to your server-side script
              data: {
                isOwnerReview: "boarder",
                listingIdReview: listingIdReview,
                reviewText: reviewText,
                rating: rating
              },
              dataType: 'json',
              success: function(response) {
                if (response.success) {

                  // Close the modal after the review is submitted
                  //$('#reviewModal').modal('hide');
                  $("#closeModal").trigger("click");


                  // Success: Show SweetAlert success message
                  Swal.fire({
                    icon: 'success',
                    title: 'Review Submitted!',
                    text: 'Your review has been successfully submitted.',
                  });



                  // Optionally, you can reload the page or update the reviews dynamically
                  // Example: location.reload();
                } else {
                  // Error: Show SweetAlert error message
                  Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Error submitting the review. Please try again.',
                  });
                }
              },
              error: function() {
                // Show SweetAlert error message for general errors
                Swal.fire({
                  icon: 'error',
                  title: 'Error!',
                  text: 'Error occurred during the review submission.',
                });
              }
            });
          }
        },
        error: function() {
          // Show SweetAlert error message for general errors
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Error checking review status.',
          });
        }
      });
    });
  </script>

</body>

</html>
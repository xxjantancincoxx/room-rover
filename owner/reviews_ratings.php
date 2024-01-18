<!DOCTYPE html>
<html lang="en">

<?php
session_start();
require_once('../backend/DBconn.php');
include('header.php');

// Calculate the average rating based on the owner's ID
$userId = $_SESSION['id'];
$avgRatingSql = "SELECT AVG(r.rating) as avg_rating
								FROM reviews r
								JOIN tbl_listings l ON r.listing_id = l.listing_id
								WHERE l.owner_id = '$userId'";

$temp_result = mysqli_query($conn, $avgRatingSql);
$avgRating = mysqli_fetch_assoc($temp_result);

// Get reviews
$sqlRatings = "SELECT l.name AS listing_name, r.rating, r.review_text
							FROM reviews r
							JOIN tbl_listings l ON r.listing_id = l.listing_id
							WHERE l.owner_id = '$userId'";

$temp_ratings = mysqli_query($conn, $sqlRatings);

$boardersQuery = "SELECT acc.id, usr.fullname FROM `accounts` acc
                  INNER JOIN `users` usr
                  ON usr.session_id = acc.session_id
                  WHERE acc.id IN (SELECT tr.uid FROM `tbl_reservations` tr
                  INNER JOIN `tbl_listings` tl
                  ON tl.listing_id = tr.lid
                  WHERE tl.owner_id = '$userId');";

$boarder_temp = mysqli_query($conn, $boardersQuery);

$boarderReviewQuery = "SELECT * FROM `accounts` acc
                      INNER JOIN `users` usr
                      ON usr.session_id = acc.session_id
                      INNER JOIN `owner_review` o_r
                      ON o_r.boarder_id = acc.id
                      WHERE acc.id IN (SELECT boarder_id FROM `owner_review` WHERE owner_id = $userId)";

$boarder_review_temp = mysqli_query($conn, $boarderReviewQuery);

?>


<body>

  <div class="wrapper">
    <?php include('sidebar.php') ?>

    <div id="content">
      <?php include('../layouts/navbar.php') ?>

      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-12 col-xxl-12">
            <div class="row">
              <div class="col-xl-4 col-lg-6 col-sm-6">
                <div class="widget-stat card bg-secondary">
                  <div class="card-body  p-4">
                    <div class="media">
                      <span class="mr-3">
                        <i class="flaticon-381-star"></i>
                      </span>
                      <div class="media-body text-white text-right">
                        <p class="mb-1 text-white">Average Ratings</p>
                        <h3 class="text-white">
                          <?php echo number_format($avgRating['avg_rating'], 2) * 20; ?>%
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
              <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">My Reviews</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table header-border" id="Orating">
                        <thead>
                          <tr>
                            <th>Listing Name</th>
                            <th>Rating</th>
                            <th>Review Text</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if (mysqli_num_rows($temp_ratings) >= 1) {
                            while ($row = mysqli_fetch_assoc($temp_ratings)) {
                              echo '<tr>';
                              echo '<td>' . $row['listing_name'] . '</td>';
                              echo '<td>' . $row['rating'] . '</td>';
                              echo '<td>' . $row['review_text'] . '</td>';
                              echo '</tr>';
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
          <br>
          <div class="col-xl-12 col-xxl-12">
            <div class="row">
              <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12">
                <div class="d-flex justify-content-end">
                  <button class="btn btn-secondary mb-2" data-toggle="modal" data-target="#reviewModal">Add Review</button>
                </div>
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">My Reviews to Boarders</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table header-border" id="reviewOwners">
                        <thead>
                          <tr>
                            <th>Boarder's Name</th>
                            <th>Rating</th>
                            <th>Review Text</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if (mysqli_num_rows($boarder_review_temp) >= 1) {
                            while ($row = mysqli_fetch_assoc($boarder_review_temp)) {
                              echo '<tr>';
                              echo '<td>' . $row["fullname"] .  '</td>';
                              echo '<td>' . $row['rating'] . '</td>';
                              echo '<td>' . $row['review_text'] . '</td>';
                              echo '</tr>';
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
                    <div class="form-group">
                      <label for="boarder">Boarder</label>
                      <select name="boarder" id="boarder" class="form-control">
                        <?php
                        if (mysqli_num_rows($boarder_temp) >= 1) {
                          while ($row = mysqli_fetch_assoc($boarder_temp)) {
                            echo '<option value="' . $row["id"] . '" >' . $row["fullname"] . '</option>';
                          }
                        }
                        ?>
                      </select>
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
                    <!-- Other review details can be added here -->
                    <div class="form-group">
                      <label for="reviewText">Your Review:</label>
                      <textarea class="form-control" id="reviewText" name="reviewText" rows="4" required></textarea>
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
        </div>
      </div>
    </div>
  </div>
  <!-- SweetAlert JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
  <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#Orating').DataTable({});
      $('#reviewOwners').DataTable({});


      $('#reviewForm').submit(function(e) {
        e.preventDefault();

        // Retrieve the review details from the form
        var boarder = $('#boarder').val();
        var reviewText = $('#reviewText').val();
        var rating = $('#rating').val();

        // Perform your review submission logic here
        // Example: sendAjaxRequestForReview(listingIdReview, reviewText, rating);

        // Check if the user has already submitted a review for the selected listing
        $.ajax({
          type: 'POST',
          url: '../backend/api/check_review.php', // Adjust the URL to your server-side script
          data: {
            isOwnerReview: "owner",
            boarder_id: boarder,
            owner_id: <?php echo $userId; ?>,
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
                  isOwnerReview: "owner",
                  boarder_id: boarder,
                  owner_id: <?php echo $userId; ?>,
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
                    }).then(() => {
                      // Reload the page
                      window.location.reload();
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
    });
  </script>
</body>

</html>
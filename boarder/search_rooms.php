<?php
session_start();
require_once('../backend/DBconn.php');

// Set the BASE_URL
$BASE_URL = 'http://localhost/room_rover/';
$userId = $_SESSION['id'];
// Set the number of records per page
$recordsPerPage = 6;

// Calculate the total number of pages
$sqlTotal = "SELECT COUNT(*) AS total FROM tbl_listings";
$resultTotal = $conn->query($sqlTotal);
$totalRecords = mysqli_fetch_assoc($resultTotal)['total'];
$totalPages = ceil($totalRecords / $recordsPerPage);



// Get the current page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;
if (isset($_GET['search']) && !empty($_GET['search'])) {
  $search = $_GET['search'];
  $sql = "SELECT l.*, u.contact_no, AVG(r.rating) AS average_rating, COUNT(r.review_id) AS review_count
    FROM tbl_listings l
    LEFT JOIN users u ON l.owner_id = u.id
    LEFT JOIN reviews r ON l.listing_id = r.listing_id
    WHERE l.rooms_Available >= 1 AND (l.name LIKE '%$search%' OR CONCAT(u.g_lastname, ' ', u.g_firstname) LIKE '%$search%')
    GROUP BY l.listing_id
    LIMIT $offset, $recordsPerPage";
} else {

  $filterConditions = [];

  if (isset($_GET['filterWiFi'])) {
    $filterConditions[] = 'l.free_wifi = 1';
  }

  if (isset($_GET['filterOwnCR'])) {
    $filterConditions[] = 'l.own_cr = 1';
  }

  if (isset($_GET['filterElectricity'])) {
    $filterConditions[] = 'l.free_water_electric = 1';
  }

  if (isset($_GET['filterAirConditioned'])) {
    $filterConditions[] = 'l.is_aircon = 1';
  }

  // Build the WHERE clause for filters
  $filterWhereClause = '';
  if (!empty($filterConditions)) {
    $filterWhereClause = 'WHERE ' . implode(' AND ', $filterConditions);
  }

  $sql1 = "SELECT l.*, 
u.contact_no AS owner_contact_no, 
AVG(r.rating) AS average_rating, 
COUNT(r.review_id) AS review_count
FROM tbl_listings l
LEFT JOIN users u ON l.owner_id = u.id
LEFT JOIN reviews r ON l.listing_id = r.listing_id
$filterWhereClause
GROUP BY l.listing_id
LIMIT $offset, $recordsPerPage";
}

$resultset = $conn->query($sql1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Other head elements -->

  <!-- SweetAlert CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">

</head>


<?php include('header.php') ?>
<style>
  .modal-overlay {
    position: absolute;
    width: 100%;
    height: 200%;
    background-color: black;
    opacity: 0.6;
    top: 0px;
    left: 0px;
    z-index: 999;
  }

  .modal-img {
    opacity: 0;
    position: absolute;
    margin-left: 50%;
    margin-top: 30%;
    left: 0px;
    top: 0px;
    z-index: 1000;

  }

  .modal-img img {
    margin-left: -50%;
    margin-top: -50%;
    background-color: white;
    padding: 5px;
    width: 500px;
    z-index: 1001;
    /*just to give a viewable size */
  }

  .noscroll {
    overflow: hidden;
  }
</style>

<body>
  <div class="wrapper">

    <?php include('sidebar.php') ?>

    <div id="content">

      <?php include('navbar.php') ?>


      <!-- row -->
      <!-- Search bar -->
      <form action="" method="GET" class="mb-1" style="padding: 30px;">
        <div class="input-group">
          <input type="text" class="form-control" name="search" placeholder="Search by name">
          <div class="input-group-append">
            <button type="submit" class="btn btn-primary">Search</button>
          </div>
        </div>
      </form>

      <!-- Filter Form Section -->
      <form action="" method="GET" class="mb-1" style="padding: 30px;">
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="filterWiFi" name="filterWiFi" value="1">
          <label class="form-check-label" for="filterWiFi">Free WiFi</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="filterOwnCR" name="filterOwnCR" value="1">
          <label class="form-check-label" for="filterOwnCR">Own CR</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="filterElectricity" name="filterElectricity" value="1">
          <label class="form-check-label" for="filterElectricity">Free Electricity</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="filterAirConditioned" name="filterAirConditioned" value="1">
          <label class="form-check-label" for="filterAirConditioned">Air Conditioned</label>
        </div>
        <button type="submit" class="btn btn-primary">Apply Filters</button>
      </form>

      <div class="row pl-4 pr-4">
        <?php
        $count = 0; // initialize a counter

        while ($record = mysqli_fetch_assoc($resultset)) {
          $obj = json_decode($record["pic"]);
          $pic1 = null;
          foreach ($obj as $key => $value) {
            $pic1 = $value;
            break;
          }
        ?>
          <div class="card mr-2 mb-2 holder-card" id="holder-card" style="width:350px">
            <img class="card-img-top" src="<?php echo "../backend/api/uploads/OWNER" . $record["owner_id"] . "/" . $pic1; ?>" alt="Card image" style="width:100%">
            <div class="card-body">
              <h4 class="card-title"><?php echo $record["name"]; ?></h4>
              <ul style="list-style-type:disc">
                <li>
                  Location: <?php echo $record["location"] ?>
                </li>
                <li>
                  Price: <?php echo $record["price"] ?>
                </li>
                <li>
                  Rooms Available: <?php echo $record["rooms_Available"] ?>
                </li>
                <li>
                  Date Added: <?php echo $record["date_added"] ?>
                </li>
              </ul>
              <a data-toggle="modal" data-target="#viewDetailsModal<?php echo $record["listing_id"] ?>" class="btn btn-reserve btn-sm btn-primary">View Details</a>
              <a class="btn btn-secondary btn-reserve btn-sm reserve-button" data-toggle="modal" data-target="#reserveModal" data-card-id="<?php echo $record['listing_id']; ?>" data-card-name="<?php echo $record['name']; ?>" data-card-loc="<?php echo $record['location']; ?>" data-card-price="<?php echo '₱' . $record['price']; ?>" data-card-condition="<?php echo $record['is_aircon'] ? 'Air Conditioned' : 'No Air Condition'; ?>" data-card-water-electric="<?php echo $record['free_water_electric'] ? 'Free Water and Electric' : 'No Free Water and Electric'; ?>" data-card-wifi="<?php echo $record['free_wifi'] ? 'Free WiFi' : 'No Free WiFi'; ?>" data-card-own-cr="<?php echo $record['own_cr'] ? 'Own CR' : 'No Own CR'; ?>" data-card-rooms-available="<?php echo $record['rooms_Available']; ?>">
                Reserve
              </a>
              <!-- Review Button -->
              <button class="btn btn-info btn-success btn-sm review-button" data-toggle="modal" data-target="#reviewModal" data-card-id="<?php echo $record['listing_id']; ?>" data-card-name="<?php echo $record['name']; ?>">
                Review
              </button>
            </div>
          </div>

          <!-- View Details Modal -->
          <div class="modal fade" id="viewDetailsModal<?php echo $record["listing_id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">View Room Details</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col col-md-6">
                      <ul style="list-style-type:disc">
                        <li>
                          Name: <?php echo $record["name"] ?>
                        </li>
                        <li>
                          Location: <?php echo $record["location"] ?>
                        </li>
                        <li>
                          Price: <?php echo $record["price"] ?>
                        </li>
                        <li>
                          Rooms Available: <?php echo $record["rooms_Available"] ?>
                        </li>
                        <li>
                          Date Added: <?php echo $record["date_added"] ?>
                        </li>
                      </ul>
                    </div>
                    <div class="col col-md-6">
                      <ul style="list-style-type:disc">
                        <li>
                          Aircon: <?php echo $record["is_aircon"] ?>
                        </li>
                        <li>
                          Free Water and Electric: <?php echo $record["free_water_electric"] ?>
                        </li>
                        <li>
                          Free Wifi: <?php echo $record["free_wifi"] ?>
                        </li>
                        <li>
                          Own Cr: <?php echo $record["own_cr"] ?>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <ul style="list-style-type:disc">
                  </ul>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>
          <br>

          <?php
          $count++;
          // Check if 3 cards have been displayed, then start a new row
          if ($count % 3 == 0) {
            echo '</div><div class="row">';
          }
          ?>
        <?php } ?>
      </div>

      <!-- Pagination -->
      <nav class="d-flex justify-content-center" aria-label="Page navigation example">
        <ul class="pagination">
          <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
              <a class="page-link" href="?page=<?php echo $i; ?><?php echo isset($_GET['search']) ? '&search=' . $_GET['search'] : ''; ?>">
                <?php echo $i; ?>
              </a>
            </li>
          <?php endfor; ?>
        </ul>
      </nav>
    </div>

  </div>

  <!-- QR Code Modal -->
  <div class="modal fade" id="qrCodeModal" tabindex="-1" role="dialog" aria-labelledby="qrCodeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="qrCodeModalLabel">Listing QR Code</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <!-- Container to center the content -->
          <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
            <!-- QR Code Image -->
            <img src="" alt="QR Code" id="qrCodeImage" style="max-width: 100%; max-height: 80vh;">
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
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
  <!--end Review modal -->
  <!-- Modal -->
  <div class="modal fade" id="reserveModal" tabindex="-1" role="dialog" aria-labelledby="reserveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="reserveModalLabel">Reservation Details</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Reservation Details Section -->

          <div class="form-group">
            <label for="numberOfRooms">Number of Rooms:</label>
            <input type="number" class="form-control" id="numberOfRooms" name="numberOfRooms" placeholder="2" required>
          </div>

          <!-- Add the hidden input field for rooms available -->
          <input type="hidden" id="roomsAvailable" name="roomsAvailable" value="">


          <!-- Total Amount Section -->
          <div class="row mb-3">
            <div class="col-md-12">
              <label for="totalAmount">Total Amount:</label>
              <!-- Display the calculated total amount here -->
              <span id="totalAmount"><strong>₱0.00</strong></span>
            </div>
          </div>

          <!-- Card Details Section -->

          <!-- Payment Details Section -->
          <h4 class="modal-title" id="reserveModalLabel">Payment Details</h4>


          <div class="form-group">
            <label for="eWallet">eWallet:</label>
            <select class="form-control" id="eWallet" name="eWallet" required>
              <option value="Cash">Cash</option>
              <option value="GCash">GCash</option>
            </select>
          </div>

          <div class="form-group">
            <label for="accountName">Account Name:</label>
            <input type="text" class="form-control" id="accountName" name="accountName" placeholder="John Doe" required>
          </div>

          <div class="form-group acc_num">
            <label for="accountNumber">Account Number:</label>
            <input type="text" class="form-control" id="accountNumber" name="accountNumber" placeholder="0914567890" required>
          </div>

          <div class="form-group ref_num">
            <label for="referenceNumber">Reference Number:</label>
            <input type="text" class="form-control" id="referenceNumber" name="referenceNumber" placeholder="7016..." required>
          </div>

          <div class="form-group">
            <label for="amountPaid">Amount Paid:</label>
            <input type="number" class="form-control" id="amountPaid" name="amountPaid" placeholder="1000" required>
          </div>

        </div>
        <!-- Update Modal Footer -->
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

          <!-- Single form for reservation -->
          <!-- Inside the modal -->
          <form id="reserveForm" method="post" action="">
            <!-- Add a hidden input field to store the listing ID -->
            <input type="hidden" id="listingId" name="listingId" value="">
            <!-- Other reservation details can be added here -->
            <button type="submit" class="btn btn-info">Reserve Now</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!--**********************************
        Scripts
    ***********************************-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

  <script>
    $(document).ready(function() {
      $(".acc_num").hide();
      $(".ref_num").hide();

      $("#eWallet").change(function() {

        if ($(this).val() == "Gcash") {
          $(".acc_num").show();
          $(".ref_num").show();
          // $(".no").hide();
        }
        if ($(this).val() == "Cash") {
          $(".acc_num").hide();
          $(".ref_num").hide();
        }

      });

      $('#holder-card img').each(function(index) {
        if ($(this).attr('onclick') != null) {
          if ($(this).attr('onclick').indexOf("runThis()") == -1) {
            $(this).click(function() {
              $(this).attr('onclick');
              var src = $(this).attr("src");
              ShowLargeImage(src);
            });
          }
        } else {
          $(this).click(function() {
            var src = $(this).attr("src");
            ShowLargeImage(src);
          });
        }
      });

      $('body').on('click', '.modal-overlay', function() {
        $('.modal-overlay, .modal-img').remove();
        $('body').removeClass('noscroll');
      });

      function ShowLargeImage(imagePath) {
        $('body').append('<div class="modal-overlay"></div><div class="modal-img"><img src="' + imagePath.replace("small", "large") + '" /></div>').addClass('noscroll');
        $('.modal-img').animate({
          opacity: 1
        }, 1000);
      }

      // JavaScript function to show QR code modal
      function showQrCodeModal(qrCodeImageUrl) {
        // Update QR code image source
        $('#qrCodeImage').attr('src', qrCodeImageUrl);

        // Show QR code modal
        $('#qrCodeModal').modal('show');
      }
    });
  </script>
  <script>
    // Update total amount when the number of rooms changes
    $('#numberOfRooms').on('input', function() {
      updateTotalAmount();
    });

    // Function to update the total amount dynamically
    function updateTotalAmount() {
      var numberOfRooms = $('#numberOfRooms').val();

      // Check if the number of rooms is 1 or above
      if (numberOfRooms >= 1) {
        // Assuming each listing has a corresponding element with a class "price-per-room"
        // within the loop where you display listings
        var pricePerRoomText = $('.price-per-room').first().text().trim(); // Get the text and remove leading/trailing spaces

        // Try to parse the price as a float, removing any non-numeric characters
        var pricePerRoom = parseFloat(pricePerRoomText.replace(/[^\d.]/g, ''));

        // Check if the parsed value is a valid number
        if (!isNaN(pricePerRoom)) {
          // Calculate total amount
          var totalAmount = numberOfRooms * pricePerRoom;

          // Display the calculated total amount
          $('#totalAmount').html('<strong>₱' + totalAmount.toFixed(2) + '</strong>');

        } else {
          // Handle the case where the price couldn't be parsed as a valid number
          // You might want to show an error message or handle it based on your needs
          $('#totalAmount').text('Invalid Price');
        }
      } else {
        // Display an error message for invalid number of rooms
        $('#totalAmount').text('Number of rooms must be 1 or above');
      }
    }
  </script>
  <script>
    $(document).ready(function() {
      // Update modal content when Reserve button is clicked
      $('.reserve-button').click(function() {
        var cardName = $(this).data('card-name');
        var cardLoc = $(this).data('card-loc');
        var cardPrice = $(this).data('card-price');
        var cardCondition = $(this).data('card-condition');
        var cardWaterElectric = $(this).data('card-water-electric');
        var cardWifi = $(this).data('card-wifi');
        var cardOwnCr = $(this).data('card-own-cr');



        $('.card-name').text(cardName);
        $('.card-loc').text(cardLoc);
        $('.card-price').text(cardPrice);
        $('.card-condition').text(cardCondition);
        $('.card-water-electric').text(cardWaterElectric);
        $('.card-wifi').text(cardWifi);
        $('.card-own-cr').text(cardOwnCr);

        // Store the card details in a hidden input field (optional)
        $('#reserveModalCardDetails').val(JSON.stringify({
          name: cardName,
          location: cardLoc,
          price: cardPrice,
          condition: cardCondition,
          waterElectric: cardWaterElectric,
          wifi: cardWifi,
          ownCr: cardOwnCr
        }));
      });

      // Handle the reservation action
      $('#confirmReserve').click(function() {
        // Retrieve the card details from the hidden input field (optional)
        var cardDetails = $('#reserveModalCardDetails').val();
        // You can now send the cardDetails to the server using AJAX
        // Perform your reservation logic here
        // Example: sendAjaxRequest(cardDetails);
        // Close the modal after the reservation is completed
        $('#reserveModal').modal('hide');
      });
    });
  </script>

  <!-- Other script tags -->

  <!-- SweetAlert JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $(document).ready(function() {
      // Update modal content when Reserve button is clicked
      $('.reserve-button').click(function() {
        var cardId = $(this).data('card-id');
        var roomsAvailable = parseInt($(this).data('card-rooms-available')); // Assuming you have a data attribute for rooms available
        $('#listingId').val(cardId);
        $('#roomsAvailable').val(roomsAvailable); // Store rooms available in a hidden field

      });

      // Handle the reservation action
      $('#reserveForm').submit(function(e) {
        e.preventDefault();

        // Validate form fields before submission
        if (validateForm()) {

          // Get the number of rooms inputted in the modal
          var numberOfRooms = parseInt($('#numberOfRooms').val());

          // Get the maximum number of rooms available for the selected listing
          var roomsAvailable = parseInt($('#roomsAvailable').val());

          if (numberOfRooms <= roomsAvailable && numberOfRooms > 0) {
            // Proceed with the reservation logic
            var listingId = $('#listingId').val();
            var eWallet = $('#eWallet').val();
            var accountName = $('#accountName').val();
            var accountNumber = $('#accountNumber').val();
            var referenceNumber = $('#referenceNumber').val();
            var amountPaid = $('#amountPaid').val();
            var numberOfRooms = $('#numberOfRooms').val(); // Add this line to get the number of rooms

            // Send an AJAX request to the reserve.php file
            $.ajax({
              type: 'POST',
              url: '../backend/api/reserve.php',
              data: {
                listingId: listingId,
                userId: <?php echo $userId; ?>,
                eWallet: eWallet, // Add these lines
                accountName: accountName,
                accountNumber: accountNumber,
                referenceNumber: referenceNumber,
                amountPaid: amountPaid,
                numberOfRooms: numberOfRooms // Include the number of rooms in the data

              },
              dataType: 'json',
              success: function(response) {
                if (response.success) {
                  // Close the modal after the reservation is completed
                  $('#reserveModal').modal('hide');

                  // Success: Show SweetAlert success message
                  Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Reservation successfully added.',
                  });

                  window.location.reload();
                  // Reload the page after a short delay
                  // setTimeout(function() {
                  //   location.reload();
                  // }, 2000);
                } else {
                  // Error: Show SweetAlert error message
                  Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: response.message, // Display the error message from the server
                  });
                }
              },
              error: function() {
                // Show SweetAlert error message for general errors
                Swal.fire({
                  icon: 'error',
                  title: 'Error!',
                  text: 'Error occurred during reservation.',
                });
              }
            });
          } else {
            // Show an alert or error message for invalid number of rooms
            Swal.fire({
              icon: 'error',
              title: 'Validation Error!',
              text: 'Invalid number of rooms. Please select a valid number within the available range.',
            });
          }
        }
      });
    });

    // Validate form function
    function validateForm() {
      var eWallet = $('#eWallet').val();
      var accountName = $('#accountName').val();
      var accountNumber = $('#accountNumber').val() ? $('#accountNumber').val() : "N/A";
      var referenceNumber = $('#referenceNumber').val() ? $('#referenceNumber').val() : "N/A";
      var amountPaid = $('#amountPaid').val();

      // Simple validation (you can enhance this based on your requirements)
      if (eWallet === '' || accountName === '' || accountNumber === '' || referenceNumber === '' || amountPaid === '') {
        // Show an alert or error message here
        Swal.fire({
          icon: 'error',
          title: 'Validation Error!',
          text: 'Please fill out all required fields.',
        });
        return false;
      }

      console.log("ewallet ", eWallet);
      console.log("account_name ", accountName);
      console.log("account_number ", accountNumber);
      console.log("reference_number ", referenceNumber);
      console.log("amount_paid ", amountPaid);

      return true;
    }
  </script>

  <script>
    // Update review modal content when Review button is clicked
    $('.review-button').click(function() {
      var cardId = $(this).data('card-id');
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
                listingIdReview: listingIdReview,
                reviewText: reviewText,
                rating: rating
              },
              dataType: 'json',
              success: function(response) {
                if (response.success) {

                  // Close the modal after the review is submitted
                  $('#reviewModal').modal('hide');


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
  <!-- Add this script at the end of your HTML -->
  <script>
    // Function to generate star indicator HTML based on the rating
    function generateStarIndicator(rating) {
      var starIndicator = '';
      var numberOfStars = Math.floor(rating); // Get the integer part of the rating

      // Add full stars
      for (var i = 0; i < numberOfStars; i++) {
        starIndicator += '<i class="fas fa-star"></i> ';
      }

      // Add half star if applicable
      if (rating % 1 !== 0) {
        starIndicator += '<i class="fas fa-star-half-alt"></i> ';
        numberOfStars++; // Increment the count to account for the half star
      }

      // Add empty stars to fill the remaining space
      for (var j = numberOfStars; j < 5; j++) {
        starIndicator += '<i class="far fa-star"></i> ';
      }

      return starIndicator;
    }

    // Update star indicators for each listing
    $('.star-indicator').each(function() {
      var rating = $(this).data('rating');
      var starIndicator = generateStarIndicator(rating);
      $(this).html(starIndicator);
    });
  </script>

</body>

</html>
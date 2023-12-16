<?php
session_start();
require_once('../backend/DBconn.php');

// Set the BASE_URL
$BASE_URL = 'http://localhost/room_rover/';
?>
?>
<!DOCTYPE html>
<html lang="en">

<?php include('header.php') ?>


<body>

    <!--*******************
        Preloader start
    ********************-->
    <?php include('../layouts/loader.php') ?>
    <!--*******************
        Preloader end
    ********************-->



    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">


        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <img class="logo" src="../assets/images/logorr.png" alt="">
               
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->
		


		<!--**********************************
            Sub-Header start
        ***********************************-->
        <?php include('sub-header.php') ?>
        <!--**********************************
            Sub-Header end ti-comment-alt
        ***********************************-->



        <!--**********************************
            Sidebar start
        ***********************************-->
        <?php include('navigation.php') ?>
        <!--**********************************
            Sidebar end
        ***********************************-->
		


		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="form-head d-flex mb-3 mb-md-5 align-items-start">
                    <div class="mr-auto d-none d-lg-block">
                        <h3 class="text-primary font-w600">Welcome Owner!</h3>
                        <p class="mb-0">Reservations Page</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="row">
                            <div class="col-xl-4 col-lg-6 col-sm-6">
                                <div class="widget-stat card bg-info">
                                    <div class="card-body  p-4">
                                        <div class="media">
                                            <span class="mr-3">
                                                <i class="flaticon-381-home"></i>
                                            </span>
                                            <div class="media-body text-white text-right">
                                                <p class="mb-1">Reservations</p>
                                                <?php
                                              // Fetch and display the count of reservations
                                                $session_owner_id = $_SESSION['id'];
                                                $sqlCountReservations = "SELECT COUNT(*) AS reservationCount FROM tbl_reservations r
                                                                        JOIN tbl_listings l ON r.lid = l.listing_id
                                                                        WHERE l.owner_id = :session_owner_id";
                                                $stmtCountReservations = $pdo->prepare($sqlCountReservations);
                                                $stmtCountReservations->bindParam(':session_owner_id', $session_owner_id, PDO::PARAM_STR);
                                                $stmtCountReservations->execute();
                                                $countReservations = $stmtCountReservations->fetch(PDO::FETCH_ASSOC)['reservationCount'];
                                                echo "<h3 class='text-white'>$countReservations</h3>";
                                                
                                                ?>
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
                                        
                                        <h4 class="card-title">Reservations List</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="reservations" class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Listing</th>
                                                        <th>Status</th>
                                                        <th>Rooms</th>
                                                        <th>Name</th>
                                                        <th>Price</th>
                                                        <th>E-wallet</th>
                                                        <th>Account Name</th>
                                                        <th>Account Number</th>
                                                        <th>Reference Number</th>
                                                        <th>Amount Paid</th>
                                                        <th>Date Paid</th>
                                                        <th>Total Amount</th>
                                                        <th>Image</th>
                                                        <th>Date Added</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    // Assuming you have a PDO database connection established, and your PDO instance is named $pdo

                                                    $session_id = $_SESSION['id']; // Replace with the actual session ID

                                                    // Your SQL query
                                                    $sql = "SELECT r.rs_id, r.lid, r.uid,r.num_Rooms, r.status, r.date_created,
                                                   l.listing_id, l.name, l.owner_id, l.price, l.is_aircon, l.free_water_electric, l.free_wifi, l.own_cr, l.pic, l.date_added,
                                                   p.payment_id, p.ewallet, p.e_accountName, p.e_accountNumber, p.referenceNo, p.amountPaid, p.payment_date
                                                   FROM tbl_reservations r
                                                   JOIN tbl_listings l ON r.lid = l.listing_id
                                                   LEFT JOIN payment p ON r.rs_id = p.rs_id
                                                   WHERE l.owner_id = :session_id
                                                   ORDER BY r.rs_id ASC";


                                                    // Prepare and execute the query
                                                    $stmt = $pdo->prepare($sql);
                                                    $stmt->bindParam(':session_id', $session_id, PDO::PARAM_STR);
                                                    $stmt->execute();

                                                    // Check if there are results
                                                    if ($stmt) {
                                                        // Fetch results using PDO fetch
                                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                            echo "<tr>";
                                                            echo "<td>{$row['lid']}</td>";
                                                            echo "<td>" . ($row['status'] == 1 ? 'Approved' : 'Rejected') . "</td>";
                                                            echo "<td>{$row['num_Rooms']}</td>";
                                                            echo "<td>{$row['name']}</td>";
                                                            echo "<td>₱" . number_format($row['price']) . "</td>";

                                                            echo "<td>{$row['ewallet']}</td>";
                                                            echo "<td>{$row['e_accountName']}</td>";
                                                            echo "<td>{$row['e_accountNumber']}</td>";
                                                            echo "<td>{$row['referenceNo']}</td>";
                                                            echo "<td>₱" . number_format($row['amountPaid']) . "</td>";
                                                            echo "<td>{$row['payment_date']}</td>";

                                                            // Calculate total amount and display the column
                                                            $totalAmount = $row['num_Rooms'] * $row['price'];
                                                            echo "<td>₱" . number_format($totalAmount) . "</td>";

                                                            $imagePath = $BASE_URL . 'backend/api/uploads/OWNER' . $row['owner_id'] . '/' . $row['pic'];
                                                            echo "<td><img src='{$imagePath}' alt='{$row['name']}' class='img-fluid' style='max-height: 50px; max-width: 50px;'></td>";
                                                            echo "<td>{$row['date_added']}</td>";
                                                            echo "<td>";
                                                            echo "<div class='btn-group'>";
                                                            // Change the button labels and data attributes
                                                            echo "<button class='btn btn-success btn-approve' data-rs-id='{$row['rs_id']}'><i class='fas fa-check'></i> Approve</button>";

                                                            echo "<button class='btn btn-danger btn-reject' data-rs-id='{$row['rs_id']}'><i class='fas fa-times'></i> Reject</button>";
                                                            echo "</div>";
                                                            echo "</td>";
                                                            echo "</tr>";
                                                        }
                                                    } else {
                                                        // Handle the case where the query fails
                                                        echo "Error: " . $stmt->errorInfo()[2];
                                                    }

                                                    // Close the PDO connection
                                                    $pdo = null;
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
        <!--**********************************
            Content body end
        ***********************************-->



        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>BSIT 4 Capstone Project 2023</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->



    
    <!--**********************************
        Scripts
    ***********************************-->
    <!-- jQuery -->

<!-- Add this script at the end of your HTML body -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>


<?php include('footer_links.php') ?>
<script>
$(document).ready(function () {
    // DataTable initialization
    $('#reservations').DataTable();

    // Handle the click event on the "Approve" and "Reject" buttons
    $('.btn-approve, .btn-reject').on('click', function () {
        var rsId = $(this).data('rs-id');
        var status = $(this).hasClass('btn-approve') ? 1 : 3; // 1 for "Approved", 3 for "Rejected"

        // Make an AJAX request to update the status
        updateReservationStatus(rsId, status);
    });

    function updateReservationStatus(rsId, status) {
        $.ajax({
            url: '../backend/api/update_reservation_status.php',
            method: 'POST',
            data: { rsId: rsId, status: status },
            dataType: 'json', // Specify that the response is expected to be JSON
            success: function (response) {
                handleUpdateResponse(response);
            },
            error: function (xhr, status, error) {
                console.error('Error updating status:', error);
                handleUpdateResponse({ success: false, error: 'Unknown error' });
            }
        });
    }

    function handleUpdateResponse(response) {
        if (response.success) {
            console.log('Reservation successfully updated.');
            // Additional actions if needed
            Swal.fire({
                icon: 'success',
                title: 'Reservation Updated Successfully',
                showConfirmButton: false,
                timer: 1500
            });
        } else {
            console.error('Error updating status:', response.error);
            Swal.fire({
                icon: 'error',
                title: 'Error updating status',
                text: response.error || 'Unknown error'
            });
        }
    }
});


</script>
	<!--**********************************
        End Scripts
    ***********************************-->
    <!-- DataTables initialization script -->
<!-- DataTables initialization script -->


</body>

</html>
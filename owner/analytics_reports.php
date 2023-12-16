<?php
session_start();

require_once('../backend/DBconn.php');

// Fetch and display payment analytics data
$session_id = $_SESSION['id'];


$sqlAnalytics = "SELECT p.payment_id, p.amountPaid, p.payment_date, r.rs_id, l.name as listing_name, u.username as owner_username
                 FROM payment p
                 JOIN tbl_reservations r ON p.rs_id = r.rs_id
                 JOIN tbl_listings l ON r.lid = l.listing_id
                 JOIN accounts u ON l.owner_id = u.id
                 WHERE u.id = :session_id";

$stmtAnalytics = $pdo->prepare($sqlAnalytics);
$stmtAnalytics->bindParam(':session_id', $session_id, PDO::PARAM_STR);
$stmtAnalytics->execute();

// Fetch and display boarders data
$sqlBoarders = "SELECT r.rs_id, u.username as boarder_name, l.name as listing_name, r.num_Rooms, r.date_created
               FROM tbl_reservations r
               JOIN tbl_listings l ON r.lid = l.listing_id
               JOIN accounts u ON r.uid = u.id
               WHERE l.owner_id = :session_id";

$stmtBoarders = $pdo->prepare($sqlBoarders);
$stmtBoarders->bindParam(':session_id', $session_id, PDO::PARAM_STR);
$stmtBoarders->execute();
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
        <!-- Your existing code for Nav header -->
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

                <div class="row">

                    <div class="col-xl-12 col-xxl-12">
                        <div class="row">

                            <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title">Income</h4>
                                    </div>
                                    <div class="card-body">
                                    <table class="table" id="incomeTable">
                                            <thead>
                                                <tr>
                                                    <th>Reservation ID</th>
                                                    <th>Listing Name</th>
                                                    <th>User</th>
                                                    <th>Payment ID</th>
                                                    <th>Amount Paid</th>
                                                    <th>Date Paid</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                    while ($row = $stmtAnalytics->fetch(PDO::FETCH_ASSOC)) {
                                                        echo "<tr>";
                                                        echo "<td>{$row['rs_id']}</td>";
                                                        echo "<td>{$row['listing_name']}</td>";
                                                        echo "<td>{$row['owner_username']}</td>";
                                                        echo "<td>{$row['payment_id']}</td>";
                                                        echo "<td><b>₱" . number_format($row['amountPaid']) . "</b></td>";
                                                        echo "<td>{$row['payment_date']}</td>";
                                                        echo "</tr>";
                                                    }
                                                    ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Add a similar block for displaying boarders -->
                            
<div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Boarders</h4>
        </div>
        <div class="card-body">
            <table class="table" id="boardersTable">
                <thead>
                    <tr>
                        <th>Reservation ID</th>
                        <th>Boarder Name</th>
                        <th>Listing Name</th>
                        <th>Rooms Availed</th>
                        <th>Date of Reservation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $stmtBoarders->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>{$row['rs_id']}</td>";
                        echo "<td>{$row['boarder_name']}</td>";
                        echo "<td>{$row['listing_name']}</td>";
                        echo "<td>{$row['num_Rooms']}</td>";
                        echo "<td>{$row['date_created']}</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
                            <!-- ... -->

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
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
   

    <?php include('footer_links.php') ?>
    <script>
        
        $(document).ready(function () {
        $('#incomeTable').DataTable({
    
        });
    });

    $(document).ready(function () {
        $('#incomeTable, #boardersTable').DataTable();
    });
    </script>

    <!--**********************************
        End Scripts
    ***********************************-->
</body>

</html>

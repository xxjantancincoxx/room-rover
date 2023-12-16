<?php session_start(); ?>
<?php require_once('../backend/DBconn.php');?>

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
                        <p class="mb-0">Reviews Page</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="row">
                            <div class="col-xl-4 col-lg-6 col-sm-6">
                                <div class="widget-stat card bg-warning">
                                    <div class="card-body  p-4">
                                        <div class="media">
                                            <span class="mr-3">
                                                <i class="flaticon-381-star"></i>
                                            </span>
                                            <div class="media-body text-white text-right">
                                                <p class="mb-1">Average Ratings</p>
                                                <h3 class="text-white">
                                                    <?php
                                                    // Calculate the average rating based on the owner's ID
                                                    $userId = $_SESSION['id'];
                                                    $avgRatingSql = "SELECT AVG(r.rating) as avg_rating
                                                                    FROM reviews r
                                                                    JOIN tbl_listings l ON r.listing_id = l.listing_id
                                                                    WHERE l.owner_id = :userId";

                                                    $stmtAvgRating = $pdo->prepare($avgRatingSql);
                                                    $stmtAvgRating->bindParam(':userId', $userId, PDO::PARAM_INT);
                                                    $stmtAvgRating->execute();

                                                    $avgRating = $stmtAvgRating->fetch(PDO::FETCH_ASSOC);
                                                    echo number_format($avgRating['avg_rating'], 2);
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
                                                        <!-- Add more columns as needed -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    // Fetch ratings based on the user's session ID
                                                    $userId = $_SESSION['id'];
                                                    $sqlRatings = "SELECT l.name AS listing_name, r.rating, r.review_text
                                                                   FROM reviews r
                                                                   JOIN tbl_listings l ON r.listing_id = l.listing_id
                                                                   WHERE l.owner_id = :userId";

                                                    $stmtRatings = $pdo->prepare($sqlRatings);
                                                    $stmtRatings->bindParam(':userId', $userId, PDO::PARAM_INT);
                                                    $stmtRatings->execute();

                                                    while ($rating = $stmtRatings->fetch(PDO::FETCH_ASSOC)) {
                                                        echo '<tr>';
                                                        echo '<td>' . $rating['listing_name'] . '</td>';
                                                        echo '<td>' . $rating['rating'] . '</td>';
                                                        echo '<td>' . $rating['review_text'] . '</td>';
                                                        // Add more columns as needed
                                                        echo '</tr>';
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
    <?php include('footer_links.php') ?>

    <script>
   // Ensure that the document is ready before executing the script
   $(document).ready(function () {
        // Initialize DataTable with pagination
        $('#Orating').DataTable({
           
        });
    });
</script>
    <!--**********************************
        End Scripts
    ***********************************-->
</body>

</html>

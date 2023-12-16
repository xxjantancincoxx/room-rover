<!DOCTYPE html>
<html lang="en">

<?php include('header.php') ?>
<style>
 
</style>
	
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
        <!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <!-- row -->
    <div class="row">
        <!-- Create a table to display reviews -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">My Reviews</h4>
                    <div class="table-responsive">
                        <table class="table header-border" id="reviews">
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
                                // Fetch reviews based on the user's session ID
                                $userId = $_SESSION['id'];
                                $sqlReviews = "SELECT l.name AS listing_name, r.rating, r.review_text
                                               FROM reviews r
                                               JOIN tbl_listings l ON r.listing_id = l.listing_id
                                               WHERE r.user_id = :userId";

                                $stmtReviews = $pdo->prepare($sqlReviews);
                                $stmtReviews->bindParam(':userId', $userId, PDO::PARAM_INT);
                                $stmtReviews->execute();

                                while ($review = $stmtReviews->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<tr>';
                                    echo '<td>' . $review['listing_name'] . '</td>';
                                    echo '<td>' . $review['rating'] . '</td>';
                                    echo '<td>' . $review['review_text'] . '</td>';
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
<!--**********************************
    Content body end
***********************************-->

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
    $(document).ready(function () {
        $('#reviews').DataTable({
            "dom": 'lrtip'
        });
    });
</script>

 
	<!--**********************************
        End Scripts
    ***********************************-->
    
</body>

</html>
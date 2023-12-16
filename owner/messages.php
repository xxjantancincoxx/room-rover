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
                <img class="logo-abbr" src="../assets/images/logo.png" alt="">
                <img class="logo-compact" src="../assets/images/logo-text.png" alt="">
                <img class="brand-title" src="../assets/images/logo-text.png" alt="">
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
						<p class="mb-0">Messages Page</p>
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
												<i class="flaticon-381-send"></i>
											</span>
											<div class="media-body text-white text-right">
												<p class="mb-1">Total Messages</p>
												<h3 class="text-white">20</h3>
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
                                <h4 class="card-title">Messages List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                   
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
	<!--**********************************
        End Scripts
    ***********************************-->
</body>

</html>
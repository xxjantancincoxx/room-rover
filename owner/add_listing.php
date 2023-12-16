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
						<p class="mb-0">Add Listings Page</p>
					</div>
					
					
				</div>
                <div class="row">
                	
					<div class="col-xl-12 col-xxl-12">
						<div class="row">
							<!-- <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12"> -->
							
							
							
							<div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12">
								<div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add a New Listing</h4>
                            </div>
                            <div class="card-body">
                            <div class="basic-form">
                                    <form>
                                    <div class="row">
                                        <div class="col-xl-12">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Listing Name:</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="li_name" name="li_name"  class="form-control" placeholder="Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">E-wallet No.:</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="li_wal" name="li_wal"  class="form-control" placeholder="09098....." required>
                                            </div>
                                        </div>
                                         <!-- Input for QR code upload -->
                                         <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" >E-Wallet QR Code</label>
                                            <div class="col-sm-6">
                                            <input type="file" class="form-control" id="ewallet_qr_code" name="ewallet_qr_code" accept="image/*" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Location:</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="li_loc" name="li_loc"  class="form-control" placeholder="Location" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Price: </label>
                                            <div class="col-sm-6">
                                                <input type="number" name="price" id="price" class="form-control" placeholder="Price" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Rooms Available: </label>
                                            <div class="col-sm-6">
                                                <input type="number" name="rooms" id="rooms" class="form-control" placeholder="Number of rooms available" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Listing Pic:</label>
                                            <div class="col-sm-6">
                                            <div class="form-file">
                                                <input type="file" id='listingpic' name="listingpic" class="form-file-input form-control" required>
                                            </div>
                                            </div>
                                        </div>

                                       

                                        <hr>
                                        <h3>Amenities</h3>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Free Water and Electricity?</label>
                                            <div class="col-sm-4">
                                                <select id="we" name="we" class="form-control form-control-lg">
                                                   
                                                    <option value="1" selected>Yes</option>
                                                    <option value="0">No</option>
                                            </select>
                                            </div>
                                        </div>
                                         
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Airconditioned?</label>
                                            <div class="col-sm-4">
                                                <select id="aircon" name="aircon" class="form-control form-control-lg">
                                                     <option value="1" selected>Yes</option>
                                                    <option value="0">No</option>
                                            </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Free Wifi?</label>
                                            <div class="col-sm-4">
                                                <select id="wifi" name="wifi" class="form-control form-control-lg">
                                                     <option value="1" selected>Yes</option>
                                                    <option value="0">No</option>
                                            </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Own CR?</label>
                                            <div class="col-sm-4">
                                                <select id="own_cr" name="own_cr" class="form-control form-control-lg">
                                                     <option value="1" selected>Yes</option>
                                                    <option value="0">No</option>
                                            </select>
                                            </div>
                                        </div>
                                       
                                       

                                        </div>
                                        <!-- -->
                                       


                                        </div>
                                        <!-- -->
                                       </div>
                                       <div class="row">
                                          
                                            <div class="col-sm-12 col-xl-12">
                                                 <button id="clear" type="button" class="btn btn-danger btn-square">Clear</button>
                                                <button id="save_listing" type="button" class="btn btn-success btn-square">Save</button>
                                                     
                                            </div>
                                        
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
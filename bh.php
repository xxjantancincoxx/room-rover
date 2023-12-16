<?php
include('layouts/header.php')
?>
<style>
    #rs-btn {
        height: 2.8em;
        width: 9em;
        background: #FFFFFF;
        -webkit-animation: jello-horizontal 0.9s both;
        animation: jello-horizontal 0.9s both;
        border: 2px solid #000000;
        outline: none;
        color: #000000;
        font-size: 17px;
    }

    #rs-btn:hover {
        background: #656C74;
        color: #ffffff;
        animation: squeeze3124 0.9s both;
    }

    @keyframes squeeze3124 {
        0% {
            -webkit-transform: scale3d(1, 1, 1);
            transform: scale3d(1, 1, 1);
        }

        30% {
            -webkit-transform: scale3d(1.25, 0.75, 1);
            transform: scale3d(1.25, 0.75, 1);
        }

        40% {
            -webkit-transform: scale3d(0.75, 1.25, 1);
            transform: scale3d(0.75, 1.25, 1);
        }

        50% {
            -webkit-transform: scale3d(1.15, 0.85, 1);
            transform: scale3d(1.15, 0.85, 1);
        }

        65% {
            -webkit-transform: scale3d(0.95, 1.05, 1);
            transform: scale3d(0.95, 1.05, 1);
        }

        75% {
            -webkit-transform: scale3d(1.05, 0.95, 1);
            transform: scale3d(1.05, 0.95, 1);
        }

        100% {
            -webkit-transform: scale3d(1, 1, 1);
            transform: scale3d(1, 1, 1);
        }
    }

    .card {
        width: 500px;
        height: 350px;
        background: #243137;
        position: relative;
        display: grid;
        place-content: center;
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.5s ease-in-out;
    }

    #logo-main, #logo-second {
        height: 100%;
    }

    #logo-main {
        fill: #bd9f67;
    }

    #logo-second {
        padding-bottom: 10px;
        fill: none;
        stroke: #bd9f67;
        stroke-width: 1px;
    }

    .border {
        position: absolute;
        inset: 0px;
        border: 2px solid #bd9f67;
        opacity: 0;
        transform: rotate(10deg);
        transition: all 0.5s ease-in-out;
    }

    .bottom-text {
        position: absolute;
        left: 50%;
        bottom: 13px;
        transform: translateX(-50%);
        font-size: 6px;
        text-transform: uppercase;
        padding: 0px 5px 0px 8px;
        color: #bd9f67;
        background: #243137;
        opacity: 0;
        letter-spacing: 7px;
        transition: all 0.5s ease-in-out;
    }

    .content {
        transition: all 0.5s ease-in-out;
    }

    .content .logo {
        height: 35px;
        position: relative;
        width: 33px;
        overflow: hidden;
        transition: all 1s ease-in-out;
    }

    .content .logo .logo1 {
        height: 33px;
        position: absolute;
        left: 0;
    }

    .content .logo .logo2 {
        height: 33px;
        position: absolute;
        left: 33px;
    }

    .content .logo .trail {
        position: absolute;
        right: 0;
        height: 100%;
        width: 100%;
        opacity: 0;
    }

    .content .logo-bottom-text {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        margin-top: 30px;
        color: #bd9f67;
        padding-left: 8px;
        font-size: 11px;
        opacity: 0;
        letter-spacing: none;
        transition: all 0.5s ease-in-out 0.5s;
    }

    .card:hover {
        border-radius: 0;
        transform: scale(1.1);
    }

    .card:hover .logo {
        width: 134px;
        animation: opacity 1s ease-in-out;
    }

    .card:hover .border {
        inset: 15px;
        opacity: 1;
        transform: rotate(0);
    }

    .card:hover .bottom-text {
        letter-spacing: 3px;
        opacity: 1;
        transform: translateX(-50%);
    }

    .card:hover .content .logo-bottom-text {
        opacity: 1;
        letter-spacing: 9.5px;
    }

    .card:hover .trail {
        animation: trail 1s ease-in-out;
    }

    @keyframes opacity {
        0% {
            border-right: 1px solid transparent;
        }

        10% {
            border-right: 1px solid #bd9f67;
        }

        80% {
            border-right: 1px solid #bd9f67;
        }

        100% {
            border-right: 1px solid transparent;
        }
    }

    @keyframes trail {
        0% {
            background: linear-gradient(90deg, rgba(189, 159, 103, 0) 90%, rgb(189, 159, 103) 100%);
            opacity: 0;
        }

        30% {
            background: linear-gradient(90deg, rgba(189, 159, 103, 0) 70%, rgb(189, 159, 103) 100%);
            opacity: 1;
        }

        70% {
            background: linear-gradient(90deg, rgba(189, 159, 103, 0) 70%, rgb(189, 159, 103) 100%);
            opacity: 1;
        }

        95% {
            background: linear-gradient(90deg, rgba(189, 159, 103, 0) 90%, rgb(189, 159, 103) 100%);
            opacity: 0;
        }
    }
</style>

<body>
    <!-- ***** Loader ****** -->
    <?php include('layouts/loader.php') ?>

    <!-- ***** Navigation ****** -->
    <?php include('layouts/navigation.php') ?>

    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner" style="background-image: url(assets/images/bg2.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-content">
                        <div class="message_1">
                            <i class="fa-solid fa-arrow-right"></i>
                            <h6>We got you everywhere</h6>
                            <i class="fa-solid fa-arrow-left"></i>
                        </div>

                        <h2>Looking for Available Boarding House?</h2>
                        <div class="main-white-button" style="margin-bottom:4rem">
                        <a type="button" class="btn btn-sm" id="rs-btn" href="../room_rover/login.php">
                                Find Now!</a>
                          
                        </div>
                        <div class="next-show" style="margin-left:-3%">
                            <i class="fa fa-arrow-up"></i>
                            <span>Scroll Up</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->


    <!-- ********* MAIN CONTENT ********* -->
    <div class="main" style="height:auto; background-color:#656C74; padding:1rem; padding-bottom:5rem;">
        <div class="col-lg-12">
            <div class="section-heading">
                <h2 style="color:#FFFFFF">Available Boarding House</h2>
            </div>
        </div>
        <div style="display:flex; flex-wrap:wrap; justify-content:center; gap:5rem;">
            <!-- 1 -->
            <div class="card">
                <div class="border"></div>
                <div class="content">
                    <img src="assets/images/bh1.jpg" alt="" style="transform:scale(0.29);">
                </div>
                <span class="bottom-text">RoomRover</span>
            </div>
            <!-- 2 -->
            <div class="card">
                <div class="border"></div>
                <div class="content">
                    <img src="assets/images/bh1.jpg" alt="" style="transform:scale(0.29);">
                </div>
                <span class="bottom-text">RoomRover</span>
            </div>
            <!-- 3 -->
            <div class="card">
                <div class="border"></div>
                <div class="content">
                    <div class="logo">
                        <span class="trail"></span>
                    </div>
                    <span class="logo-bottom-text">uiverse.io</span>
                </div>
                <span class="bottom-text">RoomRover</span>
            </div>
        </div>
    </div>


    <!-- ********* END OF MAIN CONTENT ********* -->


    <!-- *** Footer *** -->
    <?php include('layouts/footer.php') ?>




</body>

</html>
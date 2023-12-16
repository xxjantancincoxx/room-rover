<?php include('layouts/header.php'); ?>

<style>
    .main {
        background-color: #656C74;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .box {
        width: 50%;
        padding: 40px;
        background: #FFFFFF;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.6);
        border-radius: 8px;
        text-align: center;
    }

    .signup-label h3 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .button {
        display: flex;
        justify-content: space-evenly; /* Adjusted spacing */
        margin-top: 30px;
    }

    .btn {
        display: inline-block;
        padding: 12px 20px;
        background: #656C74;
        color: #FFFFFF;
        text-decoration: none;
        border-radius: 4px;
        transition: background 0.3s ease;
        cursor: pointer;
    }

    .btn:hover {
        background: #CECFD1;
    }
</style>

<body>
    <?php include('layouts/navigation.php'); ?>

    <div class="main">
        <div class="box">
            <div class="signup-label">
                <h3>Choose Your User Type</h3>
            </div>
            <div class="signup">
                <div class="button">
                    <a href="signup.php?type=owner" class="btn">Owner</a>
                    <a href="signup.php?type=boarder" class="btn">Boarder</a>
                </div>
            </div>
        </div>
    </div>
</body>

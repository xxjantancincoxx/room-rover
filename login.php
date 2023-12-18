<?php 
session_start();

include './vendor/autoload.php';

if (isset($_SESSION['session'])) {
    
}

include('layouts/header.php')
?>
<style>
    .main {
        background-color: #656C74;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;

    }

    .box {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 400px;
        padding: 20px;
        text-align: center;
        transform: translate(-50%, -50%);
        background: #FFFFFF;
        box-sizing: border-box;
        box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
        border-radius: 10px;
    }

    .main .login-label {
        padding: 1rem;
    }

    .group {
        position: relative;
        width: 90%;
        margin: auto;
    }

    .password {
        margin-top: 1rem;
    }

    .input {
        font-size: 16px;
        padding: 10px 10px 10px 5px;
        display: block;
        width: 100%;
        border: none;
        border-bottom: 2px solid #656C74;
        margin: auto;
        outline: none;
    }

    .button {
        margin-top: 10px;
        display: flex;
        justify-content: center;
    }

    button {
        display: flex;
        align-items: center;
        justify-content: center;
        outline: none;
        cursor: pointer;
        width: 120px;
        height: 40px;
        border-radius: 5px;
        border: 1px solid #8F9092;
        transition: all 0.2s ease;
        font-family: "Source Sans Pro", sans-serif;
        font-size: 14px;
        background-color: #656C74;
        color: #FFFFFF;
    }

    .avatarIcon {
        font-size: 55px;
    }
</style>

<body>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">


    <?php include('layouts/navigation.php') ?>

    <div class="main">
        <div class="box">
            <div class="login-label">
                <div class="mb-3">
                    <i class="fas fa-user avatarIcon"></i>
                </div>
                <h4>Login</h4>
                <br>
                <?php if (isset($_SESSION['error'])) { ?>
                    <span class="text-danger h6">
                        <?php 
                            echo $_SESSION['error'];
														unset($_SESSION['error']);
                        ?>
                    </span>
                <?php } ?>
            </div>
            <div class="login">
                <form action="backend/login.php" method="post">
                    <div class="group username">
                        <input autocomplete="off" placeholder="Username" required type="text" class="input" name="username">
                    </div>
                    <div class="group password">
                        <input autocomplete="off" placeholder="Password" required type="password" class="input" name="password">
                    </div><br>
                    <div class="button">
                        <button type="submit">
                            Login
                        </button>
                    </div><br>
                    <!-- <p>OR</p> -->
                    <!-- <div class="button" > -->
                    <!-- <a href="<?= $gclient->createAuthUrl() ?>" style="width:200px;"> -->
                    <!-- Sign in with Google -->
                    <!-- </a> -->
                    <!-- </div> -->
                </form><br>
                <p>Don't have an acount yet? Signup <a href="select_user_type.php">here</a></p>
            </div>
        </div>
    </div>

</body>
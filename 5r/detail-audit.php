<?php
@session_start();
include "config.php";

if (@$_SESSION['auditor']) {
    ?>

    <html lang="en">

    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
        <title>Hasil Audit</title>
        <style>
            * {
                margin: 0;
                padding: 0;
            }

            body {
                background-color: #B3D3C8;
                color: black;
                font-family: 'poppins', sans-serif;
            }

            .header {
                margin-top: 1vw;
                padding-top: 25px;
                padding-bottom: 25px;
                padding-left: 35px;
                padding-right: 35px;
                box-sizing: border-box;
                display: flex;
                justify-content: space-around;
            }

            .header h1 {
                margin: 1vw;
                font-family: 'poppins', sans-serif;
            }

            .header .profil {
                display: flex;
                justify-content: space-around;
                align-items: center;
                width: 42%;
            }

            .profil-img,
            .header .profil img {
                border-radius: 100%;
                width: 4em;
                height: 4em;
                border: 0;
            }

            .form-container {
                width: 180px;
                height: 80px;
                padding: 10px;
                border-radius: 20px;
                box-shadow: 0px 4px 4px 0px rgba(1, 1, 1, 0.5);
                background-color: white;
            }

            .form-container .btn {
                background-color: #D82B2B;
                color: white;
                margin-top: 10%;
                margin-left: 20%;
                padding: 13px 20px;
                border: none;
                width: 100px;
                opacity: 0.8;
                border-radius: 10px;
            }

            .dropdown {
                position: relative;
                display: inline-block;

            }

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f9f9f9;
                min-width: 160px;
                right: 10px;
                overflow: auto;
                border-radius: 20px;
                box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
                z-index: 999;
            }

            .show {
                display: block;
            }

            span {
                font-size: 20px;
            }

            .container {
                display: inline;
                align-items: center;
                position: absolute;
                width: 100%;
                height: 1050px;
                padding: 0 0%;
                margin-top: 2%;
                background-color: #FFFFFF;
                border-radius: 40px 40px 0px 0px;
            }

            .filter {
                margin: 4% 5% 0;
                background-color: blue;
                height: 9%;
            }

            .ctn-part {
                background-color: green;
                margin: 0 5% 0;
                padding: 10px 20px;
                height: 13%;
                border-radius: 15px;
                box-shadow: 0px 6px 4px 0px rgba(0, 0, 0, 0.5);
            }

            .ctn-menu {
                margin: 10px 0;
            }

            .top {
                overflow: auto;
                padding: 20px;
                padding-left: 50px;
                padding-right: 50px;
                box-sizing: border-box;
            }
            .left {
                float: left;
                width: 50%;
            }
            .right {
                float: left;
                width: 50%;
                text-align: right;
            }
        </style>
    </head>

    <body>
        <div class="header">
            <h1>Hasil Audit</h1>
            <div class="profil">
                <span>
                    Hi,
                    <?php echo $_SESSION['login_name']; ?> <br />
                    <?php echo $_SESSION['login_kartu'] ?>
                </span>
                <div class="dropdown">
                    <button class="profil-img" id="myBtn"><img src="assets/img-profil.svg"></button>
                    <div id="myDropdown" class="dropdown-content">
                        <form action="logout.php" class="form-container">
                            <button type="submit" class="btn">logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">

            <div class="top">
                <div class="left">
                    <h2>Maintenance</h2>
                    <h3>Muhammad Tajuddin</h3>
                    <span>07-02-2023</span>
                </div>    
                <div class="right"> 
                    <h1 style="font-size: 50px !important;">4,900</h1>
                </div>
            </div>

        </div>
        <!-- code popup logout-->
        <?php include 'functions.php'; ?>
    </body>

    </html>

    <?php
} else {
    header("location: login.php");
}
?>
<?php
@session_start();
include "config.php";

if (@$_SESSION['auditor']) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@800&display=swap" rel="stylesheet">
        <title>Menu</title>
        <style type="text/css">
            * {
                margin: 0;
                padding: 0;
            }

            body {
                background: #FFF;
                color: black;
            }

            .header {
                padding-top: 25px;
                padding-bottom: 90px;
                padding-left: 35px;
                padding-right: 35px;
                box-sizing: border-box;
                overflow: auto;
                background-color: #B3D3C8;
            }

            .header-left {
                float: left;
                width: 37%;
                font-family: 'poppins', sans-serif;
            }

            .header-right {
                float: left;
                width: 63%;
                font-family: 'poppins', sans-serif;
                text-align: right;
                overflow: auto;
            }

            .profile {
                float: left;
                width: 75%;
                padding-top: 5px;
                box-sizing: border-box;
                margin-right: 10px;
            }

            .img {
                float: left;
                width: 20%;
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

            .dropbtn {
                border: none;
                border-radius: 100%
            }

            .dropdown {
                position: relative;
                display: inline-block;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #fff;
                width: 180px;
                height: 95px;
                z-index: 999;
                text-align: center;
                left: 370px;
                box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
                border-radius: 10px;
            }

            .dropdown-content a {
                font-family: 'poppins', sans-serif;
                color: #fff;
                background-color: #D82B2B;
                margin: 25px 20px 0;
                padding: 10px;
                box-sizing: border-box;
                text-decoration: none;
                display: block;
                border-radius: 10px;
            }

            .show {
                display: block;
            }

            span {
                font-size: 20px;
            }

            .container {
                overflow: auto;
                width: 100%;
                margin-top: -50px;
                background-color: #FFFFFF;
                padding-left: 30px;
                padding-right: 30px;
                padding-top: 50px;
                padding-bottom: 50px;
                border-radius: 40px 40px 0px 0px;
                box-sizing: border-box;
            }

            .container-icon {
                background-color: blue;
                width: 100%;
                height: 400px;
            }

            .menu {
                width: 100%;
                height: auto;
                border-radius: 15px;
                box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.2);
                margin-bottom: 20px;
                padding: 20px;
                padding-top: 5px;
                padding-bottom: 5px;
                box-sizing: border-box;
                overflow: auto;
                padding-bottom: 20px;
                padding-top: 20px;
                overflow-y: hidden
            }

            .menu-blue {
                background-color: #FFFFE1;
            }

            .menu-yellow {
                background-color: #E6F6DC;
            }

            .menu-purple {
                background-color: #C5E2CC;
            }

            .menu-pink {
                background-color: #C3E3DE;
            }
            .menu-biru {
                background-color: #ABD3DB;
            }

            .icon {
                width: 30%;
                height: 150px;
                box-sizing: border-box;
                border-radius: 10px;
                float: left;
                text-align: center;
                margin-right: 20px;
            }

            .icon-blue {
                background-color: #D3D3AE;
            }

            .icon-k {
                background-color: #AABC9E;
            }

            .icon-sk {
                background-color: #A5BCAB;
            }

            .icon-sm {
                background-color: #9DBDB8;
            }
            .icon-ha {
                background-color: #8AADB4;
            }

            .desc {
                width: 65%;
                margin: 0;
                padding: 0x;
                text-align: start;
                float: left;
                padding-top: 15px;
            }

            h3 {
                font-size: 35px;
                font-family: 'poppins', sans-serif;
                margin: 0px;
                padding: 0px;
                line-height: 0.9em;
                margin-bottom: 15px;
            }

            .btn {
                width: 65%;
                padding: 10px;
                box-sizing: border-box;
                border-radius: 10px;
                border: 0px;
                font-size: 18px;
                padding-top: 15px;
                padding-bottom: 15px;
            }

            .btn-primary {
                background: #fff;
                color: black;
                box-shadow: 0px 4px 4px 0px rgba(1, 1, 1, 0.5);
            }
        </style>
    </head>

    <body>
        <div class="header">
            <div class="header-left">
                <img src="assets/img-omegamas.svg">
            </div>
            <div class="header-right">
                <div class="profile">
                    Hi,
                    <?php
                    echo $_SESSION['login_fullname'];
                    echo "<br/>";
                    echo $_SESSION['department_id'];
                    ?>
                </div>
                <div class="dropdown">
                    <img onclick="myFunction()" class="dropbtn" src="assets/img-profil.svg" width="100%">
                </div>
                <div id="myDropdown" class="dropdown-content">
                    <a href="logout.php">Logout</a>
                </div>

                <?php 
                    $login = $_SESSION['login_id'];
                    $today = date('Y-m-d');

                    $sql1 = mysqli_query($conn, "SELECT menu_id FROM t_audit WHERE menu_id = '1' AND login_id = '$login' AND audit_date = '$today'");
                    $row1 = mysqli_num_rows($sql1);

                    $sql2 = mysqli_query($conn, "SELECT menu_id FROM t_audit WHERE menu_id = '2' AND login_id = '$login' AND audit_date = '$today'");
                    $row2 = mysqli_num_rows($sql2);

                    $sql3 = mysqli_query($conn, "SELECT menu_id FROM t_audit WHERE menu_id = '3' AND login_id = '$login' AND audit_date = '$today'");
                    $row3 = mysqli_num_rows($sql3);

                    $sql4 = mysqli_query($conn, "SELECT menu_id FROM t_audit WHERE menu_id = '4' AND login_id = '$login' AND audit_date = '$today'");
                    $row4 = mysqli_num_rows($sql4);
                ?>

            </div>
        </div>
        <div class="container">
            <?php if($row1 >= 1) { echo ''; } else { ?>
            <div class="menu menu-blue" onclick="next1()">
                <div class="icon icon-blue">
                    <img src="assets/img-icon1.svg" style="width: 75%; margin-top: -5px; margin-left: 40px;">
                </div>
                <div class="desc">
                    <h3>Kebersihan & Kerapian</h3>                    
                    <button class="btn btn-primary">MULAI</button>
                </div>
            </div>
            <?php } ?>

            <?php if($row2 >= 1) { echo ''; } else { ?>
            <div class="menu menu-yellow" onclick="next2()">
                <div class="icon icon-k">
                    <img src="assets/img-icon2.svg" style="width: 120%; margin-top: -5px; margin-left: 10px;">
                </div>
                <div class="desc">
                    <h3>Kedisiplinan</h3>
                    <button class="btn btn-primary" style="margin-top: 35px;">MULAI</button>
                </div>
            </div>
            <?php } ?>

            <?php if($row3 >= 1) { echo ''; } else { ?>
            <div class="menu menu-purple" onclick="next3()">
                <div class="icon icon-sk">
                    <img src="assets/img-icon3.svg" style="width: 120%; margin-top: -5px; margin-left: 5px;">
                </div>
                <div class="desc">
                    <h3>Sarana Kerja</h3>
                    <button class="btn btn-primary" style="margin-top: 35px;">MULAI</button>
                </div>
            </div>
            <?php } ?>

            <?php if($row4 >= 1) { echo ''; } else { ?>
            <div class="menu menu-pink" onclick="next4()">
                <div class="icon icon-sm">
                    <img src="assets/img-icon4.svg" style="width: 140%; margin-top: 20px; margin-left: -20px;">
                </div>
                <div class="desc">
                    <h3>Saran &<br />Masukan</h3>
                    <button class="btn btn-primary">MULAI</button>
                </div>
            </div>
            <?php } ?>

            <?php if($row1 >= 1 AND $row2 >= 1 AND $row3 >= 1 AND $row4 >= 1) {  ?>
            <div class="menu menu-biru" onclick="next5()">
                <div class="icon icon-sm">
                    <img src="assets/img-menu-biru.png" style="width: 100%; margin-top: 5px; margin-left: -5px;">
                </div>
                <div class="desc">
                    <h3>Hasil Audit</h3>
                    <button class="btn btn-primary" style="margin-top: 30px;">MULAI</button>
                </div>
            </div>
            <?php } else { echo ''; } ?>
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
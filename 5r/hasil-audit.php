<?php
@session_start();
include "config.php";

if (@$_SESSION['auditor']) {
    ?>

    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
        <title>Hasil Audit</title>
        <style>
            * {
                margin: 0;
                padding: 0;
            }

            body {
                background-color: #B3D3C8;
                color: black;
            }

            .header {
                margin-top: 1vw;
                padding-top: 25px;
                padding-bottom: 25px;
                padding-left: 35px;
                padding-right: 35px;
                box-sizing: border-box;
                display: flex;
                justify-content: space-between;
                align-items: center;
                text-align: end;
            }
            .header span {
                font-size: 22px;
                font-weight: 500;
                line-height: 0.8em;
            }

            .header h1 {
                font-family: 'poppins', sans-serif;
            }

            .header .profil {
                display: flex;
                justify-content: space-around;
                align-items: center;
                width: 42%;
            }

            .container {
                width: 100%;
                height: auto;
                margin-top: 10px;
                padding-top: 5px;
                box-sizing: border-box;
                background-color: #FFFFFF;
                border-radius: 40px 40px 0px 0px;
                font-family: 'poppins', sans-serif;
                padding: 20px;
                overflow: auto;
            }

            .result {
                padding: 20px 20px;
                box-sizing: border-box;
                overflow: auto;
                border-radius: 15px;
                box-shadow: 0px 0px 4px 0px rgba(0, 0, 0, 0.5);
                margin-top: 20px;
            }

            .result-auditor {
                float: left;
                width: 70%;
            }

            .result-point {
                float: right;
                width: 30%;
                text-align: right;
            }
            .point {
                font-size: 40px;
            }
            .ctn-result {
                padding: 10px;
                padding-left: 15px;
                padding-right: 15px;
                box-sizing: border-box;
                border-radius: 10px;
                border: none;
            }

            .result-point span {
                margin-left: 55%;
                font-size: 25px;
                font-weight: 800;
            }
            .secondary {
                color: white;
                background-color: #E82727;
            }

            .primary {
                color: white;
                background-color: #74BFA5;
            }

            .btn {
                margin-top: 50px;
                margin-bottom: 50px;
                padding: 20px 70px;
                box-sizing: border-box;
                border: none;
                border-radius: 20px;
                font-size: 16px;
                box-shadow: 0px 6px 8px 0px rgba(0, 0, 0, 0.5);
            }
            
        </style>
    </head>
    <body>
        <div class="header">
        <a href="menu.php"><img src="assets/img-back.svg"></a>
            <div class="header-tittle">
                <h1>Hasil Audit</h1>
                <span><?php echo $_SESSION['department_id']; ?></span>
            </div>
        </div>
        <div class="container">
            <?php 
                $login = $_SESSION['login_id'];
                $tanggal = date("Y-m-d");
                $qry = mysqli_query($conn, "SELECT * FROM t_audit WHERE login_id = '$login' AND audit_date = '$tanggal'");
                while($row = mysqli_fetch_array($qry)) {
                $audit = $row['audit_id'];
                $menu = $row['menu_id'];
                $date = $row['audit_date'];
                $date = date("d F Y", strtotime($date));
                $tindakan = $row['audit_tindakan'];
                $desc = $row['audit_desc'];

                $sql = mysqli_query($conn, "SELECT SUM(detail_resik) as resik, SUM(detail_ringkas) as ringkas, SUM(detail_rapih) as rapih, SUM(detail_rajin) as rajin, SUM(detail_rawat) as rawat FROM t_audit_detail a LEFT JOIN t_audit b ON a.audit_id = b.audit_id WHERE a.audit_id = '$audit'");
                $data = mysqli_fetch_array($sql);
                $resik = $data['resik'];
                $ringkas = $data['ringkas'];
                $rapih = $data['rapih'];
                $rajin = $data['rajin']; 
                $rawat = $data['rawat'];

                $total = $resik+$ringkas+$rapih+$rajin+$rawat;
            ?>
            <div class="result">
                <div class="result-auditor">
                    <span>
                        <?php echo $date; ?><br/>
                        <i><?php 
                            if($menu == 1) {
                                echo 'Kebersihan & Kerapian';
                            } elseif($menu == 2) {
                                echo 'Kedisiplinan';
                            } elseif($menu == 3) {
                                echo 'Sarana Kerja';
                            } elseif($menu == 4) {
                                echo 'Saran & Masukan';
                            } 
                        ?></i></span>
                    <h4 style="font-size: 24px;"><?php echo $_SESSION['login_fullname']; ?></h4><br/>
                    <p style="line-height: 1.2em; font-weight: 200; color: #181a1c; font-size: 14px;"><?php echo $desc; ?></p>
                </div>
                <div class="result-point">
                    <?php if($tindakan == '1') { ?>
                        <button class="ctn-result secondary">Perlu Tindakan</button>
                    <?php } else { ?>
                        <button class="ctn-result primary">Tidak Perlu Tindakan</button>
                    <?php } ?>
                    <h3 class="point">
                        <?php 
                            if($menu != 4) {
                                echo number_format($total); 
                            } else { echo ''; }
                        ?>        
                    </h3>
                </div>
            </div>
            <?php } ?>
            <center>
                <a href="hasil-detail.php"><button type="button" class="btn primary">Review</button></a>
            </center>
        </div>
    </body>
    </html>

<?php
    } else {
        header("location: login.php");
    }
?>
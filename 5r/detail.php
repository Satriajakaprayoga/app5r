<?php
@session_start();
include "config.php";
$menu = $_GET['menu_id'];
$login = $_SESSION['login_id'];
$today = date('Y-m-d');

if (@$_SESSION['auditor']) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
        <title>Formulir</title>
        <style type="text/css">
            * {
                margin: 0;
                padding: 0;
            }

            body {
                background: #B3D3C8;
                color: black;
            }

            .header {
                margin-top: 1vw;
                padding-top: 30px;
                padding-bottom: 30px;
                padding-left: 39px;
                padding-right: 39px;
                box-sizing: border-box;
                display: flex;
                justify-content: space-between;
                align-items: center;
                text-align: right;
            }

            .container {
                width: 100%;
                height: auto;
                padding: 45px;
                padding-top: 50px;
                box-sizing: border-box;
                background-color: #FFFFFF;
                border-radius: 40px 40px 0px 0px;
                margin-top: 1.9vw;
            }

            h1 {
                margin: 0px !important;
                padding: 0px !important;
                font-family: 'poppins', sans-serif;
                line-height: 1em;
            }

            h3 {
                font-size: 1.5em;
                font-weight: 550;
                margin-bottom: 25px;
                font-family: 'poppins', sans-serif;
            }

            hr {
                margin-top: 50px;
                margin-bottom: 50px;
            }

            input,
            td {
                margin: 3vw;
                font-family: 'poppins', sans-serif;
            }

            th {
                font-family: 'poppins', sans-serif;
                font-weight:  200;
            }

            input {
                height: 3em;
                width: 3em;
            }

            .btn {
                margin-left: 30%;
                width: 200px;
                padding: 10px;
                box-sizing: border-box;
                border-radius: 30px;
                border: 0px;
                font-size: 18px;
            }

            .btn-primary {
                background: #60AA90;
                color: #FFFFFF;
                box-shadow: 0px 4px 4px 0px rgba(1, 1, 1, 0.5);
            }
        </style>
    </head>

    <body>
        <?php 
            $cek_dulu = mysqli_query($conn, "SELECT * FROM t_audit WHERE menu_id = '$menu' AND login_id = '$login' AND audit_date = '$today'");
            $row_dulu = mysqli_num_rows($cek_dulu);
            if($row_dulu == 1) {
                echo "<script>window.location=('menu.php')</script>";
            }

            $cek_dulu = mysqli_query($conn, "SELECT * FROM t_audit WHERE menu_id = '$menu' AND login_id = '$login' AND audit_date = '0000-00-00'");
            $row_dulu = mysqli_num_rows($cek_dulu);
            if($row_dulu == 1) {
                echo "<script>window.location=('tindakan.php?menu_id=".$menu."')</script>";
            }
        ?>
        <div class="header">
            <a href="menu.php"><img src="assets/img-back.svg"></a>
            <?php if($menu == 1) { ?>
                <h1>Kebersihan & <br> Kerapian</h1>
            <?php } elseif($menu == 2) { ?>
                <h1>Kedisplinan</h1>
            <?php } elseif($menu == 3) { ?>
                <h1>Sarana Kerja</h1>
            <?php } ?>
        </div>
        <div class="container">

            <form action="eks.php?act=<?php echo $menu; ?>" method="POST">
                <?php
                    $sql = mysqli_query($conn, "SELECT * FROM m_sub WHERE menu_id = '$menu'");
                    $no = 1;
                    while ($data = mysqli_fetch_array($sql)) {
                    $id = $data['sub_id'];
                ?>
                <input type="text" name="menu_id" value="<?php echo $menu; ?>" hidden>
                <input type="text" name="login_id" value="<?php echo $login; ?>" hidden>
                <input type="text" name="<?php echo $id; ?>" value="<?php echo $id; ?>" hidden>
                <table>
                    <h3><?php echo $no++; ?>. <?php echo $data['sub_title']; ?></h3>
                    <tr>
                        <th></th>
                        <th>Sangat<br>baik</th>
                        <th>Baik</th>
                        <th>Cukup</th>
                        <th>Kurang</th>
                        <th>Kurang<br />Sekali </th>
                        <th>N/A</th>
                    </tr>
                    <tr>
                        <td>Resik </td>
                        <td><input type="radio" id="resik" name="resik<?php echo $id; ?>" value="20" required></td>
                        <td><input type="radio" id="resik" name="resik<?php echo $id; ?>" value="40"></td>
                        <td><input type="radio" id="resik" name="resik<?php echo $id; ?>" value="60"></td>
                        <td><input type="radio" id="resik" name="resik<?php echo $id; ?>" value="80"></td>
                        <td><input type="radio" id="resik" name="resik<?php echo $id; ?>" value="100"></td>
                        <td><input type="radio" id="resik" name="resik<?php echo $id; ?>" value="0"></td>
                    </tr>
                    <tr>
                        <td>Ringkas </td>
                        <td><input type="radio" id="ringkas" name="ringkas<?php echo $id; ?>" value="20" required></td>
                        <td><input type="radio" id="ringkas" name="ringkas<?php echo $id; ?>" value="40"></td>
                        <td><input type="radio" id="ringkas" name="ringkas<?php echo $id; ?>" value="60"></td>
                        <td><input type="radio" id="ringkas" name="ringkas<?php echo $id; ?>" value="80"></td>
                        <td><input type="radio" id="ringkas" name="ringkas<?php echo $id; ?>" value="100"></td>
                        <td><input type="radio" id="ringkas" name="ringkas<?php echo $id; ?>" value="0"></td>
                    </tr>
                    <tr>
                        <td>Rapih </td>
                        <td><input type="radio" id="rapih" name="rapih<?php echo $id; ?>" value="20" required></td>
                        <td><input type="radio" id="rapih" name="rapih<?php echo $id; ?>" value="40"></td>
                        <td><input type="radio" id="rapih" name="rapih<?php echo $id; ?>" value="60"></td>
                        <td><input type="radio" id="rapih" name="rapih<?php echo $id; ?>" value="80"></td>
                        <td><input type="radio" id="rapih" name="rapih<?php echo $id; ?>" value="100"></td>
                        <td><input type="radio" id="rapih" name="rapih<?php echo $id; ?>" value="0"></td>
                    </tr>
                    <td>Rajin </td>
                    <td><input type="radio" id="rajin" name="rajin<?php echo $id; ?>" value="20" required></td>
                    <td><input type="radio" id="rajin" name="rajin<?php echo $id; ?>" value="40"></td>
                    <td><input type="radio" id="rajin" name="rajin<?php echo $id; ?>" value="60"></td>
                    <td><input type="radio" id="rajin" name="rajin<?php echo $id; ?>" value="80"></td>
                    <td><input type="radio" id="rajin" name="rajin<?php echo $id; ?>" value="100"></td>
                    <td><input type="radio" id="rajin" name="rajin<?php echo $id; ?>" value="0"></td>
                    <tr>
                        <td>Rawat </td>
                        <td><input type="radio" id="Rawat" name="rawat<?php echo $id; ?>" value="20" required></td>
                        <td><input type="radio" id="Rawat" name="rawat<?php echo $id; ?>" value="40"></td>
                        <td><input type="radio" id="Rawat" name="rawat<?php echo $id; ?>" value="60"></td>
                        <td><input type="radio" id="Rawat" name="rawat<?php echo $id; ?>" value="80"></td>
                        <td><input type="radio" id="Rawat" name="rawat<?php echo $id; ?>" value="100"></td>
                        <td><input type="radio" id="Rawat" name="rawat<?php echo $id; ?>" value="0"></td>
                    </tr>
                </table>
                <hr />
                <?php } ?>
                <input class="btn btn-primary" type="submit" name="" value="Lanjut">
            </form>
                
        </div>
    </body>

    </html>

    <?php
} else {
    header("location: login.php");
}
?>
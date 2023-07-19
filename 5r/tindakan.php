<?php
@session_start();
include "config.php";
$menu = $_GET['menu_id'];
$login = $_SESSION['login_id'];

if (@$_SESSION['auditor']) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0 , maximum-scale=1.0, user-scalable=0">
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
        <title>Form 5R - Form Tindakan</title>
        <script type="text/javascript">
           function PreviewImage1() {
              var oFReader = new FileReader();
              oFReader.readAsDataURL(document.getElementById("uploadImage1").files[0]);
              oFReader.onload = function (oFREvent)
              {
                 document.getElementById("uploadPreview1").src = oFREvent.target.result;
              };
           };

           function PreviewImage2() {
              var oFReader = new FileReader();
              oFReader.readAsDataURL(document.getElementById("uploadImage2").files[0]);
              oFReader.onload = function (oFREvent)
              {
                 document.getElementById("uploadPreview2").src = oFREvent.target.result;
              };
           };

           function PreviewImage3() {
              var oFReader = new FileReader();
              oFReader.readAsDataURL(document.getElementById("uploadImage3").files[0]);
              oFReader.onload = function (oFREvent)
              {
                 document.getElementById("uploadPreview3").src = oFREvent.target.result;
              };
           };
        </script>
        <style type="text/css">
            * {
                margin: 0;
                padding: 0;
            }

            body {
                background: #B3D3C8;
                color: black;
                font-family: 'poppins', sans-serif;
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

            h1 {
                margin: 0px !important;
                padding: 0px !important;
                font-family: 'poppins', sans-serif;
                line-height: 1em;
            }

            .container {
                width: 100%;
                height: auto;
                padding: 10px;
                padding-top: 50px;
                box-sizing: border-box;
                background-color: #FFFFFF;
                border-radius: 40px 40px 0px 0px;
                margin-top: 1.9vw;
            }

            .container h3 {
                font-size: 18px;
                margin-bottom: 10px;
            }

            .ctn {
                margin-top: 1vw;
                padding: 1.5em 2.4em;
            }

            .ctn-hd th {
                padding-left: 0;
                margin: 10px;
                text-align: start;
            }

            .ctn-bt td {
                padding-top: 15px;
                padding-right: 40px;
            }

            textarea {
                height: 95%;
                width: 100%;
                border-radius: 5px;
                font-size: 23px;
                padding: 20px;
                box-sizing: border-box;
                font-family: 'poppins', sans-serif;
            }

            .ctn-upload {
                
            }

            input {
                padding: 10px;
                margin: 10px 0;
                height: 30px;
                width: 30px;
                box-sizing: border-box;
            }

            label {
                margin-left: 10px;
                margin-right: 10px;
                text-align: center;
            }

            .btn {
                width: 120%;
                padding: 0 15px;
                box-sizing: border-box;
                border-radius: 15px;
                border: 0px;
                font-size: 18px;
            }

            .btn-save {
                margin-top: 20px;
                margin-left: 30%;
                width: 200px;
                padding: 19px;
                box-sizing: border-box;
                border-radius: 30px;
                border: 0px;
                font-size: 18px;
                margin-bottom: 50px;
            }

            .btn-primary {
                background: #60AA90;
                color: #fff;
                box-shadow: 0px 4px 4px 0px rgba(1, 1, 1, 0.5);
            }

            .custom-file-input {
                width: 80px;
                height: 50px;
                margin-bottom: 0;
                color: transparent;
            }

            .custom-file-input::-webkit-file-upload-button {
                visibility: hidden;
            }

            .custom-file-input::before {
                content: 'Upload';
                color: white;
                font-weight: 700;
                font-size: 18px;
            }
        </style>
    </head>

    <body>
        <?php 
            $today = date('Y-m-d');
            $cek_dulu = mysqli_query($conn, "SELECT * FROM t_audit WHERE menu_id = '$menu' AND login_id = '$login' AND audit_date = '$today'");
            $row_dulu = mysqli_num_rows($cek_dulu);
            if($row_dulu == 1) {
                echo "<script>window.location=('menu.php')</script>";
            }
        ?>
        <div class="header">
            <a href="menu.php"><img src="assets/img-back.svg"></a>
            <?php if($_GET['menu_id'] == 1) { ?>
                <h1>Kebersihan & <br> Kerapian</h1>
            <?php } elseif($_GET['menu_id'] == 2) { ?>
                <h1>Kedisplinan</h1>
            <?php } elseif($_GET['menu_id'] == 3) { ?>
                <h1>Sarana Kerja</h1>
            <?php } elseif($_GET['menu_id'] == 4) { ?>
                <h1>Saran &<br/> Masukan</h1>
            <?php } ?>
        </div>
        <div class="container">

            <form action="eks-tindakan.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="NoKartu" value="<?php echo $_SESSION['login_kartu']; ?>" hidden>
                <input type="text" name="login_id" value="<?php echo $_SESSION['login_id']; ?>" hidden>
                <input type="text" name="menu_id" value="<?php echo $_GET['menu_id']; ?>" hidden>
                <p align="center">Untuk Catatan dan Foto Boleh di Kosongi</p>
                <div class="ctn">
                    <?php if($_GET['menu_id'] == 4) { ?>
                    <h3>Saran atau Inputan Lain</h3>
                    <?php } else { ?>
                    <h3>Catatan</h3>
                    <?php } ?>
                    <textarea name="desc" id="notes" rows="4"></textarea>
                </div>

                <table width="90%" style="margin: auto;">
                    <tr class="ctn-hd">
                        <th>Foto 1</th>
                        <th>Foto 2</th>
                        <th>Foto 3</th>
                    </tr>
                    <tr class="ctn-bt">
                        <td width="33%">
                            <img id="uploadPreview1" style="width: 100%; height: 150px;"/><br>
                            <button class="btn btn-primary" type="button">
                                <input id="uploadImage1" accept="image/*" capture class="custom-file-input" value="Upload" type="file" name="photo1" onchange="PreviewImage1();">
                            </button>
                        </td>
                        <td width="33%">
                            <img id="uploadPreview2" style="width: 100%; height: 150px;"/><br>
                            <button class="btn btn-primary" type="button">
                                <input id="uploadImage2" accept="image/*" capture class="custom-file-input" value="Upload" type="file" name="photo2" onchange="PreviewImage2();">
                            </button>
                        </td>
                        <td width="33%">
                            <img id="uploadPreview3" style="width: 100%; height: 150px;"/><br>
                            <button class="btn btn-primary" type="button">
                                <input id="uploadImage3" accept="image/*" capture class="custom-file-input" value="Upload" type="file" name="photo3" onchange="PreviewImage3();">
                            </button>
                        </td>
                    </tr>
                </table>

                <div class="ctn">
                    <p>Perlu di tindak lanjuti? <span style="color: red;">*</span></p>
                    <table>
                        <tr>
                            <td><input type="radio" id="tindakan" name="tindakan" value="1" required></td>
                            <td><label for="yes">Ya</label></td>
                            <td><input type="radio" id="tindakan" name="tindakan" value="0"></td>
                            <td><label for="no">Tidak</label></td>
                        </tr>
                    </table>
                </div>
                <button type="submit" class="btn-save btn-primary">Simpan</button>
            </form>
                
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
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
                box-sizing: border-box;
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
                display: flex;
                justify-content: space-between;
                align-items: center;
                text-align: end;
            }
            .header-title {
                width: 100%;
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
                background-color: #FFFFFF;
                border-radius: 40px 40px 0px 0px;
                font-family: 'poppins', sans-serif;
                padding: 20px;
                overflow: auto;
            }

            .result {
                padding: 20px 20px;
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

            .hasil-img {
                transform: rotate(90deg); 
                margin-left: -15px;
            }

            .btn {
                margin-top: 50px;
                margin-bottom: 50px;
                padding: 20px 70px;
                border: none;
                border-radius: 20px;
                font-size: 16px;
                box-shadow: 0px 6px 8px 0px rgba(0, 0, 0, 0.5);
            }
            td {
                padding: 8px;
            }
            th {
                padding: 5px;
            }
            @media print {
                .header {
                    display: none;
                }
                .action {
                    display: none;
                }
                th {
                    padding: 5px;
                }
                td {
                    color: #000 !important;
                    border: 1px solid #000;
                    font-size: 13px;
                }
                .ctn-result {
                    color: #000 !important;
                }
                body {
                    background-color: #fff;
                }
            }
        </style>
    </head>
    <body>
        <div class="header">
            <div class="header-title">
                <h1>Hasil Audit</h1>
                <span><?php echo $_SESSION['department_id']; ?></span>
            </div>
        </div>
        <div class="container">
            <div class="title">
                <h3 align="center">Hasil Detail Audit</h3><br/>
                <table width="100%" cellspacing="0">
                    <tr>
                        <td width="30%" style="padding: 0px;">Tanggal</td>
                        <td width="70%" style="padding: 0px; padding-left: 10px;">: <b><?php echo date('d F Y'); ?></b></td>
                    </tr>
                    <tr>
                        <td style="padding: 0px;">Nama Audit</td>
                        <td style="padding: 0px; padding-left: 10px;">: <b><?php echo $_SESSION['login_fullname']; ?></b></td>
                    </tr>
                    <tr>
                        <td style="padding: 0px;">Area Yang di Nilai</td>
                        <td style="padding: 0px; padding-left: 10px;">: <b><?php echo $_SESSION['department_id']; ?></b></td>
                    </tr>
                </table>
            </div>

            <table width="100%" border="1" cellspacing="0" style="margin-top: 15px;">
                <?php 
                    $today = date('Y-m-d');
                    $login = $_SESSION['login_id'];

                    $sql = mysqli_query($conn, "SELECT * FROM m_sub a LEFT JOIN m_menu b ON a.menu_id = b.menu_id");
                    while($row = mysqli_fetch_array($sql)) {
                    $title = $row['sub_title'];
                    $sub = $row['sub_id'];

                    $name = $row['menu_name'];
                    $menu = $row['menu_id'];

                    $cek = mysqli_query($conn, "SELECT * FROM t_audit_detail a LEFT JOIN t_audit b ON a.audit_id = b.audit_id WHERE sub_id = '$sub' AND audit_date = '$today' AND b.login_id = '$login'");
                    $data = mysqli_fetch_array($cek);
                    $resik = $data['detail_resik'];
                    $ringkas = $data['detail_ringkas'];
                    $rapih = $data['detail_rapih'];
                    $rajin = $data['detail_rajin'];
                    $rawat = $data['detail_rawat'];

                    if($name !== @$oldname) {
                ?>
                <tr bgcolor="#c9c9c9" style="font-weight: 700;">
                    <th><?php echo $name; ?></th>
                    <th>Resik</th>
                    <th>Ringkas</th>
                    <th>Rapih</th>
                    <th>Rajin</th>
                    <th>Rawat</th>
                </tr>
                <?php } ?>
                <tr>
                    <td width="50%"><?php echo $sub; ?>. <?php echo $title; ?></td>
                    <td width="10%" align="right" <?php if($resik > 60) { echo "style='background-color: #E82727; color: #fff;'"; } else { echo ''; } ?>><?php echo $resik; ?></td>
                    <td width="10%" align="right" <?php if($ringkas > 60) { echo "style='background-color: #E82727; color: #fff;'"; } else { echo ''; } ?>><?php echo $ringkas; ?></td>
                    <td width="10%" align="right" <?php if($rapih > 60) { echo "style='background-color: #E82727; color: #fff;'"; } else { echo ''; } ?>><?php echo $rapih; ?></td>
                    <td width="10%" align="right" <?php if($rajin > 60) { echo "style='background-color: #E82727; color: #fff;'"; } else { echo ''; } ?>><?php echo $rajin; ?></td>
                    <td width="10%" align="right" <?php if($rawat > 60) { echo "style='background-color: #E82727; color: #fff;'"; } else { echo ''; } ?>><?php echo $rawat; ?></td>
                </tr>
                <?php 
                    @$TotalResik += $resik;
                    @$TotalRingkas += $ringkas;
                    @$TotalRapih += $rapih;
                    @$TotalRajin += $rajin;
                    @$TotalRawat += $rawat;

                    @$GrandResik += $resik;
                    @$GrandRingkas += $ringkas;
                    @$GrandRapih += $rapih;
                    @$GrandRajin += $rajin;
                    @$GrandRawat += $rawat;

                    if($sub == 11 OR $sub == 18 OR $sub == 26) {
                        $query = mysqli_query($conn, "SELECT * FROM t_audit WHERE audit_date = '$today' AND login_id = '$login' AND menu_id = '$menu'");
                        while($data = mysqli_fetch_array($query)) {
                        $menu = $data['menu_id'];
                        $desc = $data['audit_desc'];
                        $tindakan = $data['audit_tindakan'];
                        $photo1 = $data['audit_photo1'];
                        $photo2 = $data['audit_photo2'];
                        $photo3 = $data['audit_photo3'];

                        $halo = mysqli_query($conn, "SELECT menu_name FROM m_menu WHERE menu_id = '$menu'");
                        $baris = mysqli_fetch_array($halo);
                        $nama = $baris['menu_name'];
                ?>
                <tr style="font-size: 20px; font-weight: 800; background-color: #c9c9c9;">
                    <td align="right">Total</td>
                    <td align="right"><?php echo number_format($TotalResik); ?></td>
                    <td align="right"><?php echo number_format($TotalRingkas); ?></td>
                    <td align="right"><?php echo number_format($TotalRapih); ?></td>
                    <td align="right"><?php echo number_format($TotalRajin); ?></td>
                    <td align="right"><?php echo number_format($TotalRawat); ?></td>
                </tr>
                <tr bgcolor="#c9c9c9" style="font-weight: 500;">
                    <th width="45%" colspan="1"><?php echo $nama; ?>.</th>
                    <th width="55%" colspan="5">Foto 1</th>
                </tr>
                <tr>
                    <td valign="top" colspan="1">
                        <b>Catatan :</b><br/>
                        <?php echo $desc; ?><br/><br/>

                        <b>Tindakan :</b><br/>
                        <?php if($tindakan == '1') { ?>
                            <button class="ctn-result secondary">Perlu Tindakan</button>
                        <?php } else { ?>
                            <button class="ctn-result primary">Tidak Perlu Tindakan</button>
                        <?php } ?> 
                    </td>
                    <td colspan="5" style="padding-top: 60px; padding-bottom: 60px;">
                        <?php if($photo1 == '') { echo ''; } else { ?>
                        <img class="hasil-img" src="photo/<?php echo $photo1; ?>" width="300" height="200">
                        <?php } ?>
                    </td>
                </tr>
                <tr bgcolor="#c9c9c9" style="font-weight: 700;">
                    <th width="45%" colspan="1">Foto 2</th>
                    <th width="55%" colspan="5">Foto 3</th>
                </tr>
                <tr>
                    <td colspan="1" style="padding-top: 60px; padding-bottom: 60px;">
                        <?php if($photo2 == '') { echo ''; } else { ?>
                        <img class="hasil-img" src="photo/<?php echo $photo2; ?>" width="300" height="200">
                        <?php } ?>
                    </td>
                    <td colspan="5" style="padding-top: 60px; padding-bottom: 60px;">
                        <?php if($photo3 == '') { echo ''; } else { ?>
                        <img class="hasil-img" src="photo/<?php echo $photo3; ?>" width="300" height="200">
                        <?php } ?>
                    </td>
                </tr>
                <?php } 
                    $TotalResik = 0;
                    $TotalRingkas = 0;
                    $TotalRapih = 0;
                    $TotalRajin = 0;
                    $TotalRawat = 0;
                } ?>

                <?php @$oldname = $name; }  ?>
                <?php 
                    $query = mysqli_query($conn, "SELECT * FROM t_audit WHERE audit_date = '$today' AND login_id = '$login' AND menu_id = '4'");
                    while($data = mysqli_fetch_array($query)) {
                    $menu = $data['menu_id'];
                    $desc = $data['audit_desc'];
                    $tindakan = $data['audit_tindakan'];
                    $photo1 = $data['audit_photo1'];
                    $photo2 = $data['audit_photo2'];
                    $photo3 = $data['audit_photo3'];

                    $halo = mysqli_query($conn, "SELECT menu_name FROM m_menu WHERE menu_id = '$menu'");
                    $baris = mysqli_fetch_array($halo);
                    $nama = $baris['menu_name'];
                ?>
                <tr bgcolor="#c9c9c9" style="font-weight: 700;">
                    <th width="45%" colspan="1"><?php echo $nama; ?>.</th>
                    <th width="55%" colspan="5">Foto 1</th>
                </tr>
                <tr>
                    <td valign="top" colspan="1">
                        <b>Catatan :</b><br/>
                        <?php echo $desc; ?><br/><br/>

                        <b>Tindakan :</b><br/>
                        <?php if($tindakan == '1') { ?>
                            <button class="ctn-result secondary">Perlu Tindakan</button>
                        <?php } else { ?>
                            <button class="ctn-result primary">Tidak Perlu Tindakan</button>
                        <?php } ?>    
                    </td>
                    <td colspan="5" style="padding-top: 60px; padding-bottom: 60px;">
                        <?php if($photo1 == '') { echo ''; } else { ?>
                        <img class="hasil-img" src="photo/<?php echo $photo1; ?>" width="300" height="200">
                        <?php } ?>
                    </td>
                </tr>
                <tr bgcolor="#c9c9c9" style="font-weight: 700;">
                    <th width="45%" colspan="1">Foto 2</th>
                    <th width="55%" colspan="5">Foto 3</th>
                </tr>
                <tr>
                    <td colspan="1" style="padding-top: 60px; padding-bottom: 60px;">
                        <?php if($photo2 == '') { echo ''; } else { ?>
                        <img class="hasil-img" src="photo/<?php echo $photo2; ?>" width="300" height="200">
                        <?php } ?>
                    </td>
                    <td colspan="5" style="padding-top: 60px; padding-bottom: 60px;">
                        <?php if($photo3 == '') { echo ''; } else { ?>
                        <img class="hasil-img" src="photo/<?php echo $photo3; ?>" width="300" height="200">
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
                <tr style="font-size: 20px; font-weight: 800; background-color: #c9c9c9;">
                    <td align="right">Grand Total</td>
                    <td align="right"><?php echo number_format($GrandResik); ?></td>
                    <td align="right"><?php echo number_format($GrandRingkas); ?></td>
                    <td align="right"><?php echo number_format($GrandRapih); ?></td>
                    <td align="right"><?php echo number_format($GrandRajin); ?></td>
                    <td align="right"><?php echo number_format($GrandRawat); ?></td>
                </tr>
            </table>
             
            <center>
                <div class="action">
                    <a href="hasil-audit.php"><button class="btn primary">Kembali Ke Hasil Audit</button></a>
                    <button type="button" class="btn primary" onclick="window.print();" style="margin-left: 10px;">Cetak</button>
                </div>
            </center>
        </div>
    </body>
    </html>

<?php
    } else {
        header("location: login.php");
    }
?>
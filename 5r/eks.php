<?php
    
    include "config.php";

    $act = $_GET['act'];
    $menu = $_POST['menu_id'];
    $login = $_POST['login_id'];

    $qry = mysqli_query($conn, "INSERT INTO t_audit (audit_id, menu_id, login_id) VALUES ('','$menu','$login')");

    $sql = mysqli_query($conn, "SELECT * FROM t_audit WHERE login_id = '$login' ORDER BY audit_id DESC LIMIT 1");
    $row = mysqli_fetch_array($sql);
    $audit_id = $row['audit_id'];

    $data_sub = mysqli_query($conn, "SELECT COUNT(sub_id) as sub FROM m_sub WHERE menu_id = '$menu'");
    $row_sub = mysqli_fetch_array($data_sub);
    $jumlah = $row_sub['sub'];

    if($act == 1) {

        for($i = 1; $i <= $jumlah; $i++) {

            $resik = $_POST['resik'.$i];
            $ringkas = $_POST['ringkas'.$i];
            $rapih = $_POST['rapih'.$i];
            $rajin = $_POST['rajin'.$i];
            $rawat = $_POST['rawat'.$i];

            $sub = $_POST[$i];

            $query = mysqli_query($conn, "INSERT INTO t_audit_detail VALUES ('','$audit_id','$sub','$resik','$ringkas','$rapih','$rajin','$rawat')");
        }

        echo "<script>window.location=('tindakan.php?menu_id=".$menu."');</script>";
    
    } elseif ($act == 2) {

        $max = 12+$jumlah;

        for($i = 12; $i < $max; $i++) {

            $resik = $_POST['resik'.$i];
            $ringkas = $_POST['ringkas'.$i];
            $rapih = $_POST['rapih'.$i];
            $rajin = $_POST['rajin'.$i];
            $rawat = $_POST['rawat'.$i];

            $sub = $_POST[$i];

            $query = mysqli_query($conn, "INSERT INTO t_audit_detail VALUES ('','$audit_id','$sub','$resik','$ringkas','$rapih','$rajin','$rawat')");

        }

        echo "<script>window.location=('tindakan.php?menu_id=".$menu."');</script>";
        
    } elseif ($act == 3) {

        $max = 19+$jumlah;

        for($i = 19; $i < $max; $i++) {

            $resik = $_POST['resik'.$i];
            $ringkas = $_POST['ringkas'.$i];
            $rapih = $_POST['rapih'.$i];
            $rajin = $_POST['rajin'.$i];
            $rawat = $_POST['rawat'.$i];

            $sub = $_POST[$i];
            
            $query = mysqli_query($conn, "INSERT INTO t_audit_detail VALUES ('','$audit_id','$sub','$resik','$ringkas','$rapih','$rajin','$rawat')");

        }
        
        echo "<script>window.location=('tindakan.php?menu_id=".$menu."');</script>";

    }

?>   